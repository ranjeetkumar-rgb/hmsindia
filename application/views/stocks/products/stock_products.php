<?php $all_method =&get_instance(); ?>
<div class="col-md-12">
  <div class="card">
    <div class="card-action"><h3> Product Lists </h3></div>
      <div class="clearfix"></div>
    <div class="clearfix"></div>
    <div class="card-content">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataList" id="">
          <thead>
            <tr>
              <th>Name</th>
              <th>Type</th>
              <th>Consumption Unit</th>
              <th>Assign Brands</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="table_content">
          <?php foreach($data as $ky => $vl){ ?>
            <tr class="odd gradeX">
              <td><?php echo $vl['name']?>- <?php echo $vl['batch_number']?></td>
              <td><?php echo $vl['type']?></td>
              <td><?php echo $vl['consumption_unit']?></td>
              <td><a href="<?php echo base_url();?>product-brands/<?php echo $vl['ID']?>" class="btn btn-primary">Assign Brands</a></td>
              <td><a href="<?php echo base_url();?>edit-product?id=<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a><!-- <a href="<?php echo base_url();?>stocks/delete?item_number=<?php echo $vl['item_number']?>" class="delete"><i class="material-icons">delete</i></a>--></td> 
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--End Advanced Tables -->
</div>