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
    ->where('goccup_name', '=', $goccup_name)
    ->select($db::raw("goccup_code,goccup_name"))
    ->first(); 
  if($action!=3){
        $action=2;  
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
//  var_dump($action);exit();
 if ($action == 1) {/*Insert Data*/ 
    try {  
           $row =$db::insert("INSERT INTO tbl_mas_group_occup (goccup_name,goccup_desc,f_status) 
             VALUES(?,?,'A')",[$goccup_name, $goccup_desc, $f_status]);
            $status='OK'; 
    } catch (\Exception $e) { 
		 $status='Error';    
    } 
}else if($action == 2){// update data

    try {  
            $row =$db::update('update tbl_mas_group_occup set goccup_name=?,goccup_desc=?,f_status=? where goccup_code = ?',
            [$goccup_name, $goccup_desc,$f_status,$id]);

            $status='OK';  

    } catch (\Exception $e) { 
		 $status='Error';    
    } 
 
} else if($action == 3) {// Deleted 
        try {
           $countdelete = $db::table("fm_fam_hd AS a")
          ->Join('tbl_mas_group_occup AS b', 'a.g_occupational_code', 'b.goccup_code') 
          ->select($db::raw("g_occupational_code"))->where('a.g_occupational_code', '=', $id)->count();  //echo $countdelete;exit();
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
  $("input[name*='token_careergroupinfo_frm']").val('<?=\Volnix\CSRF\CSRF::getToken('token_careergroupinfo_frm')?>'); 
 setTimeout(function(){
   <?php
    if($status!='dupicate'){
      ?>
       window.location = "../../<?=$refer_urlmain?>?house_moo=<?=$goccup_name?>";
      <?php
    }
    ?> 
 }, 2*1000); 
</script>
<?php
?>