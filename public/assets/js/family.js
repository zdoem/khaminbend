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
var required = validators.required;
var maxLength = validators.maxLength;
var minLength=validators.minLength;

window.app = new Vue({
  el: '#app',
  data: { 
    successMessage: "",text: '',
    errorMessage: "", 
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
        mooHouse:'',
        txtSubDstrict:'',
        txtDistrict:'',
        txtProvince:'', 
        txtPostalCode:''
    },
    familylist:{ prefix: 1,txtFName: '',txtLName:'',txtCitizenId:'' ,xFstatusRd:1,sexRd:1,txtNational:'',religion:'',birthday:''
    ,educationlevel:'',homerelations:'',careergroup:'',careeranother:'',careermain:'',careersecond:'',netIncome:''},
    familylists:[],
    famerdetaillists:{
        deed:[],
        norsor3kor:[],
        spok:[],
        chapter5:[],
        another:''
    },
    houseinforgeneral:{

    },
    environmentdata:{

    }
    ,researchdate:new Date().getTime() 
  },
  mounted: function () { 
    this.familylists = JSON.parse(this.$el.dataset.familylists);
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
  },
   validations: {
    familylist:{
        $each: {
         txtFName: { required }
        } 
    },   
    houseinfor:{
        txtHouseId:{
           required,
           minLength: minLength(5) 
        }
    },   
  	text: {
    	required,
        minLength: minLength(5)
    }
  },
  methods: { 
    keymonitor: function(event) {
       		if(event.key == "Enter"){
         		// app.checkLogin();
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