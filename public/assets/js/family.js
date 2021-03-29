$.datepicker.regional['th'] ={
        changeMonth: true,
        changeYear: true,
        //defaultDate: GetFxupdateDate(FxRateDateAndUpdate.d[0].Day),
        yearOffSet: 543, 
        buttonImageOnly: false,
        dateFormat: 'dd/mm/yy',
        dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
        dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
        monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
        constrainInput: true,
       
        prevText: 'ก่อนหน้า',
        nextText: 'ถัดไป',
        yearRange: '-20:+0',
        buttonText: 'เลือก',
        closeText:'ปิด',
        currentText:'วันนี้'
      
 };
$.datepicker.setDefaults($.datepicker.regional['th']);

Vue.component("my-birthday_mmyy", {
  props: ["mdata"],
  template: `<div class="input-group date"  data-target-input="nearest">
             <input type="text" class="form-control" required ref="birthday_mmyy"
                 placeholder="(เดือนปี เกิดเท่านั้น ex.01/2555)" />
                <div class="input-group-append" style="cursor: pointer;" v-on:click="showdatebtn">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div> 
                </div>  
            </div>`,
  mounted() {
    var _this = this;  
     this.$nextTick(function(){    
          $(_this.$refs.birthday_mmyy).datepicker({
          yearRange: "c-100:c",
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          closeText:'เลือกข้อมูล',
          currentText: 'This year', 
          onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            var x_birthday=$.datepicker.formatDate("mm/yy", new Date(year, month, 1));
            $(this).val(x_birthday);
            _this.$emit("input", x_birthday);
          }
        }).focus(function () { 
          $(".ui-datepicker-calendar").hide();
          $(".ui-datepicker-current").hide(); 
          $("#ui-datepicker-div").position({
            my: "left top",
            at: "left bottom",
            of: $(this)
          });
        }).attr("readonly", false);
        if(_this.$refs.birthday_mmyy.value==''){$(this.$refs.birthday_mmyy).val($.datepicker.formatDate("mm/yy", new Date()));} 
         _this.$emit("input", $(this.$refs.birthday_mmyy).val()); 
     });
  },
  methods: {
          showdatebtn:function(){
          let _this=this;
          this.$nextTick(function(){   
             $(_this.$refs.birthday_mmyy).datepicker('show'); 
          });
        } 
  }
});  
Vue.component("my-birthday_yyyy", {
  props: ["mdata"],
  template: `<div class="input-group date"  data-target-input="nearest">
                      <input type="text" :value="mdata" ref="birthday_yyyy" required class="form-control" />
                      <div class="input-group-append" style="cursor: pointer;" v-on:click="showdatebtn">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div> 
                      </div>
                  </div>`,
  mounted() {
    var _this = this;  
     this.$nextTick(function(){   
            $(_this.$refs.birthday_yyyy).datepicker( {
            yearRange: "c-100:c",
            changeMonth: false,
            changeYear: true,
            showButtonPanel: true,
            closeText:'เลือกข้อมูล',
            currentText: 'This year',
            onClose: function(dateText, inst) {
              var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
              var x_birthday=$.datepicker.formatDate("yy", new Date(year, 0, 1));
              $(this).val(x_birthday);
              _this.$emit("input", x_birthday);
            },
            beforeShow: function(input, inst){
               
            }
          }).focus(function () {
            $(".ui-datepicker-month").hide();
            $(".ui-datepicker-calendar").hide();
            $(".ui-datepicker-current").hide(); 
            $(".ui-datepicker-prev").hide();
            $(".ui-datepicker-next").hide();
            $("#ui-datepicker-div").position({
              my: "left top",
              at: "left bottom",
              of: $(this)
            });
          }).attr("readonly", false);
         if(_this.$refs.birthday_yyyy.value==''){$(this.$refs.birthday_yyyy).val($.datepicker.formatDate("yy", new Date()));} 
         _this.$emit("input", $(this.$refs.birthday_yyyy).val()); 
     });
  },
  methods: {
       showdatebtn:function(){
          let _this=this;
          this.$nextTick(function(){   
             $(_this.$refs.birthday_yyyy).datepicker('show'); 
          });
        } 
  }
});

