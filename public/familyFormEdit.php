<?php
$webtitle='เพิ่มข้อมูลครัวเรือน';
require 'bootstart.php';
require ROOT . '/core/security.php';
require_once 'components/header.php';

$listprovinces= $db::table("provinces")
    ->select($db::raw("id,code,name_th,name_en")) 
    ->orderBy('name_th', 'asc')
    ->get()->toArray();  
  
$listamphures=[];

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
->orderBy('pet_desc', 'asc')
->get()->toArray();

$listmas_info = $db::table("tbl_mas_info")
    ->select($db::raw("info_code,info_name"))
    ->where('f_status', '=', 'A') 
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

$listmas_facilities= $db::table("tbl_mas_facilities")
    ->select($db::raw("fac_code,fac_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('fac_code', 'asc')
    ->get()->toArray();

$listmas_educate= $db::table("tbl_mas_educate")
    ->select($db::raw("ed_code,ed_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('ed_desc', 'asc')
    ->get()->toArray();

$listmas_disaster= $db::table("tbl_mas_disaster")
    ->select($db::raw("dis_code,dis_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('dis_code', 'asc')
    ->get()->toArray();

$listmas_addition= $db::table("tbl_mas_addition")
    ->select($db::raw("add_code,add_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('add_desc', 'asc')
    ->get()->toArray();

// $listdepartments = $db::table("tbl_departments")
//     ->select($db::raw("dept_code,dept_name"))
//     ->where('f_status', '=', 'A')
//     ->orderBy('dept_desc', 'asc')
//     ->get()->toArray();
 

$tbl_mas_info_base = splitMyArray($listmas_info, 3);
$tbl_mas_info1 = (isset($tbl_mas_info_base[0]) ? $tbl_mas_info_base[0] : []);
$tbl_mas_info2 = (isset($tbl_mas_info_base[1]) ? $tbl_mas_info_base[1] : []);
$tbl_mas_info3 = (isset($tbl_mas_info_base[2]) ? $tbl_mas_info_base[2] : []);
//ภัยธรรมชาติ
$disaster_datarows = splitMyArray($listmas_disaster, 2);
$listmas_disaster1 = (isset($disaster_datarows[0]) ? $disaster_datarows[0] : []);
$listmas_disaster2 = (isset($disaster_datarows[1]) ? $disaster_datarows[1] : []);

$mooHouse =''; 
if(!isset($_GET['id'])&&sizeof(@$listmas_vilage)>0){
$mooHouse=@$listmas_vilage[0]->vil_id;
}    

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
  //กลุ่มอาชีพ:
  var group_occup= <?=json_encode($listmas_group_occup); ?>; 
  window.Slistmas_group_occup=group_occup.reverse().concat({goccup_code: null, goccup_name: "กรุณาเลือกข้อมูล"}).reverse();
  // อาชีพหลัก/รอว
  var occupation= <?=json_encode($listmas_occupation); ?>; 
  window.Slistmas_occupation=occupation.reverse().concat({occup_code: null, occup_name: "กรุณาเลือกข้อมูล"}).reverse();
  // ข้อมูลจังหวัด 
  var provinces= <?=json_encode($listprovinces); ?>; 
  window.Slistprovinces=provinces.reverse().concat({code: null,id:null,name_en:'กรุณาเลือกข้อมูล',name_th: "กรุณาเลือกข้อมูล"}).reverse(); 
    //เครื่องมืออำนวยความสะดวกทางการเกษตร
  window.Slistmas_facilities=<?=json_encode($listmas_facilities); ?>;  
  // สัตว์เลี้ยง 
  window.listmas_pet=<?=json_encode($listmas_pet); ?>;  
  
  //อาชีพในครัวเรือน:
  window.Shouseinforgeneral={familyhomecareer:null,familyhomeproducttarget:null,familyhomesourceoffunds:null,
      familyhomeproductperiod:'',familyhomeproductioncost:'',familyhometractor:0,
      familyhomewalkingtractor:0,familyhomcartuktuk:0,familyhomcarharvester:0,
      familyhomcarbalers:0,familyhomother:'',
    };

  window.Shouseinfor={txtHouseId:'',  mooHouse:null,txtSubDstrict:'',txtDistrict:'',txtProvince:'', txtPostalCode:''}; 

  window.Sfamerdetaillists={deeds:[],norsor3kors:[],spoks:[],chapter5s:[],another:''};
  window.SSfamerdetaillists={deeds:[],norsor3kors:[],spoks:[],chapter5s:[],another:''};

  window.Sfamilylist={prefix:null,txtFName: '',txtLName:'',txtCitizenId:'' ,xFstatusRd:1,sexRd:1,txtNational:'',religion:null,birthday:''
  ,educationlevel:null,homerelations:null,careergroup:null,careeranother:'',careermain:null,careersecond:null,netIncome:''}; 
  window.Sfamilylists=[window.Sfamilylist];
  window.SSfamilylists=[window.Sfamilylist];

  window.Mfamilylist={prefix:null,txtFName: '',txtLName:'',txtCitizenId:'' ,xFstatusRd:1,sexRd:1,txtNational:'',religion:null,birthday:''
  ,educationlevel:null,homerelations:null,careergroup:null,careeranother:'',careermain:null,careersecond:null,netIncome:''};  

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
   window.xEnvironmental=1;
   window.xEnvironmentaldisc='';
   window.xEnvironmental2=1;
   window.xEnvironmental2disc='';
   window.greenxEnvironmentaldisc='';
   window.otherdisastersdisc='';
   window.helpme='N';
   window.helpmedisc='';
   //ข่าวสารทางด้านการเกษตร
   window.tbl_mas_info1=<?=json_encode($tbl_mas_info1); ?>; 
   window.tbl_mas_info2=<?=json_encode($tbl_mas_info2); ?>;
   window.tbl_mas_info3=<?=json_encode($tbl_mas_info3); ?>;
   window.Smas_info={selected:[],another:''};
   //ภัยธรรมชาติ
   window.listmas_disaster1=<?=json_encode($listmas_disaster1); ?>; 
   window.listmas_disaster2=<?=json_encode($listmas_disaster2); ?>;
   window.Sdisaster={selected:[],another:''};
   
 </script>
<style> 
  .dirty {
    border-color: #5A5!important;
    background: #EFE!important;
    }
    .dirty:focus {
    outline-color: #8E8!important;
    }
    .error {
    border-color: red!important;
    background: #FDD!important;
    }
    .error:focus {
    outline-color: #F99!important;
    } 
</style> 
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">เพิ่มข้อมูลครัวเรือน</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                	<em class="fa fa-home"></em>
                <a href="#">Home</a></li>
              <li class="breadcrumb-item active">เพิ่มข้อมูลครัวเรือน</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 
    <!-- Main content -->
      <section class="content" id="app" v-cloak> 
      <form @submit.prevent="submit" id="frm_family" ref="frm_family">   
        <!-- <pre>{{$data}}</pre> -->
        <!-- <pre>{{ $v }}</pre> -->  
       <div class="container-fluid"> 
        <!-- SELECT2 EXAMPLE ข้อมูลครัวเรือน -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลครัวเรือน [ที่อยู่ตามทะเบียนบ้าน]</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
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
                <!-- /.form-group -->
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
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label>ตำบล :</label>
                     <input type="text" :class="status($v.Mhouseinfor.txtSubDstrict)" required v-model.trim="$v.Mhouseinfor.txtSubDstrict.$model"  name="txtSubDstrict" value="โคกขมิ้น" id="txtSubDstrict" class="form-control" placeholder="ตำบล  ...">
                 </div>
                 <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <!-- /.row -->           
             <div class="row">

               <div class="col-md-4">
                 <div class="form-group">
                   <label>อำเภอ:</label>
                   <input type="text" :class="status($v.Mhouseinfor.txtDistrict)" required v-model.trim="$v.Mhouseinfor.txtDistrict.$model"  name="txtDistrict" value="พลับพลาชัย  " id="txtDistrict" class="form-control" placeholder="อำเภอ  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <div class="form-group">
                   <label>จังหวัด:</label>
                   <input type="text" :class="status($v.Mhouseinfor.txtProvince)" required v-model.trim="$v.Mhouseinfor.txtProvince.$model"  name="txtProvince" value="บุรีรัมย์ " id="txtProvince" class="form-control" placeholder="จังหวัด  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
                <div class="col-md-4">
                      <div class="form-group">
                          <label>รหัสไปรษณีย์:</label>
                          <input type="text" :class="status($v.Mhouseinfor.txtPostalCode)" required v-model.trim="$v.Mhouseinfor.txtPostalCode.$model"  name="txtPostalCode" value="31250" id="txtPostalCode" class="form-control" placeholder="รหัสไปรษณีย์  ...">
                      </div>
                        <!-- /.form-group -->
                  </div>
                <!-- /.col -->
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
        <div class="card card-warning">
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
				<a class="btn btn-info btn-sm" href="javascript:void(0)" v-if="index==0" v-on:click="addPeople">
				  <i class="fas fa-plus-square"></i> เพิ่มสมาชิกในครัวเรือน
                </a>
                <a href="javascript:void(0)" class="btn-sm btn-danger" v-if="index>0" v-on:click="removePeople(index)"><i class="fas fa-trash"></i></a>
		    	</h5>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>คำนำหน้า:</label>
                  <!-- v-model="item.prefix" v-bind:class="{ 'error dirty':item.prefix.$error, '': !item.prefix.$error}" v-model.trim="item.prefix.$model"-->
                  <select class="form-control" :class="status(item.prefix)" v-model.trim="item.prefix.$model" @blur="item.prefix.$touch()">
                     <option v-for="(v, indexx) in listmas_prefix" v-bind:value="v.pre_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.pre_name}}</option> 
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ชื่อเจ้าบ้าน :</label>
                  <input type="text" name="txtFName[]" :class="status(item.txtFName)" v-model.trim="item.txtFName.$model" @blur="item.txtFName.$touch()" id="txtFName" class="form-control" placeholder="ชื่อเจ้าบ้าน...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>นามสกุล:</label>
                  <input type="text" name="txtLName[]" :class="status(item.txtLName)" v-model.trim="item.txtLName.$model" @blur="item.txtLName.$touch()" id="txtLName" class="form-control" placeholder="นามสกุล...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>เลขที่ประจำตัวประชาชน  :</label>
                    <input type="text" name="txtCitizenId" :class="status(item.txtCitizenId)" v-model.trim="item.txtCitizenId.$model" @blur="item.txtCitizenId.$touch()" id="txtCitizenId" class="form-control" placeholder="เลขที่ประจำตัวประชาชน  ...">
                </div>
                <!-- /.form-group -->
              </div>

            </div>
            <!-- /row -->

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>สถานภาพ :</label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline"> 
                      <input type="radio" :id="'radioPrimary1'+index" value="1" :class="status(item.xFstatusRd)" v-model.trim="item.xFstatusRd.$model" @blur="item.xFstatusRd.$touch()"> 
                      <label :for="'radioPrimary1'+index">เจ้าบ้าน 
                      </label>
                    </div>
                    <div class="icheck-primary d-inline"> 
                      <input type="radio" :id="'radioPrimary2' + index" value="2" :class="status(item.xFstatusRd)" v-model.trim="item.xFstatusRd.$model" @blur="item.xFstatusRd.$touch()">
                      <label :for="'radioPrimary2'+index">ผู้อยู่อาศัย 
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>เพศ  :</label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary3'+index" value="1" v-model="item.sexRd" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioPrimary3'+index">ชาย
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary4'+index" value="2" v-model="item.sexRd" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioPrimary4'+index">หญิง
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary5'+index"  value="3" v-model="item.sexRd" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioPrimary5'+index">อื่นๆ
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->

              <div class="col-md-3">
                <div class="form-group">
                  <label>สัญชาติ  :</label>
                  <input type="text" name="txtNational" :class="status(item.txtNational)" v-model.trim="item.txtNational.$model" @blur="item.txtNational.$touch()" id="txtNational" class="form-control" placeholder="สัญชาติ  ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                 <div class="form-group">
                    <label>ศาสนา :</label>
                    <select class="form-control" name="religion" id="religion" :class="status(item.religion)" v-model.trim="item.religion.$model" @blur="item.religion.$touch()">
                      <option v-for="(v, indexx) in listmas_religion" :value="v.reg_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.reg_name}}</option> 
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>
               <!-- /.col -->
            </div>
            <!-- /row -->


            <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label>วันเดือนปีเกิด :</label>  
                   <date-picker2  v-model.trim="item.birthday.$model" @blur="item.birthday.$touch()"  :class="status(item.birthday)" :mdata="item.birthday.$model"></date-picker2>  
                   <!-- v-model.trim="item.birthday.$model" @blur="item.birthday.$touch()"  :class="status(item.birthday)"   -->
                  <!-- <div class="input-group date" id="birthday" data-target-input="nearest"> 
                      <input type="text" v-model.trim="item.birthday" class="form-control  "  />
                      <div class="input-group-append" data-target="#birthday" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div> -->
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->

                <!-- /.col -->
                <div class="col-md-3">
                   <div class="form-group">
                      <label>ระดับการศึกษา :</label>
                      <select class="form-control"  name="educationlevel" id="educationlevel" :class="status(item.educationlevel)" v-model.trim="item.educationlevel.$model" @blur="item.educationlevel.$touch()">
                        <option v-for="(v, indexx) in listmas_educate" :value="v.ed_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.ed_name}}</option> 
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                 <!-- /.col -->
                 <div class="col-md-3">
                    <div class="form-group">
                       <label>ความสัมพันธ์ในครัวเรือน  :</label>
                       <select class="form-control" name="homerelations" id="homerelations" :class="status(item.homerelations)" v-model.trim="item.homerelations.$model" @blur="item.homerelations.$touch()">
                          <option v-for="(v, indexx) in listmas_relations" :value="v.re_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.re_name}}</option>
                       </select>
                     </div>
                     <!-- /.form-group -->
                   </div>
               <!-- /.col -->

               <div class="col-md-3" v-if="index==0">
                    <div class="form-group">
                            <label>กลุ่มอาชีพ :</label>
                             <select class="form-control"  name="careergroup" id="careergroup" :class="status(item.careergroup)" v-model.trim="item.careergroup.$model" @blur="item.careergroup.$touch()">
                             <option v-for="(v, indexx) in listmas_group_occup" :value="v.goccup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.goccup_name}}</option> 
                            </select>
                     </div>
                       <!-- /.form-group -->
                </div>
              <div class="col-md-3" v-if="index==0">
                <div class="form-group">
                  <label>กลุ่มอาชีพอื่นๆ  :</label>
                  <textarea class="form-control" name="careeranother" id="careeranother" rows="1" placeholder="กลุ่มอาชีพอื่นๆ ระบุ  ..." :class="status(item.careeranother)" v-model.trim="item.careeranother.$model" @blur="item.careeranother.$touch()">
                      {{item.careeranother}}
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
				<div class="col-md-3">
					<div class="form-group">
							<label>อาชีพหลัก :</label>
							 <select class="form-control" name="careermain" id="careermain" :class="status(item.careermain)" v-model.trim="item.careermain.$model" @blur="item.careermain.$touch()">  
                <option v-for="(vv, indexx) in listmas_occupation" :value="vv.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.occup_name}}</option> 
							</select>
					 </div>
					   <!-- /.form-group -->
				</div>
				 <div class="col-md-3">
					<div class="form-group">
							<label>อาชีพรอง :</label>
							 <select class="form-control" name="careersecond" id="careersecond" :class="status(item.careersecond)" v-model.trim="item.careersecond.$model" @blur="item.careersecond.$touch()">
               <option v-for="(vv, indexx) in listmas_occupation" :value="vv.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.occup_name}}</option> 
                 <!-- <option>ไม่มี</option>
							  <option>ทำนา</option>
							 <option>ทำไร่</option>
							 <option>ทำสวน</option>
							 <option>เลี้ยงสัตย์</option>
							 <option>เพาะเลี้ยงสัตย์น้ำ</option>
							 <option>ทำประมง</option>
							 <option>รับจ้างทั่วไป/ บริการ</option>
							 <option>ทำงานบ้าน</option>
							 <option>กรรมกร</option>
							 <option>ค้าขาย/ ธุรกิจส่วนตัว</option>
							 <option>อุตสาหกรรมในครัวเรือน</option>
							 <option>อื่นๆ</option> -->
							</select>
					 </div>
					   <!-- /.form-group -->
				</div>
				<div class="col-md-3">
					<div class="form-group">
					  <label>รายได้/ต่อปี  :</label>								
						<input type="number" name="netIncome" :class="status(item.netIncome)" v-model.trim="item.netIncome.$model" @blur="item.netIncome.$touch()" id="netIncome" class="form-control btn-xs" placeholder="รายได้/ต่อปี...">
					</div>
					<!-- /.form-group -->
				 </div>

              </div> 
              <hr v-if="showhr(Mfamilylists,index)">
            </template> 
            <!-- /row -->
            <!-- row -->  
          </div>
          <!-- /.card-header -->

          <!-- /.card-body
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            <button type="reset" class="btn btn-warning">รีเซ็ท</button>
          </div>  -->

        </div>
        <!-- /.card -->

       <!-- SELECT2 EXAMPLE ข้อมูลพื้นที่การเกษตร -->
        <div class="card card-success">
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
              <a class="d-sm-inline-block btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addDeed()"><i class="fas fa-plus-square"></i> เพิ่มโฉนด
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
                                <th style="width: 10%">#</th>
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
                        <select class="form-control btn-xs" @blur="item.district.$touch()"  required @change="changedistrict('deeds',$event,index)"> 
                            <template v-for="(vv, indexx) in famerdetaillists.deeds[index].district">  
                               <option :value="vv.id" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
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
                                <td>
                                <a href="javascript:void(0)" v-on:click="removeDeed(index)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
                                </td>
                              </tr>  
                              </template>  
                             </tbody>
                         </table>       
                    </div>  
                </div>   
                 

            <h5 class="d-sm-inline-block">นส.3ก</h5>
            <a class="inline btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addNorsor3kors()">
              <i class="fas fa-plus-square"></i> เพิ่ม นส.3ก
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
                                <th style="width: 10%">#</th>
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
								 <select class="form-control btn-xs" name="district[]"  :class="status(item.district)" @blur="item.district.$touch()"> 
                   <template v-for="(vv, indexx) in famerdetaillists.norsor3kors[index].district">  
                             <option :value="vv.id" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
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
                                <td>
                                  <a href="javascript:void(0)" v-on:click="removeNorsor3kors(index)"  class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>
                              </template> 
                            </tbody>
                          </table>

              </div>
            </div>
            <h5 class="d-sm-inline-block">สปก.</h5>
            <a class="inline btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addSpoks()">
              <i class="fas fa-plus-square"></i> เพิ่ม สปก.
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
                                <th style="width: 10%">#</th>
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
								 <select class="form-control btn-xs" name="district[]" :class="status(item.district)"  @blur="item.district.$touch()">
								    <template v-for="(vv, indexx) in famerdetaillists.spoks[index].district">  
                              <option :value="vv.id" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
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
                                <td>
                                  <a href="javascript:void(0)" v-on:click="removeSpoks(index)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>
                            </template>  
                            </tbody>
                          </table>

              </div>
            </div>
            <h5 class="d-sm-inline-block">ภบท 5</h5>
            <a class="inline btn btn-info btn-sm" href="javascript:void(0)" v-on:click="addChapter5s()">
              <i class="fas fa-plus-square"></i> เพิ่ม ภบท 5
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
                                <th style="width: 10%">#</th>
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
								 <select class="form-control btn-xs" name="district[]" :class="status(item.district)"  @blur="item.district.$touch()">
								   <template v-for="(vv, indexx) in famerdetaillists.chapter5s[index].district">  
                               <option :value="vv.id" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
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
                                <td>
                                <a href="javascript:void(0)" v-on:click="removeChapter5s(index)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
                                </td>
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
                  <textarea class="form-control" name="another" v-model.trim="Mfamerdetaillists.another" rows="2" placeholder="อื่นๆ ..."></textarea>
                </div>
              </div>
            </div>


          </div>
          <!-- /.card-header -->

          <!-- /.card-body
          <div class="card-footer">
          </div> -->
        </div>
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE xxxx -->
        <div class="card card-info">
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
					         <option v-for="(vv, indexx) in listmas_occupation" :value="vv.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.occup_name}}</option> 
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
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>แหล่งเงินทุน (ครัวเรือน) :</label>
                  <select class="form-control"  class="form-control" name="familyhomesourceoffunds" id="familyhomesourceoffunds" :class="status($v.Mhouseinforgeneral.familyhomesourceoffunds)" v-model.trim="$v.Mhouseinforgeneral.familyhomesourceoffunds.$model" @blur="$v.Mhouseinforgeneral.familyhomesourceoffunds.$touch()">
                   <option v-for="(vv, indexx) in listfamilyhomesourceoffunds" :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.name}}</option> 
                  </select>
                </div>
                <!-- /.form-group -->
              </div>

            </div>
            <!-- /row -->
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
                                <input type="text" class="form-control float-right" class="form-control" name="familyhomeproductperiod" id="familyhomeproductperiod" :class="status($v.Mhouseinforgeneral.familyhomeproductperiod)" v-model.trim="$v.Mhouseinforgeneral.familyhomeproductperiod.$model" @blur="$v.Mhouseinforgeneral.familyhomeproductperiod.$touch()">
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
                <!-- /.form-group -->
              </div>

            </div>
            <!-- /row -->

            <label>เครื่องมืออำนวยความสะดวกทางการเกษตร</label>
            <div class="row">
              <template v-for="(item, index) in Mlistmas_facilities">   
              <div class="col-md-3">
                <div class="form-check">
				      <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" v-model="item.select_fac_code"> {{item.fac_name}} </label>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" :disabled="!item.select_fac_code" v-model="item.fac_quantity" :placeholder="'จำนวน...' + item.fac_name"  value="">
                </div>
                </div>
                <!-- /.form-group -->   
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
                                  <input class="form-check-input"  type="checkbox" v-model="item.selected"  :id="'apetcheck_'+item.pet_code"> {{item.pet_name}}</label>
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
                      <input type="radio" id="radioPrimary8" v-model="xEnvironmental" name="xEnvironmental" value="1">
                      <label for="radioPrimary8">ไม่มี
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary9" v-model="xEnvironmental" name="xEnvironmental"  value="2" checked>
                      <label for="radioPrimary9">มี (ระบุ)					  
                      </label>
                        <textarea class="form-control" v-model="xEnvironmentaldisc" id="xEnvironmentaldisc" rows="1" placeholder="มี (ระบุ)..." :disabled="xEnvironmental==1"></textarea>
                    </div>
                  </div>
                </div>
                </div>
                <!-- /.form-group -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-check-label">การจัดการสิ่งแวดล้อม :</label>
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary10x" v-model="xEnvironmental2" name="xEnvironmental2" value="1">
                        <label for="radioPrimary10x">ไม่มี
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary11" v-model="xEnvironmental2" name="xEnvironmental2" value="2" checked >
                        <label for="radioPrimary11">มี(ระบุ)
                        </label>
				          		 <textarea class="form-control" v-model="xEnvironmental2disc" id="xEnvironmental2disc" rows="1" :disabled="xEnvironmental2==1" placeholder="มี (ระบุ)..."></textarea>
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-check-label">การอนุรักษ์สิ่งแวดล้อม</label>
                        <textarea class="form-control" v-model="greenxEnvironmentaldisc" id="greenxEnvironmentaldisc" rows="2" placeholder="การอนุรักษ์สิ่งแวดล้อม  ..."></textarea>
                      </div>
                    </div>
                    <!-- /.form-group -->

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
				
                <!-- /.form-group -->
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
                <!-- /.form-group -->
  
                <!-- /.form-group -->
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
                  <!-- /.form-group -->				  
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
                
                <!-- /.form-group --> 
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
                <!-- /.form-group -->
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
                 <!-- /.form-group -->
            </div>
 
		  	 <div class="row">
 
              <div class="col-md-3">
                <div class="form-group">
                  <label>วันเดือนปีสำรวจ :</label>
                  <div class="input-group date datepickers" id="survseydate" data-target-input="nearest"> 
	               <input id="assessment_date" name="assessment_date" type="text"  data-target="#survseydate" data-toggle="datetimepicker" 
                 class="form-control  col-md-8 datetimepicker-input assessment-date-keypress" data-target="#survseydate" autocomplete="off" required>
                  <div class="input-group-append" data-target="#survseydate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                 </div>
                </div> 

                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
		    	</div>

          </div>
          <!-- /.card-header -->

          <!-- /.card-body -->
          <div class="card-footer"> 
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            <button type="reset" class="btn btn-warning">รีเซ็ท</button>
          </div>
        </div>
        <!-- /.card -->

       </div><!-- /.container-fluid -->
      </form>
    </section>
    <!-- /.content -->  
<!-- <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui-1.8.10.offset.datepicker.min.js"></script> --> 
<script src="assets/js/family.js"></script>
<div style="display: none;" id="xhtml"></div>
<?php
require_once 'components/footer.php';
?>