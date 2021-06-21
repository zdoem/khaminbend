<?php
require_once '../bootstart.php';  
require ROOT . '/core/security.php';  
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

 //TODO : request.getparameter from
 $deptCode = (isset($_POST['deptCode']) ? $_POST['deptCode'] : '');
 if($deptCode==''){
     $deptCode = "01";
 }
 $roleId = (isset($_POST['roleCode']) ? $_POST['roleCode'] : '');
 $userId = (isset($_POST['userId']) ? $_POST['userId'] : '');
 $fname = (isset($_POST['fname']) ? $_POST['fname'] : '');
// var_dump($columnName);exit();
## Search

 //TODO : for main query
 $resultRow = $db::table('tbl_users as a')
 ->leftJoin('tbl_departments as b', 'a.dept_code', '=', 'b.dept_code')
 ->leftJoin('tbl_role as c', 'a.role_code', '=', 'c.role_code')
 ->select($db::raw("a.*"),$db::raw("b.*"),$db::raw("c.*"))
 ->where([
     ['a.f_status', '=', 'A'],
     ['a.dept_code', '=', $deptCode],
     ['c.role_code', '<>','99']
 ]);
 //['a.user_id', '=', $userId],

 if($roleId != '') {
     $resultRow->where('a.role_code', '=', $roleId);
 }
 if($userId != '') {
     $resultRow->where('a.user_id', '=', $userId);
 }
 if($fname != '') {
     $resultRow->whereRaw("CONCAT(fname,' ',lname) like ?", ['%'.$fname.'%']);
 }

## Total number of records without filtering 

$totalRecordwithFilter =$resultRow->count(); 

$records =$resultRow->orderByRaw($columnName.' '.$columnSortOrder)->offset($row)->limit($rowperpage)->get();
 
$data =[]; 
foreach ($records as $k => $v) { 
     $fullname="<a>".$v->fname." ".$v->lname."</a><br/><small>Created ".thaidate('j/m/Y',strtotime($v->d_create))."</small>";
     $data[] =[
        "rownumber"=>($k+1)+$row,
        "user_id"=>$v->user_id, 
        "fname"=>$v->fname,
        "fullname"=>$fullname,
        "email"=>'<a>'.$v->email.'</a>',
        "mobile"=>$v->mobile,
        "position_name"=>'<small>'.$v->position_name.'</small>',
        "dept_name"=>'<small>'.$v->dept_name.'</small>',
        "role_name"=>'<small>'.$v->role_name.'</small>',
        "d_create" => thaidate('j/m/Y',strtotime($v->d_create)),
        "d_update" => thaidate('j/m/Y H:i:s',strtotime($v->d_update)), 
    ];
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data,
);

echo json_encode($response); 
 
?>