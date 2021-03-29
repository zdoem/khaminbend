<?php 
require '../bootstart.php';  
define('PATH_IMAGES',__DIR__ . '/');   
define('_MPDF_TTFONTPATH',ROOT .'/public/assets/fonts');
$stylesheet = file_get_contents(ROOT.'/public/assets/css/report.css');  
require (ROOT."/public/pdf/report_header_pdf.php");

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8',
  'format' => 'A4',
  'tempDir'=> ROOT.'/public/tmp',
  'margin_top' =>32, 
  'fontDir' => array_merge($fontDirs, [
        ROOT.'/public/assets/fonts',
  ]), 
  'fontdata' => $fontData + [
        'thsarabun' => [
            'R' => 'THSarabun.ttf',
            'I' => 'THSarabunItalic.ttf',
        ]
    ],
  'default_font_size' => 14,
	'default_font' => 'thsarabun' 
]);  
$title_pdf=\Mpdf\Utils\UtfString::strcode2utf(htmlentities('ข้อมูลครัวเรือน '.thaidate('j/m/Y', time())));
$mpdf->SetTitle($title_pdf); 
$mpdf->SetSubject($title_pdf);
$mpdf->SetKeywords($title_pdf);

//--------------------------------------------------------------
// $_GET['id'] = 631228;
$id=@$_GET['id'];
$base_join = $db::table('fm_fam_members_dt1')
    ->select($db::raw('mem_fam_id,mem_status,mem_pre,mem_fname,mem_lname,mem_citizen_id,mem_sex,mem_national,mem_religion_code,mem_df_birth,mem_education_code,mem_relations_code,f_status'))
    ->where('mem_status', 'O')
    ->where('mem_fam_id', '=',$id)
    ->groupBy('mem_fam_id');
