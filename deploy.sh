#!/bin/bash

# HMS India Deployment Script
# This script deploys your local code to the Vultr server

# Configuration
SERVER_IP="139.84.175.208"
SERVER_USER="root"
SERVER_PASSWORD="bM}5rh5Q[rmyJzba"
REMOTE_PATH="/var/www/html"
LOCAL_PATH="."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}🚀 Starting HMS India Deployment...${NC}"

# Function to check if rsync is available
check_rsync() {
    if ! command -v rsync &> /dev/null; then
        echo -e "${RED}❌ rsync is not installed. Please install it first.${NC}"
        echo "On Windows with WSL: sudo apt-get install rsync"
        echo "On Windows with Git Bash: rsync should be available"
        exit 1
    fi
}

# Function to deploy using rsync
deploy_with_rsync() {
    echo -e "${YELLOW}📦 Syncing files to server...${NC}"
    
    # Create exclude file for rsync
    cat > .rsync-exclude << EOF
.git/
.gitignore
node_modules/
*.log
*.tmp
.DS_Store
Thumbs.db
deploy.sh
.rsync-exclude
backups/
staging/
phpmyadmin/
cgi-bin/
*.md
docker-compose.yml
Dockerfile
composer.phar
composer.lock
vendor/
EOF

    # Deploy files
    rsync -avz --delete --exclude-from=.rsync-exclude \
        -e "sshpass -p '$SERVER_PASSWORD' ssh -o StrictHostKeyChecking=no" \
        "$LOCAL_PATH/" "$SERVER_USER@$SERVER_IP:$REMOTE_PATH/"
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ Files synced successfully!${NC}"
    else
        echo -e "${RED}❌ File sync failed!${NC}"
        exit 1
    fi
    
    # Clean up
    rm -f .rsync-exclude
}

# Function to deploy using scp (fallback)
deploy_with_scp() {
    echo -e "${YELLOW}📦 Uploading files to server using SCP...${NC}"
    
    # Create a temporary archive
    echo "Creating archive..."
    tar -czf hms_deploy.tar.gz \
        --exclude='.git' \
        --exclude='node_modules' \
        --exclude='*.log' \
        --exclude='*.tmp' \
        --exclude='.DS_Store' \
        --exclude='Thumbs.db' \
        --exclude='deploy.sh' \
        --exclude='backups' \
        --exclude='staging' \
        --exclude='phpmyadmin' \
        --exclude='cgi-bin' \
        --exclude='*.md' \
        --exclude='docker-compose.yml' \
        --exclude='Dockerfile' \
        --exclude='composer.phar' \
        --exclude='composer.lock' \
        --exclude='vendor' \
        .
    
    # Upload archive
    sshpass -p "$SERVER_PASSWORD" scp -o StrictHostKeyChecking=no hms_deploy.tar.gz "$SERVER_USER@$SERVER_IP:/tmp/"
    
    # Extract on server
    sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER_USER@$SERVER_IP" << 'EOF'
        cd /var/www/html
        tar -xzf /tmp/hms_deploy.tar.gz
        rm /tmp/hms_deploy.tar.gz
        chown -R www-data:www-data /var/www/html
        chmod -R 755 /var/www/html
        chmod -R 777 /var/www/html/application/logs
        chmod -R 777 /var/www/html/assets
        echo "✅ Files extracted and permissions set!"
EOF
    
    # Clean up local archive
    rm -f hms_deploy.tar.gz
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ Deployment completed successfully!${NC}"
    else
        echo -e "${RED}❌ Deployment failed!${NC}"
        exit 1
    fi
}

# Function to run post-deployment commands
post_deployment() {
    echo -e "${YELLOW}🔧 Running post-deployment setup...${NC}"
    
    sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER_USER@$SERVER_IP" << 'EOF'
        # Set proper permissions
        chown -R www-data:www-data /var/www/html
        chmod -R 755 /var/www/html
        chmod -R 777 /var/www/html/application/logs
        chmod -R 777 /var/www/html/assets
        
        # Restart Apache if needed
        systemctl restart apache2
        
        # Clear any caches if needed
        rm -rf /var/www/html/application/cache/*
        
        echo "✅ Post-deployment setup completed!"
EOF
}

# Main deployment function
main() {
    echo -e "${GREEN}🎯 HMS India Deployment Script${NC}"
    echo "Server: $SERVER_IP"
    echo "Remote Path: $REMOTE_PATH"
    echo ""
    
    # Check if sshpass is available
    if ! command -v sshpass &> /dev/null; then
        echo -e "${RED}❌ sshpass is not installed. Please install it first.${NC}"
        echo "On Ubuntu/Debian: sudo apt-get install sshpass"
        echo "On Windows with WSL: sudo apt-get install sshpass"
        echo "On Windows with Git Bash: Download from https://sourceforge.net/projects/sshpass/"
        exit 1
    fi
    
    # Try rsync first, fallback to scp
    if command -v rsync &> /dev/null; then
        deploy_with_rsync
    else
        deploy_with_scp
    fi
    
    post_deployment
    
    echo -e "${GREEN}🎉 Deployment completed successfully!${NC}"
    echo -e "${YELLOW}🌐 Your application should be available at: http://$SERVER_IP${NC}"
}

# Run main function
main
