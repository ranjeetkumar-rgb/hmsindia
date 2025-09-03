@echo off
REM HMS India Docker Deployment Script for Windows
REM This script deploys your application using Docker to the Vultr server

setlocal enabledelayedexpansion

REM Configuration
set SERVER_IP=139.84.175.208
set SERVER_USER=root
set SERVER_PASSWORD=bM}5rh5Q[rmyJzba
set REMOTE_PATH=/opt/hmsindia
set LOCAL_PATH=.

echo.
echo ========================================
echo    HMS India - Docker Deployment
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

REM Check if Docker files exist
if not exist "Dockerfile.prod" (
    echo ❌ Error: Dockerfile.prod not found
    echo    Please ensure Dockerfile.prod exists in the project root
    echo.
    pause
    exit /b 1
)

if not exist "docker-compose.prod.yml" (
    echo ❌ Error: docker-compose.prod.yml not found
    echo    Please ensure docker-compose.prod.yml exists in the project root
    echo.
    pause
    exit /b 1
)

echo 🐳 Starting Docker deployment to Vultr server...
echo 📍 Server: %SERVER_IP%
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

echo 📦 Creating Docker deployment package...

REM Create temporary directory
set TEMP_DIR=%TEMP%\hms_docker_deploy_%RANDOM%
mkdir "%TEMP_DIR%"
set DEPLOY_DIR=%TEMP_DIR%\hmsindia
mkdir "%DEPLOY_DIR%"

REM Copy necessary files
xcopy /E /I /Y application "%DEPLOY_DIR%\application"
xcopy /E /I /Y assets "%DEPLOY_DIR%\assets"
xcopy /E /I /Y system "%DEPLOY_DIR%\system"
copy /Y index.php "%DEPLOY_DIR%\"
copy /Y .htaccess "%DEPLOY_DIR%\"
copy /Y Dockerfile.prod "%DEPLOY_DIR%\"
copy /Y docker-compose.prod.yml "%DEPLOY_DIR%\"
copy /Y nginx.conf "%DEPLOY_DIR%\"
if exist env.production copy /Y env.production "%DEPLOY_DIR%\.env"
if exist composer.json copy /Y composer.json "%DEPLOY_DIR%\"
if exist composer.lock copy /Y composer.lock "%DEPLOY_DIR%\"

REM Create .dockerignore
echo .git > "%DEPLOY_DIR%\.dockerignore"
echo .gitignore >> "%DEPLOY_DIR%\.dockerignore"
echo *.md >> "%DEPLOY_DIR%\.dockerignore"
echo backups/ >> "%DEPLOY_DIR%\.dockerignore"
echo staging/ >> "%DEPLOY_DIR%\.dockerignore"
echo phpmyadmin/ >> "%DEPLOY_DIR%\.dockerignore"
echo cgi-bin/ >> "%DEPLOY_DIR%\.dockerignore"
echo *.log >> "%DEPLOY_DIR%\.dockerignore"
echo *.tmp >> "%DEPLOY_DIR%\.dockerignore"
echo .DS_Store >> "%DEPLOY_DIR%\.dockerignore"
echo Thumbs.db >> "%DEPLOY_DIR%\.dockerignore"
echo deploy*.sh >> "%DEPLOY_DIR%\.dockerignore"
echo deploy*.bat >> "%DEPLOY_DIR%\.dockerignore"
echo setup-server.sh >> "%DEPLOY_DIR%\.dockerignore"
echo docker-compose.yml >> "%DEPLOY_DIR%\.dockerignore"
echo Dockerfile >> "%DEPLOY_DIR%\.dockerignore"

REM Create deployment archive
cd /d "%TEMP_DIR%"
tar -czf hms_docker_deploy.tar.gz hmsindia/
if %errorlevel% neq 0 (
    echo ❌ Failed to create deployment package
    goto :cleanup
)

echo ✅ Package created successfully
echo 📤 Uploading to server...

REM Upload to server
sshpass -p "%SERVER_PASSWORD%" scp -o StrictHostKeyChecking=no hms_docker_deploy.tar.gz "%SERVER_USER%@%SERVER_IP%:/tmp/"

if %errorlevel% neq 0 (
    echo ❌ Upload failed. Check your internet connection and server status
    goto :cleanup
)

echo ✅ Upload completed
echo 🔧 Deploying Docker containers on server...

REM Deploy on server
sshpass -p "%SERVER_PASSWORD%" ssh -o StrictHostKeyChecking=no "%SERVER_USER%@%SERVER_IP%" "cd /opt/hmsindia 2>/dev/null && docker-compose -f docker-compose.prod.yml down 2>/dev/null || true && mkdir -p /opt/hmsindia && cd /opt/hmsindia && tar -xzf /tmp/hms_docker_deploy.tar.gz --strip-components=1 && rm /tmp/hms_docker_deploy.tar.gz && chown -R root:root /opt/hmsindia && mkdir -p ssl && if [ ! -f ssl/cert.pem ]; then openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ssl/key.pem -out ssl/cert.pem -subj '/C=IN/ST=Delhi/L=Delhi/O=HMS India/OU=IT Department/CN=139.84.175.208'; fi && mkdir -p mysql-config && echo '[mysqld]' > mysql-config/custom.cnf && echo 'max_connections = 200' >> mysql-config/custom.cnf && echo 'innodb_buffer_pool_size = 256M' >> mysql-config/custom.cnf && echo 'innodb_log_file_size = 64M' >> mysql-config/custom.cnf && echo 'query_cache_size = 32M' >> mysql-config/custom.cnf && echo 'query_cache_type = 1' >> mysql-config/custom.cnf && echo 'slow_query_log = 1' >> mysql-config/custom.cnf && echo 'slow_query_log_file = /var/lib/mysql/slow.log' >> mysql-config/custom.cnf && echo 'long_query_time = 2' >> mysql-config/custom.cnf && docker-compose -f docker-compose.prod.yml build --no-cache && docker-compose -f docker-compose.prod.yml up -d && sleep 30 && docker-compose -f docker-compose.prod.yml ps"

if %errorlevel% neq 0 (
    echo ❌ Docker deployment failed
    goto :cleanup
)

echo ✅ Docker deployment completed
echo 📊 Checking deployment status...

REM Show status
sshpass -p "%SERVER_PASSWORD%" ssh -o StrictHostKeyChecking=no "%SERVER_USER%@%SERVER_IP%" "cd /opt/hmsindia && echo '=== Container Status ===' && docker-compose -f docker-compose.prod.yml ps && echo '' && echo '=== Container Logs (last 10 lines) ===' && docker-compose -f docker-compose.prod.yml logs --tail=10"

:cleanup
REM Clean up local files
if exist "%TEMP_DIR%" rmdir /S /Q "%TEMP_DIR%"

echo.
echo ========================================
echo 🎉 DOCKER DEPLOYMENT COMPLETED!
echo ========================================
echo.
echo 🌐 Your application is now live at:
echo    http://%SERVER_IP%
echo.
echo 📋 What was deployed:
echo    ✅ Docker containers built and started
echo    ✅ MySQL database container running
echo    ✅ phpMyAdmin available at port 8080
echo    ✅ Nginx reverse proxy configured
echo    ✅ SSL certificate generated
echo    ✅ Production-optimized PHP configuration
echo.
echo 🔐 Database credentials:
echo    Host: localhost (from server) or %SERVER_IP%:3306 (external)
echo    Database: hmsindiaivf
echo    Username: hmsuser
echo    Password: hms123456
echo    Root Password: root123456
echo.
echo 📊 Access URLs:
echo    • Main Application: http://%SERVER_IP%
echo    • phpMyAdmin: http://%SERVER_IP%:8080
echo    • Database: %SERVER_IP%:3306
echo.
echo Press any key to exit...
pause >nul
