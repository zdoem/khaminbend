<?php
require_once '../../bootstart.php'; 
require ROOT . '/core/security.php';
$action=@$_POST['action']; 
$id=@$_POST['id']; 
 
$status='';  
$refer_urlmain='familyList.php'; 
// echo '<pre>';
// print_r($_REQUEST);
// exit();

// check validating csrf token name

//if (\Volnix\CSRF\CSRF::validate($_POST, 'token_family_frm')){ 
  // var_dump($_POST['Mmas_info_select']);exit();
 
$yearfam_id=substr(date("Y")+543, -2);
$tran_id=$yearfam_id.date("m");

$txtHouseId=trim((isset($_POST['Mhouseinfor']['txtHouseId']) ? $_POST['Mhouseinfor']['txtHouseId'] : ''));
$house_moo=trim((isset($_POST['Mhouseinfor']['mooHouse']) ? $_POST['Mhouseinfor']['mooHouse'] : ''));
$sub_district=trim((isset($_POST['Mhouseinfor']['txtSubDstrict']) ? $_POST['Mhouseinfor']['txtSubDstrict'] : ''));
$district=trim((isset($_POST['Mhouseinfor']['txtDistrict']) ? $_POST['Mhouseinfor']['txtDistrict'] : ''));
$province=trim((isset($_POST['Mhouseinfor']['txtProvince']) ? $_POST['Mhouseinfor']['txtProvince'] : ''));
$post_code = trim((isset($_POST['Mhouseinfor']['txtPostalCode']) ? $_POST['Mhouseinfor']['txtPostalCode'] : ''));
 
$familylists=(isset($_POST['Mfamilylists']) ? $_POST['Mfamilylists']:[]);
$familylist=@$familylists[0];

// $pre_owner=trim((isset($familylist['prefix']) ? $familylist['prefix']: ''));
// $owner_fname = trim((isset($familylist['txtFName']) ? $familylist['txtFName'] : ''));
// $owner_lname = trim((isset($familylist['txtLName']) ? $familylist['txtLName'] : '')); 
// $citizen_id = trim((isset($familylist['txtCitizenId']) ? $familylist['txtCitizenId'] : ''));
// $x_status=    trim((isset($familylist['xFstatusRd']) ? $familylist['xFstatusRd'] : ''));
// $x_sex = trim((isset($familylist['sexRd']) ? $familylist['sexRd'] : ''));
// $national = trim((isset($familylist['txtNational']) ? $familylist['txtNational'] : ''));
// $reg_code = trim((isset($familylist['religion']) ? $familylist['religion'] : ''));
// $date_of_birth = trim((isset($familylist['birthday']) ? $familylist['birthday'] : ''));
// $date_of_birth =preg_replace("/(\d+)\/(\d+)\/(\d+)/","$3-$2-$1",$date_of_birth);
// $education_code = trim((isset($familylist['educationlevel']) ? $familylist['educationlevel'] : ''));
// $relations_code = trim((isset($familylist['homerelations']) ? $familylist['homerelations'] : ''));

// $g_occupational_code = trim((isset($familylist['careergroup']) ? $familylist['careergroup'] : ''));
// $g_occupational_other = trim((isset($familylist['careeranother']) ? $familylist['careeranother'] : ''));

$main_occupation_code= trim((isset($familylist['careermain']) ? $familylist['careermain'] : ''));
$add_occupation_code = trim((isset($familylist['careersecond']) ? $familylist['careersecond'] : ''));
$income_per_year= trim((isset($familylist['netIncome']) ? $familylist['netIncome'] : ''));
//  var_dump($_POST['Mfamilylists']);exit();

