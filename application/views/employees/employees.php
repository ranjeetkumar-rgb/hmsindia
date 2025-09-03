 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Employees Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Employee Number</th>
                  <th>Username</th>
                  <th>Employee Name</th>
                  <th>Employee Center</th>
                  <th>Department</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['employee_number']?></td>
                  <td><?php echo $vl['username']?></td>
                  <td><?php echo $vl['name']?></td>
                  <td><?php if($vl['center_id'] == 0){echo 'IndiaIVF';}else{ $center = $all_method->get_center($vl['center_id']); if(isset($center['center_name'])){echo $center['center_name'];}else{echo 'No center assigned';}} ?></td>
                  <td><?php if($vl['role'] == "accountant"){echo "Accountant";}
                            if($vl['role'] == "stock_manager"){echo "Stock manager";}
                            if($vl['role'] == "billing_manager"){echo "Billing manager";}
                            if($vl['role'] == "central_stock_manager"){echo "Central stock manager";}
                            if($vl['role'] == "embryologist"){echo "Embryologist";}
                            if($vl['role'] == "investigator_manager"){echo "Investigation manager";}
                            if($vl['role'] == "telecaller"){echo "Telecaller";}
                            ?>
                </td>
                  <td><?php echo $vl['phone']?></td>
                  <td><?php echo $vl['email']?></td>
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><a href="<?php echo base_url();?>employees/edit?employee_number=<?php echo $vl['employee_number']?>" class="edit"><i class="material-icons">edit</i></a> <a href="<?php echo base_url();?>employees/delete?employee_number=<?php echo $vl['employee_number']?>" class="delete"><i class="material-icons">delete</i></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>