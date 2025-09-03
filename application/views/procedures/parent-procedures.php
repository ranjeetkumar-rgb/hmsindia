 <?php $all_method =&get_instance(); ?>
    <div class="col-md-12">
    <style>
    	a#upload_procedures {
			text-align: right;
			width: 100%;
			display: block;
		}
		
		#upload_procedures {
			color: #000;
			text-decoration: none;
		}
    </style>
      <!-- Advanced Tables -->
      <div class="card">
        <div class="card-action"><h3> Parent Procedures Lists </h3></div>
         <div class="clearfix"></div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataList" id="">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Procedure</th>
                  <th>Code</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($data as $ky => $vl){ ?>
                <tr class="odd gradeX">
                  <td><?php echo $vl['ID']?></td>
                  <td><?php echo $vl['procedure_name']?></td>
                  <td><?php echo $vl['code']?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>