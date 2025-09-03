<?php //var_dump($data);die;?>

  <form class="col-sm-12 col-xs-12" method="post" action="" >

    <input type="hidden" name="action" value="update_products" />

    <input type="hidden" name="ID" value="<?php echo $data['ID']; ?>" />

    <div class="row">

      <div class="col-sm-12 col-xs-12 panel panel-piluku">

        <div class="panel-heading">

          <h3 class="heading">Edit Product</h3>

        </div>

        <div class="panel-body profile-edit">

          <p>

          <div class="row">

          <div class="form-group col-sm-6 col-xs-12">

              <label for="item_name">Product Name (Required)</label>

              <input value="<?php echo $data['name']?>" placeholder="Product name" id="name" name="name" type="text" class="form-control validate" required>

            </div>



            <div class="form-group col-sm-6 col-xs-12">

                  <label for="quantity">Product Type (Required)</label>

                  <div class="clearfix"></div>

                  <select class="form-control" name="type" id="type" required>

                      <option value="">-- Select --</option>

                      <option value="Capsule" <?php if($data['type'] == "Capsule"){echo 'selected="selected"'; }?> mode="solid">Capsule</option>

                      <option value="Injection" <?php if($data['type'] == "Injection"){echo 'selected="selected"'; }?> mode="liquid">Injection</option>

                      <option value="Tablet" <?php if($data['type'] == "Tablet"){echo 'selected="selected"'; }?> mode="solid">Tablet</option>

                      <option value="Cyrup" <?php if($data['type'] == "Cyrup"){echo 'selected="selected"'; }?> mode="liquid">Cyrup</option>

                      

                      <option value="Gel" <?php if($data['type'] == "Gel"){echo 'selected="selected"'; }?> mode="liquid">Gel</option>

                      <option value="Ointment" <?php if($data['type'] == "Ointment"){echo 'selected="selected"'; }?> mode="liquid">Ointment</option>

                      <option value="Powder" <?php if($data['type'] == "Powder"){echo 'selected="selected"'; }?> mode="solid">Powder</option>

                      <option value="Sachet" <?php if($data['type'] == "Sachet"){echo 'selected="selected"'; }?> mode="solid">Sachet</option>

                      <option value="Suppository" <?php if($data['type'] == "Suppository"){echo 'selected="selected"'; }?> mode="solid">Suppository</option>

                      <option value="Pessery" <?php if($data['type'] == "Pessery"){echo 'selected="selected"'; }?> mode="solid">Pessery</option>
                      <option value="Cannula" <?php if($data['type'] == "Cannula"){echo 'selected="selected"'; }?> mode="solid">Cannula</option>
                      
                      <option value="Media and Consumables" <?php if($data['type'] == "Media and Consumables"){echo 'selected="selected"'; }?> mode="liquid">Media and Consumables</option>
                      <option value="Consumables" <?php if($data['type'] == "Consumables"){echo 'selected="selected"'; }?> mode="solid">Consumables</option>

                  </select>

            </div>

          </div>       

          

            <div class="row">

                <div class="form-group col-sm-6 col-xs-12">

                      <label for="expiry">Consumption unit (Required) <span id="type-msg" style="display:none;color:#fff; padding:0px 10px; border-radius:5px; background:#FF3E43">asdasdasd</span></label>

                      <input value="<?php echo $data['consumption_unit']?>" placeholder="Consumption unit" id="consumption_unit" name="consumption_unit" type="number" class="form-control validate" required>

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

    var type_mode = $( "#type :selected" ).attr("mode");

    if(type_mode == "solid"){

        $("span#type-msg").empty().append("(1 Unit)");

        $("span#type-msg").show();

    }else if(type_mode == "liquid"){

      $("span#type-msg").empty().append("(1 Unit/ml)");

      $("span#type-msg").show();

    }

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

</script>