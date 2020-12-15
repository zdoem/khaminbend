<?php 
require '../bootstart.php';   
if (isset($_POST['action'])&&@$_POST['action']=='reset-password') { 
  $email = addslashes($_POST['email']); 
   
   $row= $db::table("tbl_users")  
    ->where('email', '=', $email)
    ->select($db::raw("email"))->first();

   if (!isset($row->email)) {
    ?>
    <script type="text/javascript">
       Swal.fire({
        title: 'ไม่พบข้อมูลผู้ใช้งาน!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script>
    <?php
    exit();
   }  
   $token = bin2hex(random_bytes(50)); 
   $expires = new DateTime('NOW');
   $expires->add(new DateInterval('PT01H'));  
   $results =$db::table('tbl_password_reset')->insert(['email'=>$email,'token'=>$token,'expires'=>$expires->format('U')]);
 
    // $to = $email;
    // $subject = "Reset your password on examplesite.com";
    // $msg = "Hi there, click on this <a href=\"new_password.php?token=" . $token . "\">link</a> to reset your password on our site";
    // $msg = wordwrap($msg,70);
    // $headers = "From: info@examplesite.com";
    // mail($to, $subject, $msg, $headers);
     ?>
    <script type="text/javascript">
       Swal.fire({
        title: 'ระบบได้ส่งรหัสผ่านใหม่ไปที่อีเมล์ของคุณแล้ว กรุณาตรวจสอบอีเมล์!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script>
    <?php
    exit();
}

// ENTER A NEW PASSWORD 
if (isset($_POST['action'])&&@$_POST['action']=='new_password') {  

  $new_pass = trim($_POST['new_pass']); 
  $new_pass_c = trim($_POST['new_pass_c']); 
  $token = $_POST['token']; 

  if (empty($token)){
    ?>
     <script type="text/javascript">
       Swal.fire({
        title: 'ไม่พบข้อมูล!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script> 
     <?php
     exit();
   }

  if (empty($new_pass) || empty($new_pass_c)){
      ?>
     <script type="text/javascript">
       Swal.fire({
        title: 'กรุณากรอกรหัสผ่าน!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script> 
     <?php
     exit();
  } 

if ($new_pass !== $new_pass_c){
 ?>
     <script type="text/javascript">
       Swal.fire({
        title: 'กรอกยืนยันรหัสผ่านไม่ตรงกัน!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script> 
     <?php
     exit();
  }  

$re = "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
if (mb_strlen($new_pass, 'UTF8') < 8) {
     ?>
     <script type="text/javascript">
       Swal.fire({
        title: 'รหัสผ่านต้องมีไม่ต่ำกว่า 8 ตัว!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script> 
     <?php
     exit();
} elseif (!preg_match($re, $new_pass)) {
    if (misc_parsestring($new_pass) == false) {
        ?>
        <script type="text/javascript">
       Swal.fire({
        title: 'รหัสผ่านต้องมีอักษรภาษาอังกฤษกับตัวเลขผสมเท่านั้น!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
      </script>  
        <?php
        exit();
    } else {
      ?>
      <script type="text/javascript">
       Swal.fire({
        title: 'รหัสผ่านต้องมีตัวเลขอยู่ด้วยอย่างน้อย 1 ตัว!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script>  
      <?php
      exit();
    }
}
   //expires >=time()
    $row= $db::table("tbl_password_reset")  
    ->where('token', '=', $token)
    ->select($db::raw("token,expires,email"))->first();

    if (isset($row->token)) {
         $new_pass = md5(S_SALT.$new_pass); 
         $row =$db::update('update tbl_users set password=? where email = ?',[$new_pass,$row->email]); 
         $db::table('tbl_password_reset')->where('token', '=', $token)->delete(); 
          ?>
        <script type="text/javascript">
        Swal.fire({
          title: 'แก้ไขเปลี่ยนรหัสผ่านเรียบร้อยแล้ว!',
          allowOutsideClick: false,
          showDenyButton: false,
          showCancelButton: false 
          });
        </script>  
        <?php
        exit();
    }else{
       ?>
      <script type="text/javascript">
       Swal.fire({
        title: 'ไม่พบข้อมูล!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
    </script>  
      <?php
      exit();
    } 
}