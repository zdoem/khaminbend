<?php
defined('ROOT') OR exit('No access allowed');

defined('DBdriver') or define('DBdriver', 'mysql'); 
defined('DBHost')    OR define('DBHost', 'localhost');
defined('DBUser')    OR define('DBUser', 'root'); 
defined('DBPassword') OR define('DBPassword', '');
defined('DBName') OR define('DBName', 'db_khokkhamin');
defined('DBPort') or define('DBPort', 3306); 
defined('S_SALT') or define('S_SALT', 'YyUcSW7yg#mXNWq5Lz9V!x_MuZRj_N');

defined('MAIL_DRIVER')    OR define('MAIL_DRIVER', 'smtp'); 
defined('MAIL_HOST') OR define('MAIL_HOST', 'smtp.gmail.com');
defined('MAIL_PORT') OR define('MAIL_PORT', 465);
defined('MAIL_USERNAME') or define('MAIL_USERNAME', '123maweb@gmail.com'); 
defined('MAIL_PASSWORD') or define('MAIL_PASSWORD', 'svofzoavnycedpyu');
defined('MAIL_ENCRYPTION') or define('MAIL_ENCRYPTION', 'ssl');
 
 //production =pro  พัฒนา=dev
defined('ENV') OR define('ENV','dev');

 
?>
