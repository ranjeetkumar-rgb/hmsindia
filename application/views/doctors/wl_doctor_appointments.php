<style>

  h4.error {

    color: red;

  }

  h4.success {

    color: #518e41;

  }

  .panel-heading {

      width: 100%;

      float: left;

  }

  #profile_data .form-group .form-control {

    border-bottom: 1px solid #000;

    padding: 0 15px;

  }

  img.img_show {

    max-width: 100%;

    max-height: 200px;

  }

  input#search_patient {

    background: #2b982b !important;

    color: #fff;

    border-radius: 10px;

  }

  body.login-page.ls-closed {

    max-width: 1000px!important;

    padding: 0px 15px;

  }

  .form-group.col-sm-6.col-xs-12 {

    width: 50%;

  }

  .form-group.col-sm-1.col-xs-12 {

    width: 12%;

    float: left;

  }.form-group.col-sm-4.col-xs-12 {

    width: 33.33%;

    float: left;

  }

  @media only screen and (max-width: 600px) {

    .form-group.col-sm-6.col-xs-12 {

      width: 100%;

  }

  .form-group.col-sm-1.col-xs-12 {

      width: 100%;

      float: left;

  }.form-group.col-sm-4.col-xs-12 {

      width: 100%;

      float: left;

  }

  }

</style>

<?php $all_method =&get_instance(); ?>

<form class="col-sm-12 col-xs-12" id="profile_data" method="post" action="" enctype="multipart/form-data" >

  <input type="hidden" name="action" value="wl_doctor_appointments" />

  <div class="row">

    <div class="col-sm-12 col-xs-12 panel panel-piluku">

      <div class="panel-heading">

        <div class="form-group col-sm-6 col-xs-12">

          <h3 class="heading">Doctor Appointment's</h3>

        </div>

        <div class="form-group col-sm-6 col-xs-12">

          <?php if(isset($_GET['m']) && !empty($_GET['m'])){?>

              <h4 class="update_msg <?php echo base64_decode($_GET['t']); ?>"><?php echo base64_decode($_GET['m']); ?></h4>

          <?php } ?>

        </div>



      </div>

      <div class="panel-body profile-edit">

        <p id="msg_area" class="delete"></p>

        <p>

        <div class="row">

          <div class="form-group col-sm-4 col-xs-12">

            <input value="" required placeholder="Doctor Username" id="doctor_username" name="doctor_username" type="text" class="form-control validate" >

          </div>
          
          <div class="form-group col-sm-4 col-xs-12">

            <input value="" appointment="off" placeholder="Appointment Date, Leave empty for all appointments" id="particular_date_filter" name="appointment_date" type="text" class="form-control date validate" >

          </div>

          

          	<div class="form-group col-sm-3 col-xs-12">

                <input value="Submit" id="search_patient" type="submit" class="form-control validate" >

            </div>

        </div>        

        <hr/>        

        <div id="add_section">
        <div class="row">
          <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataList" id="doctor_appointments">
                <thead>
                  <tr>
                    <th>S. No.</th>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Slot</th>
                    <th>Reason of visit</th>
                    <!-- <th>Investigation Reports</th>
                    <th>Procedure Reports</th> -->
                  </tr>
                </thead>
                <tbody id="appointment_body">
                <?php $count = 1; if($appointments) { foreach($appointments as $ky => $vl){ ?>
                  <?php $patient_id = get_patient_by_number($vl['wife_phone']); ?>
                  <tr class="odd gradeX">
                    <td><?php echo $count; ?></td>
                    <td> 
                      <?php echo $vl['wife_name']; ?>
                    </td>
                    <td><?php echo $vl['appoitmented_date']?></td>
                    <td><?php echo $vl['appoitmented_slot']?></td>
                    <td><?php echo $vl['reason_of_visit']?></td>                  
                  </tr>
                <?php $count++; } }else{ ?>
                  <tr class="odd gradeX">
                    <td colspan="5">No Appointment Today!</td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>       

          </div>
        </div>
      </p>
    </div>
  </div>
</form>

