<?php
require '../bootstart.php';
require ROOT . '/core/security.php';

$listamphur = $db::table("amphures")
    ->select($db::raw("code,name_th,name_en"))
    ->where('province_id', '=', @$_GET['id'])
    ->orderBy('name_th', 'asc')
    ->get()->toArray();
 
echo json_encode($listamphur);exit();
?>