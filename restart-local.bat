@echo off
REM Quick restart script for local development
REM This will restart your Docker containers with updated configuration

echo.
echo ========================================
echo    HMS India - Restart Local Development
echo ========================================
echo.

echo 🔄 Restarting Docker containers...

REM Stop containers
docker-compose down

REM Start containers
docker-compose up -d

if %errorlevel% equ 0 (
    echo ✅ Containers restarted successfully!
    echo.
    echo 🌐 Your application is now available at:
    echo    http://localhost:8080
    echo.
    echo 📊 Access URLs:
    echo    • Main Application: http://localhost:8080
    echo    • phpMyAdmin: http://localhost:8081
    echo    • Database: localhost:3307
    echo.
    echo 🔐 Database credentials:
    echo    Host: localhost:3307 (external) or db:3306 (from container)
    echo    Database: hmsindiaivf_dev
    echo    Username: root
    echo    Password: (empty)
    echo.
) else (
    echo ❌ Failed to restart containers
    echo Check the logs: docker-compose logs
)

echo.
echo Press any key to exit...
pause >nul
