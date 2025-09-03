#!/bin/bash

# HMS India Server Setup Script
# Run this script ONCE on your Vultr server to set up the environment

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}🚀 Setting up HMS India Server Environment...${NC}"

# Update system
echo -e "${YELLOW}📦 Updating system packages...${NC}"
apt update && apt upgrade -y

# Install required packages
echo -e "${YELLOW}📦 Installing required packages...${NC}"
apt install -y \
    apache2 \
    php7.4 \
    php7.4-mysql \
    php7.4-curl \
    php7.4-gd \
    php7.4-mbstring \
    php7.4-xml \
    php7.4-zip \
    php7.4-json \
    php7.4-cli \
    php7.4-common \
    php7.4-opcache \
    mysql-server \
    unzip \
    git \
    curl \
    wget \
    htop \
    nano \
    vim

# Enable Apache modules
echo -e "${YELLOW}🔧 Enabling Apache modules...${NC}"
a2enmod rewrite
a2enmod ssl
a2enmod headers

# Configure Apache
echo -e "${YELLOW}🔧 Configuring Apache...${NC}"
cat > /etc/apache2/sites-available/hmsindia.conf << 'EOF'
<VirtualHost *:80>
    ServerName hmsindia.local
    DocumentRoot /var/www/html
    
    <Directory /var/www/html>
        AllowOverride All
        Require all granted
        Options Indexes FollowSymLinks
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/hmsindia_error.log
    CustomLog ${APACHE_LOG_DIR}/hmsindia_access.log combined
</VirtualHost>
EOF

# Enable the site
a2ensite hmsindia.conf
a2dissite 000-default.conf

# Configure PHP
echo -e "${YELLOW}🔧 Configuring PHP...${NC}"
cat > /etc/php/7.4/apache2/conf.d/99-hmsindia.ini << 'EOF'
; HMS India PHP Configuration
upload_max_filesize = 50M
post_max_size = 50M
max_execution_time = 300
max_input_time = 300
memory_limit = 256M
date.timezone = Asia/Kolkata
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log
EOF

# Create web directory and set permissions
echo -e "${YELLOW}📁 Setting up web directory...${NC}"
mkdir -p /var/www/html
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

# Create logs directory
mkdir -p /var/www/html/application/logs
chown -R www-data:www-data /var/www/html/application/logs
chmod -R 777 /var/www/html/application/logs

# Create assets directory with proper permissions
mkdir -p /var/www/html/assets
chown -R www-data:www-data /var/www/html/assets
chmod -R 777 /var/www/html/assets

# Configure MySQL
echo -e "${YELLOW}🗄️ Configuring MySQL...${NC}"
mysql -e "CREATE DATABASE IF NOT EXISTS hmsindiaivf;"
mysql -e "CREATE USER IF NOT EXISTS 'hmsuser'@'localhost' IDENTIFIED BY 'hms123456';"
mysql -e "GRANT ALL PRIVILEGES ON hmsindiaivf.* TO 'hmsuser'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"

# Create database configuration file
cat > /var/www/html/db_config.php << 'EOF'
<?php
// HMS India Database Configuration for Production
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'hmsuser';
$db['default']['password'] = 'hms123456';
$db['default']['database'] = 'hmsindiaivf';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
?>
EOF

# Set up firewall
echo -e "${YELLOW}🔥 Configuring firewall...${NC}"
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw --force enable

# Create deployment user (optional)
echo -e "${YELLOW}👤 Creating deployment user...${NC}"
useradd -m -s /bin/bash deploy
usermod -aG www-data deploy
mkdir -p /home/deploy/.ssh
chmod 700 /home/deploy/.ssh

# Set up log rotation
echo -e "${YELLOW}📋 Setting up log rotation...${NC}"
cat > /etc/logrotate.d/hmsindia << 'EOF'
/var/log/apache2/hmsindia_*.log {
    daily
    missingok
    rotate 52
    compress
    delaycompress
    notifempty
    create 644 www-data www-data
    postrotate
        systemctl reload apache2
    endscript
}
EOF

# Create backup script
echo -e "${YELLOW}💾 Creating backup script...${NC}"
cat > /usr/local/bin/backup-hms.sh << 'EOF'
#!/bin/bash
BACKUP_DIR="/var/backups/hmsindia"
DATE=$(date +%Y%m%d_%H%M%S)

mkdir -p $BACKUP_DIR

# Backup database
mysqldump -u hmsuser -phms123456 hmsindiaivf > $BACKUP_DIR/database_$DATE.sql

# Backup files
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/html

# Keep only last 7 days of backups
find $BACKUP_DIR -name "*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +7 -delete

echo "Backup completed: $DATE"
EOF

chmod +x /usr/local/bin/backup-hms.sh

# Set up cron job for daily backups
echo -e "${YELLOW}⏰ Setting up daily backups...${NC}"
(crontab -l 2>/dev/null; echo "0 2 * * * /usr/local/bin/backup-hms.sh") | crontab -

# Restart services
echo -e "${YELLOW}🔄 Restarting services...${NC}"
systemctl restart apache2
systemctl restart mysql
systemctl enable apache2
systemctl enable mysql

# Create a simple test page
cat > /var/www/html/index.html << 'EOF'
<!DOCTYPE html>
<html>
<head>
    <title>HMS India - Server Ready</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 100px; }
        .success { color: green; font-size: 24px; }
        .info { color: #666; margin-top: 20px; }
    </style>
</head>
<body>
    <h1 class="success">✅ HMS India Server Setup Complete!</h1>
    <p class="info">Your server is ready for deployment.</p>
    <p class="info">Next step: Run the deployment script from your local machine.</p>
</body>
</html>
EOF

echo -e "${GREEN}🎉 Server setup completed successfully!${NC}"
echo -e "${YELLOW}📋 Summary:${NC}"
echo "✅ Apache2 installed and configured"
echo "✅ PHP 7.4 installed with required extensions"
echo "✅ MySQL installed and configured"
echo "✅ Database 'hmsindiaivf' created"
echo "✅ User 'hmsuser' created with password 'hms123456'"
echo "✅ Firewall configured (ports 22, 80, 443)"
echo "✅ Log rotation set up"
echo "✅ Daily backup script created"
echo "✅ Test page created"
echo ""
echo -e "${GREEN}🌐 Your server is now ready!${NC}"
echo "You can access it at: http://$(curl -s ifconfig.me)"
echo ""
echo -e "${YELLOW}📝 Next steps:${NC}"
echo "1. Run the deployment script from your local machine"
echo "2. Import your database if needed"
echo "3. Configure your domain name (optional)"
echo ""
echo -e "${GREEN}🔐 Database credentials:${NC}"
echo "Host: localhost"
echo "Database: hmsindiaivf"
echo "Username: hmsuser"
echo "Password: hms123456"
