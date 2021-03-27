<?php 
defined('ROOT') OR exit('No access allowed');
//$current_file_name=preg_replace("/\//", "",$_SERVER['PHP_SELF']);
$current_file_name = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
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

  <!--Back to top page-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style-back2top-page.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">  
  <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">  
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> 

  <!-- <link rel="stylesheet" href="assets/css/ui-lightness/jquery-ui-1.8.10.custom.css">    -->
  <link rel="stylesheet" href="assets/plugins/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="assets/plugins/jquery-ui/jquery-ui.theme.min.css">   
  <link rel="stylesheet" href="assets/css/adminlte.min.css"> 
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300&display=swap" rel="stylesheet">
  <!--Custom Style-->
  <link rel="stylesheet" href="assets/css/style.custom.css"> 
      
  <?php 
   require_once 'resource/app_js.php'; 
   ?> 

   <script type="text/javascript">
		$().ready(function(){
			var btn = $('#button2top');

			$(window).scroll(function() {
			  if ($(window).scrollTop() > 500) {
				btn.addClass('show');
			  } else {
				btn.removeClass('show');
			  }
			});

			btn.click(function(e) {
			  e.preventDefault();
			  $('html, body').animate({scrollTop:0}, '500');
			});
		});
	</script>

</head>
<body class="hold-transition sidebar-mini">

<!-- Back to top page -->
<a id="button2top"></a>

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
	
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./dashboard.php" class="nav-link">Home</a>
      </li> 
    </ul> 
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

	  <!-- Notifications Dropdown Menu -->

		<li class="nav-item dropdown user-menu">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
			  <!-- <img src="assets/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image"> -->
         <i class="fa fa-user" aria-hidden="true"></i>
			  <span class="d-none d-md-inline"><?=@$_SESSION['fname'].' '.@$_SESSION['lname']?></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			  <!-- User image -->
			  <li class="user-header bg-primary">
				<!-- <img src="assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          <i class="fa fa-user" aria-hidden="true"></i>
				<p>  
          <?=@$_SESSION['fname'].' '.@$_SESSION['lname'].' - '.@$_SESSION['position_name']?>
				  <small>กองส่งเสริมการเกษตร</small>
				</p>
			  </li> 
			  <li class="user-footer">
				<!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
				<a href="./logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
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
    <a href="index.php" class="brand-link">
       <img src="images/logo-kmsc.png" alt="โคกขมิ้น สมาร์ท ซิตี้  Portal " class="brand-image img-circle elevation-3"
           style="opacity: .8"> 
      <span class="brand-text font-weight-light bn-xs">โคกขมิ้น สมาร์ท ซิตี้ </span>
    </a>

      <!-- Sidebar -->
      <div class="sidebar"> 
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
            <li class="nav-item">
              <a href="dashboard.php"  class="nav-link <?=(in_array($current_file_name,['dashboard.php','dashboard.php']))?'active':'' ?>">

                <em class="fa fa-home">&nbsp;</em>
                <p>
               กองส่งเสริมการเกษตร
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="familyList.php"  class="nav-link <?=(in_array($current_file_name,['familyList.php','familyForm.php']))?'active':'' ?>">
                <em class="fa fa-address-card">&nbsp;</em>
                <p>
                หน้าจัดการข้อมูลครัวเรือน
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="villageList.php" class="nav-link <?=(in_array($current_file_name,['villageList.php','villageForm.php','villageFormEdit.php']))?'active':'' ?>">
                <em class="fa fa-university">&nbsp;</em>
                <p>
                หน้าจัดการข้อมูลหมู่บ้าน

                </p>
              </a>
            </li>			
			<li class="nav-item has-treeview <?=(in_array($current_file_name,['careergroupinfoForm.php','careergroupinfoFormEdit.php','careergroupinfolist.php']))?'menu-open':'' ?>">
              <a href="#" class="nav-link">
                <em class="fa fa-bars">&nbsp;</em>
                <p>
                  ข้อมูลพื้นฐานครัวเรือน
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item"> 
                  <a href="careergroupinfolist.php" class="nav-link <?=(in_array($current_file_name,['careergroupinfoForm.php','careergroupinfoFormEdit.php','careergroupinfolist.php']))?'active':'' ?>">
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
<script> 
 $(function () { 
    // var url = window.location;  
    // for single sidebar menu
    // $('ul.nav-sidebar a').filter(function () { 
    //     return this.href == url;
    // }).addClass('active');

    // for sidebar menu and treeview
    // $('ul.nav-treeview a.active').filter(function () {
    //     return this.href == url;
    // }).parentsUntil(".nav-sidebar > .nav-treeview")
    //     .css({'display': 'block'})
    //     .addClass('menu-open').prev('a')
    //     .addClass('active');
});
</script>
 