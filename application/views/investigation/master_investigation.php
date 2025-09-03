 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
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
      <div class="card">
      	<div class="card-action stock_upload_box">
      	<a href="javascript:void(0)" id="upload_procedures" title="Upload stock"><i class="fa fa-upload  fa-lg" aria-hidden="true"></i> Upload Investigations</a>
        <div class="show_upload" style="display:none;">
        	<form method="post" action="" enctype="multipart/form-data">
   				<input type="hidden" name="upload_investigation" value="upload_investigation" />
        		<input type="file" name="investigation_list" class="up_file" required />
        		<input type="submit" value="Upload CSV file only" class="btn btn-primary up_btn" />
            </form>
            <a href="<?php echo base_url();?>assets/investigation_files/sample_investigation.csv" download>Download sample</a>
        </div>
      </div>
        <div class="card-action"><h3> Master Investigations Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Investigation</th>
                  <th>Code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['investigation_name']?></td>
                  <td><?php echo $vl['code']?></td>
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><a href="<?php echo base_url();?>investigation/edit_master?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a> </td>
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