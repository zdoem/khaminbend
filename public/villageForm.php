<?php
 require 'bootstart.php';   
 require ROOT . '/core/security.php';
$webtitle='เพิ่มข้อมูลหมู่บ้าน';
$row=[];
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);  
if (isset($_GET['id'])) {
$webtitle='แก้ไขข้อมูลหมู่บ้าน';
$row = $db::table("tbl_mas_vilage")
    ->where('vil_id', '=', $id)
    ->select($db::raw("
      vil_moo,vil_name,vil_desc,water,water_desc,water_tap,water_tap_desc,bowels,bowels_desc
     ,public_fire,public_fire_desc,road,road_desc,community_forest,community_forest_desc,learning,learning_desc,other,f_status
    "))->first();
    if (is_null($row)) {
    ?>
  <script type="text/javascript">
   Swal.fire({
    title: 'ไม่พบข้อมูลที่ต้องการแก้ไข!',
    showDenyButton: false,
    showCancelButton: false,
    confirmButtonText: `OK`
  }).then((result) => {
     window.location = "./villageList.php";
  });
  </script>
  <?php
  exit();
  } 
}   
 require_once 'components/header.php';    
?> 
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$webtitle?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">หน้าจัดการข้อมูลหมู่บ้าน</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
     <section class="content" id="app" v-cloak>
      <form method="post" @submit.prevent="submit" id="frm_village" ref="frm_village">  
      <?= \Volnix\CSRF\CSRF::getHiddenInputString('token_village_frm') ?>  
      <input type="hidden" id="action" v-model="action" name="action">
      <input type="hidden" id="id" name="id" value="<?=$id?>">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลหลักของหมู่บ้าน</h3>

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
                  <label>หมู่ที่ <span class="requiredfeilds">*</span></label>
                  <input v-if="action==1" type="number" name="txtMoo" id="txtMoo" :class="status($v.txtMoo)" required v-model.trim="$v.txtMoo.$model" @blur="$v.txtMoo.$touch()" class="form-control" required pattern="\d*" title="กรุณากรอกหมู่ที่และเป็นตัวเลขเท่านั้น" placeholder="หมู่ที่ ...">
                  <input v-if="action==2" type="number" name="txtMoo" id="txtMoo" class="form-control" readonly required pattern="\d*" title="ตัวเลขเท่านั้น" :class="status($v.txtMoo)" v-model.trim="$v.txtMoo.$model"  placeholder="หมู่ที่ ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>ชื่อหมู่บ้าน <span class="requiredfeilds">*</span></label>
                  <input type="text" name="txtVillageName" id="txtVillageName" :class="status($v.txtVillageName)" required v-model.trim="$v.txtVillageName.$model" @blur="$v.txtVillageName.$touch()" required class="form-control" title="กรุณากรอกชื่อหมู่บ้าน" placeholder="ชื่อหมู่บ้าน...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>รายละเอียดพอสังเขป :</label>
                  <textarea class="form-control" name="txthomeDesc" :class="status($v.txthomeDesc)" v-model.trim="$v.txthomeDesc.$model" @blur="$v.txthomeDesc.$touch()" id="txthomeDesc" rows="2" placeholder="รายละเอียดพอสังเขป  ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-header -->

          <!-- /.card-body
          <div class="card-footer">
            xxx about  the plugin.
          </div>-->
        </div>
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อทั่วไปของหมู่บ้าน</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row bg-light">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>แหล่งน้ำ :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nWater" id="nWater" :class="status($v.nWater)" v-model.trim="$v.nWater.$model" @blur="$v.nWater.$touch()" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งน้ำ:</label>
                  <textarea class="form-control bg-light" name="water_desc" id="water_desc" :class="status($v.water_desc)" v-model.trim="$v.water_desc.$model" @blur="$v.water_desc.$touch()" rows="1" placeholder="รายละเอียดแหล่งน้ำ  ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-white">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาผิวดิน :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="water_tap" id="water_tap" :class="status($v.water_tap)" v-model.trim="$v.water_tap.$model" @blur="$v.water_tap.$touch()" class="form-control" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาผิวดิน :</label>
                  <textarea class="form-control" name="water_tap_desc" id="water_tap_desc" :class="status($v.water_tap_desc)" v-model.trim="$v.water_tap_desc.$model" @blur="$v.water_tap_desc.$touch()" rows="1" placeholder="รายละเอียดประปาผิวดิน ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาบาดาล :</label>
                  <input type="number" value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="bowels" id="bowels" :class="status($v.bowels)" v-model.trim="$v.bowels.$model" @blur="$v.bowels.$touch()" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาบาดาล :</label>
                  <textarea class="form-control bg-light" name="bowels_desc" id="bowels_desc" :class="status($v.bowels_desc)" v-model.trim="$v.bowels_desc.$model" @blur="$v.bowels_desc.$touch()" rows="1" placeholder="รายละเอียดประปาบาดาล ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ไฟสาธารณะ :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="public_fire" id="public_fire" :class="status($v.public_fire)" v-model.trim="$v.public_fire.$model" @blur="$v.public_fire.$touch()" class="form-control" placeholder="ไฟสาธารณะจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดไฟสาธารณะ :</label>
                  <textarea class="form-control" name="public_fire_desc" id="public_fire_desc" :class="status($v.public_fire_desc)" v-model.trim="$v.public_fire_desc.$model" @blur="$v.public_fire_desc.$touch()" rows="1" placeholder="รายละเอียดไฟสาธารณะ ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ถนน :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="road" id="road" :class="status($v.road)" v-model.trim="$v.road.$model" @blur="$v.road.$touch()" class="form-control bg-light" placeholder="ถนนจำนวน...เส้น">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดถนน :</label>
                  <textarea class="form-control bg-light" name="road_desc" id="road_desc" :class="status($v.road_desc)" v-model.trim="$v.road_desc.$model" @blur="$v.road_desc.$touch()"  rows="1" placeholder="รายละเอียดถนน ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ป่าชุมชน  :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="community_forest" id="community_forest" :class="status($v.community_forest)" v-model.trim="$v.community_forest.$model" @blur="$v.community_forest.$touch()" class="form-control" placeholder="ป่าชุมชนจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดป่าชุมชน :</label>
                  <textarea class="form-control" name="community_forest_desc" id="community_forest_desc" :class="status($v.community_forest_desc)" v-model.trim="$v.community_forest_desc.$model" @blur="$v.community_forest_desc.$touch()" rows="1" placeholder="รายละเอียดป่าชุมชน ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row" bg-light>
              <div class="col-md-6">
                <div class="form-group">
                  <label>แหล่งการเรียนรู้ทางการเกษตร :</label>
                  <input type="number" value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="learning" id="learning" :class="status($v.learning)" v-model.trim="$v.learning.$model" @blur="$v.learning.$touch()" class="form-control bg-light" placeholder="แหล่งการเรียนรู้ทางการเกษตรจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งการเรียนรู้ทางการเกษตร :</label>
                  <textarea class="form-control bg-light" name="learning_desc" id="learning_desc" :class="status($v.learning_desc)" v-model.trim="$v.learning_desc.$model" @blur="$v.learning_desc.$touch()"  rows="1" placeholder="รายละเอียดแหล่งการเรียนรู้ทางการเกษตร ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>



            <!-- /.row -->
            <div class="row"> 

              <div class="col-md-6">
                <div class="form-group">
                  <label>อื่นๆ :</label> 
                    <textarea class="form-control" name="other" id="other" :class="status($v.other)" v-model.trim="$v.other.$model" @blur="$v.other.$touch()" rows="1" placeholder="อื่นๆ ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- row -->

          </div>
          <!-- /.card-header -->

          <!-- /.card-body   -->
          <div class="card-footer"> 
            <button type="submit" class="btn btn-primary" v-if="!btn_save" :disabled="btn_save||btn_validate==2">บันทึกข้อมูล</button>
            <button class="btn btn-danger" v-show="btn_save" ref="issave"  :disabled="btn_save||btn_validate==2"><span class="fas fa-spinner glyphicon-refresh-animate"></span> กำลังบันทึกข้อมูล...</button>
            <button type="reset" class="btn btn-warning">รีเซ็ท</button>
          </div>

        </div>
        <!-- /.card -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
     </form>
    </section>
    <!-- /.content -->
    <script>
    Vue.use(window.vuelidate.default); 
    var validationMixin = window.vuelidate.validationMixin;
    var required = validators.required;
    var maxLength = validators.maxLength;
    var minLength=validators.minLength;
    var Fn_integer = validators.integer;
    var Fn_decimal = validators.decimal;
    var helpers=validators.helpers;
    var requiredIf=validators.requiredIf;

    window.app = new Vue({
        el: '#app', 
        mixins: [validationMixin],
        data: {
         btn_save:false,
         btn_validate:1,
         action:<?=isset($_GET['id'])? 2 : 1?>,
         txtMoo:'<?=(isset($row->vil_moo)?$row->vil_moo:'')?>',
         txtVillageName:'<?=(isset($row->vil_name)?$row->vil_name:'')?>',
         txthomeDesc:'<?=(isset($row->vil_desc)?$row->vil_desc:'')?>',
         nWater:'<?=(isset($row->water)?$row->water:0)?>',
         water_desc:'<?=(isset($row->water_desc)?$row->water_desc:'')?>',
         water_tap:'<?=(isset($row->water_tap)?$row->water_tap:0)?>',
         water_tap_desc:'<?=(isset($row->water_tap_desc)?$row->water_tap_desc:'')?>',
         bowels:'<?=(isset($row->bowels)?$row->bowels:0)?>',
         bowels_desc:'<?=(isset($row->bowels_desc)?$row->bowels_desc:'')?>',
         public_fire:'<?=(isset($row->public_fire)?$row->public_fire:0)?>',
         public_fire_desc:'<?=(isset($row->public_fire_desc)?$row->public_fire_desc:'')?>',
         road:'<?=(isset($row->road)?$row->road:0)?>',
         road_desc:'<?=(isset($row->road_desc)?$row->road_desc:'')?>',
         community_forest:'<?=(isset($row->community_forest)?$row->community_forest:0)?>',
         community_forest_desc:'<?=(isset($row->community_forest_desc)?$row->community_forest_desc:'')?>',
         learning:'<?=(isset($row->learning)?$row->learning:0)?>',
         learning_desc:'<?=(isset($row->learning_desc)?$row->learning_desc:'')?>',
         other:'<?=(isset($row->other)?$row->other:'')?>',
        },
       validations() {
        return {  
         txtMoo:{required},
         txtVillageName:{required},
         txthomeDesc:{},
         nWater:{Fn_integer},
         water_desc:{},
         water_tap:{Fn_integer},
         water_tap_desc:{},
         bowels:{Fn_integer},
         bowels_desc:{},
         public_fire:{Fn_integer},
         public_fire_desc:{},
         road:{Fn_integer},
         road_desc:{},
         community_forest:{Fn_integer},
         community_forest_desc:{},
         learning:{Fn_integer},
         learning_desc:{},
         other:{},
        }
      },
      methods: {    
           submit: function() { 
             let _this=this; 
             this.$v.$touch();  
               if (!this.$v.$invalid) {  
                  if(this.goccup_name==''){
                    Swal.fire({
                    title:'กรุณากรอกข้อมูล!',
                    allowOutsideClick: false,
                    showDenyButton: false,
                    showCancelButton: false 
                    }); 
                    return;
                }
               var datasend={
                  'token_village_frm':$("input[name*='token_village_frm']").val()
                  ,id:'<?=$id?>',
                  txtMoo:this.txtMoo,
                  txtVillageName:this.txtVillageName,
                  txthomeDesc:this.txthomeDesc,
                  nWater:this.nWater,
                  water_desc:this.water_desc,
                  water_tap:this.water_tap,
                  water_tap_desc:this.water_tap_desc,
                  bowels:this.bowels,
                  bowels_desc:this.bowels_desc,
                  public_fire:this.public_fire,
                  public_fire_desc:this.public_fire_desc,
                  road:this.road,
                  road_desc:this.road_desc,
                  community_forest:this.community_forest,
                  community_forest_desc:this.community_forest_desc,
                  learning:this.learning,
                  learning_desc:this.learning_desc,
                  other:this.other,
                 };    
                 $.ajax({
                beforeSend: function() {  
                 _this.btn_save=true;
                },
                type: "POST",  
                datatype : "application/json", 
                url: "handler/village/village.php",
                data: datasend, 
                success: function(data){   
                  $('#xhtml').html(data);
                 _this.btn_save=false; 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                   _this.btn_save=false; 
                  $('#xhtml').html('');
                  }       
                 }); 

                }else {  
                 this.$nextTick(function(){ 
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: 'โปรดตรวจสอบการกรอกข้อมูลอีกครั้ง!',
                    }); 
                   $('.error.dirty').each(function(index){
                     $(this).focus(); return false;   
                  }); 
               });

            } 
           },
           status(validation) {
          return {
            error: validation.$error,
            dirty: validation.$dirty
          } 
        },status2(validation) {
          return {
            error: validation.$error 
          } 
         },
       }
      });
    </script>

<?php
 require_once 'components/footer.php';  
?>