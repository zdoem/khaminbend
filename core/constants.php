<?php
defined('ROOT') OR exit('No access allowed');

defined('DBdriver') or define('DBdriver', 'mysql'); 
defined('DBHost')    OR define('DBHost', 'localhost');
defined('DBUser')    OR define('DBUser', 'root'); 
defined('DBPassword') OR define('DBPassword', '');
defined('DBName') OR define('DBName', 'db_khokkhamin');
defined('DBPort') or define('DBPort', 3306);
 //production ����¹dev �� pro
defined('ENV') OR define('ENV','dev');

 
?>