// insert  ข้อมูลพื้นที่การเกษตร
$famerdetaillists_deed=(isset($_POST['Mfamerdetaillists']['deeds']) ? $_POST['Mfamerdetaillists']['deeds'] : []);
$famerdetaillists_norsor3kors = (isset($_POST['Mfamerdetaillists']['norsor3kors']) ? $_POST['Mfamerdetaillists']['norsor3kors'] : []);
$famerdetaillists_spoks= (isset($_POST['Mfamerdetaillists']['spoks']) ? $_POST['Mfamerdetaillists']['spoks'] : []);
$famerdetaillists_chapter5s= (isset($_POST['Mfamerdetaillists']['chapter5s']) ? $_POST['Mfamerdetaillists']['chapter5s'] : []);
$fam_land_other = trim((isset($_POST['Mfamerdetaillists']['another']) ? $_POST['Mfamerdetaillists']['another'] : ''));

$g_occupational_code = trim((isset($_POST['Mhouseinforgeneral']['g_occupational_code']) ? $_POST['Mhouseinforgeneral']['g_occupational_code']: NULL));
$g_occupational_other = trim((isset($_POST['Mhouseinforgeneral']['g_occupational_other']) ? $_POST['Mhouseinforgeneral']['g_occupational_other'] : NULL));
$eco_occupation_code=  trim((isset($_POST['Mhouseinforgeneral']['familyhomecareer']) ? $_POST['Mhouseinforgeneral']['familyhomecareer'] : NULL));
$eco_product_target_code = trim((isset($_POST['Mhouseinforgeneral']['familyhomeproducttarget']) ? $_POST['Mhouseinforgeneral']['familyhomeproducttarget'] : null));
$eco_capital_code = trim((isset($_POST['Mhouseinforgeneral']['familyhomesourceoffunds']) ? $_POST['Mhouseinforgeneral']['familyhomesourceoffunds'] : ''));
$familyhomeproductioncost=trim((isset($_POST['Mhouseinforgeneral']['familyhomeproductioncost']) ? $_POST['Mhouseinforgeneral']['familyhomeproductioncost'] : '01'));
$familyhomeproductperiod = trim((isset($_POST['Mhouseinforgeneral']['familyhomeproductperiod']) ? preg_replace('/\s+/', '', $_POST['Mhouseinforgeneral']['familyhomeproductperiod'])  : ''));
$b_period=explode('-',$familyhomeproductperiod); 
$eco_product_from=trim((isset($b_period[0]) ? preg_replace("/(\d+)\/(\d+)\/(\d+)/","$3-$2-$1",$b_period[0]): ''));
$eco_product_to=trim((isset($b_period[1]) ? preg_replace("/(\d+)\/(\d+)\/(\d+)/","$3-$2-$1",$b_period[1]): '')); 
// var_dump($eco_product_from,$eco_product_to);exit();
//สิ่งแวดล้อม
$f_problem_env=trim((isset($_POST['xEnvironmental']) ? $_POST['xEnvironmental'] : ''));
$problem_env_desc=(isset($_POST['xEnvironmentaldisc']) ? $_POST['xEnvironmentaldisc'] : '');
$f_manage_env=trim((isset($_POST['xEnvironmental2']) ? $_POST['xEnvironmental2'] : ''));
$manage_env_desc =(isset($_POST['xEnvironmental2disc']) ? $_POST['xEnvironmental2disc'] : '');
$conserve_env=(isset($_POST['greenxEnvironmentaldisc']) ? $_POST['greenxEnvironmentaldisc'] : ''); 
$f_help=trim((isset($_POST['helpme']) ? $_POST['helpme'] : 'N'));
$help_desc=(isset($_POST['helpmedisc']) ? $_POST['helpmedisc'] : ''); 
if($action!=3){
$survseydate=DateTime::createFromFormat('d/m/Y H:i A',$_POST['survseydate']); 
$d_survseydate=$survseydate->format('Y-m-d H:i:s');
$d_survey=(isset($d_survseydate) ? $d_survseydate: ''); 
$yearfam_id=substr($survseydate->format('Y')+543, -2);
$tran_id=$yearfam_id.$survseydate->format('m');
}
$select_facilities=(isset($_POST['Mlistmas_facilities']) ? $_POST['Mlistmas_facilities'] : []);
$listmas_pet=(isset($_POST['listmas_pet']) ? $_POST['listmas_pet'] : []);

