<?php
 if (session_status() == PHP_SESSION_NONE) {
     session_start();
  } 
$logged_in = false;  
if (!isset($_SESSION['user_id'])) {
    $logged_in = true;
} elseif (empty($_SESSION['user_id'])) {
    $logged_in = true;
} elseif (@sizeof($_SESSION['user_id']) <= 0) {
    $logged_in = true;
}   
if ($logged_in) {
    session_destroy(); 
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('refresh:0;url=../login.php',TRUE,403);//,TRUE,403
    exit();
    }else{
    header('refresh:0;url=../login.php');//,TRUE,403
    exit();
    } 
}
function logged_in(){
    return $logged_in;
}

?>