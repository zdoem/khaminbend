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
$d_survey = addslashes($_POST['date_survey']); // Search value
$house_no = addslashes($_POST['txtHouseNo']); // Search value
$mem_fname = addslashes($_POST['mem_fname']); // Search value
$citizen_id = addslashes($_POST['txtCitizenId']); // Search value

// var_dump($columnName);exit();
## Search
$searchQuery = " ";

$base_join = $db::table('fm_fam_members_dt1')
    ->select($db::raw('mem_fam_id,mem_status,mem_fname,mem_lname,f_status,mem_citizen_id'))
    ->where('mem_status', 'O')
    ->groupBy('mem_fam_id');

$filtering = $db::table("fm_fam_hd AS a")->select($db::raw('count(*) as allcount'))
             ->Join('tbl_mas_vilage AS b', 'a.house_moo', 'b.vil_id')
             ->leftJoinSub($base_join, 'cc', function ($join) {
                    $join->on('a.fam_id', '=', 'cc.mem_fam_id');
              })->whereRaw('1');
// $fetchrecords = $db::table("fm_fam_hd AS a")->select($db::raw('a.fam_id,a.d_create,a.d_survey,a.d_update,a.f_status,vil_moo,vil_name,house_no,mem_fname'))
//             ->Join('tbl_mas_vilage AS b','a.house_moo','b.vil_id')
//             ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
//             ->whereRaw('1');
 
$fetchrecords = $db::table('fm_fam_hd AS a')
    ->select($db::raw("a.fam_id,a.d_create,a.d_survey,a.d_update,vil_moo,vil_name,house_no,cc.mem_fname,cc.mem_lname,cc.mem_citizen_id,cc.f_status"))
    ->Join('tbl_mas_vilage AS b', 'a.house_moo', 'b.vil_id')
    ->leftJoinSub($base_join, 'cc', function ($join) {
        $join->on('a.fam_id', '=', 'cc.mem_fam_id');
    })->whereRaw('1');

if ($d_survey != '') {
    $filtering->whereYear('d_survey',$d_survey);
    $fetchrecords->whereYear('d_survey',$d_survey);
}else{
    $filtering->whereYear('d_survey',date('Y-m-d'));
    $fetchrecords->whereYear('d_survey',date('Y-m-d'));  
}
if ($house_no != '') {
    $filtering->where('house_no', '=', $house_no);
    $fetchrecords->where('house_no', '=', $house_no);
}
if ($mem_fname != '') {
    $filtering->where('mem_fname', 'like', "%{$mem_fname}%");
    $fetchrecords->where('mem_fname', 'like', "%{$mem_fname}%");
}
if ($citizen_id != '') {
    $filtering->where('mem_citizen_id', '=', $citizen_id);
    $fetchrecords->where('mem_citizen_id', '=', $citizen_id);
} 

## Total number of records without filtering
$totalRecords = $db::table("fm_fam_hd AS a")
    ->select($db::raw('count(*) as allcount')) 
    ->count();

$totalRecordwithFilter = $filtering->count();

$records = $fetchrecords->orderByRaw($columnName . ' ' . $columnSortOrder)->offset($row)->limit($rowperpage)->get();

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
        "mem_fname" => $v->mem_fname,
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