$disaster=(isset($_POST['Mdisaster']['selected']) ? $_POST['Mdisaster']['selected'] : []);

$mas_info_select=(isset($_POST['Mmas_info_select']['selected']) ? $_POST['Mmas_info_select']['selected'] : []);

//  data เทียบ 
$data_mas_pet = $db::table("tbl_mas_pet")
    ->select($db::raw("pet_code,pet_name,pet_type"))
    ->where('f_status', '=', 'A')
    ->orderBy('pet_desc', 'asc')
    ->get()->toArray();

$listmas_info = $db::table("tbl_mas_info")
    ->select($db::raw("info_code,info_name"))
    ->where('f_status', '=', 'A')
    ->get()->toArray(); 

$listmas_disaster = $db::table("tbl_mas_disaster")
    ->select($db::raw("dis_code,dis_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('dis_code', 'asc')
    ->get()->toArray();

$listmas_facilities = $db::table("tbl_mas_facilities")
    ->select($db::raw("fac_code,fac_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('fac_code', 'asc')
    ->get()->toArray();

// validate  data in server site.----------------------------------------------------------------------
$temp_mem_citizen_id=[];
foreach ($familylists as $k => $v) { 
  $temp_mem_citizen_id[] = trim((isset($v['txtCitizenId']) ? $v['txtCitizenId'] : ''));  
  } 
$query = $db::table("fm_fam_members_dt1") 
    ->whereIn('mem_citizen_id',$temp_mem_citizen_id)
    ->select($db::raw("mem_citizen_id"));
if (isset($_POST['id']) && strlen(trim(@$_POST['id'])) > 0) {
    $query->whereNotIn('mem_fam_id', [$id]);
}
$rows_old = $query->get()->toArray();
$dupi_mem_citizen_id=[];
foreach ($rows_old as $k => $v) { 
   $dupi_mem_citizen_id[]=$v->mem_citizen_id;
}
 if(sizeof($dupi_mem_citizen_id)>0){
?>
  <script type="text/javascript">
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    html: 'มีข้อมูลเลขที่บัตรประชาชน <?=implode(",",$dupi_mem_citizen_id);?> ในระบบแล้ว!',
    }); 
  </script>
  <?php
  exit();
 } 
//-----------------------------------------------------------------------------------------------------
$query = $db::table("fm_fam_hd")
    ->where('house_no', '=', $txtHouseId)
    ->select($db::raw("fam_id,SUBSTRING(fam_id,1,2) AS yearfam_id,house_no,house_moo"));
if (isset($_POST['id']) && strlen(trim(@$_POST['id'])) > 0) {
    $query->whereNotIn('fam_id', [$id]);
}
$rows_old = $query->first();
 if(isset($rows_old->house_no)){
   ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      html: 'มีข้อมูลบ้านเลขที่ <?=$rows_old->house_no?> ในระบบแล้ว!',
      });  
  </script>
  <?php
  exit();
 } 

