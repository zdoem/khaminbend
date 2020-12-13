 $(function(){
	app_init();
   $(document).ajaxComplete(function( event, xhr, settings ) { 
       switch(xhr.status) {
            case 301: case 404: case 403: redirect_to_login(); break;
        }
   });  

});
function app_init(){
  
}
function redirect_to_login(){
   window.location.href = "/login.php";
}
