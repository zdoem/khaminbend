var app = new Vue({
	el: '#app',
	data:{
		successMessage: "",
		errorMessage: "",
		datainput: {
            txtHouseNo:null, 
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            txtHouseholder:null,
            
        }
	},

	methods:{ 
		keymonitor: function(event) {
       		if(event.key == "Enter"){
         		app.checkLogin();
        	}
		   },  
		checkLogin: function(){  
			var _this=this;
		   //if(_this.logDetails.username==null||_this.logDetails.password==null||_this.logDetails.username.length<=0||_this.logDetails.password.length<=0){return;}
		   //var logForm =$("#frm_login").serialize();    
           
		},   
		clearMessage: function(){
			app.errorMessage = '';
			app.successMessage = '';
		}

	}
});