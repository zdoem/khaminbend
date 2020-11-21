<?php
 require 'bootstart.php';   
    if (isset($_SESSION['member_no'])) { 
        header('refresh:0;url=./');
        exit();
    } 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เข้าสู่ระบบ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> 
  
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
  <!-- Theme style --> 
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style> [v-cloak] {display: none} </style>
</head>
<body class="hold-transition login-page">
<div class="login-box" id="app" v-cloak>
  <div class="login-logo">
    <a><b>เข้าสู่ระบบ</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">เข้าสู่ระบบเพื่อเริ่มการทำงาน</p>

      <form action="handler/login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="password" v-model="logDetails.username" placeholder="ชื่อผู้ใช้" v-on:keyup.enter="checkLogin">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" v-model="logDetails.password" placeholder="รหัสผ่าน" v-on:keyup.enter="checkLogin">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
		  <!--
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
			 <div class="icheck-primary">
              <p class="mb-1">
				<a href="forgot-password.html">ฉันลืมรหัสผ่าน</a>
			  </p>
            </div> 
			
          </div>
          <!-- /.col -->
          <div class="col-4">
            <!-- <a href="index2.html" type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</a> -->
            <button class="btn btn-primary btn-block" type="button" v-on:click="checkLogin()">เข้าสู่ระบบ</button>
          </div>
          <!-- /.col -->
        </div>
      </form> 
  </div>
 </div>
</div>
<!-- /.login-box --> 
<?php 
  require_once 'resource/app_js.php'; 
?> 
<script src="assets/js/login.js"></script>
<div style="display: none;" id="xhtml"></div>
</body>
</html>
