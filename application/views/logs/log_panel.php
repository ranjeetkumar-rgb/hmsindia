    <div class="col-md-12">
      <!-- Log Panel Header -->
      <div class="card">
        <div class="card-action clearfix">
          <h3 class="pull-left"><i class="fa fa-list-alt"></i> System Logs</h3>
          <div class="pull-right">
            <button class="btn btn-primary btn-refresh" onclick="refreshLogs()">
              <i class="fa fa-refresh"></i> Refresh
            </button>
            <button class="btn btn-success" onclick="downloadLogs()">
              <i class="fa fa-download"></i> Download
            </button>
            <button class="btn btn-danger" onclick="clearLogs()">
              <i class="fa fa-trash"></i> Clear
            </button>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="card-content">
          <p class="text-muted">Monitor and analyze application logs</p>
        </div>
      </div>

      <!-- Filters -->
      <div class="card">
        <div class="card-action">
          <h4>Filters</h4>
        </div>
        <div class="card-content">
          <form id="logFilters" method="GET">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="date">Date:</label>
                  <select name="date" id="date" class="form-control" onchange="applyFilters()">
                    <?php foreach($available_dates as $date): ?>
                      <option value="<?php echo $date; ?>" <?php echo $date == $date_filter ? 'selected' : ''; ?>>
                        <?php echo date('M d, Y', strtotime($date)); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="level">Log Level:</label>
                  <select name="level" id="level" class="form-control" onchange="applyFilters()">
                    <?php foreach($log_levels as $value => $label): ?>
                      <option value="<?php echo $value; ?>" <?php echo $value == $level_filter ? 'selected' : ''; ?>>
                        <?php echo $label; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="search">Search:</label>
                  <div class="log-search" style="position: relative;">
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="Search in log messages..." value="<?php echo htmlspecialchars($search_term); ?>"
                           onkeyup="debounceSearch()">
                    <i class="fa fa-search" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div>
                    <button type="button" class="btn btn-default" onclick="clearFilters()">
                      <i class="fa fa-times"></i> Clear
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Log Content -->
      <div class="card">
        <div class="card-action">
          <h4>Log Entries</h4>
        </div>
        <div class="card-content">
          <!-- Stats -->
          <div class="log-stats" style="background: #f5f5f5; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
            <div class="stat-item" style="display: inline-block; margin-right: 20px; font-size: 14px;">
              Total Logs: <span class="stat-value" id="totalLogs" style="font-weight: bold; color: #337ab7;"><?php echo $total_logs; ?></span>
            </div>
            <div class="stat-item" style="display: inline-block; margin-right: 20px; font-size: 14px;">
              Errors: <span class="stat-value" id="errorCount" style="font-weight: bold; color: #d9534f;">-</span>
            </div>
            <div class="stat-item" style="display: inline-block; margin-right: 20px; font-size: 14px;">
              Debug: <span class="stat-value" id="debugCount" style="font-weight: bold; color: #5bc0de;">-</span>
            </div>
            <div class="stat-item" style="display: inline-block; margin-right: 20px; font-size: 14px;">
              Info: <span class="stat-value" id="infoCount" style="font-weight: bold; color: #5cb85c;">-</span>
            </div>
            <div class="stat-item" style="display: inline-block; margin-right: 20px; font-size: 14px;">
              File Size: <span class="stat-value" id="fileSize" style="font-weight: bold; color: #337ab7;">-</span>
            </div>
            <div class="stat-item auto-refresh" style="display: inline-block; margin-left: 20px;">
              <label>
                <input type="checkbox" id="autoRefresh" onchange="toggleAutoRefresh()"> Auto Refresh (30s)
              </label>
            </div>
          </div>

          <!-- Log Entries -->
          <div id="logEntries" style="max-height: 600px; overflow-y: auto; border: 1px solid #ddd;">
            <?php if(empty($logs)): ?>
              <div class="no-logs" style="padding: 40px; text-align: center; color: #999;">
                <i class="fa fa-info-circle fa-3x" style="margin-bottom: 15px;"></i>
                <h4>No logs found</h4>
                <p>No log entries match your current filters.</p>
              </div>
            <?php else: ?>
              <?php foreach($logs as $log): ?>
                <div class="log-entry" style="padding: 12px 15px; border-bottom: 1px solid #eee; font-family: 'Courier New', monospace; font-size: 13px; line-height: 1.4;">
                  <span class="log-level <?php echo $log['level']; ?>" style="display: inline-block; padding: 2px 8px; border-radius: 3px; font-weight: bold; font-size: 11px; text-transform: uppercase; margin-right: 10px; color: white; background: <?php echo $log['level'] == 'ERROR' ? '#d9534f' : ($log['level'] == 'DEBUG' ? '#5bc0de' : '#5cb85c'); ?>"><?php echo $log['level']; ?></span>
                  <span class="log-timestamp" style="color: #999; margin-right: 15px;"><?php echo $log['timestamp']; ?></span>
                  <span class="log-message" style="color: #333;"><?php echo htmlspecialchars($log['message']); ?></span>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <!-- Pagination -->
          <?php if($total_pages > 1): ?>
            <div class="pagination-wrapper" style="padding: 20px; text-align: center; background: #f9f9f9; margin-top: 20px;">
              <nav>
                <ul class="pagination" style="display: inline-block; margin: 0;">
                  <?php if($current_page > 1): ?>
                    <li>
                      <a href="#" onclick="changePage(<?php echo $current_page - 1; ?>)" style="padding: 8px 12px; margin: 0 2px; border: 1px solid #ddd; text-decoration: none; color: #337ab7;">
                        <i class="fa fa-chevron-left"></i> Previous
                      </a>
                    </li>
                  <?php endif; ?>
                  
                  <?php for($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++): ?>
                    <li>
                      <a href="#" onclick="changePage(<?php echo $i; ?>)" style="padding: 8px 12px; margin: 0 2px; border: 1px solid #ddd; text-decoration: none; color: #337ab7; background: <?php echo $i == $current_page ? '#337ab7' : 'white'; ?>; color: <?php echo $i == $current_page ? 'white' : '#337ab7'; ?>"><?php echo $i; ?></a>
                    </li>
                  <?php endfor; ?>
                  
                  <?php if($current_page < $total_pages): ?>
                    <li>
                      <a href="#" onclick="changePage(<?php echo $current_page + 1; ?>)" style="padding: 8px 12px; margin: 0 2px; border: 1px solid #ddd; text-decoration: none; color: #337ab7;">
                        Next <i class="fa fa-chevron-right"></i>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>
              <p class="text-muted" style="margin-top: 10px;">
                Showing page <?php echo $current_page; ?> of <?php echo $total_pages; ?> 
                (<?php echo $total_logs; ?> total logs)
              </p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <style>
      .log-entry:hover {
        background: #f8f9fa;
      }
      .log-entry:last-child {
        border-bottom: none;
      }
      .loading {
        text-align: center;
        padding: 40px;
        color: #999;
      }
    </style>
    <script>
        let autoRefreshInterval;
        let searchTimeout;

        // Auto refresh functionality
        function toggleAutoRefresh() {
            const checkbox = document.getElementById('autoRefresh');
            if (checkbox.checked) {
                autoRefreshInterval = setInterval(refreshLogs, 30000); // 30 seconds
            } else {
                clearInterval(autoRefreshInterval);
            }
        }

        // Debounced search
        function debounceSearch() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 500);
        }

        // Apply filters
        function applyFilters() {
            const form = document.getElementById('logFilters');
            
            // Show loading
            document.getElementById('logEntries').innerHTML = '<div class="loading"><i class="fa fa-spinner fa-spin"></i> Loading logs...</div>';
            
            // Make AJAX request using jQuery (system default)
            $.ajax({
                url: '<?php echo base_url(); ?>logs/ajax',
                type: 'GET',
                data: {
                    date: document.getElementById('date').value,
                    level: document.getElementById('level').value,
                    search: document.getElementById('search').value
                },
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        displayLogs(data.logs);
                        updatePagination(data.current_page, data.total_pages, data.total);
                    } else {
                        document.getElementById('logEntries').innerHTML = '<div class="no-logs" style="padding: 40px; text-align: center; color: #999;"><i class="fa fa-exclamation-triangle"></i> Error loading logs</div>';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    document.getElementById('logEntries').innerHTML = '<div class="no-logs" style="padding: 40px; text-align: center; color: #999;"><i class="fa fa-exclamation-triangle"></i> Error loading logs: ' + xhr.responseText + '</div>';
                }
            });
        }

        // Display logs
        function displayLogs(logs) {
            const container = document.getElementById('logEntries');
            
            if (logs.length === 0) {
                container.innerHTML = '<div class="no-logs" style="padding: 40px; text-align: center; color: #999;"><i class="fa fa-info-circle fa-3x" style="margin-bottom: 15px;"></i><h4>No logs found</h4><p>No log entries match your current filters.</p></div>';
                return;
            }
            
            let html = '';
            logs.forEach(log => {
                const levelColor = log.level === 'ERROR' ? '#d9534f' : (log.level === 'DEBUG' ? '#5bc0de' : '#5cb85c');
                html += `
                    <div class="log-entry" style="padding: 12px 15px; border-bottom: 1px solid #eee; font-family: 'Courier New', monospace; font-size: 13px; line-height: 1.4;">
                        <span class="log-level" style="display: inline-block; padding: 2px 8px; border-radius: 3px; font-weight: bold; font-size: 11px; text-transform: uppercase; margin-right: 10px; color: white; background: ${levelColor}">${log.level}</span>
                        <span class="log-timestamp" style="color: #999; margin-right: 15px;">${log.timestamp}</span>
                        <span class="log-message" style="color: #333;">${escapeHtml(log.message)}</span>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }

        // Update pagination
        function updatePagination(currentPage, totalPages, totalLogs) {
            // Update pagination UI here if needed
            document.getElementById('totalLogs').textContent = totalLogs;
        }

        // Change page
        function changePage(page) {
            // Show loading
            document.getElementById('logEntries').innerHTML = '<div class="loading"><i class="fa fa-spinner fa-spin"></i> Loading logs...</div>';
            
            $.ajax({
                url: '<?php echo base_url(); ?>logs/ajax',
                type: 'GET',
                data: {
                    date: document.getElementById('date').value,
                    level: document.getElementById('level').value,
                    search: document.getElementById('search').value,
                    page: page
                },
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        displayLogs(data.logs);
                        updatePagination(data.current_page, data.total_pages, data.total);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    document.getElementById('logEntries').innerHTML = '<div class="no-logs" style="padding: 40px; text-align: center; color: #999;"><i class="fa fa-exclamation-triangle"></i> Error loading logs: ' + xhr.responseText + '</div>';
                }
            });
        }

        // Refresh logs
        function refreshLogs() {
            applyFilters();
            loadStats();
        }

        // Load statistics
        function loadStats() {
            const date = document.getElementById('date').value;
            const level = document.getElementById('level').value;
            const search = document.getElementById('search').value;
            
            $.ajax({
                url: '<?php echo base_url(); ?>logs/stats',
                type: 'GET',
                data: {
                    date: date,
                    level: level,
                    search: search
                },
                dataType: 'json',
                success: function(data) {
                    document.getElementById('errorCount').textContent = data.error_count || 0;
                    document.getElementById('debugCount').textContent = data.debug_count || 0;
                    document.getElementById('infoCount').textContent = data.info_count || 0;
                    document.getElementById('fileSize').textContent = formatFileSize(data.file_size || 0);
                }
            });
        }

        // Download logs
        function downloadLogs() {
            const form = document.getElementById('logFilters');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            
            window.open(`<?php echo base_url(); ?>logs/download?${params}`, '_blank');
        }

        // Clear logs
        function clearLogs() {
            if (confirm('Are you sure you want to clear the logs for the selected date? This action cannot be undone.')) {
                const form = document.getElementById('logFilters');
                const formData = new FormData(form);
                formData.append('date', document.getElementById('date').value);
                
                $.ajax({
                    url: '<?php echo base_url(); ?>logs/clear',
                    type: 'GET',
                    data: {
                        date: document.getElementById('date').value
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            alert('Logs cleared successfully');
                            refreshLogs();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText);
                        alert('Error clearing logs: ' + xhr.responseText);
                    }
                });
            }
        }

        // Clear filters
        function clearFilters() {
            document.getElementById('date').value = '<?php echo date('Y-m-d'); ?>';
            document.getElementById('level').value = 'all';
            document.getElementById('search').value = '';
            applyFilters();
        }

        // Utility functions
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Initialize
        $(document).ready(function() {
            loadStats();
        });
    </script>
