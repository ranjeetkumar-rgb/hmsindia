@echo off
REM Fix sessions directory issue
REM This script creates the sessions directory and restarts containers

echo.
echo ========================================
echo    HMS India - Fix Sessions Directory
echo ========================================
echo.

echo 🔧 Creating sessions directory...

REM Create sessions directory locally
if not exist "application\cache\sessions" (
    mkdir "application\cache\sessions"
    echo ✅ Created local sessions directory
) else (
    echo ⚠️  Sessions directory already exists locally
)

echo 🔄 Restarting Docker containers...

REM Stop containers
docker-compose down

REM Start containers
docker-compose up -d --build

if %errorlevel% equ 0 (
    echo ✅ Containers restarted successfully!
    echo.
    echo 🔧 Creating sessions directory in container...
    
    REM Create sessions directory in container
    docker exec hmsindia_web mkdir -p /var/www/html/application/cache/sessions
    docker exec hmsindia_web chmod -R 777 /var/www/html/application/cache
    
    echo ✅ Sessions directory created in container
    echo.
    echo 🌐 Your application is now available at:
    echo    http://localhost:8080
    echo.
    echo 📊 The sessions error should now be fixed!
    echo.
) else (
    echo ❌ Failed to restart containers
    echo Check the logs: docker-compose logs
)

echo.
echo Press any key to exit...
pause >nul
