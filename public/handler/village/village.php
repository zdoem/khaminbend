<?php
require_once '../../bootstart.php';    
require ROOT . '/core/security.php';
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
$water_desc=(isset($_POST['water_desc']) ? $_POST['water_desc'] : '');

$water_tap=((isset($_POST['water_tap'])&&@$_POST['water_tap']>0) ? $_POST['water_tap'] :0);
$water_tap_desc=(isset($_POST['water_tap_desc']) ? $_POST['water_tap_desc'] : '');

$bowels=((isset($_POST['bowels'])&&@$_POST['bowels']>0) ? $_POST['bowels'] : 0);
$bowels_desc=(isset($_POST['bowels_desc']) ? $_POST['bowels_desc'] : '');

$public_fire=((isset($_POST['public_fire'])&&@$_POST['public_fire']>0) ? $_POST['public_fire'] : 0);
$public_fire_desc=(isset($_POST['public_fire_desc']) ? $_POST['public_fire_desc'] : '');

$road=((isset($_POST['road'])&&@$_POST['road']>0) ? $_POST['road'] :0);
$road_desc=(isset($_POST['road_desc']) ? $_POST['road_desc'] : '');

$community_forest=((isset($_POST['community_forest'])&&@$_POST['community_forest']>0) ? $_POST['community_forest'] : 0);
$community_forest_desc=((isset($_POST['community_forest_desc'])&&@$_POST['community_forest_desc']>0) ? $_POST['community_forest_desc'] : '');

$learning=((isset($_POST['learning'])&&@$_POST['learning']>0) ? $_POST['learning'] : 0);
$learning_desc=(isset($_POST['learning_desc']) ? $_POST['learning_desc'] : '');

$other=(isset($_POST['other']) ? $_POST['other'] : ''); 
  
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
     if(@$rows_old->vil_moo==$txtMoo){ 
      $action='dupicate'; 
      $status ='dupicate'; 
     }
}  

 if ($action == 1) {/*Insert Data*/ 
    try { 
          $row =$db::insert("INSERT INTO tbl_mas_vilage (vil_moo,vil_name,vil_desc,water,water_desc,water_tap,water_tap_desc,bowels,bowels_desc
             ,public_fire,public_fire_desc,road,road_desc,community_forest,community_forest_desc,learning,learning_desc,other,d_create,d_update,create_by,f_status) 
             VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,'A')",[$txtMoo, $txtVillageName, $txthomeDesc,$nWater,$water_desc,$water_tap,$water_tap_desc
             ,$bowels,$bowels_desc,$public_fire,$public_fire_desc,$road,$road_desc,$community_forest,$community_forest_desc,$learning,$learning_desc,$other,@$_SESSION['user_id']]);
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
            [$txtVillageName, $txthomeDesc,$nWater,$water_desc,$water_tap,$water_tap_desc
            ,$bowels,$bowels_desc,$public_fire,$public_fire_desc
            ,$road,$road_desc,$community_forest,$community_forest_desc,$learning,$learning_desc,$other,$id]);

            $status='OK';  

    } catch (\Exception $e) { 
		 $status='Error';   
    } 
 
} else if($action == 3) {// Deleted 
        try {
           $countdelete = $db::table("fm_fam_hd AS a")
          ->Join('tbl_mas_vilage AS b', 'a.house_moo', 'b.vil_id') 
          ->select($db::raw("house_moo"))->where('a.house_moo', '=', $id)->count(); 
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
   $mag='';$icon_type='error';
   switch ($status) {
     case 'OK': $mag='บันทึกข้อมูลแล้ว!';$icon_type='success'; break;
     case 'dupicate': $mag='ข้อมูลซ้ำ!';$icon_type='error'; break;
     case 'Error': $mag='ไม่สามารถดำเนินการได้!';$icon_type='error';break;
     case 'delete_used': $mag='มีการใช้อยู่ไม่สามารถลบข้อมูลได้!';$icon_type='error';break;
     case 'deletefail': $mag='ลบข้อมูลไม่ได้!';$icon_type='error';break; 
   }
   ?>
  Swal.fire({
  icon: '<?=$icon_type?>', 
  html: '<?=$mag?>',
  });
  $("input[name*='token_village_frm']").val('<?=\Volnix\CSRF\CSRF::getToken('token_village_frm')?>'); 
 setTimeout(function(){
   <?php
    if($status!='dupicate'){
      ?>
        window.location = "../../<?=$refer_urlmain?>?house_moo=<?=$txtMoo?>";
      <?php
    }
    ?> 
 }, 2*1000);

// window.location = "../../status_action.php?status=<?=$status?>&refer_urlmain=<?=$refer_urlmain?>";
</script>
<?php
?>