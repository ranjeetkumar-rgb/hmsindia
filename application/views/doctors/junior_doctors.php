<?php $all_method =&get_instance(); ?>
<div class="col-md-12">
  <!-- Advanced Tables -->
  <div class="card">
    <div class="card-action"><h3> Junior Doctors Lists </h3></div>
    <div class="col-sm-12 col-xs-12">
        <a href="<?php echo base_url('junior-doctors/add'); ?>" class="btn btn-primary pull-right">Add Junior Doctor</a>
    </div>
    <div class="clearfix"></div>
    <div class="card-content">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataList" id="">
          <thead>
            <tr>
              <th>Name</th>
              <th>Assigned To Doctors</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($data as $ky => $vl){?>
            <tr class="odd gradeX">
              <td>
                <?php echo 'Dr. '.strtoupper($vl['name']); ?>
              </td>
              <td><?php $doctors = get_doctors_relationship($vl['ID']);
                      foreach($doctors as $key => $val){
                          $doctor_details = doctor_details($val);
                          echo strtoupper($doctor_details['name']).' ('.strtoupper(get_center_name($doctor_details['center_id'])).')<br/>';
                      }
                  ?>
              </td>
              <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
              <td><a href="<?php echo base_url();?>junior-doctors/edit?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a> <a href="<?php echo base_url();?>junior-doctors/delete?id=<?php echo $vl['ID']?>" class="delete"><i class="material-icons">delete</i></a></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--End Advanced Tables -->
</div>