@echo off
echo ========================================
echo HMS India IVF - Database Import Script
echo ========================================
echo.

echo Step 1: Export from WAMP phpMyAdmin
echo ----------------------------------------
echo 1. Open http://localhost/phpmyadmin
echo 2. Select your hmsindiaivf database
echo 3. Go to Export tab
echo 4. Choose Quick export, SQL format
echo 5. Download the SQL file
echo 6. Save it as "hmsindiaivf_backup.sql" in this folder
echo.
pause

echo.
echo Step 2: Import to Docker Database
echo ----------------------------------------
echo Importing database to Docker...

if exist "hmsindiaivf_backup.sql" (
    echo File found! Importing...
    docker exec -i hmsindia_db mysql -u root hmsindiaivf < hmsindiaivf_backup.sql
    echo.
    echo ✅ Database imported successfully!
    echo.
    echo You can now access your application at:
    echo 🌐 Web App: http://localhost:8080
    echo 🗄️ WAMP phpMyAdmin: http://localhost/phpmyadmin
    echo.
) else (
    echo ❌ hmsindiaivf_backup.sql file not found!
    echo Please export your database from WAMP phpMyAdmin first.
)

echo.
echo Press any key to exit...
pause > nul