// validate   substr($id,0,2)
$rows_old=null;
if($id>0){
   $rows_old = $db::table("fm_fam_hd")
    ->where('fam_id', '=', $id)
    ->select($db::raw("fam_id,SUBSTRING(fam_id,1,2) AS yearfam_id,house_no,house_moo"))
    ->first();
      if($action!=3){
         if(!isset($rows_old->yearfam_id)||($rows_old->yearfam_id<$yearfam_id)){// ไม่มีข้อมูลเก่าหรือ idที่ใช้ปี<ปีปัจจุบัน insert ใหม่  
         $action=1;   
         }else if($rows_old->yearfam_id==$yearfam_id){// มีข้อมูลอยู่แล้วให้และปีเดี่ยวกัน update 
         $action=2; 
        }
    } 
}else{
  $action=1;     
}  
// test
// $action = 1;
// var_dump($action);exit();
 if ($action == 1) {/*Insert Data*/ 
    try {    
          $tran_id=$db::select("SELECT CONCAT($tran_id,nextval('sqfm_fam_hd')) AS tran_id")[0]->tran_id; 
          if(!insertall('insert',$tran_id)){throw new Exception("Error Processing insertall", 1);} 
          $db::beginTransaction(); 
          //pre_owner,owner_fname,owner_lname,citizen_id,x_status,x_sex,national,reg_code,date_of_birth,education_code,relations_code
          //$pre_owner,$owner_fname,$owner_lname,$citizen_id,$x_status,$x_sex,$national,$reg_code,$date_of_birth,$education_code,$relations_code
          $row =$db::insert("INSERT INTO fm_fam_hd (fam_id,house_no,house_moo,sub_district,district,province,post_code
          ,g_occupational_code,g_occupational_other,main_occupation_code,add_occupation_code
          ,income_per_year,d_create,fam_land_other,eco_occupation_code,eco_product_target_code,eco_capital_code,eco_product_cost,d_update,f_problem_env,problem_env_desc
          ,f_manage_env,manage_env_desc,conserve_env,f_help,help_desc,create_by,update_by,d_survey,f_status,eco_product_from,eco_product_to) 
             VALUES($tran_id,?,?,?,?,?,?,?,?,?,?,?,NOW(),?,?,?,?,?,NOW(),?,?,?,?,?,?,?,?,?,?,'A',?,?)",
             [$txtHouseId,$house_moo,$sub_district,$district,$province,$post_code,$g_occupational_code,$g_occupational_other,$main_occupation_code,$add_occupation_code,$income_per_year
             ,$fam_land_other,$eco_occupation_code,$eco_product_target_code,$eco_capital_code,$familyhomeproductioncost,$f_problem_env,$problem_env_desc,$f_manage_env
             ,$manage_env_desc,$conserve_env,$f_help,$help_desc,@$_SESSION['user_id'],@$_SESSION['user_id'],$d_survey,$eco_product_from,$eco_product_to
             ]); 
            $db::commit();
            $status='OK';  
      } catch (\Exception $e) { 
      $db::rollBack();
      Ceardata($tran_id);
      $status='Error'; 
      var_dump($e->getMessage());exit(); 
    } 
}else if($action == 2){// update data

    try {    
            $tran_id=$id;
            if(!insertall('update',$tran_id)){throw new Exception("Error Processing insertall", 1);} 
             $db::beginTransaction(); 
             //$pre_owner,$owner_fname,$owner_lname,$citizen_id,$x_status,$x_sex,$national,$reg_code,$date_of_birth,$education_code,$relations_code,
             $row =$db::update('update fm_fam_hd set house_no=?,house_moo=?,sub_district=?,district=?,province=?
            ,post_code=?,g_occupational_code=?,g_occupational_other=?,main_occupation_code=?
            ,add_occupation_code=?,income_per_year=?,fam_land_other=?,eco_occupation_code=?
            ,eco_product_target_code=?,eco_capital_code=?,eco_product_cost=?,d_update=NOW(),f_problem_env=?
            ,problem_env_desc=?,f_manage_env=?,manage_env_desc=?,conserve_env=?,f_help=?,help_desc=?,update_by=?,d_survey=?,eco_product_from=?,eco_product_to=?
            where fam_id = ?',
            [$txtHouseId,$house_moo,$sub_district,$district,$province,$post_code,$g_occupational_code,$g_occupational_other,$main_occupation_code,$add_occupation_code,$income_per_year
             ,$fam_land_other,$eco_occupation_code,$eco_product_target_code,$eco_capital_code,$familyhomeproductioncost,$f_problem_env,$problem_env_desc,$f_manage_env
             ,$manage_env_desc,$conserve_env,$f_help,$help_desc,@$_SESSION['user_id'],$d_survey,$eco_product_from,$eco_product_to
             ,$id
            ]); 
            $db::commit(); 
            $status='OK';   
    } catch (\Exception $e) {  
      $db::rollBack();
      $status='Error'; 
     var_dump($e->getMessage());exit();   
    }  
} else if($action == 3) {// Deleted 
        try { 
          $tran_id=$id;
          if(!Ceardata($tran_id)){throw new Exception("Error Processing Ceardata", 1);} 
          $db::table('fm_fam_hd')->where('fam_id', '=', $id)->delete(); 
		    	$status='deleted'; 
          } catch (\Exception $e) { 
          $status='Error';  
         }
       echo json_encode(['status'=>$status,'token'=>\Volnix\CSRF\CSRF::getToken('token_family_frm')]); exit();
  }
