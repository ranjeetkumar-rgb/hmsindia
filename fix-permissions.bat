@echo off
echo Setting proper permissions for HMS Application...
echo.

REM Navigate to the project directory
cd /d "C:\wamp64\www\hmsindia"

echo Setting directory permissions...
icacls . /grant Everyone:(OI)(CI)F /T

echo.
echo Setting specific write permissions for upload directories...

REM Application directories
icacls "application\cache" /grant Everyone:(OI)(CI)F /T
icacls "application\logs" /grant Everyone:(OI)(CI)F /T

REM Asset directories
icacls "assets\patient_files" /grant Everyone:(OI)(CI)F /T
icacls "assets\investigation_files" /grant Everyone:(OI)(CI)F /T
icacls "assets\investigation_reports" /grant Everyone:(OI)(CI)F /T
icacls "assets\procedure_files" /grant Everyone:(OI)(CI)F /T
icacls "assets\procedure-forms-uploads" /grant Everyone:(OI)(CI)F /T
icacls "assets\package_form" /grant Everyone:(OI)(CI)F /T
icacls "assets\consent_book" /grant Everyone:(OI)(CI)F /T
icacls "assets\initial-history" /grant Everyone:(OI)(CI)F /T
icacls "assets\stock_files" /grant Everyone:(OI)(CI)F /T
icacls "assets\purchase_orders" /grant Everyone:(OI)(CI)F /T
icacls "assets\purchase_order_payments" /grant Everyone:(OI)(CI)F /T
icacls "assets\whatsapp-pdf" /grant Everyone:(OI)(CI)F /T

REM Root files
icacls "app_data.txt" /grant Everyone:F
icacls ".htaccess" /grant Everyone:F

echo.
echo Permissions set successfully!
echo.
echo Please restart your WAMP server for changes to take effect.
echo.
pause
