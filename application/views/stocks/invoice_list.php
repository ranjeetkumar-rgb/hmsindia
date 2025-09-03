  <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <div class="row" style="margin-bottom:20px;">
         <div class="col-md-12"><h3>Vendor Invoice </h3></div>
      <div class="clearfix"></div>
        <form action="<?php echo base_url().'stocks/invoice_list'; ?>" method="get">
		   <div class="col-sm-3 col-xs-12" style="margin-top:10px;">
            	<label>IIC ID </label>
                <input type="text" class="form-control" id="invoice_no" name="invoice_no" value="<?php echo $invoice_no;?>" />
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<button name="btnsearch" id="btnsearch" type="submit"  class="btn btn-primary">Search</button>
            </div>
            <div class="col-sm-1" style="margin-top: 10px;">
            	<a href="<?php echo base_url().'stocks/invoice_list'; ?>" style="text-decoration: none;">
                <button name="btnreset" id="btnreset" type="button"  class="btn btn-secondary">RESET</button>
               </a>
            </div>
            </form>
        </div>
         <div class="clearfix"></div>
        <div class="card-content">

          <div class="table-responsive">

            <table class="table table-striped table-bordered table-hover" id="investigation_billing_list">

              <thead>

                <tr>

				  <th>S.No.</th>

                  <th>Invoice No</th>

                  <th>No Of Item</th>

                  <th>Invoice Total Amount</th>

                  <th>Invoice Date</th>

                  <th>Invoice Add Date</th>
				  
				</tr>

              </thead>

              <tbody id="invoice_result">

              <?php foreach($invoice_result as $ky => $vl){ ?>

                <tr class="odd gradeX">

                  <td><?php echo $vl['ID']; ?></td>
                  <td><?php echo $vl['invoice_no'];?></td>
                  <td><?php echo $vl['no_of_item']; ?></td>
				  <td><?php echo $vl['Total_amount']; ?></td>
				  <td><?php echo $vl['invoice_date']; ?></td>				  
				  <td><?php echo $vl['add_date']; ?></td>
                </tr>

              <?php $count++; } ?>
			   <tr>
                <td colspan="11">
                <p class="custom-pagination"><?php echo $links; ?></p>
                </td>
              </tr>

              </tbody>

            </table>

          </div>

        </div>

      </div>

       <!--End Investigation Tables -->


      <!--End Advanced Tables -->

	   
    </div>

<script>
     

      $( function() {
        $( ".particular_date_filter" ).datepicker({
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
          changeYear: true,
          onSelect: function(dateStr) {
            $('#loader_div').hide();				
            var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
            var data = {appointment_date:startDate, type:'particular_date_filter'};
          }
        });
    });

      
     
</script>
<style >
.custom-pagination{
  padding:8px;
}
.custom-pagination a{
  padding:10px;
  text-decoration: none;
}
.form-control{
  height: 30px!important;
  border: 1px solid #9e9e9e!important;
}
.form-control#billing_at{
  height: 40px!important;
  border: 1px solid #9e9e9e!important;
}
</style>