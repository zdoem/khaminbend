<?php
defined('ROOT') OR exit('No access allowed');

defined('DBdriver') or define('DBdriver', 'mysql'); 
defined('DBHost')    OR define('DBHost', 'localhost');
defined('DBUser')    OR define('DBUser', 'root'); 
defined('DBPassword') OR define('DBPassword', '');
defined('DBName') OR define('DBName', 'db_khokkhamin');
defined('DBPort') or define('DBPort', 3306); 
defined('S_SALT') or define('S_SALT', 'YyUcSW7yg#mXNWq5Lz9V!x_MuZRj_N'); 
 //production ����¹dev �� pro
defined('ENV') OR define('ENV','dev');

 
?>
