<?php 
 if (session_status() == PHP_SESSION_NONE) {
   session_start();
  }   
 date_default_timezone_set("Asia/Bangkok");

 defined('ROOT')  OR define('ROOT',  realpath(__DIR__."/..")); 
 require_once ROOT.'/private/vendor/autoload.php';   
 require_once ROOT.'/core/constants.php';  
 require_once ROOT.'/core/function.php';
 require_once ROOT . '/core/fn_http.php'; 
  if(ENV=='dev'){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
   }else{
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
  }
 require_once ROOT.'/core/db.php'; 
 //require_once ROOT.'/core/security.php';

?>