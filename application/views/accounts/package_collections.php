 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
           <div class="card" style="margin-bottom:20px;">
      <div class="col-md-12"><h3>Package Collections </h3></div>
      <div class="clearfix"></div>
	    <form action="<?php echo base_url().'accounts/package_collections'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Filter by billing at</label>
                <select class="form-control" id="billing_at" name="billing_at">
                	<option value=''>--Select From--</option>
                    <?php $all_centers = $all_method->get_all_centers();
						            foreach($all_centers as $key => $val){ //var_dump($val);die;
                          if($billing_at == $val['center_number']){
                            echo '<option value="'.$val['center_number'].'" selected>'.$val['center_name'].'</option>';
                          }else{
		                        echo '<option value="'.$val['center_number'].'">'.$val['center_name'].'</option>';
                          }
                    	  } 
					    ?>
                </select>
            </div>
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
                <input type="text" class="form-control" id="iic_id" name="iic_id" value="<?php echo $patient_id;?>" />
            </div>
			 <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>Status </label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $status;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'accounts/package_collections'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            <div class="col-sm-2" style="margin-top: 10px;">
            	<a href="<?php echo base_url('accounts/package_collections'); ?>" style="text-decoration: none;">
                <button name="export-billing" type="submit"  class="btn btn-secondary" id="export-billing">Export Billings</button>
               </a>
            </div>	
		  </form>  
       
             <div class="clearfix"></div>
            <div class="card-content">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="procedure_billing_list">
                  <thead>
                   <tr>
					  <td>Pkg Booking Date</td>
					  <td>Pkg Month</td>
					  <td>Pkg Booking Yr</td>
					  <td>Financial Year</td>
					  <td>Pkg No</td>
					  <td>IIC Id</td>
					  <td>Patient Name</td>
					  <td>Patient Category_1</td>
					  <td>Patient Category_2</td>
					  <td>Combo Code</td>
					  <td>Combo Description</td>
					  <td>Pkg Code</td>
					  <td>Pkg Description</td>
					  <td>Category</td>
					  <td>Sub_Category1</td>
					  <td>Sub_Category2</td>
					  <td>Sub_Category3</td>
					  <td>Sub_Category4</td>
					  <td>Sub_Category7</td>
					  <td>Scheme No</td>
					  <td>Scheme Name</td>
					  <td>Coupon Code</td>
					  <td>Scheme Description</td>
					  <td>Period (in Month)</td>
					  <td>Starting Date</td>
					  <td>Ending Date</td>
					  <td>Tag1</td>
					  <td>Tag2</td>
					  <td>Tag3</td>
					  <td>Actual Date of Procedures</td>
					  <td>Pkg Cost Centre</td>
					  <td>Origin/Booking Centre</td>
					  <td>Sales Reporting Centre</td>
					  <td>Billing Centre</td>
					  <td>Cluster Name</td>
					  <td>Lead Source ID</td>
					  <td>Source Category</td>
					  <td>Source Name</td>
					  <td>Source_3 AgentName</td>
					  <td>Narrations</td>
					  <td>Remarks_1</td>
					  <td>Remarks_2</td>
					  <td>Remarks_3</td>
					  <td>Remarks_4</td>
					  <td>Remarks_5</td>
					  <td>Status</td>
					  <td>Document Type</td>
					  <td>Invoice No</td>
					  <td>Gross Revenue Pkg</td>
					  <td>Discount %</td>
					  <td>Discount</td>
					  <td>Booked Pkg amt Inc GST</td>
					  <td>GST in Booked Pkg Amt</td>
					  <td>Booked Pkg Amount Ex GST</td>
					  <td>Collection as on 01/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 02/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 03/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 04/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 05/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 06/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 07/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 08/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 09/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 10/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 11/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 12/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 13/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 14/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 15/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 16/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 17/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 18/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 19/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 20/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 21/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 22/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 23/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 24/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 25/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 26/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 27/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 28/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 29/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 30/04/<?php echo date('Y'); ?></td>
					  <td>Collection as on 01/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 02/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 03/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 04/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 05/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 06/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 07/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 08/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 09/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 10/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 11/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 12/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 13/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 14/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 15/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 16/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 17/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 18/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 19/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 20/05/<?php echo date('Y'); ?></td>
						<td>Collection as on 21/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 31/05/<?php echo date('Y'); ?></td>
					<td>Collection as on 01/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 02/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 03/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 04/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 05/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 06/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 07/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 08/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 09/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 10/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 11/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 12/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 13/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 14/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 15/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 16/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 17/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 18/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 19/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 20/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 21/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/06/<?php echo date('Y'); ?></td>
					<td>Collection as on 01/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 02/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 03/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 04/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 05/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 06/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 07/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 08/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 09/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 10/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 11/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 12/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 13/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 14/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 15/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 16/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 17/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 18/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 19/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 20/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 21/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 31/07/<?php echo date('Y'); ?></td>
					<td>Collection as on 01/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 02/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 03/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 04/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 05/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 06/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 07/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 08/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 09/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 10/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 11/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 12/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 13/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 14/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 15/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 16/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 17/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 18/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 19/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 20/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 21/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 31/08/<?php echo date('Y'); ?></td>
					<td>Collection as on 01/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 02/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 03/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 04/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 05/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 06/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 07/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 08/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 09/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 10/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 11/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 12/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 13/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 14/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 15/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 16/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 17/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 18/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 19/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 20/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 21/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/09/<?php echo date('Y'); ?></td>
					<td>Collection as on 01/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 02/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 03/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 04/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 05/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 06/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 07/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 08/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 09/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 10/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 11/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 12/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 13/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 14/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 15/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 16/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 17/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 18/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 19/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 20/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 21/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 31/10/<?php echo date('Y'); ?></td>
					<td>Collection as on 01/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 02/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 03/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 04/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 05/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 06/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 07/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 08/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 09/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 10/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 11/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 12/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 13/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 14/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 15/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 16/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 17/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 18/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 19/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 20/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 21/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/11/<?php echo date('Y'); ?></td>
					<td>Collection as on 01/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 02/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 03/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 04/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 05/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 06/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 07/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 08/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 09/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 10/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 11/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 12/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 13/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 14/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 15/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 16/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 17/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 18/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 19/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 20/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 21/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 22/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 23/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 24/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 25/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 26/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 27/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 28/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 29/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 30/12/<?php echo date('Y'); ?></td>
					<td>Collection as on 31/12/<?php echo date('Y'); ?></td>
					 <td>Collection as on 01/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 02/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 03/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 04/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 05/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 06/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 07/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 08/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 09/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 10/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 11/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 12/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 13/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 14/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 15/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 16/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 17/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 18/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 19/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 20/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 21/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 22/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 23/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 24/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 25/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 26/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 27/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 28/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 29/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 30/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 31/01/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 01/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 02/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 03/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 04/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 05/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 06/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 07/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 08/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 09/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 10/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 11/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 12/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 13/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 14/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 15/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 16/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 17/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 18/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 19/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 20/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 21/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 22/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 23/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 24/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 25/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 26/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 27/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 28/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 29/02/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 01/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 02/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 03/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 04/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 05/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 06/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 07/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 08/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 09/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 10/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 11/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 12/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 13/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 14/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 15/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 16/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 17/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 18/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 19/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 20/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 21/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 22/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 23/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 24/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 25/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 26/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 27/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 28/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 29/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 30/03/<?php echo date('Y')+1; ?></td>
					<td>Collection as on 31/03/<?php echo date('Y')+1; ?></td>
					<td>Apr'<?php echo date('Y'); ?></td>
					<td>May'<?php echo date('Y'); ?></td>
					<td>Jun'<?php echo date('Y'); ?></td>
					<td>Jul'<?php echo date('Y'); ?></td>
					<td>Aug'<?php echo date('Y'); ?></td>
					<td>Sep'<?php echo date('Y'); ?></td>
					<td>Oct'<?php echo date('Y'); ?></td>
					<td>Nov'<?php echo date('Y'); ?></td>
					<td>Dec'<?php echo date('Y'); ?></td>
					<td>Jan'<?php echo date('Y')+1; ?></td>
					<td>Feb'<?php echo date('Y')+1; ?></td>
					<td>Mar'<?php echo date('Y')+1; ?></td>
					<td>Total Collection</td>
					<td>Total Collection FY 2024-25</td>
					<td>Balance in FY 2024-25</td>
					<td>Total Collection FY 2025-26</td>
					<td>Balance in FY 2025-26</td>
					<td>Return/Credit Note Date</td>
					<td>Return/Credit Note No</td>
					<td>Return/Credit Note Amount</td>
					<td>Return/Credit Note Comment</td>
					<td>Original Reference Date</td>
					<td>Original Reference No</td>
					<td>Non PKg Adj Date</td>
					<td>Non PKg Adj Amt</td>
					<td>Non PKg Adj Comment</td>
					<td>Other Adj Date</td>
					<td>OtherAdj Amt</td>
					<td>Other Adj Comment</td>
					<td>Balance FY 2024-25</td>
					<td>Balance FY 2025-26</td>
					<td>Refund Date</td>
					<td>Refund Amount</td>
					<td>Total Outstanding</td>
				</tr>
                  </thead>
                  <tbody id="partial_payment_result">
                  <?php $count=1; foreach($partialpayments_result as $ky => $vl){
                            $patient_data = get_patient_detail($vl['patient_id']);
    						$currency = '';
                  $current_balance = $all_method->get_current_balance($vl['patient_id']); ?>
                    <tr class="odd gradeX">
						<td><?php echo $vl['pkg_booking_date']; ?></td>
						<td><?php echo $vl['pkg_month']; ?></td>
						<td><?php echo $vl['pkg_booking_year']; ?></td>
						<td><?php echo $vl['financial_year']; ?></td>
						<td><?php echo $vl['pkg_no']; ?></td>
						<td><?php echo $vl['iic_id']; ?></td>
						<td><?php echo $vl['patient_name']; ?></td>
						<td><?php echo $vl['patient_category_1']; ?></td>
						<td><?php echo $vl['patient_category_2']; ?></td>
						<td><?php echo $vl['combo_code']; ?></td>
						<td><?php echo $vl['combo_description']; ?></td>
						<td><?php echo $vl['pkg_code']; ?></td>
						<td><?php echo $vl['pkg_description']; ?></td>
						<td><?php echo $vl['category']; ?></td>
						<td><?php echo $vl['sub_category1']; ?></td>
						<td><?php echo $vl['sub_category2']; ?></td>
						<td><?php echo $vl['sub_category3']; ?></td>
						<td><?php echo $vl['sub_category4']; ?></td>
						<td><?php echo $vl['sub_category7']; ?></td>
						<td><?php echo $vl['scheme_no']; ?></td>
						<td><?php echo $vl['scheme_name']; ?></td>
						<td><?php echo $vl['coupon_code']; ?></td>
						<td><?php echo $vl['scheme_description']; ?></td>
						<td><?php echo $vl['period_in_month']; ?></td>
						<td><?php echo $vl['starting_date']; ?></td>
						<td><?php echo $vl['ending_date']; ?></td>
						<td><?php echo $vl['tag1']; ?></td>
						<td><?php echo $vl['tag2']; ?></td>
						<td><?php echo $vl['tag3']; ?></td>
						<td><?php echo $vl['actual_date_of_procedures']; ?></td>
						<td><?php echo $vl['pkg_cost_centre']; ?></td>
						<td><?php echo $vl['origin_booking_centre']; ?></td>
						<td><?php echo $vl['sales_reporting_centre']; ?></td>
						<td><?php echo $vl['billing_centre']; ?></td>
						<td><?php echo $vl['cluster_name']; ?></td>
						<td><?php echo $vl['lead_source_id']; ?></td>
						<td><?php echo $vl['source_category']; ?></td>
						<td><?php echo $vl['source_name']; ?></td>
						<td><?php echo $vl['source_3_agent_name']; ?></td>
						<td><?php echo $vl['narrations']; ?></td>
						<td><?php echo $vl['remarks_1']; ?></td>
						<td><?php echo $vl['remarks_2']; ?></td>
						<td><?php echo $vl['remarks_3']; ?></td>
						<td><?php echo $vl['remarks_4']; ?></td>
						<td><?php echo $vl['remarks_5']; ?></td>
						<td><?php echo $vl['status']; ?></td>
						<td><?php echo $vl['document_type']; ?></td>
						<td><?php echo $vl['invoice_no']; ?></td>
						<td><?php echo $vl['gross_revenue_pkg']; ?></td>
						<td><?php echo $vl['discount_percent']; ?></td>
						<td><?php echo $vl['discount']; ?></td>
						<td><?php echo $vl['booked_pkg_amt_inc_gst']; ?></td>
						<td><?php echo $vl['gst_in_booked_pkg_amt']; ?></td>
						<td><?php echo $vl['booked_pkg_amt_ex_gst']; ?></td>

						<!-- Daily Collection Fields (Year 1) -->
						<?php for($i=1; $i<=12; $i++): ?>
							<?php for($j=1; $j<=31; $j++): ?>
								<?php if(!($i==2 && $j>29) && !(in_array($i, [4,6,9,11]) && $j>30)): ?>
									<td><?php echo $vl[sprintf('collection_year_%02d_%02d', $i, $j)]; ?></td>
								<?php endif; ?>
							<?php endfor; ?>
						<?php endfor; ?>

						<!-- Monthly Collection Fields -->
						<td><?php echo $vl['collection_Apr']; ?></td>
						<td><?php echo $vl['collection_May']; ?></td>
						<td><?php echo $vl['collection_Jun']; ?></td>
						<td><?php echo $vl['collection_Jul']; ?></td>
						<td><?php echo $vl['collection_Aug']; ?></td>
						<td><?php echo $vl['collection_Sep']; ?></td>
						<td><?php echo $vl['collection_Oct']; ?></td>
						<td><?php echo $vl['collection_Nov']; ?></td>
						<td><?php echo $vl['collection_Dec']; ?></td>
						<td><?php echo $vl['collection_Jan']; ?></td>
						<td><?php echo $vl['collection_Feb']; ?></td>
						<td><?php echo $vl['collection_Mar']; ?></td>

						<!-- Summary Fields -->
						<td><?php echo $vl['total_collection']; ?></td>
						<td><?php echo $vl['total_collection_fy_2024_25']; ?></td>
						<td><?php echo $vl['balance_fy_2024_25']; ?></td>
						<td><?php echo $vl['total_collection_fy_2025_26']; ?></td>
						<td><?php echo $vl['balance_fy_2025_26']; ?></td>

						<!-- Adjustment/Refund Fields -->
						<td><?php echo $vl['return_credit_note_date']; ?></td>
						<td><?php echo $vl['return_credit_note_no']; ?></td>
						<td><?php echo $vl['return_credit_note_amount']; ?></td>
						<td><?php echo $vl['return_credit_note_comment']; ?></td>
						<td><?php echo $vl['original_reference_date']; ?></td>
						<td><?php echo $vl['original_reference_no']; ?></td>
						<td><?php echo $vl['non_pkg_adj_date']; ?></td>
						<td><?php echo $vl['non_pkg_adj_amt']; ?></td>
						<td><?php echo $vl['non_pkg_adj_comment']; ?></td>
						<td><?php echo $vl['other_adj_date']; ?></td>
						<td><?php echo $vl['other_adj_amt']; ?></td>
						<td><?php echo $vl['other_adj_comment']; ?></td>
						<td><?php echo $vl['balance_2024_25']; ?></td>
						<td><?php echo $vl['balance_2025_26']; ?></td>
						<td><?php echo $vl['refund_date']; ?></td>
						<td><?php echo $vl['refund_amount']; ?></td>
						<td><?php echo $vl['total_outstanding']; ?></td>
                    </tr>
                  <?php $count++;} ?>
				   <tr>
                <td colspan="7">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
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
			box-shadow: 0px 0px 3px 0px #000;
			display:none;
		}
		.pop_lable {
			width: 100%;
			color: #000!important;
			font-weight: 800;
			font-size: 15px;
			margin-bottom: 10px!important;
		}
		.disapprove_pop_inner {
			width: 50%;
			margin: 80px 25%;
			float:left;
			box-shadow: 0px 0px 10px 0px #000;
			background: #fff;
		}
		a.close_disapprove {
			float: right;
			margin-top: 10px;
		}
		a.now_disapprove.btn.btn-large {
			margin: 10px 0px;
		}
	</style>
<script>
      $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var data = {appointment_date:startDate, type:'particular_date_filter'};
          }
        });
    });
</script>
<style >
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