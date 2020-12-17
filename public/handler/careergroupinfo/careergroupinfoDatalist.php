<?php
require_once '../../bootstart.php';  
require ROOT . '/core/security.php';  
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = addslashes($_POST['goccup_name']); // Search value
// var_dump($columnName);exit();
## Search
$searchQuery = " ";
$filtering=$db::table("tbl_mas_group_occup")->select($db::raw('count(*) as allcount'))->whereRaw('1');
$fetchrecords=$db::table("tbl_mas_group_occup")->select($db::raw('goccup_code,goccup_name,goccup_desc,f_status'))->whereRaw('1');
 
if ($searchValue != '') {  
    $filtering->where('goccup_name', 'like', "%{$searchValue}%"); 
     $fetchrecords->where('goccup_name', 'like', "%{$searchValue}%"); 
} 
## Total number of records without filtering 
$totalRecords = $db::table("tbl_mas_group_occup")  
    ->select($db::raw('count(*) as allcount')) 
    ->count(); 

$totalRecordwithFilter =$filtering->count(); 

$records =$fetchrecords->orderByRaw($columnName.' '.$columnSortOrder)->offset($row)->limit($rowperpage)->get();
 
$data =[]; 
foreach ($records as $k => $v) { 
    $tmp_moo=$v->goccup_name;
    $data[] =[
        "rownumber"=>($k+1)+$row,
        "id"=>$v->goccup_code,
        "goccup_name" =>$tmp_moo, 
        "goccup_desc" => $v->goccup_desc,
        "f_status" => $v->f_status, 
    ];
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data,
);

echo json_encode($response); 
 
?>