<table width="600">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
<tr>
<td width="20%">Select file</td>
<td width="80%"><input type="file" name="csv" id="file" /></td>
</tr>
<tr>
<td>Submit</td>
<td><input type="submit" name="submit" /></td>
</tr>
</form>
</table>

<?php

$conn = mysqli_connect("localhost","indiaivftest_hmsivfusr" ,"cJ0xpKfqVY","indiaivftest_hmsivf");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// $product_result = mysqli_query($conn, "SELECT id FROM hms_stock_products ORDER BY ID ASC");
// while($row = mysqli_fetch_row($product_result))
// {
//     //echo $row[0]."<br/>";  
//     $product_id = $row[0];
//     $product_data_result = mysqli_query($conn, "SELECT brand_number FROM hms_product_vendors where product_id='$product_id' ORDER BY ID ASC");
//     while($prdct_row = mysqli_fetch_row($product_data_result))
//     {
//         //var_dump($prdct_row);die;
//         echo $prdct_row[0]."<br/>";  
//     }
// }die;


if ( isset($_POST["submit"]) ) {
    if ( isset($_FILES["csv"])) { 
             //if there was an error uploading the file
         if ($_FILES["csv"]["error"] > 0) {
             echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
          }
         else {
                $csv = array();
                $name = $_FILES['csv']['name'];
                $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
                $type = $_FILES['csv']['type'];
                $tmpName = $_FILES['csv']['tmp_name'];

                // check the file is a csv
                if($ext === 'csv'){
                    if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                        // necessary if a large csv file
                        set_time_limit(0);
                        $row = 0;
                        $product_arr = $brand_arr = array();
                        while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                            // number of fields in the csv
                            $col_count = count($data);
                            $sql_txt = "";
                            $product_id = $data[0];
                            $item = $data[1];
                            $category = $data[2];
                            $safty = $data[3];
                            $vendor = "16139738473495";
                            $expiry = date("Y-m-d", strtotime($data[4]));
                            $expiry_notify = date("Y-m-d", strtotime( date( "Y-m-d", strtotime($data[4]) ) . "-1 month" ) );
                            $batchnumber = $data[5];
                            $quantity = $data[6];
                            $order_unit = $data[7];
                            $unit_price = "";
                            
                            $product_data_result = mysqli_query($conn, "SELECT * FROM hms_product_vendors where product_id='$product_id' ORDER BY ID ASC");
                            $prdct_row=mysqli_fetch_assoc($product_data_result);
                            $vendor_price = $prdct_row['price'];
                            $vendor_units = $prdct_row['units'];
                            $brandname = $prdct_row['brand_number'];
                            
                            $percent = ($vendor_price / $vendor_units);
                            $unit_price = round($percent * $quantity, 2);
                            
                            $sql_txt = "INSERT INTO `hms_stocks`(`item_number`, `product_id`, `item_name`, `batch_number`, `brand_name`,`quantity`, `safety_stock`, `order_qty`, `category`, `price`, `vendor_number`, `expiry`, `expiry_day`, `add_date`)
                            VALUES ('".getGUID()."', '$product_id', '$item', '$batchnumber', '$brandname', '$quantity', '$safty', '$order_unit', '$category', '$unit_price', '$vendor', '$expiry', '$expiry_notify', '".date("Y-m-d H:i:s")."');";
                            
                            echo $sql_txt."<br/><br/>";
                            
                            // $product_id = $brand_id = 0;
                            // // get the values from the csv
                            // $product = $data[0];
                            
                            // $product_result = mysqli_query($conn, "SELECT ID FROM hms_stock_products where name like '%".trim($product)."%'  ORDER BY ID DESC LIMIT 1");
                            // $product_num_rows = mysqli_num_rows($product_result);
                            // //var_dump($product_num_rows);
                            // $sql_txt = "INSERT INTO `hms_product_vendors` (`product_id`, `brand_number`, `vendor_number`, `price`, `units`, `status`)";
                            //   while($row = mysqli_fetch_row($product_result))
                            //   {
                            //       $product_id = $row[0];
                            //         $product_arr[] = $row[0];
                            //   }
                              
                            // $brand = $data[1];
                            // $brand_result = mysqli_query($conn, "SELECT brand_number FROM hms_brands where name like '%".trim($brand)."%'  ORDER BY ID DESC LIMIT 1");
                            // $brand_num_rows = mysqli_num_rows($brand_result);
                            // //var_dump($brand_num_rows);
                            //   while($row = mysqli_fetch_row($brand_result))
                            //   {
                            //       $brand_id = $row[0];
                            //         $brand_arr[] = $row[0];
                            //   }
                            // $price = $data[2];
                            // $price = str_replace(',', '', $price);
                            // $sql_txt .= " VALUES ('$product_id', '$brand_id', '16139738473495', '$price', '50', '1');";
                            
                            
                            // inc the row
                            $row++;
                        }
                        // var_dump($product_arr); echo "<br/><br/>";
                        // var_dump($brand_arr);die;
                        fclose($handle);
                    }
                }
            }
      } else {
              echo "No file selected <br />";
      }
 }

function getGUID(){		
    $date = date("Y-m-d H:i:s");
    $date = strtotime($date).rand(0, 9999);
    return $date;
}