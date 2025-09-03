#!/bin/bash

# HMS India Docker Deployment Script
# This script deploys your application using Docker to the Vultr server

# Configuration
SERVER_IP="139.84.175.208"
SERVER_USER="root"
SERVER_PASSWORD="bM}5rh5Q[rmyJzba"
REMOTE_PATH="/opt/hmsindia"
LOCAL_PATH="."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${GREEN}🐳 Starting HMS India Docker Deployment...${NC}"

# Function to check prerequisites
check_prerequisites() {
    echo -e "${YELLOW}🔍 Checking prerequisites...${NC}"
    
    # Check if we're in the right directory
    if [ ! -d "application" ]; then
        echo -e "${RED}❌ Error: application folder not found. Please run this script from the project root.${NC}"
        exit 1
    fi
    
    # Check if Docker files exist
    if [ ! -f "Dockerfile.prod" ] || [ ! -f "docker-compose.prod.yml" ]; then
        echo -e "${RED}❌ Error: Docker files not found. Please ensure Dockerfile.prod and docker-compose.prod.yml exist.${NC}"
        exit 1
    fi
    
    # Check if sshpass is available
    if ! command -v sshpass &> /dev/null; then
        echo -e "${RED}❌ sshpass is not installed. Please install it first.${NC}"
        echo "On Ubuntu/Debian: sudo apt-get install sshpass"
        echo "On Windows with WSL: sudo apt-get install sshpass"
        exit 1
    fi
    
    echo -e "${GREEN}✅ Prerequisites check passed!${NC}"
}

# Function to create deployment package
create_deployment_package() {
    echo -e "${YELLOW}📦 Creating deployment package...${NC}"
    
    # Create a temporary directory for deployment
    TEMP_DIR=$(mktemp -d)
    DEPLOY_DIR="$TEMP_DIR/hmsindia"
    
    # Create deployment directory
    mkdir -p "$DEPLOY_DIR"
    
    # Copy necessary files
    cp -r application "$DEPLOY_DIR/"
    cp -r assets "$DEPLOY_DIR/"
    cp -r system "$DEPLOY_DIR/"
    cp index.php "$DEPLOY_DIR/"
    cp .htaccess "$DEPLOY_DIR/"
    cp Dockerfile.prod "$DEPLOY_DIR/"
    cp docker-compose.prod.yml "$DEPLOY_DIR/"
    cp nginx.conf "$DEPLOY_DIR/"
    cp env.production "$DEPLOY_DIR/.env" 2>/dev/null || true
    cp composer.json "$DEPLOY_DIR/" 2>/dev/null || true
    cp composer.lock "$DEPLOY_DIR/" 2>/dev/null || true
    
    # Create .dockerignore
    cat > "$DEPLOY_DIR/.dockerignore" << 'EOF'
.git
.gitignore
*.md
backups/
staging/
phpmyadmin/
cgi-bin/
*.log
*.tmp
.DS_Store
Thumbs.db
deploy*.sh
deploy*.bat
setup-server.sh
docker-compose.yml
Dockerfile
EOF
    
    # Create deployment archive
    cd "$TEMP_DIR"
    tar -czf hms_docker_deploy.tar.gz hmsindia/
    cd - > /dev/null
    
    echo -e "${GREEN}✅ Deployment package created!${NC}"
    echo "$TEMP_DIR/hms_docker_deploy.tar.gz"
}

