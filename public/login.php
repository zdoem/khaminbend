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
  

  <?php 
   /* main css for user page*/
   require_once 'components/css_userpage.php';
   
   require_once 'resource/app_js.php'; 
   ?>  
   <script src="assets/js/app.js"></script>

	<script type="text/javascript">
 	 $(function(){
        var s_alert=s_alert||{};
         $("#submitBtn").click(function() {
			  if($('#username').val() == ""){	
				Swal.fire({
					title: 'กรุณากรอก ชื่อผู้ใช้!',
					allowOutsideClick: false,
					showDenyButton: false,
					showCancelButton: false 
				});
								
			  }else if($('#password').val() == ""){	
				Swal.fire({
					title: 'กรุณากรอก รหัสผ่าน!',
					allowOutsideClick: false,
					showDenyButton: false,
					showCancelButton: false 
				});
								
			  }else{
				app.checkLogin();
			  }
			  return;
		 });
	});
	</script>
</head>
<body class="hold-transition login-page bg-img">
	<!--
	<script>
	//check resolution screen size
    function getResolution() {
        alert("Your screen resolution is: " + screen.width + "x" + screen.height);
    }
    </script>
     
    <button type="button" onclick="getResolution();">Get Resolution</button>
	-->
<div class="login-box" id="app" v-cloak>
  <div class="login-logo">
    <b>เข้าสู่ระบบ</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">เข้าสู่ระบบเพื่อเริ่มการทำงาน</p>

      <form action="handler/login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" id="username" v-model="logDetails.username" placeholder="ชื่อผู้ใช้" v-on:keyup.enter="checkLogin" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" v-model="logDetails.password" placeholder="รหัสผ่าน" v-on:keyup.enter="checkLogin" />
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
				<a href="passwordforgot.php">ฉันลืมรหัสผ่าน&nbsp;</a>|<a href="./index.php">&nbsp;หน้าแรก</a>
			  </p>
            </div> 
			
          </div>
          <!-- /.col -->
          <div class="col-4">
            <!-- <a href="index2.html" type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</a> -->
            
			<!--<button class="btn btn-primary btn-block" type="button" v-on:click="checkLogin()">เข้าสู่ระบบ</button>-->
			<button id="submitBtn" class="btn btn-primary btn-block" type="button">เข้าสู่ระบบ</button>
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
