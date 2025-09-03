<?php $all_method =&get_instance(); //var_dump($_SERVER['REDIRECT_QUERY_STRING']);die; ?>
<div class="card">
   <div class="row card-content" style="margin-bottom:20px;">
         <div class="col-md-12"><h3> FREEZING RENEWAL </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'accounts/freezing_renewal'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Start Date</label>
              <input type="text" class="particular_date_filter form-control" id="start_date" name="start_date" value="<?php echo $start_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>End Date</label>
                <input type="text" class="particular_date_filter form-control" id="end_date" name="end_date" value="<?php echo $end_date;?>" />
            </div>
            <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $iic_id;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/freezing_renewal'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            	    
            </form>
        </div>
      <!-- Advanced Tables -->       

       <!--Investigation Tables -->

    	  <div class="card">

         <div class="clearfix"></div>

        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="">

              <thead>

                <tr>

                  <th>S.No.</th>
				  
				  <th>Expiry Date</th>

                  <th>IIC ID</th>

                  <th>Patient Name</th>
				  
				  <th>Frozen Sample</th>
				  
				  <th>Freezing </th>
				  
				  <th>Remaining </th>

                  <th>Discard Status</th>
				  
				  <th>Status</th>
				  
				  <th>Update</th>

                </tr>

              </thead>

              <tbody id="investigate_result">

              <?php $count=1; foreach($freezing_result as $ky => $vl){ 
			  
			    /*embryology freezing detail*/
			    $sql1 = "SELECT * FROM discharge_summary WHERE iic_id='".$vl['iic_id']."'";
                $select_result1 = run_select_query($sql1);                 
			    $sql = "SELECT * FROM `embryology_discharge_summary` WHERE iic_id='".$vl['iic_id']."'";
                $select_result = run_select_query($sql); 
			  
			    $sql2 = "SELECT * FROM semen_analysis WHERE iic_id='".$vl['iic_id']."'";
                $select_result2 = run_select_query($sql2); 
				 
				$sql3 = "SELECT * FROM ovum_discharge_summary WHERE iic_id='".$vl['iic_id']."'";
                $select_result3 = run_select_query($sql3);

                $sql4 = "SELECT * FROM freezing WHERE iic_id='".$vl['iic_id']."'";
			    $select_result4 = run_select_query($sql4);	
                 
				 ?>

                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>
				  
				  <td><?php echo $vl['expiry_date']?></td>

                  <td><?php echo $vl['iic_id']?></td>

                  <td><?php echo $vl['wife_name']?></td>

                  <td><?php echo $vl['frozen_sample']?></td>
				  <td>
				   <?php echo $select_result1['embryo_status']; ?> - <?php echo $select_result1['day_of_freezing']; ?>
                   <?php echo $select_result2['Freezing']; ?>
                   <?php echo $select_result3['freezing']; ?>				   
                   				   
				  </td>
				  <td>
				      <?php echo $select_result['embryos_after_transfer']; ?>,
				     <br/>  
					  <?php echo $select_result4['remaining']; ?>
					  
					   
				  </td>
				  <td><?php echo ucfirst($vl['discard_status']); ?></td>
				  
				  <td><?php echo ucfirst($vl['status']); ?></td>

                  <td><a target="_blank" href="<?php echo base_url(); ?>accounts/updatefreezing?ID=<?php echo $vl['id']?>">Edit</a></td>
				  
                </tr>

              <?php $count++;} ?>
			   <tr>
                <td colspan="12">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>

              </tbody>

            </table>

          </div>

        </div>

      </div>

       <!--End Investigation Tables -->

      <!--End Advanced Tables -->

    </div>


    <style>
.custom-pagination{
  padding:8px;
}
.custom-pagination a{
  padding:10px;
  text-decoration: none;
}
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
.form-control#billing_at{
  height: 40px!important;
  border: 1px solid #9e9e9e!important;
}

	</style>

   

    

    <script>

		$(document).on('change',"#billing_from_filter",function(e) {

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

					//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

					var data = {start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD'), type:'date_wise'};

					billing_filter(data);

					$(this).datepicker('setDate', null);

			  });

		});



		$('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {

			$(this).val('');

			$(this).data('daterangepicker').setStartDate(moment());

			$(this).data('daterangepicker').setEndDate(moment());

		});


</script>

