<?php
include_once("inc/db_connect.php");
$query = "SELECT * FROM pcp_ndt WHERE center='India IVF Fertility Fortis' ORDER BY date DESC";
$results = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
$allOrders = array();
while( $order = mysqli_fetch_assoc($results) ) {
	$allOrders[] = $order;
}
$startDateMessage = '';
$endDate = '';
$noResult ='';
if(isset($_POST["export"])){
 if(empty($_POST["fromDate"])){
  $startDateMessage = '<label class="text-danger">Select start date.</label>';
 }else if(empty($_POST["toDate"])){
  $endDate = '<label class="text-danger">Select end date.</label>';
 } else {  
  $orderQuery = "
	SELECT * FROM pcp_ndt 
	WHERE date >= '".$_POST["fromDate"]."' AND date <= '".$_POST["toDate"]."' and center='India IVF Fertility Fortis' ORDER BY date DESC";
  $orderResult = mysqli_query($conn, $orderQuery) or die("database error:". mysqli_error($conn));
  $filterOrders = array();
  while( $order = mysqli_fetch_assoc($orderResult) ) {
	$filterOrders[] = $order;
  }
  if(count($filterOrders)) {
	  $fileName = "pcpndt_fhvk.csv";
	  header("Content-Description: File Transfer");
	  header("Content-Disposition: attachment; filename=$fileName");
	  header("Content-Type: application/csv;");
	  $file = fopen('php://output', 'w');
	  $header = array("S.NO", "NAME OF WOMAN UNDERGOING IVF / ART WITH DATE","Age", "HUSBAND'S / FATHER'S NAME","COMPLETE ADDRESS","PHONE NO.","PARITY OF WOMAN WITH SEX OF PREVIOUS CHILD","REASON FOR IVF / ART","DETALIS OF REFERRING DR","PROCEDURE DONE","OUTCOME OF THE TREATMENT","DETAIL OF THE DR FURTHER REFERRED FOR DELIVERY/MANAGEMENT OF PREGNANCY","OUTCOME OF THE PREGNANCY","MALE","FEMALE","ANY MALFORMATION IN NEW BORN DETAILS","LIST OF ISSUES","CENTER NAME","DATE OF DISCHARGE","TEST", "DATE");
	  fputcsv($file, $header);  
	  foreach($filterOrders as $order) {
	   $dataArr = $order["female_pregnancy_other_p"]." ".$order["female_pregnancy_other_l"]." ".$order["female_pregnancy_other_a"];
	   $orderData = array();
	   $orderData[] = $order["ID"];
	   $orderData[] = $order["wife_name"];
	   $orderData[] = $order["wife_age"];
	   $orderData[] = $order["husband_name"];
	   $orderData[] = $order["wife_address"];
	   $orderData[] = $order["wife_phone"];
	   $orderData[] = $dataArr;
	   $orderData[] = $order["details_management_advised"];
	   $orderData[] = $order["IVF_Consultant"];
	   $orderData[] = $order["procedure_done"];
	   $orderData[] = $order["outcome_of_tretment"];
	   $orderData[] = $order["further_referredfor_dellvery"];
	   $orderData[] = $order["outcome_of_pregnancy"];
	   $orderData[] = $order["male"];
	   $orderData[] = $order["female"];
	   $orderData[] = $order["malformation_in_newborn"];
	   $orderData[] = $order["female_issues"];
	   $orderData[] = $order["center"];
	   $orderData[] = $order["test_type"];
	   $orderData[] = $order["date_of_discharge"];
	   $orderData[] = $order["date"];
	   fputcsv($file, $orderData);
	  }
	  fclose($file);
	  exit;
  } else {
	 $noResult = '<label class="text-danger">There are no record exist with this date range to export. Please choose different date range.</label>';  
  }
 }
}
  $sql1 = "SELECT * FROM pcp_ndt WHERE center='India IVF Fertility Fortis ' ORDER BY date DESC";
	$query = $this->db->query($sql1);
    $select_result1 = $query->result(); 
   ?>
<div class="col-md-12">
   <!-- Advanced Tables -->
   <!--Consultation  Tables -->
   <div class="card">
      <div class="card-action">
         <h3>PCPNDT FHVK</h3>
      </div>
      
	  <div class="col-sm-12 col-xs-12">
 <form method="post">
  <div class="input-daterange">
   <div class="col-md-4">
	From<input type="text" name="fromDate" class="particular_date_filter form-control" value="<?php echo date("Y-m-d"); ?>" readonly />
	<?php echo $startDateMessage; ?>
   </div>
   <div class="col-md-3">
	To<input type="text" name="toDate" class="particular_date_filter form-control" value="<?php echo date("Y-m-d"); ?>" readonly />
	<?php echo $endDate; ?>
   </div>
  </div>
  <div class="col-md-2"><div>&nbsp;</div>
   <input type="submit" name="export" value="Export to CSV" class="btn btn-info" />
  </div>
 </form>
