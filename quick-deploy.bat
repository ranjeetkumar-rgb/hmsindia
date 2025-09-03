@echo off
REM Quick Deployment Script for HMS India
REM Simple one-click deployment to Vultr server

echo.
echo ========================================
echo    HMS India - Quick Deployment
echo ========================================
echo.

REM Check if we're in the right directory
if not exist "application" (
    echo ❌ Error: Please run this script from the project root directory
    echo    (The directory containing the 'application' folder)
    echo.
    pause
    exit /b 1
)

echo 🚀 Starting deployment to Vultr server...
echo 📍 Server: 139.84.175.208
echo.

REM Check if sshpass is available
where sshpass >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ sshpass not found. Please install it first:
    echo.
    echo For Windows:
    echo 1. Download from: https://sourceforge.net/projects/sshpass/
    echo 2. Extract sshpass.exe to C:\Windows\System32\
    echo.
    echo Or use Git Bash which includes sshpass
    echo.
    pause
    exit /b 1
)

echo 📦 Creating deployment package...

REM Create archive excluding unnecessary files
tar -czf hms_deploy.tar.gz ^
    --exclude='.git' ^
    --exclude='node_modules' ^
    --exclude='*.log' ^
    --exclude='*.tmp' ^
    --exclude='.DS_Store' ^
    --exclude='Thumbs.db' ^
    --exclude='deploy*.bat' ^
    --exclude='deploy.sh' ^
    --exclude='setup-server.sh' ^
    --exclude='backups' ^
    --exclude='staging' ^
    --exclude='phpmyadmin' ^
    --exclude='cgi-bin' ^
    --exclude='*.md' ^
    --exclude='docker-compose.yml' ^
    --exclude='Dockerfile' ^
    --exclude='composer.phar' ^
    --exclude='composer.lock' ^
    --exclude='vendor' ^
    .

if %errorlevel% neq 0 (
    echo ❌ Failed to create deployment package
    pause
    exit /b 1
)

echo ✅ Package created successfully
echo 📤 Uploading to server...

REM Upload to server
sshpass -p "bM}5rh5Q[rmyJzba" scp -o StrictHostKeyChecking=no hms_deploy.tar.gz root@139.84.175.208:/tmp/

if %errorlevel% neq 0 (
    echo ❌ Upload failed. Check your internet connection and server status
    goto :cleanup
)

echo ✅ Upload completed
echo 🔧 Extracting and setting up on server...

REM Extract and setup on server
sshpass -p "bM}5rh5Q[rmyJzba" ssh -o StrictHostKeyChecking=no root@139.84.175.208 "cd /var/www/html && tar -xzf /tmp/hms_deploy.tar.gz && rm /tmp/hms_deploy.tar.gz && chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html && chmod -R 777 /var/www/html/application/logs && chmod -R 777 /var/www/html/assets && systemctl restart apache2"

if %errorlevel% neq 0 (
    echo ❌ Server setup failed
    goto :cleanup
)

echo ✅ Server setup completed
echo 🧹 Cleaning up...

:cleanup
REM Clean up local archive
if exist hms_deploy.tar.gz del hms_deploy.tar.gz

echo.
echo ========================================
echo 🎉 DEPLOYMENT COMPLETED SUCCESSFULLY!
echo ========================================
echo.
echo 🌐 Your application is now live at:
echo    http://139.84.175.208
echo.
echo 📋 What was deployed:
echo    ✅ All application files
echo    ✅ Assets and uploads
echo    ✅ Proper permissions set
echo    ✅ Apache restarted
echo.
echo 🔐 Database credentials (if needed):
echo    Host: localhost
echo    Database: hmsindiaivf
echo    Username: hmsuser
echo    Password: hms123456
echo.
echo Press any key to exit...
pause >nul
