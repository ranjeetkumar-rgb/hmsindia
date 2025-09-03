# Database Recovery Guide

## Method 1: Export from Current phpMyAdmin

1. **Access your current phpMyAdmin:**
   - URL: http://localhost/phpmyadmin (or your current setup)
   - Login with your existing credentials

2. **Export your database:**
   - Select database: `hmsindiaivf`
   - Click "Export" tab
   - Choose "Quick" export
   - Format: SQL
   - Click "Go" to download

3. **Import to Docker database:**
   - Place the SQL file in the `backups/` folder
   - Restart Docker containers
   - The database will be automatically imported

## Method 2: Direct Import via Command Line

1. **Export from current database:**
   ```bash
   mysqldump -u root -p hmsindiaivf > hmsindiaivf_backup.sql
   ```

2. **Import to Docker database:**
   ```bash
   # Copy file to container
   docker cp hmsindiaivf_backup.sql hmsindia_db:/tmp/
   
   # Import the database
   docker exec -i hmsindia_db mysql -u root -psecret hmsindiaivf < /tmp/hmsindiaivf_backup.sql
   ```

## Method 3: Use Your Local phpMyAdmin

1. **Configure your local phpMyAdmin to connect to Docker database:**
   - Host: localhost
   - Port: 3306
   - Username: root
   - Password: secret

2. **Access your local phpMyAdmin:**
   - URL: http://localhost/phpmyadmin
   - Import your existing database

## Quick Commands

```bash
# Stop current containers
docker-compose down

# Start without phpMyAdmin container
docker-compose up -d

# Check database status
docker exec hmsindia_db mysql -u root -psecret -e "SHOW DATABASES;"
```
