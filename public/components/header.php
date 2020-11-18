<?php 
defined('ROOT') OR exit('No access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> 
    <?php
    if(isset($webtitle)){
      echo $webtitle;
    }
    ?>
    กองส่งเสริมการเกษตร |<?=get_domain()?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">  
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <link rel="stylesheet" href="assets/css/adminlte.min.css"> 
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300&display=swap" rel="stylesheet">


  <style >
  body {
    font-family: 'Prompt', sans-serif; !important; 
  }
  [v-cloak] {display: none}
  </style>
  <?php 
   require_once 'resource/app_js.php'; 
   ?> 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
	
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./" class="nav-link">Home</a>
      </li> 
    </ul> 
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

	  <!-- Notifications Dropdown Menu -->

		<li class="nav-item dropdown user-menu">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
			  <img src="assets/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
			  <span class="d-none d-md-inline">เสน่ห์ เพกประโคน</span>
			</a>
			<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			  <!-- User image -->
			  <li class="user-header bg-primary">
				<img src="assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

				<p>
				  เสน่ห์ เพกประโคน - Supervisor
				  <small>กองส่งเสริมการเกษตร</small>
				</p>
			  </li> 
			  <li class="user-footer">
				<a href="#" class="btn btn-default btn-flat">Profile</a>
				<a href="#" class="btn btn-default btn-flat float-right">Sign out</a>
			  </li>
			</ul>
		 </li>

	  <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> 
	 <!-- -->
    </ul>
  </nav>
  <!-- /.navbar -->

    <!-- Main Sidebar Container -->
     <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
    <a href="/" class="brand-link">
       <img src="images/apple-icon-57x57.png" alt="ระบบจัดการข้อมูลครัวเรือน " class="brand-image img-circle elevation-3"
           style="opacity: .8"> 
      <span class="brand-text font-weight-light bn-xs">กองส่งเสริมการเกษตร </span>
    </a>

      <!-- Sidebar -->
      <div class="sidebar"> 
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 

            <li class="nav-item">
              <a href="familyList.php" class="nav-link active">
                <em class="fa fa-address-card">&nbsp;</em>
                <p>
                หน้าจัดการข้อมูลครัวเรือน
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="villageList.php" class="nav-link ">
                <em class="fa fa-university">&nbsp;</em>
                <p>
                หน้าจัดการข้อมูลหมู่บ้าน

                </p>
              </a>
            </li>			
			<li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <em class="fa fa-bars">&nbsp;</em>
                <p>
                  ข้อมูลพื้นฐานครัวเรือน
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="fas fa-angle-right left"></i>
                    <p>ข้อมูลกลุ่มอาชีพ</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <em class="fa fa-bars">&nbsp;</em>
                <p>
                  รายงาน
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-angle-right left"></i>
                    <p> รายงานประจำปี</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="fas fa-angle-right left"></i>
                    <p>รายงานแยกตามกลุ่มอาชีพ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="fas fa-angle-right left"></i>
                    <p>รายงานแยกตามครัวเรือน</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
            <li class="nav-header"><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

 