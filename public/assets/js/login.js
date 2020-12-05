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
			var _this=this;
		   //if(_this.logDetails.username==null||_this.logDetails.password==null||_this.logDetails.username.length<=0||_this.logDetails.password.length<=0){return;}
		   //var logForm =$("#frm_login").serialize();    
                $.post('handler/login.php', _this.logDetails, function(data) { 
                    Swal.fire({
                        title: 'Loggin in....',
                        text: 'รอซักครู่ค่ะ',
                        footer: 'ระบบกำลังตรวจสอบข้อมูลผู้ใช้งาน',
						timer: 2000,
						showConfirmButton:false,
                        timerProgressBar: true,
                        onBeforeOpen: function() {
                            Swal.showLoading();
                        },
                        onClose:function() {
                            
                        }
                    }).then(function(result){ 
                        if (result.dismiss === Swal.DismissReason.timer) { 
                        }
                        $("#xhtml").html(data)
                    })
                }); 
		},   
		clearMessage: function(){
			app.errorMessage = '';
			app.successMessage = '';
		}

	}
});