Vue.component("date-picker", {
  props: ["mdata"],
  template: `<div class="input-group date"  data-target-input="nearest">
                      <input type="text" :value="mdata" ref="mdate" required class="form-control" />
                      <div class="input-group-append" style="cursor: pointer;" v-on:click="showdatebtn">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div> 
                      </div>
                  </div>`,
  mounted() {
    var _this = this; 
     this.$nextTick(function(){   
      var mydate = new Date();
      var toDay = mydate.getDate() + '/' + (mydate.getMonth() + 1) + '/' + (mydate.getFullYear() + 543); 
      $(this.$refs.mdate).datepicker({  
        yearRange: '-80:+0',
        gotoCurrent:true,
        changeMonth: true, changeYear: true, defaultDate: toDay
        ,beforeShow: function (input, calendar) {
           $(calendar.dpDiv).removeClass('eco_product'); 
         }
        ,onSelect: function(date) { 
          _this.$emit("input", date);
       }
      }); 
      if(_this.$refs.mdate.value==''){$(this.$refs.mdate).datepicker("setDate", new Date());}
      _this.$emit("input", $(this.$refs.mdate).val()); 
     });
  },
  methods: {
        showdatebtn:function(){
          let _this=this;
          this.$nextTick(function(){   
             $(_this.$refs.mdate).datepicker('show'); 
          });
        }
  }
}); 
Vue.use(window.vuelidate.default); 
var validationMixin = window.vuelidate.validationMixin;
var required = validators.required;
var maxLength = validators.maxLength;
var minLength=validators.minLength;
var Fn_integer = validators.integer;
var Fn_decimal = validators.decimal;
var helpers=validators.helpers;
var requiredIf=validators.requiredIf;

var Fn_txtHouseId = function Fn_txtHouseId(v) {
  return  !helpers.req(v) || !!(''+v).match(/^[0-9/]*$/);
};
var Fn_txtCitizenId = function Fn_txtCitizenId(v) {
  return  !helpers.req(v) ||(!!(''+v).match(/([0-9]{1})([0-9]{4})([0-9]{5})([0-9]{2})([0-9]{1})$/)&&v.length==13);
};
var Fn_areawork = function Fn_areawork(v) {  
  return  !helpers.req(v) ||(!!(''+v).match(/^[0-4]$/));
};
var Fn_plusinteger = function Fn_plusinteger(v) {  
  return  !helpers.req(v) ||(!!(''+v).match(/^[0-9]*$/));
};
var validateIf = function validateIf(prop, validator) {
  return helpers.withParams({
    type: 'validatedIf',
    prop: prop
  }, function (value, parentVm) {
    return helpers.ref(prop, this, parentVm) ? validator(value) : true;
  });
};
var showonly_houseinforgeneral=["02", "03", "04", "07", "05","08", "12"];

