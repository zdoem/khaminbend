<?php
$webtitle='เพิ่มข้อมูลครัวเรือน';
if (isset($_GET['id'])) {
$webtitle='แก้ไขข้อมูลครัวเรือน';
} 
require 'bootstart.php';
require ROOT . '/core/security.php';
require_once 'components/header.php'; 
?>
<?php
require_once 'handler/family/familyloadDataUser.php'; 
?>  
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$webtitle?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                	<em class="fa fa-home"></em>
                <a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$webtitle?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 
    <!-- Main content -->
      <section class="content" id="app" v-cloak> 
      <form @submit.prevent="submit" id="frm_family" ref="frm_family">   
       <?= \Volnix\CSRF\CSRF::getHiddenInputString('token_family_frm') ?>  
        <!-- <pre>{{$data}}</pre> -->
        <!-- <pre>{{ $v }}</pre> -->  
       <div class="container-fluid"> 
        <!-- SELECT2 EXAMPLE ข้อมูลครัวเรือน -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลครัวเรือน [ที่อยู่ตามทะเบียนบ้าน]</h3>

            <div class="card-tools">
              <div class="d-flex flex-row flex-nowrap align-items-center">
                <!-- <div class="p-0"><input class="form-control form-control-sm input-sm" type="text" id="txtcopydata" autocomplete="on" name="txtcopydata" v-model="txtcopydata" placeholder="รหัสที่ต้องการ copy" title="กรอกรหัสที่ต้องการ copy"></div>
                <div class="p-0"> <button type="button" class="btn btn-tool" @click="copydata" title="กด Copy ข้อมูล" ><i class="fas fa-copy"></i></button> </div> -->
                <div class="p-0"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> </div>
              </div>                                      
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>บ้านเลขที่ <span class="requiredfeilds">*</span></label>
                  <input type="text" :class="status($v.Mhouseinfor.txtHouseId)" required v-model.trim="$v.Mhouseinfor.txtHouseId.$model" @blur="$v.Mhouseinfor.txtHouseId.$touch()" name="txtHouseId" id="txtHouseId" class="form-control" placeholder="บ้านเลขที่  ...">
                  <div class="invalid-feedback order-last" v-if="!$v.Mhouseinfor.txtHouseId.Fn_txtHouseId">ต้องเป็นตัวเลขและ/เท่านั้น</div>
                  <div class="invalid-feedback order-last" v-if="!$v.Mhouseinfor.txtHouseId.isUnique&&!$v.Mhouseinfor.txtHouseId.$pending">มีข้อมูลอยู่แล้ว!.</div>
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>หมู่ที่ - ชื่อหมู่บ้าน <span class="requiredfeilds">*</span></label> 
				       	<select class="form-control"  :class="status($v.Mhouseinfor.mooHouse)" required @blur="$v.Mhouseinfor.mooHouse.$touch()" v-model.trim="$v.Mhouseinfor.mooHouse.$model" > 
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
                   <label>ตำบล <span class="requiredfeilds">*</span></label>
                     <input type="text" :class="status($v.Mhouseinfor.txtSubDstrict)" required @blur="$v.Mhouseinfor.txtSubDstrict.$touch()" v-model.trim="$v.Mhouseinfor.txtSubDstrict.$model"  name="txtSubDstrict" value="โคกขมิ้น" id="txtSubDstrict" class="form-control" placeholder="ตำบล  ...">
                 </div>
                 <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <!-- /.row -->           
             <div class="row">

               <div class="col-md-4">
                 <div class="form-group">
                   <label>อำเภอ <span class="requiredfeilds">*</span></label>
                   <input type="text" :class="status($v.Mhouseinfor.txtDistrict)" required @blur="$v.Mhouseinfor.txtDistrict.$touch()"  v-model.trim="$v.Mhouseinfor.txtDistrict.$model"  name="txtDistrict" value="พลับพลาชัย  " id="txtDistrict" class="form-control" placeholder="อำเภอ  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <div class="form-group">
                   <label>จังหวัด <span class="requiredfeilds">*</span></label>
                   <input type="text" :class="status($v.Mhouseinfor.txtProvince)" required @blur="$v.Mhouseinfor.txtProvince.$touch()" v-model.trim="$v.Mhouseinfor.txtProvince.$model"  name="txtProvince" value="บุรีรัมย์ " id="txtProvince" class="form-control" placeholder="จังหวัด  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
                <div class="col-md-4">
                      <div class="form-group">
                          <label>รหัสไปรษณีย์ <span class="requiredfeilds">*</span></label>
                          <input type="text" :class="status($v.Mhouseinfor.txtPostalCode)" required @blur="$v.Mhouseinfor.txtPostalCode.$touch()" v-model.trim="$v.Mhouseinfor.txtPostalCode.$model"  name="txtPostalCode" value="31250" id="txtPostalCode" class="form-control" placeholder="รหัสไปรษณีย์  ...">
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
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลสมาชิกในครัวเรือน</h3> &nbsp;  &nbsp; 
            <a class="btn btn-info btn-sm text-white" href="javascript:void(0)" v-on:click="addPeople">
            <i class="fa fa-user-plus" aria-hidden="true"></i> เพิ่มสมาชิกในครัวเรือน
            </a> 
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
         <template v-for="(item, index) in $v.Mfamilylists.$each.$iter"> 
            <h5>ลำดับที่ : {{(index*1)+1}}  
                <a href="javascript:void(0)" class="btn-sm btn-danger"  v-on:click="removePeople(index)"><i class="fas fa-trash"></i></a>
		    	</h5>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>คำนำหน้า <span class="requiredfeilds">*</span></label>
                  <!-- v-model="item.prefix" v-bind:class="{ 'error dirty':item.prefix.$error, '': !item.prefix.$error}" v-model.trim="item.prefix.$model"-->
                  <select class="form-control" :class="status(item.prefix)" required v-model.trim="item.prefix.$model" @blur="item.prefix.$touch()">
                     <option v-for="(v, indexx) in listmas_prefix" v-bind:value="v.pre_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.pre_name}}</option> 
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-3" v-if="item.xFstatusRd.$model=='O'">
                <div class="form-group">
                  <label>ชื่อเจ้าบ้าน <span class="requiredfeilds">*</span></label>
                  <input type="text" :id="'txtFName'+index" :class="status(item.txtFName)" required v-model.trim="item.txtFName.$model" @blur="item.txtFName.$touch()" class="form-control" placeholder="ชื่อเจ้าบ้าน...">
                </div> 
              </div>
               <div class="col-md-3" v-if="item.xFstatusRd.$model=='M'">
                <div class="form-group">
                  <label>ชื่อผู้อยู่อาศัย <span class="requiredfeilds">*</span></label>
                  <input type="text" :id="'txtFName'+index" :class="status(item.txtFName)" required v-model.trim="item.txtFName.$model" @blur="item.txtFName.$touch()" class="form-control" placeholder="ชื่อผู้อยู่อาศัย...">
                </div> 
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>นามสกุล <span class="requiredfeilds">*</span></label>
                  <input type="text" :id="'txtLName'+index" :class="status(item.txtLName)" required v-model.trim="item.txtLName.$model" @blur="item.txtLName.$touch()" class="form-control" placeholder="นามสกุล...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>เลขที่ประจำตัวประชาชน <span class="requiredfeilds">*</span></label>
                    <input type="text" :id="'txtCitizenId'+index" :class="status(item.txtCitizenId)" required v-model.trim="item.txtCitizenId.$model" @blur="item.txtCitizenId.$touch()" class="form-control" minlength="13" maxlength="13" placeholder="เลขที่ประจำตัวประชาชน  ...">
                    <div class="invalid-feedback order-last" v-if="!item.txtCitizenId.isUnique&&!item.txtCitizenId.$pending">มีข้อมูลอยู่แล้ว!.</div>
                </div>
                <!-- /.form-group -->
              </div>

            </div>
            <!-- /row -->

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>สถานภาพ <span class="requiredfeilds">*</span></label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline"><!--   :disabled="index>0" -->
                      <input type="radio" :id="'radioxFstatusRdO'+index" v-on:change="setOwnerfamily('O',index)"  value="O" :class="status(item.xFstatusRd)" v-model.trim="item.xFstatusRd.$model" @blur="item.xFstatusRd.$touch()"> 
                      <label :for="'radioxFstatusRdO'+index">เจ้าบ้าน 
                      </label>
                    </div>
                    <div class="icheck-primary d-inline"> 
                      <input type="radio" :id="'radioxFstatusRdM' + index" v-on:change="setOwnerfamily('M',index)" value="M" :class="status(item.xFstatusRd)" v-model.trim="item.xFstatusRd.$model" @blur="item.xFstatusRd.$touch()">
                      <label :for="'radioxFstatusRdM'+index">ผู้อยู่อาศัย 
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>เพศ <span class="requiredfeilds">*</span></label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioxsexRdM'+index" value="M" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioxsexRdM'+index">ชาย
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioxsexRdW'+index" value="W" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioxsexRdW'+index">หญิง
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioxsexRdO'+index"  value="O" :class="status(item.sexRd)" v-model.trim="item.sexRd.$model" @blur="item.sexRd.$touch()">
                      <label :for="'radioxsexRdO'+index">อื่นๆ
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->

              <div class="col-md-3">
                <div class="form-group">
                  <label>สัญชาติ <span class="requiredfeilds">*</span></label>
                  <input type="text" :id="'txtNational'+index" :class="status(item.txtNational)" required v-model.trim="item.txtNational.$model" @blur="item.txtNational.$touch()" class="form-control" placeholder="สัญชาติ  ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                 <div class="form-group">
                    <label>ศาสนา <span class="requiredfeilds">*</span></label>
                    <select class="form-control" :id="'religion'+index"  :class="status(item.religion)" required v-model.trim="item.religion.$model" @blur="item.religion.$touch()">
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
                       <label>ระบุวันเดือนปีเกิดในบัตร * :</label>
                         <select class="form-control"  required @blur="item.birthday_format.$touch()" v-model.trim="item.birthday_format.$model">
                         <option value='yy-mm-dd'>มีวัน/เดือน/ปีเกิด</option>
                         <option value='yy-mm'>มีเฉพาะเดือนและปีเกิด</option>
                         <option value='yyyy' selected>มีเฉพาะปีเกิด</option>
                        </select>
                       </div> 
            </div> {{item.birthday_format.$model}}
               <div v-if="item.birthday_format.$model='yy-mm-dd'">
                  1
              </div> 
              <div class="col-md-3">
                <div class="form-group">
                  <label>วันเดือนปีเกิด <span class="requiredfeilds">*</span></label>  
                   <date-picker  v-model.trim="item.birthday.$model" @blur="item.birthday.$touch()"  required  :class="status(item.birthday)" :mdata="item.birthday.$model"></date-picker>  
                </div> 
              </div>

              <!-- /.col -->

                <!-- /.col -->
                <div class="col-md-3">
                   <div class="form-group">
                      <label>ระดับการศึกษา <span class="requiredfeilds">*</span></label>
                      <select class="form-control"  :id="'educationlevel'+index" :class="status(item.educationlevel)" required v-model.trim="item.educationlevel.$model" @blur="item.educationlevel.$touch()">
                        <option v-for="(v, indexx) in listmas_educate" :value="v.ed_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.ed_name}}</option> 
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                 <!-- /.col -->
                 <div class="col-md-3">
                    <div class="form-group">
                       <label>ความสัมพันธ์ในครัวเรือน <span class="requiredfeilds">*</span></label>
                       <select class="form-control" :id="'homerelations'+index" :class="status(item.homerelations)" required v-model.trim="item.homerelations.$model" @blur="item.homerelations.$touch()">
                          <option v-for="(v, indexx) in listmas_relations" :value="v.re_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.re_name}}</option> 
                       </select>
                     </div> 
                   </div>
               <!-- /.col --> 
				<div class="col-md-3">
					<div class="form-group">
							<label>อาชีพหลัก <span class="requiredfeilds">*</span></label>
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
					  <label>รายได้/ต่อปี <span class="requiredfeilds">*</span></label>								
						<input type="number" :id="'netIncome'+index" :class="status(item.netIncome)" required v-model.trim="item.netIncome.$model" @blur="item.netIncome.$touch()" class="form-control btn-xs" placeholder="รายได้/ต่อปี...">
					</div> 
         </div>
         
         <div class="col-md-3">
					 <div class="form-group">
                  <label>สถานะ <span class="requiredfeilds">*</span></label>
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioF_status1'+index" required v-model="item.memF_status.$model" value="A" :class="status(item.memF_status)" @blur="item.memF_status.$touch()">
                      <label :for="'radioF_status1'+index">ยังมีชีวิตอยู่</label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" :id="'radioF_status2'+index" required v-model="item.memF_status.$model"  value="D" :class="status(item.memF_status)" @blur="item.memF_status.$touch()">
                      <label :for="'radioF_status2'+index">ถึงแก่กรรม
                      </label>
                    </div> 
                  </div>
                </div>
				  </div>

              </div> 
              <hr v-if="showhr(Mfamilylists,index)">
            </template>  
          </div> 
        </div> 

       <!-- SELECT2 EXAMPLE ข้อมูลพื้นที่การเกษตร -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลพื้นที่การเกษตร </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> 
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
                                <th style="width: 15%">จังหวัด <span class="requiredfeilds">*</span></th>
                                <th style="width: 25%">อำเภอ <span class="requiredfeilds">*</span></th>
                                <th style="width: 15%">เลขที่เอกสารสิทธิ์ <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ไร่) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(งาน) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ตรว.) <span class="requiredfeilds">*</span></th>
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
                        <select class="form-control btn-xs"  v-model.trim="item.district.$model"  @change="item.district.$touch()"  required > 
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
                                    <input type="number" name="arearai[]"  :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="จำนวนเต็มเท่านั้น...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)0-4เท่านั้น...">
                                    <div class="invalid-feedback order-last" v-if="!item.areawork.Fn_areawork">พื้นที่(งาน)0-4เท่านั้น</div>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" step="any" name="areatrw[]" :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="ใส่จุดทศนิยมได้...">
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
                                <th style="width: 15%">จังหวัด <span class="requiredfeilds">*</span></th>
                                <th style="width: 25%">อำเภอ <span class="requiredfeilds">*</span></th>
                                <th style="width: 15%">เลขที่เอกสารสิทธิ์ <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ไร่) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(งาน) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ตรว.) <span class="requiredfeilds">*</span></th>
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
								 <select class="form-control btn-xs" v-model.trim="item.district.$model"  name="district[]" required  :class="status(item.district)" @blur="item.district.$touch()"> 
                   <template v-for="(vv, indexx) in distric_norsor3kors[index]">  
                             <option :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
                    </template> 
								</select>
							   </div>
								</td>								
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="nodeed[]" :class="status(item.nodeed)" v-model.trim="item.nodeed.$model" @blur="item.nodeed.$touch()" class="form-control btn-xs" placeholder="เลขที่นส.3ก  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="arearai[]" :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="จำนวนเต็มเท่านั้น...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)0-4เท่านั้น...">
                                    <div class="invalid-feedback order-last" v-if="!item.areawork.Fn_areawork">พื้นที่(งาน)0-4เท่านั้น</div>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" step="any" name="areatrw[]"  :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="ใส่จุดทศนิยมได้...">
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
                                <th style="width: 15%">จังหวัด <span class="requiredfeilds">*</span></th>
                                <th style="width: 25%">อำเภอ <span class="requiredfeilds">*</span></th>
                                <th style="width: 15%">เลขที่เอกสารสิทธิ์ <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ไร่) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(งาน) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ตรว.) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">#</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr class="table-warning" v-if="Mfamerdetaillists.spoks.length<=0">
                            <td align="center" colspan="8">*** ยังไม่มีข้อมูล ***</td></tr>        
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
								 <select class="form-control btn-xs" v-model.trim="item.district.$model"  name="district[]" required :class="status(item.district)"  @blur="item.district.$touch()">
								    <template v-for="(vv, indexx) in distric_sorporkor[index]">  
                              <option :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
                    </template> 
								</select>
							   </div>
								</td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="nodeed[]" :class="status(item.nodeed)" v-model.trim="item.nodeed.$model" @blur="item.nodeed.$touch()" class="form-control btn-xs" placeholder="เลขที่สปก....">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="arearai[]" :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="จำนวนเต็มเท่านั้น...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)0-4เท่านั้น...">
                                    <div class="invalid-feedback order-last" v-if="!item.areawork.Fn_areawork">พื้นที่(งาน)0-4เท่านั้น</div> 
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" step="any" name="areatrw[]"  :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="ใส่จุดทศนิยมได้...">
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
                                <th style="width: 15%">จังหวัด <span class="requiredfeilds">*</span></th>
                                <th style="width: 25%">อำเภอ <span class="requiredfeilds">*</span></th>
                                <th style="width: 15%">เลขที่เอกสารสิทธิ์ <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ไร่) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(งาน) <span class="requiredfeilds">*</span></th>
                                <th style="width: 10%">พื้นที่(ตรว.) <span class="requiredfeilds">*</span></th>
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
								 <select class="form-control btn-xs" v-model.trim="item.district.$model"  name="district[]" required :class="status(item.district)" @blur="item.district.$touch()">
								   <template v-for="(vv, indexx) in distric_chapter5s[index]">  
                               <option :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false" >{{vv.name_th}}</option>
                    </template> 
								</select>
							   </div>
								</td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="nodeed" :class="status(item.nodeed)" v-model.trim="item.nodeed.$model" @blur="item.nodeed.$touch()" class="form-control btn-xs" placeholder="เลขที่ภบท 5  ...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="arearai[]"  :class="status(item.arearai)" v-model.trim="item.arearai.$model" @blur="item.arearai.$touch()" class="form-control btn-xs" placeholder="จำนวนเต็มเท่านั้น...">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" name="areawork[]" :class="status(item.areawork)" v-model.trim="item.areawork.$model" @blur="item.areawork.$touch()" class="form-control btn-xs" placeholder="พื้นที่(งาน)0-4เท่านั้น...">
                                    <div class="invalid-feedback order-last" v-if="!item.areawork.Fn_areawork">พื้นที่(งาน)0-4เท่านั้น</div>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="number" step="any" name="areatrw[]" :class="status(item.areatrw)" v-model.trim="item.areatrw.$model" @blur="item.areatrw.$touch()" class="form-control btn-xs" placeholder="ใส่จุดทศนิยมได้...">
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
                  <textarea class="form-control" name="another" v-model="Mfamerdetaillists.another" rows="2" placeholder="อื่นๆ ..."></textarea>
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
                  <label>อาชีพในครัวเรือน <span class="requiredfeilds">*</span></label>
                  <select class="form-control" name="familyhomecareer" id="familyhomecareer" :class="status($v.Mhouseinforgeneral.familyhomecareer)" v-model.trim="$v.Mhouseinforgeneral.familyhomecareer.$model" @blur="$v.Mhouseinforgeneral.familyhomecareer.$touch()">
					         <option v-for="(vv, indexx) in listmas_house_occup" :value="vv.hccup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.hccup_name}}</option> 
				         </select> 
                </div> 
              </div>
              
            <div class="col-md-3">
                    <div class="form-group">
                            <label>กลุ่มอาชีพ <span class="requiredfeilds">*</span></label>
                             <select class="form-control" :class="status($v.Mhouseinforgeneral.g_occupational_code)" required v-model.trim="$v.Mhouseinforgeneral.g_occupational_code.$model" @blur="$v.Mhouseinforgeneral.g_occupational_code.$touch()">
                             <option v-for="(v, indexx) in listmas_group_occup" :value="v.goccup_code" v-bind:selected="indexx== 0 ? 'selected' : false">{{v.goccup_name}}</option> 
                            </select>
                     </div> 
                </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>กลุ่มอาชีพอื่นๆ  :</label>
                  <textarea class="form-control" rows="1" placeholder="กลุ่มอาชีพอื่นๆ ระบุ  ..." :class="status($v.Mhouseinforgeneral.g_occupational_other)" v-model.trim="$v.Mhouseinforgeneral.g_occupational_other.$model" @blur="$v.Mhouseinforgeneral.g_occupational_other.$touch()">
                      {{$v.Mhouseinforgeneral.g_occupational_other}}
                  </textarea>
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

            </div>
            <!-- /row -->
            <div class="row"> 

              <div class="col-md-3">
                <div class="form-group">
                  <label>แหล่งเงินทุน (ครัวเรือน) <span class="requiredfeilds">*</span></label>
                  <select class="form-control"  class="form-control" name="familyhomesourceoffunds" id="familyhomesourceoffunds" :class="status($v.Mhouseinforgeneral.familyhomesourceoffunds)" v-model.trim="$v.Mhouseinforgeneral.familyhomesourceoffunds.$model" @blur="$v.Mhouseinforgeneral.familyhomesourceoffunds.$touch()">
                   <option v-for="(vv, indexx) in listfamilyhomesourceoffunds" :value="vv.code" v-bind:selected="indexx== 0 ? 'selected' : false">{{vv.name}}</option> 
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
             <div class="col-md-3">
                <div class="form-group">
                  <label>ช่วงเวลาการผลิต(เริ่ม) <span class="requiredfeilds">*</span></label> 
                  <div class="input-group date" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" autocomplete="off" required id="eco_product_from" :class="status($v.Mhouseinforgeneral.eco_product_from)" v-model.trim="$v.Mhouseinforgeneral.eco_product_from.$model" @blur="$v.Mhouseinforgeneral.eco_product_from.$touch()"> 
                      <div class="input-group-append eco_product_from" style="cursor: pointer;">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div> 
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ช่วงเวลาการผลิต(หมด) <span class="requiredfeilds">*</span></label> 
                  <div class="input-group date" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" autocomplete="off" required id="eco_product_to" :class="status($v.Mhouseinforgeneral.eco_product_to)" v-model.trim="$v.Mhouseinforgeneral.eco_product_to.$model" @blur="$v.Mhouseinforgeneral.eco_product_to.$touch()"> 
                      <div class="input-group-append eco_product_to" style="cursor: pointer;">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div> 
              </div> 

              <div class="col-md-3">
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
              <template v-for="(item, index) in $v.Mlistmas_facilities.$each.$iter">   
              <div class="col-md-3">
                <div class="form-check">
				      <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" v-model="item.selected.$model"> {{item.fac_name.$model}} </label>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" :class="status2(item.fac_quantity)" :disabled="!item.selected.$model"  v-model="item.fac_quantity.$model" @blur="item.fac_quantity.$touch()" :placeholder="'จำนวน...' + item.fac_name.$model"  value="">
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
                                <th style="width: 15px">จำนวน <span class="requiredfeilds">*</span></th>
                                <th style="width: 15px">จำนวน(ที่ได้รับวัคซีน) </th>
                                <th style="width: 50px">รายละเอียด</th>
                              </tr>
                            </thead>
                            <tbody> 
                                <template v-for="(item, index) in $v.listmas_pet.$each.$iter">   
                                <tr>
                                  <td>{{(index*1)+1}}.</td>
                                   <td>
                                <div class="form-check">
                                  <label class="form-check-label"> 
                                  <input class="form-check-input"  type="checkbox"  v-model="item.selected.$model" :value="item.pet_code.$model" :id="'apetcheck_'+item.pet_code.$model"> {{item.pet_name.$model}}</label>
                                </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                    <input type="number" :id="'pet_quantity'+item.pet_code.$model" required :class="status2(item.pet_quantity)"  @blur="item.pet_quantity.$touch()" v-model="item.pet_quantity.$model" :disabled="!item.selected.$model"  class="form-control btn-xs"  :placeholder="'จำนวน'+item.pet_name.$model+'...ตัว'" >					
                                    </div>
                                  </td>
                                <td>
                                    <div class="form-group">
                                    <input type="number" :id="'pet_vacine_qt'+item.pet_code.$model" required :class="status2(item.pet_vacine_qt)"  @blur="item.pet_vacine_qt.$touch()" v-model="item.pet_vacine_qt.$model" :disabled="!item.selected.$model" class="form-control btn-xs" :placeholder="'จำนวน'+item.pet_name.$model+'(รับวัคซีนแล้ว)...ตัว'">					
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-group">
                                      <textarea class="form-control btn-xs" :id="'pet_desc'+item.pet_code.$model" :class="status2(item.pet_desc)"  @blur="item.pet_desc.$touch()" :disabled="!item.selected.$model" v-model="item.pet_desc.$model" rows="2" :placeholder="'รายละเอียด'+item.pet_name.$model+'...'"></textarea>
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
                      <input type="radio" id="xEnvironmental1" v-model="$v.xEnvironmental.$model" name="xEnvironmental" value="N">
                      <label for="xEnvironmental1">ไม่มี
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="xEnvironmental2" v-model="$v.xEnvironmental.$model" name="xEnvironmental"  value="Y" checked>
                      <label for="xEnvironmental2">มี (ระบุ)					  
                      </label> 
                        <textarea class="form-control" v-model="$v.xEnvironmentaldisc.$model" :class="status2($v.xEnvironmentaldisc)"  @blur="$v.xEnvironmentaldisc.$touch()" id="xEnvironmentaldisc" rows="1" placeholder="มี (ระบุ)..." :disabled="$v.xEnvironmental.$model=='N'"></textarea>
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
                        <input type="radio" id="radioxxEnvironmental11" v-model="$v.xEnvironmental2.$model" name="radioPrimary101x" value="N">
                        <label for="radioxxEnvironmental11">ไม่มี
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioxxEnvironmental22" v-model="$v.xEnvironmental2.$model" name="radioPrimary101x" value="Y">
                        <label for="radioxxEnvironmental22">มี(ระบุ)
                        </label>
				          		 <textarea class="form-control" v-model="$v.xEnvironmental2disc.$model" :class="status2($v.xEnvironmental2disc)"  @blur="$v.xEnvironmental2disc.$touch()" id="xEnvironmental2disc" rows="1" :disabled="$v.xEnvironmental2.$model=='N'" placeholder="มี (ระบุ)..."></textarea>
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
                        <textarea class="form-control dt_dis_desc" rows="1" v-model="item.dt_dis_desc"  :placeholder="''+item.dis_name+'...'"></textarea>
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
                        <textarea class="form-control dt_dis_desc" rows="1" v-model="item.dt_dis_desc"  :placeholder="''+item.dis_name+'...'"></textarea>
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
                        <input type="radio" id="radiohelpme1" name="helpme" v-model="$v.helpme.$model" value="N" >
                        <label for="radiohelpme1">ไม่เคย
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radiohelpme2" name="helpme"  v-model="$v.helpme.$model"  value="Y" checked>
                        <label for="radiohelpme2">เคย(ระบุความช่วยเหลือจากหน่วยงานไหน)
                        </label>
				        		    <textarea class="form-control" name="helpmedisc" id="helpmedisc"  :class="status2($v.helpmedisc)"  @blur="$v.helpmedisc.$touch()" v-model="$v.helpmedisc.$model" rows="2" :disabled="$v.helpme.$model=='N'"  placeholder="เคย (ความช่วยเหลือจากหน่วยงานไหน)..."></textarea>
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
                        <input class="form-check-input" type="checkbox" :id="item.info_code" name="info_code[]" v-model="Mmas_info.selected"  :value="item.info_code">
                        <label class="form-check-label" :for="item.info_code">{{item.info_name}}</label>
                      </div>
                      <div class="form-group" v-if="item.info_code==99" >
                       <label class="form-check-label">{{item.info_name}}</label>  
                        <textarea class="form-control info_desc" rows="1" v-model="item.info_desc"  :placeholder="''+item.info_name+'...'"></textarea>
                     </div>	
                 </template> 
                </div>
                
                <!-- /.form-group --> 
                <div class="col-md-3">
                  <template  v-for="(item, index) in tbl_mas_info2">
                        <div class="form-check" v-if="item.info_code!=99" :key="item.info_code">
                        <input class="form-check-input" type="checkbox" :id="item.info_code" name="info_code[]" v-model="Mmas_info.selected"  :value="item.info_code">
                        <label class="form-check-label" :for="item.info_code">{{item.info_name}}</label>
                      </div>
                      <div class="form-group" v-if="item.info_code==99" :key="item.info_code">
                       <label class="form-check-label">{{item.info_name}}</label>  
                        <textarea class="form-control info_desc" name="info_desc[]" rows="1" v-model="item.info_desc"  :placeholder="''+item.info_name+'...'"></textarea>
                     </div>	
                 </template>
                </div>
                <!-- /.form-group -->
                <div class="col-md-3">
                       <template  v-for="(item, index) in tbl_mas_info3">
                        <div class="form-check" v-if="item.info_code!=99" >
                        <input class="form-check-input" type="checkbox" :id="item.info_code" name="info_code[]" v-model="Mmas_info.selected"  :value="item.info_code">
                        <label class="form-check-label" :for="item.info_code">{{item.info_name}}</label>
                      </div>
                      <div class="form-group" v-if="item.info_code==99">
                       <label class="form-check-label">{{item.info_name}}</label> 
                        <textarea class="form-control info_desc" name="info_desc[]" rows="1" v-model="item.info_desc"  :placeholder="''+item.info_name+'...'"></textarea>
                     </div>	
                 </template>
                 </div>
                 <!-- /.form-group -->
            </div>
 
		  	 <div class="row">  
               <div class="col-md-3"> 
                <div class="form-group">
                  <label>วันเดือนปีสำรวจ :</label>
                  <div class="input-group date datepickers" > 
	               <input id="survseydate" name="survseydate" v-model="survseydate" required type="text" data-toggle="datetimepicker" 
                 class="form-control  col-md-8 datetimepicker-input"   autocomplete="off" required>
                  <div class="input-group-append survseydate" style="cursor: pointer;">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                 </div>
                </div> 
                </div>
              </div>  

              <!-- /.col -->
		    	</div>

          </div>
          <!-- /.card-header -->

          <!-- /.card-body -->
          <div class="card-footer"> 
            <button type="submit" class="btn btn-primary" v-if="!btn_save" :disabled="btn_save||btn_validate==2">บันทึกข้อมูล</button>
            <button class="btn btn-danger" v-show="btn_save" ref="issave"  :disabled="btn_save||btn_validate==2"><span class="fas fa-spinner glyphicon-refresh-animate"></span> กำลังบันทึกข้อมูล...</button>
            <!-- <button type="submit" class="btn btn-primary vld-parent" v-show="btn_save" ref="issave"  :disabled="btn_save">กำลังบันทึกข้อมูล</button> -->
            <button type="reset" class="btn btn-warning">รีเซ็ท</button> 
            <!-- &nbsp;&nbsp;<a class="vld-parent" id="issave" ref="issave" >saveing...</a> -->
          </div>
        </div>
        <!-- /.card -->

       </div><!-- /.container-fluid -->
      </form>
    </section>
    <!-- /.content -->  
 
<script src="assets/js/family.js"></script> 
<?php
require_once 'components/footer.php';
?>