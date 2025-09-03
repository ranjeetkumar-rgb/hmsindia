<?php
   
   /* $sql1 = "SELECT DISTINCT ap.wife_name, ap.wife_phone, f.id, f.iic_id, f.frozen_sample, f.freezing_date, f.expiry_date, f.status FROM hms_appointments ap JOIN freezing f 
WHERE ap.paitent_id = f.iic_id";*/
    $sql1 = "SELECT * FROM freezing WHERE discard_status='discard' ORDER BY created_date DESC"; 
    $query = $this->db->query($sql1);
    $select_result1 = $query->result();
   
?>

    <div class="col-md-12">
      <!-- Advanced Tables -->
       <!--Consultation  Tables -->
    	  <div class="card">
        <div class="card-action"><h3>DISCARD LIST</h3></div>
	    <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover dataList" id="consultation_billing_list">
              <thead>

                <tr>

                  <th>S.No.</th>
				  
				  <th>Expiry Date</th>
				  
				  <th>IIC ID</th>
				  
				  <th>Patient name</th>
				  
				  <th>Mobile No</th>
				  
				  <th>Frozen Sample</th>

                 
                </tr>

              </thead>
    
              <tbody id="consultation_result">

            
                 <?php
              foreach ($select_result1 as $res_val){
              ?>
                <tr class="odd gradeX">

	              <td><?php echo $res_val->id; ?></td>
				  
				  <td style="width:10%"><?php echo $res_val->expiry_date ?></td>
				  
				  <td><?php echo $res_val->iic_id; ?></td>

                  <td><?php echo $res_val->wife_name; ?></td>
				  
				   <td><?php echo sting_masking($res_val->wife_phone);  ?></td>

                  <td style="width:15%"><?php echo $res_val->frozen_sample; ?></td>
				  
				  
				 
				 
				 
				 
				  
				 
				 
				 
				 
				 
				 
				 
				 
				 
                  
                  

                </tr>
            <?php 
			} 
            ?>
            

              </tbody>
	
            </table>

          </div>

        </div>

      </div>

       <!--End Consultation  Tables -->
 
 
      

    </div>

    <style>

		.hidden_field{display:none;}

		div#disapprove_pop {

			position: fixed;

			top: 0;

			right: 0;

			left: 0;

			background: rgba(255,255,255,0.6);

			z-index: 999999999;

			height: 100%;

			height: 100%;

			box-shadow: 0px 0px 3px 0px #000;

			display:none;

		}

	

	</style>


<script>
        $(document).on('change',"#billing_at_filter",function(e) {
        $('#billing_from_filter').prop('selectedIndex',0);
            $('#loader_div').show();
            var billing_at = $(this).val();
            if(billing_at != ''){
              var data = {billing_at:billing_at, type:'billing_at'};
              billing_filter(data);
            }else{
              $('#loader_div').hide();
            }
        });
        $(document).on('change',"#billing_from_filter",function(e) {
        $('#billing_at_filter').prop('selectedIndex',0);
            $('#loader_div').show();
            var billing_from = $(this).val();
            if(billing_from != ''){
              var data = {billing_from:billing_from, type:'billing_from'};
              billing_filter(data);
            }else{
              $('#loader_div').hide();
            }
        });
      $(function() {
          $('input[name="daterange"]').daterangepicker({
          opens: 'left'
          }, function(start, end, label) {
              $('#billing_from_filter').prop('selectedIndex',0);
              $('#billing_at_filter').prop('selectedIndex',0);
            var end = end.add(1, 'days');
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 00:00:00'));
            var data = {start:start.format('YYYY-MM-DD 00:00:00'),end:end.format('YYYY-MM-DD 00:00:00'), type:'date_wise'};
            billing_filter(data, start.format('YYYY-MM-DD 00:00:00'), end.format('YYYY-MM-DD 00:00:00'));
            $(this).datepicker('setDate', null);
          });
      });

      $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data('daterangepicker').setStartDate(moment());
        $(this).data('daterangepicker').setEndDate(moment());
      });
      
     $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val('');
        $(this).data('daterangepicker').setStartDate(moment());
        $(this).data('daterangepicker').setEndDate(moment());
      });

      function billing_filter(data, start, end){ //console.log('23432');
          $('#loader_div').show();
          $('tbody#consultation_result').empty();
          $('tbody#investigate_result').empty();
          $('tbody#procedure_result').empty();
          $.ajax({
              url: '<?php echo base_url('billings/ajax_accounts_billing_filter')?>',
              data: data,
              dataType: 'json',
              method:'post',
              success: function(datax)
              {
                  $("#consultation_billing_list").append(datax.consultant_html);
                  $('tbody#investigate_result').empty().append(datax.investigation_html);
                  $('tbody#procedure_result').empty().append(datax.procedure_html);
                  $('tbody#partial_payment_result').empty().append(datax.payment_html);

                  var export_billing = $('#export-billing').attr('href');
                  if(data.type == "date_wise"){
                    $('#export-billing').attr('href', export_billing+"?type="+data.type+"&start="+start+"&end="+end);
                  }
                  if(data.type == "billing_from"){
                    $('#export-billing').attr('href', export_billing+"?type="+data.type+"&billing_from="+data.billing_from);  
                  }
                  if(data.type == "billing_at"){
                      $('#export-billing').attr('href', export_billing+"?type="+data.type+"&billing_at="+data.billing_at);  
                  }
                $("ul.pagination").hide();
                  $('#loader_div').hide();
              } 
          });
      }
</script>