<?php $all_method =&get_instance();  ?>
 	<div class="card">
      <!-- Advanced Tables -->
 <div class="row card-content" style="margin-bottom:20px;">
      <div class="col-md-12"><h3>Fellowship And Training</h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'accounts/fellowship_and_training'; ?>" method="get">
		    <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>" />
            </div>
			 <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/fellowship-reports'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Reports</button>
               </a>
            </div>	
            <div class="col-sm-2" style="margin-top: 30px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
              <a href="<?php echo base_url().'accounts/fellowship_and_training'; ?>" style="text-decoration: none;">
				<button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
				</a>
            </div>
           
            </form>  
        </div>

       <!--Procedure Tables -->

   		  <div class="card">

         <div class="clearfix"></div>

        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="">

              <thead>

                <tr>

                  <th>S.No.</th>

                  <th>Student Id</th>

                  <th>Name</th>

                  <th>Father Name</th>

                  <th>Total Package</th>

                  <th>Discount</th>

                  <th>Paid Amount</th>

                  <th>Method</th>
				  
				          <th>Address</th>

                  <th>Date</th>

                  <th>Status</th>
				  
				</tr>

              </thead>

              <tbody id="procedure_result">
			  
			  <?php $count=1; foreach($consultation_cancel_result as $ky => $vl){ ?>
                <tr class="odd gradeX">

                  <td><?php echo $count; ?></td>

                  <td><a href="<?php echo base_url() ?>accounts/fellow_details/<?php echo $vl['receipt']; ?>"><?php echo $vl['studentid']; ?></a></td>

                  <td><?php echo $vl['name']; ?></td>

                  <td><?php echo $vl['fname']; ?></td>

                  <td><?php echo $vl['price']; ?></td>

                  <td><?php echo $vl['discount_amount']; ?></td>

                  <td><?php echo $vl['payment_done']; ?></td>

                  <td><?php echo $vl['payment_method']; ?></td>
				  
				          <td><?php echo $vl['address']; ?></td>

                  <td><?php echo $vl['add_date']?></td>

                  <td><?php if($vl['status'] == 0){echo 'Pending';}elseif($vl['status'] == 1){ echo "Appoved"; }elseif($vl['status'] == 3){ echo "Cancel"; }else{ echo "Disappoved"; }
             if($_SESSION['logged_accountant']){
           if($vl['status']== '0'){ ?> 
			<a class="btn btn-primary" href="<?php echo base_url();?>accounts/approve_fellowship/<?php echo $vl['ID']?>?i=<?php echo $vl['ID'];?>">Approved</a> 
			<a class="btn btn-primary" href="<?php echo base_url();?>accounts/disapprove_fellowship/<?php echo $vl['ID']?>?i=<?php echo $vl['ID'];?>">Disapproved</a>
			<a class="btn btn-primary" href="<?php echo base_url();?>accounts/cancel_fellowship/<?php echo $vl['ID']?>?i=<?php echo $vl['ID'];?>">Cancel</a> 
          <?php } elseif ($vl['status'] == '1') { ?>
			   <a class="btn btn-primary" href="<?php echo base_url();?>accounts/cancel_fellowship/<?php echo $vl['ID']?>?i=<?php echo $vl['ID'];?>">Cancel</a> 
			   
		  <?php } } ?>
							
							</td>
				  
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
      <!--End Procedure Tables -->
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