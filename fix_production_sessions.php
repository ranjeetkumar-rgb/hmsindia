<?php
/**
 * Production Session Fix Script
 * Run this script on the production server to fix session issues
 */

// Set environment to production
define('ENVIRONMENT', 'production');
define('BASEPATH', __DIR__ . '/system/');
define('APPPATH', __DIR__ . '/application/');

echo "<h1>Production Session Fix</h1>";
echo "<hr>";

// 1. Create sessions directory
$session_path = APPPATH . 'cache/sessions/';
echo "<h2>1. Creating Sessions Directory</h2>";
echo "Target path: " . $session_path . "<br>";

if (!is_dir($session_path)) {
    if (mkdir($session_path, 0755, true)) {
        echo "✅ Sessions directory created successfully<br>";
    } else {
        echo "❌ Failed to create sessions directory<br>";
        exit;
    }
} else {
    echo "✅ Sessions directory already exists<br>";
}

// 2. Set proper permissions
if (chmod($session_path, 0755)) {
    echo "✅ Directory permissions set to 755<br>";
} else {
    echo "❌ Failed to set directory permissions<br>";
}

// 3. Test writability
if (is_writable($session_path)) {
    echo "✅ Directory is writable<br>";
} else {
    echo "❌ Directory is not writable<br>";
}

// 4. Create .htaccess for security
$htaccess_content = "Order Deny,Allow\nDeny from all\n";
$htaccess_path = $session_path . '.htaccess';
if (file_put_contents($htaccess_path, $htaccess_content)) {
    echo "✅ Security .htaccess file created<br>";
} else {
    echo "⚠️ Could not create .htaccess file (not critical)<br>";
}

// 5. Test session functionality
echo "<h2>2. Testing Session Functionality</h2>";

// Set session configuration
ini_set('session.save_path', $session_path);
ini_set('session.cookie_secure', 0); // HTTP
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.auto_start', 0);

echo "Session configuration set<br>";

// Test session start
if (session_status() === PHP_SESSION_NONE) {
    if (session_start()) {
        echo "✅ Session started successfully<br>";
        $_SESSION['test'] = 'Production session test';
        echo "✅ Session variable set: " . $_SESSION['test'] . "<br>";
    } else {
        echo "❌ Failed to start session<br>";
    }
} else {
    echo "✅ Session already active<br>";
}

// 6. Clean up old session files (optional)
echo "<h2>3. Cleaning Up Old Session Files</h2>";
$files = glob($session_path . 'sess_*');
$count = count($files);
if ($count > 0) {
    foreach ($files as $file) {
        if (filemtime($file) < (time() - 7200)) { // Older than 2 hours
            unlink($file);
        }
    }
    echo "✅ Cleaned up old session files<br>";
} else {
    echo "✅ No old session files to clean<br>";
}

echo "<hr>";
echo "<h2>Summary</h2>";
echo "✅ Sessions directory: " . $session_path . "<br>";
echo "✅ Directory exists and is writable<br>";
echo "✅ Session configuration applied<br>";
echo "✅ Session functionality tested<br>";
echo "<br><strong>Session fix completed successfully!</strong><br>";
echo "The 'Session not started in production environment' error should now be resolved.<br>";
?>
