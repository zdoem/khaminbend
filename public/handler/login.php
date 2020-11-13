
<?php
require '../bootstart.php';  

if (isset($_SESSION['member_no'])) {  
    exit();
}
if (empty($_POST['username'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก เบอร์โทรศัพท์', 'error');</script>";
    exit();
} elseif (empty($_POST['password'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก รหัสผ่าน', 'error');</script>";
    exit();
} else { 
    $site =Get_m_site();
    $phone = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT member_no,member_username,member_login,member_firstname,member_lastname,member_bank_account,member_aff_upline  FROM `members` WHERE member_phone = ? AND member_password =?"; // ORDER BY ASC'";
    $row = $conn->row($query,[$phone,$password]); 
    if (!$row) {
        echo "<script>swal.fire('เข้าสู่ระบบ','เบอร์โทรศัพท์ หรือ รหัสผ่าน ไม่ถูกต้อง','error');</script>";
        exit();
    } else { 
        if (@$row['status'] != 0) {
            echo "<script>swal.fire('เข้าสู่ระบบ','เบอร์โทรศัพท์ หรือ รหัสผ่าน ไม่ถูกต้อง','error');</script>";
            exit();
        }
    }  
    $_SESSION['member_no'] = $row['member_no'];
    $_SESSION['member_username'] = $row['member_username'];
    $_SESSION['member_login'] = $row['member_login'];
    $_SESSION['member_name'] = $row['member_firstname'] . " " . $row['member_lastname'];
    $_SESSION['member_bank_account'] = $row['member_bank_account'];
    $_SESSION['member_aff_upline'] = $row['member_aff_upline']; 

    echo "<script>window.location.href = '/user/dashboard'</script>";
    exit();
}


?>