//}
// echo $status;exit(); 

if($action==1&&$status=='OK'){// insert
 ?> 
<script type="text/javascript">
  Swal.fire({
      title: 'บันทึกข้อมูลเรียบร้อยแล้ว', 
      allowOutsideClick: false,
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'ดูรายการทั้งหมด', 
      cancelButtonText:'ทำงานต่อ',
    }).then(function(result) { 
      if (result.isConfirmed) { 
         window.location = "../familyList.php";
      } 
    }); 
</script>
<?php
}else if(($action==2&&$status=='OK')){// update or deleted
?>
<script type="text/javascript">
  Swal.fire({
      title: 'แก้ไข้อมูลเรียบร้อยแล้ว',
      allowOutsideClick: false,
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: 'ดูรายการทั้งหมด' 
    }).then(function(result){
      if (result.isConfirmed) {
         window.location = "../familyList.php";
      }
    });
</script>
<?php
}else {// error
?>
<script type="text/javascript">
  Swal.fire({
      title: 'ระบบผิดพลาด!',
      allowOutsideClick: false,
      showDenyButton: false,
      showCancelButton: false,
      confirmButtonText: 'ดูรายการทั้งหมด' 
    }).then(function(result) {
      if (result.isConfirmed) {
         window.location = "../familyList.php";
      }
    });
</script>
<?php
} 
exit();
  // Clear old data
