<?php
/**
 * Session Fix Script for Live Environment
 * Run this script to fix session issues in production
 */

// Set environment
define('ENVIRONMENT', 'production');
define('BASEPATH', __DIR__ . '/system/');
define('APPPATH', __DIR__ . '/application/');
define('FCPATH', __DIR__ . '/');

echo "=== HMS India Session Fix Script ===\n";
echo "Environment: " . ENVIRONMENT . "\n\n";

// 1. Create session directory if it doesn't exist
$session_path = APPPATH . 'cache/sessions/';
echo "1. Checking session directory: $session_path\n";

if (!is_dir($session_path)) {
    if (mkdir($session_path, 0755, true)) {
        echo "   ✓ Created session directory\n";
    } else {
        echo "   ✗ Failed to create session directory\n";
        exit(1);
    }
} else {
    echo "   ✓ Session directory exists\n";
}

// 2. Set proper permissions
if (chmod($session_path, 0755)) {
    echo "   ✓ Set directory permissions to 755\n";
} else {
    echo "   ✗ Failed to set directory permissions\n";
}

// 3. Clean old session files
echo "\n2. Cleaning old session files...\n";
$files = glob($session_path . 'ci_session*');
$cleaned = 0;
foreach ($files as $file) {
    if (is_file($file) && (time() - filemtime($file)) > 7200) { // 2 hours
        if (unlink($file)) {
            $cleaned++;
        }
    }
}
echo "   ✓ Cleaned $cleaned old session files\n";

// 4. Test session functionality
echo "\n3. Testing session functionality...\n";
session_save_path($session_path);
session_start();

// Test session write
$_SESSION['test_session'] = 'test_value_' . time();
session_write_close();

// Test session read
session_start();
if (isset($_SESSION['test_session'])) {
    echo "   ✓ Session write/read test passed\n";
    unset($_SESSION['test_session']);
} else {
    echo "   ✗ Session write/read test failed\n";
}

// 5. Check PHP session configuration
echo "\n4. PHP Session Configuration:\n";
echo "   Session save path: " . session_save_path() . "\n";
echo "   Session cookie lifetime: " . ini_get('session.cookie_lifetime') . "\n";
echo "   Session gc maxlifetime: " . ini_get('session.gc_maxlifetime') . "\n";
echo "   Session use cookies: " . ini_get('session.use_cookies') . "\n";
echo "   Session cookie secure: " . ini_get('session.cookie_secure') . "\n";

// 6. Create .htaccess for session directory
$htaccess_content = "Order Deny,Allow\nDeny from all\n";
$htaccess_file = $session_path . '.htaccess';
if (file_put_contents($htaccess_file, $htaccess_content)) {
    echo "\n5. ✓ Created .htaccess for session directory security\n";
} else {
    echo "\n5. ✗ Failed to create .htaccess file\n";
}

echo "\n=== Session Fix Complete ===\n";
echo "Please restart your web server for changes to take effect.\n";
echo "If issues persist, check:\n";
echo "- Web server has write permissions to session directory\n";
echo "- PHP session configuration in php.ini\n";
echo "- Domain and cookie settings match your live environment\n";
?>
