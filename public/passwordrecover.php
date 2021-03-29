
<?php
 require 'bootstart.php';    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เปลี่ยนรหัสผ่านใหม่</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

   
  <?php /* main css*/
   require_once './components/css_userpage.php';
   require_once 'resource/app_js.php'; 
   ?>  
   <script src="assets/js/app.js"></script>
  <script type="text/javascript">
 	 $(function(){
        var s_alert=s_alert||{};
         $("#submitBtn" ).click(function() {
             $.ajax({
                beforeSend: function() {  
                s_alert= Swal.fire({
                        title: 'รอสักครู่...',
                        text: 'กำลังบันทึกข้อมูลการเปลี่ยนรหัส.',
                        showCancelButton: false,
                        showConfirmButton: false,
                        closeOnConfirm: false,
                        allowOutsideClick: false 
                    }); 
                },
                type: "POST",  
                datatype : "application/json", 
                url: "handler/recoverpassword.php",
                data: {'action':'new_password','token':'<?=@$_GET['token']?>','new_pass':$('#new_pass').val(),'new_pass_c':$('#new_pass_c').val()}, 
                success: function(data){   
                  s_alert.close(); 
                  $('#xhtml').html(data); 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {  
                  s_alert.close();  
                  $('#xhtml').html(''); 
                }       
              }); 
         }); 
      });
 </script>
</head>
<body class="hold-transition login-page bg-img">
<div class="login-box">
  <div class="login-logo"><b>เปลี่ยนรหัสผ่านใหม่</b>  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">กรุณาเปลี่ยนรหัสผ่านใหม่</p>

      <form action="login.php" method="post"> 
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="new_pass" id="new_pass" placeholder="รหัสผ่านใหม่">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
         <span id="exampleInputEmail1-error" class="error invalid-feedback" style="display: block;">
         รหัสผ่านต้องมีอักษรภาษาอังกฤษกับตัวเลขผสมไม่ต่ำกว่า 8 ตัว
         </span>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="new_pass_c" id="new_pass_c" placeholder="กรอกรหัสผ่านใหม่อีกครั้ง">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
           <span id="exampleInputEmail1-error" class="error invalid-feedback" style="display: block;">
           กรอกรหัสผ่านใหม่อีกครั้งให้ตรงกัน
           </span>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="button"  id="submitBtn" class="btn btn-primary btn-block">เปลี่ยนรหัสผ่าน</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">เข้าสู่ระบบ&nbsp;</a>|<a href="./index.php">&nbsp;หน้าแรก</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<div style="display: none;" id="xhtml"></div>
</body>
</html>
