 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Procedures Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>Procedure</th>
                  <th>Code</th>
                  <th>Parent</th>
                  <th>Price (Rupee)</th>
                  <th>Price (USD)</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['procedure_name']?></td>
                  <td><?php echo $vl['code']?></td>
                  <td><?php if($vl['parent_id'] == 0){echo '';}else{ $procedure_parent = $all_method->get_parent_procedure($vl['parent_id']); echo $procedure_parent['procedure_name'];} ?></td>
                  <td><?php echo '<i class="fa fa-inr" aria-hidden="true"></i> '.$vl['price']?></td>
                  <td><?php echo '<i class="fa fa-usd" aria-hidden="true"></i> '.$vl['usd_price']?></td>
                  <td><?php if($vl['status'] == '1'){echo "Active";}else{echo "Inactive"; } ?></td>
                  <td><a href="<?php echo base_url();?>procedures/edit?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a> <a href="<?php echo base_url();?>procedures/delete?id=<?php echo $vl['ID']?>" class="delete"><i class="material-icons">delete</i></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>