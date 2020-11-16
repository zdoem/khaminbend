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
         ระบบข้อมูลครัวเรือน
    <?php
    if(isset($webtitle)){
      echo $webtitle;
    }
    ?>
    <?=get_domain()?> 
    </title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
  <!-- Google Font: Source Sans Pro
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->

  <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
  <style >
body {
  font-family: 'Prompt', sans-serif; !important;
}
</style>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="assets/js/demo.js"></script> -->

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<!-- <script src="assets/plugins/chart.js/Chart.min.js"></script> -->

<!-- PAGE SCRIPTS -->
<!-- <script src="assets/js/pages/dashboard2.js"></script> -->

<script src="assets/js/sweetalert2.min.js"></script> 
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> 

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper" id="app">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> 

  </nav>
  <!-- /.navbar --> 

    <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
       <img src="images/apple-icon-57x57.png" alt="ระบบจัดการข้อมูลครัวเรือน " class="brand-image img-circle elevation-3"
           style="opacity: .8">
           	<!-- <img src="images/apple-icon-57x57.png" class="img-responsive" alt=""  style="opacity: .8">-->
      <span class="brand-text font-weight-light bn-xs">ระบบข้อมูลครัวเรือน </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar"> 
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="villageList.php" class="nav-link ">
              <em class="fa fa-university">&nbsp;</em>
              <p>
              หน้าจัดการข้อมูลหมู่บ้าน
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="familyList.php" class="nav-link">
              <em class="fa fa-address-card">&nbsp;</em>
              <p>
              หน้าจัดการข้อมูลครัวเรือน
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <em class="fa fa-bars">&nbsp;</em>
              <p>
                ข้อมูลพื้นฐานหมู่บ้าน
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-angle-right left"></i>
                  <p>จัดการข้อมูลทั่วไปหมู่บ้าน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-angle-right left"></i>
                  <p>จัดการข้อมูลกลุ่มและชุมชน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-angle-right left"></i>
                  <p>Validation xxx</p>
                </a>
              </li>
            </ul>
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
                  <p> ข้อมูลทั่วไป</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-angle-right left"></i>
                  <p>ข้อมูลการประกอบอาชีพ</p>
                </a>
              </li>
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
            <a href="#" class="nav-link">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              <p>
                จัดการข้อมูลผู้ใช้งานระบบ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-angle-right left"></i>
                  <p>จัดการ Users</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-header"><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

 