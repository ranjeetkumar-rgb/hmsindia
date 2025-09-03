 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <style>
    	a#upload_procedures {
			text-align: right;
			width: 100%;
			display: block;
		}
		
		#upload_procedures {
			color: #000;
			text-decoration: none;
		}
    </style>
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Package Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Package Name</th>
				  <th>Procedure Name</th>
                  <th>Code</th>
                  <th>Price (Rupee)</th>
                  <th>Status</th>
			      <th>Action</th>
			    </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['package_name']?></td>
				  <td><?php echo $vl['procedure_id']?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['price']; ?></td>
                  <td><?php echo '<i class="fa fa-usd" aria-hidden="true"></i> '.$vl['usd_price']?></td>
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
				  <td><a href="<?php echo base_url();?>procedures/edit_package?package_id=<?php echo $vl['package_id']?>" class="edit"><i class="material-icons">edit</i></a></td>
				</tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
    
     <script>
		$( "#upload_procedures" ).click(function() {
		  $( ".show_upload" ).toggle( "slow", function() {
			// Animation complete.
		  });
		});
    </script>