<?php
defined('ROOT') or exit('No access allowed'); 
 
use Illuminate\Database\Capsule\Manager as Capsule;

$db = new Capsule;

$db->addConnection([
  'driver'    => DBdriver,
  'port'      => DBPort,
  'host'      => DBHost,
  'database'  => DBName,
  'username'  => DBUser,
  'password'  => DBPassword,
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'pooling' => false,
  'prefix'    => '',
]);
 
$db->setAsGlobal();
$db->bootEloquent();

?>