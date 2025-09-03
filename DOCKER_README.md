# HMS India IVF - Docker Setup

This document provides instructions for running the HMS India IVF application using Docker.

## Prerequisites

- Docker Desktop installed on your system
- Docker Compose (usually comes with Docker Desktop)

## Quick Start

1. **Clone and navigate to the project directory:**
   ```bash
   cd /path/to/hmsindia
   ```

2. **Build and start the containers:**
   ```bash
   docker-compose up -d --build
   ```

3. **Access the application:**
   - **Web Application:** http://localhost:8080
   - **phpMyAdmin:** http://localhost:8081
   - **Database:** localhost:3306

## Services

### Web Application (Port 8080)
- **Container:** hmsindia_web
- **Technology:** PHP 7.4 + Apache
- **URL:** http://localhost:8080

### Database (Port 3306)
- **Container:** hmsindia_db
- **Technology:** MySQL 8.0
- **Database:** hmsindiaivf
- **Username:** root
- **Password:** secret

### phpMyAdmin (Port 8081)
- **Container:** hmsindia_phpmyadmin
- **URL:** http://localhost:8081
- **Username:** root
- **Password:** secret

## Environment Configuration

The application uses environment variables for configuration. You can modify the `docker.env` file to change settings:

```env
# Database Configuration
DB_HOST=db
DB_USER=root
DB_PASSWORD=secret
DB_NAME=hmsindiaivf
```

## Database Setup

1. **Import existing database:**
   - Place your SQL dump files in the `backups/` directory
   - The database will be automatically imported on first startup

2. **Manual database access:**
   - Use phpMyAdmin at http://localhost:8081
   - Or connect directly to MySQL on localhost:3306

## File Permissions

The Docker setup automatically handles file permissions for:
- Application logs: `/var/www/html/application/logs`
- Assets directory: `/var/www/html/assets`
- Upload directories: Various asset subdirectories

## Development

### Viewing Logs
```bash
# View all logs
docker-compose logs

# View specific service logs
docker-compose logs web
docker-compose logs db
```

### Accessing Container Shell
```bash
# Access web container
docker exec -it hmsindia_web bash

# Access database container
docker exec -it hmsindia_db bash
```

### Restarting Services
```bash
# Restart all services
docker-compose restart

# Restart specific service
docker-compose restart web
```

## Stopping the Application

```bash
# Stop all services
docker-compose down

# Stop and remove volumes (WARNING: This will delete database data)
docker-compose down -v
```

## Troubleshooting

### Common Issues

1. **Port conflicts:**
   - If ports 8080, 8081, or 3306 are already in use, modify the ports in `docker-compose.yml`

2. **Permission issues:**
   - Ensure Docker has proper permissions to access the project directory
   - On Windows, make sure the project is in a Docker-accessible location

3. **Database connection issues:**
   - Wait for the database to fully initialize (can take 30-60 seconds on first run)
   - Check database logs: `docker-compose logs db`

4. **Application not loading:**
   - Check web container logs: `docker-compose logs web`
   - Verify the application is accessible at http://localhost:8080

### Reset Everything
```bash
# Stop and remove all containers, networks, and volumes
docker-compose down -v --remove-orphans

# Remove the built image
docker rmi hmsindia_web

# Rebuild and start
docker-compose up -d --build
```

## Production Considerations

For production deployment:

1. **Change default passwords** in `docker-compose.yml`
2. **Use environment files** instead of hardcoded values
3. **Enable SSL/TLS** with reverse proxy (nginx/traefik)
4. **Set up proper backup strategy** for database volumes
5. **Configure proper logging** and monitoring
6. **Use Docker secrets** for sensitive data

## Support

For issues related to:
- **Docker setup:** Check this README and Docker documentation
- **Application functionality:** Refer to the main application documentation
- **Database issues:** Check MySQL and phpMyAdmin documentation
