
<?php
require '../bootstart.php';   
 
if (isset($_SESSION['user_id'])) {  
    echo "<script>window.location.href = '../'</script>";
    exit();
}
if (empty($_POST['username'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก ชื่อผู้ใช้งาน', 'error');</script>";
    exit();
} elseif (empty($_POST['password'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก รหัสผ่านผู้ใช้งาน', 'error');</script>";
    exit();
 } else {  
    $username = trim($_POST['username']);
    $password = md5(S_SALT.trim($_POST['password'])); 

    $rowsdata = $db::select("CALL user_auth('{$username}','{$password}')")[0];
 
    if ($rowsdata->callstatus=='FAIL') {
        echo "<script>swal.fire('เข้าสู่ระบบ','ข้อมูลไม่ถูกต้อง!','error');</script>";
        exit();
    }   

    $_SESSION['user_id'] =$rowsdata->user_id;  
    $_SESSION['fname'] = $rowsdata->fname; 
    $_SESSION['lname'] = $rowsdata->lname; 
    $_SESSION['position_name'] =$rowsdata->position_name; 
    $_SESSION['email'] = $rowsdata->email; 
    $_SESSION['level'] = $rowsdata->level; 
    $_SESSION['dept_code'] = $rowsdata->dept_code; 
    $_SESSION['role_code'] = $rowsdata->role_code; 

    echo "<script>window.location.href = '../'</script>";
    exit();
}
 

?>