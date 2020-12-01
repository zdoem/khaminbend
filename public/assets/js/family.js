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
                      <div class="input-group-append"  data-toggle="datetimepicker">
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

Vue.use(window.vuelidate.default); 
var validationMixin = window.vuelidate.validationMixin;
var required = validators.required;
var maxLength = validators.maxLength;
var minLength=validators.minLength;
var showonly_houseinforgeneral=["02", "03", "04", "07", "05","08", "12"];

window.app = new Vue({
  el: '#app', 
  mixins: [validationMixin],
  data: {  
    successMessage: "",
    errorMessage: "",  
    btn_save:false,
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
    listprovinces:window.Slistprovinces,
    famerdetaillists:window.Sfamerdetaillists, 
    listfamilyhomeproducttarget:window.listfamilyhomeproducttarget,
    listfamilyhomesourceoffunds:window.listfamilyhomesourceoffunds,
    tbl_mas_info1:window.tbl_mas_info1,
    tbl_mas_info2:window.tbl_mas_info2,
    tbl_mas_info3:window.tbl_mas_info3, 
    listmas_disaster1:window.listmas_disaster1,
    listmas_disaster2:window.listmas_disaster2,
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
    otherdisastersdisc:window.otherdisastersdisc,
    helpme:window.helpme,
    helpmedisc:window.helpmedisc, 
    listmas_pet:window.listmas_pet,
    Mdisaster:window.Sdisaster,
    Mmas_info:window.Smas_info,  
    // usingmobilephone:'',
    // computers:'',
    // mailing:'',
    // broadcasttower:'',
    // communityradio:'',
    // communityforum:'',
    // communityforumdisc:'',  
    // environmentdata:{ },
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
   validations: {
     Mhouseinforgeneral:{
        //  familyhomecareer:{required},
        //  familyhomeproducttarget:{required},
        //  familyhomesourceoffunds:{required},
        //  familyhomeproductperiod:{required},
        //  familyhomeproductioncost:{required},
         familyhomecareer:{},
         familyhomeproducttarget:{},
         familyhomesourceoffunds:{},
         familyhomeproductperiod:{},
         familyhomeproductioncost:{},
     },  
     Mfamerdetaillists:{
          deeds:{
              $each:{
                  province:{required},district:{},nodeed:{},districtselect:{}
                 ,arearai:{},areawork:{},areatrw:{},
              } 
          },
          norsor3kors:{
              $each:{
                  province:{},district:{},nodeed:{},districtselect:{}
                 ,arearai:{},areawork:{},areatrw:{},
              } 
          },
          spoks:{
              $each:{
                  province:{},district:{},nodeed:{},districtselect:{}
                 ,arearai:{},areawork:{},areatrw:{},
              } 
          },
          chapter5s:{
              $each:{
                province:{},district:{},nodeed:{},districtselect:{}
                 ,arearai:{},areawork:{},areatrw:{},
                //   province:{required},district:{},nodeed:{required},districtselect:{required}
                //  ,arearai:{required},areawork:{required},areatrw:{required},
              } 
          },
         another:{}
     },  
    Mfamilylists:{
        $each: {
         prefix:{required},   
         txtFName:{ required },
         txtLName:{required},
         txtCitizenId:{ required },
         xFstatusRd:{ required },
         sexRd:{ required },
         txtNational:{ required },
         religion:{ required },
         birthday:{ required },
         educationlevel:{ required },
         homerelations:{ required },
         careergroup:{ required },
         careeranother:{ required },
         careermain:{ required },
         careersecond:{ required },
         netIncome:{ required } 
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
           minLength: minLength(5) 
        } 
    }
  },
  methods: {  
     getdata:function(){
       console.log('mas_info',this.Mdisaster);
     },
    keymonitor: function(event) {
       		if(event.key == "Enter"){
         		// app.checkLogin();
        	}
           },  
     submit: function() {  
             var _this=this;
             this.$v.$touch();  
             if (!this.$v.$invalid) { 
               var tmp_disaster=[];
               var tmp_info_code=[];
               var tmp_helpme=[];
              //  $('input[name="disaster[]"]:checked').map(function() {tmp_disaster.push(this.value);});
              //  $('input[name="info_code[]"]:checked').map(function() {tmp_info_code.push(this.value);});
              //  $('input[name="helpme"]:checked').map(function() {tmp_helpme.push(this.value);});
               var datasend={
                //  frm_family:$('#frm_family').serializeArray(), 
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
                //  otherdisastersdisc:this.otherdisastersdisc,
                //  helpme:this.helpme,
                //  helpmedisc:this.helpmedisc,
                 mouthtomouth:this.mouthtomouth,
                 usingmobilephone:this.usingmobilephone,
                 computers:this.computers,
                 mailing:this.mailing,
                 broadcasttower:this.broadcasttower,
                 communityradio:this.communityradio,
                 communityforum:this.communityforum,
                 communityforumdisc:this.communityforumdisc,
              };

               console.log('datasend',datasend);
               $.ajax({
                beforeSend: function() {  
                 _this.btn_save=true;
                },
                type: "POST",  
                datatype : "application/json", 
                url: "handler/family/familySave.php",
                data: datasend, 
                success: function(data){  
                  console.log('data',data); 
                 _this.btn_save=false;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  _this.btn_save=false; 
                }       
            });
               
              } else {
               this.$nextTick(function(){
                   $('.error.dirty').each(function(index){
                     $(this).focus(); return false;   
                  }); 
               });
            } 
        }, 
      changedistrict:function(foriten,event,index){ 
      var _this=this;  
      switch (foriten) {
            case 'deeds':  _this.Mfamerdetaillists.deeds[index].districtselect=event.target.value; break;
            case 'norsor3kors': _this.Mfamerdetaillists.norsor3kors[index].districtselect=event.target.value;  break;
            case 'spoks': _this.Mfamerdetaillists.spoks[index].districtselect=event.target.value;  break;
            case 'chapter5s': _this.Mfamerdetaillists.chapter5s[index].districtselect=event.target.value;  break; 
          } 
      },        
     getamphurbyprovince:function(foriten,event,index){ 
       var _this=this;  
      $.ajax({
        url: 'handler/GetAmphurByProvince.php',
        type: 'get', 
        data: {id:event.target.value},
        contentType: "application/json",
        dataType: "json",
        cache: false,
        success: function(data){ 
          //  console.log('_this.famerdetaillists.deeds[index]',_this.famerdetaillists.deeds); 
          switch (foriten) {  
            case 'deeds':  _this.famerdetaillists.deeds[index].district=data; break;
            case 'norsor3kors': _this.famerdetaillists.norsor3kors[index].district=data;break;
            case 'spoks': _this.famerdetaillists.spoks[index].district=data;  break;
            case 'chapter5s': _this.famerdetaillists.chapter5s[index].district=data;break; 
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
    },     
    addPeople: function () { 
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
    },
    removeDeed: function (index) {
    Vue.delete(this.famerdetaillists.deeds, index);
    Vue.delete(this.Mfamerdetaillists.deeds, index);
    },
   addNorsor3kors: function () { 
    this.famerdetaillists.norsor3kors.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.norsor3kors.push(Vue.util.extend({}, this.deed));
    },
    removeNorsor3kors: function (index) {
    Vue.delete(this.famerdetaillists.norsor3kors, index);
    Vue.delete(this.Mfamerdetaillists.norsor3kors, index);
    },
   addSpoks: function () { 
    this.famerdetaillists.spoks.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.spoks.push(Vue.util.extend({}, this.deed)); 
    },
    removeSpoks: function (index) {
    Vue.delete(this.famerdetaillists.spoks, index);
    Vue.delete(this.Mfamerdetaillists.spoks, index);
    },
   addChapter5s: function () { 
    this.famerdetaillists.chapter5s.push(Vue.util.extend({}, this.deed)); 
    this.Mfamerdetaillists.chapter5s.push(Vue.util.extend({}, this.deed));
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
 //Mhouseinforgeneral.familyhomeproductperiod
      $('#survseydate').datetimepicker({autoclose: true});
      $('input[name="familyhomeproductperiod"]').daterangepicker({
          opens: 'left',
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          format: 'DD/MMM/YYYY',
          locale: {
            format: 'DD/MM/YYYY'
          }  
        }, function(start, end, label) { 
          window.app.Mhouseinforgeneral.familyhomeproductperiod=start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY');
          
        });

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