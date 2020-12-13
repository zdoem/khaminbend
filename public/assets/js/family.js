Vue.component("date-picker", {
  props: ["value"],
  template: `<input type="text" class="form-control" placeholder="วันเดือนปีเกิด" required>`,
  mounted() {
    var _this = this; 
     this.$nextTick(function(){   
      // var mydate = new Date();
      // var toDay = mydate.getDate() + '/' + (mydate.getMonth() + 1) + '/' + (mydate.getFullYear() + 543);
      // $(this.$el).datepicker({ 
      //  onSelect: function(date) { 
      //     _this.$emit("input", date);
      //  },
      // changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay
      // ,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
      // dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
      // monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
      // monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

     });
  }
}); 
Vue.component("date-picker2", {
  props: ['mdata'],
  template: `<div class="input-group date" ref="mdate" data-target-input="nearest">
                      <input type="text" :value="mdata" ref="mdate" required class="form-control" />
                      <div class="input-group-append"  ref="mdate" style="cursor: pointer;">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div> 
                      </div>
                  </div> `,
  mounted() {
    var _this = this;
    $(this.$refs.mdate).datepicker({
      autoclose: true,
      format: "dd/mm/yyyy",
      todayHighlight: true
    });
    $(this.$refs.mdate)
      .datepicker()
      .on("changeDate", function (e) { 
        _this.$emit("input", e.format(0, "dd/mm/yyyy"));
      });
  }
});
Vue.component("datepickerrang", {
  props: ['mdatarang'],
  template: `<input type="text" class="form-control float-right" required name="familyhomeproductperiod"  :value="mdatarang" ref="mdatarang">`,
  mounted() {
    var _this = this;
       $(this.$refs.mdatarang).daterangepicker({
         opens: 'left',
          locale: {
            format: 'DD/MM/YYYY'
          }  
         }, function(start, end, label) { 
          _this.$emit("familyhomeproductperiod",start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        });  
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
    txtcopydata:'',
    actions:window.actions,
     // for view  
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
    survseydate:new Date().getTime() 
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
         familyhomeproductperiod:{required},
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
                  data:{id:_this.getParameterByName('id'),mem_citizen_id:encodeURIComponent(value)},
                  success: function (data) { 
                    resolve((data.status=='nodupicate'))
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
                  data:{id:_this.getParameterByName('id'),house_no:encodeURIComponent(value)},
                  success: function (data) { 
                    resolve((data.status=='nodupicate'))
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
     up_familyhomeproductperiod:function(e){  
       this.Mhouseinforgeneral.familyhomeproductperiod=e;
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
             this.$v.$touch();  
             if (!this.$v.$invalid) {  
              //  $('input[name="disaster[]"]:checked').map(function() {tmp_disaster.push(this.value);}); 
               var datasend={
                //  frm_family:$('#frm_family').serializeArray(), 
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
                 survseydate:$('#assessment_date').val(),  
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
                url: "handler/family/familycopydata.php",
                data: {id:_this.txtcopydata}, 
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
              //  _this.Mfamerdetaillists.deeds[index].district=null; 
              _this.Mfamerdetaillists.deeds[index].district=_this.deed.district;
             break;
            case 'norsor3kors':
              _this.$set(_this.distric_norsor3kors, index, data.reverse().concat({code: null, name_th: "กรุณาเลือกข้อมูล"}).reverse());
              // _this.Mfamerdetaillists.norsor3kors[index].district=null;
              _this.Mfamerdetaillists.norsor3kors[index].district=_this.deed.district;
              break;
            case 'spoks': 
             _this.$set(_this.distric_sorporkor, index, data.reverse().concat({code: null, name_th: "กรุณาเลือกข้อมูล"}).reverse());
             // _this.Mfamerdetaillists.spoks[index].district=null;
             _this.Mfamerdetaillists.spoks[index].district=_this.deed.district;
            break;
            case 'chapter5s':
              _this.$set(_this.distric_chapter5s, index, data.reverse().concat({code: null, name_th: "กรุณาเลือกข้อมูล"}).reverse());
              // _this.Mfamerdetaillists.chapter5s[index].district=null;
              _this.Mfamerdetaillists.chapter5s[index].district=_this.deed.district;
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
    }  
    this.familylists.push(Vue.util.extend({}, this.familylist)); 
    this.Mfamilylists.push(Vue.util.extend({},this.familylist));   
    //  this.$nextTick(function(){  
    //   var mydate = new Date();
    //   var toDay = mydate.getDate() + '/' + (mydate.getMonth() + 1) + '/' + (mydate.getFullYear() + 543);
    //   $(".datepicker-th-2").datepicker({ 
    //    onSelect: function(date) {
    //        console.log('log',this); 
    //    },
    //   changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay
    //   ,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
    //   dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
    //   monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
    //   monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
    //  }); 
    },
    removePeople: function (index) {
    Vue.delete(this.familylists, index);
    Vue.delete(this.Mfamilylists, index);
    },
   addDeed: function () {  
    this.famerdetaillists.deeds.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.deeds.push(Vue.util.extend({}, this.deed)); 
    this.getamphurbyprovince('deeds',{target:{value:this.deed.province}},this.famerdetaillists.deeds.length-1); 
    },
    removeDeed: function (index) {
    Vue.delete(this.famerdetaillists.deeds, index);
    Vue.delete(this.Mfamerdetaillists.deeds, index);
    },
   addNorsor3kors: function () { 
    this.famerdetaillists.norsor3kors.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.norsor3kors.push(Vue.util.extend({}, this.deed));
    this.getamphurbyprovince('norsor3kors',{target:{value:this.deed.province}},this.famerdetaillists.norsor3kors.length-1); 
    },
    removeNorsor3kors: function (index) {
    Vue.delete(this.famerdetaillists.norsor3kors, index);
    Vue.delete(this.Mfamerdetaillists.norsor3kors, index);
    },
   addSpoks: function () { 
    this.famerdetaillists.spoks.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.spoks.push(Vue.util.extend({}, this.deed)); 
    this.getamphurbyprovince('spoks',{target:{value:this.deed.province}},this.famerdetaillists.spoks.length-1); 
    },
    removeSpoks: function (index) {
    Vue.delete(this.famerdetaillists.spoks, index);
    Vue.delete(this.Mfamerdetaillists.spoks, index);
    },
   addChapter5s: function () { 
    this.famerdetaillists.chapter5s.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.chapter5s.push(Vue.util.extend({}, this.deed));
    this.getamphurbyprovince('chapter5s',{target:{value:this.deed.province}},this.famerdetaillists.chapter5s.length-1); 
    },
    removeChapter5s: function (index) {
    Vue.delete(this.famerdetaillists.chapter5s, index);
    Vue.delete(this.Mfamerdetaillists.chapter5s, index);
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
      //   $('#birthday,#reservationdate2').datetimepicker({
      //   format: 'L'
      // });  
      // var mydate = new Date();
      // var toDay = mydate.getDate() + '/' + (mydate.getMonth() + 1) + '/' + (mydate.getFullYear() + 543);
      // $(".datepicker-th-2").datepicker({ 
      //  onSelect: function(date) {
      //      console.log('log',this); 
      //  },
      // changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay
      // ,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
      // dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
      // monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
      // monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
  
      $('#survseydate').datetimepicker(window.d_survey);
      // $('#survseydate').datetimepicker({defaultDate:'11/03/2020 13:52',format: 'DD/MM/YYYY HH:mm A'});
      // $('input[name="familyhomeproductperiod"]').daterangepicker(window.ConfDaterang); 
   //$('#birthday,#reservationdate2').on("change.datetimepicker", function (e) {
       //console.log('log',$('#datetimepicker1').datetimepicker('viewDate')); 
       // window.app.familylists.birthday=122;//$('#datetimepicker1').datetimepicker('viewDate');  
   //});
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