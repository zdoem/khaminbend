<?php
$webtitle='เพิ่มข้อมูลครัวเรือน';
require 'bootstart.php';
require ROOT . '/core/security.php';
require_once 'components/header.php';

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
       data-listmas_occupation='<?=json_encode($listmas_occupation)?>' data-listmas_prefix='<?=json_encode($listmas_prefix)?>'
       data-listmas_religion='<?=json_encode($listmas_religion)?>' data-listmas_pet='<?=json_encode($listmas_pet)?>'
       data-listmas_info='<?=json_encode($listmas_info)?>' data-listmas_house_occup='<?=json_encode($listmas_house_occup)?>'
       data-listmas_group_occup='<?=json_encode($listmas_group_occup)?>' data-listmas_facilities='<?=json_encode($listmas_facilities)?>'
       data-listmas_educate='<?=json_encode($listmas_educate)?>' data-listmas_disaster='<?=json_encode($listmas_disaster)?>'
       data-listmas_addition='<?=json_encode($listmas_addition)?>' data-listdepartments='<?=json_encode($listdepartments)?>'
       data-listmas_relations='<?=json_encode($listmas_relations)?>'  data-apartments='[{ "price": "23000", "rooms": "12" }, { "price": "42000", "rooms": "32" }]'
       > 
      <form>   
          <!-- <pre>{{$data}}</pre> -->
          <pre>{{ $v }}</pre>
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
					<select class="form-control"  v-model="houseinfor.mooHouse" >
						<option>หมู่ที่ 1 - บ้านแสลงคง</option>
						<option>หมู่ที่ 2 - บ้านตาแก</option>
						<option>หมู่ที่ 3 - บ้านโคกขมิ้น</option>
						<option>หมู่ที่ 4 - บ้านเขว้า</option>
						<option>หมู่ที่ 5 - บ้านตาพระ</option>
						<option>หมู่ที่ 6 - บ้านศรีสมบูรณ์</option>
						<option>หมู่ที่ 7 - บ้านลำเดง</option>
						<option>หมู่ที่ 8 -  บ้านหนองขอน</option>
						<option>หมู่ที่ 9 - บ้านพลับ</option>
						<option>หมู่ที่ 10 - บ้านโคกบัว</option>
						<option>หมู่ที่ 11 - บ้านโคกขมิ้น</option>
						<option>หมู่ที่ 12 - บ้านโคกเพชร</option>
						<option>หมู่ที่ 13 - บ้านทะเมนชัย</option>
						<option>หมู่ที่ 14 - บ้านพงษ์ศิริ</option>
						<option>หมู่ที่ 15 - บ้านหนองอุดม</option>
					  </select>

                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label>ตำบล :</label>
                     <input type="text" v-model="houseinfor.txtSubDstrict"  name="txtSubDstrict" value="โคกขมิ้น" id="txtSubDstrict" class="form-control" placeholder="ตำบล  ...">
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
                   <input type="text"  v-model="houseinfor.txtDistrict"  name="txtDistrict" value="พลับพลาชัย  " id="txtDistrict" class="form-control" placeholder="อำเภอ  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <div class="form-group">
                   <label>จังหวัด:</label>
                   <input type="text"  v-model="houseinfor.txtProvince"  name="txtProvince" value="บุรีรัมย์ " id="txtProvince" class="form-control" placeholder="จังหวัด  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
                <div class="col-md-4">
                      <div class="form-group">
                          <label>รหัสไปรษณีย์:</label>
                          <input type="text" v-model="houseinfor.txtPostalCode"  name="txtPostalCode" value="31250" id="txtPostalCode" class="form-control" placeholder="รหัสไปรษณีย์  ...">
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
         <template v-for="(item, index) in familylists"> 
            <h5>ลำดับที่ : {{index+1}}
				<a class="btn btn-info btn-sm" href="javascript:void(0)" v-if="index==0" v-on:click="addPeople">
				  <i class="fas fa-plus-square"></i> เพิ่มสมาชิกในครัวเรือน
                </a>
                <a href="javascript:void(0)" class="btn-sm btn-danger" v-if="index>0" v-on:click="removePeople(index)"><i class="fas fa-trash"></i></a>
			</h5>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>คำนำหน้า:</label>
                  <select class="form-control" v-model="item.prefix">
                     <option v-for="(v, indexx) in listmas_prefix" v-bind:value="v.pre_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.pre_name}}</option> 
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ชื่อเจ้าบ้าน :</label>
                  <input type="text" name="txtFName" v-model.trim="item.txtFName.$model" id="txtFName" class="form-control" placeholder="ชื่อเจ้าบ้าน...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>นามสกุล:</label>
                  <input type="text" name="txtLName" v-model="item.txtLName" id="txtLName" class="form-control" placeholder="นามสกุล...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>เลขที่ประจำตัวประชาชน  :</label>
                    <input type="text" name="txtCitizenId" v-model="item.txtCitizenId" id="txtCitizenId" class="form-control" placeholder="เลขที่ประจำตัวประชาชน  ...">
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
                      <input type="radio" :id="'radioPrimary1'+index" value="1" v-model="item.xFstatusRd"> 
                      <label :for="'radioPrimary1'+index">เจ้าบ้าน 
                      </label>
                    </div>
                    <div class="icheck-primary d-inline"> 
                      <input type="radio" :id="'radioPrimary2' + index" value="2" v-model="item.xFstatusRd">
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
                      <input type="radio" :id="'radioPrimary3'+index" value="1" v-model="item.sexRd">
                      <label :for="'radioPrimary3'+index">ชาย
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary4'+index" value="2" v-model="item.sexRd">
                      <label :for="'radioPrimary4'+index">หญิง
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioPrimary5'+index"  value="3" v-model="item.sexRd">
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
                  <input type="text" name="txtNational" v-model="item.txtNational" id="txtNational" class="form-control" placeholder="สัญชาติ  ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                 <div class="form-group">
                    <label>ศาสนา :</label>
                    <select class="form-control" v-model="item.religion" name="religion" id="religion">
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
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" v-model="item.birthday" name="birthday" id="birthday" />
                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
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
                      <select class="form-control" v-model="item.educationlevel" name="educationlevel" id="educationlevel">
                        <option v-for="(v, indexx) in listmas_educate" :value="v.ed_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.ed_name}}</option> 
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                 <!-- /.col -->
                 <div class="col-md-3">
                    <div class="form-group">
                       <label>ความสัมพันธ์ในครัวเรือน  :</label>
                       <select class="form-control" v-model="item.homerelations" name="homerelations" id="homerelations">
                          <option v-for="(v, indexx) in listmas_relations" :value="v.re_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.re_name}}</option>
                       </select>
                     </div>
                     <!-- /.form-group -->
                   </div>
               <!-- /.col -->

               <div class="col-md-3" v-if="index==0">
                    <div class="form-group">
                            <label>กลุ่มอาชีพ :</label>
                             <select class="form-control"  v-model="item.careergroup" name="careergroup" id="careergroup">>
                             <option v-for="(v, indexx) in listmas_group_occup" :value="v.goccup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.goccup_name}}</option> 
                            </select>
                     </div>
                       <!-- /.form-group -->
                </div>
              <div class="col-md-3" v-if="index==0">
                <div class="form-group">
                  <label>กลุ่มอาชีพอื่นๆ  :</label>
                  <textarea class="form-control" name="careeranother" id="careeranother" rows="1" placeholder="กลุ่มอาชีพอื่นๆ ระบุ  ...">
                      {{item.careeranother}}
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
				<div class="col-md-3">
					<div class="form-group">
							<label>อาชีพหลัก :</label>
							 <select class="form-control"  v-model="item.careermain" name="careermain" id="careermain">
							  <option v-for="(v, indexx) in listmas_occupation" :value="v.occup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.occup_name}}</option> 
							</select>
					 </div>
					   <!-- /.form-group -->
				</div>
				 <div class="col-md-3">
					<div class="form-group">
							<label>อาชีพรอง :</label>
							 <select class="form-control"  v-model="item.careersecond" name="careersecond" id="careersecond">
							 <option>ไม่มี</option>
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
							 <option>อื่นๆ</option>
							</select>
					 </div>
					   <!-- /.form-group -->
				</div>
				<div class="col-md-3">
					<div class="form-group">
					  <label>รายได้/ต่อปี  :</label>								
						<input type="number" name="netIncome" v-model="item.netIncome"  id="netIncome" class="form-control btn-xs" placeholder="รายได้/ต่อปี...">
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
              <a class="d-sm-inline-block btn btn-info btn-sm" href="#"><i class="fas fa-plus-square"></i> เพิ่มโฉนด
              </a>


            <div class="row">
              <div class="col-md-12">
				<!--  table-striped  -->
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
                              <tr >
                                <td>1.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control  btn-xs">
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
								 <select class="form-control btn-xs">
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
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <td>
                                <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>
                              <tr >
                                <td>2.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control  btn-xs">
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
								 <select class="form-control btn-xs">
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
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <td>
                                <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>

                            </tbody>
                          </table>

              </div>
            </div>
            <h5 class="d-sm-inline-block">นส.3ก</h5>
            <a class="inline btn btn-info btn-sm" href="#">
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
                              <tr>
                                <td>1.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control  btn-xs">
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
								 <select class="form-control btn-xs">
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
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <td>
                                  <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>

                            </tbody>
                          </table>

              </div>
            </div>
            <h5 class="d-sm-inline-block">สปก.</h5>
            <a class="inline btn btn-info btn-sm" href="#">
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
                              <tr>
                                <td>1.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control  btn-xs">
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
								 <select class="form-control btn-xs">
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
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <td>
                                  <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>
                              <tr>
                                <td>2.</td>
								<td>
								  <div class="form-group">
									 <select class="form-control  btn-xs">
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
								 <select class="form-control btn-xs">
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
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
                                  </div>
                                </td>
                                <td>
                                  <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>

                            </tbody>
                          </table>

              </div>
            </div>
            <h5 class="d-sm-inline-block">ภบท 5</h5>
            <a class="inline btn btn-info btn-sm" href="#">
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
                              <tr >
                                <td align="center" colspan="7">*** ยังไม่มีข้อมูล ***</td>                                
                              </tr>


                            </tbody>
                          </table>

              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>อื่นๆ :</label>
                  <textarea class="form-control" name="txtOhterLandDesc" id="txtOhterLandDesc" rows="2" placeholder="อื่นๆ ..."></textarea>
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
                  <select class="form-control">
                    <option>ทำนา</option>
                    <option>ทำสวน</option>
                    <option>ประมง</option>
                    <option>ทำไร่</option>
                    <option>เลี้ยงสัตว์</option>
                    <option>อุตสหกรรมครัวเรือน</option>
                    <option>รับจ้างทั่วไป</option>
                  <!--  <option>ค้าขาย</option>
                    <option>รับราชการ</option>
                  -->
                  </select>
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>เป้าหมายการผลิต :</label>
                  <select class="form-control">
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
                  <select class="form-control">
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
                                <input type="text" class="form-control float-right" id="reservation">
                              </div>
                              <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>ต้นทุนการผลิต :</label>
                  <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="ต้นทุนการผลิต  ..."></textarea>
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
                    <input type="number" id="inputSpentBudget" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
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
                      <input type="number" id="inputSpentBudget" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
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
                        <input type="number" id="inputSpentBudget"  placeholder="จำนวน...คัน" class="form-control" value="" step="1">
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
                      <input type="number" id="inputSpentBudget"  placeholder="จำนวน...คัน" class="form-control" value="" step="1">
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
                    <input type="number" id="inputSpentBudget" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
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
                      <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="อื่นๆ  ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนโค...ตัว">					
                                  </div>
                                </td>
								<td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนโค(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดโค ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนโกระบือ...ตัว">					
                                  </div>
                                </td>
								 <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนโกระบือ(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดกระบือ ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนสุกร...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนสุกร(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดสุกร ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนสุนัข...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนสุนัข(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดสุนัข ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนแมว...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนแมว (รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดแมว ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนหนูนา...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนหนูนา(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดหนูนา ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนไก่บ้าน...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนไก่บ้าน(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดไก่บ้าน ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนไก่ชน...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนไก่ชน(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดไก่ชน ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนกบ...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนกบ(รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดกบ ..."></textarea>
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
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนปลา...ตัว">					
                                  </div>
                                </td>								
                                <td>
                                  <div class="form-group">
                                   <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวนปลา (รับวัคซีนแล้ว)...ตัว">					
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดปลา  ..."></textarea>
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
                                    <textarea class="form-control btn-xs" name="txtCowDesc" id="txtCowDesc" rows="2" placeholder="รายละเอียดอื่นๆ ..."></textarea>
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
                        <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="มี (ระบุ)..."></textarea>
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
						 <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="มี (ระบุ)..."></textarea>
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-check-label">การอนุรักษ์สิ่งแวดล้อม</label>
                        <textarea class="form-control" name="txtDesc" id="txtDesc" rows="2" placeholder="การอนุรักษ์สิ่งแวดล้อม  ..."></textarea>
                      </div>
                    </div>
                    <!-- /.form-group -->

            </div>
			
  
            <div class="row">

              <div class="col-md-3">
			  	<label>ภัยธรรมชาติ</label>
                <div class="form-check">
				  <label class="form-check-label">
                  <input class="form-check-input" type="checkbox">
					ภัยแล้ง </label>
                </div>
                  <div class="form-check">
				   <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
					น้ำท่วม</label>
                  </div>
                    <div class="form-check">
					  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">
					วาตภัย</label>
                    </div>	
					<div class="form-check">
					  <label class="form-check-label">
					  <input class="form-check-input" type="checkbox">
						อัคคีภัย </label>
					</div>					
                </div>
				
                <!-- /.form-group -->
			   <div class="col-md-3">
			   <label>&nbsp;</label>

                  <div class="form-check">
				   <label class="form-check-label">
                    <input class="form-check-input" type="checkbox">
					โรคระบาด</label>
                  </div>
				<div class="form-check">
					<label class="form-check-label">
                   <input class="form-check-input" type="checkbox">
					อื่นๆ</label>
                </div>
                <div class="form-group">
                     <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="อื่นๆ  ..."></textarea>
                </div>
                </div>
                <!-- /.form-group -->
  
                <!-- /.form-group -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label >เคยได้รับความช่วยเหลือ :</label>
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary12" name="xEnvironmental2" >
                        <label for="radioPrimary12">ไม่เคย
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary13" name="xEnvironmental2" checked>
                        <label for="radioPrimary13">เคย(ระบุความช่วยเหลือจากหน่วยงานไหน)
                        </label>
						 <textarea class="form-control" name="txtDesc" id="txtDesc" rows="2" placeholder="เคย (ความช่วยเหลือจากหน่วยงานไหน)..."></textarea>
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
                  <input class="form-check-input" type="checkbox">
                  <label class="form-check-label">ปากต่อปาก</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">การใช้โทรศัพท์มือถือ</label>
                 </div>				
                 <div class="form-check">
                      <input class="form-check-input" type="checkbox">
                      <label class="form-check-label">การใช้คอมพิวเตอร์และอินเทอร์เน็ต</label>
                 </div>	
				 
                </div>
                <!-- /.form-group -->

                <div class="col-md-3">
				
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">การส่งหนังสือแจ้ง/การส่งจดหมาย</label>
                  </div>
				 <div class="form-check">
                  <input class="form-check-input" type="checkbox">
                  <label class="form-check-label">หอกระจายข่าว</label>
                </div>
				 <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">วิทยุชุมชน</label>
                  </div>
			  
			  
                </div>
                <!-- /.form-group -->
                <div class="col-md-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox">
                      <label class="form-check-label">เวทีประชุม/ประชาคม</label>
                    </div>					
                   <div class="form-group">
                     <label class="form-check-label">อื่นๆ</label>
                     <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="อื่นๆ  ..."></textarea>
                   </div>	
                 </div>
                 <!-- /.form-group -->
            </div>

			 <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label>วันเดือนปีสำรวจ :</label>
                  <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                      <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
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
          <a href="successPage2.html" type="submit" class="btn btn-primary">บันทึกข้อมูล</a>
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