 $(function(){
	app_init();
	$.datepicker._gotoToday = function(id) {
          var target = $(id);
          var inst = this._getInst(target[0]); 
          var date = new Date();
          this._setDate(inst,date);
          this._hideDatepicker(); 
    };
   $(document).ajaxComplete(function( event, xhr, settings ) { 
       switch(xhr.status) {
            case 403: redirect_to_login(); break;
        }
   });  

});
function app_init(){
  
}
function redirect_to_login(){
   window.location.href = "/login.php";
}
function validateEmail(email) {
    var xre = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return xre.test(String(email).toLowerCase());
}