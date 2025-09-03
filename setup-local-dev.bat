@echo off
REM HMS India Local Development Setup Script for Windows
REM This script sets up your local development environment with Docker

echo.
echo ========================================
echo    HMS India - Local Development Setup
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

echo 🚀 Setting up local development environment...

REM Check if Docker is installed
where docker >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ Docker is not installed. Please install Docker first.
    echo Visit: https://docs.docker.com/get-docker/
    echo.
    pause
    exit /b 1
)

REM Check if Docker Compose is installed
where docker-compose >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ Docker Compose is not installed. Please install Docker Compose first.
    echo Visit: https://docs.docker.com/compose/install/
    echo.
    pause
    exit /b 1
)

echo 📋 Setting up configuration files...

REM Create database configuration if it doesn't exist
if not exist "application\config\database.php" (
    echo 📝 Creating database configuration...
    copy "application\config\database.php.example" "application\config\database.php"
    echo ✅ Database configuration created
) else (
    echo ⚠️  Database configuration already exists
)

REM Create application configuration if it doesn't exist
if not exist "application\config\config.php" (
    echo 📝 Creating application configuration...
    copy "application\config\config.php.example" "application\config\config.php"
    echo ✅ Application configuration created
) else (
    echo ⚠️  Application configuration already exists
)

REM Create .env file for local development
if not exist ".env" (
    echo 📝 Creating environment file...
    copy "env.local" ".env"
    echo ✅ Environment file created
) else (
    echo ⚠️  Environment file already exists
)

echo 🐳 Building and starting Docker containers...

REM Stop any existing containers
docker-compose down 2>nul

REM Build and start containers
docker-compose up -d --build

if %errorlevel% neq 0 (
    echo ❌ Failed to start Docker containers
    pause
    exit /b 1
)

echo ✅ Docker containers started successfully!
echo ⏳ Waiting for services to be ready...
timeout /t 30 /nobreak >nul

echo 📊 Checking container status...
docker-compose ps

echo.
echo ========================================
echo 🎉 LOCAL DEVELOPMENT SETUP COMPLETED!
echo ========================================
echo.
echo 🌐 Your development environment is ready:
echo    http://localhost:8080
echo.
echo 📋 What was set up:
echo    ✅ Docker containers built and started
echo    ✅ MySQL database container running (development database)
echo    ✅ phpMyAdmin available for database management
echo    ✅ Application configured for development
echo.
echo 🔐 Database credentials (Local Development):
echo    Host: localhost:3307 (external) or db:3306 (from container)
echo    Database: hmsindiaivf_dev
echo    Username: root
echo    Password: (empty)
echo.
echo 📊 Access URLs:
echo    • Main Application: http://localhost:8080
echo    • phpMyAdmin: http://localhost:8081
echo    • Database: localhost:3307
echo.
echo 💡 Useful Commands:
echo    • View logs: docker-compose logs
echo    • Stop containers: docker-compose down
echo    • Restart containers: docker-compose restart
echo    • Access database: docker exec -it hmsindia_db mysql -u root -p
echo    • Access application container: docker exec -it hmsindia_web bash
echo.
echo 📝 Next Steps:
echo    1. Import your development database if needed
echo    2. Start developing your application
echo    3. Use 'docker-compose down' to stop when done
echo    4. Use 'docker-compose up -d' to start again
echo.
echo Press any key to exit...
pause >nul
