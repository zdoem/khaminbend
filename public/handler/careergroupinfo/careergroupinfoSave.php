<?php
require_once '../../bootstart.php';    
require ROOT . '/core/security.php';
$action=@$_POST['action']; 
$id=@$_POST['id']; 

$status='';  
$refer_urlmain='careergroupinfolist.php'; 
// echo '<pre>';
// print_r($_REQUEST);
// exit();

// check validating csrf token name

if (\Volnix\CSRF\CSRF::validate($_POST, 'token_careergroupinfo_frm')){ 
 
$goccup_name=trim((isset($_POST['goccup_name']) ? $_POST['goccup_name'] : ''));
$goccup_desc=(isset($_POST['goccup_desc']) ? $_POST['goccup_desc'] : '');
$f_status=(isset($_POST['f_status']) ? $_POST['f_status'] : 'A'); 
  
// validate 

$rows_old=null;
if($id>0){
   $rows_old = $db::table("tbl_mas_group_occup")
    ->where('goccup_code', '=', $id)
    ->select($db::raw("goccup_code,goccup_name"))
    ->first();
  if($action!=3){
         if(!isset($rows_old->goccup_code)){// ไม่มีข้อมูลเก่าให้ insert ใหม่ 
         $action=1;  
         }else if($rows_old->goccup_name==$goccup_name){// มีข้อมูลอยู่แล้วให้ update 
         $action=2;  
         }
    } 
}else{
  $action=1;     
   $rows_old = $db::table("tbl_mas_group_occup")
    ->where('goccup_name', '=', $goccup_name)
    ->select($db::raw("goccup_code,goccup_name"))
    ->first();
     if(@$rows_old->goccup_name==$goccup_name){ 
      $action='dupicate'; 
      $status ='dupicate'; 
     }
}  

 if ($action == 1) {/*Insert Data*/ 
    try {  
           $row =$db::insert("INSERT INTO tbl_mas_group_occup (goccup_name,goccup_desc,f_status) 
             VALUES(?,?,'A')",[$goccup_name, $goccup_desc, $f_status]);
            $status='OK'; 
    } catch (\Exception $e) { 
		 $status='Error';    var_dump($e->getMessage());exit(); 
    } 
}else if($action == 2){// update data

    try {  
            $row =$db::update('update tbl_mas_group_occup set goccup_name=?,goccup_desc=?,f_status=? where goccup_code = ?',
            [$goccup_desc, $goccup_desc,$f_status,$id]);

            $status='OK';  

    } catch (\Exception $e) { 
		 $status='Error';   
    } 
 
} else if($action == 3) {// Deleted 
        try {
           $countdelete = $db::table("fm_fam_hd AS a")
          ->Join('tbl_mas_group_occup AS b', 'a.g_occupational_code', 'b.goccup_code') 
          ->select($db::raw("g_occupational_code"))->where('a.g_occupational_code', '=', $id)->toSql();  echo $countdelete;exit();
          if($countdelete<=0){
            $row =$db::table('tbl_mas_group_occup')->where('goccup_code', '=', $id)->delete(); 
			      $status='deleted'; 
          }else{
            $status='delete_used';
          } 
        } catch (\Exception $e) { 
           $status='deletefail';   
        }
        echo json_encode(['status'=>$status,'token'=>\Volnix\CSRF\CSRF::getToken('token_careergroupinfo_frm')]); exit();
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
 window.location = "../../<?=$refer_urlmain?>?house_moo=<?=$goccup_name?>";
// window.location = "../../status_action.php?status=<?=$status?>&refer_urlmain=<?=$refer_urlmain?>";
</script>
<?php
?>