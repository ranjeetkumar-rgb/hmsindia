    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Categories Lists </h3></div>
        <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Category number</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="table_content">
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['category_id']?></td>
                  <td><?php echo $vl['name']?></td>
                    <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><a href="<?php echo base_url();?>stocks/edit_category?i=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a> <!--<a href="<?php echo base_url();?>stocks/delete_category?i=<?php echo $vl['ID']?>" class="delete"><i class="material-icons">delete</i></a>--></td>
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
		$( "#upload_stock" ).click(function() {
		  $( ".show_upload" ).toggle( "slow", function() {
			// Animation complete.
		  });
		});
    </script>