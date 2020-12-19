<?php
 require 'bootstart.php';   
 require ROOT . '/core/security.php';

$webtitle='เพิ่มข้อมูลกลุ่มอาชีพ';
$row=[];
$id = @$_GET['id']; 
if (isset($_GET['id'])) {
$webtitle='แก้ไขข้อมูลกลุ่มอาชีพ';
$row = $db::table("tbl_mas_group_occup")
    ->where('goccup_code', '=', $id)
    ->select($db::raw("goccup_code,goccup_name,goccup_desc,f_status"))->first(); 
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">หน้าจัดการข้อมูลกลุ่มอาชีพ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
     <section class="content" id="app" v-cloak>
      <form  method="post" @submit.prevent="submit" id="frm_careergroup" ref="frm_careergroup">  
      <?= \Volnix\CSRF\CSRF::getHiddenInputString('token_careergroupinfo_frm') ?> 
      <input type="hidden" id="action" name="action" value="<?($id>0)?2:1?>">
      <input type="hidden" id="id" name="id" value="<?=$id?>">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลกลุ่มอาชีพ</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อมูลกลุ่มอาชีพ <span class="requiredfeilds">*</span></label>
                  <input type="text" name="goccup_name" id="goccup_name" class="form-control" :class="status($v.goccup_name)" required v-model.trim="$v.goccup_name.$model" @blur="$v.goccup_desc.$touch()"  title="กรุณากรอกกลุ่มอาชีพและเป็นตัวเลขเท่านั้น" placeholder="กลุ่มอาชีพ ...">
                </div> 
              </div> 
              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดพอสังเขป :</label>
                  <textarea class="form-control" name="goccup_desc" id="goccup_desc" :class="status($v.goccup_desc)" v-model.trim="$v.goccup_desc.$model" @blur="$v.goccup_desc.$touch()" rows="2" placeholder="รายละเอียดพอสังเขป  ..."></textarea>
                </div> 
              </div> 
               
            </div>
            <!-- /.row -->
            <div class="row">

              <div class="col-md-3">
                <div class="form-group"> 
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary8" value="A" name="f_status" :class="status($v.f_status)" required v-model.trim="$v.f_status.$model" @blur="$v.f_status.$touch()" checked>
                      <label for="radioPrimary8">เปิด </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary9" value="C" :class="status($v.f_status)" required v-model.trim="$v.f_status.$model" @blur="$v.f_status.$touch()" name="f_status">
                      <label for="radioPrimary9">ปิด </label> 
                    </div>
                  </div>
                </div>
                </div> 

            </div>
          </div>
          
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
         goccup_name:'<?=(isset($row->goccup_name)?$row->goccup_name:'')?>',
         goccup_desc:'<?=(isset($row->goccup_desc)?$row->goccup_desc:'')?>',
         f_status:'<?=(isset($row->f_status)?$row->f_status:'A')?>',
        },
       validations() {
        return { 
         goccup_name:{required},
         goccup_desc:{},
         f_status:{},
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
                   'token_careergroupinfo_frm':$("input[name*='token_careergroupinfo_frm']").val()
                   ,id:'<?=$id?>'
                   ,goccup_name:this.goccup_name
                   ,goccup_desc:this.goccup_desc
                   ,f_status:this.f_status
                 };  
                 $.ajax({
                beforeSend: function() {  
                 _this.btn_save=true;
                },
                type: "POST",  
                datatype : "application/json", 
                url: "handler/careergroupinfo/careergroupinfoSave.php",
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