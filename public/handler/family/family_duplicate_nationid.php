<?php
require '../../bootstart.php';
require ROOT . '/core/security.php'; 
header('Content-Type: application/json');

$mem_citizen_id = trim((isset($_POST['mem_citizen_id']) ? $_POST['mem_citizen_id'] : ''));  
$mem_citizen_id =rawurldecode($mem_citizen_id);

$query= $db::table("fm_fam_members_dt1")
    ->where('mem_citizen_id', '=', $mem_citizen_id)
    ->select($db::raw("mem_citizen_id"));
if(isset($_POST['id'])&&strlen(trim(@$_POST['id']))>0){
     $query->whereNotIn('mem_fam_id', [$_POST['id']]);
}
$rows_old =$query->first(); 

 if(isset($rows_old->mem_citizen_id)){
  echo json_encode(['status'=>'dupicate']);
 }else{
 echo json_encode(['status'=>'nodupicate']);
 }
?>
