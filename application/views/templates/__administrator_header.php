<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Dashboard</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/materialize/css/materialize.min.css" media="screen,projection" />
<!-- Bootstrap Styles-->
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" />
<!-- FontAwesome Styles-->
<link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet" />
<!-- Morris Chart Styles-->
<link href="<?php echo base_url();?>assets/css/morris/morris-0.4.3.min.css" rel="stylesheet" />
<!-- Custom Styles-->
<link href="<?php echo base_url();?>assets/css/custom-styles.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- jQuery Js -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<!-- Google Fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/Lightweight-Chart/cssCharts.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-multiselect.css">

<!-- TimePicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

</head>
<body>
<div id="wrapper">
<nav class="navbar navbar-default top-navbar" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    <a class="navbar-brand waves-effect waves-dark logo_section" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/IndiaIVFClinic_logo.png" /></a>
    <div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
  </div>
  <?php $notice = get_admin_notification(); ?>
  <ul class="nav navbar-top-links navbar-right">
    <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown4">
    	<?php if($notice['count'] > 0){
			echo '<span class="notice_count">'.$notice['count'].'</span>';
        } ?>
	    <i class="fa fa-bell fa-fw" aria-hidden="true"></i> <i class="material-icons right">arrow_drop_down</i></a>
    </li>
    <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b><?php echo $_SESSION['logged_administrator']['name']?></b> <i class="material-icons right">arrow_drop_down</i></a></li>
  </ul>
</nav>
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="<?php echo base_url('settings/'); ?>"><i class="fa fa-gear fa-fw"></i> Settings</a> </li>
  <li><a href="<?php echo base_url('password/'); ?>"><i class="fa fa-gear fa-fw"></i> Change Password</a> </li>
  <li><a href="<?php echo base_url(); ?>logout?r=<?php echo base64_encode('logged_administrator'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
</ul>
<ul id="dropdown4" class="dropdown-content dropdown-tasks w250 taskList">
  <?php //var_dump($notice);die;
		if($notice['count'] > 0){
			echo $notice['html'];
		}
  ?>
</ul>
<!--/. NAV TOP  -->
<nav class="navbar-default navbar-side" style="overflow:scroll;height:100%" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">
      <li> <a class="active-menu waves-effect waves-dark" href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Stocks<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>stocks">All Stocks</a> </li>
          <!--<li> <a href="<?php echo base_url(); ?>stocks/products">Products</a></li>-->
          <li> <a href="<?php echo base_url(); ?>stocks/categories">Categories</a></li>
          <li> <a href="<?php echo base_url(); ?>vendors">All Vendors</a> </li>
          <li> <a href="<?php echo base_url(); ?>brands">All Brands</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Centers<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>centers">All Centers</a> </li>
          <li> <a href="<?php echo base_url(); ?>centers/add">Add Center</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Camps<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>camps">All Camps</a> </li>
          <li> <a href="<?php echo base_url(); ?>camps/add">Add Camp</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Employees<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>employees">All Employees</a> </li>
          <li> <a href="<?php echo base_url(); ?>employees/add">Add Employee</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Procedures<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>procedures">All Procedures</a> </li>
          <!-- <li> <a href="<?php echo base_url(); ?>procedures/parent_procedures">Parent Procedure</a> </li> -->
          <li> <a href="<?php echo base_url(); ?>procedures/add">Add Procedure</a> </li>
          <li> <a href="<?php echo base_url(); ?>procedures/forms">All Forms</a> </li>
          <li> <a href="<?php echo base_url(); ?>procedures/add_form">Add Forms</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Consultation<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>procedures/ids">All Consultation ID's</a> </li>
          <li> <a href="<?php echo base_url(); ?>procedures/add_id">Add Consultation ID</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Investigations<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>investigation/investigation">All Investigations</a> </li>
          <li> <a href="<?php echo base_url(); ?>investigation/add">Add Investigation</a> </li>
        </ul>
      </li>
       <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Doctors<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>doctors">All Doctors</a> </li>
          <li> <a href="<?php echo base_url(); ?>doctors/add">Add Doctor</a> </li>
          <li> <a href="<?php echo base_url(); ?>junior-doctors">Junior Doctors</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Accounts<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
              <li> <a href="<?php echo base_url(); ?>accounts/accounts">Account Ledger</a> </li>
              <li> <a href="<?php echo base_url(); ?>accounts/patient_ledger">Patient Ledger</a> </li>
              <li> <a href="<?php echo base_url(); ?>accounts/reconciliation">Center Reconciliation</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Billing<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
              <li> <a href="<?php echo base_url(); ?>billings/all_billings">All billings</a> </li>
              <li> <a href="<?php echo base_url(); ?>billings/billing_discount">Billing discount List</a> </li>
              <li> <a href="<?php echo base_url(); ?>doctor-consultations">Doctor's Consultation</a> </li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Orders<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li> <a href="<?php echo base_url(); ?>orders/orders">Centre requisition</a> </li>
          <li> <a href="<?php echo base_url(); ?>orders/my_orders">Orders</a> </li>
          <li> <a href="<?php echo base_url(); ?>orders/purchase_orders_list">Purchase orders</a> </li>
          <li><a href="<?php echo base_url(); ?>stocks/patient_items">Patient consumption</a></li>
        </ul>
      </li>
      <li> <a href="#" class="waves-effect waves-dark"><i class="fa fa-sitemap"></i>Manage Patients<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li> <a href="<?php echo base_url(); ?>billings/patients">Patients</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
<?php 
	if(isset($_GET['m']) && !empty($_GET['m'])){
		echo '<div class="col-sm-12 col-xs-12 '.base64_decode($_GET['t']).'"><h4>'.base64_decode($_GET['m']).'</h4></div>';
	}
?>