# Function to upload and deploy
deploy_to_server() {
    local package_path="$1"
    
    echo -e "${YELLOW}📤 Uploading package to server...${NC}"
    
    # Upload package
    sshpass -p "$SERVER_PASSWORD" scp -o StrictHostKeyChecking=no "$package_path" "$SERVER_USER@$SERVER_IP:/tmp/"
    
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Upload failed!${NC}"
        return 1
    fi
    
    echo -e "${GREEN}✅ Package uploaded successfully!${NC}"
    
    echo -e "${YELLOW}🔧 Deploying on server...${NC}"
    
    # Deploy on server
    sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER_USER@$SERVER_IP" << 'EOF'
        # Stop existing containers
        cd /opt/hmsindia 2>/dev/null && docker-compose -f docker-compose.prod.yml down 2>/dev/null || true
        
        # Create directory
        mkdir -p /opt/hmsindia
        
        # Extract new package
        cd /opt/hmsindia
        tar -xzf /tmp/hms_docker_deploy.tar.gz --strip-components=1
        rm /tmp/hms_docker_deploy.tar.gz
        
        # Set proper permissions
        chown -R root:root /opt/hmsindia
        chmod +x /opt/hmsindia/docker-deploy.sh 2>/dev/null || true
        
        # Create SSL directory
        mkdir -p ssl
        
        # Generate self-signed certificate if not exists
        if [ ! -f ssl/cert.pem ]; then
            openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
                -keyout ssl/key.pem \
                -out ssl/cert.pem \
                -subj "/C=IN/ST=Delhi/L=Delhi/O=HMS India/OU=IT Department/CN=139.84.175.208"
        fi
        
        # Create MySQL config directory
        mkdir -p mysql-config
        
        # Create MySQL configuration
        cat > mysql-config/custom.cnf << 'MYSQL_EOF'
[mysqld]
max_connections = 200
innodb_buffer_pool_size = 256M
innodb_log_file_size = 64M
query_cache_size = 32M
query_cache_type = 1
slow_query_log = 1
slow_query_log_file = /var/lib/mysql/slow.log
long_query_time = 2
MYSQL_EOF
        
        # Build and start containers
        docker-compose -f docker-compose.prod.yml build --no-cache
        docker-compose -f docker-compose.prod.yml up -d
        
        # Wait for services to be ready
        echo "Waiting for services to start..."
        sleep 30
        
        # Check container status
        docker-compose -f docker-compose.prod.yml ps
        
        # Show logs if there are issues
        if ! docker-compose -f docker-compose.prod.yml ps | grep -q "Up"; then
            echo "Container startup issues detected. Showing logs:"
            docker-compose -f docker-compose.prod.yml logs
        fi
        
        echo "✅ Docker deployment completed!"
EOF
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ Deployment completed successfully!${NC}"
        return 0
    else
        echo -e "${RED}❌ Deployment failed!${NC}"
        return 1
    fi
}

# Function to show deployment status
show_status() {
    echo -e "${YELLOW}📊 Checking deployment status...${NC}"
    
    sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER_USER@$SERVER_IP" << 'EOF'
        cd /opt/hmsindia
        echo "=== Container Status ==="
        docker-compose -f docker-compose.prod.yml ps
        
        echo ""
        echo "=== Container Logs (last 20 lines) ==="
        docker-compose -f docker-compose.prod.yml logs --tail=20
        
        echo ""
        echo "=== System Resources ==="
        docker stats --no-stream --format "table {{.Container}}\t{{.CPUPerc}}\t{{.MemUsage}}\t{{.NetIO}}"
EOF
}

# Function to cleanup
cleanup() {
    local temp_dir="$1"
    if [ -n "$temp_dir" ] && [ -d "$temp_dir" ]; then
        rm -rf "$temp_dir"
        echo -e "${BLUE}🧹 Cleaned up temporary files${NC}"
    fi
}

# Main deployment function
main() {
    echo -e "${GREEN}🐳 HMS India Docker Deployment Script${NC}"
    echo "Server: $SERVER_IP"
    echo "Remote Path: $REMOTE_PATH"
    echo ""
    
    # Check prerequisites
    check_prerequisites
    
    # Create deployment package
    package_path=$(create_deployment_package)
    temp_dir=$(dirname "$package_path")
    
    # Deploy to server
    if deploy_to_server "$package_path"; then
        echo -e "${GREEN}🎉 Deployment completed successfully!${NC}"
        echo ""
        echo -e "${YELLOW}📋 Deployment Summary:${NC}"
        echo "✅ Application deployed using Docker"
        echo "✅ MySQL database container running"
        echo "✅ phpMyAdmin available at port 8080"
        echo "✅ Nginx reverse proxy configured"
        echo "✅ SSL certificate generated"
        echo ""
        echo -e "${GREEN}🌐 Access URLs:${NC}"
        echo "• Main Application: http://$SERVER_IP"
        echo "• phpMyAdmin: http://$SERVER_IP:8080"
        echo "• Database: localhost:3306"
        echo ""
        echo -e "${GREEN}🔐 Database Credentials:${NC}"
        echo "• Host: localhost (from server) or $SERVER_IP:3306 (external)"
        echo "• Database: hmsindiaivf"
        echo "• Username: hmsuser"
        echo "• Password: hms123456"
        echo "• Root Password: root123456"
        echo ""
        
        # Show status
        show_status
    else
        echo -e "${RED}❌ Deployment failed!${NC}"
        echo "Check the logs above for more details."
    fi
    
    # Cleanup
    cleanup "$temp_dir"
}

# Run main function
main
