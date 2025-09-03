<style>

	.table > thead > tr > th {

		vertical-align: top;

	}

	td {

		width: auto;

	}

	.border-field input.form-control {

		border: 1px solid;

		padding: 0;

	}

	[type="radio"]:checked+label:before, [type="radio"]:checked+label:after, [type="radio"]:not(:checked)+label:before, [type="radio"]:not(:checked)+label:after{display:none!important;}

	[type="radio"]:not(:checked), [type="radio"]:checked { position: relative!important;  left: 0!important; opacity: 1!important; }

	[type="radio"]:not(:checked)+label, [type="radio"]:checked+label{padding-left:0px!important; padding-right:5px!important;}

	.multiselect-container>li>a>label {

		padding: 4px 20px 3px 20px;

	}

	table#SOCIAl_DRUG_INTAKE_HISTORY td, #table_dentures td {

		width: 55%;

	}

	input[type="checkbox"] {

		position: relative!important;

		left: 2px!important;

		opacity: 1!important;

	}

	.open > .dropdown-menu {

		width: 350px;

		max-height: 300px;

		overflow: auto;

	}

	label.checkbox {

		color: #000;

	}

	.btn-group{

		max-width: 100%;

	}

	button.multiselect.dropdown-toggle.btn.btn-default {

		width: 100%;

		overflow:hidden;

	}

</style>

  <form class="col-sm-12 col-xs-12" method="post" action="" >

    <input type="hidden" name="action" value="assign_brands" />

    <div class="row">

      <div class="col-sm-12 col-xs-12 panel panel-piluku">

        <div class="panel-heading">

          <h3 class="heading">Assign Brands</h3>

        </div>

        <div class="panel-body profile-edit">

          <p>

          <div class="row">            

            <div class="form-group col-sm-6 col-xs-12">

              <label for="item_name">Product Name</label>

              <h3><?php echo $product['name']?></h3>

            </div>



            <div class="form-group col-sm-6 col-xs-12">

                  <label for="quantity">Brands (Required)</label>

                  <div class="clearfix"></div>

                  <select class="form-control multidselect_dropdown_2" multiple name="brands[]" id="brands" required>

                      <?php $product_brands_arr = array();

                        if(!empty($prodcut_brands)){

                          foreach($prodcut_brands as $key => $val){  

                            $product_brands_arr[] = $val['brand_number'];

                          }

                        }

                      if(!empty($brands)){

                        foreach($brands as $key => $val){  

                      ?>

                          <option value="<?php echo $val['brand_number']?>"><?php echo $val['name']?></option>

                        <?php } }?>

                  </select>

            </div>

          </div>

          <script type='text/javascript'>

						$('#brands').val(<?php echo json_encode($product_brands_arr); ?>);

					</script>

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

$(function() {

$('.multidselect_dropdown_2').multiselect({ includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		filterPlaceholder: 'Search for something...' });

});

</script>