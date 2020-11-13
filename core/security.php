<?php
$logged_in = false; 
$site = Get_m_site();
if (!isset($_SESSION['member_no'])) {
    $logged_in = true;
} elseif (empty($_SESSION['member_no'])) {
    $logged_in = true;
} elseif (@sizeof($_SESSION['member_no']) <= 0) {
    $logged_in = true;
} elseif (!isset($_SESSION['member_login'])) {
    $logged_in = true;
} elseif (empty($_SESSION['member_login'])) {
    $logged_in = true;
} elseif (@sizeof($_SESSION['member_login']) <= 0) {
    $logged_in = true;
} 
if ($logged_in) {
    session_destroy();
    header('refresh:0;url=../');
    exit();
}
function logged_in(){
    return $logged_in;
}

?>