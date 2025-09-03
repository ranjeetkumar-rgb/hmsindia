#!/bin/bash

# HMS India Docker Server Setup Script
# Run this script ONCE on your Vultr server to set up Docker environment

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${GREEN}🐳 Setting up HMS India Docker Server Environment...${NC}"

# Update system
echo -e "${YELLOW}📦 Updating system packages...${NC}"
apt update && apt upgrade -y

# Install required packages
echo -e "${YELLOW}📦 Installing required packages...${NC}"
apt install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg \
    lsb-release \
    software-properties-common \
    git \
    unzip \
    wget \
    htop \
    nano \
    vim \
    ufw

# Install Docker
echo -e "${YELLOW}🐳 Installing Docker...${NC}"
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null

apt update
apt install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin

# Install Docker Compose (standalone)
echo -e "${YELLOW}📦 Installing Docker Compose...${NC}"
curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose

# Add docker-compose to PATH
echo 'export PATH="/usr/local/bin:$PATH"' >> /etc/environment
source /etc/environment

# Start and enable Docker
systemctl start docker
systemctl enable docker

# Add current user to docker group
usermod -aG docker $USER

# Create application directory
echo -e "${YELLOW}📁 Creating application directory...${NC}"
mkdir -p /opt/hmsindia
chown -R root:root /opt/hmsindia

# Configure firewall
echo -e "${YELLOW}🔥 Configuring firewall...${NC}"
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw allow 8080/tcp
ufw allow 3306/tcp
ufw --force enable

# Create Docker network
echo -e "${YELLOW}🌐 Creating Docker network...${NC}"
docker network create hmsindia_network 2>/dev/null || true

# Create backup script
echo -e "${YELLOW}💾 Creating backup script...${NC}"
cat > /usr/local/bin/backup-hms-docker.sh << 'EOF'
#!/bin/bash
BACKUP_DIR="/var/backups/hmsindia-docker"
DATE=$(date +%Y%m%d_%H%M%S)

mkdir -p $BACKUP_DIR

# Backup database
docker exec hmsindia_db_prod mysqldump -u hmsuser -phms123456 hmsindiaivf > $BACKUP_DIR/database_$DATE.sql

# Backup application files
docker exec hmsindia_web_prod tar -czf /tmp/app_backup_$DATE.tar.gz /var/www/html
docker cp hmsindia_web_prod:/tmp/app_backup_$DATE.tar.gz $BACKUP_DIR/
docker exec hmsindia_web_prod rm /tmp/app_backup_$DATE.tar.gz

# Keep only last 7 days of backups
find $BACKUP_DIR -name "*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +7 -delete

echo "Docker backup completed: $DATE"
EOF

chmod +x /usr/local/bin/backup-hms-docker.sh

# Set up cron job for daily backups
echo -e "${YELLOW}⏰ Setting up daily backups...${NC}"
(crontab -l 2>/dev/null; echo "0 2 * * * /usr/local/bin/backup-hms-docker.sh") | crontab -

# Create monitoring script
echo -e "${YELLOW}📊 Creating monitoring script...${NC}"
cat > /usr/local/bin/monitor-hms-docker.sh << 'EOF'
#!/bin/bash
echo "=== HMS India Docker Status ==="
echo "Date: $(date)"
echo ""

echo "=== Container Status ==="
cd /opt/hmsindia && docker-compose -f docker-compose.prod.yml ps

echo ""
echo "=== Container Resource Usage ==="
docker stats --no-stream --format "table {{.Container}}\t{{.CPUPerc}}\t{{.MemUsage}}\t{{.NetIO}}"

echo ""
echo "=== Disk Usage ==="
df -h

echo ""
echo "=== Memory Usage ==="
free -h

echo ""
echo "=== Recent Logs ==="
cd /opt/hmsindia && docker-compose -f docker-compose.prod.yml logs --tail=10
EOF

chmod +x /usr/local/bin/monitor-hms-docker.sh

# Create log rotation for Docker
echo -e "${YELLOW}📋 Setting up log rotation...${NC}"
cat > /etc/logrotate.d/docker-containers << 'EOF'
/var/lib/docker/containers/*/*.log {
    daily
    missingok
    rotate 7
    compress
    delaycompress
    notifempty
    create 0644 root root
}
EOF

# Configure Docker daemon for better performance
echo -e "${YELLOW}⚙️ Configuring Docker daemon...${NC}"
cat > /etc/docker/daemon.json << 'EOF'
{
    "log-driver": "json-file",
    "log-opts": {
        "max-size": "10m",
        "max-file": "3"
    },
    "storage-driver": "overlay2",
    "live-restore": true
}
EOF

# Restart Docker daemon
systemctl restart docker

# Create SSL directory
mkdir -p /opt/hmsindia/ssl

# Create MySQL config directory
mkdir -p /opt/hmsindia/mysql-config

# Create a simple test page
cat > /opt/hmsindia/index.html << 'EOF'
<!DOCTYPE html>
<html>
<head>
    <title>HMS India - Docker Server Ready</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .success { font-size: 24px; margin-bottom: 20px; }
        .info { margin: 10px 0; }
        .docker { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="success">🐳 HMS India Docker Server Setup Complete!</h1>
        <div class="docker">
            <h2>Docker Environment Ready</h2>
            <p>Your server is now configured for Docker deployment.</p>
        </div>
        <p class="info">✅ Docker installed and configured</p>
        <p class="info">✅ Docker Compose installed</p>
        <p class="info">✅ Firewall configured</p>
        <p class="info">✅ Backup system set up</p>
        <p class="info">✅ Monitoring tools installed</p>
        <p class="info">Next step: Run the Docker deployment script from your local machine.</p>
    </div>
</body>
</html>
EOF

# Set proper permissions
chown -R root:root /opt/hmsindia
chmod -R 755 /opt/hmsindia

echo -e "${GREEN}🎉 Docker server setup completed successfully!${NC}"
echo -e "${YELLOW}📋 Summary:${NC}"
echo "✅ Docker CE installed and configured"
echo "✅ Docker Compose installed"
echo "✅ Application directory created: /opt/hmsindia"
echo "✅ Firewall configured (ports 22, 80, 443, 8080, 3306)"
echo "✅ Docker network created"
echo "✅ Log rotation configured"
echo "✅ Daily backup script created"
echo "✅ Monitoring script created"
echo "✅ Test page created"
echo ""
echo -e "${GREEN}🐳 Your Docker server is now ready!${NC}"
echo "You can access it at: http://$(curl -s ifconfig.me)"
echo ""
echo -e "${YELLOW}📝 Next steps:${NC}"
echo "1. Run the Docker deployment script from your local machine"
echo "2. Your application will be available at: http://$(curl -s ifconfig.me)"
echo "3. phpMyAdmin will be available at: http://$(curl -s ifconfig.me):8080"
echo ""
echo -e "${GREEN}🔧 Useful commands:${NC}"
echo "• Monitor containers: /usr/local/bin/monitor-hms-docker.sh"
echo "• Backup data: /usr/local/bin/backup-hms-docker.sh"
echo "• View logs: cd /opt/hmsindia && docker-compose -f docker-compose.prod.yml logs"
echo "• Restart services: cd /opt/hmsindia && docker-compose -f docker-compose.prod.yml restart"
echo ""
echo -e "${BLUE}💡 Docker commands:${NC}"
echo "• List containers: docker ps"
echo "• View logs: docker logs <container_name>"
echo "• Execute commands: docker exec -it <container_name> bash"
echo "• Stop all: docker stop \$(docker ps -q)"
echo "• Remove all: docker system prune -a"
