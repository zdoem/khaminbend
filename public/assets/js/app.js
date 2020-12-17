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
