
<?php
 require 'bootstart.php';    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รีเซ็ทรหัสผ่าน</title>
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
         $("#submitBtn" ).click(function() {
			  if($('#email').val() == ""){	
				Swal.fire({
				title: 'กรุณากรอก email!',
				allowOutsideClick: false,
				showDenyButton: false,
				showCancelButton: false 
				});
				return;				
			  }else if (!validateEmail($('#email').val())){
                 Swal.fire({
                  title: 'รูปแบบ Email ไม่ถูกต้อง!',
                  allowOutsideClick: false,
                  showDenyButton: false,
                  showCancelButton: false 
              });
              return;
             }
             $.ajax({
                beforeSend: function() {  
                s_alert= Swal.fire({
                        title: 'รอสักครู่...',
                        text: 'กำลังส่งข้อมูลการเปลี่ยนรหัสผ่านใหม่!.',
                        showCancelButton: false,
                        showConfirmButton: false,
                        closeOnConfirm: false,
                        allowOutsideClick: false 
                    }); 
                },
                type: "POST",  
                datatype : "application/json", 
                url: "handler/recoverpassword.php",
                data: {'action':'reset-password','email':$('#email').val()}, 
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
         //ระบบได้ส่งรหัสผ่านใหม่ไปที่อีเมล์ของคุณแล้ว กรุณาตรวจสอบอีเมล์
      });
 </script>
</head>
<body class="hold-transition login-page bg-img">
<div class="login-box">
  <div class="login-logo">
    <b>รีเซ็ทรหัสผ่าน</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">คุณลืมรหัสผ่าน? </br>รหัสผ่านใหม่จะถูกส่งไปที่อีเมล์ของคุณ</p>

      <form action="recover-password.php" method="post">
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="button" id="submitBtn" class="btn btn-primary btn-block">รีเซ็ทรหัสผ่าน</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">เข้าสู่ระบบ&nbsp;</a>|<a href="./index.php">&nbsp;หน้าแรก</a>
      </p> 
    </div> 
  </div>
</div>  
<div style="display: none;" id="xhtml"></div>
</body>
</html>
