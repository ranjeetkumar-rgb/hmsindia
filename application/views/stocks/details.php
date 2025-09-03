<?php $all_method =&get_instance(); ?>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
}
</style>
<div class="col-sm-12 col-xs-12  panel panel-piluku ml-5">
  <div class="panel-body profile-edit">
	<h3>Item Details</h3>
    <hr />
<table style="width:100%">
  <tr>
    <th>Category :</th>
    <td><?php echo $all_method->get_category_name($data['category']);?></td>
  </tr>
  <tr>
    <th>Item number :</th>
    <td><?php echo $data['item_number'];?></td>
  </tr>
  <tr>
    <th>Item name :</th>
    <td><?php echo $data['item_name'];?></td>
  </tr>
  <tr>
    <th>Company :</th>
    <td><?php echo $data['company'];?></td>
  </tr>
  <tr>
    <th>Brand :</th>
    <td><?php echo $all_method->get_brand_name($data['brand_name']);?></td>
  </tr>
  <tr>
    <th>Quantity :</th>
    <td><?php echo $data['quantity'];?> (units)</td>
  </tr>
  
  <tr>
    <th>Safety stock :</th>
    <td><?php echo $data['safety_stock'];?> (units)</td>
  </tr>
  <tr>
    <th>Order Quantity. :</th>
    <td><?php echo $data['order_qty'];?> (units)</td>
  </tr>
  <tr>
    <th>MRP :</th>
    <td><i class="fa fa-inr" aria-hidden="true"></i><?php echo $data['price'];?></td>
  </tr>
  <tr>
    <th>Expiry :</th>
    <td><?php echo $data['expiry'];?></td>
  </tr>
  
  <tr>
    <th>Expiry nofification :</th>
    <td><?php echo strtoupper($data['expiry_day']);?></td>
  </tr>
  <tr>
    <th>Add date :</th>
    <td><?php echo $data['add_date'];?></td>
  </tr>
  <tr>
    <th>Last Updated date :</th>
    <td><?php echo $data['update_date'];?></td>
  </tr>
</table>
</div>
</div>