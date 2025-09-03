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
        <div class="card-action"><h3> Procedure Forms </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Form</th>
                  <th>For</th>
                  <th>Status</th>
				  <th>Action</th>
				</tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo ucfirst(strtolower(str_replace("_", " ", $vl['form_name']))); ?></td>
                  <td><?php echo ucfirst(strtolower(str_replace("_", " ", $vl['form_for']))); ?></td>
				  <td><?php echo ucfirst(strtolower(str_replace("_", " ", $vl['status']))); ?></td>
                  <td><a href="<?php echo base_url();?>procedures/edit_form?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a></td>
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