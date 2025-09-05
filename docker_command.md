# Windows (Git Bash)
# Download from: https://sourceforge.net/projects/sshpass/

# Ubuntu/Debian
sudo apt-get install sshpass

# macOS
brew install sshpass

# Navigate to your project directory
cd C:\wamp64\www\hmsindia

# Build the Docker image
docker build -t hmsindia-local .

# Run the container locally
docker run -d \
  --name hmsindia-web \
  -p 8080:80 \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3306 \
  -e DB_USER=root \
  -e DB_PASSWORD= \
  -e DB_NAME=hmsindiaivf \
  hmsindia-local

# Check if container is running
docker ps

# View logs
docker logs hmsindia-web

# Access your application
# Open browser: http://localhost:8080

# Start all services (web + phpMyAdmin)
docker-compose up -d

# View running containers
docker-compose ps

# View logs
docker-compose logs

# Stop services
docker-compose down

# Rebuild and start
docker-compose up -d --build

# Access phpMyAdmin
# Open browser: http://localhost:8081

# Or connect directly to MySQL
docker exec -it hmsindia_phpmyadmin mysql -u root -p

# Import your database
docker exec -i hmsindia_phpmyadmin mysql -u root -p hmsindiaivf < your_database_backup.sql

# Connect to your server
ssh root@139.84.175.208

# Install Docker (if not already installed)
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh

# Install Docker Compose
curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose

# Create application directory
mkdir -p /opt/hmsindia
cd /opt/hmsindia

# From your local machine, create deployment package
tar -czf hms_deploy.tar.gz application/ assets/ system/ index.php .htaccess Dockerfile.prod docker-compose.prod.yml nginx.conf

# Upload to server
scp hms_deploy.tar.gz root@139.84.175.208:/opt/hmsindia/

# On server, extract files
cd /opt/hmsindia
tar -xzf hms_deploy.tar.gz
rm hms_deploy.tar.gz

# On server
cd /opt/hmsindia

# Create SSL certificate
mkdir -p ssl
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout ssl/key.pem \
  -out ssl/cert.pem \
  -subj "/C=IN/ST=Delhi/L=Delhi/O=HMS India/OU=IT Department/CN=139.84.175.208"

# Build and start containers
docker-compose -f docker-compose.prod.yml build --no-cache
docker-compose -f docker-compose.prod.yml up -d

# Check status
docker-compose -f docker-compose.prod.yml ps

# List running containers
docker ps

# List all containers
docker ps -a

# Start a container
docker start hmsindia-web

# Stop a container
docker stop hmsindia-web

# Restart a container
docker restart hmsindia-web

# Remove a container
docker rm hmsindia-web

# Remove all stopped containers
docker container prune

# List images
docker images

# Remove an image
docker rmi hmsindia-local

# Remove unused images
docker image prune

# Remove all unused images
docker image prune -a

# View container logs
docker logs hmsindia-web

# Follow logs in real-time
docker logs -f hmsindia-web

# View last 50 lines
docker logs --tail=50 hmsindia-web

# Execute commands in container
docker exec -it hmsindia-web bash

# Check container resource usage
docker stats hmsindia-web

# Start services
docker-compose up -d

# Stop services
docker-compose down

# Restart services
docker-compose restart

# View logs
docker-compose logs

# View logs for specific service
docker-compose logs web

# Rebuild and start
docker-compose up -d --build

# Scale services
docker-compose up -d --scale web=2

# Access MySQL shell
docker exec -it hmsindia_db mysql -u root -p

# Create database
docker exec -it hmsindia_db mysql -u root -p -e "CREATE DATABASE hmsindiaivf;"

# Import database
docker exec -i hmsindia_db mysql -u root -p hmsindiaivf < backup.sql

# Export database
docker exec hmsindia_db mysqldump -u root -p hmsindiaivf > backup.sql

# Reset MySQL root password
docker exec -it hmsindia_db mysql -u root -p -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'newpassword';"


# Check if containers are running
docker-compose ps

# Check container health
docker inspect hmsindia-web | grep -A 10 "Health"

# Check container logs for errors
docker logs hmsindia-web 2>&1 | grep -i error


# Check Docker networks
docker network ls

# Inspect network
docker network inspect hmsindia_network

# Test connectivity between containers
docker exec hmsindia-web ping db


# Fix file permissions
docker exec hmsindia-web chown -R www-data:www-data /var/www/html
docker exec hmsindia-web chmod -R 755 /var/www/html

# Check file permissions
docker exec hmsindia-web ls -la /var/www/html


# Fix file permissions
docker exec hmsindia-web chown -R www-data:www-data /var/www/html
docker exec hmsindia-web chmod -R 755 /var/www/html

# Check file permissions
docker exec hmsindia-web ls -la /var/www/html

# Check container resource usage
docker stats

# Check disk usage
docker system df

# Check system resources
docker system info

# Follow all logs
docker-compose logs -f

# Follow specific service logs
docker-compose logs -f web

# Search logs for specific terms
docker logs hmsindia-web 2>&1 | grep "ERROR"

# Remove stopped containers
docker container prune

# Remove unused images
docker image prune

# Remove unused volumes
docker volume prune

# Remove unused networks
docker network prune

# Remove everything unused
docker system prune -a

# Stop all containers
docker stop $(docker ps -aq)

# Remove all containers
docker rm $(docker ps -aq)

# Remove all images
docker rmi $(docker images -q)

# Remove all volumes
docker volume rm $(docker volume ls -q)


# 1. Navigate to project
cd C:\wamp64\www\hmsindia

# 2. Build and run
docker-compose up -d --build

# 3. Check status
docker-compose ps

# 4. Access application
# Open: http://localhost:8080

# 1. Run automated deployment
docker-deploy.bat  # Windows
# OR
./docker-deploy.sh  # Linux/Mac

# 2. Access your live application
# Open: http://139.84.175.208