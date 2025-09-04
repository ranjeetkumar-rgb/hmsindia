# HMS India - Local Development Guide

This guide will help you set up and run your HMS India application locally using traditional PHP/Apache/MySQL setup.

## 🚀 Quick Start

### Option 1: One-Click Setup (Recommended)

**For Windows:**
```cmd
# Just double-click this file:
setup-local-dev.bat
```

**For Linux/Mac:**
```bash
chmod +x setup-local-dev.sh
./setup-local-dev.sh
```

### Option 2: Manual Setup

```bash
# 1. Create configuration files
cp application/config/database.php.example application/config/database.php
cp application/config/config.php.example application/config/config.php
cp env.local .env

# 2. Start your local web server
# Use XAMPP, WAMP, MAMP, or built-in PHP server
```

## 🖥️ Local Development Architecture

Your local development environment uses:

- **Web Server**: Apache (via XAMPP/WAMP/MAMP) or PHP built-in server
- **Database**: MySQL 8.0 (local installation)
- **PHP**: PHP 7.4+ (recommended 8.1+)

## 🌐 Access URLs

After setup:

- **Main Application**: http://localhost/hmsindia (or http://localhost:8080)
- **phpMyAdmin**: http://localhost/phpmyadmin (if using XAMPP/WAMP)
- **Database (External)**: localhost:3306

## 🔐 Database Credentials (Local Development)

- **Host**: `localhost`
- **Database**: `hmsindiaivf`
- **Username**: `root`
- **Password**: (empty or your local MySQL password)

## 📋 Prerequisites

1. **PHP 7.4+** (recommended 8.1+) installed
2. **Apache Web Server** (or use PHP built-in server)
3. **MySQL 8.0** installed and running
4. **Git** (for version control)

### Recommended Local Development Stacks:

- **Windows**: XAMPP, WAMP, or Laragon
- **Mac**: XAMPP, MAMP, or Homebrew
- **Linux**: Apache + PHP + MySQL via package manager

## 🔧 Configuration Files

### Environment Configuration

The setup creates these configuration files:

- **`.env`** - Environment variables for local development
- **`application/config/database.php`** - Database configuration
- **`application/config/config.php`** - Application configuration

### Database Configuration

Your local database is configured with:
- **Database Name**: `hmsindiaivf_dev`
- **Username**: `root`
- **Password**: (empty)
- **Port**: `3307` (external), `3306` (internal)

## 🗄️ Database Management

### Import Your Development Database

```bash
# Connect to MySQL container
docker exec -it hmsindia_db mysql -u root -p hmsindiaivf_dev

# Import your database
docker exec -i hmsindia_db mysql -u root -p hmsindiaivf_dev < your_database_backup.sql
```

### Using phpMyAdmin

1. Open http://localhost:8081
2. Login with:
   - **Server**: `db`
   - **Username**: `root`
   - **Password**: (leave empty)

## 🔄 Daily Development Workflow

### Starting Development

```bash
# Start containers
docker-compose up -d

# Check status
docker-compose ps
```

### Stopping Development

```bash
# Stop containers
docker-compose down
```

### Restarting Services

```bash
# Restart all services
docker-compose restart

# Restart specific service
docker-compose restart web
docker-compose restart db
```

## 🛠️ Useful Commands

### Container Management

```bash
# View running containers
docker-compose ps

# View logs
docker-compose logs
docker-compose logs web
docker-compose logs db

# Execute commands in containers
docker exec -it hmsindia_web bash
docker exec -it hmsindia_db mysql -u root -p
```

### Database Operations

```bash
# Connect to database
docker exec -it hmsindia_db mysql -u root -p

# Backup database
docker exec hmsindia_db mysqldump -u root -p hmsindiaivf_dev > backup.sql

# Restore database
docker exec -i hmsindia_db mysql -u root -p hmsindiaivf_dev < backup.sql
```

### File Operations

```bash
# Copy files to container
docker cp local_file.php hmsindia_web:/var/www/html/

# Copy files from container
docker cp hmsindia_web:/var/www/html/file.php ./

# View container files
docker exec hmsindia_web ls -la /var/www/html/
```

## 🛠️ Troubleshooting

### Common Issues

1. **Port Already in Use**:
   ```bash
   # Check what's using port 8080
   netstat -ano | findstr :8080
   
   # Stop containers and restart
   docker-compose down
   docker-compose up -d
   ```

2. **Container Won't Start**:
   ```bash
   # Check logs
   docker-compose logs
   
   # Rebuild containers
   docker-compose down
   docker-compose up -d --build
   ```

3. **Database Connection Issues**:
   ```bash
   # Check database container
   docker exec hmsindia_db mysql -u root -p
   
   # Check network connectivity
   docker exec hmsindia_web ping db
   ```

4. **Permission Issues**:
   ```bash
   # Fix permissions
   docker exec hmsindia_web chown -R www-data:www-data /var/www/html
   docker exec hmsindia_web chmod -R 755 /var/www/html
   ```

### Log Files

- **Application Logs**: `docker-compose logs web`
- **Database Logs**: `docker-compose logs db`
- **All Logs**: `docker-compose logs`

## 🔄 Updates and Maintenance

### Update Application Code

Your application code is mounted as a volume, so changes are reflected immediately. No need to rebuild containers.

### Update Dependencies

```bash
# Rebuild containers with new dependencies
docker-compose down
docker-compose up -d --build
```

### Clean Up

```bash
# Remove containers and volumes
docker-compose down -v

# Remove unused images
docker image prune

# Full cleanup
docker system prune -a
```

## 📊 Development vs Production

| Aspect | Local Development | Production Server |
|--------|------------------|-------------------|
| **Database** | `hmsindiaivf_dev` | `hmsindiaivf_prod` |
| **Username** | `root` | `hmsuser` |
| **Password** | (empty) | `hms123456` |
| **Port** | `3307` | `3306` |
| **Debug** | Enabled | Disabled |
| **Logs** | Verbose | Errors only |
| **SSL** | Disabled | Enabled |

## 🆘 Support

If you encounter issues:

1. Check container logs: `docker-compose logs`
2. Verify Docker is running: `docker ps`
3. Check port availability: `netstat -ano | findstr :8080`
4. Restart Docker Desktop if needed
5. Try rebuilding containers: `docker-compose up -d --build`

## 📝 Notes

- Your local database is completely separate from production
- All file changes are reflected immediately (volume mounts)
- Use `docker-compose down` to stop when done developing
- The development environment is optimized for debugging and testing
- All sensitive data is kept local and secure
