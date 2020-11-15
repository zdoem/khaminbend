<?php
require_once '../bootstart.php';   

$action=@$_POST['action'];
$csrf=@$_POST['csrf'];
$id=@$_POST['id'];
$action=1;
if ($id > 0){$action = 2;} 
// echo '<pre>';
// print_r($_REQUEST);
// exit();

$txtMoo=(isset($_POST['txtMoo']) ? $_POST['txtMoo'] : '');
$txtVillageName=(isset($_POST['txtVillageName']) ? $_POST['txtVillageName'] : '');
$txtDesc=(isset($_POST['txtDesc']) ? $_POST['txtDesc'] : '');

$nWater=(isset($_POST['nWater']) ? $_POST['nWater'] : '');
$waterDesc=(isset($_POST['waterDesc']) ? $_POST['waterDesc'] : '');

$nPlumbing=(isset($_POST['nPlumbing']) ? $_POST['nPlumbing'] : '');
$plumbingDesc=(isset($_POST['plumbingDesc']) ? $_POST['plumbingDesc'] : '');

$nUndergroundWater=(isset($_POST['nUndergroundWater']) ? $_POST['nUndergroundWater'] : '');
$UndergroundWaterDesc=(isset($_POST['UndergroundWaterDesc']) ? $_POST['UndergroundWaterDesc'] : '');

$nElectriclight=(isset($_POST['nElectriclight']) ? $_POST['nElectriclight'] : '');
$ElectriclightDesc=(isset($_POST['ElectriclightDesc']) ? $_POST['ElectriclightDesc'] : '');

$nRoad=(isset($_POST['nRoad']) ? $_POST['nRoad'] : '');
$RoadDesc=(isset($_POST['RoadDesc']) ? $_POST['RoadDesc'] : '');

$nCommunityForest=(isset($_POST['nCommunityForest']) ? $_POST['nCommunityForest'] : '');
$CommunityForestDesc=(isset($_POST['CommunityForestDesc']) ? $_POST['CommunityForestDesc'] : '');

$nLearning=(isset($_POST['nLearning']) ? $_POST['nLearning'] : '');
$LearningDesc=(isset($_POST['LearningDesc']) ? $_POST['LearningDesc'] : '');

$txtOther=(isset($_POST['txtOther']) ? $_POST['txtOther'] : ''); 

$status='';  
$refer_urlmain='villageList.php';

 if ($action == 1) {/*Insert Data*/ 
    try { 
        $tbl_mas_vilage_old = $db::table("tbl_mas_vilage")
            ->where('vil_id', '=', $txtMoo) 
            ->select($db::raw("vil_id"))
            ->first();
        if(!isset($tbl_mas_vilage_old->vil_id)){ 
                $db::insert('INSERT INTO tbl_mas_vilage
                        (PeriodID,TypeLottoID,Number,CreateDateTime)
                        values
                        (?,?,?,GETDATE())'
            , [$txtMoo, $txtVillageName, $txtDesc,$nWater,$waterDesc,$nPlumbing,$plumbingDesc
			,$nUndergroundWater,$UndergroundWaterDesc,$nElectriclight,$ElectriclightDesc
			,$nRoad,$RoadDesc,$nCommunityForest,$CommunityForestDesc,$nLearning,$LearningDesc,$txtOther]);
            $status='OK';  
		}else{// ข้อมูลซ้ำ
		    $status='duplicate';  
		}  
        //$ReturnObject = (object)array('pStatus' => 'success', 'pMessage' => '�ѹ�֡�����������');
        //echo json_encode($ReturnObject); 
    } catch (\Exception $e) { 
		 $status='Error';  
        /*$data = @unserialize($e->getMessage());
        if (is_array($data)){
            $ReturnObject = (object)array('pStatus' => 'error', 'pMessage' =>$data['pMessage']);
        } else {
            $ReturnObject = (object)array('pStatus' => 'error', 'pMessage' =>$e->getMessage());
        }
        echo json_encode($ReturnObject); */
    } 
}else if($action == 2){// update data

    try { 
        $tbl_mas_vilage_old = $db::table("tbl_mas_vilage")
            ->where('vil_id', '=', $txtMoo) 
            ->select($db::raw("vil_id"))
            ->first();
        if(isset($tbl_mas_vilage_old->vil_id)){ 
			     $db::update('update tbl_mas_vilage set Credit=?,CreditRemain=? where vil_id = ?',[$txtMoo, $txtVillageName, $txtDesc,$nWater,$waterDesc,$nPlumbing,$plumbingDesc
			,$nUndergroundWater,$UndergroundWaterDesc,$nElectriclight,$ElectriclightDesc
			,$nRoad,$RoadDesc,$nCommunityForest,$CommunityForestDesc,$nLearning,$LearningDesc,$txtOther]);
            $status='OK';  
		}else{// ไม่พบข้อมูลที่จะแก้ไข
		    $status='notfound';  
		}   
    } catch (\Exception $e) { 
		 $status='Error';   
    } 
 
} else if($action == 3) {// Deleted 
        try {
            $db::table('tbl_mas_vilage')->where('vil_id', '=', $id)->delete(); 
			$status='deleted'; 
        } catch (\Exception $e) { 
           $status='deletefail';  
        }
}
 ?>
<script type="text/javascript">
window.location.href = "<?=Get_domain();?>/status_action.php?status=<?=$status?>&refer_urlmain=<?=$refer_urlmain?>";
</script>
<?php
?>