$data_fm_fam_hd = $db::table('fm_fam_hd AS a')
    ->select($db::raw("vil_moo,vil_name,
      fam_id,house_no,house_moo,sub_district,district,province,post_code,cc.mem_pre,cc.mem_fname,cc.mem_lname,cc.mem_citizen_id
      ,CONCAT(DATE_FORMAT(eco_product_from,'%d') ,'/', DATE_FORMAT(eco_product_from ,'%m'),'/',DATE_FORMAT(eco_product_from ,'%Y')+543) AS eco_product_from
      ,CONCAT(DATE_FORMAT(eco_product_to,'%d') ,'/', DATE_FORMAT(eco_product_to ,'%m'),'/',DATE_FORMAT(eco_product_to ,'%Y')+543) AS eco_product_to
      ,mem_status AS x_status,mem_sex AS x_sex,mem_national AS national,mem_religion_code AS reg_code,mem_df_birth AS date_of_birth,mem_education_code AS education_code
      ,mem_relations_code AS relations_code,g_occupational_code,g_occupational_other,main_occupation_code,add_occupation_code
      ,income_per_year,fam_land_other,hccup_name AS eco_occupation_code,eco_product_target_code,eco_capital_code,eco_product_cost,f_problem_env,problem_env_desc
      ,f_manage_env,manage_env_desc,conserve_env,f_help,help_desc,CONCAT(DATE_FORMAT(d_survey,'%d') ,'/', DATE_FORMAT(d_survey ,'%m'),'/',DATE_FORMAT(d_survey ,'%Y')+543) AS d_survey"))
    ->leftJoinSub($base_join, 'cc', function ($join) {
        $join->on('a.fam_id', '=', 'cc.mem_fam_id');
    })  
    ->leftJoin('tbl_mas_vilage AS dd', 'a.house_moo', 'dd.vil_id')
    ->leftJoin('tbl_mas_house_occup AS hjob', 'a.eco_occupation_code', 'hjob.hccup_code')  
    ->where('fam_id', '=', $id)->first();
  
  if(!isset($data_fm_fam_hd->house_no)){echo '<center><b>ไม่พบข้อมูล!</b></center>'; exit();}

  $a=Getproduct_target($data_fm_fam_hd->eco_product_target_code);
  $b=Getsourceoffund($data_fm_fam_hd->eco_capital_code);
  $data_fm_fam_hd->eco_product_target_code=isset($a['name'])?$a['name']:'';
  $data_fm_fam_hd->eco_capital_code=isset($b['name'])?$b['name']:''; 

  $house_no = (isset($data_fm_fam_hd->house_no) ? $data_fm_fam_hd->house_no : ''); //บ้านเลขที่
  $house_moo = ((isset($data_fm_fam_hd->house_moo) && !IsNullOrEmptyString($data_fm_fam_hd->house_moo)) ? $data_fm_fam_hd->house_moo : ''); //หมู่ที
  $vil_name=((isset($data_fm_fam_hd->vil_name) && !IsNullOrEmptyString($data_fm_fam_hd->vil_name)) ? $data_fm_fam_hd->vil_name : '');
  $vil_moo=((isset($data_fm_fam_hd->vil_moo) && !IsNullOrEmptyString($data_fm_fam_hd->vil_moo)) ? $data_fm_fam_hd->vil_moo : '');
  $sub_district = (isset($data_fm_fam_hd->sub_district) ? $data_fm_fam_hd->sub_district : ''); //ตำบล
  $district = (isset($data_fm_fam_hd->district) ? $data_fm_fam_hd->district : ''); //อำเภอ
  $province = (isset($data_fm_fam_hd->province) ? $data_fm_fam_hd->province : ''); //จังหวัด
  $post_code = (isset($data_fm_fam_hd->post_code) ? $data_fm_fam_hd->post_code : '');
  $eco_occupation_code = (isset($data_fm_fam_hd->eco_occupation_code) ? $data_fm_fam_hd->eco_occupation_code : ''); //อาชีพในครัวเรือน
  $eco_product_target_code = ((isset($data_fm_fam_hd->eco_product_target_code) && !IsNullOrEmptyString($data_fm_fam_hd->eco_product_target_code)) ? $data_fm_fam_hd->eco_product_target_code : null); //เป้าหมายการผลิต : 01=ผลิตเพื่อบริโภค,02=ผลิตเพื่อจำหน่าย,03=ผลิตเพื่อบริโภคและจำหน่าย
  $eco_capital_code = ((isset($data_fm_fam_hd->eco_capital_code) && !IsNullOrEmptyString($data_fm_fam_hd->eco_capital_code)) ? $data_fm_fam_hd->eco_capital_code : null); //แหล่งเงินทุน (ครัวเรือน) :01=เงินทุนส่วนตัว,02=กู้มาลงทุน,03=กู้บางส่วน
  $eco_product_cost = (!IsNullOrEmptyString($data_fm_fam_hd->eco_product_cost) ? $data_fm_fam_hd->eco_product_cost : 0); //ต้นทุนการผลิต
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

  $img_check='<img src="../images/checkbox.png" width="3.5mm" />';
  $img_blank='<img src="../images/blank-check-box.png" width="3.5mm" />'; 

// $listpeople
$listpeople = $db::table("fm_fam_members_dt1 AS a")
    ->select($db::raw("mem_pre AS prefix,pre_name,b.f_status,mem_fname AS txtFName,mem_lname AS txtLName,mem_citizen_id AS txtCitizenId,mem_status AS xFstatusRd
      ,mem_sex AS sexRd,mem_national AS txtNational,reg_name AS religion
      ,CONCAT(DATE_FORMAT(mem_df_birth,'%d') ,'/', DATE_FORMAT(mem_df_birth ,'%m'),'/',DATE_FORMAT(mem_df_birth ,'%Y')+543) AS birthday,ed_name AS educationlevel
      ,re_name AS homerelations,b.g_occupational_code AS careergroup,b.g_occupational_other AS careeranother
      ,oc.occup_name AS careermain,oc2.occup_name AS careersecond ,xincome_per_year AS netIncome,mem_seq,a.F_status AS memF_status"))
    ->leftJoin('tbl_mas_prefix AS pre', 'a.mem_pre', 'pre.pre_code')
    ->leftJoin('tbl_mas_religion AS re', 'a.mem_religion_code', 're.reg_code')
    ->leftJoin('tbl_mas_educate AS ed', 'a.mem_education_code', 'ed.ed_code')
    ->leftJoin('tbl_mas_relations AS rel', 'a.mem_relations_code', 'rel.re_code') 
    ->leftJoin('tbl_mas_occupation AS oc', 'a.xmain_occupation_code', 'oc.occup_code')  
    ->leftJoin('tbl_mas_occupation AS oc2', 'a.xadditional_occupation_code', 'oc2.occup_code')   
    ->Join('fm_fam_hd AS b', 'b.fam_id', 'a.mem_fam_id')
    ->where('a.mem_fam_id', '=', $id)
    ->orderBy('mem_seq', 'asc')->get()->toArray(); 
    // var_dump($listpeople);exit();
// ข้อมูลพื้นที่การเกษตร
$list_fm_fam_land_dt2 = $db::table("fm_fam_land_dt2 AS a")
    ->select($db::raw("land_type,land_desc,pro.name_th AS province,(SELECT name_th FROM amphures WHERE code=a.district) AS district,title_deed_id AS nodeed,area1_rai AS arearai,area2_work AS areawork,area3_sqw AS areatrw,f_status"))
    ->leftJoin('provinces AS pro', 'a.province', 'pro.id')   
    ->orderBy('land_type', 'asc')
    ->orderBy('land_seq', 'asc')
    ->where('land_fam_id', '=', $id) 
    ->get()->toArray(); 
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
    })->orderBy('a.fac_code', 'asc')->get()->toArray();

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
    })->orderBy('a.pet_code', 'asc')->get()->toArray();
