<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
   $db::table('tbl_password_reset')->where('email', '=', $email)->delete(); 
   $results =$db::table('tbl_password_reset')->insert(['email'=>$email,'token'=>$token,'expires'=>$expires->format('U')]);
   
    $output = '<p>เรียนผู้ใช้งาน</p>';
    $output .= '<b>กรุณาคลิกที่ลิงค์ต่อไปนี้เพื่อรีเซ็ตรหัสผ่านของคุณ.</b>';
    $output .= '<p>---------------------------------------------------------------------------------------------------------------------</p>';
    $output .= '<p><a href="' . Getbaseurl() . '/passwordrecover.php?token=' . $token . '" target="_blank">
    ' . Getbaseurl() . '/passwordrecover.php?token=' . $token . '</a></p>';
    $output .= '<p>---------------------------------------------------------------------------------------------------------------------</p>';
    $output .= '<p>โปรดอย่าลืมคัดลอกลิงก์ทั้งหมดลงในเบราว์เซอร์ของคุณ ลิงก์จะหมดอายุหลังจาก 1 ชั่วโมงด้วยเหตุผลด้านความปลอดภัย.</p>';
    $output .= '<p>หากคุณไม่ได้ขออีเมลที่ลืมรหัสผ่านนี้ไม่จำเป็นต้องดำเนินการใด ๆ รหัสผ่านของคุณจะไม่ถูกรีเซ็ต อย่างไรก็ตามคุณอาจต้องการลงชื่อเข้าใช้บัญชีของคุณและเปลี่ยนรหัสผ่านความปลอดภัยของคุณเนื่องจากอาจมีคนเดาได้.</p>';
    $output .= '<p>ขออภัยในความไม่สะดวก</p>';
    $output .= '<p>ระบบสำรวจมูลครัวเรือน.com</p>';
    $body = $output;

    $subject = "กู้คืนรหัสผ่าน - ระบบสำรวจมูลครัวเรือน.com";
    $email_to = $email;
    $fromserver = "noreply@yourwebsite.com";

    try {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->Host = MAIL_HOST; // Enter your host here
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Username = MAIL_USERNAME; // Enter your email here
        $mail->Password = MAIL_PASSWORD; //Enter your password here
        $mail->Port = MAIL_PORT;
        $mail->IsHTML(true);
        $mail->CharSet = "utf-8";
        $mail->From = "noreply@yourwebsite.com";
        $mail->FromName = "ระบบสำรวจมูลครัวเรือน";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        if (!$mail->Send()) {
            // echo "Mailer Error: " . $mail->ErrorInfo;
             ?>
             <script type="text/javascript">
             Swal.fire({
              title: 'ระบบไม่สามารถส่งคำขอเปลี่ยนรหัสผ่านใหม่ได้ กรุณาติดต่อ admin!',
              allowOutsideClick: false,
              showDenyButton: false,
              showCancelButton: false 
              });
            </script>  
              <?php
              exit();
        }
    } catch (Exception $e) {
       ?>
       <script type="text/javascript">
       Swal.fire({
        title: 'ระบบไม่สามารถส่งคำขอเปลี่ยนรหัสผ่านใหม่ได้ กรุณาติดต่อ admin!',
        allowOutsideClick: false,
        showDenyButton: false,
        showCancelButton: false 
        });
       </script>   
      <?php
      exit();
        // echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    } 
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