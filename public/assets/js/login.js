var app = new Vue({
	el: '#app',
	data:{
		successMessage: "",
		errorMessage: "",
		logDetails: {username:null, password:null}
	},

	methods:{ 
		keymonitor: function(event) {
       		if(event.key == "Enter"){
         		app.checkLogin();
        	}
		   }, 
		   
		checkLogin: function(){ 
			//var logForm = app.toFormData(app.logDetails); 
			var _this=this;
		   //if(_this.logDetails.username==null||_this.logDetails.password==null||_this.logDetails.username.length<=0||_this.logDetails.password.length<=0){return;}
			var logForm =$("#frm_login").serialize(); 
			axios.post('../main/api/login.php', logForm)
				.then(function(response){ 
					$("input[name*='csrf_token']").val(response.data.csrf_token); 
					if(response.data.status=='success'){
						app.successMessage = response.data.msg;
						app.logDetails = {username:null, password:null};
						setTimeout(function(){
						 	window.location.href="main/index.php";
						},1000);  
					} 
					else{  
						app.errorMessage = response.data.msg; 	
					}
				});
		},

		toFormData: function(obj){
			var form_data = new FormData();
			for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function(){
			app.errorMessage = '';
			app.successMessage = '';
		}

	}
});