<?php
 require 'bootstart.php';   
    if (isset($_SESSION['member_no'])) { 
        header('refresh:0;url=./');
        exit();
    }
 $webtitle='เข้าสู่ระบบ';
 require_once 'componentxx/header.php';  
?>
 
<?php
 require_once 'componentxx/footer.php';  
?>