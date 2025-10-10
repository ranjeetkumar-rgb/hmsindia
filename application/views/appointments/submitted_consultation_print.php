<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Consultation Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }
        
        .print-header {
            text-align: center;
            border-bottom: 3px solid #28a745;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .print-header h1 {
            margin: 0;
            color: #28a745;
            font-size: 32px;
            font-weight: bold;
        }
        
        .print-header h2 {
            margin: 8px 0 0 0;
            color: #666;
            font-size: 18px;
            font-weight: normal;
        }
        
        .consultation-date {
            background-color: #e8f5e8;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
            color: #155724;
        }
        
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        
        .section-title {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 15px 20px;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .field-row {
            display: flex;
            margin-bottom: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .field-row:last-child {
            border-bottom: none;
        }
        
        .field-label {
            font-weight: bold;
            width: 220px;
            flex-shrink: 0;
            color: #495057;
            font-size: 14px;
        }
        
        .field-value {
            flex: 1;
            color: #212529;
            font-size: 14px;
        }
        
        .medicine-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .medicine-table th {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 13px;
        }
        
        .medicine-table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        
        .medicine-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .medicine-table tr:hover {
            background-color: #e3f2fd;
        }
        
        .list-items {
            margin: 10px 0;
            padding-left: 25px;
        }
        
        .list-items li {
            margin-bottom: 8px;
            color: #333;
            position: relative;
        }
        
        .list-items li:before {
            content: "•";
            color: #28a745;
            font-weight: bold;
            position: absolute;
            left: -20px;
        }
        
        .follow-up-info {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #ffc107;
            padding: 20px;
            border-radius: 10px;
            margin-top: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .follow-up-info .field-row {
            border-bottom: 1px solid #ffc107;
        }
        
        .no-data {
            color: #6c757d;
            font-style: italic;
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border: 1px dashed #dee2e6;
        }
        
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 2px solid #dee2e6;
            padding-top: 20px;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        .consultation-id {
            background-color: #e9ecef;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            font-weight: bold;
            color: #495057;
            margin-bottom: 10px;
        }
        
        @media print {
            body { 
                margin: 0; 
                padding: 15px;
            }
            .section { 
                page-break-inside: avoid; 
            }
            .medicine-table { 
                page-break-inside: auto; 
            }
            .print-header {
                page-break-after: avoid;
            }
        }
        
        @page {
            margin: 1.5cm;
            size: A4;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-completed {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="print-header">
        <h1>Consultation Report</h1>
        <h2>Hospital Management System</h2>
        <div class="consultation-id">Consultation ID: <?php echo isset($appointments['ID']) ? $appointments['ID'] : 'N/A'; ?></div>
        <div class="status-badge status-completed">Consultation Completed</div>
    </div>
    
    <div class="consultation-date">
        Consultation Date: <?php echo isset($consultation_data['consultation_date']) ? date("d-m-Y H:i:s", strtotime($consultation_data['consultation_date'])) : date("d-m-Y H:i:s"); ?>
    </div>
    
    <!-- Patient Information -->
    <div class="section">
        <div class="section-title">👤 Patient Information</div>
        <div class="field-row">
            <div class="field-label">Patient Name:</div>
            <div class="field-value"><?php echo isset($patient_data['wife_name']) ? htmlspecialchars($patient_data['wife_name']) : 'N/A'; ?></div>
        </div>
        <div class="field-row">
            <div class="field-label">Phone Number:</div>
            <div class="field-value"><?php echo isset($patient_data['wife_phone']) ? htmlspecialchars($patient_data['wife_phone']) : 'N/A'; ?></div>
        </div>
        <div class="field-row">
            <div class="field-label">Email Address:</div>
            <div class="field-value"><?php echo isset($patient_data['wife_email']) ? htmlspecialchars($patient_data['wife_email']) : 'N/A'; ?></div>
        </div>
        <div class="field-row">
            <div class="field-label">Doctor:</div>
            <div class="field-value"><?php echo isset($appointments['doctor_name']) ? htmlspecialchars($appointments['doctor_name']) : 'N/A'; ?></div>
        </div>
        <div class="field-row">
            <div class="field-label">Appointment Date:</div>
            <div class="field-value"><?php echo isset($appointments['appoitmented_date']) ? date("d-m-Y", strtotime($appointments['appoitmented_date'])) : 'N/A'; ?></div>
        </div>
        <div class="field-row">
            <div class="field-label">Center:</div>
            <div class="field-value"><?php echo isset($appointments['center_name']) ? htmlspecialchars($appointments['center_name']) : 'N/A'; ?></div>
        </div>
    </div>
    
    <!-- Clinical Findings -->
    <div class="section">
        <div class="section-title">🔍 Clinical Findings</div>
        <div class="field-row">
            <div class="field-label">Female Findings:</div>
            <div class="field-value"><?php echo isset($consultation_data['female_findings']) && !empty($consultation_data['female_findings']) ? htmlspecialchars($consultation_data['female_findings']) : '<span class="no-data">No findings recorded</span>'; ?></div>
        </div>
        <div class="field-row">
            <div class="field-label">Male Findings:</div>
            <div class="field-value"><?php echo isset($consultation_data['male_findings']) && !empty($consultation_data['male_findings']) ? htmlspecialchars($consultation_data['male_findings']) : '<span class="no-data">No findings recorded</span>'; ?></div>
        </div>
    </div>
    
    <!-- Investigations -->
    <?php if(isset($print_data['investigations']['enabled']) && $print_data['investigations']['enabled']): ?>
    <div class="section">
        <div class="section-title">🔬 Investigations Recommended</div>
        
        <?php if(isset($print_data['investigations']['female']) && !empty($print_data['investigations']['female'])): ?>
        <div class="field-row">
            <div class="field-label">Female Investigations:</div>
            <div class="field-value">
                <div class="list-items">
                    <?php foreach($print_data['investigations']['female'] as $investigation): ?>
                        <li><?php echo htmlspecialchars($investigation); ?></li>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if(isset($print_data['investigations']['male']) && !empty($print_data['investigations']['male'])): ?>
        <div class="field-row">
            <div class="field-label">Male Investigations:</div>
            <div class="field-value">
                <div class="list-items">
                    <?php foreach($print_data['investigations']['male'] as $investigation): ?>
                        <li><?php echo htmlspecialchars($investigation); ?></li>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <!-- OPD Medicines -->
    <?php if(isset($print_data['medicines_opd']['enabled']) && $print_data['medicines_opd']['enabled']): ?>
    <div class="section">
        <div class="section-title">💊 OPD Medicines</div>
        
        <?php if(isset($print_data['medicines_opd']['female']) && !empty($print_data['medicines_opd']['female'])): ?>
        <div class="field-row">
            <div class="field-label">Female Medicines:</div>
            <div class="field-value">
                <?php 
                echo '<table class="medicine-table">';
                echo '<thead><tr><th>Medicine</th><th>Dosage</th><th>Frequency</th><th>Duration</th><th>Route</th><th>Remarks</th></tr></thead>';
                echo '<tbody>';
                foreach($print_data['medicines_opd']['female'] as $medicine) {
                    if(is_array($medicine)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_name'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_dosage'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_frequency'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_days'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_route'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_remarks'] ?? 'N/A') . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</tbody></table>';
                ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if(isset($print_data['medicines_opd']['male']) && !empty($print_data['medicines_opd']['male'])): ?>
        <div class="field-row">
            <div class="field-label">Male Medicines:</div>
            <div class="field-value">
                <?php 
                echo '<table class="medicine-table">';
                echo '<thead><tr><th>Medicine</th><th>Dosage</th><th>Frequency</th><th>Duration</th><th>Route</th><th>Remarks</th></tr></thead>';
                echo '<tbody>';
                foreach($print_data['medicines_opd']['male'] as $medicine) {
                    if(is_array($medicine)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_name'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_dosage'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_frequency'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_days'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_route'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_remarks'] ?? 'N/A') . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</tbody></table>';
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <!-- IPD Medicines -->
    <?php if(isset($print_data['medicines_ipd']['enabled']) && $print_data['medicines_ipd']['enabled']): ?>
    <div class="section">
        <div class="section-title">🏥 IPD Medicines</div>
        
        <?php if(isset($print_data['medicines_ipd']['female']) && !empty($print_data['medicines_ipd']['female'])): ?>
        <div class="field-row">
            <div class="field-label">Female Medicines:</div>
            <div class="field-value">
                <?php 
                echo '<table class="medicine-table">';
                echo '<thead><tr><th>Medicine</th><th>Dosage</th><th>Frequency</th><th>Duration</th><th>Route</th><th>Remarks</th></tr></thead>';
                echo '<tbody>';
                foreach($print_data['medicines_ipd']['female'] as $medicine) {
                    if(is_array($medicine)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_name'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_dosage'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_frequency'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_days'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_route'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['female_medicine_remarks'] ?? 'N/A') . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</tbody></table>';
                ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if(isset($print_data['medicines_ipd']['male']) && !empty($print_data['medicines_ipd']['male'])): ?>
        <div class="field-row">
            <div class="field-label">Male Medicines:</div>
            <div class="field-value">
                <?php 
                echo '<table class="medicine-table">';
                echo '<thead><tr><th>Medicine</th><th>Dosage</th><th>Frequency</th><th>Duration</th><th>Route</th><th>Remarks</th></tr></thead>';
                echo '<tbody>';
                foreach($print_data['medicines_ipd']['male'] as $medicine) {
                    if(is_array($medicine)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_name'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_dosage'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_frequency'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_days'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_route'] ?? 'N/A') . '</td>';
                        echo '<td>' . htmlspecialchars($medicine['male_medicine_remarks'] ?? 'N/A') . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</tbody></table>';
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <!-- Procedures -->
    <?php if(isset($print_data['procedures']['enabled']) && $print_data['procedures']['enabled']): ?>
    <div class="section">
        <div class="section-title">⚕️ Procedures Recommended</div>
        <div class="field-row">
            <div class="field-label">Procedures:</div>
            <div class="field-value">
                <?php if(isset($print_data['procedures']['list']) && !empty($print_data['procedures']['list'])): ?>
                    <div class="list-items">
                        <?php foreach($print_data['procedures']['list'] as $procedure): ?>
                            <li><?php echo htmlspecialchars($procedure); ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <span class="no-data">No procedures recommended</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Packages -->
    <?php if(isset($print_data['packages']['enabled']) && $print_data['packages']['enabled']): ?>
    <div class="section">
        <div class="section-title">📦 Packages Recommended</div>
        <div class="field-row">
            <div class="field-label">Packages:</div>
            <div class="field-value">
                <?php if(isset($print_data['packages']['list']) && !empty($print_data['packages']['list'])): ?>
                    <div class="list-items">
                        <?php foreach($print_data['packages']['list'] as $package): ?>
                            <li><?php echo htmlspecialchars($package); ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <span class="no-data">No packages recommended</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Follow-up Appointment -->
    <?php if(isset($print_data['follow_up']['enabled']) && $print_data['follow_up']['enabled']): ?>
    <div class="section">
        <div class="section-title">📅 Follow-up Appointment</div>
        <div class="follow-up-info">
            <div class="field-row">
                <div class="field-label">Follow-up Date:</div>
                <div class="field-value"><?php echo isset($print_data['follow_up']['date']) ? date("d-m-Y", strtotime($print_data['follow_up']['date'])) : 'N/A'; ?></div>
            </div>
            <div class="field-row">
                <div class="field-label">Follow-up Time:</div>
                <div class="field-value"><?php echo isset($print_data['follow_up']['slot']) ? htmlspecialchars($print_data['follow_up']['slot']) : 'N/A'; ?></div>
            </div>
            <div class="field-row">
                <div class="field-label">Purpose:</div>
                <div class="field-value"><?php echo isset($print_data['follow_up']['purpose']) ? htmlspecialchars($print_data['follow_up']['purpose']) : 'N/A'; ?></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="footer">
        <p><strong>Report Generated:</strong> <?php echo date('d-m-Y H:i:s'); ?></p>
        <p><strong>Consultation ID:</strong> <?php echo isset($appointments['ID']) ? $appointments['ID'] : 'N/A'; ?></p>
        <p>This is an official consultation report generated by the Hospital Management System.</p>
        <p>For any queries or clarifications, please contact the hospital administration.</p>
    </div>
    
    <script>
        // Auto-print when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 1000);
        };
    </script>
</body>
</html>
