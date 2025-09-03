 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Vendor Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Vendor number</th>
                  <th>Name</th>
				  <th>GST</th>
				  <th>Drug License</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><a href="<?php echo base_url('vendors/details/'.$vl['ID']); ?>"><?php echo $vl['vendor_number'];?></a></td>
                  <td><?php echo $vl['name'];?></td>
				  <td><a href="<?php echo $vl['gst_number'];?>" target="_blank">Download</a></td>
				  <td><a href="<?php echo $vl['drug_license_number'];?>" target="_blank">Download</a></td>
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><a href="<?php echo base_url();?>vendors/edit?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a> 
                  	  <a href="<?php echo base_url();?>vendors/delete?id=<?php echo $vl['ID']?>" class="delete"><i class="material-icons">delete</i></a>
                  </td>
				  
				</tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>