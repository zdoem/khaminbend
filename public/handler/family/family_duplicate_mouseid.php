<?php
require '../../bootstart.php';
require ROOT . '/core/security.php'; 
header('Content-Type: application/json');

$house_no = trim((isset($_POST['house_no']) ? $_POST['house_no'] : ''));  
$mooHouse = trim((isset($_POST['mooHouse']) ? $_POST['mooHouse'] : ''));  
$house_no =rawurldecode($house_no); 
echo json_encode(['status'=>'nodupicate']);exit();
if(isset($_POST['id'])&&strlen(trim(@$_POST['id']))>0){
    $rows_old =$db::select("SELECT fam_id,d_survey,house_no,house_moo FROM  fm_fam_hd AS a 
    WHERE  house_no=? AND house_moo=? AND fam_id!=? AND YEAR(d_survey)  IN (
        SELECT YEAR(d_survey) FROM  fm_fam_hd  WHERE fam_id=? 
    )", [$house_no,$mooHouse, @$_POST['id'],@$_POST['id']] );
}else{
    $survseydate=DateTime::createFromFormat('d/m/Y',DateConvert('toadre','d/m/Y',$_POST['survseydate'],'/')); 
    $d_survseydate=$survseydate->format('Y');
    $rows_old =$db::select("SELECT fam_id,d_survey,house_no,house_moo FROM  fm_fam_hd AS a 
    WHERE  house_no=? AND house_moo=? AND YEAR(d_survey)  IN (
        SELECT YEAR(d_survey) FROM  fm_fam_hd  WHERE YEAR(d_survey)=? 
    )",[$house_no,$mooHouse,$d_survseydate]);
} 
 if(isset($rows_old[0]->house_moo)){
  echo json_encode(['status'=>'dupicate']);
 }else{
 echo json_encode(['status'=>'nodupicate']);
 }
 
?>