function Ceardata($id){
global $db;
try {
  $db::beginTransaction(); 
  $db::table('fm_fam_members_dt1')->where('mem_fam_id', '=', $id)->delete();
  $db::table('fm_fam_land_dt2')->where('land_fam_id', '=', $id)->delete();
  $db::table('fm_fam_facilities_dt3')->where('fac_fam_id', '=', $id)->delete();
  $db::table('fm_fam_pet_dt4')->where('pet_fam_id', '=', $id)->delete();
  $db::table('fm_fam_disaster_dt5')->where('dis_fam_id', '=', $id)->delete();
  $db::table('fm_fam_info_dt6')->where('info_fam_id', '=', $id)->delete(); 
  $db::commit(); 
  return true;
 } catch (\Exception $e) { 
  $db::rollBack();
  return false;
}

}
//  inset data u   
function insertall($type,$tran_id){
     global $db,$familylists,$famerdetaillists_deed,$famerdetaillists_norsor3kors
    ,$famerdetaillists_spoks,$famerdetaillists_chapter5s,$select_facilities
    ,$listmas_pet,$disaster,$mas_info_select,$listmas_disaster,$listmas_info,$data_mas_pet,$listmas_facilities;
    try { 
              $db::beginTransaction(); 
              // Clear old data
              if($type=='update'){
              $db::table('fm_fam_members_dt1')->where('mem_fam_id', '=', $tran_id)->delete();
              $db::table('fm_fam_land_dt2')->where('land_fam_id', '=', $tran_id)->delete();
              $db::table('fm_fam_facilities_dt3')->where('fac_fam_id', '=', $tran_id)->delete(); 
              $db::table('fm_fam_pet_dt4')->where('pet_fam_id', '=', $tran_id)->delete();
              $db::table('fm_fam_disaster_dt5')->where('dis_fam_id', '=', $tran_id)->delete();
              $db::table('fm_fam_info_dt6')->where('info_fam_id','=', $tran_id)->delete(); 
              }
             // 1.ข้อมูลสมาชิกครัวเรือน
             $batc_insert_sql_people=[];
             foreach ($familylists as $k => $v) {
                  //if($k==0){continue;}// skip first
                  $mem_pre = trim((isset($v['prefix']) ? $v['prefix'] : ''));
                  $mem_fname = trim((isset($v['txtFName']) ? $v['txtFName'] : ''));
                  $mem_lname = trim((isset($v['txtLName']) ? $v['txtLName'] : ''));
                  $mem_citizen_id = trim((isset($v['txtCitizenId']) ? $v['txtCitizenId'] : ''));
                  $mem_status =trim((isset($v['xFstatusRd']) ? $v['xFstatusRd'] : ''));
                  $mem_sex = trim((isset($v['sexRd']) ? $v['sexRd'] : ''));
                  $f_status = trim((isset($v['memF_status']) ? $v['memF_status'] : ''));
                  $mem_national = trim((isset($v['txtNational']) ? $v['txtNational'] : ''));
                  $mem_religion_code = trim((isset($v['religion']) ? $v['religion'] : ''));
                  $mem_df_birth = trim((isset($v['birthday']) ? $v['birthday'] : ''));
                  $mem_df_birth = preg_replace("/(\d+)\/(\d+)\/(\d+)/", "$3-$2-$1", $mem_df_birth);
                  $mem_education_code = trim((isset($v['educationlevel']) ? $v['educationlevel'] : ''));
                  $mem_relations_code = trim((isset($v['homerelations']) ? $v['homerelations'] : ''));  
                  $xmain_occupation_code = trim((isset($v['careermain']) ? $v['careermain'] : '')); 
                  $xadditional_occupation_code = trim((isset($v['careersecond']) ? $v['careersecond'] : ''));
                  $xincome_per_year = trim((isset($v['netIncome']) ? $v['netIncome'] : ''));
               
                  $batc_insert_sql_people[] =['mem_fam_id' =>$tran_id, 'd_create' =>$db::raw('NOW()') , 'f_status' =>$f_status, 'create_by' =>@$_SESSION['user_id'], 'mem_pre' =>$mem_pre
                                      ,'mem_fname' =>$mem_fname,'mem_lname' =>$mem_lname,'mem_citizen_id' =>$mem_citizen_id,'mem_status' =>$mem_status
                                      ,'mem_sex' =>$mem_sex,'mem_national' =>$mem_national,'mem_religion_code' =>$mem_religion_code
                                      ,'mem_df_birth' =>$mem_df_birth,'mem_education_code' =>$mem_education_code,'mem_relations_code' =>$mem_relations_code,'xmain_occupation_code' =>$xmain_occupation_code
                                      ,'xadditional_occupation_code' =>$xadditional_occupation_code,'xincome_per_year' =>$xincome_per_year,'mem_seq' =>$k+1];   
              } 
               
              if(sizeof($batc_insert_sql_people)>0){
                  $row=$db::table('fm_fam_members_dt1')->insert($batc_insert_sql_people);
                } 
            
             //2.ข้อมูลพื้นที่การเกษตร
             $batc_insert_sql_deed=[]; 
              foreach ($famerdetaillists_deed as $k => $v) {  
                  $province = trim((isset($v['province']) ? $v['province'] : ''));
                  $district = trim((isset($v['district']) ? $v['district'] : ''));
                  $nodeed = trim((isset($v['nodeed']) ? $v['nodeed'] : ''));
                  $arearai = trim((isset($v['arearai']) ? $v['arearai'] : ''));
                  $areawork = trim((isset($v['areawork']) ? $v['areawork'] : ''));
                  $areatrw = trim((isset($v['areatrw']) ? $v['areatrw'] : '')); 

                  $batc_insert_sql_deed[] =['land_fam_id' =>$tran_id, 'd_create' =>$db::raw('NOW()') , 'f_status' =>'A', 'create_by' =>@$_SESSION['user_id'], 'land_seq' =>$k+1
                                      ,'land_type' =>'title_deed','province' =>$province,'district' =>$district,'title_deed_id' =>$nodeed
                                      ,'area1_rai' =>$arearai,'area2_work' =>$areawork,'area3_sqw' =>$areatrw];  
            }  
            
            $batc_insert_sql_norsor3kors=[]; 
              foreach ($famerdetaillists_norsor3kors as $k => $v) {  
                  $province = trim((isset($v['province']) ? $v['province'] : ''));
                  $district = trim((isset($v['district']) ? $v['district'] : ''));
                  $nodeed = trim((isset($v['nodeed']) ? $v['nodeed'] : ''));
                  $arearai = trim((isset($v['arearai']) ? $v['arearai'] : ''));
                  $areawork = trim((isset($v['areawork']) ? $v['areawork'] : ''));
                  $areatrw = trim((isset($v['areatrw']) ? $v['areatrw'] : '')); 

                  $batc_insert_sql_norsor3kors[] =['land_fam_id' =>$tran_id, 'd_create' =>$db::raw('NOW()') , 'f_status' =>'A', 'create_by' =>@$_SESSION['user_id'], 'land_seq' =>$k+1
                                      ,'land_type' =>'NorSor3Kor','province' =>$province,'district' =>$district,'title_deed_id' =>$nodeed
                                      ,'area1_rai' =>$arearai,'area2_work' =>$areawork,'area3_sqw' =>$areatrw]; 
            }  
             $batc_insert_sql_spoks=[]; 
              foreach ($famerdetaillists_spoks as $k => $v) {  
                  $province = trim((isset($v['province']) ? $v['province'] : ''));
                  $district = trim((isset($v['district']) ? $v['district'] : ''));
                  $nodeed = trim((isset($v['nodeed']) ? $v['nodeed'] : ''));
                  $arearai = trim((isset($v['arearai']) ? $v['arearai'] : ''));
                  $areawork = trim((isset($v['areawork']) ? $v['areawork'] : ''));
                  $areatrw = trim((isset($v['areatrw']) ? $v['areatrw'] : '')); 

                  $batc_insert_sql_spoks[] =['land_fam_id' =>$tran_id, 'd_create' =>$db::raw('NOW()') , 'f_status' =>'A', 'create_by' =>@$_SESSION['user_id'], 'land_seq' =>$k+1
                                      ,'land_type' =>'sorporkor','province' =>$province,'district' =>$district,'title_deed_id' =>$nodeed
                                      ,'area1_rai' =>$arearai,'area2_work' =>$areawork,'area3_sqw' =>$areatrw];  
            } 
            
            $batc_insert_sql_chapter5s=[]; 
            foreach ($famerdetaillists_chapter5s as $k => $v) {  
                  $province = trim((isset($v['province']) ? $v['province'] : ''));
                  $district = trim((isset($v['district']) ? $v['district'] : ''));
                  $nodeed = trim((isset($v['nodeed']) ? $v['nodeed'] : ''));
                  $arearai = trim((isset($v['arearai']) ? $v['arearai'] : ''));
                  $areawork = trim((isset($v['areawork']) ? $v['areawork'] : ''));
                  $areatrw = trim((isset($v['areatrw']) ? $v['areatrw'] : '')); 

                  $batc_insert_sql_chapter5s[] =['land_fam_id' =>$tran_id, 'd_create' =>$db::raw('NOW()') , 'f_status' =>'A', 'create_by' =>@$_SESSION['user_id'], 'land_seq' =>$k+1
                                      ,'land_type' =>'porbortor5','province' =>$province,'district' =>$district,'title_deed_id' =>$nodeed
                                      ,'area1_rai' =>$arearai,'area2_work' =>$areawork,'area3_sqw' =>$areatrw]; 
               } 

              //run batc all  
               
               if(sizeof($batc_insert_sql_deed)>0){
                  $row=$db::table('fm_fam_land_dt2')->insert($batc_insert_sql_deed);
                } 
                if(sizeof($batc_insert_sql_norsor3kors)>0){
                  $row=$db::table('fm_fam_land_dt2')->insert($batc_insert_sql_norsor3kors);
                }
                if(sizeof($batc_insert_sql_spoks)>0){
                  $row=$db::table('fm_fam_land_dt2')->insert($batc_insert_sql_spoks);
                }
                if(sizeof($batc_insert_sql_chapter5s)>0){
                  $row=$db::table('fm_fam_land_dt2')->insert($batc_insert_sql_chapter5s);
                }  

             // 3.เครื่องมืออำนวยความสะดวกทางการเกษตร
             $batc_insert_sql_facilities=[];
             foreach ($select_facilities as $k => $v) { 
                  if(isset($v['selected'])&&@$v['selected']=='true'){ 
                     foreach ($listmas_facilities as $k2 => $v2) { // เทียบกับ data จริง
                         if($v2->fac_code==$v['fac_code']){ 
                          $batc_insert_sql_facilities[]=['fac_fam_id'=>$tran_id,'fac_code'=>$v2->fac_code,'fac_name'=>$v2->fac_name,'fac_quantity'=>(int)$v['fac_quantity']];
                         }
                      }
                   }  
                } 

              if(sizeof($batc_insert_sql_facilities)>0){
                  $row=$db::table('fm_fam_facilities_dt3')->insert($batc_insert_sql_facilities);
               } 
           
             //4.สัตว์เลี้ยง  
              $batc_insert_sql_mas_pet=[];
             foreach ($listmas_pet as $k => $v) { 
                  if(isset($v['selected'])&&@$v['selected']=='true'){ 
                     foreach ($data_mas_pet as $k2 => $v2) { // เทียบกับ data จริง
                         if($v2->pet_code==$v['pet_code']){ 
                          $batc_insert_sql_mas_pet[]=['pet_fam_id'=>$tran_id,'pet_code'=>$v['pet_code'],'pet_name'=>$v['pet_name'],'pet_quantity'=>(int)$v['pet_quantity']
                        ,'pet_vacine_qt'=>$v['pet_vacine_qt'],'pet_desc'=>$v['pet_desc']];
                         break;
                     } 
                   }
                  } 
                } 

              if(sizeof($batc_insert_sql_mas_pet)>0){
                  $row=$db::table('fm_fam_pet_dt4')->insert($batc_insert_sql_mas_pet);
               } 
            
            // 5.ภัยธรรมชาติ
             $batc_insert_sql_mas_pet=[];
             foreach ($disaster as $k => $v) { 
                  foreach ($listmas_disaster as $k2 => $v2) { // เทียบกับ data จริง
                    if($v2->dis_code==$v){ 
                      $batc_insert_sql_mas_pet[]=['dis_fam_id'=>$tran_id,'dis_code'=>$v2->dis_code,'dis_name'=>$v2->dis_name];
                       break;
                    }
                  } 
                } 
              
              if(sizeof($batc_insert_sql_mas_pet)>0){
                  $row=$db::table('fm_fam_disaster_dt5')->insert($batc_insert_sql_mas_pet);
               }
         
             //6. ข่าวสารทางด้านการเกษตร
             $batc_insert_sql_fam_info=[];
             foreach ($mas_info_select as $k => $v) {
                  foreach ($listmas_info as $k2 => $v2) { // เทียบกับ data จริง 
                    if($v2->info_code==$v){ 
                      $batc_insert_sql_fam_info[]=['info_fam_id'=>$tran_id,'info_code'=>$v2->info_code,'info_name'=>$v2->info_name];
                      break;
                    }
                  } 
                } 

              if(sizeof($batc_insert_sql_fam_info)>0){
                  $row=$db::table('fm_fam_info_dt6')->insert($batc_insert_sql_fam_info);
               } 
       $db::commit();      
       return true;
     } catch (\Exception $e) { 
       $db::rollBack();
      //  var_dump($e->getMessage());exit();   
       return false;
    }
}
?>