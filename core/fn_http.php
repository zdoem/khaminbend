<?php
function GetIP()
{
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {

        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (!empty($_SERVER["REMOTE_ADDR"])) {
        $ip = $_SERVER["REMOTE_ADDR"];
    } else {
        $ip = "ไม่สามารถรับมันได้！";
    }
    return $ip;
}
function is_subdomain(){  
    $parts = explode(".",trim(preg_replace('/www\./i', '',$_SERVER['SERVER_NAME'])));
     if($parts[0]=='www'){
          return count($parts)>3;
        }else {
         return count($parts)>2;
     }
}
function GetPageURL() {
    $pageURL = 'http';
    if ((isset($_SERVER["HTTPS"]) ? $_SERVER["HTTPS"] : '') == "on") {
      $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
      $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
  }
function Getbaseurl(){
    if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
       return "https://" . $_SERVER['HTTP_HOST'] . "";
    } 
    return "http://" . $_SERVER['HTTP_HOST'] . "";
 }
function Get_domain($url=null){   
	 $pieces='';
	 if(isset($url)){
	  $pieces = parse_url((isset($url)?$url:$_SERVER['HTTP_HOST']));
	 }else{
	  $sevssl='http://';
	  if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
	  $sevssl='https://';
	  }
	  $pieces = parse_url((isset($url)?$url:$sevssl.$_SERVER['HTTP_HOST']));
	 } 
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
        return $regs['domain'];
    }
    return FALSE;
}
function Getfullurl($url=null){ 
   return Get_domain(). $_SERVER['REQUEST_URI'];
}

?>