window.app = new Vue({
  el: '#app', 
  mixins: [validationMixin],
  data: {  
    successMessage: "",
    errorMessage: "",  
    btn_save:false,
    btn_validate:1,
    txtcopydata:'',
    actions:window.actions,
     // for view  
    OwnerHomelistfamily:'',
    listmas_vilage:window.Slistmas_vilage,
    familylist:window.Sfamilylist,
    deed:window.Sfamerland,
    listmas_prefix:window.Slistmas_prefix, 
    familylists:window.Sfamilylists,
    listmas_religion:window.Slistmas_religion, 
    listmas_educate:window.Slistmas_educate,
    listmas_relations:window.Slistmas_relations,
    listmas_group_occup:window.Slistmas_group_occup,
    listmas_occupation:window.Slistmas_occupation,
    listmas_house_occup:window.Slistmas_house_occup,
    listlistmas_addition:window.Slistlistmas_addition,
    listprovinces:window.Slistprovinces,
    
    famerdetaillists:window.Sfamerdetaillists, 
    listfamilyhomeproducttarget:window.listfamilyhomeproducttarget,
    listfamilyhomesourceoffunds:window.listfamilyhomesourceoffunds,
    tbl_mas_info1:window.tbl_mas_info1,
    tbl_mas_info2:window.tbl_mas_info2,
    tbl_mas_info3:window.tbl_mas_info3, 
    listmas_disaster1:window.listmas_disaster1,
    listmas_disaster2:window.listmas_disaster2,
    distric_deeds:window.distric_deeds,
    distric_norsor3kors:window.distric_norsor3kors,
    distric_sorporkor:window.distric_sorporkor,
    distric_chapter5s:window.distric_chapter5s,
    // for model  
    Mhouseinfor:window.Shouseinfor, 
    Mfamilylists:window.SSfamilylists,
    Mfamerdetaillists:window.SSfamerdetaillists,
    Mhouseinforgeneral:window.Shouseinforgeneral,
    Mlistmas_facilities:window.Slistmas_facilities, 
    xEnvironmental:window.xEnvironmental,
    xEnvironmentaldisc:window.xEnvironmentaldisc,
    xEnvironmental2:window.xEnvironmental2,
    xEnvironmental2disc:window.xEnvironmental2disc,
    greenxEnvironmentaldisc:window.greenxEnvironmentaldisc, 
    helpme:window.helpme,
    helpmedisc:window.helpmedisc, 
    listmas_pet:window.listmas_pet,
    Mdisaster:window.Sdisaster,
    Mmas_info:window.Smas_info,  
    survseydate:window.d_survey 
  },
  mounted: function () {
     this.$nextTick(function(){  
       //$(".datepicker-th-2").datepicker( "refresh" );  
  
     });  
     
    // var tmfam=this.$el.dataset.famerdetaillists;
    // if(tmfam.hasOwnProperty('deeds')){
    //     this.famerdetaillists = JSON.parse(tmfam);
    // } 

    // this.listmas_occupation = JSON.parse(this.$el.dataset.listmas_occupation); 
  },
 validations() {
    return { 
     Mhouseinforgeneral:{
         familyhomecareer:{required},
         familyhomeproducttarget:{},
         familyhomesourceoffunds:{required}, 
         eco_product_from:{required},
         eco_product_to:{required},
         familyhomeproductioncost:{}, 
         g_occupational_code:{required},
         g_occupational_other:{}
     },  
     Mfamerdetaillists:{
          deeds:{
              $each:{
                  province:{required},district:{required},nodeed:{required}
                 ,arearai:{required,Fn_plusinteger},areawork:{required,Fn_plusinteger,Fn_areawork},areatrw:{required,Fn_decimal},
              } 
          },
          norsor3kors:{
              $each:{
                  province:{required},district:{required},nodeed:{required}
                 ,arearai:{required,Fn_plusinteger},areawork:{required,Fn_plusinteger,Fn_areawork},areatrw:{required,Fn_decimal},
              } 
          },
          spoks:{
              $each:{
                  province:{required},district:{required},nodeed:{required}
                ,arearai:{required,Fn_plusinteger},areawork:{required,Fn_plusinteger,Fn_areawork},areatrw:{required,Fn_decimal},
              } 
          },
          chapter5s:{
              $each:{
                province:{required},district:{required},nodeed:{required}
               ,arearai:{required,Fn_plusinteger},areawork:{required,Fn_plusinteger,Fn_areawork},areatrw:{required,Fn_decimal}, 
              } 
          },
         another:{}
     },  
     
    Mfamilylists:{
        $each: {
         prefix:{required},   
         txtFName:{ required },
         txtLName:{required},
         txtCitizenId:{ 
          required,
          isUnique (value) {
          if ((value == '')||(''+value).length!=13) return true;   
            let _this=this;
            return new Promise(function(resolve, reject){
                $.ajax({
                  url: 'handler/family/family_duplicate_nationid.php',
                  type: 'post', 
                  datatype : "application/json", 
                  data:{id:_this.getParameterByName('id'),survseydate:_this.survseydate,mem_citizen_id:encodeURIComponent(value)},
                  success: function (data) { 
                    if((data.status=='nodupicate')){_this.btn_validate=1;}else{_this.btn_validate=2;}
                    resolve((data.status=='nodupicate'));
                  },
                  error: function (error) {
                    reject(true)
                  },
                })
              });  
          },
          Fn_txtCitizenId },
         xFstatusRd:{ required },
         sexRd:{ required },
         txtNational:{ required },
         religion:{ required },
         birthday:{ required },
         birthday_format:{  },
         educationlevel:{ required },
         homerelations:{ required }, 
         careermain:{ required },
         careersecond:{  },
         netIncome:{ required }, 
         memF_status:{required}  
        } 
    },   
    Mhouseinfor:{
        mooHouse:{required},
        txtSubDstrict:{required},
        txtDistrict:{required},
        txtProvince:{required},
        txtPostalCode:{required},
        txtHouseId:{
           required,
          isUnique (value) {
          if ((value == '')||(''+value).length<=0) return true;  
            let _this=this;
            return new Promise(function(resolve, reject){
                $.ajax({
                  url: 'handler/family/family_duplicate_mouseid.php',
                  type: 'post', 
                  datatype : "application/json", 
                  data:{id:_this.getParameterByName('id'),survseydate:_this.survseydate,house_no:encodeURIComponent(value)},
                  success: function (data) { 
                    if((data.status=='nodupicate')){_this.btn_validate=1;}else{_this.btn_validate=2;}  
                    resolve((data.status=='nodupicate'));
                  },
                  error: function (error) {
                    reject(true)
                  },
                })
              });  
          },
           Fn_txtHouseId,
           minLength: minLength(1) 
        } 
    },
    Mlistmas_facilities:{
      $each: {
        selected:{}, 
        fac_name:{},
        fac_quantity:{
          Fn_plusinteger:validateIf(function (nestedModel) {
               return !!nestedModel.selected;
          },Fn_plusinteger),
          required: requiredIf(function (nestedModel) {
            return !!nestedModel.selected; 
          })
        }
      }
    },
    listmas_pet:{
      $each: {
        selected:{}, 
        pet_name:{},
        pet_desc:{},
        pet_code:{},
        pet_vacine_qt:{},
        pet_quantity:{
          Fn_plusinteger:validateIf(function (nestedModel) {
               return !!nestedModel.selected;
          },Fn_plusinteger),
          required: requiredIf(function (nestedModel) {
            return !!nestedModel.selected; 
          })
        }
      }
    },
    xEnvironmental:{},
    xEnvironmentaldisc:{
      minLength: validateIf('xEnvironmental', minLength(3)) 
    },
    xEnvironmental2:{},
    xEnvironmental2disc:{
      minLength: validateIf('xEnvironmental2', minLength(3)) 
    },
    helpme:{},
    helpmedisc:{
      minLength: validateIf('helpme', minLength(3)) 
    }
   }
  },
  methods: {    
    changebirthday_format: function (event,pindex) {
       var vv=this.Mfamilylists[pindex];
       vv.birthday='';
       vv.birthday_format=event.target.value; 
       this.$set(this.Mfamilylists, pindex, vv);
    },
    setOwnerfamily:function(type,pindex){ 
       let _this=this;
       _this.OwnerHomelistfamily=pindex;  
       
       if(_this.Mfamilylists.length>1){
         var vv=_this.Mfamilylists[pindex];
         var f_txtFName=vv.txtFName;
         var f_txt='เปลี่ยนให้เจ้าบ้านใหม่';
         vv.xFstatusRd=type; 
         if(type=='O'){
           vv.homerelations='01';
          if(f_txtFName.length>0){f_txt='เปลี่ยนให้'+f_txtFName+'เป็นเจ้าบ้านแล้ว!';}
           Swal.fire({
            title:f_txt,
            allowOutsideClick: false,
            showDenyButton: false,
            showCancelButton: false 
            }); 
           }else{
           vv.homerelations=null;
          }
         _this.$set(_this.Mfamilylists, pindex, vv); 
         this.Mfamilylists.forEach(function(v,index){ 
          if(pindex!=index){
           if(v.xFstatusRd=='O'){v.homerelations=null;}  
           v.xFstatusRd='M'; 
          _this.$set(_this.Mfamilylists, index, v);
          }  
        }); 
       }   
    },
    getsurvseydate:function(){
       return $('#assessment_date').val();    
    }, 
    getParameterByName:function(name, url) {
    if (!url)
     url = window.location.href;
     name = name.replace(/[\[\]]/g, "\\$&");
     var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
     results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
   },
    keymonitor: function(event) {
       		if(event.key == "Enter"){
         		// app.checkLogin();
        	}
     },  
     submit: function() {  
             var _this=this; 
             var y1=moment($('#assessment_date').val(),'DD/MM/YYYY').format('YYYY/MM/DD'); 
             var y2=moment(window.alert_survey,'DD/MM/YYYY').format('YYYY/MM/DD'); 
             var alertinert=moment(y1).diff(y2, 'year');
             if(alertinert>0&&alertinert!=NaN){
                   Swal.fire({
                      title: 'คุณกำลังจะสร้างข้อมูลใหม่ใช่หรือไม่?', 
                      allowOutsideClick: false,
                      showDenyButton: false,
                      showCancelButton: true,
                      confirmButtonText: 'ตกลง', 
                      cancelButtonText:'ยกเลิก',
                    }).then(function(result) { 
                      if (!result.isConfirmed) { return; } 
                  }); 
             }  
             let checkOwner=undefined;
             this.Mfamilylists.forEach(function(v,index){
                  if(v.xFstatusRd=='O'){ checkOwner=index;this.OwnerHomelistfamily=checkOwner;}
             });
             if(checkOwner==undefined){
                Swal.fire({
                title:'กรุณาเลือกเจ้าบ้าน 1 คน ก่อนค่ะ!',
                allowOutsideClick: false,
                showDenyButton: false,
                showCancelButton: false 
                }); 
                return;
             }
             this.$v.$touch();  
             if (!this.$v.$invalid) {  
              //  $('input[name="disaster[]"]:checked').map(function() {tmp_disaster.push(this.value);}); 
               var datasend={
                'token_family_frm':$("input[name*='token_family_frm']").val(),
                 info_desc:$(".info_desc").val(),
                 dt_dis_desc:$(".dt_dis_desc").val(),
                 OwnerHomelistfamily:this.OwnerHomelistfamily, 
                 id:this.getParameterByName('id'),
                 Mhouseinfor:this.Mhouseinfor,
                 Mfamilylists:this.Mfamilylists, 
                 Mfamerdetaillists:this.Mfamerdetaillists, 
                 Mhouseinforgeneral:this.Mhouseinforgeneral, 
                 Mlistmas_facilities:this.Mlistmas_facilities,
                 listmas_pet:this.listmas_pet,
                 xEnvironmental:this.xEnvironmental,
                 xEnvironmentaldisc:this.xEnvironmentaldisc,
                 xEnvironmental2:this.xEnvironmental2,
                 xEnvironmental2disc:this.xEnvironmental2disc,
                 greenxEnvironmentaldisc:this.greenxEnvironmentaldisc,
                 Mdisaster:this.Mdisaster,
                 Mmas_info_select:this.Mmas_info,
                 helpme:this.helpme,
                 helpmedisc:this.helpmedisc,
                 survseydate:this.survseydate,  
              };  
               $.ajax({
                beforeSend: function() {  
                 _this.btn_save=true;
                },
                type: "POST",  
                datatype : "application/json", 
                url: "handler/family/familySave.php",
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
              } else {  
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
     copydata:function(id){ 
       var _this=this;
         $.ajax({
                beforeSend: function() {  
                 
                },
                type: "GET",  
                cache: false,
                datatype : "application/json", 
                url: "handler/family/familyloadDataUser.php",
                data: {type:'copy',id:_this.txtcopydata}, 
                success: function(data){    
                    $('#xhtml').empty().html(data);
                    // _this.Mfamilylists=window.SSfamilylists;
                    _this.Mhouseinfor=window.Shouseinfor; 
                    _this.Mhouseinforgeneral=window.Shouseinforgeneral; 
                    _this.listmas_house_occup=window.Slistmas_house_occup; 
                    _this.Mlistmas_facilities=window.Slistmas_facilities;
                    _this.listmas_pet=window.listmas_pet;  
                    _this.xEnvironmental=window.xEnvironmental;
                    _this.xEnvironmentaldisc=window.xEnvironmentaldisc;
                    _this.xEnvironmental2=window.xEnvironmental2;
                    _this.xEnvironmental2disc=window.xEnvironmental2disc;
                    _this.greenxEnvironmentaldisc=window.greenxEnvironmentaldisc;
                    _this.helpme=window.helpme;
                    _this.helpmedisc=window.helpmedisc; 
                    _this.tbl_mas_info1=window.tbl_mas_info1;
                    _this.tbl_mas_info2=window.tbl_mas_info2;
                    _this.tbl_mas_info3=window.tbl_mas_info3;
                    _this.Mmas_info=window.Smas_info;
                    _this.listmas_disaster1=window.listmas_disaster1;
                    _this.listmas_disaster2=window.listmas_disaster2;
                    _this.Mdisaster=window.Sdisaster;
                    _this.survseydate=window.d_survey;
                    $('#xhtml').empty();   
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {  
                  $('#xhtml').html(data);
                }       
            });
     },   
     getamphurbyprovince:function(foriten,event,index){ 
       var _this=this;  // console.log('index',index);
      $.ajax({
        url: 'handler/GetAmphurByProvince.php',
        type: 'get', 
        data: {id:event.target.value},
        contentType: "application/json",
        dataType: "json",
        cache: false,
        success: function(data){  
          switch (foriten) {  
            case 'deeds':
               _this.$set(_this.distric_deeds, index, data.reverse().concat({code: null, name_th: "กรุณาเลือกข้อมูล"}).reverse());
               _this.Mfamerdetaillists.deeds[index].district=_this.deed.district; 
               if(_this.Mfamerdetaillists.deeds[index].province!=20){
                 _this.Mfamerdetaillists.deeds[index].district=null;
               }
             break;
            case 'norsor3kors':
              _this.$set(_this.distric_norsor3kors, index, data.reverse().concat({code: null, name_th: "กรุณาเลือกข้อมูล"}).reverse()); 
                _this.Mfamerdetaillists.norsor3kors[index].district=_this.deed.district;
                if(_this.Mfamerdetaillists.norsor3kors[index].province!=20){
                _this.Mfamerdetaillists.norsor3kors[index].district=null;
                }
              break;
            case 'spoks': 
             _this.$set(_this.distric_sorporkor, index, data.reverse().concat({code: null, name_th: "กรุณาเลือกข้อมูล"}).reverse()); 
             _this.Mfamerdetaillists.spoks[index].district=_this.deed.district;
              if(_this.Mfamerdetaillists.spoks[index].province!=20){
               _this.Mfamerdetaillists.spoks[index].district=null;
              }
            break;
            case 'chapter5s':
              _this.$set(_this.distric_chapter5s, index, data.reverse().concat({code: null, name_th: "กรุณาเลือกข้อมูล"}).reverse()); 
              _this.Mfamerdetaillists.chapter5s[index].district=_this.deed.district;
               if(_this.Mfamerdetaillists.chapter5s[index].province!=20){
                _this.Mfamerdetaillists.chapter5s[index].district=null;
               }
               break; 
          } 
            
        },
        error: function (jqXHR, textStatus, errorThrown){ 
          alert('error!');
        }
      });
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
    addPeople: function () { 
    if(this.Mfamilylists.length>0){
       this.familylist.xFstatusRd='M'; 
       this.familylist.homerelations=null;
    }else{ 
       this.familylist.xFstatusRd='O'; 
       this.familylist.homerelations='01';
    }  
    this.familylists.push(Vue.util.extend({}, this.familylist)); 
    this.Mfamilylists.push(Vue.util.extend({},this.familylist));    
    },
    removePeople: function (index) {
    let _this=this;
    Swal.fire({
      title: 'ลบสมาชิกในครัวเรือน?',
      text: "คุณจะไม่สามารถกู้คืนข้อมูลได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบ',
      cancelButtonText:'ยกเลิก' 
    }).then(function(result){
      if (!result.isConfirmed) return; 
      Vue.delete(_this.familylists, index);
      Vue.delete(_this.Mfamilylists, index); 
      if(_this.Mfamilylists.length>0){
      let checkOwner=undefined;
      _this.Mfamilylists.forEach(function(v,index){
          if(v.xFstatusRd=='O'){checkOwner=v;}  
      });
        if(checkOwner==undefined){
          var vv=_this.Mfamilylists[0];
          vv.xFstatusRd='O'; 
          vv.homerelations='01';
          _this.$set(_this.Mfamilylists, 0, vv);
        } 
      } 
    });
    
    },
   addDeed: function () {  
    this.famerdetaillists.deeds.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.deeds.push(Vue.util.extend({}, this.deed)); 
    this.getamphurbyprovince('deeds',{target:{value:this.deed.province}},this.famerdetaillists.deeds.length-1); 
    },
    removeDeed: function (index) {
    let _this=this;
    Swal.fire({
      title: 'ลบรายการ โฉนด '+_this.famerdetaillists.deeds[index].nodeed+'?',
      text: "คุณจะไม่สามารถกู้คืนข้อมูลได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบ',
      cancelButtonText:'ยกเลิก' 
    }).then(function(result){
    if (!result.isConfirmed) return;   
    Vue.delete(_this.famerdetaillists.deeds, index);
    Vue.delete(_this.Mfamerdetaillists.deeds, index);
    });

    },
   addNorsor3kors: function () { 
    this.famerdetaillists.norsor3kors.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.norsor3kors.push(Vue.util.extend({}, this.deed));
    this.getamphurbyprovince('norsor3kors',{target:{value:this.deed.province}},this.famerdetaillists.norsor3kors.length-1); 
    },
    removeNorsor3kors: function (index) {
    let _this=this;
    Swal.fire({
      title: 'ลบรายการ นส.3ก '+_this.famerdetaillists.norsor3kors[index].nodeed+'?',
      text: "คุณจะไม่สามารถกู้คืนข้อมูลได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบ',
      cancelButtonText:'ยกเลิก' 
    }).then(function(result){
    if (!result.isConfirmed) return; 
    Vue.delete(_this.famerdetaillists.norsor3kors, index);
    Vue.delete(_this.Mfamerdetaillists.norsor3kors, index);
    });

    },
   addSpoks: function () { 
    this.famerdetaillists.spoks.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.spoks.push(Vue.util.extend({}, this.deed)); 
    this.getamphurbyprovince('spoks',{target:{value:this.deed.province}},this.famerdetaillists.spoks.length-1); 
    },
    removeSpoks: function (index) {
    let _this=this;
    Swal.fire({
      title: 'ลบรายการ สปก. '+_this.famerdetaillists.spoks[index].nodeed+'?',
      text: "คุณจะไม่สามารถกู้คืนข้อมูลได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบ',
      cancelButtonText:'ยกเลิก' 
    }).then(function(result){
    if (!result.isConfirmed) return;   
    Vue.delete(_this.famerdetaillists.spoks, index);
    Vue.delete(_this.Mfamerdetaillists.spoks, index);
    });

    },
   addChapter5s: function () { 
    this.famerdetaillists.chapter5s.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.chapter5s.push(Vue.util.extend({}, this.deed));
    this.getamphurbyprovince('chapter5s',{target:{value:this.deed.province}},this.famerdetaillists.chapter5s.length-1); 
    },
    removeChapter5s: function (index) {
    let _this=this;
    Swal.fire({
      title: 'ลบรายการ ภบท 5 '+_this.famerdetaillists.chapter5s[index].nodeed+'?',
      text: "คุณจะไม่สามารถกู้คืนข้อมูลได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบ',
      cancelButtonText:'ยกเลิก' 
    }).then(function(result){
    if (!result.isConfirmed) return;   
    Vue.delete(_this.famerdetaillists.chapter5s, index);
    Vue.delete(_this.Mfamerdetaillists.chapter5s, index);
    });

    },
    showinhomeonly:function(code_ck){
       if(showonly_houseinforgeneral.indexOf(code_ck) != -1) {return true}
       return false;
    },
    showhr: function(list,curindex) { 
            if (list.length-1>curindex) {
                return true;
                }  
            return false;
    },    
    clearMessage: function(){
        app.errorMessage = '';
        app.successMessage = '';
    }
  }
});    
Vue.nextTick(function () {    
      var mydate = new Date();
      var toDay = mydate.getDate() + '/' + (mydate.getMonth() + 1) + '/' + (mydate.getFullYear() + 543);
      $("#survseydate").datepicker({ 
       showButtonPanel: true,
       yearRange: '-4:+0',
       beforeShow: function (input, calendar) {
           $(calendar.dpDiv).removeClass('eco_product'); 
        },
       onSelect: function(date) {
           window.app.$data.survseydate= date; 
       },
      changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay
      });
      $(document).on("click", ".survseydate", function () {
        $('#survseydate').datepicker('show');   
       });
     //----------------------------------------------------------------------------------------------------------------------
      var dpmode = '';
      var startDate = '0';
      var endDate = '0'; 
      $(document).on("click", ".eco_product_from", function () {
        $('#eco_product_from').datepicker('show');   
       });
       $(document).on("click", ".eco_product_to", function () {
        $('#eco_product_to').datepicker('show');   
       });
      $("#eco_product_from").datepicker({
        // minDate: '-1Y',
        yearRange: '-4:+39',
        setDate: new Date(), 
        dateFormat: "dd/mm/yy",
        showButtonPanel: true, 
        changeMonth: true,
        numberOfMonths: 1,
        gotoCurrent:true,
        changeYear: true
        ,beforeShow: function (input, calendar) {
           $(calendar.dpDiv).addClass('eco_product');
          dpmode = 'depart';
        },
        beforeShowDay: function (date) {
          var date1 = $.datepicker.parseDate("dd/mm/yy", $("#eco_product_from").val());
          var date2 = $.datepicker.parseDate("dd/mm/yy", $("#eco_product_to").val());
          return [true, date1 && date2 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2)) ? "dp-highlight" : ""];

        },
        onClose: function (selectedDate) {
           window.app.$data.Mhouseinforgeneral.eco_product_from= selectedDate;
           $("#eco_product_to").datepicker("option", "minDate", selectedDate);
           $('#eco_product_to').datepicker('show'); 
           startDate = selectedDate; 
        } 
      });

      $("#eco_product_to").datepicker({
        dateFormat: "dd/mm/yy",
        // minDate: 2,
        yearRange: '-4:+39',
        setDate: new Date(), 
        gotoCurrent:true,
        showButtonPanel: true, 
        numberOfMonths: 1,
        changeMonth: true, changeYear: true,isBuddhist: true, defaultDate: toDay
        ,beforeShow: function (input, calendar) {
          $(calendar.dpDiv).addClass('eco_product');
          dpmode = 'return';
        },
        beforeShowDay: function (date) {
          var date1 = $.datepicker.parseDate("dd/mm/yy", $("#eco_product_from").val());
          var date2 = $.datepicker.parseDate("dd/mm/yy", $("#eco_product_to").val());
          return [true, date1 && date2 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2)) ? "dp-highlight" : ""];
        }, 
        onClose: function (selectedDate) {
          $("#eco_product_from").datepicker("option", "maxDate", selectedDate); 
          window.app.$data.Mhouseinforgeneral.eco_product_to= selectedDate;
          endDate = selectedDate; 
        }
      });

      $('#ui-datepicker-div').delegate('.eco_product .ui-datepicker-calendar td', 'mouseover', function () {
        if ($(this).data('year') == undefined) return;
        if (dpmode == 'depart' && endDate == '0') return;
        if (dpmode == 'return' && startDate == '0') return;

        var currentDate =  $('a',this).html()+ '/' + ($(this).data('month') + 1)+'/'+ $(this).data('year'); 
        currentDate = $.datepicker.parseDate("dd/mm/yy", currentDate).getTime();
        if (dpmode == 'depart') {
          var StartDate = currentDate;
          var EndDate = $.datepicker.parseDate("dd/mm/yy", endDate).getTime();
        } else {
          var StartDate = $.datepicker.parseDate("dd/mm/yy", startDate).getTime();
          var EndDate = currentDate;
        };
        $('#ui-datepicker-div.eco_product td').each(function (index, el) {
          if ($(this).data('year') == undefined) return;

          var currentDate = $('a',this).html()+ '/' + ($(this).data('month') + 1)+'/'+ $(this).data('year'); 
          currentDate = $.datepicker.parseDate("dd/mm/yy", currentDate).getTime();
          if (currentDate >= StartDate && currentDate <= EndDate) {
            $(this).addClass('dp-highlight')
          } else {
            $(this).removeClass('dp-highlight')
          };
        });
      }); 
});  
// var dd= Swal.fire({
//           title: 'Timer Test',
//           text: 'This window has a 2s timer.',
//           showCancelButton: false,
//           showConfirmButton: false,
//           closeOnConfirm: false,
//           allowOutsideClick: false,
//           timer: 2000
//           },
//           function() {
//           	swal({
//             title: 'Second Window!',
//             text: 'This window has no timer set'
//             });
//            });
//         dd.close();