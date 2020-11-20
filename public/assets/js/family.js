/*window.app = new Vue({
  el: '#app',
  data: {
    familylist:{ prefix: 1,txtFName: '',txtLName:'',txtCitizenId:'' ,xFstatusRd:1,sexRd:1,txtNational:'',religion:'',birthday:''
    ,educationlevel:'',homerelations:'',careergroup:'',careeranother:'',careermain:'',careersecond:'',netIncome:''},
    familylists:[],  
  },
  mounted: function () { 
    this.familylists = JSON.parse(this.$el.dataset.familylists); 
  },
  methods: {
    addNewApartment: function () {
      this.familylists.push(Vue.util.extend({}, this.familylist))
    },
    removeApartment: function (index) {
      Vue.delete(this.familylists, index);
    },
    addPeople: function () {
    this.familylists.push(Vue.util.extend({}, this.familylist)); 
    },
    removePeople: function (index) {
    Vue.delete(this.familylists, index);
    },
  }
}); */
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
    listmas_vilage:[],
    listmas_occupation:[],
    listmas_prefix:[],
    listmas_religion:[],
    listmas_relations:[],
    listmas_pet:[],
    listmas_info:[],
    listmas_house_occup:[],
    listmas_group_occup:[],
    listmas_facilities:[],
    listmas_educate:[],
    listmas_disaster:[],
    listmas_addition:[],
    listdepartments:[],
    houseinfor:{
        txtHouseId:'',  
        mooHouse:27,
        txtSubDstrict:'',
        txtDistrict:'',
        txtProvince:'', 
        txtPostalCode:''
    },
    familylist:{ prefix:'',txtFName: '',txtLName:'',txtCitizenId:'' ,xFstatusRd:1,sexRd:1,txtNational:'',religion:'',birthday:''
    ,educationlevel:'',homerelations:'',careergroup:'',careeranother:'',careermain:'',careersecond:'',netIncome:''},
    familylists:[],
    deed:{province:'',district:'',nodeed:'',arearai:'',areawork:'',areatrw:''},
    famerdetaillists:{
        deeds:[],
        norsor3kors:[],
        spoks:[],
        chapter5s:[],
        another:''
    },
    houseinforgeneral:{
      familyhomecareer:'',
      familyhomeproducttarget:'',
      familyhomesourceoffunds:'',
      familyhomeproductperiod:'',
      familyhomeproductioncost:'',
      familyhometractor:0,
      familyhomewalkingtractor:0,
      familyhomcartuktuk:0,
      familyhomcarharvester:0,
      familyhomcarbalers:0,
      familyhomother:'',
    },
    environmentdata:{

    }
    ,researchdate:new Date().getTime() 
  },
  mounted: function () { 

      this.$nextTick(function(){
            // $('#birthday').daterangepicker();
            $('#birthday').datetimepicker({
                format: 'L'
            });
       }); 
    this.familylists = JSON.parse(this.$el.dataset.familylists); 
    var tmfam=this.$el.dataset.famerdetaillists;
    if(tmfam.hasOwnProperty('deeds')){
        this.famerdetaillists = JSON.parse(tmfam);
    } 

    this.listmas_occupation = JSON.parse(this.$el.dataset.listmas_occupation);
    this.listmas_prefix = JSON.parse(this.$el.dataset.listmas_prefix);
    this.listmas_religion = JSON.parse(this.$el.dataset.listmas_religion);
    this.listmas_pet = JSON.parse(this.$el.dataset.listmas_pet);
    this.listmas_info = JSON.parse(this.$el.dataset.listmas_info);
    this.listmas_house_occup = JSON.parse(this.$el.dataset.listmas_house_occup);
    this.listmas_group_occup = JSON.parse(this.$el.dataset.listmas_group_occup);
    this.listmas_facilities = JSON.parse(this.$el.dataset.listmas_facilities);
    this.listmas_educate = JSON.parse(this.$el.dataset.listmas_educate);
    this.listmas_disaster = JSON.parse(this.$el.dataset.listmas_disaster);
    this.listmas_addition = JSON.parse(this.$el.dataset.listmas_addition);
    this.listdepartments = JSON.parse(this.$el.dataset.listdepartments);
    this.listmas_relations = JSON.parse(this.$el.dataset.listmas_relations); 
    this.listmas_vilage = JSON.parse(this.$el.dataset.listmas_vilage);  
  },
   validations: {
     houseinforgeneral:{
         familyhomecareer:{required},
         familyhomeproducttarget:{required},
         familyhomesourceoffunds:{required},
         familyhomeproductperiod:{required},
         familyhomeproductioncost:{required},
     },  
     famerdetaillists:{
          deeds:{
              $each:{
                  province:{required},district:{required},nodeed:{required}
                 ,arearai:{required},areawork:{required},areatrw:{required},
              } 
          },
          norsor3kors:{
              $each:{
                  province:{required},district:{required},nodeed:{required}
                 ,arearai:{required},areawork:{required},areatrw:{required},
              } 
          },
          spoks:{
              $each:{
                  province:{required},district:{required},nodeed:{required}
                 ,arearai:{required},areawork:{required},areatrw:{required},
              } 
          },
          chapter5s:{
              $each:{
                  province:{required},district:{required},nodeed:{required}
                 ,arearai:{required},areawork:{required},areatrw:{required},
              } 
          },
         another:{required}
     },  
    familylists:{
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
         netIncome:{ required },
        } 
    },   
    houseinfor:{
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
    keymonitor: function(event) {
       		if(event.key == "Enter"){
         		// app.checkLogin();
        	}
           },  
     submit: function() {
            this.$v.$touch();  
             if (this.$v.$invalid) { 
                 this.$nextTick(function(){
                   $('.error.dirty').each(function(index){
                     $(this).focus(); return false;   
                  }); 
               }); 
              } else {
                // Submit the form here
            } 
        },       
     status(validation) {
    	return {
      	error: validation.$error,
        dirty: validation.$dirty
      }
    },     
    addPeople: function () {
    this.familylists.push(Vue.util.extend({}, this.familylist)); 
    },
    removePeople: function (index) {
    Vue.delete(this.familylists, index);
    },
   addDeed: function () { 
    this.famerdetaillists.deeds.push(Vue.util.extend({}, this.deed)); 
    },
    removeDeed: function (index) {
    Vue.delete(this.famerdetaillists.deeds, index);
    },
   addNorsor3kors: function () { 
    this.famerdetaillists.norsor3kors.push(Vue.util.extend({}, this.deed)); 
    },
    removeNorsor3kors: function (index) {
    Vue.delete(this.famerdetaillists.norsor3kors, index);
    },
   addSpoks: function () { 
    this.famerdetaillists.spoks.push(Vue.util.extend({}, this.deed)); 
    },
    removeSpoks: function (index) {
    Vue.delete(this.famerdetaillists.spoks, index);
    },
   addChapter5s: function () { 
    this.famerdetaillists.chapter5s.push(Vue.util.extend({}, this.deed)); 
    },
    removeChapter5s: function (index) {
    Vue.delete(this.famerdetaillists.chapter5s, index);
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