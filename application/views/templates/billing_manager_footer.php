</div>
</div>
<div id="loader_div">
	<img src="<?php echo base_url();?>assets/images/ajax-loader.gif" />
</div>
<script type="text/javascript">
		/*$(function() {
		  $('input.daterange_filter').daterangepicker({
			timePicker: false,
			startDate: moment().startOf('hour'),
			endDate: moment().startOf('hour').add(32, 'hour'),
			locale: {
			  format: 'DD-MM-YYYY'
			}
		  });
		});*/
</script>

<script type="text/javascript">
/*$( ".week_month_filter" ).on( "change", function() {
 	var selected = $(this).val();
	var filter_type = $(this).attr('filter');
	$.ajax({                                      
	  url: '<?php echo base_url('welcome/week_month_filter')?>',                      
	  data: {filter_value:selected, filter_type:filter_type},
	  dataType: 'json',
	  method: "POST",
	  success: function(data)
	  {
		  //$('#loading-gif').hide();
		  //$('#extra-addon').empty();
		  //$('.modal-title').append(data.head_title);
	   }
	});
});*/

$( "#get_discount_approval" ).on( "click", function() {
	$('#loader_div').show();
	var accountant = $(this).attr('accountant');
	var discount = $('#discount_amount').val();
	var receipt_number = $('#receipt_number').val();
	var patient_id = $('#patient_id').val();
	var billing_type = $('#billing_type').val();
	if(accountant != '' && discount != '' && receipt_number != '' && patient_id != '' && billing_type != ''){
		$.ajax({                                      
			  url: '<?php echo base_url('accounts/get_discount_approval'); ?>',                      
			  data: {accountant:accountant, discount:discount, receipt_number:receipt_number, patient_id:patient_id, billing_type:billing_type},
			  dataType: 'json',
			  method: "POST",
			  success: function(data)
			  {
				if(data.status == 1){
					$('a#create_billing').show();
					alert('Approval request sent.');
				}else if(data.status == 2){
					$('a#create_billing').show();
					alert('Discount already requested.');
				}else{
					alert('Opps, something went wrong! Try again later.');
				}
				$('#loader_div').hide();
			  }
		});
	}else{
		alert('Opps, something went wrong! Try again later.');
		window.location.reload();
		$('#loader_div').hide();
	}
});

</script>

<!-- JS Scripts-->
<!-- Bootstrap Js -->
<script src="<?php echo base_url();?>assets/materialize/js/materialize.min.js"></script>
<!-- Metis Menu Js -->
<script src="<?php echo base_url();?>assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="<?php echo base_url();?>assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url();?>assets/js/morris/morris.js"></script>
<script src="<?php echo base_url();?>assets/js/easypiechart.js"></script>
<script src="<?php echo base_url();?>assets/js/easypiechart-data.js"></script>
<script src="<?php echo base_url();?>assets/js/Lightweight-Chart/jquery.chart.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-multiselect.js"></script>
<script>
    $(document).ready(function () { $('.dataList').dataTable(); });
</script>
<!-- Custom Js -->
<script src="<?php echo base_url();?>assets/js/custom-scripts.js"></script>

<!-- Menu Highlighting Script -->
<script src="<?php echo base_url();?>assets/js/menu-highlight.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/daterangepicker.min.js"></script>

</body>
</html>
