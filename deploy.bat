@echo off
REM HMS India Deployment Script for Windows
REM This script deploys your local code to the Vultr server

setlocal enabledelayedexpansion

REM Configuration
set SERVER_IP=139.84.175.208
set SERVER_USER=root
set SERVER_PASSWORD=bM}5rh5Q[rmyJzba
set REMOTE_PATH=/var/www/html
set LOCAL_PATH=.

echo 🚀 Starting HMS India Deployment...

REM Check if we're in the right directory
if not exist "application" (
    echo ❌ Error: application folder not found. Please run this script from the project root.
    pause
    exit /b 1
)

REM Check if rsync is available (Git Bash)
where rsync >nul 2>nul
if %errorlevel% equ 0 (
    echo 📦 Using rsync for deployment...
    goto :deploy_rsync
) else (
    echo 📦 Using SCP for deployment...
    goto :deploy_scp
)

:deploy_rsync
REM Create exclude file for rsync
echo .git/ > .rsync-exclude
echo .gitignore >> .rsync-exclude
echo node_modules/ >> .rsync-exclude
echo *.log >> .rsync-exclude
echo *.tmp >> .rsync-exclude
echo .DS_Store >> .rsync-exclude
echo Thumbs.db >> .rsync-exclude
echo deploy.sh >> .rsync-exclude
echo deploy.bat >> .rsync-exclude
echo .rsync-exclude >> .rsync-exclude
echo backups/ >> .rsync-exclude
echo staging/ >> .rsync-exclude
echo phpmyadmin/ >> .rsync-exclude
echo cgi-bin/ >> .rsync-exclude
echo *.md >> .rsync-exclude
echo docker-compose.yml >> .rsync-exclude
echo Dockerfile >> .rsync-exclude
echo composer.phar >> .rsync-exclude
echo composer.lock >> .rsync-exclude
echo vendor/ >> .rsync-exclude

REM Deploy files using rsync
rsync -avz --delete --exclude-from=.rsync-exclude -e "sshpass -p '%SERVER_PASSWORD%' ssh -o StrictHostKeyChecking=no" "%LOCAL_PATH%/" "%SERVER_USER%@%SERVER_IP%:%REMOTE_PATH%/"

if %errorlevel% equ 0 (
    echo ✅ Files synced successfully!
) else (
    echo ❌ File sync failed!
    goto :cleanup
)

REM Clean up
del .rsync-exclude
goto :post_deployment

:deploy_scp
echo 📦 Creating archive for upload...

REM Create a temporary archive (using tar if available, otherwise zip)
where tar >nul 2>nul
if %errorlevel% equ 0 (
    tar -czf hms_deploy.tar.gz --exclude='.git' --exclude='node_modules' --exclude='*.log' --exclude='*.tmp' --exclude='.DS_Store' --exclude='Thumbs.db' --exclude='deploy.sh' --exclude='deploy.bat' --exclude='backups' --exclude='staging' --exclude='phpmyadmin' --exclude='cgi-bin' --exclude='*.md' --exclude='docker-compose.yml' --exclude='Dockerfile' --exclude='composer.phar' --exclude='composer.lock' --exclude='vendor' .
) else (
    echo ❌ tar command not found. Please install Git for Windows or use WSL.
    pause
    exit /b 1
)

REM Upload archive
sshpass -p "%SERVER_PASSWORD%" scp -o StrictHostKeyChecking=no hms_deploy.tar.gz "%SERVER_USER%@%SERVER_IP%:/tmp/"

if %errorlevel% neq 0 (
    echo ❌ Upload failed!
    goto :cleanup
)

REM Extract on server
sshpass -p "%SERVER_PASSWORD%" ssh -o StrictHostKeyChecking=no "%SERVER_USER%@%SERVER_IP%" "cd /var/www/html && tar -xzf /tmp/hms_deploy.tar.gz && rm /tmp/hms_deploy.tar.gz && chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html && chmod -R 777 /var/www/html/application/logs && chmod -R 777 /var/www/html/assets"

if %errorlevel% equ 0 (
    echo ✅ Files extracted and permissions set!
) else (
    echo ❌ Server setup failed!
    goto :cleanup
)

REM Clean up local archive
del hms_deploy.tar.gz

:post_deployment
echo 🔧 Running post-deployment setup...

sshpass -p "%SERVER_PASSWORD%" ssh -o StrictHostKeyChecking=no "%SERVER_USER%@%SERVER_IP%" "systemctl restart apache2 && rm -rf /var/www/html/application/cache/* && echo '✅ Post-deployment setup completed!'"

if %errorlevel% equ 0 (
    echo 🎉 Deployment completed successfully!
    echo 🌐 Your application should be available at: http://%SERVER_IP%
) else (
    echo ❌ Post-deployment setup failed!
)

:cleanup
echo.
echo Press any key to exit...
pause >nul
