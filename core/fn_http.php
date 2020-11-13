<?php
function getIP()
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

function get_domain($url=null){   
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

?>