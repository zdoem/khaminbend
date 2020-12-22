<?php
require '../bootstart.php';  
$cmd=@$_POST['cmd'];  //I,U,D
//$id=@$_POST['id']; 
$status='';  

$xUserId=trim((isset($_POST['userId']) ? $_POST['userId'] : ''));

$resultRow = $db::table("tbl_users")
->select($db::raw("user_id,email"))
->where('user_id', '=', $xUserId)
->first();

//->first();
//->get()->toArray();
//https://makitweb.com/return-json-response-ajax-using-jquery-php/
$return_arr = array();
//echo 
if(is_null($resultRow)){
    //No record
     $return_arr[] = array("xId" => 'OK',
            "xUserId" => $xUserId,
            "xDesc" => 'สามารถใช้งาน  ('.$xUserId.' ) ได้',
            "xStatus" => 'Y');
}else {
   // $rows_edit->vil_name
    if($resultRow->user_id == $xUserId){
        $return_arr[] = array("xId" => '!!! No .. ',
            "xUserId" => $xUserId,
            "xDesc" => '!! ผู้ใช้งานนี้   '.$xUserId.'  ถูกใช้แล้วกรุณาระบุใหม่ ',
            "xStatus" => 'N');
    }else{
        $return_arr[] = array("xId" => 'OK',
            "xUserId" => $xUserId,
            "xDesc" => 'สามารถใช้งาน  ('.$xUserId.') ได้',
            "xStatus" => 'Y');
    }
}
echo json_encode($return_arr);
?>