</div>
<div class="clearfix"></div>
      <div class="card-content">
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="consultation_billing_list">
               <thead>
                  <tr>
                     <th>S.NO</th>
                     <th>NAME OF WOMAN UNDERGOING IVF / ART WITH DATE</th>
                     <th>AGE</th>
					 <th>HUSBAND'S / FATHER'S NAME</th>
                     <th>COMPLETE ADDRESS</th>
					 <th>PHONE NO.</th>
                     <th>PARITY OF WOMAN WITH SEX OF PREVIOUS CHILD</th>
                     <th>REASON FOR IVF / ART</th>
                     <th>DETAILS OF REFERRING DR</th>
                     <th>PROCEDURE DONE</th>
                     <th>OUTCOME OF THE TREATMENT</th>
                     <th>DETAIL THE DR FURTHER REFERRED FOR DELIVERY/MANAGEMENT OF PREGNANCY</th>
					 <th>OUTCOME OF THE PREGNANCY</th>
                     <th>MALE</th>
					 <th>FEMALE</th>
                     <th>ANY MALFORMATION IN NEW BORN DETAILS</th>
					 <th>LIST OF ISSUE</th>
					 <th>CENTER NAME</th>
					 <th>TEST TYPE</th>
					 <th>Date Of Discharge</th>
				 </tr>
               </thead>
               <tbody id="consultation_result">
                  <?php
                     foreach ($select_result1 as $res_val){
                     ?>
                  <tr class="odd gradeX">
                     <td><a href="<?php echo base_url()?>doctors/pcp_ndt_update?ID=<?php echo $res_val->ID; ?>"><?php echo $res_val->iic_id; ?></a></td>
                     <td><?php echo $res_val->wife_name; ?></td>
					 <td style="width:15%"><?php echo $res_val->wife_age; ?></td>
                     <td style="width:15%"><?php echo $res_val->husband_name; ?></td>
                     <td style="width:15%"><?php echo $res_val->wife_address; ?></td>
					 <td style="width:15%"><?php echo $res_val->wife_phone; ?></td>
                     <td style="width:15%"><?php echo $res_val->female_pregnancy_other_p; ?>,&nbsp<?php echo $res_val->female_pregnancy_other_l; ?>,&nbsp<?php echo $res_val->female_pregnancy_other_a; ?></td>
					 <td style="width:15%"><?php echo $res_val->details_management_advised; ?></td>
					 <td style="width:15%"><?php echo $res_val->IVF_Consultant; ?></td>
					 <td style="width:15%"><?php echo $res_val->procedure_done; ?></td>
					 <td style="width:15%"><?php echo $res_val->outcome_of_tretment; ?></td>
					 <td style="width:15%"><?php echo $res_val->further_referredfor_dellvery; ?></td>
					 <td style="width:15%"><?php echo $res_val->outcome_of_pregnancy; ?></td>
					 <td style="width:15%"><?php echo $res_val->male; ?></td>
					 <td style="width:15%"><?php echo $res_val->female; ?></td>
					 <td style="width:15%"><?php echo $res_val->malformation_in_newborn; ?></td>
					 <td style="width:15%"><?php echo $res_val->female_issues; ?></td>
					 <td style="width:15%"><?php echo $res_val->center; ?></td>
					 <td style="width:15%"><?php echo $res_val->test_type; ?></td>
					 <td style="width:15%"><?php echo $res_val->date_of_discharge; ?></td>
				 </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <!--End Consultation  Tables -->
</div>
<style>
   select.appointment_status {
   display: block!important;
   width: auto!important;
   }
</style>
<script>
$(document).on('change',"#filter_by_status",function(e) {
  $('#loader_div').show();
   var status = $(this).val();
   if(status != ''){
		var data = {status:status, type:'appointment_status'};
		appointment_filter(data);
	}else{
		$('#loader_div').hide();
	}
});

$(function() {
	  $('input[name="date_range"]').daterangepicker({
		opens: 'left'
	  }, function(start, end, label) {
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			var data = {start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD'), type:'date_wise'};
			appointment_filter(data);
	  });
});


$( function() {
    $( ".particular_date_filter" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			onSelect: function(dateStr) {
				$('#loader_div').show();				
				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
				var data = {appointment_date:startDate, type:'particular_date_filter'};
			}
		});
});
</script>





