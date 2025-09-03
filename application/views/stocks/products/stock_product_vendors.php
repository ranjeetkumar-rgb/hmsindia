<?php $all_method =&get_instance(); ?>
<div class="col-md-12">  
<div class="card">
    <div class="card-action"><h3> Product Vendors </h3></div>
      <div class="clearfix"></div>
    <div class="card-content">      
      <a href="<?php echo base_url();?>assign-vendor" class="btn btn-primary pull-right">Assign Vendor</a>
      <div class="clearfix"></div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataList" id="">
          <thead>
            <tr>
              <th>Product</th>
              <th>Brand</th>
              <th>Vendor</th>
              <th>Product Id</th>
			  <th>Price</th>
              <th>Unit</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="table_content">
          <?php foreach($data as $ky => $vl){ ?>
            <tr class="odd gradeX">
              <td><?php echo $all_method->get_product_name($vl['product_id']); ?></td>
              <td><?php echo $all_method->get_brand_name($vl['brand_number']);?></td>
              <td><?php echo $all_method->get_vendor_name($vl['vendor_number']); ?></td>
              <td><?php echo $vl['product_id']; ?></td>
			  <td><?php echo $vl['price']?></td>
              <td><?php echo $vl['units']?></td>
              <td><a href="<?php echo base_url();?>edit-product-vendor/<?php echo $vl['ID']?>" class="edit"><i class="material-icons">edit</i></a></td> 
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--End Advanced Tables -->
</div>