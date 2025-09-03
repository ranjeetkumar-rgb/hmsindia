<?php
if(isset($_POST['submit'])){
     
      $iic_idArr  = $_POST['iic_id'];
	  $wife_nameArr  = $_POST['wife_name'];
      $wife_phoneArr  = $_POST['wife_phone'];
	  $freezingArr  = $_POST['freezing'];
	  $remainingArr  = $_POST['remaining'];
	 
	 

   if(!empty($iic_idArr)){
        for($i = 0; $i < count ($iic_idArr); $i++){
            if(!empty($iic_idArr[$i])){
                $iic_id = $iic_idArr[$i];
                $wife_name = $wife_nameArr[$i];
                $wife_phone = $wife_phoneArr[$i];
                $freezing = $freezingArr[$i];
                 $remaining = $remainingArr[$i];
            echo   $sql="INSERT INTO freezing (iic_id, wife_name, wife_phone, freezing, remaining)  Values('".$iic_id."','".$wife_name."','".$wife_phone."','".$freezing."','".$remaining."')";
 $result = run_form_query($sql); 
if ($result) 
{ 
    echo "New record created successfully";
 }
  else
 {
     echo 'Record not successfully';
 }
  }   
    }
       }	
} 

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container"> 
   <form method="post">
                        <div class="row">
                                    <div class="col-lg-12 col-12">
         <table class="table table-bordered table-hover" id="tab_logicQual">
            <thead>
               <tr >
                  <th class="text-center">
                     #
                  </th>
                  <th class="text-center">
                     Degree<span class="str"><font color="red">*</font></span>
                  </th>
                  <th class="text-center">
                     Subject<span class="str"><font color="red">*</font></span>
                  </th>
                  <th class="text-center">
                     College/University<span class="str"><font color="red">*</font></span>
                  </th>
                  <th class="text-center">
                     Year of Passing<span class="str"><font color="red">*</font></span>
                  </th>
                  <th class="text-center">
                     Percentage/Grade<span class="str"><font color="red">*</font></span>
                  </th>
               </tr>
            </thead>
            
            <tbody>
               <tr id='addrQual0'>
                  <td>
                  1
                  </td>
               
                  <td>
                      <input placeholder="Patient Name" id="iic_id[]" value="<?php echo $res_val->iic_id; ?>" name="iic_id[]" type="text" class="form-control">
        </td>
                  <td>
                     <input placeholder="Patient Name" id="wife_name[]" value="<?php echo $res_val->wife_name; ?>" name="wife_name[]" type="text" class="form-control">
         </td>
                  <td>
                      <input placeholder="Phone" id="wife_phone[]" value="<?php echo $res_val->wife_phone; ?>" name="wife_phone[]" type="text" class="form-control">
        </td>
                  <td>
                     <input placeholder="Freezing" id="freezing[]" value="<?php echo $res_val->freezing; ?>" name="freezing[]" type="text" class="form-control">
         </td>
                  
                  <td>
                     <input placeholder="Remaining" id="remaining[]" value="<?php echo $res_val->remaining; ?>" name="remaining[]" type="text" class="form-control">
         </td>
               
                 
               
               </tr>
                    <tr id='addrQual1'></tr>
            </tbody>
            
         
         </table>
      

      <a id="add_row2" class="btn btn-primary pull-left" style=" background-color: #0d469b; color: white; padding: 3px 8px; text-align: center;display: inline-block; font-size: 16px;cursor: pointer;">Add More</a>   <a id='delete_row2' class="pull-right btn btn-primary" style="background-color: #0d469b; color: white; padding: 3px 8px; text-align: center;display: inline-block; font-size: 16px;cursor: pointer; float: right;">Remove</a>
          
               <div class="clearfix"></div>
               
      </div>   

      <div class="text-center">
                                <input type="submit" name="submit" class="btn btn-primary btn-marketing mt-4" value="Submit" onClick="return encrypt()">
         </form>                            </div>
</div>
      <script>
 $(document).ready(function(){
    var i=1;
   $("#add_row2").click(function(){
    $('#addrQual'+i).html("<td>"+ (i+1) +"</td><td><input name='iic_id["+i+"].iic_id' type='text' placeholder='Qualification' class='form-control input-md'/> </td><td><input  name='wife_name["+i+"].wife_name' type='text' placeholder='Subject'  class='form-control input-md'></td><td><input  name='wife_phone["+i+"].wife_phone' type='text' placeholder='College'  class='form-control input-md'></td><td><input  name='freezing["+i+"].freezing' type='text' placeholder='Passing Year'  class='form-control input-md'></td><td><input  name='remaining["+i+"].remaining' type='text' placeholder='Grade/Percentage'  class='form-control input-md'></td>");

    $('#tab_logicQual').append('<tr id="addrQual'+(i+1)+'"></tr>');
    i++; 
});
   $("#delete_row2").click(function(){
      if(i>1){
       $("#addrQual"+(i-1)).html('');
       i--;
       }
    });

}); 
</script>
