 <?php $all_method =&get_instance(); ?>
 	<div class="container-2">
        <header>
            <div class="header-top">
                <div class="logo"><i class="fas fa-hospital"></i> Medical Revenue Dashboard</div>
                <div class="date-display"><i class="fas fa-calendar-alt"></i> September 1, 2025</div>
            </div>
            <h1>Centre Noida Revenue Report</h1>
            <div class="filters">
                <div class="filter-item">
                    <label for="center-select">Center</label>
                    <select id="center-select">
                        <option>Noida</option>
                        <option>Delhi</option>
                        <option>Gurgaon</option>
                    </select>
                </div>
                <div class="filter-item">
                    <label for="date-select">Date</label>
                    <input type="date" id="date-select" value="2025-09-01">
                </div>
                <div class="filter-item">
                    <label for="report-type">Report Type</label>
                    <select id="report-type">
                        <option>Daily Report</option>
                        <option>Monthly Report</option>
                    </select>
                </div>
            </div>
        </header>
        
        <div class="dashboard">
            <div class="card">
                <div class="card-header">
                    <span>Orderbook Summary</span>
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-content">
                    <div class="summary-stats">
                        <div class="stat">
                            <div class="stat-label">Customer Count</div>
                            <div class="stat-value">3</div>
                        </div>
                        <div class="stat">
                            <div class="stat-label">Bill Count / Cycles Sold</div>
                            <div class="stat-value">4</div>
                        </div>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Type of procedures</th>
                                <th>Customer Count</th>
                                <th>Bill Count</th>
                                <th>Amount (Rs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>IVF Cycles Sold</td>
                                <td></td>
                                <td></td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>IVF with Bed</td>
                                <td></td>
                                <td></td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>Non IVF with Bed</td>
                                <td></td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>Non IVF without Bed</td>
                                <td></td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>(Not Tagged)</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                           <?php 
            $procedure_net = 0;
            $procedure_receive = 0;
            $procedure_total = 0;
            $procedure_discount = 0;
            foreach($procedure_daily_result as $ky => $vl){
                $procedure_net += round($vl['total_patients'],2);
                $procedure_receive += round($vl['payment_done'],2);
                $procedure_total += round($vl['fees'],2);
                $procedure_discount += round($vl['discount_amount'],2);
            ?>
                    <tr class="sub-header">
                        <td>A. Package Revenue Total</td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                        <td><?php echo round($vl['total_fees'],2); ?></td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                    </tr>
					<?php } ?>
                			 <?php 
            $medicine_net = 0;
            $medicine_receive = 0;
            $medicine_total = 0;
            $medicine_discount = 0;
            foreach($medicine_daily_result as $ky => $vl){
                $medicine_net += round($vl['total_patients'],2);
                $medicine_receive += round($vl['payment_done'],2);
                $medicine_total += round($vl['fees'],2);
                $medicine_discount += round($vl['discount_amount'],2);
            ?>
                    <tr>
                        <td>Medicine</td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                        <td><?php echo round($vl['total_payment'],2); ?></td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                    </tr>
					<?php } ?>
							<?php 
            $investigations_net = 0;
            $investigations_receive = 0;
            $investigations_total = 0;
            $investigations_discount = 0;
            foreach($investigations_daily_result as $ky => $vl){
                $investigations_net += round($vl['total_patients'],2);
                $investigations_receive += round($vl['payment_done'],2);
                $investigations_total += round($vl['fees'],2);
                $investigations_discount += round($vl['discount_amount'],2);
            ?>
                    <tr>
                        <td>Diagnosis</td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                        <td><?php echo round($vl['total_payment'],2); ?></td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                    </tr>
					<?php } ?>
                           <?php 
            $consultation_net = 0;
            $consultation_receive = 0;
            $consultation_total = 0;
            $consultation_discount = 0;
			$registration_payment = 0 ;
			foreach($registration_daily_result as $ky => $vl){
            	$registration_payment = round($vl['total_payment'],2);
            } 
            foreach($consultation_daily_result as $ky => $vl){
                $consultation_net += round($vl['total_patients'],2);
                $consultation_receive += round($vl['payment_done'],2);
                $consultation_total += round($vl['fees'],2);
                $consultation_discount += round($vl['discount_amount'],2);
            ?>
                    <tr>
                        <td>Consultation / Registration - Paid</td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                        <td><?php echo round($vl['total_payment'],2) + $registration_payment; ?></td>
                        <td><?php echo round($vl['total_patients'],2); ?></td>
                    </tr>
					<?php } ?>
                            <tr>
                                <td>Fellowship</td>
                                <td></td>
                                <td></td>
                                <td class="numeric"></td>
                            </tr>
                            <tr class="total-row">
                                <td>Total Revenue</td>
                                <td></td>
                                <td></td>
                                <td class="numeric"></td>
                            </tr>
							<tr class="total-row">
                                <td>Status</td>
                                <td></td>
                                <td colspan="2">
								<div class="approver-item" style="margin-bottom: 8px; padding: 6px; border-radius: 4px; border-left: 3px solid #ffc107; background-color: #f8f9fa;"><div style="display: flex; align-items: center; margin-bottom: 4px;"><span class="status-icon" style="color: #ffc107; font-weight: bold;">⏳</span><span class="status-text" style="color: #333;">Pending</span></div><div class="approver-email">ranjeetmaurya2033@gmail.com</div></div>
								<div class="approver-item" style="margin-bottom: 8px; padding: 6px; border-radius: 4px; border-left: 3px solid #ffc107; background-color: #f8f9fa;"><div style="display: flex; align-items: center; margin-bottom: 4px;"><span class="status-icon" style="color: #ffc107; font-weight: bold;">⏳</span><span class="status-text" style="color: #333;">Pending</span></div><div class="approver-email">ranjeetmaurya2033@gmail.com</div></div>
								</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <span>Collection Summary</span>
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="card-content">
                    <div class="summary-stats">
                        <div class="stat">
                            <div class="stat-label">Customer Count</div>
                            <div class="stat-value">0</div>
                        </div>
                        <div class="stat">
                            <div class="stat-label">Bill Count</div>
                            <div class="stat-value">0</div>
                        </div>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Type of procedures</th>
                                <th>Customer Count</th>
                                <th>Bill Count</th>
                                <th>Amount (Rs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>IVF Cycles Sold</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>IVF with Bed</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>Non IVF with Bed</td>
                                <td></td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>Non IVF without Bed</td>
                                <td></td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>(Not Tagged)</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>A. Package Revenue</td>
                                <td></td>
                                <td></td>
                                <td class="numeric">0</td>
                            </tr>
                            <tr>
                                <td>Medicine</td>
                                <td></td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>Diagnostic</td>
                                <td></td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>Consultation / Registration - Paid</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                            <tr>
                                <td>Fellowship</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="numeric">-</td>
                            </tr>
                           <tr class="total-row">
                                <td>Total Revenue</td>
                                <td></td>
                                <td></td>
                                <td class="numeric"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple JavaScript to update the date display when the date input is changed
        document.getElementById('date-select').addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.querySelector('.date-display').innerHTML = 
                '<i class="fas fa-calendar-alt"></i> ' + selectedDate.toLocaleDateString('en-US', options);
        });
    </script>
	 <style>
        header {
            background: linear-gradient(135deg, #2c3e50, #1a2530);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            color: #4CAF50;
        }
        
        .date-display {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .filters {
            display: flex;
            gap: 15px;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
        
        .filter-item {
            flex: 1;
        }
        
        .filter-item label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            opacity: 0.8;
        }
        
        .filter-item select, .filter-item input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: white;
            color: #333;
        }
        
        .dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header i {
            font-size: 20px;
        }
        
        .card-content {
            padding: 20px;
        }
        
        .summary-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin: 10px 0;
        }
        
        .stat-label {
            font-size: 14px;
            color: #7f8c8d;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        th {
            background-color: #f1f5f9;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #e9ecef;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        tr:hover {
            background-color: #f8f9fa;
        }
        
        .numeric {
            text-align: right;
            font-family: 'Courier New', monospace;
            font-weight: 500;
        }
        
        .positive {
            color: #2E7D32;
        }
        
        .section-header {
            background-color: #e3f2fd;
            font-weight: 600;
        }
        
        .total-row {
            font-weight: 700;
            background-color: #f1f8e9;
        }
        
        .chart-container {
            height: 250px;
            padding: 15px 0;
        }
        
        @media (max-width: 900px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .filters {
                flex-direction: column;
            }
        }
    </style>