<?php
require_once '../../bootstart.php';    
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = addslashes($_POST['vil_moo']); // Search value
$searchValue2 = addslashes($_POST['vil_name']); // Search value
// var_dump($_POST);exit();
## Search
$searchQuery = " ";
$filtering=$db::table("tbl_mas_vilage")->select($db::raw('count(*) as allcount'))->whereRaw('1');
$fetchrecords=$db::table("tbl_mas_vilage")->select($db::raw('vil_id,vil_moo,vil_name,vil_desc,water,water_desc,water_tap,water_tap_desc,bowels,bowels_desc
             ,public_fire,public_fire_desc,road,road_desc,community_forest,community_forest_desc,learning,learning_desc,other,d_create,d_update,f_status'))->whereRaw('1');
 
if ($searchValue != '') { 
    //  $filtering->where('vil_moo', 'like', "%{$searchValue}%")->orWhere('vil_name', 'like', "%{$searchValue}%"); 
    $filtering->where('vil_moo', 'like', "%{$searchValue}%"); 
     $fetchrecords->where('vil_moo', 'like', "%{$searchValue}%");

}
if ($searchValue2 != '') { 
     $filtering->where('vil_name', 'like', "%{$searchValue2}%"); 
     $fetchrecords->where('vil_name', 'like', "%{$searchValue2}%");
}
## Total number of records without filtering 
$totalRecords = $db::table("tbl_mas_vilage")  
    ->select($db::raw('count(*) as allcount')) 
    ->count(); 

$totalRecordwithFilter =$filtering->count(); 

$records =$fetchrecords->orderByRaw($columnName.' '.$columnSortOrder)->offset($row)->limit($rowperpage)->get();
 
$data =[]; 
foreach ($records as $k => $v) { 
     $tmp_moo=$v->vil_moo."<br><small>Created ".thaidate('j/m/Y',strtotime($v->d_create))."</small>";
    $data[] =[
        "rownumber"=>'#',
        "id"=>$v->vil_id,
        "vil_moo" =>$tmp_moo,
        "vil_name"=>$v->vil_name,
        "vil_desc" => $v->vil_desc,
        "d_update" => thaidate('j/m/Y H:i:s',strtotime($v->d_update)), 
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