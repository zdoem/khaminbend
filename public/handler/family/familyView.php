<?php
require_once '../../bootstart.php';    
 
$id=@$_GET['id']; 
$row= $db::table("fm_fam_hd AS a")  
    ->where('fam_id', '=', $id)
    ->select($db::raw("a.fam_id,a.d_create,a.d_survey,a.d_update,a.f_status"))->first();
    
 if(isset($row->fam_id)){ 

$listprovinces = $db::table("provinces")
    ->select($db::raw("id,code,name_th,name_en"))
    ->orderBy('name_th', 'asc')
    ->get()->toArray();

$listamphures = [];

$listmas_vilage = $db::table("tbl_mas_vilage")
    ->select($db::raw("vil_id,vil_moo,vil_name,vil_desc"))
    ->where('f_status', '=', 'A')
    ->orderBy('vil_moo', 'asc')
    ->get()->toArray();

$listmas_occupation = $db::table("tbl_mas_occupation")
    ->select($db::raw("occup_code,occup_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('occup_desc', 'asc')
    ->get()->toArray();

$listmas_relations = $db::table("tbl_mas_relations")
    ->select($db::raw("re_code,re_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('re_desc', 'asc')
    ->get()->toArray();

$listmas_prefix = $db::table("tbl_mas_prefix")
    ->select($db::raw("pre_code,pre_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('pre_desc', 'asc')
    ->get()->toArray();

$listmas_religion = $db::table("tbl_mas_religion")
    ->select($db::raw("reg_code,reg_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('reg_desc', 'asc')
    ->get()->toArray();

$listmas_pet = $db::table("tbl_mas_pet")
    ->select($db::raw("pet_code,pet_name,pet_type"))
    ->where('f_status', '=', 'A')
    ->orderBy('pet_code', 'asc')
    ->get()->toArray();

$listmas_info = $db::table("tbl_mas_info")
    ->select($db::raw("info_code,info_name"))
    ->where('f_status', '=', 'A')
    ->get()->toArray();

$listmas_house_occup = $db::table("tbl_mas_house_occup")
    ->select($db::raw("hccup_code,hccup_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('hccup_desc', 'asc')
    ->get()->toArray();

$listmas_group_occup = $db::table("tbl_mas_group_occup")
    ->select($db::raw("goccup_code,goccup_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('goccup_desc', 'asc')
    ->get()->toArray(); 

$listmas_educate = $db::table("tbl_mas_educate")
    ->select($db::raw("ed_code,ed_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('ed_desc', 'asc')
    ->get()->toArray();

$listmas_disaster = $db::table("tbl_mas_disaster")
    ->select($db::raw("dis_code,dis_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('dis_code', 'asc')
    ->get()->toArray();

$listmas_addition = $db::table("tbl_mas_addition")
    ->select($db::raw("add_code,add_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('add_desc', 'asc')
    ->get()->toArray();

//-------------------------Data Update Query---------------------------------------------------------------------------------------------------
$data_fm_fam_hd = [];
$list_fm_fam_facilities_dt3 = [];
$list_fm_fam_pet_dt4 = [];
$list_fm_fam_info_dt6_selected = [];
$list_fm_fam_disaster_dt5_selected = [];
$deeds = [];
$distric_deeds = [];
$listpeople = [];
$norsor3kors = [];
$distric_norsor3kors = [];
$sorporkor = [];
$distric_sorporkor = [];
$chapter5s = [];
$distric_chapter5s = [];
$temlistpeople = ['prefix' => null, 'txtFName' => '', 'txtLName' => '', 'txtCitizenId' => '', 'xFstatusRd' => 'O', 'sexRd' => 'M'
    , 'txtNational' => '', 'religion' => null, 'birthday' => '', 'educationlevel' => null, 'homerelations' => null, 'careergroup' => null
    , 'careeranother' => '', 'careermain' => null, 'careersecond' => null, 'netIncome' => ''];
$listpeople[] = $temlistpeople;
//---------------------------------------------------------------------------------------------------------------
$house_no = ''; //บ้านเลขที่
$house_moo = null; //หมู่ที
$sub_district = ''; //ตำบล
$district = ''; //อำเภอ
$province = ''; //จังหวัด
$post_code = '';
$pre_owner = '';
$owner_fname = '';
$owner_lname = '';
$citizen_id = '';
$x_status = 'O'; //สถานภาพ O =owner , M=Member
$x_sex = 'M'; // เพศ M,W, หรือ O
$national = ''; //สัญชาติ
$reg_code = ''; //ศาสนา 01=พุทธ,02=อิสลาม 03=คริสต์ศาสนา 99 = อื่นๆ
$date_of_birth = '';
$education_code = '';
$relations_code = ''; //ความสัมพันธ์ในครัวเรือน 01 =หัวหน้าครอบครัว
$g_occupational_code = null; //กลุ่มอาชีพ 01 =กลุ่มอาชีพ1
$g_occupational_other = ''; //กลุุ่้มอาชีพอื่นๆ
$main_occupation_code = ''; //อาชีพหลัก
$add_occupation_code = ''; //อาชีพรอง/อาชีพเสริม
$income_per_year = '';
$fam_land_other = ''; //ที่ดินอื่นๆ
$eco_occupation_code = ''; //อาชีพในครัวเรือน
$eco_product_target_code = null; //เป้าหมายการผลิต : 01=ผลิตเพื่อบริโภค,02=ผลิตเพื่อจำหน่าย,03=ผลิตเพื่อบริโภคและจำหน่าย
$eco_capital_code = null; //แหล่งเงินทุน (ครัวเรือน) :01=เงินทุนส่วนตัว,02=กู้มาลงทุน,03=กู้บางส่วน
$eco_product_cost = ''; //ต้นทุนการผลิต
$f_problem_env = 'N'; //ปัญหาสิ่งแวดล้อมในครัวเรือน Y/N
$problem_env_desc = ''; //รายละเอียดปัญหาสิ่งแวดล้อมในครัวเรือน
$f_manage_env = 'N'; //การจัดการสิ่งแวดล้อม Y/N
$manage_env_desc = ''; //รายละเอียดการจัดการสิ่งแวดล้อม
$conserve_env = ''; //การอนุรักษ์สิ่งแวดล้อม
$f_help = 'N'; //เคยได้รับความช่วยเหลือ Y/N
$help_desc = '';
$eco_product_from = ''; //ช่วงเวลาการผลิต จาก
$eco_product_to = ''; //ช่วงเวลาการผลิต จาก
$familyhomeproductperiod = date('d/m/Y', time()) . ' - ' . date("d/m/Y", strtotime("+3 month", time())); //ช่วงเวลาการผลิต จาก ช่วงเวลาการผลิต จาก
$d_survey = date('d/m/Y h:i', time()); //วันเดือนปีสำรวจ

if (isset($_GET['id'])) { // update
    $data_fm_fam_hd = $db::table("fm_fam_hd")
        ->select($db::raw("fam_id,house_no,house_moo,sub_district,district,province,post_code,pre_owner,owner_fname,owner_lname,citizen_id,eco_product_from,eco_product_to
      ,x_status,x_sex,national,reg_code,date_of_birth,education_code,relations_code,g_occupational_code,g_occupational_other,main_occupation_code,add_occupation_code
      ,income_per_year,fam_land_other,eco_occupation_code,eco_product_target_code,eco_capital_code,eco_product_cost,f_problem_env,problem_env_desc
      ,f_manage_env,manage_env_desc,conserve_env,f_help,help_desc,d_survey"))
        ->where('fam_id', '=', $id)
        ->first();

    $house_no = (isset($data_fm_fam_hd->house_no) ? $data_fm_fam_hd->house_no : ''); //บ้านเลขที่
    $house_moo = ((isset($data_fm_fam_hd->house_moo) && !IsNullOrEmptyString($data_fm_fam_hd->house_moo)) ? $data_fm_fam_hd->house_moo : null); //หมู่ที
    $sub_district = (isset($data_fm_fam_hd->sub_district) ? $data_fm_fam_hd->sub_district : ''); //ตำบล
    $district = (isset($data_fm_fam_hd->district) ? $data_fm_fam_hd->district : ''); //อำเภอ
    $province = (isset($data_fm_fam_hd->province) ? $data_fm_fam_hd->province : ''); //จังหวัด
    $post_code = (isset($data_fm_fam_hd->post_code) ? $data_fm_fam_hd->post_code : '');
    $pre_owner = (isset($data_fm_fam_hd->pre_owner) ? $data_fm_fam_hd->pre_owner : '');
    $owner_fname = (isset($data_fm_fam_hd->owner_fname) ? $data_fm_fam_hd->owner_fname : '');
    $owner_lname = (isset($data_fm_fam_hd->owner_lname) ? $data_fm_fam_hd->owner_lname : '');
    $citizen_id = (isset($data_fm_fam_hd->citizen_id) ? $data_fm_fam_hd->citizen_id : '');
    $x_status = (isset($data_fm_fam_hd->x_status) ? $data_fm_fam_hd->x_status : 'O'); //สถานภาพ O =owner , M=Member
    $x_sex = (isset($data_fm_fam_hd->x_sex) ? $data_fm_fam_hd->x_sex : 'M'); // เพศ M,W, หรือ O
    $national = (isset($data_fm_fam_hd->national) ? $data_fm_fam_hd->national : ''); //สัญชาติ
    $reg_code = (isset($data_fm_fam_hd->reg_code) ? $data_fm_fam_hd->reg_code : null); //ศาสนา 01=พุทธ,02=อิสลาม 03=คริสต์ศาสนา 99 = อื่นๆ
    $date_of_birth = (isset($data_fm_fam_hd->date_of_birth) ? $data_fm_fam_hd->date_of_birth : '');
    $education_code = (isset($data_fm_fam_hd->education_code) ? $data_fm_fam_hd->education_code : '');
    $relations_code = (isset($data_fm_fam_hd->relations_code) ? $data_fm_fam_hd->relations_code : ''); //ความสัมพันธ์ในครัวเรือน 01 =หัวหน้าครอบครัว
    $g_occupational_code = ((isset($data_fm_fam_hd->g_occupational_code) && !IsNullOrEmptyString($data_fm_fam_hd->g_occupational_code)) ? $data_fm_fam_hd->g_occupational_code : null); //กลุ่มอาชีพ 01 =กลุ่มอาชีพ1
    $g_occupational_other = (isset($data_fm_fam_hd->g_occupational_other) ? $data_fm_fam_hd->g_occupational_other : ''); //กลุุ่้มอาชีพอื่นๆ
    $main_occupation_code = (isset($data_fm_fam_hd->main_occupation_code) ? $data_fm_fam_hd->main_occupation_code : null); //อาชีพหลัก
    $add_occupation_code = (isset($data_fm_fam_hd->add_occupation_code) ? $data_fm_fam_hd->add_occupation_code : null); //อาชีพรอง/อาชีพเสริม
    $income_per_year = (isset($data_fm_fam_hd->income_per_year) ? $data_fm_fam_hd->income_per_year : '');
    $fam_land_other = (isset($data_fm_fam_hd->fam_land_other) ? $data_fm_fam_hd->fam_land_other : ''); //ที่ดินอื่นๆ
    $eco_occupation_code = (isset($data_fm_fam_hd->eco_occupation_code) ? $data_fm_fam_hd->eco_occupation_code : ''); //อาชีพในครัวเรือน
    $eco_product_target_code = ((isset($data_fm_fam_hd->eco_product_target_code) && !IsNullOrEmptyString($data_fm_fam_hd->eco_product_target_code)) ? $data_fm_fam_hd->eco_product_target_code : null); //เป้าหมายการผลิต : 01=ผลิตเพื่อบริโภค,02=ผลิตเพื่อจำหน่าย,03=ผลิตเพื่อบริโภคและจำหน่าย
    $eco_capital_code = ((isset($data_fm_fam_hd->eco_capital_code) && !IsNullOrEmptyString($data_fm_fam_hd->eco_capital_code)) ? $data_fm_fam_hd->eco_capital_code : null); //แหล่งเงินทุน (ครัวเรือน) :01=เงินทุนส่วนตัว,02=กู้มาลงทุน,03=กู้บางส่วน
    $eco_product_cost = (isset($data_fm_fam_hd->eco_product_cost) ? $data_fm_fam_hd->eco_product_cost : 0); //ต้นทุนการผลิต
    $f_problem_env = (isset($data_fm_fam_hd->f_problem_env) ? $data_fm_fam_hd->f_problem_env : 'N'); //ปัญหาสิ่งแวดล้อมในครัวเรือน Y/N
    $problem_env_desc = (isset($data_fm_fam_hd->problem_env_desc) ? $data_fm_fam_hd->problem_env_desc : ''); //รายละเอียดปัญหาสิ่งแวดล้อมในครัวเรือน
    $f_manage_env = (isset($data_fm_fam_hd->f_manage_env) ? $data_fm_fam_hd->f_manage_env : 'N'); //การจัดการสิ่งแวดล้อม Y/N
    $manage_env_desc = (isset($data_fm_fam_hd->manage_env_desc) ? $data_fm_fam_hd->manage_env_desc : ''); //รายละเอียดการจัดการสิ่งแวดล้อม
    $conserve_env = (isset($data_fm_fam_hd->conserve_env) ? $data_fm_fam_hd->conserve_env : ''); //การอนุรักษ์สิ่งแวดล้อม
    $f_help = (isset($data_fm_fam_hd->f_help) ? $data_fm_fam_hd->f_help : 'N'); //เคยได้รับความช่วยเหลือ Y/N
    $help_desc = (isset($data_fm_fam_hd->help_desc) ? $data_fm_fam_hd->help_desc : '');
    $eco_product_from = (isset($data_fm_fam_hd->eco_product_from) ? $data_fm_fam_hd->eco_product_from : ''); //ช่วงเวลาการผลิต จาก
    $eco_product_to = (isset($data_fm_fam_hd->eco_product_to) ? $data_fm_fam_hd->eco_product_to : ''); //ช่วงเวลาการผลิต จาก
    if (!IsNullOrEmptyString($eco_product_from)) {$eco_product_from = date('d/m/Y', strtotime($eco_product_from));}
    if (!IsNullOrEmptyString($eco_product_to)) {$eco_product_to = date('d/m/Y', strtotime($eco_product_to));}
    if (!IsNullOrEmptyString($eco_product_from) && !IsNullOrEmptyString($eco_product_to)) {$familyhomeproductperiod = $eco_product_from . ' - ' . $eco_product_to;}
    $d_survey = (isset($data_fm_fam_hd->d_survey) ? $data_fm_fam_hd->d_survey : ''); //วันเดือนปีสำรวจ
    if (!IsNullOrEmptyString($d_survey)) {$d_survey = date('d/m/Y h:i', strtotime($d_survey));}

    // echo '<pre>';print_r($data_fm_fam_hd);exit();
    // var_dump($d_survey);exit();

    // $listpeople
    $c_fm_fam_hd = $db::table("fm_fam_members_dt1 AS a")
        ->select($db::raw("mem_pre AS prefix,f_status,mem_fname AS txtFName,mem_lname AS txtLName,mem_citizen_id AS txtCitizenId,mem_status AS xFstatusRd
      ,mem_sex AS sexRd,mem_national AS txtNational,mem_religion_code AS religion,mem_df_birth AS birthday,mem_education_code AS educationlevel
      ,mem_relations_code AS homerelations,null AS careergroup,null AS careeranother
      ,xmain_occupation_code AS careermain,xadditional_occupation_code AS careersecond ,xincome_per_year AS netIncome,mem_seq"))
        ->where('a.mem_fam_id', '=', $id);
    //->where('a.f_status', '=','A');

    $p_fm_fam_hd = $db::table("fm_fam_hd AS a")
        ->select($db::raw("pre_owner AS prefix,f_status,owner_fname AS txtFName,owner_lname AS txtLName,citizen_id AS txtCitizenId ,x_status AS xFstatusRd
      ,x_sex AS sexRd,national AS txtNational,reg_code AS religion,date_of_birth AS birthday,education_code AS educationlevel
      ,relations_code AS homerelations
      ,g_occupational_code AS careergroup,g_occupational_other AS  careeranother,main_occupation_code AS careermain,add_occupation_code AS careersecond
      ,income_per_year AS netIncome,1 AS mem_seq"))
        ->where('a.fam_id', '=', $id);
    //->where('a.f_status', '=','A');

    $final_query = $p_fm_fam_hd->unionall($c_fm_fam_hd);
    $querySql = $final_query->toSql();
    $all_content_query = $db::table($db::raw("($querySql) as t"))->mergeBindings($final_query);
    $listpeople = $all_content_query->select($db::raw("t.*"))->orderBy('mem_seq', 'asc')->get()->toArray();
    // ข้อมูลพื้นที่การเกษตร
    $list_fm_fam_land_dt2 = $db::table("fm_fam_land_dt2")
        ->select($db::raw("land_type,land_desc,province,district,title_deed_id AS nodeed,area1_rai AS arearai,area2_work AS areawork,area3_sqw AS areatrw,f_status"))
        ->orderBy('land_type', 'asc')
        ->orderBy('land_seq', 'asc')
        ->where('land_fam_id', '=', $id)
        ->get()->toArray();
    $deeds = [];
    $norsor3kors = [];
    $sorporkor = [];
    $chapter5s = [];
    $another = '';
    $distric_deeds = [];
    $distric_norsor3kors = [];
    $distric_sorporkor = [];
    $distric_chapter5s = [];
    foreach ($list_fm_fam_land_dt2 as $k => $v) {
        $list_district = $db::table("amphures")
            ->select($db::raw("code,name_th,name_en,province_id"))
            ->where('province_id', '=', $v->province)
            ->orderBy('id', 'asc')
            ->get()->toArray();
        switch ($v->land_type) {
            case 'title_deed':$deeds[] = $v;
                $distric_deeds[] = $list_district;
                break;
            case 'NorSor3Kor':$norsor3kors[] = $v;
                $distric_norsor3kors[] = $list_district;
                break;
            case 'sorporkor':$sorporkor[] = $v;
                $distric_sorporkor[] = $list_district;
                break;
            case 'porbortor5':$chapter5s[] = $v;
                $distric_chapter5s[] = $list_district;
                break;
            default:break;
        }
    }
    //5. ภัยธรรมชาติ fm_fam_disaster_dt5
    $list_fm_fam_disaster_dt5 = $db::table('fm_fam_disaster_dt5')
        ->select($db::raw('dis_code,dis_name,dis_desc'))
        ->where('dis_fam_id', $id)
        ->get()->toArray(); 
    foreach ($list_fm_fam_disaster_dt5 as $k => $v) {
        $list_fm_fam_disaster_dt5_selected[] = $v->dis_code;
    } 
    $list_fm_fam_info_dt6 = $db::table('fm_fam_info_dt6')
        ->select($db::raw('info_code,info_name,info_desc'))
        ->where('info_fam_id', '=', $id)
        ->get()->toArray();

    foreach ($list_fm_fam_info_dt6 as $k => $v) {
        $list_fm_fam_info_dt6_selected[] = $v->info_code;
    } 

}
//3.เครื่องมืออำนวยความสะดวกทางการเกษตร fm_fam_facilities_dt3
$base_join = $db::table('fm_fam_facilities_dt3')
    ->select($db::raw('fac_code,fac_name,fac_quantity,fac_desc'))
    ->where('fac_fam_id', $id);

$list_fm_fam_facilities_dt3 = $db::table('tbl_mas_facilities AS a')
    ->select($db::raw("a.fac_code,a.fac_name,b.fac_quantity,b.fac_desc
        ,CASE
        WHEN b.fac_code IS NOT NULL THEN 'true'
        WHEN b.fac_code IS NULL THEN null
        ELSE null
      END AS selected"))
    ->leftJoinSub($base_join, 'b', function ($join) {
        $join->on('a.fac_code', '=', 'b.fac_code');
    })->get()->toArray();

//4. สัตว์เลี้ยง fm_fam_pet_dt4
$base_join = $db::table('fm_fam_pet_dt4 as b')
    ->select($db::raw('pet_code,pet_quantity,pet_vacine_qt,pet_desc'))
    ->where('pet_fam_id', $id);
$list_fm_fam_pet_dt4 = $db::table('tbl_mas_pet AS a')
    ->select($db::raw("a.pet_code,a.pet_name,b.pet_quantity,b.pet_vacine_qt,b.pet_desc
        ,CASE
        WHEN b.pet_code IS NOT NULL THEN 'true'
        WHEN b.pet_code IS NULL THEN null
        ELSE null
      END AS selected"))
    ->Join('fm_fam_pet_dt4 as b','a.pet_code','b.pet_code')
    ->where('b.pet_fam_id', $id)
    ->get()->toArray();//toSql();//->
  
//-------------------------End Data Update Query---------------------------------------------------------------------------------------------------

$tbl_mas_info_base = splitMyArray($listmas_info, 3);
$tbl_mas_info1 = (isset($tbl_mas_info_base[0]) ? $tbl_mas_info_base[0] : []);
$tbl_mas_info2 = (isset($tbl_mas_info_base[1]) ? $tbl_mas_info_base[1] : []);
$tbl_mas_info3 = (isset($tbl_mas_info_base[2]) ? $tbl_mas_info_base[2] : []);
//ภัยธรรมชาติ
$disaster_datarows = splitMyArray($listmas_disaster, 2);
$listmas_disaster1 = (isset($disaster_datarows[0]) ? $disaster_datarows[0] : []);
$listmas_disaster2 = (isset($disaster_datarows[1]) ? $disaster_datarows[1] : []);

$Shouseinforgeneral = ['familyhomecareer' => $g_occupational_code, 'familyhomeproducttarget' => $eco_product_target_code
    , 'familyhomesourceoffunds' => $eco_capital_code, 'familyhomeproductperiod' => $familyhomeproductperiod, 'familyhomeproductioncost' => $eco_product_cost];
$Shouseinfor = ['txtHouseId' => $house_no, 'mooHouse' => $house_moo, 'txtSubDstrict' => $sub_district, 'txtDistrict' => $district, 'txtProvince' => $province
    , 'txtPostalCode' => $post_code];

?>
<script>
  // config data for vue
  var vilage = <?=json_encode($listmas_vilage);?>;
  window.Slistmas_vilage=vilage.reverse().concat({vil_id: null, vil_moo:null, vil_name: "กรุณาเลือกข้อมูล", vil_desc: ""}).reverse();
  var mas_prefix = <?=json_encode($listmas_prefix);?>;
  window.Slistmas_prefix=mas_prefix.reverse().concat({pre_code: null,pre_name: "กรุณาเลือกข้อมูล"}).reverse();
    //ศาสนา
  var religion = <?=json_encode($listmas_religion);?>;
  window.Slistmas_religion=religion.reverse().concat({reg_code: null, reg_name: "กรุณาเลือกข้อมูล"}).reverse();
  //ระดับการศึกษา:
  var educate = <?=json_encode($listmas_educate);?>;
  window.Slistmas_educate=educate.reverse().concat({ed_code: null, ed_name: "กรุณาเลือกข้อมูล"}).reverse();
  //ความสัมพันธ์ในครัวเรือน:
  var home_relations= <?=json_encode($listmas_relations);?>;
  window.Slistmas_relations=home_relations.reverse().concat({re_code: null, re_name: "กรุณาเลือกข้อมูล"}).reverse();
    // อาชีพในครัวเรือน
  var house_occup= <?=json_encode($listmas_house_occup); ?>;  
  window.Slistmas_house_occup=house_occup.reverse().concat({hccup_code: null, hccup_name: "กรุณาเลือกข้อมูล"}).reverse();
  window.Shouseinforgeneral=<?=json_encode($Shouseinforgeneral)?>;
  window.Shouseinfor=<?=json_encode($Shouseinfor)?>; 
  
  //กลุ่มอาชีพ:
  var group_occup= <?=json_encode($listmas_group_occup);?>;
  window.Slistmas_group_occup=group_occup.reverse().concat({goccup_code: null, goccup_name: "กรุณาเลือกข้อมูล"}).reverse();
  // อาชีพหลัก
  var occupation= <?=json_encode($listmas_occupation);?>;
  window.Slistmas_occupation=occupation.reverse().concat({occup_code: null, occup_name: "กรุณาเลือกข้อมูล"}).reverse();
  //อาชีพรอง
  var addition= <?=json_encode($listmas_addition); ?>;   
  window.Slistlistmas_addition=addition.reverse().concat({add_code: null, add_name: "กรุณาเลือกข้อมูล"}).reverse();
  // ข้อมูลจังหวัด
  var provinces= <?=json_encode($listprovinces);?>;
  window.Slistprovinces=provinces.reverse().concat({code: null,id:null,name_en:'กรุณาเลือกข้อมูล',name_th: "กรุณาเลือกข้อมูล"}).reverse();
  //-ช้อมูลอำเภอ
  window.distric_deeds=<?=json_encode($distric_deeds);?>;
  window.distric_norsor3kors =<?=json_encode($distric_norsor3kors);?>;
  window.distric_sorporkor =<?=json_encode($distric_sorporkor);?>;
  window.distric_chapter5s =<?=json_encode($distric_chapter5s);?>;

    //เครื่องมืออำนวยความสะดวกทางการเกษตร
  window.Slistmas_facilities=<?=json_encode($list_fm_fam_facilities_dt3);?>;
  // สัตว์เลี้ยง
  window.listmas_pet=<?=json_encode($list_fm_fam_pet_dt4);?>; 

  window.Sfamerdetaillists={deeds:<?=json_encode($deeds)?>,norsor3kors:<?=json_encode($norsor3kors)?>,spoks:<?=json_encode($sorporkor)?>,chapter5s:<?=json_encode($chapter5s)?>,another:'<?=$fam_land_other?>'};
  window.SSfamerdetaillists={deeds:<?=json_encode($deeds)?>,norsor3kors:<?=json_encode($norsor3kors)?>,spoks:<?=json_encode($sorporkor)?>,chapter5s:<?=json_encode($chapter5s)?>,another:'<?=$fam_land_other?>'};

  window.Sfamilylist=<?=json_encode($temlistpeople)?>;
  window.Sfamilylists=<?=json_encode($listpeople)?>;
  window.SSfamilylists=<?=json_encode($listpeople)?>;

  window.Mfamilylist={prefix:null,txtFName: '',txtLName:'',txtCitizenId:'' ,xFstatusRd:'O',sexRd:'M',txtNational:'',religion:null,birthday:''
  ,educationlevel:null,homerelations:null,careergroup:null,careeranother:'',careermain:null,careersecond:null,netIncome:''};
  //ข้อมูลพื้นที่การเกษตร
  window.Sfamerland={province:null,districtselect:null,district:'',nodeed:'',arearai:'',areawork:'',areatrw:''};
  //เป้าหมายการผลิต
  window.listfamilyhomeproducttarget=[{code:null,name:'กรุณาเลือกข้อมูล'}
  ,{code:1,name:'ผลิตเพื่อบริโภค'}
  ,{code:2,name:'ผลิตเพื่อจำหน่าย'}
  ,{code:3,name:'ผลิตเพื่อบริโภคและจำหน่าย'}];
//แหล่งเงินทุน (ครัวเรือน)
  window.listfamilyhomesourceoffunds=[{code:null,name:'กรุณาเลือกข้อมูล'}
  ,{code:1,name:'เงินทุนส่วนตัว'}
  ,{code:2,name:'กู้มาลงทุน'}
  ,{code:3,name:'กู้บ้างสวน'}];
  //สิ่งแวดล้อม
   window.xEnvironmental='<?=$f_problem_env?>';
   window.xEnvironmentaldisc='<?=$problem_env_desc?>';
   window.xEnvironmental2='<?=$f_manage_env?>';
   window.xEnvironmental2disc='<?=$manage_env_desc?>';
   window.greenxEnvironmentaldisc='<?=$conserve_env?>';
   window.helpme='<?=$f_help?>';
   window.helpmedisc='<?=$help_desc?>';
   //ข่าวสารทางด้านการเกษตร
   window.tbl_mas_info1=<?=json_encode($tbl_mas_info1);?>;
   window.tbl_mas_info2=<?=json_encode($tbl_mas_info2);?>;
   window.tbl_mas_info3=<?=json_encode($tbl_mas_info3);?>;
   window.Smas_info={selected:<?='["' . implode('", "', $list_fm_fam_info_dt6_selected) . '"]'?>,another:''};
   //ภัยธรรมชาติ
   window.listmas_disaster1=<?=json_encode($listmas_disaster1);?>;
   window.listmas_disaster2=<?=json_encode($listmas_disaster2);?>;
   window.Sdisaster={selected:<?='["' . implode('", "', $list_fm_fam_disaster_dt5_selected) . '"]'?>,another:''};

  window.d_survey={autoclose: true,format: 'DD/MM/YYYY HH:mm A',defaultDate:'<?=$d_survey?>'};

 </script>

 <section class="content" id="app" v-cloak> 
      <form @submit.prevent="submit" id="frm_family" ref="frm_family">   
        <!-- <pre>{{$data}}</pre> -->
        <!-- <pre>{{ $v }}</pre> -->  
       <div class="container-fluid"> 
        <!-- SELECT2 EXAMPLE ข้อมูลครัวเรือน -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลครัวเรือน [ที่อยู่ตามทะเบียนบ้าน]</h3>

            <div class="card-tools">
              <!-- <button type="button" class="btn btn-tool" title="Copy ข้อมูลคนล่าสุด" ><i class="fas fa-copy"></i></button>  -->
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> 
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>บ้านเลขที่ :</label>
                  <input type="text" :class="status($v.Mhouseinfor.txtHouseId)" required v-model.trim="$v.Mhouseinfor.txtHouseId.$model" name="txtHouseId" id="txtHouseId" class="form-control" placeholder="บ้านเลขที่  ...">
                </div>

              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>หมู่ที่ - ชื่อหมู่บ้าน :</label>
				       	<select class="form-control"  :class="status($v.Mhouseinfor.mooHouse)" required v-model.trim="$v.Mhouseinfor.mooHouse.$model" > 
                        <template v-for="(v, indexx) in listmas_vilage">
                          <option v-if="(indexx*1)==0" v-bind:value="v.vil_id" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.vil_name}}</option> 
                          <option v-if="(indexx*1)>0" v-bind:value="v.vil_id" v-bind:selected="indexx== 0 ? 'selected' : false">หมู่ที่ {{v.vil_moo}} - {{v.vil_name}}</option>
                        </template>
					     </select> 
                </div>

              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label>ตำบล :</label>
                     <input type="text" :class="status($v.Mhouseinfor.txtSubDstrict)" required v-model.trim="$v.Mhouseinfor.txtSubDstrict.$model"  name="txtSubDstrict" value="โคกขมิ้น" id="txtSubDstrict" class="form-control" placeholder="ตำบล  ...">
                 </div>
 
              </div>

            </div>

            <!-- /.row -->           
             <div class="row">

               <div class="col-md-4">
                 <div class="form-group">
                   <label>อำเภอ:</label>
                   <input type="text" :class="status($v.Mhouseinfor.txtDistrict)" required v-model.trim="$v.Mhouseinfor.txtDistrict.$model"  name="txtDistrict" value="พลับพลาชัย  " id="txtDistrict" class="form-control" placeholder="อำเภอ  ...">
                 </div>
 
               </div>
 
               <div class="col-md-4">
                 <div class="form-group">
                   <label>จังหวัด:</label>
                   <input type="text" :class="status($v.Mhouseinfor.txtProvince)" required v-model.trim="$v.Mhouseinfor.txtProvince.$model"  name="txtProvince" value="บุรีรัมย์ " id="txtProvince" class="form-control" placeholder="จังหวัด  ...">
                 </div>
 
               </div>
                <div class="col-md-4">
                      <div class="form-group">
                          <label>รหัสไปรษณีย์:</label>
                          <input type="text" :class="status($v.Mhouseinfor.txtPostalCode)" required v-model.trim="$v.Mhouseinfor.txtPostalCode.$model"  name="txtPostalCode" value="31250" id="txtPostalCode" class="form-control" placeholder="รหัสไปรษณีย์  ...">
                      </div>
        
                  </div>
  
             </div>

          </div>
          <!-- /.card-header -->

          <!-- /.card-body
          <div class="card-footer">
            xxx about  the plugin.
          </div>-->
        </div>
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE ข้อมูลสมาชิกในครัวเรือน -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลสมาชิกในครัวเรือน</h3> &nbsp;  &nbsp; 
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
         <template v-for="(item, index) in $v.Mfamilylists.$each.$iter"> 
            <h5>ลำดับที่ : {{(index*1)+1}}   
		    	</h5>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>คำนำหน้า:</label>
                  <!-- v-model="item.prefix" v-bind:class="{ 'error dirty':item.prefix.$error, '': !item.prefix.$error}" v-model.trim="item.prefix.$model"-->
                  <select class="form-control" :class="status(item.prefix)" required v-model.trim="item.prefix.$model" @blur="item.prefix.$touch()">
                     <option v-for="(v, indexx) in listmas_prefix" v-bind:value="v.pre_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.pre_name}}</option> 
                  </select>
                </div>

              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ชื่อเจ้าบ้าน :</label>
                  <input type="text" :id="'txtFName'+index" :class="status(item.txtFName)" required v-model.trim="item.txtFName.$model" @blur="item.txtFName.$touch()" class="form-control" placeholder="ชื่อเจ้าบ้าน...">
                </div>

              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>นามสกุล:</label>
                  <input type="text" :id="'txtLName'+index" :class="status(item.txtLName)" required v-model.trim="item.txtLName.$model" @blur="item.txtLName.$touch()" class="form-control" placeholder="นามสกุล...">
                </div>

              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>เลขที่ประจำตัวประชาชน  :</label>
                    <input type="text" :id="'txtCitizenId'+index" :class="status(item.txtCitizenId)" required v-model.trim="item.txtCitizenId.$model" @blur="item.txtCitizenId.$touch()" class="form-control" placeholder="เลขที่ประจำตัวประชาชน  ...">
                </div>

              </div>

            </div>


            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>สถานภาพ :</label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary1'+index" :disabled="index>0" value="O" :class="status(item.xFstatusRd)" v-model.trim="item.xFstatusRd.$model" @blur="item.xFstatusRd.$touch()"> 
                      <label :for="'radioPrimary1'+index">เจ้าบ้าน 
                      </label>
                    </div>
                    <div class="icheck-primary d-inline"> 
                      <input type="radio" :id="'radioPrimary2' + index" value="M" :class="status(item.xFstatusRd)" v-model.trim="item.xFstatusRd.$model" @blur="item.xFstatusRd.$touch()">
                      <label :for="'radioPrimary2'+index">ผู้อยู่อาศัย 
                      </label>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>เพศ  :</label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary3'+index" value="M" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioPrimary3'+index">ชาย
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary4'+index" value="W" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioPrimary4'+index">หญิง
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary5'+index"  value="O" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioPrimary5'+index">อื่นๆ
                      </label>
                    </div>
                  </div>
                </div>

              </div>


              <div class="col-md-3">
                <div class="form-group">
                  <label>สัญชาติ  :</label>
                  <input type="text" :id="'txtNational'+index" :class="status(item.txtNational)" required v-model.trim="item.txtNational.$model" @blur="item.txtNational.$touch()" class="form-control" placeholder="สัญชาติ  ...">
                </div>

              </div>

              <div class="col-md-3">
                 <div class="form-group">
                    <label>ศาสนา :</label>
                    <select class="form-control" :id="'religion'+index"  :class="status(item.religion)" required v-model.trim="item.religion.$model" @blur="item.religion.$touch()">
                      <option v-for="(v, indexx) in listmas_religion" :value="v.reg_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.reg_name}}</option> 
                    </select>
                  </div>
  
                </div>
 
            </div> 
            <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label>วันเดือนปีเกิด :</label>  
                   <date-picker2  v-model.trim="item.birthday.$model" @blur="item.birthday.$touch()"  required  :class="status(item.birthday)" :mdata="item.birthday.$model"></date-picker2>  
                </div>

              </div>


  
                <div class="col-md-3">
                   <div class="form-group">
                      <label>ระดับการศึกษา :</label>
                      <select class="form-control"  :id="'educationlevel'+index" :class="status(item.educationlevel)" required v-model.trim="item.educationlevel.$model" @blur="item.educationlevel.$touch()">
                        <option v-for="(v, indexx) in listmas_educate" :value="v.ed_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.ed_name}}</option> 
                      </select>
                    </div>
    
                  </div>
   
                 <div class="col-md-3">
                    <div class="form-group">
                       <label>ความสัมพันธ์ในครัวเรือน  :</label>
                       <select class="form-control" :id="'homerelations'+index" :class="status(item.homerelations)" required v-model.trim="item.homerelations.$model" @blur="item.homerelations.$touch()">
                          <option v-for="(v, indexx) in listmas_relations" :value="v.re_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.re_name}}</option>
                       </select>
                     </div> 
                   </div>
 

               <div class="col-md-3" v-if="index==0">
                    <div class="form-group">
                            <label>กลุ่มอาชีพ :</label>
                             <select class="form-control" :id="'careergroup'+index" :class="status(item.careergroup)" required v-model.trim="item.careergroup.$model" @blur="item.careergroup.$touch()">
                             <option v-for="(v, indexx) in listmas_group_occup" :value="v.goccup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.goccup_name}}</option> 
                            </select>
                     </div> 
                </div>
              <div class="col-md-3" v-if="index==0">
                <div class="form-group">
                  <label>กลุ่มอาชีพอื่นๆ  :</label>
                  <textarea class="form-control" :id="'careeranother'+index"  rows="1" placeholder="กลุ่มอาชีพอื่นๆ ระบุ  ..." :class="status(item.careeranother)" v-model.trim="item.careeranother.$model" @blur="item.careeranother.$touch()">
                      {{item.careeranother}}
                  </textarea>
                </div>
              </div>
				<div class="col-md-3">
					<div class="form-group">
							<label>อาชีพหลัก :</label>
							 <select class="form-control" :id="'careermain'+index"  :class="status(item.careermain)" required v-model.trim="item.careermain.$model" @blur="item.careermain.$touch()">  
                <option v-for="(vv, indexx) in listmas_occupation" :value="vv.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.occup_name}}</option> 
							</select>
					 </div>
				</div>
				 <div class="col-md-3">
					<div class="form-group">
							<label>อาชีพรอง :</label>
							 <select class="form-control" :id="'careersecond'+index" :class="status(item.careersecond)" v-model.trim="item.careersecond.$model" @blur="item.careersecond.$touch()">
               <option v-for="(vv, indexx) in listlistmas_addition" :value="vv.add_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.add_name}}</option>  
							</select>
					 </div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					  <label>รายได้/ต่อปี  :</label>								
						<input type="number" :id="'netIncome'+index" :class="status(item.netIncome)" v-model.trim="item.netIncome.$model" @blur="item.netIncome.$touch()" class="form-control btn-xs" placeholder="รายได้/ต่อปี...">
					</div>

				 </div>

              </div> 
              <hr v-if="showhr(Mfamilylists,index)">
            </template>  
          </div>  
        </div>
        <!-- /.card -->

       <!-- SELECT2 EXAMPLE ข้อมูลพื้นที่การเกษตร -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลพื้นที่การเกษตร </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
              <h5 class="d-sm-inline-block">โฉนด</h5> 
              <!-- <a class="d-sm-inline-block btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addDeed()"><i class="fas fa-plus-square"></i> เพิ่มโฉนด -->
              </a>  
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm" >
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 15%">จังหวัด</th>
                                <th style="width: 25%">อำเภอ</th>
                                <th style="width: 15%">เลขที่โฉนด</th>
                                <th style="width: 10%">พื้นที่(ไร่)</th>
                                <th style="width: 10%">พื้นที่(งาน)</th>
                                <th style="width: 10%">พื้นที่(ตรว.)</th>
                                <!-- <th style="width: 10%">#</th> -->
                              </tr>
                            </thead>
                              <tbody> 
                             <tr class="table-warning" v-if="Mfamerdetaillists.deeds.length<=0">
                               <td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                             <template v-for="(item, index) in $v.Mfamerdetaillists.deeds.$each.$iter">
                              <tr >
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
                        <select class="form-control btn-xs" :class="status(item.province)"  @change="getamphurbyprovince('deeds',$event,index)" v-model.trim="item.province.$model"  @blur="item.province.$touch()">
                           <option v-for="(v, indexx) in listprovinces" :value="v.id" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.name_th}}</option> 
                          </select>
                          </div>								
                        </td>
                        <td > 
                        <div class="form-group btn-xs"> 
                          <!-- :class="status(item.district)" v-model.trim="item.districtselect.$model" @blur="item.district.$touch()" -->    
                        <select class="form-control btn-xs"  v-model.trim="item.district.$model"  @blur="item.district.$touch()"  required > 
                            <template v-for="(vv, indexx) in distric_deeds[index]">  
                               <option :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
                            </template> 
                        </select>
                        </div>
                        </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="nodeed" :class="status(item.nodeed)" v-model.trim="item.nodeed.$model" @blur="item.nodeed.$touch()" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="arearai[]"  :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areatrw[]" :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <!-- <td>
                                <a href="javascript:void(0)" v-on:click="removeDeed(index)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
                                </td> -->
                              </tr>  
                              </template>  
                             </tbody>
                         </table>       
                    </div>  
                </div>   
                 

            <h5 class="d-sm-inline-block">นส.3ก</h5>
            <!-- <a class="inline btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addNorsor3kors()">
              <i class="fas fa-plus-square"></i> เพิ่ม นส.3ก
            </a> -->

            <div class="row">
              <div class="col-md-12">

                    <table class="table table-sm" >
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 15%">จังหวัด</th>
                                <th style="width: 25%">อำเภอ</th>
                                <th style="width: 15%">เลขที่โฉนด</th>
                                <th style="width: 10%">พื้นที่(ไร่)</th>
                                <th style="width: 10%">พื้นที่(งาน)</th>
                                <th style="width: 10%">พื้นที่(ตรว.)</th>
                                <!-- <th style="width: 10%">#</th> -->
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="table-warning" v-if="Mfamerdetaillists.norsor3kors.length<=0"><td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                              <template v-for="(item, index) in $v.Mfamerdetaillists.norsor3kors.$each.$iter">
                              <tr>
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
								    <select class="form-control  btn-xs" name="province[]" :class="status(item.province)" @change="getamphurbyprovince('norsor3kors',$event,index)" v-model.trim="item.province.$model" @blur="item.province.$touch()">
								      <option v-for="(v, indexx) in listprovinces" :value="v.id" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.name_th}}</option> 
									</select>
								   </div>								
								</td>
								<td>
								<div class="form-group btn-xs">
								 <select class="form-control btn-xs" v-model.trim="item.district.$model"  name="district[]"  :class="status(item.district)" @blur="item.district.$touch()"> 
                   <template v-for="(vv, indexx) in distric_norsor3kors[index]">  
                             <option :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
                    </template> 
								</select>
							   </div>
								</td>								
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="nodeed[]" :class="status(item.nodeed)" v-model.trim="item.nodeed.$model" @blur="item.nodeed.$touch()" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="arearai[]" :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areatrw[]"  :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <!-- <td>
                                  <a href="javascript:void(0)" v-on:click="removeNorsor3kors(index)"  class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td> -->
                              </tr>
                              </template> 
                            </tbody>
                          </table>

              </div>
            </div>
            <h5 class="d-sm-inline-block">สปก.</h5>
            <!-- <a class="inline btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addSpoks()">
              <i class="fas fa-plus-square"></i> เพิ่ม สปก.
            </a> -->

            <div class="row">
              <div class="col-md-12">

               <table class="table table-sm" >
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 15%">จังหวัด</th>
                                <th style="width: 25%">อำเภอ</th>
                                <th style="width: 15%">เลขที่โฉนด</th>
                                <th style="width: 10%">พื้นที่(ไร่)</th>
                                <th style="width: 10%">พื้นที่(งาน)</th>
                                <th style="width: 10%">พื้นที่(ตรว.)</th>
                                <!-- <th style="width: 10%">#</th> -->
                              </tr>
                            </thead>
                            <tbody>
                            <tr class="table-warning" v-if="Mfamerdetaillists.spoks.length<=0"><td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                             <template v-for="(item, index) in $v.Mfamerdetaillists.spoks.$each.$iter">
                              <tr>
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control  btn-xs" name="province[]" :class="status(item.province)" @change="getamphurbyprovince('spoks',$event,index)" v-model.trim="item.province.$model" @blur="item.province.$touch()">
									   <option v-for="(v, indexx) in listprovinces" :value="v.id" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.name_th}}</option> 
									</select>
								   </div>								
								</td>
								<td>
								<div class="form-group btn-xs">
								 <select class="form-control btn-xs" v-model.trim="item.district.$model"  name="district[]" :class="status(item.district)"  @blur="item.district.$touch()">
								    <template v-for="(vv, indexx) in distric_sorporkor[index]">  
                              <option :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
                    </template> 
								</select>
							   </div>
								</td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="nodeed[]" :class="status(item.nodeed)" v-model.trim="item.nodeed.$model" @blur="item.nodeed.$touch()" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="arearai[]" :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areatrw[]"  :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <!-- <td>
                                  <a href="javascript:void(0)" v-on:click="removeSpoks(index)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td> -->
                              </tr>
                            </template>  
                            </tbody>
                          </table>

              </div>
            </div>
            <h5 class="d-sm-inline-block">ภบท 5</h5>
            <!-- <a class="inline btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addChapter5s()">
              <i class="fas fa-plus-square"></i> เพิ่ม ภบท 5
            </a> -->

            <div class="row">
              <div class="col-md-12">

                  <table class="table table-sm" >
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 15%">จังหวัด</th>
                                <th style="width: 25%">อำเภอ</th>
                                <th style="width: 15%">เลขที่โฉนด</th>
                                <th style="width: 10%">พื้นที่(ไร่)</th>
                                <th style="width: 10%">พื้นที่(งาน)</th>
                                <th style="width: 10%">พื้นที่(ตรว.)</th>
                                <!-- <th style="width: 10%">#</th> -->
                              </tr>
                            </thead>
                            <tbody>
                             <tr class="table-warning" v-if="Mfamerdetaillists.chapter5s.length<=0">
                               <td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                             <template v-for="(item, index) in $v.Mfamerdetaillists.chapter5s.$each.$iter">
                              <tr >
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control btn-xs" name="province[]"  :class="status(item.province)" @change="getamphurbyprovince('chapter5s',$event,index)" v-model.trim="item.province.$model" @blur="item.province.$touch()">
								    <option v-for="(v, indexx) in listprovinces" :value="v.id" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.name_th}}</option>  
								   </div>								
								</td>
								<td>
								<div class="form-group btn-xs"> 
								 <select class="form-control btn-xs" v-model.trim="item.district.$model"  name="district[]" :class="status(item.district)" @blur="item.district.$touch()">
								   <template v-for="(vv, indexx) in distric_chapter5s[index]">  
                               <option :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
                    </template> 
								</select>
							   </div>
								</td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="nodeed" :class="status(item.nodeed)" v-model.trim="item.nodeed.$model" @blur="item.nodeed.$touch()" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="arearai[]"  :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areatrw[]" :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <!-- <td>
                                <a href="javascript:void(0)" v-on:click="removeChapter5s(index)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
                                </td> -->
                              </tr>  
                              </template> 
                            </tbody>
                          </table> 
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>อื่นๆ :</label>
                  <textarea class="form-control" name="another" v-model="Mfamerdetaillists.another" rows="2" placeholder="อื่นๆ ..."></textarea>
                </div>
              </div>
            </div>


          </div> 
        </div> 

        <!-- SELECT2 EXAMPLE xxxx -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลทั่วไปของครัวเรือน</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <h5> เศรษฐกิจครัวเรือน</h5>
            <div class="row">             
              <div class="col-md-3">
               <div class="form-group">
                  <label>อาชีพในครัวเรือน:</label>
                  <select class="form-control" name="familyhomecareer" id="familyhomecareer" :class="status($v.Mhouseinforgeneral.familyhomecareer)" v-model.trim="$v.Mhouseinforgeneral.familyhomecareer.$model" @blur="$v.Mhouseinforgeneral.familyhomecareer.$touch()">
					         <option v-for="(vv, indexx) in listmas_house_occup" :value="vv.hccup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.hccup_name}}</option>  
				         </select> 
                </div> 
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>เป้าหมายการผลิต :</label>
                  <select class="form-control"  class="form-control" name="familyhomeproducttarget" id="familyhomeproducttarget" :class="status($v.Mhouseinforgeneral.familyhomeproducttarget)" v-model.trim="$v.Mhouseinforgeneral.familyhomeproducttarget.$model" @blur="$v.Mhouseinforgeneral.familyhomeproducttarget.$touch()" >
                    <option v-for="(vv, indexx) in listfamilyhomeproducttarget" :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.name}}</option> 
                  </select>
                </div>

              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>แหล่งเงินทุน (ครัวเรือน) :</label>
                  <select class="form-control"  class="form-control" name="familyhomesourceoffunds" id="familyhomesourceoffunds" :class="status($v.Mhouseinforgeneral.familyhomesourceoffunds)" v-model.trim="$v.Mhouseinforgeneral.familyhomesourceoffunds.$model" @blur="$v.Mhouseinforgeneral.familyhomesourceoffunds.$touch()">
                   <option v-for="(vv, indexx) in listfamilyhomesourceoffunds" :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.name}}</option> 
                  </select>
                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4">
                            <!-- Date range -->
                            <div class="form-group">
                              <label>ช่วงเวลาการผลิต:</label> 
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                  </span>
                                </div>
                                <!--  :class="status($v.Mhouseinforgeneral.familyhomeproductperiod)" v-model.trim="$v.Mhouseinforgeneral.familyhomeproductperiod.$model"@blur="$v.Mhouseinforgeneral.familyhomeproductperiod.$touch()" --> 
                                <!-- <input type="text" class="form-control float-right" class="form-control"  name="daterange" value="01/01/2018 - 01/12/2018" />      -->
                                 <datepickerrang :mdatarang="'<?=$familyhomeproductperiod?>'" @familyhomeproductperiod='up_familyhomeproductperiod' v-model="$v.Mhouseinforgeneral.familyhomeproductperiod.$model"></datepickerrang>  
                                <!-- <input type="text" class="form-control float-right" class="form-control" name="familyhomeproductperiod" id="familyhomeproductperiod" value="01/01/2018 - 01/12/2018"  > -->
                              </div>
                              <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>ต้นทุนการผลิต :</label>
                  <textarea class="form-control"  class="form-control" name="familyhomeproductioncost" id="familyhomeproductioncost" :class="status($v.Mhouseinforgeneral.familyhomeproductioncost)" v-model.trim="$v.Mhouseinforgeneral.familyhomeproductioncost.$model" @blur="$v.Mhouseinforgeneral.familyhomeproductioncost.$touch()" rows="1" placeholder="ต้นทุนการผลิต  ..."></textarea>
                </div>

              </div>

            </div>


            <label>เครื่องมืออำนวยความสะดวกทางการเกษตร</label>
            <div class="row">
              <template v-for="(item, index) in Mlistmas_facilities">   
              <div class="col-md-3">
                <div class="form-check">
				      <label class="form-check-label"> 
                  <input class="form-check-input" type="checkbox" v-model="item.selected"> {{item.fac_name}} </label>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" :disabled="!item.selected" v-model="item.fac_quantity" :placeholder="'จำนวน...' + item.fac_name"  value="">
                </div>
                </div>
   
              </template>
            </div>
			     <label> สัตว์เลี้ยง</label>

            <div class="row">
              <div class="col-md-12">

                  <table class="table table-sm" >
                            <thead>
                              <tr>
                                <th style="width: 5px">#</th>
                                <th style="width: 30px">ประเภทสัตว์เลี้ยง</th>
                                <th style="width: 15px">จำนวน</th>
                                <th style="width: 15px">จำนวน(ที่ได้รับวัคซีน) </th>
                                <th style="width: 50px">รายละเอียด</th>
                              </tr>
                            </thead>
                            <tbody>
                               <template v-for="(item, index) in listmas_pet">   
                                <tr>
                                  <td>{{index+1}}.</td>
                                   <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                  <input class="form-check-input"  type="checkbox" v-model="item.selected" :value="item.pet_code" :id="'apetcheck_'+item.pet_code"> {{item.pet_name}}</label>
                                </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                    <input type="number" :id="'pet_quantity'+item.pet_code" v-model="item.pet_quantity" :disabled="!item.selected"  class="form-control btn-xs"  :placeholder="'จำนวน'+item.pet_name+'...ตัว'" >					
                                    </div>
                                  </td>
                                <td>
                                    <div class="form-group">
                                    <input type="number" :id="'pet_vacine_qt'+item.pet_code"  v-model="item.pet_vacine_qt" :disabled="!item.selected" class="form-control btn-xs" :placeholder="'จำนวน'+item.pet_name+'(รับวัคซีนแล้ว)...ตัว'">					
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <textarea class="form-control btn-xs" :id="'pet_desc'+item.pet_code" :disabled="!item.selected" v-model="item.pet_desc" rows="2" :placeholder="'รายละเอียด'+item.pet_name+'...'"></textarea>
                                    </div>
                                  </td>                              
                                </tr> 
                          </template>  
                            </tbody>
                          </table>

              </div>
            </div>  

            <label>สิ่งแวดล้อม</label>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-check-label">ปัญหาสิ่งแวดล้อมในครัวเรือน :</label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary8" v-model="xEnvironmental" name="xEnvironmental" value="N">
                      <label for="radioPrimary8">ไม่มี
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary9" v-model="xEnvironmental" name="xEnvironmental"  value="Y" checked>
                      <label for="radioPrimary9">มี (ระบุ)					  
                      </label>
                        <textarea class="form-control" v-model="xEnvironmentaldisc" id="xEnvironmentaldisc" rows="1" placeholder="มี (ระบุ)..." :disabled="xEnvironmental=='N'"></textarea>
                    </div>
                  </div>
                </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-check-label">การจัดการสิ่งแวดล้อม :</label>
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary101x" v-model="xEnvironmental2" name="radioPrimary101x" value="N">
                        <label for="radioPrimary101x">ไม่มี
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary102x" v-model="xEnvironmental2" name="radioPrimary101x" value="Y">
                        <label for="radioPrimary102x">มี(ระบุ)
                        </label>
				          		 <textarea class="form-control" v-model="xEnvironmental2disc" id="xEnvironmental2disc" rows="1" :disabled="xEnvironmental2=='N'" placeholder="มี (ระบุ)..."></textarea>
                      </div>
                    </div>
                  </div>
                  </div> 
  
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-check-label">การอนุรักษ์สิ่งแวดล้อม</label>
                        <textarea class="form-control" v-model="greenxEnvironmentaldisc" id="greenxEnvironmentaldisc" rows="2" placeholder="การอนุรักษ์สิ่งแวดล้อม  ..."></textarea>
                      </div>
                    </div>
    

            </div>
			
  
            <div class="row">
              <div class="col-md-3">
                <label>ภัยธรรมชาติ</label>   
                <template  v-for="(item, index) in listmas_disaster1">
                     <div class="form-check" v-if="item.dis_code!=99">
                      <label class="form-check-label"> 
                      <input class="form-check-input" type="checkbox" name="disaster[]" v-model="Mdisaster.selected" :value="item.dis_code">
                      {{item.dis_name}}</label>
                    </div>
                    <div class="form-group" v-if="item.dis_code==99">
                        <textarea class="form-control" v-model="Mdisaster.another"  rows="1" placeholder="อื่นๆ  ..."></textarea>
                    </div>
                </template>			
               </div>
				

			   <div class="col-md-3">
         <label>&nbsp;</label>
                 <template  v-for="(item, index) in listmas_disaster2">
                     <div class="form-check" v-if="item.dis_code!=99">
                      <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="disaster[]" v-model="Mdisaster.selected" :value="item.dis_code">
                      {{item.dis_name}}</label>
                    </div>
                    <div class="form-group" v-if="item.dis_code==99">
                        <textarea class="form-control" v-model="Mdisaster.another"  rows="1" placeholder="อื่นๆ  ..."></textarea>
                    </div>
                </template>	 	 
                </div>

  

                <div class="col-md-6">
                  <div class="form-group">
                    <label >เคยได้รับความช่วยเหลือ :</label> 
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary12" name="helpme" v-model="helpme" value="N" >
                        <label for="radioPrimary12">ไม่เคย
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary13" name="helpme"  v-model="helpme"  value="Y" checked>
                        <label for="radioPrimary13">เคย(ระบุความช่วยเหลือจากหน่วยงานไหน)
                        </label>
				        		    <textarea class="form-control" name="helpmedisc" id="helpmedisc" v-model="helpmedisc" rows="2" :disabled="helpme=='N'"  placeholder="เคย (ความช่วยเหลือจากหน่วยงานไหน)..."></textarea>
                      </div>
                    </div>
                  </div>
                  </div>
  				  
            </div>

            <label>ข่าวสารทางด้านการเกษตร</label> 
            <div class="row">  
              <div class="col-md-3"> 
                  <template  v-for="(item, index) in tbl_mas_info1">
                        <div class="form-check" v-if="item.info_code!=99" :key="item.info_code">
                        <input class="form-check-input" type="checkbox" name="info_code[]" v-model="Mmas_info.selected"  :value="item.info_code">
                        <label class="form-check-label">{{item.info_name}}</label>
                      </div>
                      <div class="form-group" v-if="item.info_code==99" :key="item.info_code">
                       <label class="form-check-label">อื่นๆ</label>
                        <textarea class="form-control" name="info_code[]" v-model="Mmas_info.another" rows="1" placeholder="อื่นๆ  ..."></textarea>
                     </div>	
                 </template> 
                </div>
                
 
                <div class="col-md-3">
                  <template  v-for="(item, index) in tbl_mas_info2">
                        <div class="form-check" v-if="item.info_code!=99" :key="item.info_code">
                        <input class="form-check-input" type="checkbox" name="info_code[]" v-model="Mmas_info.selected"  :value="item.info_code">
                        <label class="form-check-label">{{item.info_name}}</label>
                      </div>
                      <div class="form-group" v-if="item.info_code==99" :key="item.info_code">
                       <label class="form-check-label">อื่นๆ</label>
                        <textarea class="form-control" name="info_code[]" v-model="Mmas_info.another" rows="1" placeholder="อื่นๆ  ..."></textarea>
                     </div>	
                 </template>
                </div>

                <div class="col-md-3">
                       <template  v-for="(item, index) in tbl_mas_info3">
                        <div class="form-check" v-if="item.info_code!=99" :key="item.info_code">
                        <input class="form-check-input" type="checkbox" name="info_code[]" v-model="Mmas_info.selected"  :value="item.info_code">
                        <label class="form-check-label">{{item.info_name}}</label>
                      </div>
                      <div class="form-group" v-if="item.info_code==99" :key="item.info_code">
                       <label class="form-check-label">อื่นๆ</label>
                        <textarea class="form-control" name="info_code[]" v-model="Mmas_info.another" rows="1" placeholder="อื่นๆ  ..."></textarea>
                     </div>	
                 </template>
                 </div>
 
            </div>
 
		  	 <div class="row"> 

               <div class="col-md-4"> 
                <div class="form-group">
                  <label>วันเดือนปีสำรวจ :</label>
                  <div class="input-group date datepickers" id="survseydate" data-target-input="nearest"> 
	               <input id="assessment_date" name="assessment_date" type="text" data-target="#survseydate" data-toggle="datetimepicker" 
                 class="form-control  col-md-8 datetimepicker-input assessment-date-keypress" data-target="#survseydate" autocomplete="off" required>
                  <div class="input-group-append" data-target="#survseydate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                 </div>
                </div> 
                </div>
              </div>  


		    	</div>

          </div>
          <!-- /.card-header -->

          <!-- /.card-body --> 
        </div>
        <!-- /.card -->

       </div><!-- /.container-fluid -->
      </form>
    </section>
    <script src="assets/js/family.js"></script>
    <div style="display: none;" id="xhtml"></div>
 <?php }else{  
?>
<h4 class="modal-title">ไม่พบแสดงข้อมูล!</h4>
<?php
 }?>