<?php
if (defined("ROOT")){ 
  require_once ROOT. '/public/bootstart.php';  
  }else{
  require_once '../../bootstart.php';
} 
require_once ROOT . '/core/security.php';  
if (!isset($_GET['id'])&&isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'&&@$_GET['type']=='copy') { throw new Exception("Error Processing Bad Request", 1);} 
$listprovinces= $db::table("provinces")
    ->select($db::raw("id,code,name_th,name_en")) 
    ->orderBy('name_th', 'asc')
    ->get()->toArray();   

$listmas_vilage= $db::table("tbl_mas_vilage")
    ->select($db::raw("vil_id,vil_moo,vil_name,vil_desc"))
    ->where('f_status', '=', 'A')
    ->orderBy('vil_moo', 'asc')
    ->get()->toArray();

$listmas_occupation=$db::table("tbl_mas_occupation") 
    ->select($db::raw("occup_code,occup_name"))
    ->where('f_status', '=','A')
    ->orderBy('occup_desc', 'asc')
    ->get()->toArray(); 

$listmas_relations= $db::table("tbl_mas_relations")
    ->select($db::raw("re_code,re_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('re_desc', 'asc')
    ->get()->toArray();

$listmas_prefix= $db::table("tbl_mas_prefix")
    ->select($db::raw("pre_code,pre_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('pre_desc', 'asc')
    ->get()->toArray(); 
  
$listmas_religion= $db::table("tbl_mas_religion")
    ->select($db::raw("reg_code,reg_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('reg_desc', 'asc')
    ->get()->toArray(); 

$listmas_pet = $db::table("tbl_mas_pet")
->select($db::raw("pet_code,pet_name,pet_type"))
->where('f_status', '=', 'A')
->orderBy('pet_code', 'asc')
->get()->toArray();
 
$listmas_house_occup= $db::table("tbl_mas_house_occup")
    ->select($db::raw("hccup_code,hccup_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('hccup_desc', 'asc')
    ->get()->toArray();

$listmas_group_occup= $db::table("tbl_mas_group_occup")
    ->select($db::raw("goccup_code,goccup_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('goccup_desc', 'asc')
    ->get()->toArray();

$listmas_educate= $db::table("tbl_mas_educate")
    ->select($db::raw("ed_code,ed_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('ed_desc', 'asc')
    ->get()->toArray();
 
$listmas_addition= $db::table("tbl_mas_addition")
    ->select($db::raw("add_code,add_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('add_desc', 'asc')
    ->get()->toArray();

//-------------------------Data Update Query---------------------------------------------------------------------------------------------------
 $id = @$_GET['id'];
 $data_fm_fam_hd=[];$list_fm_fam_facilities_dt3=[];$list_fm_fam_pet_dt4=[];
 $list_fm_fam_info_dt6_selected = [];$list_fm_fam_disaster_dt5_selected = [];
 $deeds=[];$distric_deeds=[];$listpeople=[];
 $norsor3kors=[];$distric_norsor3kors=[];
 $sorporkor=[];$distric_sorporkor=[]; 
 $chapter5s=[];$distric_chapter5s=[];
 $temlistpeople=['prefix'=>null,'txtFName'=>'','txtLName'=>'','txtCitizenId'=>'','xFstatusRd'=>'O','sexRd'=>'M'
  ,'txtNational'=>'ไทย','religion'=>'01','birthday'=>'','educationlevel'=>null,'homerelations'=>'01','careermain'=>null,'careersecond'=>'01','netIncome'=>'','memF_status'=>'A']; 
$listpeople[]=$temlistpeople; 

 $base_join = $db::table('fm_fam_info_dt6')
    ->select($db::raw('info_fam_id,info_code,info_name,info_desc'))
    ->where('info_fam_id', $id); 
 $listmas_info = $db::table('tbl_mas_info AS a')
     ->select($db::raw("a.info_code,a.info_name,b.info_desc"))
    ->leftJoinSub($base_join, 'b', function ($join) {
        $join->on('a.info_code', '=', 'b.info_code');
    })
   ->orderBy('info_code', 'asc')
    ->get()->toArray();  

$base_join = $db::table('fm_fam_disaster_dt5')
    ->select($db::raw('dis_fam_id,dis_code,dis_name,dis_desc'))
    ->where('dis_fam_id', $id);
$listmas_disaster = $db::table('tbl_mas_disaster AS a')
    ->select($db::raw("a.dis_code,a.dis_name,a.dis_desc,b.dis_desc AS dt_dis_desc"))
    ->leftJoinSub($base_join, 'b', function ($join) {
        $join->on('a.dis_code', '=', 'b.dis_code');
    })
    ->orderBy('a.dis_code', 'asc')
    ->get()->toArray(); 

//---------------------------------------------------------------------------------------------------------------
$house_no = ''; //บ้านเลขที่
$house_moo =null; //หมู่ที
$sub_district = 'โคกขมิ้น'; //ตำบล
$district ='พลับพลาชัย'; //อำเภอ
$province ='จังหวัดบุรีรัมย์'; //จังหวัด
$post_code ='31250';
$pre_owner = '';
$owner_fname ='';
$owner_lname ='';
$citizen_id = '';
$x_status ='O'; //สถานภาพ O =owner , M=Member
$x_sex ='M'; // เพศ M,W, หรือ O
$national = ''; //สัญชาติ
$reg_code =''; //ศาสนา 01=พุทธ,02=อิสลาม 03=คริสต์ศาสนา 99 = อื่นๆ
$date_of_birth ='';
$education_code ='';
$relations_code =''; //ความสัมพันธ์ในครัวเรือน 01 =หัวหน้าครอบครัว
$g_occupational_code =null; //กลุ่มอาชีพ 01 =กลุ่มอาชีพ1
$g_occupational_other =''; //กลุุ่้มอาชีพอื่นๆ
$main_occupation_code =''; //อาชีพหลัก
$add_occupation_code ='01'; //อาชีพรอง/อาชีพเสริม
$income_per_year ='';
$fam_land_other =''; //ที่ดินอื่นๆ
$eco_occupation_code =null; //อาชีพในครัวเรือน
$eco_product_target_code =null; //เป้าหมายการผลิต : 01=ผลิตเพื่อบริโภค,02=ผลิตเพื่อจำหน่าย,03=ผลิตเพื่อบริโภคและจำหน่าย
$eco_capital_code =null; //แหล่งเงินทุน (ครัวเรือน) :01=เงินทุนส่วนตัว,02=กู้มาลงทุน,03=กู้บางส่วน
$eco_product_cost =''; //ต้นทุนการผลิต
$f_problem_env ='N'; //ปัญหาสิ่งแวดล้อมในครัวเรือน Y/N
$problem_env_desc =''; //รายละเอียดปัญหาสิ่งแวดล้อมในครัวเรือน
$f_manage_env ='N'; //การจัดการสิ่งแวดล้อม Y/N
$manage_env_desc =''; //รายละเอียดการจัดการสิ่งแวดล้อม
$conserve_env =''; //การอนุรักษ์สิ่งแวดล้อม
$f_help ='N'; //เคยได้รับความช่วยเหลือ Y/N
$help_desc ='';
$eco_product_from =''; //ช่วงเวลาการผลิต จาก
$eco_product_to =''; //ช่วงเวลาการผลิต จาก 
$d_survey = DateConvert('topsre','d/m/Y',date('d/m/Y', time()),'/');//วันเดือนปีสำรวจ 
$alert_survey=DateConvert('topsre','d/m/Y h:i',date('d/m/Y h:i', time()),'/'); 
$actions='I'; 
if (isset($_GET['id'])) {// update 
  $actions='U';

  $base_join = $db::table('fm_fam_members_dt1')
    ->select($db::raw('mem_fam_id,mem_status,mem_pre,mem_fname,mem_lname,mem_citizen_id,mem_sex,mem_national,mem_religion_code,mem_df_birth,mem_education_code,mem_relations_code,f_status'))
    ->where('mem_status', 'O')
    ->where('mem_fam_id', '=', $_GET['id'])
    ->groupBy('mem_fam_id'); 
  $data_fm_fam_hd = $db::table('fm_fam_hd AS a')
    ->select($db::raw("fam_id,house_no,house_moo,sub_district,district,province,post_code,cc.mem_pre,cc.mem_fname,cc.mem_lname,cc.mem_citizen_id
      ,CONCAT(DATE_FORMAT(eco_product_from,'%d') ,'/', DATE_FORMAT(eco_product_from ,'%m'),'/',DATE_FORMAT(eco_product_from ,'%Y')+543) AS eco_product_from
      ,CONCAT(DATE_FORMAT(eco_product_to,'%d') ,'/', DATE_FORMAT(eco_product_to ,'%m'),'/',DATE_FORMAT(eco_product_to ,'%Y')+543) AS eco_product_to 
      ,mem_status AS x_status,mem_sex AS x_sex,mem_national AS national,mem_religion_code AS reg_code,mem_df_birth AS date_of_birth,mem_education_code AS education_code
      ,mem_relations_code AS relations_code,g_occupational_code,g_occupational_other,main_occupation_code,add_occupation_code
      ,income_per_year,fam_land_other,eco_occupation_code,eco_product_target_code,eco_capital_code,eco_product_cost,f_problem_env,problem_env_desc
      ,f_manage_env,manage_env_desc,conserve_env,f_help,help_desc,CONCAT(DATE_FORMAT(d_survey,'%d') ,'/', DATE_FORMAT(d_survey ,'%m'),'/',DATE_FORMAT(d_survey ,'%Y')+543) AS d_survey"))
    ->leftJoinSub($base_join, 'cc', function ($join) {
        $join->on('a.fam_id', '=', 'cc.mem_fam_id');
    })->where('fam_id', '=', $_GET['id'])->first();   

    if (isset($data_fm_fam_hd->d_survey)&&!IsNullOrEmptyString($data_fm_fam_hd->d_survey)) {$alert_survey = date('d/m/Y', strtotime($data_fm_fam_hd->d_survey));}
    $house_no = (isset($data_fm_fam_hd->house_no) ? $data_fm_fam_hd->house_no : ''); //บ้านเลขที่
    $house_moo = ((isset($data_fm_fam_hd->house_moo)&&!IsNullOrEmptyString($data_fm_fam_hd->house_moo)) ? $data_fm_fam_hd->house_moo :null); //หมู่ที
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
    $g_occupational_code =((isset($data_fm_fam_hd->g_occupational_code)&&!IsNullOrEmptyString($data_fm_fam_hd->g_occupational_code)) ? $data_fm_fam_hd->g_occupational_code :null); //กลุ่มอาชีพ 01 =กลุ่มอาชีพ1
    $g_occupational_other = (isset($data_fm_fam_hd->g_occupational_other) ? $data_fm_fam_hd->g_occupational_other : ''); //กลุุ่้มอาชีพอื่นๆ
    $main_occupation_code = (isset($data_fm_fam_hd->main_occupation_code) ? $data_fm_fam_hd->main_occupation_code : null); //อาชีพหลัก
    $add_occupation_code = (isset($data_fm_fam_hd->add_occupation_code) ? $data_fm_fam_hd->add_occupation_code : '01'); //อาชีพรอง/อาชีพเสริม
    $income_per_year = (isset($data_fm_fam_hd->income_per_year) ? $data_fm_fam_hd->income_per_year : '');
    $fam_land_other = (isset($data_fm_fam_hd->fam_land_other) ? $data_fm_fam_hd->fam_land_other : ''); //ที่ดินอื่นๆ
    $eco_occupation_code = (isset($data_fm_fam_hd->eco_occupation_code) ? $data_fm_fam_hd->eco_occupation_code : ''); //อาชีพในครัวเรือน
    $eco_product_target_code=((isset($data_fm_fam_hd->eco_product_target_code)&&!IsNullOrEmptyString($data_fm_fam_hd->eco_product_target_code)) ? $data_fm_fam_hd->eco_product_target_code :null); //เป้าหมายการผลิต : 01=ผลิตเพื่อบริโภค,02=ผลิตเพื่อจำหน่าย,03=ผลิตเพื่อบริโภคและจำหน่าย
    $eco_capital_code=((isset($data_fm_fam_hd->eco_capital_code)&&!IsNullOrEmptyString($data_fm_fam_hd->eco_capital_code)) ? $data_fm_fam_hd->eco_capital_code :null); //แหล่งเงินทุน (ครัวเรือน) :01=เงินทุนส่วนตัว,02=กู้มาลงทุน,03=กู้บางส่วน
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
    $d_survey = (isset($data_fm_fam_hd->d_survey) ? $data_fm_fam_hd->d_survey : ''); //วันเดือนปีสำรวจ 

    // echo '<pre>';print_r($data_fm_fam_hd);exit();
    // var_dump($d_survey);exit();

    // $listpeople
  $listpeople = $db::table("fm_fam_members_dt1 AS a")
    ->select($db::raw("mem_pre AS prefix,b.f_status,mem_fname AS txtFName,mem_lname AS txtLName,mem_citizen_id AS txtCitizenId,mem_status AS xFstatusRd
      ,mem_sex AS sexRd,mem_national AS txtNational,mem_religion_code AS religion
      ,CONCAT(DATE_FORMAT(mem_df_birth,'%d') ,'/', DATE_FORMAT(mem_df_birth ,'%m'),'/',DATE_FORMAT(mem_df_birth ,'%Y')+543) AS birthday,mem_education_code AS educationlevel
      ,mem_relations_code AS homerelations,b.g_occupational_code AS careergroup,b.g_occupational_other AS careeranother
      ,xmain_occupation_code AS careermain,xadditional_occupation_code AS careersecond ,xincome_per_year AS netIncome,mem_seq,a.F_status AS memF_status"))
    ->Join('fm_fam_hd AS b', 'b.fam_id', 'a.mem_fam_id')
    ->where('a.mem_fam_id', '=', $id)
    ->orderBy('mem_seq', 'asc')->get()->toArray();   
    // echo $listpeople;exit();

  // ข้อมูลพื้นที่การเกษตร 
  $list_fm_fam_land_dt2= $db::table("fm_fam_land_dt2")
      ->select($db::raw("land_type,land_desc,province,district,title_deed_id AS nodeed,area1_rai AS arearai,area2_work AS areawork,area3_sqw AS areatrw,f_status")) 
      ->orderBy('land_type', 'asc')
      ->orderBy('land_seq', 'asc')
      ->where('land_fam_id', '=',$id)
      ->get()->toArray();
  $deeds=[]; $norsor3kors=[];$sorporkor=[];$chapter5s=[]; $another=''; 
  $distric_deeds=[]; $distric_norsor3kors=[];$distric_sorporkor=[];$distric_chapter5s=[];
  foreach ($list_fm_fam_land_dt2 as $k => $v) { 
      $list_district=$db::table("amphures")
      ->select($db::raw("code,name_th,name_en,province_id"))
      ->where('province_id', '=', $v->province)
      ->orderBy('id', 'asc')
      ->get()->toArray();    
      switch ($v->land_type) {
        case 'title_deed': $deeds[]=$v;$distric_deeds[]=$list_district;  break;
        case 'NorSor3Kor': $norsor3kors[]=$v;$distric_norsor3kors[]=$list_district;  break;
        case 'sorporkor': $sorporkor[]=$v;$distric_sorporkor[]=$list_district;  break; 
        case 'porbortor5': $chapter5s[]=$v;$distric_chapter5s[]=$list_district;  break;
        default:   break;
      }
  }  
  //5. ภัยธรรมชาติ fm_fam_disaster_dt5
  $list_fm_fam_disaster_dt5 = $db::table('fm_fam_disaster_dt5')
      ->select($db::raw('dis_code,dis_name,dis_desc'))
      ->where('dis_fam_id', $_GET['id'])
      ->get()->toArray();

  foreach ($list_fm_fam_disaster_dt5 as $k => $v) {
      $list_fm_fam_disaster_dt5_selected[] = $v->dis_code;
  }
  // var_dump($list_fm_fam_disaster_dt5_array);exit();
  // echo json_encode($list_fm_fam_disaster_dt5);exit();
  // 6. ข่าวสารทางด้านการเกษตร fm_fam_info_dt6
 $list_fm_fam_info_dt6 = $db::table('fm_fam_info_dt6')
      ->select($db::raw('info_code,info_name,info_desc'))
      ->where('info_fam_id', '=', $_GET['id'])
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
$base_join = $db::table('fm_fam_pet_dt4')
    ->select($db::raw('pet_code,pet_quantity,pet_vacine_qt,pet_desc'))
    ->where('pet_fam_id', $id); 
$list_fm_fam_pet_dt4 = $db::table('tbl_mas_pet AS a')
    ->select($db::raw("a.pet_code,a.pet_name,b.pet_quantity,IFNULL(b.pet_vacine_qt,0)AS pet_vacine_qt,b.pet_desc
        ,CASE
        WHEN b.pet_code IS NOT NULL THEN 'true'
        WHEN b.pet_code IS NULL THEN null
        ELSE null
      END AS selected"))
    ->leftJoinSub($base_join, 'b', function ($join) {
        $join->on('a.pet_code', '=', 'b.pet_code');
    })->get()->toArray();

// var_dump($list_fm_fam_pet_dt4);exit();

//-------------------------End Data Update Query---------------------------------------------------------------------------------------------------

$tbl_mas_info_base = splitMyArray($listmas_info, 3);
$tbl_mas_info1 = (isset($tbl_mas_info_base[0]) ? $tbl_mas_info_base[0] : []);
$tbl_mas_info2 = (isset($tbl_mas_info_base[1]) ? $tbl_mas_info_base[1] : []);
$tbl_mas_info3 = (isset($tbl_mas_info_base[2]) ? $tbl_mas_info_base[2] : []);
//ภัยธรรมชาติ
$disaster_datarows = splitMyArray($listmas_disaster, 2);
$listmas_disaster1 = (isset($disaster_datarows[0]) ? $disaster_datarows[0] : []);
$listmas_disaster2 = (isset($disaster_datarows[1]) ? $disaster_datarows[1] : []);

$Shouseinforgeneral=['familyhomecareer'=>$eco_occupation_code,'familyhomeproducttarget'=>$eco_product_target_code
,'familyhomesourceoffunds'=>$eco_capital_code,'eco_product_from'=>$eco_product_from,'eco_product_to'=>$eco_product_to,'familyhomeproductioncost'=>$eco_product_cost
,'g_occupational_code'=>$g_occupational_code,'g_occupational_other'=>$g_occupational_other];
$Shouseinfor=['txtHouseId'=>$house_no,'mooHouse'=>$house_moo,'txtSubDstrict'=>$sub_district,'txtDistrict'=>$district,'txtProvince'=>$province
,'txtPostalCode'=>$post_code];

?>
<script>
  // config data for vue  
  var vilage = <?=json_encode($listmas_vilage); ?>; 
  window.Slistmas_vilage=vilage.reverse().concat({vil_id: null, vil_moo:null, vil_name: "กรุณาเลือกข้อมูล", vil_desc: ""}).reverse();
  var mas_prefix = <?=json_encode($listmas_prefix); ?>; 
  window.Slistmas_prefix=mas_prefix.reverse().concat({pre_code: null,pre_name: "กรุณาเลือกข้อมูล"}).reverse();
    //ศาสนา
  var religion = <?=json_encode($listmas_religion); ?>; 
  window.Slistmas_religion=religion.reverse().concat({reg_code: null, reg_name: "กรุณาเลือกข้อมูล"}).reverse();
  //ระดับการศึกษา: 
  var educate = <?=json_encode($listmas_educate); ?>; 
  window.Slistmas_educate=educate.reverse().concat({ed_code: null, ed_name: "กรุณาเลือกข้อมูล"}).reverse();
  //ความสัมพันธ์ในครัวเรือน:
  var home_relations= <?=json_encode($listmas_relations); ?>; 
  window.Slistmas_relations=home_relations.reverse().concat({re_code: null, re_name: "กรุณาเลือกข้อมูล"}).reverse();
  // อาชีพในครัวเรือน
  var house_occup= <?=json_encode($listmas_house_occup); ?>;  
  window.Slistmas_house_occup=house_occup.reverse().concat({hccup_code: null, hccup_name: "กรุณาเลือกข้อมูล"}).reverse();
  window.Shouseinforgeneral=<?=json_encode($Shouseinforgeneral)?>;
  window.Shouseinfor=<?=json_encode($Shouseinfor)?>; 
  //กลุ่มอาชีพ:
  var group_occup= <?=json_encode($listmas_group_occup); ?>; 
  window.Slistmas_group_occup=group_occup.reverse().concat({goccup_code: null, goccup_name: "กรุณาเลือกข้อมูล"}).reverse();
  // อาชีพหลัก
  var occupation= <?=json_encode($listmas_occupation); ?>;  
  window.Slistmas_occupation=occupation.reverse().concat({occup_code: null, occup_name: "กรุณาเลือกข้อมูล"}).reverse();
    ///อาชีพรอง
 var addition= <?=json_encode($listmas_addition); ?>;   
  window.Slistlistmas_addition=addition.reverse().concat({add_code: null, add_name: "กรุณาเลือกข้อมูล"}).reverse();
  // ข้อมูลจังหวัด 
  var provinces= <?=json_encode($listprovinces); ?>; 
  window.Slistprovinces=provinces.reverse().concat({code: null,id:null,name_en:'กรุณาเลือกข้อมูล',name_th: "กรุณาเลือกข้อมูล"}).reverse();  
  //-ช้อมูลอำเภอ
  window.distric_deeds=<?=json_encode($distric_deeds); ?>;
  window.distric_norsor3kors =<?=json_encode($distric_norsor3kors); ?>;
  window.distric_sorporkor =<?=json_encode($distric_sorporkor); ?>;
  window.distric_chapter5s =<?=json_encode($distric_chapter5s); ?>;
  
    //เครื่องมืออำนวยความสะดวกทางการเกษตร 
  window.Slistmas_facilities=<?=json_encode($list_fm_fam_facilities_dt3); ?>;  
  // สัตว์เลี้ยง 
  window.listmas_pet=<?=json_encode($list_fm_fam_pet_dt4); ?>;   
  
  window.Sfamerdetaillists={deeds:<?=json_encode($deeds)?>,norsor3kors:<?=json_encode($norsor3kors)?>,spoks:<?=json_encode($sorporkor)?>,chapter5s:<?=json_encode($chapter5s)?>,another:'<?=$fam_land_other?>'};
  window.SSfamerdetaillists={deeds:<?=json_encode($deeds)?>,norsor3kors:<?=json_encode($norsor3kors)?>,spoks:<?=json_encode($sorporkor)?>,chapter5s:<?=json_encode($chapter5s)?>,another:'<?=$fam_land_other?>'};

  window.Sfamilylist=<?=json_encode($temlistpeople)?>; 
  window.Sfamilylists=<?=json_encode($listpeople)?>;
  window.SSfamilylists=<?=json_encode($listpeople)?>;

  window.Mfamilylist={prefix:null,txtFName: '',txtLName:'',txtCitizenId:'' ,xFstatusRd:'O',sexRd:'M',txtNational:'ไทย',religion:'01',birthday:''
  ,educationlevel:null,homerelations:null,careermain:null,careersecond:'01',netIncome:'',memF_status:'A'};
  //ข้อมูลพื้นที่การเกษตร
  window.Sfamerland={province:20,district:3115,nodeed:'',arearai:0,areawork:0,areatrw:0};
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
   window.tbl_mas_info1=<?=json_encode($tbl_mas_info1); ?>; 
   window.tbl_mas_info2=<?=json_encode($tbl_mas_info2); ?>;
   window.tbl_mas_info3=<?=json_encode($tbl_mas_info3); ?>;
   window.Smas_info={selected:<?='["' . implode('", "',$list_fm_fam_info_dt6_selected) . '"]'?>,another:''};
   //ภัยธรรมชาติ
   window.listmas_disaster1=<?=json_encode($listmas_disaster1); ?>; 
   window.listmas_disaster2=<?=json_encode($listmas_disaster2); ?>;
   window.Sdisaster={selected:<?='["' . implode('", "',$list_fm_fam_disaster_dt5_selected) . '"]'?>,another:''}; 
      
  window.d_survey='<?=$d_survey?>';
  window.alert_survey='<?=$alert_survey?>';
  window.actions='<?=$actions?>';
  
<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'&&@$_GET['type']=='copy') { 
if(IsNullOrEmptyString($house_no)){
?>
 Swal.fire('ไม่พบข้อมูล!');
<?php
 } 
}?>
</script>