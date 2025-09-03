<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Configuration Status</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #007cba; padding-bottom: 20px; }
        .status-card { padding: 15px; margin: 15px 0; border-radius: 5px; border-left: 4px solid; }
        .status-success { background-color: #d4edda; border-color: #28a745; color: #155724; }
        .status-error { background-color: #f8d7da; border-color: #dc3545; color: #721c24; }
        .status-warning { background-color: #fff3cd; border-color: #ffc107; color: #856404; }
        .config-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 20px 0; }
        .config-item { padding: 10px; background: #f8f9fa; border-radius: 4px; }
        .config-label { font-weight: bold; color: #495057; }
        .config-value { color: #6c757d; margin-top: 5px; }
        .btn { display: inline-block; padding: 10px 20px; margin: 5px; text-decoration: none; border-radius: 4px; color: white; }
        .btn-primary { background-color: #007cba; }
        .btn-success { background-color: #28a745; }
        .btn-danger { background-color: #dc3545; }
        .btn:hover { opacity: 0.8; }
        .actions { text-align: center; margin: 20px 0; }
        .error-list { background: #f8d7da; padding: 15px; border-radius: 4px; margin: 10px 0; }
        .error-item { color: #721c24; margin: 5px 0; }
        .warning-list { background: #fff3cd; padding: 15px; border-radius: 4px; margin: 10px 0; }
        .warning-item { color: #856404; margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Email Configuration Status</h1>
            <p>Current Environment: <strong><?php echo strtoupper($config_summary['environment']); ?></strong></p>
        </div>

        <!-- Configuration Status -->
        <div class="status-card <?php echo $is_complete ? 'status-success' : 'status-error'; ?>">
            <h3><?php echo $is_complete ? '✅ Configuration Complete' : '❌ Configuration Incomplete'; ?></h3>
            <p><?php echo $is_complete ? 'All required email configuration parameters are set.' : 'Some required email configuration parameters are missing.'; ?></p>
        </div>

        <!-- Configuration Summary -->
        <h3>📋 Configuration Summary</h3>
        <div class="config-grid">
            <div class="config-item">
                <div class="config-label">SMTP Host</div>
                <div class="config-value"><?php echo $config_summary['host']; ?></div>
            </div>
            <div class="config-item">
                <div class="config-label">SMTP Username</div>
                <div class="config-value"><?php echo $config_summary['username']; ?></div>
            </div>
            <div class="config-item">
                <div class="config-label">SMTP Password</div>
                <div class="config-value"><?php echo $config_summary['password']; ?></div>
            </div>
            <div class="config-item">
                <div class="config-label">From Email</div>
                <div class="config-value"><?php echo $config_summary['from_email']; ?></div>
            </div>
            <div class="config-item">
                <div class="config-label">From Name</div>
                <div class="config-value"><?php echo $config_summary['from_name']; ?></div>
            </div>
            <div class="config-item">
                <div class="config-label">SMTP Port</div>
                <div class="config-value"><?php echo $config_summary['port']; ?></div>
            </div>
            <div class="config-item">
                <div class="config-label">Encryption</div>
                <div class="config-value"><?php echo $config_summary['encryption']; ?></div>
            </div>
            <div class="config-item">
                <div class="config-label">Debug Mode</div>
                <div class="config-value"><?php echo $config_summary['debug'] ? 'Enabled' : 'Disabled'; ?></div>
            </div>
        </div>

        <!-- Validation Results -->
        <?php if (!empty($validation['errors'])): ?>
        <div class="status-card status-error">
            <h3>❌ Configuration Errors</h3>
            <div class="error-list">
                <?php foreach ($validation['errors'] as $error): ?>
                    <div class="error-item">• <?php echo htmlspecialchars($error); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($validation['warnings'])): ?>
        <div class="status-card status-warning">
            <h3>⚠️ Configuration Warnings</h3>
            <div class="warning-list">
                <?php foreach ($validation['warnings'] as $warning): ?>
                    <div class="warning-item">• <?php echo htmlspecialchars($warning); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="actions">
            <a href="<?php echo base_url('email_config/test_form'); ?>" class="btn btn-primary">🧪 Test Email Configuration</a>
            <a href="<?php echo base_url('email_config/config_form'); ?>" class="btn btn-success">⚙️ Configure Email Settings</a>
            <a href="<?php echo base_url('email_config'); ?>" class="btn btn-primary">🔄 Refresh Status</a>
        </div>

        <!-- Quick Actions -->
        <div style="margin-top: 30px; padding: 20px; background: #e9ecef; border-radius: 5px;">
            <h4>🔧 Quick Actions</h4>
            <p><strong>Test Connection:</strong> <code>POST <?php echo base_url('email_config/test_connection'); ?></code></p>
            <p><strong>Send Test Email:</strong> <code>POST <?php echo base_url('email_config/send_test'); ?></code></p>
            <p><strong>Get Config:</strong> <code>GET <?php echo base_url('email_config/get_config'); ?></code></p>
            <p><strong>Validate Config:</strong> <code>GET <?php echo base_url('email_config/validate'); ?></code></p>
        </div>
    </div>

    <script>
        // Auto-refresh status every 30 seconds
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>
</body>
</html>