//5. ภัยธรรมชาติ fm_fam_disaster_dt5  
$base_join = $db::table('fm_fam_disaster_dt5')
    ->select($db::raw('dis_code,dis_name,dis_desc'))
    ->where('dis_fam_id',$id);
$list_fm_fam_disaster_dt5 = $db::table('tbl_mas_disaster AS a')
    ->select($db::raw("a.dis_code,a.dis_name,b.dis_desc
                      ,CASE   WHEN b.dis_code IS NOT NULL THEN 'true'
                      WHEN b.dis_code IS NULL THEN null
                      ELSE null END AS selected"))
    ->leftJoinSub($base_join, 'b', function ($join) {
        $join->on('a.dis_code', '=', 'b.dis_code');
    })
    ->orderBy('a.dis_code', 'asc')
    ->get()->toArray(); 

 $group=round(sizeof(@$list_fm_fam_disaster_dt5)/5);   
 $disaster_datarows = splitMyArray($list_fm_fam_disaster_dt5, ($group)>0?$group:1); 
//  var_dump( $disaster_datarows);exit();
// 6. ข่าวสารทางด้านการเกษตร fm_fam_info_dt6
 $base_join = $db::table('fm_fam_info_dt6')
    ->select($db::raw('info_fam_id,info_code,info_name,info_desc'))
    ->where('info_fam_id', $id); 
 $list_fm_fam_info_dt6 = $db::table('tbl_mas_info AS a')
     ->select($db::raw("a.info_code,a.info_name,b.info_desc
                     ,CASE   WHEN b.info_code IS NOT NULL THEN 'true'
                      WHEN b.info_code IS NULL THEN null
                      ELSE null END AS selected"))
    ->leftJoinSub($base_join, 'b', function ($join) {
        $join->on('a.info_code', '=', 'b.info_code');
    })
   ->orderBy('info_code', 'asc')
    ->get()->toArray();


 $group=round(sizeof(@$list_fm_fam_info_dt6)/3);   
 $farminfo_datarows = splitMyArray($list_fm_fam_info_dt6, ($group)>0?$group:1); 
//  var_dump($farminfo_datarows);exit();
//--------------------------------------------------------------

// mocker test data
$sumallpage1=sizeof(@$listpeople);//หน้าแรกใส่ได้ 7 
$sumallpage2=sizeof(@$list_fm_fam_land_dt2);//ทั้งหน้าได้ 27
$sumallpage3=sizeof(@$list_fm_fam_facilities_dt3);//ทั้งหน้าได้ 26
$sumallpage4=sizeof(@$list_fm_fam_pet_dt4); //ทั้งหน้าได้29
$sumallpage5=sizeof(@$list_fm_fam_disaster_dt5); //ทั้งหน้าได้29
$sumallpage6=sizeof(@$list_fm_fam_info_dt6); //ทั้งหน้าได้29

$mpdf->WriteHTML($headerhtml); //header 
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$html1 = '';  
$html_homeinfo ='<table style="width:100%" align="center" border="0" cellpadding="5" cellspacing="0"> 
                    <caption class="c_table c_homeinfo">ข้อมูลครัวเรือน [ที่อยู่ตามทะเบียนบ้าน]</caption>
                    <tr>
                        <td> บ้านเลขที่ : </td> 
                        <td> '.$house_no.' </td> 
                        <td align="right"> หมู่ที่- ชื่อหมู่บ้าน : </td>
                        <td> '.$vil_moo.$vil_name.' </td>
                        <td  align="right"> ตำบล : </td>
                        <td> '.$sub_district.' </td>
                    </tr> 
                     <tr> 
                        <td> อำเภอ : </td> 
                        <td> '.$district.' </td>
                        <td align="right"> จังหวัด: </td>
                        <td> '.$province.' </td>
                        <td  align="right"> รหัสไปรษณีย์ : </td> 
                        <td> '.$post_code.' </td>
                    </tr>
  </table><br/> ';

$mpdf->WriteHTML($html_homeinfo); 

$listpeople_html='';  
$listpeople_html_header='<table style="width:100%" align="center" border="0" cellpadding="5" cellspacing="0">
<thead>
<tr>
  <th colspan="7" class="c_table c_infohome_list" id="c_infohome_list">ข้อมูลสมาชิกในครัวเรือน</th> 
</tr>
</thead>
'; 

$listpeople_html_footer='</table>';     
                  foreach($listpeople AS $k=>$v){  
                     @$listpeople_html.='<tr>
                                        <th>ลำดับที่:
                                        <div class="tbfont_content">'.$v->mem_seq.'</div>
                                        </th>
                                        <th align="left">ชื่อ-สกุล:
                                        <div class="tbfont_content">'.$v->pre_name.$v->txtFName.' '.$v->txtLName.'</div>
                                        </th> 
                                        <th  align="left">เลขที่บัตร:
                                        <div class="tbfont_content">'.$v->txtCitizenId.'</div>
                                        </th>
                                        <th>สถานภาพ:
                                          <div class="tbfont_content">'.(($v->xFstatusRd=='O')?"เจ้าบ้าน":"ผู้อยู่อาศัย").'</div>
                                        </th>
                                        <th>เพศ:
                                        <div class="tbfont_content">'.($v->sexRd=='M' ? "ชาย" :($v->sexRd=='W' ? "หญิง" :"อื่นๆ")).'</div>
                                        </th>
                                        <th>สัญชาติ:
                                        <div class="tbfont_content">'.$v->txtNational.'</div>
                                        </th>
                                        <th>ศาสนา:
                                        <div class="tbfont_content">'.$v->religion.'</div>
                                        </th> 
                                      </tr> 
                                        <tr>
                                        <th>ว/ด/ป เกิด :
                                        <div class="tbfont_content">'.$v->birthday.'</div>
                                        </th>
                                        <th  align="left">ระดับการศึกษา:  
                                        <div class="tbfont_content">'.$v->educationlevel.'</div>
                                        </th> 
                                        <th  align="left">ความสัมพันธ์:
                                        <div class="tbfont_content">'.$v->homerelations.'</div>
                                        </th>
                                        <th>อาชีพหลัก:
                                        <div class="tbfont_content">'.$v->careermain.'</div>
                                        </th>
                                        <th>อาชีพรอง:
                                        <div class="tbfont_content">'.$v->careersecond.'</div>
                                        </th>
                                        <th>รายได้ต่อปี:
                                        <div class="tbfont_content">'.number_format($v->netIncome).'</div>
                                        </th>
                                        <th></th> 
                                      </tr>';
                  } 
   
if($listpeople_html!=''&&$sumallpage1>0){
 $mpdf->WriteHTML($listpeople_html_header.$listpeople_html.$listpeople_html_footer.'<HR class="c_hr"></HR>');
 $listpeople_html = ''; 
 }else if($sumallpage1>0){
 $mpdf->WriteHTML('<HR class="c_hr"></HR>');
 }
// $sumallpage=$sumallpage1+$sumallpage2;
// if($sumallpage>=7){$mpdf->AddPage();}
$listfarm_html='';
$listfarm_html_header='<table style="width:100%" align="center"  class="animal"  border="0" cellpadding="5" cellspacing="0">
<thead><tr><th colspan="8" class="c_table c_infohome_farm">ข้อมูลพื้นที่การเกษตร</th></tr>
<tr>
  <th align="center">ลำดับ</th>
  <th align="center">จังหวัด</th>
  <th align="center">อำเภอ</th>
  <th align="center">เลขที่</th>
  <th align="center">พื้นที่(ไร่)</th>
  <th align="center">พื้นที่(งาน)</th>
  <th align="center">พื้นที่(ตรว.)</th>
  <th align="center">ประเภท</th>
</tr>
</thead>'; 
$listfarm_html_footer='</table>';  
 if($sumallpage2>=3){
    foreach($list_fm_fam_land_dt2 AS $k=>$v){   
             switch ($v->land_type) {
               case 'title_deed': $v->land_type='โฉนด';break;
               case 'NorSor3Kor': $v->land_type='นส.3ก';break;
               case 'sorporkor': $v->land_type='สปก.';break;
               case 'porbortor5': $v->land_type='ภบท 5';break;
               default:$v->land_type='ไม่พบ'; break;
             }
            @$listfarm_html.='
            <tr>
            <td align="center">'.($k+1).'</td>
            <td align="center">'.$v->province.'</td>
            <td align="center">'.$v->district.'</td>
            <td align="center">'.$v->nodeed.'</td>
            <td align="center">'.$v->arearai.'</td>
            <td align="center">'.$v->areawork.'</td>
            <td align="center">'.$v->areatrw.'</td>
            <td align="center">'.$v->land_type.'</td>
            </tr>'; 
     }
 }else{ 
      $title_num=0;
       foreach($list_fm_fam_land_dt2 AS $k=>$v){   
             switch ($v->land_type) {
               case 'title_deed': $v->land_type='โฉนด';$title_num++;break;
               case 'NorSor3Kor': $v->land_type='นส.3ก';$title_num++;break;
               case 'sorporkor': $v->land_type='สปก.';$title_num++;break;
               case 'porbortor5': $v->land_type='ภบท 5';$title_num++;break;
               default:$v->land_type='ไม่พบ'; break;
             }
            @$listfarm_html.='
            <tr>
            <td align="center">'.($k+1).'</td>
            <td align="center">'.$v->province.'</td>
            <td align="center">'.$v->district.'</td>
            <td align="center">'.$v->nodeed.'</td>
            <td align="center">'.$v->arearai.'</td>
            <td align="center">'.$v->areawork.'</td>
            <td align="center">'.$v->areatrw.'</td>
            <td align="center">'.$v->land_type.'</td>
            </tr>'; 
        } 
     $loopx=4-$title_num; 
     for($i=0;$i<$loopx;$i++){
         @$listfarm_html.='
            <tr>
            <td align="center">'.($i+1).'</td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            </tr>';
     }
 } 
if($listfarm_html!=''){
 $mpdf->WriteHTML($listfarm_html_header.$listfarm_html.$listfarm_html_footer.'<HR class="c_hr"></HR>');
 $listfarm_html = '';  
 }else if($sumallpage2>0){
 $mpdf->WriteHTML('<HR class="c_hr"></HR>');
 }    
 
$generalinfo_html='';
$generalinfo_header='<table style="width:100%" align="center" border="0" cellpadding="5" cellspacing="0">
                    <thead><tr><th colspan="6" class="c_table c_generalinfo">ข้อมูลทั่วไปของครัวเรือน</th></tr></thead>';   
$generalinfo_html = '
                    <tr  align="center">
                    <td width="10%">อาชีพในรัวเรือน:</td>
                    <td width="18%" class="tdline"><span>'.$eco_occupation_code.'</span></td>
                    <td width="17%" align="right">เป้าหมายการผลิต :</td>
                    <td width="20%" class="tdline"><span>'.$eco_product_target_code.'</span></td>
                    <td width="15%" align="right">แหล่งเงินทุน :</td>
                    <td width="20%" class="tdline"><span>'.$eco_capital_code.'</span></td> 
                   </tr>
                   <tr  align="center">
                    <td>ช่วงเวลาการผลิต:</td>
                    <td colspan="2" class="tdline"><span>'.$eco_product_from.' - '.$eco_product_to.'</span></td>
                    <td  align="right">ต้นทุนการผลิต : </td>
                    <td colspan="2" class="tdline"><span>'.(number_format($eco_product_cost)).'</span></td> 
                   </tr> ';
$mpdf->WriteHTML($generalinfo_header.$generalinfo_html.'</table><div class="spacegroup"></div>');
 
// $sumallpage=$sumallpage1+$sumallpage2+$sumallpage3;
// if($sumallpage>=7){$mpdf->AddPage();}

$enginhelp_html='';
$enginhelp_header='<table style="width:100%" align="center" border="0" cellpadding="5" cellspacing="0">
                    <thead><tr><th  class="c_table c_enginhelp">เครื่องมืออำนวยความสะดวกทางการเกษตร</th></tr></thead>';   

foreach($list_fm_fam_facilities_dt3 AS $k=>$v){  
          $enginhelp_html .= '<tr  align="center">
                     <td>
                      <table style="width:100%" align="center" border="0" cellpadding="0" cellspacing="0"> 
                        <tr  align="center">
                        <td  width="10%">'.($k+1).'.</td>
                        <td  align="right"width="15%">'.$v->fac_name.'</td>
                        <td align="center" width="40%" class="dot" style="text-align: center;">'.(($v->fac_quantity>0)?$v->fac_quantity:'').'</td>  
                        <td align="left" width="35%">คัน</td>
                        </tr> 
                     </table>
                    </td>  
                   </tr>';
    }  
if($enginhelp_html!=''&&$sumallpage3>0){        
$mpdf->WriteHTML($enginhelp_header . $enginhelp_html . '</table><div class="spacegroup"></div>');
}
// $sumallpage=$sumallpage1+$sumallpage2+$sumallpage3+$sumallpage4;
// if($sumallpage>=7){$mpdf->AddPage();}

$animal_html='';
$animal_header='<table style="width:100%" class="animal" align="center" border="0" cellpadding="5" cellspacing="0">
<thead><tr><th  colspan="5" class="c_table c_animal">สัตว์เลี้ยง</th></tr></thead>
<tr  align="center">
  <th align="center" width="10%">ลำดับ.</th>
  <th align="center" width="20%">ประเภทสัตว์เลี้ยง</th>
  <th align="center" width="15%">จำนวน</th>
  <th align="center" width="15%">จำนวน(ที่ได้รับวัคซีน)</th>
  <th align="center" width="40%">รายละเอียด</th>
</tr>';  
foreach($list_fm_fam_pet_dt4 AS $k=>$v){  
   $animal_html .= '<tr  align="center">
                    <td align="center">'.($k+1).'</td>
                    <td align="center">'.$v->pet_name.'</td>
                    <td align="center">'.(($v->pet_quantity>0)?$v->pet_quantity:'').'</td>
                    <td align="center">'.(($v->pet_vacine_qt>0)?$v->pet_vacine_qt:'').'</td>
                    <td align="left">'.$v->pet_desc.'</td>
                   </tr>';
   }  
if($animal_html!=''&&$sumallpage4>0){      
 $mpdf->WriteHTML($animal_header . $animal_html . '</table><div class="spacegroup"></div>'); 
}

$issuegreen_html='
<table style="width:100%" align="center" border="0" cellpadding="0" cellspacing="0">
<thead><tr><th  colspan="3" class="c_table c_enginhelp">ปัญหาสิ่งแวดล้อมในครัวเรือน</th></tr></thead>
<tbody>
 <tr>
   <td colspan="3" style="height:1mm;"></td> 
</tr>
<tr  align="center">
      <td width="40%">ปัญหาสิ่งแวดล้อมในครัวเรือน: 
      </td>
      <td width="30%">การจัดการสิ่งแวดล้อม: 
      </td>
      <td width="30%" align="right">การอนุรักษ์สิ่งแวดล้อม: 
      </td>
  </tr> 
 <tr align="center">
      <td colspan="3">
          <table style="width:100%" align="center" border="0" cellpadding="0" cellspacing="0">
              <tr  align="center">
                <td width="15%">'.(($f_problem_env=='Y')?$img_blank:$img_check).' <span>ไม่มี</span> '.(($f_problem_env=='Y')?$img_check:$img_blank).' <span>มี (ระบุ)</span></td>
                <td width="20%" class="dot">'.$problem_env_desc.'</td>
                <td width="2%"></td>
                <td width="15%">'.(($f_manage_env=='Y')?$img_blank:$img_check).' <span>ไม่มี</span> '.(($f_manage_env=='Y')?$img_check:$img_blank).' <span>มี (ระบุ)</span></td>
                <td width="20%" class="dot">'.$manage_env_desc.'</td>
                <td width="5%"></td>
                <td width="20%" class="dot">'.$conserve_env.'</td>
              </tr> 
            </table> 
      </td> 
</tr></tbody>'; 
$mpdf->WriteHTML($issuegreen_html.'</table><div class="spacegroup"></div>');
 
$disaster_html='';
$disaster_header='<table style="width:100%" align="center" border="0" cellpadding="5" cellspacing="0">
                  <thead><tr><th  colspan="7" class="c_table c_enginhelp">ภัยธรรมชาติ</th></tr></thead>';    
  foreach($disaster_datarows as $k=>$v){  
      $disaster_html .= '<tr  align="center" class="trmiddle">'; 
        for($i=0;$i<5;$i++){  
                if(isset($v[$i]->dis_code)){
                   if($v[$i]->dis_code!=99){
                    $disaster_html .= '<td>'.(($v[$i]->selected=='true')?$img_check:$img_blank).' <span>'.$v[$i]->dis_name.'</span></td>';
                   }else if($v[$i]->dis_code==99){
                   $disaster_html .= '<td width="50">'.$img_check.' อื่นๆ</td><td width="100" class="dot">'.$v[$i]->dis_name.'</td>';
                  }
                }else{
                  $disaster_html .='<td width="50"></td>';
                } 
        }
  $disaster_html .= '</tr>';   
    }
$disaster_html .= '</table>'; 
$disaster_html .='<table style="width:100%" align="center" border="0" cellpadding="5" cellspacing="0"> 
                  <tr>
                    <td colspan="4" style="height:5mm;"></td> 
                  </tr>
                 <tr  align="left">
                  <th align="left" colspan="4">เคยได้รับความช่วยเหลือ:</th>
                 </tr> 
                 <tr  align="left">
                    <td width="10%" >'.(($f_help=='Y')?$img_blank:$img_check).' <span>ไม่เคย</span></td> 
                    <td width="10%" align="right">'.(($f_help=='Y')?$img_check:$img_blank).' <span>เคย(ระบุความช่วยเหลือจากหน่วยงานไหน)</span></td>    
                    <td width="40%" class="dot">'.$help_desc.'</td>
                    <td width="10%"></td>
                </tr>
                </table><div class="spacegroup"></div>';
if($disaster_html!=''&&$sumallpage5>0){  
$mpdf->WriteHTML($disaster_header . $disaster_html ); 
}

$newsland_html='';
$newsland_header='<table style="width:100%" align="center" border="0" cellpadding="5" cellspacing="0">
                    <thead><tr><th  colspan="7" class="c_table c_newsland">ข่าวสารทางด้านการเกษตร</th></tr></thead>';   
 
  foreach($farminfo_datarows as $k=>$v){  
     $newsland_html .='<tr  align="left" class="trmiddle">';
       for($i=0;$i<3;$i++){ 
              if(isset($v[$i]->info_code)){
                    if($v[$i]->info_code!=99){
                    $newsland_html .= '<td width="35%">'.(($v[$i]->selected=='true')?$img_check:$img_blank).' <span>'.$v[$i]->info_name.'</span></td>';
                    }else if($v[$i]->info_code==99){
                      $newsland_html .= '<td>'.$img_check.' '.Getdotline(80,'อื่น',$v[$i]->info_desc).'</td>';
                   }
                }else{
                  $newsland_html .='<td width="35%"></td>';       
                 }
        } 
       $newsland_html .='</tr>';       
  }       
if($newsland_html!=''&&$sumallpage6>0){           
$mpdf->WriteHTML($newsland_header . $newsland_html.'</table> <div class="spacegroup"></div>');
}
$survey_html = '<pagebreak><table style="width:100%" align="center" border="0" cellpadding="0" cellspacing="0"> 
                    <thead><tr><th  colspan="5" class="c_table" id="c_survey"> วันเดือนปีสำรวจ : <span class="surveydate">'.$d_survey.'</span></th></tr></thead>
                    <tr>
                    <td colspan="5" style="height:10mm;"></td> 
                    </tr>
                    <tr>
                    <td width="10%"></td>
                    <th width="35%">ลงชื่อ(ผู้ให้ข้อมูล)</th>
                    <td width="10%"></td>
                    <th width="35%">ลงชื่อ(ผู้สำรวจ)</th> 
                    <td width="10%"></td>
                    </tr> 
                    <tr>
                    <td colspan="5" style="height:8mm;"></td> 
                    </tr>
                    <tr>
                    <td width="10%"></td>
                    <td width="35%" class="dot"></td>
                    <td width="10%"></td>
                    <td width="35%" class="dot"></td>
                    <td width="10%"></td>
                    </tr>
                    </table><div class="spacegroup" style="margin:2.2rem 0;"></div>'; 
  $mpdf->WriteHTML($survey_html); 
// $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY); 
$mpdf->Output("familyreport_".date('d-m-Y').".pdf", 'I');

?>