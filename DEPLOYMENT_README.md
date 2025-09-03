# HMS India - Deployment Guide

This guide will help you deploy your HMS India application to your Vultr server.

## 🖥️ Server Information

- **Server IP**: 139.84.175.208
- **Username**: root
- **Password**: bM}5rh5Q[rmyJzba
- **OS**: Ubuntu 25.04 x64
GRANT ALL PRIVILEGES ON stagin_hms_db.* TO 'hmaadmin'@'localhost' IDENTIFIED BY 'Admin@2025!';
FLUSH PRIVILEGES;
EXIT;
## 🚀 Quick Start

### Step 1: Initial Server Setup (Run Once)

First, you need to set up your server with the required software. Connect to your server and run the setup script:

```bash
# Connect to your server
ssh root@139.84.175.208

# Download and run the setup script
wget https://raw.githubusercontent.com/your-repo/hmsindia/main/setup-server.sh
chmod +x setup-server.sh
./setup-server.sh
```

**Or manually upload the setup script:**
```bash
# From your local machine
scp setup-server.sh root@139.84.175.208:/root/
ssh root@139.84.175.208 "chmod +x setup-server.sh && ./setup-server.sh"
```

### Step 2: Deploy Your Code

#### Option A: Using the Deployment Script (Recommended)

**For Windows:**
```cmd
# Make sure you have Git Bash or WSL installed
deploy.bat
```

**For Linux/Mac:**
```bash
chmod +x deploy.sh
./deploy.sh
```

#### Option B: Manual Deployment

```bash
# Create archive
tar -czf hms_deploy.tar.gz --exclude='.git' --exclude='node_modules' --exclude='*.log' .

# Upload to server
scp hms_deploy.tar.gz root@139.84.175.208:/tmp/

# Extract on server
ssh root@139.84.175.208 "cd /var/www/html && tar -xzf /tmp/hms_deploy.tar.gz && rm /tmp/hms_deploy.tar.gz"
```

## 📋 Prerequisites

### Local Machine Requirements

1. **Git Bash** (for Windows) or **WSL** or **Linux/Mac terminal**
2. **sshpass** (for password authentication):
   ```bash
   # Ubuntu/Debian
   sudo apt-get install sshpass
   
   # Windows (Git Bash)
   # Download from: https://sourceforge.net/projects/sshpass/
   ```

3. **rsync** (optional, for faster sync):
   ```bash
   # Usually comes with Git Bash
   # Ubuntu/Debian: sudo apt-get install rsync
   ```

### Server Requirements

The setup script will install:
- Apache2
- PHP 7.4 with required extensions
- MySQL Server
- Required system packages

## 🔧 Configuration

### Database Configuration

After deployment, update your database configuration:

**File**: `application/config/database.php`
```php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'hmsuser';
$db['default']['password'] = 'hms123456';
$db['default']['database'] = 'hmsindiaivf';
```

### Application Configuration

**File**: `application/config/config.php`
```php
$config['base_url'] = 'http://139.84.175.208/';
$config['index_page'] = '';
```

## 🗄️ Database Setup

### Import Your Database

```bash
# Connect to MySQL
mysql -u hmsuser -phms123456 hmsindiaivf

# Import your database
mysql -u hmsuser -phms123456 hmsindiaivf < your_database_backup.sql
```

### Or use phpMyAdmin

1. Install phpMyAdmin:
   ```bash
   apt install phpmyadmin
   ```

2. Access at: `http://139.84.175.208/phpmyadmin`

## 🔄 Automated Deployment with Git

### Set up Git Hooks (Optional)

Create a post-receive hook on your server:

```bash
# On your server
mkdir -p /var/repo/hmsindia.git
cd /var/repo/hmsindia.git
git init --bare

# Create post-receive hook
cat > hooks/post-receive << 'EOF'
#!/bin/bash
cd /var/www/html
git --git-dir=/var/repo/hmsindia.git --work-tree=/var/www/html checkout -f
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html
chmod -R 777 /var/www/html/application/logs
chmod -R 777 /var/www/html/assets
systemctl reload apache2
EOF

chmod +x hooks/post-receive
```

### Deploy with Git Push

```bash
# Add remote repository
git remote add production root@139.84.175.208:/var/repo/hmsindia.git

# Deploy
git push production main
```

## 🛠️ Troubleshooting

### Common Issues

1. **Permission Denied**:
   ```bash
   chmod +x deploy.sh
   chmod +x setup-server.sh
   ```

2. **SSH Connection Issues**:
   ```bash
   # Test connection
   ssh root@139.84.175.208
   
   # If using key authentication
   ssh -i your-key.pem root@139.84.175.208
   ```

3. **File Upload Issues**:
   ```bash
   # Check disk space
   df -h
   
   # Check permissions
   ls -la /var/www/html
   ```

4. **Apache Not Starting**:
   ```bash
   # Check Apache status
   systemctl status apache2
   
   # Check error logs
   tail -f /var/log/apache2/error.log
   ```

### Log Files

- **Apache Error Log**: `/var/log/apache2/error.log`
- **Apache Access Log**: `/var/log/apache2/access.log`
- **PHP Error Log**: `/var/log/php_errors.log`
- **Application Logs**: `/var/www/html/application/logs/`

## 🔐 Security Considerations

1. **Change Default Passwords**:
   ```bash
   # Change MySQL password
   mysql -u root -p
   ALTER USER 'hmsuser'@'localhost' IDENTIFIED BY 'your_strong_password';
   ```

2. **Set up SSL Certificate**:
   ```bash
   # Install Certbot
   apt install certbot python3-certbot-apache
   
   # Get certificate
   certbot --apache -d yourdomain.com
   ```

3. **Configure Firewall**:
   ```bash
   # Only allow necessary ports
   ufw allow 22/tcp
   ufw allow 80/tcp
   ufw allow 443/tcp
   ufw enable
   ```

## 📊 Monitoring

### Set up Monitoring

```bash
# Install monitoring tools
apt install htop iotop nethogs

# Check system resources
htop
df -h
free -h
```

### Backup Strategy

The setup script creates a daily backup script. Backups are stored in `/var/backups/hmsindia/`.

## 🆘 Support

If you encounter issues:

1. Check the logs (see Troubleshooting section)
2. Verify server resources: `htop`, `df -h`
3. Test connectivity: `ping`, `telnet`
4. Check Apache configuration: `apache2ctl configtest`

## 📝 Notes

- The deployment script excludes sensitive files and development-only files
- Database credentials are set during server setup
- Logs are automatically rotated to prevent disk space issues
- The server is configured for production use with security best practices
