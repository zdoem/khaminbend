<?php
require_once '../../bootstart.php';    

$action=@$_POST['action']; 
$id=@$_POST['id']; 

$status='';  
$refer_urlmain='villageList.php'; 
// echo '<pre>';
// print_r($_REQUEST);
// exit();

// check validating csrf token name

if (\Volnix\CSRF\CSRF::validate($_POST, 'token_village_frm')){ 
 
$txtMoo=trim((isset($_POST['txtMoo']) ? $_POST['txtMoo'] : ''));
$txtVillageName=(isset($_POST['txtVillageName']) ? $_POST['txtVillageName'] : '');
$txthomeDesc=(isset($_POST['txthomeDesc']) ? $_POST['txthomeDesc'] : '');

$nWater=((isset($_POST['nWater'])&&@$_POST['nWater']>0) ? $_POST['nWater'] : 0);
$waterDesc=(isset($_POST['waterDesc']) ? $_POST['waterDesc'] : '');

$water_tap=((isset($_POST['water_tap'])&&@$_POST['water_tap']>0) ? $_POST['water_tap'] :0);
$water_tap_desc=(isset($_POST['water_tap_desc']) ? $_POST['water_tap_desc'] : '');

$bowels=((isset($_POST['bowels'])&&@$_POST['bowels']>0) ? $_POST['bowels'] : 0);
$bowels_desc=(isset($_POST['bowels_desc']) ? $_POST['bowels_desc'] : '');

$nElectriclight=((isset($_POST['nElectriclight'])&&@$_POST['nElectriclight']>0) ? $_POST['nElectriclight'] : 0);
$ElectriclightDesc=(isset($_POST['ElectriclightDesc']) ? $_POST['ElectriclightDesc'] : '');

$nRoad=((isset($_POST['nRoad'])&&@$_POST['nRoad']>0) ? $_POST['nRoad'] :0);
$RoadDesc=(isset($_POST['RoadDesc']) ? $_POST['RoadDesc'] : '');

$nCommunityForest=((isset($_POST['nCommunityForest'])&&@$_POST['nCommunityForest']>0) ? $_POST['nCommunityForest'] : 0);
$CommunityForestDesc=((isset($_POST['CommunityForestDesc'])&&@$_POST['CommunityForestDesc']>0) ? $_POST['CommunityForestDesc'] : 0);

$nLearning=((isset($_POST['nLearning'])&&@$_POST['nLearning']>0) ? $_POST['nLearning'] : 0);
$LearningDesc=(isset($_POST['LearningDesc']) ? $_POST['LearningDesc'] : '');

$txtOther=(isset($_POST['txtOther']) ? $_POST['txtOther'] : ''); 
  
// validate 

$rows_old=null;
if($id>0){
   $rows_old = $db::table("tbl_mas_vilage")
    ->where('vil_id', '=', $id)
    ->select($db::raw("vil_id,vil_moo"))
    ->first();
  if($action!=3){
         if(!isset($rows_old->vil_id)){// ไม่มีข้อมูลเก่าให้ insert ใหม่ 
         $action=1;  
         }else if($rows_old->vil_moo==$txtMoo){// มีข้อมูลอยู่แล้วให้ update 
         $action=2;  
         }
    } 
}else{
  $action=1;     
   $rows_old = $db::table("tbl_mas_vilage")
    ->where('vil_moo', '=', $txtMoo)
    ->select($db::raw("vil_id,vil_moo"))
    ->first();
     if($rows_old->vil_moo==$txtMoo){ 
      $action='dupicate'; 
      $status ='dupicate'; 
     }
}  

 if ($action == 1) {/*Insert Data*/ 
    try { 
          $row =$db::insert("INSERT INTO tbl_mas_vilage (vil_moo,vil_name,vil_desc,water,water_desc,water_tap,water_tap_desc,bowels,bowels_desc
             ,public_fire,public_fire_desc,road,road_desc,community_forest,community_forest_desc,learning,learning_desc,other,d_create,d_update,create_by,f_status) 
             VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,'A')",[$txtMoo, $txtVillageName, $txthomeDesc,$nWater,$waterDesc,$water_tap,$water_tap_desc
             ,$bowels,$bowels_desc,$nElectriclight,$ElectriclightDesc,$nRoad,$RoadDesc,$nCommunityForest,$CommunityForestDesc,$nLearning,$LearningDesc,$txtOther,@$_SESSION['user_id']]);
            $status='OK'; 
    } catch (\Exception $e) { 
		 $status='Error';  //var_dump($e->getMessage());exit(); 
    } 
}else if($action == 2){// update data

    try {  
            $row =$db::update('update tbl_mas_vilage set vil_name=?,vil_desc=?,water=?,water_desc=?
            ,water_tap=?,water_tap_desc=?,bowels=?,bowels_desc=?,public_fire=?,public_fire_desc=?,road=?,road_desc=?
            ,community_forest=?,community_forest_desc=?,learning=?,learning_desc=?,other=?,d_update=NOW()
            where vil_id = ?',
            [$txtVillageName, $txthomeDesc,$nWater,$waterDesc,$water_tap,$water_tap_desc
            ,$bowels,$bowels_desc,$nElectriclight,$ElectriclightDesc
            ,$nRoad,$RoadDesc,$nCommunityForest,$CommunityForestDesc,$nLearning,$LearningDesc,$txtOther,$id]);

            $status='OK';  

    } catch (\Exception $e) { 
		 $status='Error';   
    } 
 
} else if($action == 3) {// Deleted 
        try {
           $countdelete = $db::table("fm_fam_hd AS a")
          ->Join('tbl_mas_vilage AS b', 'a.house_moo', 'b.vil_id') 
          ->select($db::raw("house_moo"))->count(); 
          if($countdelete<=0){
            $row =$db::table('tbl_mas_vilage')->where('vil_id', '=', $id)->delete(); 
			      $status='deleted'; 
          }else{
            $status='delete_used';
          } 
        } catch (\Exception $e) { 
           $status='deletefail';   
        }
        echo json_encode(['status'=>$status,'token'=>\Volnix\CSRF\CSRF::getToken('token_village_frm')]); exit();
  }
} 

 ?>
 
<script type="text/javascript"> 
   <?php 
   switch ($status) {
     case 'OK': ?> alert('บันทึกข้อมูลแล้ว!'); <?php break;
     case 'dupicate': ?> alert('ข้อมูลซ้ำ!'); <?php  break;
     case 'Error': ?> alert('ไม่สามารถดำเนินการได้!'); <?php break;
     case 'delete_used': ?> alert('มีการใช้อยู่ไม่สามารถลบข้อมูลได้!'); <?php  break;
     case 'deletefail': ?> alert('ลบข้อมูลไม่ได้!'); <?php break; 
   }
   ?>
 window.location = "../../<?=$refer_urlmain?>";
// window.location = "../../status_action.php?status=<?=$status?>&refer_urlmain=<?=$refer_urlmain?>";
</script>
<?php
?>