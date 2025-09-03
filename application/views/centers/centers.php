    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action clearfix">
          <h3 class="pull-left"> Centers Lists </h3>
          <div class="pull-right">
            <a href="<?php echo base_url();?>centers/hub_spoke" class="btn btn-success">Hub-Spoke Management</a>
            <a href="<?php echo base_url();?>camps" class="btn btn-info">Manage Camps</a>
            <a href="<?php echo base_url();?>centers/add" class="btn btn-primary">Add Center</a>
          </div>
        </div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Center ID</th>
                  <th>Center Name</th>
                  <th>Center Type</th>
                  <th>GST Status</th>
                  <th>Center Classification</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['center_number']?></td>
                  <td><?php echo $vl['center_name']?></td>
                  <td><?php echo $vl['type']?></td>
                  <td><?php if($vl['gst'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><?php if($vl['center_classification'] == 'hub'){echo "Hub";}else{echo "Spoke"; } ?></td>
                    <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><a href="<?php echo base_url();?>centers/edit?center_number=<?php echo $vl['center_number']?>" class="edit"><i class="material-icons">edit</i></a> <a href="<?php echo base_url();?>centers/delete?center_number=<?php echo $vl['center_number']?>" class="delete"><i class="material-icons">delete</i></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>