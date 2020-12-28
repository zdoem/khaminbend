<?php 
defined('ROOT') OR exit('No access allowed');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

  <title>โคกขมิ้น สมาร์ทซิตี้ Portal 
     <?php
    if(isset($webtitle)){
      echo $webtitle;
    }
    ?>
    <?=get_domain()?>  
  </title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">  
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300&display=swap" rel="stylesheet">
  <style >
  body {
    font-family: 'Prompt', sans-serif; !important;
   /* font-family: 'Kanit', sans-serif; !important; */
  }
   .requiredfeilds {
    color: #f95c5ced;
  }
  .d_none{display:none;}
 .glyphicon-refresh-animate {
	-animation: spin 0.7s infinite linear;
	-webkit-animation: spin2 0.7s infinite linear;
  }

  @-webkit-keyframes spin2 {
    from {
      -webkit-transform: rotate(0deg);
    }
    to {
      -webkit-transform: rotate(360deg);
    }
  } 
  @keyframes spin {
    from {
      transform: scale(1) rotate(0deg);
    }
    to {
      transform: scale(1) rotate(360deg);
    }
  }
  </style>
<script src="assets/plugins/jquery/jquery.min.js"></script> 
<script src="assets/js/jquery-migrate.min.js"></script> 
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script> 
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>  
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/adminlte.js"></script>
<script>
function check_form(obj){
    $(".is-invalid").removeClass("is-invalid");
    var formObj = $(obj);
    var required_count = formObj.find("[data-required]").length; // มีรายการที่จะเช็คกี่รายการ
    var valid_check = true;
    if(required_count && required_count>0){
        var requiredObj = formObj.find("[data-required]"); // ได้รายการที่จะเช็คเป็น array ของ object
        $.each(requiredObj,function(k,v){ // วนลูปรายการที่จะเช็ค
            var typeObj_required = requiredObj.eq(k)[0].tagName.toLowerCase();
            var nameObj = requiredObj.eq(k).attr("name");
            var nodeObj_required = '';
            var requiredText = "";
            if(typeObj_required=='input' || typeObj_required=='select' || typeObj_required=='textarea'){
                nodeObj_required = requiredObj.eq(k).attr("type");
                requiredText = requiredObj.eq(k).data("required");
                if(nodeObj_required=='radio'){
                    if(formObj.find(":radio[name='"+nameObj+"']:checked").length==0){
                        $('html, body').animate({ // สร้างการเคลื่อนไหว
                            scrollTop: requiredObj.eq(k).offset().top-100 // ให้หน้าเพจเลื่อนไปทำตำแหน่งบนสุด
                        }, 0); // ภายในเวลา 0.5 วินาที ---- 1000 เท่ากับ 1 วินาที    
                        valid_check = false;
                        var textAlert = "เลือกหรือกรอกข้อมูลที่จำเป็นให้ครบถ้วน<br/>- "+requiredText;
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: textAlert,
                        });  
                        return false;   
                    }
                }
                if(nodeObj_required=='checkbox'){
                    if(formObj.find(":checkbox[data-required='"+requiredText+"']:checked").length==0){
                        $('html, body').animate({ // สร้างการเคลื่อนไหว
                            scrollTop: requiredObj.eq(k).offset().top-100 // ให้หน้าเพจเลื่อนไปทำตำแหน่งบนสุด
                        }, 0); // ภายในเวลา 0.5 วินาที ---- 1000 เท่ากับ 1 วินาที    
                        valid_check = false;
                        var textAlert = "เลือกหรือกรอกข้อมูลที่จำเป็นให้ครบถ้วน<br/>- "+requiredText;
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: textAlert,
                        });  
                        return false;   
                    }
                }               
            }
            if(requiredObj.eq(k).val()==""){        
                $('html, body').animate({ // สร้างการเคลื่อนไหว
                        scrollTop: requiredObj.eq(k).offset().top-100 // ให้หน้าเพจเลื่อนไปทำตำแหน่งบนสุด
                    }, 0); // ภายในเวลา 0.5 วินาที ---- 1000 เท่ากับ 1 วินาที                   
                requiredObj.eq(k).addClass("is-invalid").focus();
                valid_check = false;
                var textAlert = "เลือกหรือกรอกข้อมูลที่จำเป็นให้ครบถ้วน<br/>- "+requiredText;
                Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: textAlert,
                  });  
                return false;   
            }
        }); 
         if(valid_check==false){
            return valid_check;   
        }else if(valid_check==true){
            return valid_check;   
        }           
    }
}
</script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">

	  <a href="/" class="navbar-brand">
       <img src="images/apple-icon-57x57.png" alt="Portal เทศบาลโคกขมิ้น" class="brand-image img-circle elevation-3"
           style="opacity: .8">
           	<!-- <img src="images/apple-icon-57x57.png" class="img-responsive" alt=""  style="opacity: .8">-->
      <span class="brand-text font-weight-light bn-xs">โคกขมิ้น สมาร์ทซิตี้ Portal</span>
    </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <!--  remark for new version 
          <li class="nav-item">
            <a href="index3.html" class="nav-link">แก้ไขข้อมูลส่วนตัว</a>
          </li>
          -->
          <li class="nav-item">
            <!-- <a href="#" class="nav-link text-white">ลืมรหัสผ่าน</a> -->
            &nbsp;
          </li>
          <?php if(@$_SESSION['role_code']=='99'){?>
          <!-- role_code 99 for admin -->
          
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">จัดการข้อมูลผู้ใช้งาน (Admin)</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="userRegFarmList.php" class="dropdown-item">รายการข้อมูลผู้ใช้งาน</a></li>
              <li><a href="userRegFarmForm.php" class="dropdown-item">เพิ่มข้อมูลผู้ใช้งาน</a></li>

              <li class="dropdown-divider"></li>

              <!-- Level two dropdown 
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li>

                  <!-- Level three dropdown -- >
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -- >

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li>
          <?php }?>
          
        </ul>

        <!-- SEARCH FORM 
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
	  -->

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          
          <?php 
          
         // echo @$_SESSION['role_code'];
          if(@$_SESSION['user_id']==null){
          ?>
            <a href="login.php"><i class="fas fa-sign-in-alt"> เข้าสู่ระบบ</i></a>
            <?php }?>
            <?php 
            if(@$_SESSION['user_id']!=null){
            ?>
            <a href="logout.php" class="text-danger"><em class="fa fa-power-off">&nbsp;</em> ออกจากระบบ</a>
            <?php }?>
          

		</li>

		
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  



 