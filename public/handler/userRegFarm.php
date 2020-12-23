<?php
require '../bootstart.php';  
$cmd=@$_POST['cmd'];  //I,U,D
//$id=@$_POST['id']; 
$status='';  
$refer_urlmain='userRegFarmList.php';  
// echo '<pre>';
// print_r($_REQUEST);
// exit();
// check validating csrf token name
//if (\Volnix\CSRF\CSRF::validate($_POST, 'token_village_frm')){ 
$xDelId=trim((isset($_POST['userDelId']) ? $_POST['userDelId'] : ''));
$xUserId=trim((isset($_POST['userId']) ? $_POST['userId'] : ''));
$xTxtPwd=(isset($_POST['txtPwd']) ? $_POST['txtPwd'] : '');
$xTxtfName=(isset($_POST['txtfName']) ? $_POST['txtfName'] : '');
$xTxtlName=(isset($_POST['txtlName']) ? $_POST['txtlName'] : '');
$xTxtEmail=(isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '');
$xTxtMobile=(isset($_POST['txtMobile']) ? $_POST['txtMobile'] : '');
$xTxtPosition=(isset($_POST['txtPosition']) ? $_POST['txtPosition'] : '');
$xDeptId=(isset($_POST['deptId']) ? $_POST['deptId'] : '');
$xRoleId=(isset($_POST['roleId']) ? $_POST['roleId'] : '');

// validate 
/*$rows_old=null;
if($id>0){
$rows_old = $db::table("tbl_mas_vilage")
    ->where('vil_id', '=', $id)
    ->select($db::raw("vil_id,vil_moo"))
    ->first();
  if($action!=3){
         if(!isset($rows_old->vil_id)){// ไม่มีข้อมูลเก่าให้ insert ใหม่ 
         $action=1;  
         }else if($rows_old->vil_moo!=$txtMoo){// มีข้อมูลอยู่แล้วให้ update 
         $action=2;  
         }
    } 
}else{
  $action=1;     
}  
*/
//echo "x=====> ".$xDelId;
//echo $cmd;
 if ($cmd == 'I') {/*Insert Data*/ 
    try { 
        
          $new_pass = md5(S_SALT.$xTxtPwd); 
          $row = $db::insert("INSERT INTO tbl_users (user_id,password,fname,lname,position_name,email,mobile,dept_code ,role_code,f_status,d_create,create_by) 
                    VALUES(?,?,?,?,?,?,?,?,?,'A',NOW(),? )"
              ,[$xUserId, $new_pass,$xTxtfName,$xTxtlName,$xTxtPosition,$xTxtEmail,$xTxtMobile,$xDeptId,$xRoleId,@$_SESSION['user_id']]);
          
            $status='OK'; 
    } catch (\Exception $e) { 
		 $status='Error';  //var_dump($e->getMessage());exit(); 
    } 
 }else if($cmd == 'U'){// update data
     
     try {
         $row =$db::update('update tbl_users set fname=?,lname=?,position_name=?,email=?
            ,mobile=?,dept_code=?,role_code=?,update_by=?,d_update=NOW()
             where user_id = ?',
             [$xTxtfName, $xTxtlName,$xTxtPosition,$xTxtEmail,$xTxtMobile,$xDeptId,$xRoleId,@$_SESSION['user_id'],$xUserId]);
         
         $status='OK';
         
     } catch (\Exception $e) {
         $status='Error';
     }
     
 } else if($cmd == 'D') {// Deleted
     try {  
         //echo "1111111111111";
         $row =$db::table('tbl_users')->where('user_id', '=', $xDelId)->delete();
         //echo "2222222222";
         $status='OK';
     } catch (\Exception $e) {
         $status='Error';
     }
     //echo json_encode(['status'=>$status,'token'=>\Volnix\CSRF\CSRF::getToken('token_village_frm')]); exit();
 }
//}
 ?>
 
<script type="text/javascript">
	window.location = "../../successPage.php?status=<?=$status?>&refer_urlmain=<?=$refer_urlmain?>";
</script>
<?php
?>