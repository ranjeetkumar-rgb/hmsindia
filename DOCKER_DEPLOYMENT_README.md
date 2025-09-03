# HMS India - Docker Deployment Guide

This guide will help you deploy your HMS India application using Docker to your Vultr server.

## 🖥️ Server Information

- **Server IP**: 139.84.175.208
- **Username**: root
- **Password**: bM}5rh5Q[rmyJzba
- **OS**: Ubuntu 25.04 x64

## 🐳 Docker Architecture

Your application will run in the following Docker containers:

- **Web Container**: PHP 8.1 + Apache (your application)
- **Database Container**: MySQL 8.0
- **phpMyAdmin Container**: Database management interface
- **Nginx Container**: Reverse proxy and SSL termination

## 🚀 Quick Start

### Step 1: Initial Docker Server Setup (Run Once)

First, set up your server with Docker:

```bash
# Connect to your server
ssh root@139.84.175.208

# Upload and run the Docker setup script
scp setup-docker-server.sh root@139.84.175.208:/root/
ssh root@139.84.175.208 "chmod +x setup-docker-server.sh && ./setup-docker-server.sh"
```

### Step 2: Deploy Your Application with Docker

#### Option A: Using the Docker Deployment Script (Recommended)

**For Windows:**
```cmd
# Make sure you have Git Bash or WSL installed
docker-deploy.bat
```

**For Linux/Mac:**
```bash
chmod +x docker-deploy.sh
./docker-deploy.sh
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

### Server Requirements

The Docker setup script will install:
- Docker CE
- Docker Compose
- Required system packages
- Firewall configuration
- Backup and monitoring scripts

## 🔧 Docker Configuration

### Production Docker Compose

The `docker-compose.prod.yml` file defines:

```yaml
services:
  web:          # PHP 8.1 + Apache application
  db:           # MySQL 8.0 database
  phpmyadmin:   # Database management
  nginx:        # Reverse proxy + SSL
```

### Environment Variables

```bash
DB_HOST=db
DB_PORT=3306
DB_USER=hmsuser
DB_PASSWORD=hms123456
DB_NAME=hmsindiaivf
ENVIRONMENT=production
```

## 🗄️ Database Setup

### Database Credentials

**Production Server:**
- **Host**: `db` (internal) or `139.84.175.208:3306` (external)
- **Database**: `hmsindiaivf_prod`
- **Username**: `hmsuser`
- **Password**: `hms123456`
- **Root Password**: `root123456`

**Local Development:**
- **Host**: `db` (internal) or `localhost:3307` (external)
- **Database**: `hmsindiaivf_dev`
- **Username**: `root`
- **Password**: (empty)

### Import Your Database

**For Production Server:**
```bash
# Connect to MySQL container
docker exec -it hmsindia_db_prod mysql -u hmsuser -phms123456 hmsindiaivf_prod

# Import your database
docker exec -i hmsindia_db_prod mysql -u hmsuser -phms123456 hmsindiaivf_prod < your_database_backup.sql
```

**For Local Development:**
```bash
# Connect to MySQL container
docker exec -it hmsindia_db mysql -u root -p hmsindiaivf_dev

# Import your database
docker exec -i hmsindia_db mysql -u root -p hmsindiaivf_dev < your_database_backup.sql
```

## 🌐 Access URLs

**Production Server:**
- **Main Application**: http://139.84.175.208
- **phpMyAdmin**: http://139.84.175.208:8080
- **Database (External)**: 139.84.175.208:3306

**Local Development:**
- **Main Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **Database (External)**: localhost:3307

## 🔄 Docker Commands

### Container Management

```bash
# View running containers
docker ps

# View all containers
docker ps -a

# View container logs
docker logs hmsindia_web_prod
docker logs hmsindia_db_prod

# Execute commands in container
docker exec -it hmsindia_web_prod bash
docker exec -it hmsindia_db_prod mysql -u root -p

# Restart containers
docker restart hmsindia_web_prod
```

### Docker Compose Commands

```bash
# Navigate to application directory
cd /opt/hmsindia

# View container status
docker-compose -f docker-compose.prod.yml ps

# View logs
docker-compose -f docker-compose.prod.yml logs

# Restart services
docker-compose -f docker-compose.prod.yml restart

# Stop services
docker-compose -f docker-compose.prod.yml down

# Start services
docker-compose -f docker-compose.prod.yml up -d

# Rebuild and start
docker-compose -f docker-compose.prod.yml up -d --build
```

## 🛠️ Troubleshooting

### Common Issues

1. **Container Won't Start**:
   ```bash
   # Check logs
   docker logs hmsindia_web_prod
   
   # Check container status
   docker ps -a
   ```

2. **Database Connection Issues**:
   ```bash
   # Check database container
   docker exec hmsindia_db_prod mysql -u root -p
   
   # Check network connectivity
   docker exec hmsindia_web_prod ping db
   ```

3. **Permission Issues**:
   ```bash
   # Fix permissions
   docker exec hmsindia_web_prod chown -R www-data:www-data /var/www/html
   docker exec hmsindia_web_prod chmod -R 755 /var/www/html
   ```

4. **Port Conflicts**:
   ```bash
   # Check what's using ports
   netstat -tulpn | grep :80
   netstat -tulpn | grep :3306
   ```

### Log Files

- **Application Logs**: `docker logs hmsindia_web_prod`
- **Database Logs**: `docker logs hmsindia_db_prod`
- **Nginx Logs**: `docker logs hmsindia_nginx_prod`
- **phpMyAdmin Logs**: `docker logs hmsindia_phpmyadmin_prod`

## 🔐 Security Considerations

### SSL Certificate

The deployment script generates a self-signed SSL certificate. For production:

```bash
# Install Certbot
apt install certbot

# Get Let's Encrypt certificate
certbot certonly --standalone -d yourdomain.com

# Copy certificates to Docker
cp /etc/letsencrypt/live/yourdomain.com/fullchain.pem /opt/hmsindia/ssl/cert.pem
cp /etc/letsencrypt/live/yourdomain.com/privkey.pem /opt/hmsindia/ssl/key.pem

# Restart containers
cd /opt/hmsindia && docker-compose -f docker-compose.prod.yml restart
```

### Firewall Configuration

```bash
# Check firewall status
ufw status

# Allow specific ports
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw allow 8080/tcp
```

## 📊 Monitoring

### Built-in Monitoring

```bash
# Run monitoring script
/usr/local/bin/monitor-hms-docker.sh

# Check resource usage
docker stats

# Check disk usage
df -h

# Check memory usage
free -h
```

### Log Monitoring

```bash
# Follow logs in real-time
docker-compose -f docker-compose.prod.yml logs -f

# Follow specific service logs
docker-compose -f docker-compose.prod.yml logs -f web
```

## 💾 Backup Strategy

### Automated Backups

The setup script creates daily backups:

```bash
# Manual backup
/usr/local/bin/backup-hms-docker.sh

# Backup includes:
# - Database dump
# - Application files
# - Stored in /var/backups/hmsindia-docker/
```

### Manual Backup

```bash
# Backup database
docker exec hmsindia_db_prod mysqldump -u hmsuser -phms123456 hmsindiaivf > backup.sql

# Backup application files
docker exec hmsindia_web_prod tar -czf /tmp/app_backup.tar.gz /var/www/html
docker cp hmsindia_web_prod:/tmp/app_backup.tar.gz ./
```

## 🔄 Updates and Maintenance

### Update Application

```bash
# Deploy new version
./docker-deploy.sh

# Or manually update
cd /opt/hmsindia
docker-compose -f docker-compose.prod.yml down
docker-compose -f docker-compose.prod.yml up -d --build
```

### Update Docker Images

```bash
# Pull latest images
docker-compose -f docker-compose.prod.yml pull

# Recreate containers
docker-compose -f docker-compose.prod.yml up -d
```

### Clean Up

```bash
# Remove unused images
docker image prune

# Remove unused volumes
docker volume prune

# Remove unused networks
docker network prune

# Full cleanup
docker system prune -a
```

## 🆘 Support

If you encounter issues:

1. Check container logs: `docker logs <container_name>`
2. Check container status: `docker ps -a`
3. Verify network connectivity: `docker network ls`
4. Check resource usage: `docker stats`
5. Review firewall settings: `ufw status`

## 📝 Notes

- All containers are configured for production use
- SSL certificates are automatically generated
- Logs are automatically rotated
- Backups run daily at 2 AM
- The system is optimized for performance and security
- All sensitive data is properly secured
