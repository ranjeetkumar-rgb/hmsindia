

  <form class="col-sm-12 col-xs-12" method="post" action="" >

    <input type="hidden" name="action" value="add_single_product" />

    <div class="row">

      <div class="col-sm-12 col-xs-12 panel panel-piluku">

        <div class="panel-heading">

          <h3 class="heading">Add Product</h3>

        </div>

        <div class="panel-body profile-edit">

          <p>

          <div class="row">

            

          <div class="form-group col-sm-6 col-xs-12">

              <label for="item_name">Product Name (Required)</label>

             <select id="name" name="name" class="select2 form-control" required>
                    <option value="">-- Select --</option>
              	<?php foreach($medicines as $key => $value){ ?>
                	<option value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option>
                <?php } ?>
                </select>

            </div>



            <div class="form-group col-sm-6 col-xs-12">

                  <label for="quantity">Product Type (Required)</label>

                  <div class="clearfix"></div>

                  <select class="form-control" name="type" id="type" required>
                      <option value="">-- Select --</option>
                      <option value="Capsule" mode="solid">Capsule</option>
                      <option value="Injection" mode="liquid">Injection</option>
                      <option value="Tablet" mode="solid">Tablet</option>
                      <option value="Cyrup" mode="liquid">Syrup</option>
                      <option value="Gel" mode="liquid">Gel</option>
                      <option value="Ointment" mode="liquid">Ointment</option>
                      <option value="Powder" mode="solid">Powder</option>
                      <option value="Sachet" mode="solid">Sachet</option>
                      <option value="Suppository" mode="solid">Suppository</option>
                      <option value="Pessery" mode="solid">Pessery</option>
                      <option value="Cannula" mode="solid">Cannula</option>
                      <option value="Media and Consumables" mode="liquid">Media and Consumables</option>
                      <option value="Consumables" mode="solid">Consumables</option>
                  </select>

            </div>

          </div>       

          

            <div class="row">

                <div class="form-group col-sm-6 col-xs-12">

                      <label for="expiry">Consumption unit (Required) <span id="type-msg" style="display:none;color:#fff; padding:0px 10px; border-radius:5px; background:#FF3E43">asdasdasd</span></label>

                      <input value="" placeholder="Consumption unit" id="consumption_unit" name="consumption_unit" type="number" class="form-control validate" required>

                    </div>
					
					<div class="form-group col-sm-6 col-xs-12">

                      <label for="expiry">Batch Number</label>

                      <input value="" placeholder="Batch Number" id="batch_number" name="batch_number" type="text" class="form-control validate" required>

                    </div>

                </div>

            </div>

          

        <div class="clearfix"></div>

        <div class="form-group col-sm-12 col-xs-12">

          <input type="submit" id="submitbutton" class="btn btn-large" value="Submit" />

        </div>

        </p>

      </div>

    </div>

  </form>





<script>

  $( "#type" ).change(function() {

    $("span#type-msg").hide();

    $("span#type-msg").empty();

    var type_mode = $( "#type :selected" ).attr("mode");

    if(type_mode == "solid"){

        $("span#type-msg").empty().append("(1 Unit)");

        $("span#type-msg").show();

    }else if(type_mode == "liquid"){

      $("span#type-msg").empty().append("(1 Unit/ml)");

      $("span#type-msg").show();

    }

});

$(function(){
	  // turn the element to select2 select style
	  $('.select2').select2({
		placeholder: "Select stock item."
	  }).on('change', function(e) {
		var data = $(".select2 option:selected").val();
			
	  });
	
});

</script>