<?php
$webtitle='เพิ่มข้อมูลครัวเรือน';
require 'bootstart.php';
require ROOT . '/core/security.php';
require_once 'components/header.php';

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
    ->orderBy('fac_desc', 'asc')
    ->get()->toArray();

$listmas_educate= $db::table("tbl_mas_educate")
    ->select($db::raw("ed_code,ed_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('ed_desc', 'asc')
    ->get()->toArray();

$listmas_disaster= $db::table("tbl_mas_disaster")
    ->select($db::raw("dis_code,dis_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('dis_desc', 'asc')
    ->get()->toArray();

$listmas_addition= $db::table("tbl_mas_addition")
    ->select($db::raw("add_code,add_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('add_desc', 'asc')
    ->get()->toArray();

$listdepartments = $db::table("tbl_departments")
    ->select($db::raw("dept_code,dept_name"))
    ->where('f_status', '=', 'A')
    ->orderBy('dept_desc', 'asc')
    ->get()->toArray();
 
?>
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
      <section class="content" id="app" v-cloak 
      data-familylists='[{ "prefix":"01","txtFName": "","txtLName":"","txtCitizenId":"" ,"xFstatusRd":1,"sexRd":1,"txtNational":"","religion":"","birthday":""
       ,"educationlevel":"","homerelations":"","careergroup":"","careeranother":"","careermain":"","careersecond":"","netIncome":""}]'
       data-famerdetaillists='{}'
       data-listmas_occupation='<?=json_encode($listmas_occupation)?>' data-listmas_prefix='<?=json_encode($listmas_prefix)?>'
       data-listmas_religion='<?=json_encode($listmas_religion)?>' data-listmas_pet='<?=json_encode($listmas_pet)?>'
       data-listmas_info='<?=json_encode($listmas_info)?>' data-listmas_house_occup='<?=json_encode($listmas_house_occup)?>'
       data-listmas_group_occup='<?=json_encode($listmas_group_occup)?>' data-listmas_facilities='<?=json_encode($listmas_facilities)?>'
       data-listmas_educate='<?=json_encode($listmas_educate)?>' data-listmas_disaster='<?=json_encode($listmas_disaster)?>'
       data-listmas_addition='<?=json_encode($listmas_addition)?>' data-listdepartments='<?=json_encode($listdepartments)?>'
       data-listmas_relations='<?=json_encode($listmas_relations)?>'  data-listmas_vilage='<?=json_encode($listmas_vilage)?>'
       > 
      <form @submit.prevent="submit" id="frm_family">   
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
                  <input type="text" :class="status($v.houseinfor.txtHouseId)" v-model.trim="$v.houseinfor.txtHouseId.$model" name="txtHouseId" id="txtHouseId" class="form-control" placeholder="บ้านเลขที่  ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>หมู่ที่ - ชื่อหมู่บ้าน :</label>
					<select class="form-control"  :class="status($v.houseinfor.mooHouse)" v-model.trim="$v.houseinfor.mooHouse.$model" > 
                        <option v-for="(v, indexx) in listmas_vilage" v-bind:value="v.vil_id" v-bind:selected="indexx== 0 ? 'selected' : false">หมู่ที่ {{v.vil_moo}} - {{v.vil_name}}</option> 
					  </select> 
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label>ตำบล :</label>
                     <input type="text" :class="status($v.houseinfor.txtSubDstrict)" v-model.trim="$v.houseinfor.txtSubDstrict.$model"  name="txtSubDstrict" value="โคกขมิ้น" id="txtSubDstrict" class="form-control" placeholder="ตำบล  ...">
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
                   <input type="text" :class="status($v.houseinfor.txtDistrict)" v-model.trim="$v.houseinfor.txtDistrict.$model"  name="txtDistrict" value="พลับพลาชัย  " id="txtDistrict" class="form-control" placeholder="อำเภอ  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <div class="form-group">
                   <label>จังหวัด:</label>
                   <input type="text" :class="status($v.houseinfor.txtProvince)" v-model.trim="$v.houseinfor.txtProvince.$model"  name="txtProvince" value="บุรีรัมย์ " id="txtProvince" class="form-control" placeholder="จังหวัด  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
                <div class="col-md-4">
                      <div class="form-group">
                          <label>รหัสไปรษณีย์:</label>
                          <input type="text" :class="status($v.houseinfor.txtPostalCode)" v-model.trim="$v.houseinfor.txtPostalCode.$model"  name="txtPostalCode" value="31250" id="txtPostalCode" class="form-control" placeholder="รหัสไปรษณีย์  ...">
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
         <template v-for="(item, index) in $v.familylists.$each.$iter"> 
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
                  <div class="input-group date" id="birthday" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#birthday" :class="status(item.birthday)" v-model.trim="item.birthday.$model" @blur="item.birthday.$touch()" name="birthday" id="birthday" />
                      <div class="input-group-append" data-target="#birthday" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
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
							  <option v-for="(v, indexx) in listmas_occupation" :value="v.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.occup_name}}</option> 
							</select>
					 </div>
					   <!-- /.form-group -->
				</div>
				 <div class="col-md-3">
					<div class="form-group">
							<label>อาชีพรอง :</label>
							 <select class="form-control" name="careersecond" id="careersecond" :class="status(item.careersecond)" v-model.trim="item.careersecond.$model" @blur="item.careersecond.$touch()">
                             <option v-for="(v, indexx) in listmas_occupation" :value="v.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.occup_name}}</option> 
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
              <hr v-if="showhr(familylists,index)">
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
                                <th style="width: 5px">#</th>
								<th style="width: 20px">จังหวัด</th>
								<th style="width: 20px">อำเภอ</th>
                                <th style="width: 20px">เลขที่โฉนด</th>
                                <th style="width: 10px">พื้นที่(ไร่)</th>
                                <th style="width: 10px">พื้นที่(งาน)</th>
                                <th style="width: 10px">พื้นที่(ตรว.)</th>
                                <th style="width: 10px">#</th>
                              </tr>
                            </thead>
                              <tbody>
                             <tr class="table-warning" v-if="famerdetaillists.deeds.length<=0"><td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                             <template v-for="(item, index) in $v.famerdetaillists.deeds.$each.$iter">
                              <tr >
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control btn-xs" name="province[]"  :class="status(item.province)" v-model.trim="item.province.$model" @blur="item.province.$touch()">
									<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
									<option value="81">กระบี่</option>
									<option value="10">กรุงเทพมหานคร</option>
									<option value="71">กาญจนบุรี</option>
									<option value="46">กาฬสินธุ์</option>
									<option value="62">กำแพงเพชร</option>
									<option value="40">ขอนแก่น</option>
									<option value="22">จันทบุรี</option>
									<option value="24">ฉะเชิงเทรา</option>
									<option value="20">ชลบุรี</option>
									<option value="18">ชัยนาท</option>
									<option value="36">ชัยภูมิ</option>
									<option value="86">ชุมพร</option>
									<option value="57">เชียงราย</option>
									<option value="50">เชียงใหม่</option>
									<option value="92">ตรัง</option>
									<option value="23">ตราด</option>
									<option value="63">ตาก</option>
									<option value="26">นครนายก</option>
									<option value="73">นครปฐม</option>
									<option value="48">นครพนม</option>
									<option value="30">นครราชสีมา</option>
									<option value="80">นครศรีธรรมราช</option>
									<option value="60">นครสวรรค์</option>
									<option value="12">นนทบุรี</option>
									<option value="96">นราธิวาส</option>
									<option value="55">น่าน</option>
									<option value="38">บึงกาฬ</option>
									<option value="31" selected="selected">บุรีรัมย์</option>
									<option value="13">ปทุมธานี</option>
									<option value="77">ประจวบคีรีขันธ์</option>
									<option value="25">ปราจีนบุรี</option>
									<option value="94">ปัตตานี</option>
									<option value="14">พระนครศรีอยุธยา</option>
									<option value="56">พะเยา</option>
									<option value="82">พังงา</option>
									<option value="93">พัทลุง</option>
									<option value="66">พิจิตร</option>
									<option value="65">พิษณุโลก</option>
									<option value="76">เพชรบุรี</option>
									<option value="67">เพชรบูรณ์</option>
									<option value="54">แพร่</option>
									<option value="83">ภูเก็ต</option>
									<option value="44">มหาสารคาม</option>
									<option value="49">มุกดาหาร</option>
									<option value="58">แม่ฮ่องสอน</option>
									<option value="35">ยโสธร</option>
									<option value="95">ยะลา</option>
									<option value="45">ร้อยเอ็ด</option>
									<option value="85">ระนอง</option>
									<option value="21">ระยอง</option>
									<option value="70">ราชบุรี</option>
									<option value="16">ลพบุรี</option>
									<option value="52">ลำปาง</option>
									<option value="51">ลำพูน</option>
									<option value="42">เลย</option>
									<option value="33">ศรีสะเกษ</option>
									<option value="47">สกลนคร</option>
									<option value="90">สงขลา</option>
									<option value="91">สตูล</option>
									<option value="11">สมุทรปราการ</option>
									<option value="75">สมุทรสงคราม</option>
									<option value="74">สมุทรสาคร</option>
									<option value="27">สระแก้ว</option>
									<option value="19">สระบุรี</option>
									<option value="17">สิงห์บุรี</option>
									<option value="64">สุโขทัย</option>
									<option value="72">สุพรรณบุรี</option>
									<option value="84">สุราษฎร์ธานี</option>
									<option value="32">สุรินทร์</option>
									<option value="43">หนองคาย</option>
									<option value="39">หนองบัวลำภู</option>
									<option value="15">อ่างทอง</option>
									<option value="37">อำนาจเจริญ</option>
									<option value="41">อุดรธานี</option>
									<option value="53">อุตรดิตถ์</option>
									<option value="61">อุทัยธานี</option>
									<option value="34">อุบลราชธานี</option>
									</select>
								   </div>								
								</td>
								<td>
								<div class="form-group btn-xs">
								 <select class="form-control btn-xs" name="district[]" :class="status(item.district)" v-model.trim="item.district.$model" @blur="item.district.$touch()">
								 <option>พลับพลาชัย </option>
								 <option>เมืองบุรีรัมย์</option>
								 <option>คูเมือง</option>
								 <option>กระสัง</option>
								 <option>นางรอง</option>
								 <option>ละหานทราย</option>
								 <option>ประโคนชัย</option>
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
                                <th style="width: 5px">#</th>
								<th style="width: 20px">จังหวัด</th>
								<th style="width: 20px">อำเภอ</th>
                                <th style="width: 20px">เลขที่โฉนด</th>
                                <th style="width: 10px">พื้นที่(ไร่)</th>
                                <th style="width: 10px">พื้นที่(งาน)</th>
                                <th style="width: 10px">พื้นที่(ตรว.)</th>
                                <th style="width: 10px">#</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="table-warning" v-if="famerdetaillists.norsor3kors.length<=0"><td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                              <template v-for="(item, index) in $v.famerdetaillists.norsor3kors.$each.$iter">
                              <tr>
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
								    <select class="form-control  btn-xs" name="province[]" :class="status(item.province)" v-model.trim="item.province.$model" @blur="item.province.$touch()">
									<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
									<option value="81">กระบี่</option>
									<option value="10">กรุงเทพมหานคร</option>
									<option value="71">กาญจนบุรี</option>
									<option value="46">กาฬสินธุ์</option>
									<option value="62">กำแพงเพชร</option>
									<option value="40">ขอนแก่น</option>
									<option value="22">จันทบุรี</option>
									<option value="24">ฉะเชิงเทรา</option>
									<option value="20">ชลบุรี</option>
									<option value="18">ชัยนาท</option>
									<option value="36">ชัยภูมิ</option>
									<option value="86">ชุมพร</option>
									<option value="57">เชียงราย</option>
									<option value="50">เชียงใหม่</option>
									<option value="92">ตรัง</option>
									<option value="23">ตราด</option>
									<option value="63">ตาก</option>
									<option value="26">นครนายก</option>
									<option value="73">นครปฐม</option>
									<option value="48">นครพนม</option>
									<option value="30">นครราชสีมา</option>
									<option value="80">นครศรีธรรมราช</option>
									<option value="60">นครสวรรค์</option>
									<option value="12">นนทบุรี</option>
									<option value="96">นราธิวาส</option>
									<option value="55">น่าน</option>
									<option value="38">บึงกาฬ</option>
									<option value="31" selected="selected">บุรีรัมย์</option>
									<option value="13">ปทุมธานี</option>
									<option value="77">ประจวบคีรีขันธ์</option>
									<option value="25">ปราจีนบุรี</option>
									<option value="94">ปัตตานี</option>
									<option value="14">พระนครศรีอยุธยา</option>
									<option value="56">พะเยา</option>
									<option value="82">พังงา</option>
									<option value="93">พัทลุง</option>
									<option value="66">พิจิตร</option>
									<option value="65">พิษณุโลก</option>
									<option value="76">เพชรบุรี</option>
									<option value="67">เพชรบูรณ์</option>
									<option value="54">แพร่</option>
									<option value="83">ภูเก็ต</option>
									<option value="44">มหาสารคาม</option>
									<option value="49">มุกดาหาร</option>
									<option value="58">แม่ฮ่องสอน</option>
									<option value="35">ยโสธร</option>
									<option value="95">ยะลา</option>
									<option value="45">ร้อยเอ็ด</option>
									<option value="85">ระนอง</option>
									<option value="21">ระยอง</option>
									<option value="70">ราชบุรี</option>
									<option value="16">ลพบุรี</option>
									<option value="52">ลำปาง</option>
									<option value="51">ลำพูน</option>
									<option value="42">เลย</option>
									<option value="33">ศรีสะเกษ</option>
									<option value="47">สกลนคร</option>
									<option value="90">สงขลา</option>
									<option value="91">สตูล</option>
									<option value="11">สมุทรปราการ</option>
									<option value="75">สมุทรสงคราม</option>
									<option value="74">สมุทรสาคร</option>
									<option value="27">สระแก้ว</option>
									<option value="19">สระบุรี</option>
									<option value="17">สิงห์บุรี</option>
									<option value="64">สุโขทัย</option>
									<option value="72">สุพรรณบุรี</option>
									<option value="84">สุราษฎร์ธานี</option>
									<option value="32">สุรินทร์</option>
									<option value="43">หนองคาย</option>
									<option value="39">หนองบัวลำภู</option>
									<option value="15">อ่างทอง</option>
									<option value="37">อำนาจเจริญ</option>
									<option value="41">อุดรธานี</option>
									<option value="53">อุตรดิตถ์</option>
									<option value="61">อุทัยธานี</option>
									<option value="34">อุบลราชธานี</option>
									</select>
								   </div>								
								</td>
								<td>
								<div class="form-group btn-xs">
								 <select class="form-control btn-xs" name="district[]"  :class="status(item.district)" v-model.trim="item.district.$model" @blur="item.district.$touch()">
								 <option>พลับพลาชัย </option>
								 <option>เมืองบุรีรัมย์</option>
								 <option>คูเมือง</option>
								 <option>กระสัง</option>
								 <option>นางรอง</option>
								 <option>ละหานทราย</option>
								 <option>ประโคนชัย</option>
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
                                <th style="width: 5px">#</th>
								<th style="width: 20px">จังหวัด</th>
								<th style="width: 20px">อำเภอ</th>
                                <th style="width: 20px">เลขที่โฉนด</th>
                                <th style="width: 10px">พื้นที่(ไร่)</th>
                                <th style="width: 10px">พื้นที่(งาน)</th>
                                <th style="width: 10px">พื้นที่(ตรว.)</th>
                                <th style="width: 10px">#</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr class="table-warning" v-if="famerdetaillists.spoks.length<=0"><td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                             <template v-for="(item, index) in $v.famerdetaillists.spoks.$each.$iter">
                              <tr>
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control  btn-xs" name="province[]" :class="status(item.province)" v-model.trim="item.province.$model" @blur="item.province.$touch()">
									<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
									<option value="81">กระบี่</option>
									<option value="10">กรุงเทพมหานคร</option>
									<option value="71">กาญจนบุรี</option>
									<option value="46">กาฬสินธุ์</option>
									<option value="62">กำแพงเพชร</option>
									<option value="40">ขอนแก่น</option>
									<option value="22">จันทบุรี</option>
									<option value="24">ฉะเชิงเทรา</option>
									<option value="20">ชลบุรี</option>
									<option value="18">ชัยนาท</option>
									<option value="36">ชัยภูมิ</option>
									<option value="86">ชุมพร</option>
									<option value="57">เชียงราย</option>
									<option value="50">เชียงใหม่</option>
									<option value="92">ตรัง</option>
									<option value="23">ตราด</option>
									<option value="63">ตาก</option>
									<option value="26">นครนายก</option>
									<option value="73">นครปฐม</option>
									<option value="48">นครพนม</option>
									<option value="30">นครราชสีมา</option>
									<option value="80">นครศรีธรรมราช</option>
									<option value="60">นครสวรรค์</option>
									<option value="12">นนทบุรี</option>
									<option value="96">นราธิวาส</option>
									<option value="55">น่าน</option>
									<option value="38">บึงกาฬ</option>
									<option value="31" selected="selected">บุรีรัมย์</option>
									<option value="13">ปทุมธานี</option>
									<option value="77">ประจวบคีรีขันธ์</option>
									<option value="25">ปราจีนบุรี</option>
									<option value="94">ปัตตานี</option>
									<option value="14">พระนครศรีอยุธยา</option>
									<option value="56">พะเยา</option>
									<option value="82">พังงา</option>
									<option value="93">พัทลุง</option>
									<option value="66">พิจิตร</option>
									<option value="65">พิษณุโลก</option>
									<option value="76">เพชรบุรี</option>
									<option value="67">เพชรบูรณ์</option>
									<option value="54">แพร่</option>
									<option value="83">ภูเก็ต</option>
									<option value="44">มหาสารคาม</option>
									<option value="49">มุกดาหาร</option>
									<option value="58">แม่ฮ่องสอน</option>
									<option value="35">ยโสธร</option>
									<option value="95">ยะลา</option>
									<option value="45">ร้อยเอ็ด</option>
									<option value="85">ระนอง</option>
									<option value="21">ระยอง</option>
									<option value="70">ราชบุรี</option>
									<option value="16">ลพบุรี</option>
									<option value="52">ลำปาง</option>
									<option value="51">ลำพูน</option>
									<option value="42">เลย</option>
									<option value="33">ศรีสะเกษ</option>
									<option value="47">สกลนคร</option>
									<option value="90">สงขลา</option>
									<option value="91">สตูล</option>
									<option value="11">สมุทรปราการ</option>
									<option value="75">สมุทรสงคราม</option>
									<option value="74">สมุทรสาคร</option>
									<option value="27">สระแก้ว</option>
									<option value="19">สระบุรี</option>
									<option value="17">สิงห์บุรี</option>
									<option value="64">สุโขทัย</option>
									<option value="72">สุพรรณบุรี</option>
									<option value="84">สุราษฎร์ธานี</option>
									<option value="32">สุรินทร์</option>
									<option value="43">หนองคาย</option>
									<option value="39">หนองบัวลำภู</option>
									<option value="15">อ่างทอง</option>
									<option value="37">อำนาจเจริญ</option>
									<option value="41">อุดรธานี</option>
									<option value="53">อุตรดิตถ์</option>
									<option value="61">อุทัยธานี</option>
									<option value="34">อุบลราชธานี</option>
									</select>
								   </div>								
								</td>
								<td>
								<div class="form-group btn-xs">
								 <select class="form-control btn-xs" name="district[]" :class="status(item.district)" v-model.trim="item.district.$model" @blur="item.district.$touch()">
								 <option>พลับพลาชัย </option>
								 <option>เมืองบุรีรัมย์</option>
								 <option>คูเมือง</option>
								 <option>กระสัง</option>
								 <option>นางรอง</option>
								 <option>ละหานทราย</option>
								 <option>ประโคนชัย</option>
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
                                <th style="width: 5px">#</th>
								<th style="width: 20px">จังหวัด</th>
								<th style="width: 20px">อำเภอ</th>
                                <th style="width: 20px">เลขที่โฉนด</th>
                                <th style="width: 10px">พื้นที่(ไร่)</th>
                                <th style="width: 10px">พื้นที่(งาน)</th>
                                <th style="width: 10px">พื้นที่(ตรว.)</th>
                                <th style="width: 10px">#</th>
                              </tr>
                            </thead>
                            <tbody>
                             <tr class="table-warning" v-if="famerdetaillists.chapter5s.length<=0"><td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
                             <template v-for="(item, index) in $v.famerdetaillists.chapter5s.$each.$iter">
                              <tr >
                                <td>{{(index*1)+1}}.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control btn-xs" name="province[]"  :class="status(item.province)" v-model.trim="item.province.$model" @blur="item.province.$touch()">
									<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
									<option value="81">กระบี่</option>
									<option value="10">กรุงเทพมหานคร</option>
									<option value="71">กาญจนบุรี</option>
									<option value="46">กาฬสินธุ์</option>
									<option value="62">กำแพงเพชร</option>
									<option value="40">ขอนแก่น</option>
									<option value="22">จันทบุรี</option>
									<option value="24">ฉะเชิงเทรา</option>
									<option value="20">ชลบุรี</option>
									<option value="18">ชัยนาท</option>
									<option value="36">ชัยภูมิ</option>
									<option value="86">ชุมพร</option>
									<option value="57">เชียงราย</option>
									<option value="50">เชียงใหม่</option>
									<option value="92">ตรัง</option>
									<option value="23">ตราด</option>
									<option value="63">ตาก</option>
									<option value="26">นครนายก</option>
									<option value="73">นครปฐม</option>
									<option value="48">นครพนม</option>
									<option value="30">นครราชสีมา</option>
									<option value="80">นครศรีธรรมราช</option>
									<option value="60">นครสวรรค์</option>
									<option value="12">นนทบุรี</option>
									<option value="96">นราธิวาส</option>
									<option value="55">น่าน</option>
									<option value="38">บึงกาฬ</option>
									<option value="31" selected="selected">บุรีรัมย์</option>
									<option value="13">ปทุมธานี</option>
									<option value="77">ประจวบคีรีขันธ์</option>
									<option value="25">ปราจีนบุรี</option>
									<option value="94">ปัตตานี</option>
									<option value="14">พระนครศรีอยุธยา</option>
									<option value="56">พะเยา</option>
									<option value="82">พังงา</option>
									<option value="93">พัทลุง</option>
									<option value="66">พิจิตร</option>
									<option value="65">พิษณุโลก</option>
									<option value="76">เพชรบุรี</option>
									<option value="67">เพชรบูรณ์</option>
									<option value="54">แพร่</option>
									<option value="83">ภูเก็ต</option>
									<option value="44">มหาสารคาม</option>
									<option value="49">มุกดาหาร</option>
									<option value="58">แม่ฮ่องสอน</option>
									<option value="35">ยโสธร</option>
									<option value="95">ยะลา</option>
									<option value="45">ร้อยเอ็ด</option>
									<option value="85">ระนอง</option>
									<option value="21">ระยอง</option>
									<option value="70">ราชบุรี</option>
									<option value="16">ลพบุรี</option>
									<option value="52">ลำปาง</option>
									<option value="51">ลำพูน</option>
									<option value="42">เลย</option>
									<option value="33">ศรีสะเกษ</option>
									<option value="47">สกลนคร</option>
									<option value="90">สงขลา</option>
									<option value="91">สตูล</option>
									<option value="11">สมุทรปราการ</option>
									<option value="75">สมุทรสงคราม</option>
									<option value="74">สมุทรสาคร</option>
									<option value="27">สระแก้ว</option>
									<option value="19">สระบุรี</option>
									<option value="17">สิงห์บุรี</option>
									<option value="64">สุโขทัย</option>
									<option value="72">สุพรรณบุรี</option>
									<option value="84">สุราษฎร์ธานี</option>
									<option value="32">สุรินทร์</option>
									<option value="43">หนองคาย</option>
									<option value="39">หนองบัวลำภู</option>
									<option value="15">อ่างทอง</option>
									<option value="37">อำนาจเจริญ</option>
									<option value="41">อุดรธานี</option>
									<option value="53">อุตรดิตถ์</option>
									<option value="61">อุทัยธานี</option>
									<option value="34">อุบลราชธานี</option>
									</select>
								   </div>								
								</td>
								<td>
								<div class="form-group btn-xs">
								 <select class="form-control btn-xs" name="district[]" :class="status(item.district)" v-model.trim="item.district.$model" @blur="item.district.$touch()">
								 <option>พลับพลาชัย </option>
								 <option>เมืองบุรีรัมย์</option>
								 <option>คูเมือง</option>
								 <option>กระสัง</option>
								 <option>นางรอง</option>
								 <option>ละหานทราย</option>
								 <option>ประโคนชัย</option>
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
                  <textarea class="form-control" name="another" v-model.trim="famerdetaillists.another" rows="2" placeholder="อื่นๆ ..."></textarea>
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
                  <select class="form-control" name="familyhomecareer" id="familyhomecareer" :class="status($v.houseinforgeneral.familyhomecareer)" v-model.trim="$v.houseinforgeneral.familyhomecareer.$model" @blur="$v.houseinforgeneral.familyhomecareer.$touch()">
					  <option v-for="(v, indexx) in listmas_occupation" :value="v.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.occup_name}}</option> 
				 </select>
                  <!-- <select class="form-control">
                    <option>ทำนา</option>
                    <option>ทำสวน</option>
                    <option>ประมง</option>
                    <option>ทำไร่</option>
                    <option>เลี้ยงสัตว์</option>
                    <option>อุตสหกรรมครัวเรือน</option>
                    <option>รับจ้างทั่วไป</option> 
                  </select> -->
                </div> 
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>เป้าหมายการผลิต :</label>
                  <select class="form-control"  class="form-control" name="familyhomeproducttarget" id="familyhomeproducttarget" :class="status($v.houseinforgeneral.familyhomeproducttarget)" v-model.trim="$v.houseinforgeneral.familyhomeproducttarget.$model" @blur="$v.houseinforgeneral.familyhomeproducttarget.$touch()" >
                    <option>ผลิตเพื่อบริโภค</option>
                    <option>ผลิตเพื่อจำหน่าย</option>
                    <option>ผลิตเพื่อบริโภคและจำหน่าย</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>แหล่งเงินทุน (ครัวเรือน) :</label>
                  <select class="form-control"  class="form-control" name="familyhomesourceoffunds" id="familyhomesourceoffunds" :class="status($v.houseinforgeneral.familyhomesourceoffunds)" v-model.trim="$v.houseinforgeneral.familyhomesourceoffunds.$model" @blur="$v.houseinforgeneral.familyhomesourceoffunds.$touch()">
                    <option>เงินทุนส่วนตัว</option>
                    <option>กู้มาลงทุน</option>
                    <option>กู้บ้างสวน</option>
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
                                <input type="text" class="form-control float-right" class="form-control" name="familyhomeproductperiod" id="familyhomeproductperiod" :class="status($v.houseinforgeneral.familyhomeproductperiod)" v-model.trim="$v.houseinforgeneral.familyhomeproductperiod.$model" @blur="$v.houseinforgeneral.familyhomeproductperiod.$touch()">
                              </div>
                              <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>ต้นทุนการผลิต :</label>
                  <textarea class="form-control"  class="form-control" name="familyhomeproductioncost" id="familyhomeproductioncost" :class="status($v.houseinforgeneral.familyhomeproductioncost)" v-model.trim="$v.houseinforgeneral.familyhomeproductioncost.$model" @blur="$v.houseinforgeneral.familyhomeproductioncost.$touch()" rows="1" placeholder="ต้นทุนการผลิต  ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>

            </div>
            <!-- /row -->

            <label>เครื่องมืออำนวยความสะดวกทางการเกษตร</label>
            <div class="row">
              <div class="col-md-3">
                <div class="form-check">
				  <label class="form-check-label">
                  <input class="form-check-input" type="checkbox">
					รถไถ แทรกเตอร์ </label>
                </div>
                <div class="form-group">
                    <input type="number" id="familyhometractor" v-model.trim="houseinforgeneral.familyhometractor" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
                </div>
                </div>
                <!-- /.form-group -->

                <div class="col-md-3">
                  <div class="form-check">
				   <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
					รถไถเดินตาม</label>
                  </div>
                  <div class="form-group">
                      <input type="number" id="familyhomewalkingtractor" v-model.trim="houseinforgeneral.familyhomewalkingtractor" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
                  </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-md-3">
                    <div class="form-check">
					  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">
					รถตุ๊กตุ๊ก</label>
                    </div>
                    <div class="form-group">
                        <input type="number" id="familyhomcartuktuk"  v-model.trim="houseinforgeneral.familyhomcartuktuk"  placeholder="จำนวน...คัน" class="form-control" value="" step="1">
                    </div>
                    </div>
                 <!-- /.form-group -->
                 <div class="col-md-3">
                  <div class="form-check">
					<label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
					รถเกี่ยว</label>
                  </div>
                  <div class="form-group">
                      <input type="number" id="familyhomcarharvester"  v-model.trim="houseinforgeneral.familyhomcarharvester"   placeholder="จำนวน...คัน" class="form-control" value="" step="1">
                  </div>
                  </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-check">
					<label class="form-check-label">
                   <input class="form-check-input" type="checkbox">
					รถอัดฟาง</label>
                </div>
                <div class="form-group">
                    <input type="number"   id="familyhomcarbalers"  v-model.trim="houseinforgeneral.familyhomcarbalers"  class="form-control" placeholder="จำนวน...คัน" value="" step="1">
                </div>
                </div>
                <!-- /.form-group -->

                <!-- /.form-group -->
                <div class="col-md-4">
                  <div class="form-check">
					<label class="form-check-label">
                    <input class="form-check-input" type="checkbox">อื่นๆ</label>
                  </div>
                  <div class="form-group">
                      <textarea class="form-control" name="familyhomother" id="familyhomother"  v-model.trim="houseinforgeneral.familyhomother" rows="1" placeholder="อื่นๆ  ..."></textarea>
                  </div>
                  </div>
                  <!-- /.form-group -->

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

							  <tr >
							    <td>1.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label ">
								   <input class="form-check-input " type="checkbox"> โค</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familycow" id="familycownum" class="form-control btn-xs" placeholder="จำนวนโค...ตัว">					
                                  </div>
                                </td>
								<td>
                                  <div class="form-group">
                                   <input type="number" name="familycowgetvaccine" id="familycowgetvaccine" class="form-control btn-xs" placeholder="จำนวนโค(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familycowdesc" id="familycowdesc" rows="2" placeholder="รายละเอียดโค ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
							<tr >
							    <td>2.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox"> กระบือ</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familybuffalonum" id="familybuffalonum" class="form-control btn-xs" placeholder="จำนวนโกระบือ...ตัว">					
                                  </div>
                                </td>
								 <td>
                                  <div class="form-group">
                                   <input type="number" name="familybuffalogetvaccine" id="familybuffalogetvaccine" class="form-control btn-xs" placeholder="จำนวนโกระบือ(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familybuffalodesc" id="familybuffalodesc" rows="2" placeholder="รายละเอียดกระบือ ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>3.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox">สุกร</label>
								</div>
                                </td>
								<td>
                                  <div class="form-group">
                                   <input type="number" name="familypigsnum" id="familypigsnum" class="form-control btn-xs" placeholder="จำนวนสุกร...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familypigsgetvaccine" id="familypigsgetvaccine" class="form-control btn-xs" placeholder="จำนวนสุกร(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familypigsdisc" id="familypigsdisc rows="2" placeholder="รายละเอียดสุกร ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>							  
								<tr >
							    <td>4.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox"> สุนัข </label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familydognum" id="familydognum" class="form-control btn-xs" placeholder="จำนวนสุนัข...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familydoggetvaccine" id="familydoggetvaccine" class="form-control btn-xs" placeholder="จำนวนสุนัข(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familydogdisc" id="familydogdisc" rows="2" placeholder="รายละเอียดสุนัข ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>5.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox"> แมว</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familycatnum" id="familycatnum" class="form-control btn-xs" placeholder="จำนวนแมว...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familycatgetvaccine" id="familycatgetvaccine" class="form-control btn-xs" placeholder="จำนวนแมว (รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familycatdisc" id="familycatdisc" rows="2" placeholder="รายละเอียดแมว ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>6.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox"> หนูนา</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familyratnum" id="familyratnum" class="form-control btn-xs" placeholder="จำนวนหนูนา...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familyratgetvaccine" id="familyratgetvaccine" class="form-control btn-xs" placeholder="จำนวนหนูนา(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familyratdisc" id="familyratdisc" rows="2" placeholder="รายละเอียดหนูนา ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>7.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox"> ไก่บ้าน</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familychickennum" id="familychickennum" class="form-control btn-xs" placeholder="จำนวนไก่บ้าน...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familychickengetvaccine" id="familychickengetvaccine" class="form-control btn-xs" placeholder="จำนวนไก่บ้าน(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familychickendisc" id="familychickendisc" rows="2" placeholder="รายละเอียดไก่บ้าน ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>8.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox">ไก่ชน</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familychickenfightnum" id="familychickenfightnum" class="form-control btn-xs" placeholder="จำนวนไก่ชน...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familychickenfightgetvaccine" id="familychickenfightgetvaccine" class="form-control btn-xs" placeholder="จำนวนไก่ชน(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familychickenfightdisc" id="familychickenfightdisc" rows="2" placeholder="รายละเอียดไก่ชน ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>9.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox"> กบ</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familyfrognum" id="familyfrognum" class="form-control btn-xs" placeholder="จำนวนกบ...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familyfroggetvaccine" id="familyfroggetvaccine" class="form-control btn-xs" placeholder="จำนวนกบ(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familyfrogdisc" id="familyfrogdisc" rows="2" placeholder="รายละเอียดกบ ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>10.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox"> ปลา</label>
								</div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familyfishnum" id="familyfishnum" class="form-control btn-xs" placeholder="จำนวนปลา...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="familyfishgetvaccine" id="familyfishgetvaccine" class="form-control btn-xs" placeholder="จำนวนปลา (รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familyfishdisc" id="familyfishdisc" rows="2" placeholder="รายละเอียดปลา  ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>
								<tr >
							    <td>11.</td>
                                <td>
								<div class="form-check">
								   <label class="form-check-label">
								   <input class="form-check-input" type="checkbox">อื่นๆ </label>
								</div>
                                </td>
                                <td colspan='2'>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="familyother" id="familyother" rows="2" placeholder="รายละเอียดอื่นๆ ..."></textarea>
                                  </div>
                                </td>                              
                              </tr>

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
                      <input type="radio" id="radioPrimary8" name="xEnvironmental" >
                      <label for="radioPrimary8">ไม่มี
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary9" name="xEnvironmental" checked>
                      <label for="radioPrimary9">มี (ระบุ)					  
                      </label>
                        <textarea class="form-control" name="xEnvironmentaldisc" id="xEnvironmentaldisc" rows="1" placeholder="มี (ระบุ)..."></textarea>
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
                        <input type="radio" id="radioPrimary10" name="xEnvironmental2" >
                        <label for="radioPrimary10">ไม่มี
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary11" name="xEnvironmental2" checked>
                        <label for="radioPrimary11">มี(ระบุ)
                        </label>
						 <textarea class="form-control" name="xEnvironmental2disc" id="xEnvironmental2disc" rows="1" placeholder="มี (ระบุ)..."></textarea>
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-check-label">การอนุรักษ์สิ่งแวดล้อม</label>
                        <textarea class="form-control" name="greenxEnvironmentaldisc" id="greenxEnvironmentaldisc" rows="2" placeholder="การอนุรักษ์สิ่งแวดล้อม  ..."></textarea>
                      </div>
                    </div>
                    <!-- /.form-group -->

            </div>
			
  
            <div class="row">

              <div class="col-md-3">
			  	<label>ภัยธรรมชาติ</label>
                <div class="form-check">
				  <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="drought" >
					ภัยแล้ง </label>
                </div>
                  <div class="form-check">
				   <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="flood" >
					น้ำท่วม</label>
                  </div>
                    <div class="form-check">
					  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="windstorm" >
					วาตภัย</label>
                    </div>	
					<div class="form-check">
					  <label class="form-check-label">
					  <input class="form-check-input" type="checkbox" name="fire" >
						อัคคีภัย </label>
					</div>					
                </div>
				
                <!-- /.form-group -->
			   <div class="col-md-3">
			   <label>&nbsp;</label>

                  <div class="form-check">
				   <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="plague" >
					โรคระบาด</label>
                  </div>
				<div class="form-check">
					<label class="form-check-label">
                   <input class="form-check-input" type="checkbox" name="othernaturaldisasters" >
					อื่นๆ</label>
                </div>
                <div class="form-group">
                     <textarea class="form-control" name="otherdisastersdisc" id="otherdisastersdisc" rows="1" placeholder="อื่นๆ  ..."></textarea>
                </div>
                </div>
                <!-- /.form-group -->
  
                <!-- /.form-group -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label >เคยได้รับความช่วยเหลือ :</label> 
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary12" name="helpme" >
                        <label for="radioPrimary12">ไม่เคย
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary13" name="helpme" checked>
                        <label for="radioPrimary13">เคย(ระบุความช่วยเหลือจากหน่วยงานไหน)
                        </label>
						 <textarea class="form-control" name="helpmedisc" id="helpmedisc" rows="2" placeholder="เคย (ความช่วยเหลือจากหน่วยงานไหน)..."></textarea>
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- /.form-group -->				  
            </div>

            <label>ข่าวสารทางด้านการเกษตร</label>
            <div class="row">
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="mouthtomouth" >
                  <label class="form-check-label">ปากต่อปาก</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="usingmobilephone" >
                    <label class="form-check-label">การใช้โทรศัพท์มือถือ</label>
                 </div>				
                 <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="computers" >
                      <label class="form-check-label">การใช้คอมพิวเตอร์และอินเทอร์เน็ต</label>
                 </div>	
				 
                </div>
                <!-- /.form-group -->

                <div class="col-md-3">
				
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="mailing" >
                    <label class="form-check-label">การส่งหนังสือแจ้ง/การส่งจดหมาย</label>
                  </div>
				 <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="broadcasttower" >
                  <label class="form-check-label">หอกระจายข่าว</label>
                </div>
				 <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="communityradio" >
                    <label class="form-check-label">วิทยุชุมชน</label>
                  </div>
			  
			  
                </div>
                <!-- /.form-group -->
                <div class="col-md-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="communityforum" >
                      <label class="form-check-label">เวทีประชุม/ประชาคม</label>
                    </div>					
                   <div class="form-group">
                     <label class="form-check-label">อื่นๆ</label>
                     <textarea class="form-control" name="communityforumdisc" id="communityforumdisc" rows="1" placeholder="อื่นๆ  ..."></textarea>
                   </div>	
                 </div>
                 <!-- /.form-group -->
            </div>

			 <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label>วันเดือนปีสำรวจ :</label>
                  <div class="input-group date" id="urvseydate" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="urvseydate"  data-target="#urvseydate"/>
                      <div class="input-group-append" data-target="#urvseydate" data-toggle="datetimepicker">
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
<script src="assets/js/family.js"></script>
<div style="display: none;" id="xhtml"></div>
<?php
require_once 'components/footer.php';
?>