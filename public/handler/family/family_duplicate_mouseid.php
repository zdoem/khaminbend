<?php
require '../../bootstart.php';
require ROOT . '/core/security.php'; 
header('Content-Type: application/json');

$house_no = trim((isset($_POST['house_no']) ? $_POST['house_no'] : ''));  
$house_no =rawurldecode($house_no);

$query= $db::table("fm_fam_hd")
    ->where('house_no', '=', $house_no)
    ->select($db::raw("fam_id,SUBSTRING(fam_id,1,2) AS yearfam_id,house_no,house_moo"));
if(isset($_POST['id'])&&strlen(trim(@$_POST['id']))>0){
     $query->whereNotIn('fam_id', [$_POST['id']]);
}
$rows_old =$query->first(); 

 if(isset($rows_old->house_moo)){
  echo json_encode(['status'=>'dupicate']);
 }else{
 echo json_encode(['status'=>'nodupicate']);
 }
?>
