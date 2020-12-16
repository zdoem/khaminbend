<?php
require '../../bootstart.php';
require ROOT . '/core/security.php'; 
header('Content-Type: application/json');

$mem_citizen_id = trim((isset($_POST['mem_citizen_id']) ? $_POST['mem_citizen_id'] : ''));  
$mem_citizen_id =rawurldecode($mem_citizen_id);
  
if(isset($_POST['id'])&&strlen(trim(@$_POST['id']))>0){
    $rows_old =$db::select("SELECT mem_citizen_id FROM  fm_fam_hd AS a INNER JOIN fm_fam_members_dt1 AS b ON a.fam_id=b.mem_fam_id
    WHERE  mem_citizen_id=? AND mem_fam_id!=? AND YEAR(d_survey)  IN (
        SELECT YEAR(d_survey) FROM  fm_fam_hd  WHERE mem_fam_id=? 
    )", [$mem_citizen_id, @$_POST['id'],@$_POST['id']] );
}else{
    $survseydate=DateTime::createFromFormat('d/m/Y',DateConvert('toadre','d/m/Y',$_POST['survseydate'],'/')); 
    $d_survseydate=$survseydate->format('Y');
    $rows_old =$db::select("SELECT mem_citizen_id FROM  fm_fam_hd AS a INNER JOIN fm_fam_members_dt1 AS b ON a.fam_id=b.mem_fam_id
    WHERE  mem_citizen_id=? AND YEAR(d_survey)  IN (
        SELECT YEAR(d_survey) FROM  fm_fam_hd  WHERE YEAR(d_survey)=? 
    )",[$mem_citizen_id,$d_survseydate]);
} 
 
 if(isset($rows_old[0]->mem_citizen_id)){
  echo json_encode(['status'=>'dupicate']);
 }else{
 echo json_encode(['status'=>'nodupicate']);
 }
?>
