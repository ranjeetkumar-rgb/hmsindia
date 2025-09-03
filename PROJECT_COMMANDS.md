# HMS India Project - Important Commands

## 🚀 Starting the Project

### First Time Setup
```bash
# Navigate to project directory
cd C:\wamp64\www\hmsindia

# Start the project (builds and runs containers)
docker-compose up -d

# Check if containers are running
docker-compose ps
```

### Daily Usage
```bash
# Start the project
docker-compose up -d

# Stop the project
docker-compose down

# Restart the project
docker-compose down && docker-compose up -d
```

## 🔧 Container Management

### View Container Status
```bash
# Check running containers
docker-compose ps

# View container logs
docker-compose logs web
docker-compose logs db

# View real-time logs
docker-compose logs -f web
```

### Container Operations
```bash
# Stop all containers
docker-compose down

# Stop and remove all containers (including orphaned)
docker-compose down --remove-orphans

# Rebuild containers (if Dockerfile changes)
docker-compose up -d --build

# Execute commands inside web container
docker exec -it hmsindia_web bash
docker exec hmsindia_web php /var/www/html/your_script.php
```

## 🗄️ Database Management

### Database Access
```bash
# Connect to MySQL database (if using Docker MySQL)
docker exec -it hmsindia_db mysql -u root -p

# Test database connection from web container
docker exec hmsindia_web php -r "try { \$pdo = new PDO('mysql:host=host.docker.internal;port=3306;dbname=hmsindiaivf', 'root', ''); echo 'Connected!'; } catch(Exception \$e) { echo 'Failed: ' . \$e->getMessage(); }"
```

### Database Backup/Restore
```bash
# Backup database (if using Docker MySQL)
docker exec hmsindia_db mysqldump -u root -p hmsindiaivf > backup.sql

# Restore database (if using Docker MySQL)
docker exec -i hmsindia_db mysql -u root -p hmsindiaivf < backup.sql
```

## 🌐 Access URLs

### Application Access
- **HMS Web Application**: http://localhost:8080
- **phpMyAdmin (WAMP)**: http://localhost/phpmyadmin/index.php
  - Username: `root`
  - Password: (leave empty)

### Database Connection Details
- **Host**: localhost:3306 (WAMP MySQL)
- **Database**: hmsindiaivf
- **Username**: root
- **Password**: (empty)

## 🛠️ Troubleshooting Commands

### Common Issues
```bash
# Check if ports are in use
netstat -an | findstr :8080
netstat -an | findstr :3306

# View detailed container information
docker inspect hmsindia_web
docker inspect hmsindia_db

# Check container resource usage
docker stats

# Remove all stopped containers
docker container prune

# Remove unused images
docker image prune
```

### Reset Everything
```bash
# Stop and remove all containers, networks, and volumes
docker-compose down -v --remove-orphans

# Remove all Docker images for this project
docker rmi hmsindia-web

# Start fresh
docker-compose up -d --build
```

## 📁 File Operations

### Copy Files to/from Container
```bash
# Copy file to container
docker cp local_file.php hmsindia_web:/var/www/html/

# Copy file from container
docker cp hmsindia_web:/var/www/html/file.php ./

# Copy entire directory
docker cp ./local_folder/ hmsindia_web:/var/www/html/
```

### View Container Files
```bash
# List files in container
docker exec hmsindia_web ls -la /var/www/html/

# View file content
docker exec hmsindia_web cat /var/www/html/index.php
```

## 🔍 Debugging Commands

### Application Debugging
```bash
# Check PHP configuration
docker exec hmsindia_web php -i

# Check PHP extensions
docker exec hmsindia_web php -m

# Test PHP syntax
docker exec hmsindia_web php -l /var/www/html/index.php

# View Apache error logs
docker exec hmsindia_web tail -f /var/log/apache2/error.log
```

### Network Debugging
```bash
# Test network connectivity
docker exec hmsindia_web ping host.docker.internal

# Check DNS resolution
docker exec hmsindia_web nslookup host.docker.internal
```

## 📋 Quick Reference

### Essential Commands (Most Used)
```bash
# Start project
docker-compose up -d

# Stop project
docker-compose down

# Check status
docker-compose ps

# View logs
docker-compose logs web

# Access application
# Browser: http://localhost:8080
# phpMyAdmin: http://localhost/phpmyadmin/index.php
```

### Emergency Commands
```bash
# Force stop everything
docker-compose down --remove-orphans

# Clean restart
docker-compose down -v && docker-compose up -d --build

# Check what's using port 8080
netstat -ano | findstr :8080
```

## ⚠️ Important Notes

1. **WAMP Server**: Make sure your WAMP server is running before starting the project
2. **Ports**: Ensure ports 8080 and 3306 are not used by other applications
3. **Database**: The project now uses your WAMP MySQL server, not Docker MySQL
4. **phpMyAdmin**: Use WAMP's phpMyAdmin at http://localhost/phpmyadmin/index.php
5. **File Changes**: Changes to application files are automatically reflected (volume mounts)

## 🆘 If Something Goes Wrong

1. Check WAMP server is running
2. Run `docker-compose ps` to see container status
3. Run `docker-compose logs web` to see error messages
4. Try `docker-compose down && docker-compose up -d` to restart
5. If still issues, run `docker-compose down -v --remove-orphans && docker-compose up -d --build`
