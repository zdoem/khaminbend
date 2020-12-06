<?php
require_once '../../bootstart.php';
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$d_survey = addslashes($_POST['date_survey']); // Search value
$house_no = addslashes($_POST['txtHouseNo']); // Search value
$owner_fname = addslashes($_POST['owner_house']); // Search value
$citizen_id = addslashes($_POST['txtCitizenId']); // Search value

// var_dump($columnName);exit();
## Search
$searchQuery = " ";
$filtering = $db::table("fm_fam_hd AS a")->select($db::raw('count(*) as allcount'))
             ->Join('tbl_mas_vilage AS b','a.house_moo','b.vil_id')->whereRaw('1');
$fetchrecords = $db::table("fm_fam_hd AS a")->select($db::raw('a.fam_id,a.d_create,a.d_survey,a.d_update,a.f_status,vil_moo,vil_name,house_no,owner_fname'))
            ->Join('tbl_mas_vilage AS b','a.house_moo','b.vil_id')->whereRaw('1');

if ($d_survey != '') {
    $filtering->whereYear('d_survey',$d_survey);
    $fetchrecords->whereYear('d_survey',$d_survey);
}
if ($house_no != '') {
    $filtering->where('house_no', 'like', "%{$house_no}%");
    $fetchrecords->where('house_no', 'like', "%{$house_no}%");
}
if ($owner_fname != '') {
    $filtering->where('owner_fname', 'like', "%{$owner_fname}%");
    $fetchrecords->where('owner_fname', 'like', "%{$owner_fname}%");
}
if ($citizen_id != '') {
    $filtering->where('citizen_id', 'like', "%{$citizen_id}%");
    $fetchrecords->where('citizen_id', 'like', "%{$citizen_id}%");
} 

## Total number of records without filtering
$totalRecords = $db::table("fm_fam_hd AS a")
    ->select($db::raw('count(*) as allcount')) 
    ->count();

$totalRecordwithFilter = $filtering->count();

$records = $fetchrecords->orderByRaw($columnName . ' ' . $columnSortOrder)->offset($row)->limit($rowperpage)->get();
// echo $records;exit(); toSql
$data = [];
foreach ($records as $k => $v) {
    $f_moo = $v->vil_moo.'-'.$v->vil_name. "<br><small>Created ".thaidate('j/m/Y', strtotime($v->d_survey))."</small>";
    $f_update='<small>'.thaidate('j/m/Y', strtotime($v->d_update)).'<br>'.thaidate('H:i', strtotime($v->d_update))."</small>";
    $data[] = [
        "rownumber" =>($k+1)+$row,
        "id" => $v->fam_id,
        "d_create" => $v->d_create,
        "d_update" => $v->d_update,
        "d_survey" => '<small>'.thaidate('j/m/Y', strtotime($v->d_survey)).'</small>', 
        "f_status" => $v->f_status,
        "vil_moo" => $v->vil_moo,
        "vil_name" => $v->vil_name, 
        "house_no" => $v->house_no,
        "owner_fname" => $v->owner_fname,
        "f_vil_moo" => $f_moo,
        "f_update" => $f_update,
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
exit();