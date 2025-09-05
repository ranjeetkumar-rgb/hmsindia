@echo off
REM HMS India Local Development Setup Script for Windows
REM This script sets up your local development environment with traditional PHP/Apache/MySQL

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

REM Check if PHP is installed
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ PHP is not installed. Please install PHP first.
    echo Recommended: Install XAMPP, WAMP, or Laragon
    echo Visit: https://www.apachefriends.org/ (XAMPP)
    echo.
    pause
    exit /b 1
)

REM Check if MySQL is available
where mysql >nul 2>nul
if %errorlevel% neq 0 (
    echo ⚠️  MySQL command not found in PATH. Make sure MySQL is installed and running.
    echo If using XAMPP/WAMP, start MySQL from the control panel.
    echo.
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

echo 🌐 Setting up web server...

REM Check if Apache is running (for XAMPP/WAMP users)
netstat -an | findstr :80 >nul
if %errorlevel% equ 0 (
    echo ✅ Apache appears to be running on port 80
) else (
    echo ⚠️  Apache not detected on port 80. Please start your web server.
    echo If using XAMPP/WAMP, start Apache from the control panel.
    echo.
)

REM Create .htaccess for URL rewriting
if not exist ".htaccess" (
    echo 📝 Creating .htaccess file...
    echo RewriteEngine On > .htaccess
    echo RewriteCond %%{REQUEST_FILENAME} !-f >> .htaccess
    echo RewriteCond %%{REQUEST_FILENAME} !-d >> .htaccess
    echo RewriteRule ^(.*)$ index.php/$1 [L] >> .htaccess
    echo ✅ .htaccess file created
)

echo ✅ Local development environment configured!
echo ⏳ Please ensure your web server and MySQL are running...

echo.
echo ========================================
echo 🎉 LOCAL DEVELOPMENT SETUP COMPLETED!
echo ========================================
echo.
echo 🌐 Your development environment is ready:
echo    http://localhost/hmsindia
echo.
echo 📋 What was set up:
echo    ✅ Configuration files created
echo    ✅ .htaccess file for URL rewriting
echo    ✅ Environment variables configured
echo    ✅ Application ready for development
echo.
echo 🔐 Database credentials (Local Development):
echo    Host: localhost:3306
echo    Database: hmsindiaivf
echo    Username: root
echo    Password: (empty or your local MySQL password)
echo.
echo 📊 Access URLs:
echo    • Main Application: http://localhost/hmsindia
echo    • phpMyAdmin: http://localhost/phpmyadmin (if using XAMPP/WAMP)
echo    • Database: localhost:3306
echo.
echo 💡 Next Steps:
echo    1. Start your web server (Apache) and MySQL
echo    2. Create the database 'hmsindiaivf' in MySQL
echo    3. Import your database if needed
echo    4. Access your application at http://localhost/hmsindia
echo.
echo 📝 Manual Database Setup:
echo    1. Open phpMyAdmin or MySQL command line
echo    2. Create database: CREATE DATABASE hmsindiaivf;
echo    3. Import your SQL file if you have one
echo.
echo Press any key to exit...
pause >nul
