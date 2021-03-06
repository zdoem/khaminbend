<?php
defined('ROOT') or exit('No access allowed'); 

defined('ROOTJS')  OR define('ROOTJS', realpath(__DIR__."/..")); 
require_once ROOTJS.'/bootstart.php';
?> 
<?php 
   switch (ENV) {
         case 'prd':
               ?> 
               <!-- REQUIRED SCRIPTS -->
               <!-- jQuery -->
               <script src="assets/plugins/jquery/jquery.min.js"></script>
               <script src="assets/js/jquery-migrate.min.js"></script> 
               <script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script> 
               <!-- Bootstrap -->
               <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
               <!-- overlayScrollbars -->
               <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
               <!-- PAGE PLUGINS -->
               <!-- jQuery Mapael -->

               <script src="assets/js/sweetalert2.min.js"></script> 
               <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> 
               <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
               <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
               <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
               <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
               <script src="assets/plugins/moment/moment.min.js"></script>  
               <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
                  <!-- AdminLTE App -->
               <script src="assets/js/adminlte.js"></script>
               <script src="assets/js/vue.runtime.min.js"></script>   
               <script src="assets/js/vuelidate.min.js"></script>
               <script src="assets/js/validators.min.js"></script> 
               <script src="assets/js/app.js"></script> 
               <?php
               break;  
              case 'dev':
               ?> 
                 <!-- REQUIRED SCRIPTS -->
                  <!-- jQuery -->
                  <script src="assets/plugins/jquery/jquery.min.js"></script>
                  <script src="assets/js/jquery-migrate.min.js"></script> 
                  <script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script> 
                  <!-- Bootstrap -->
                  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                  <!-- overlayScrollbars -->
                  <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
                  <!-- PAGE PLUGINS -->
                  <!-- jQuery Mapael -->

                  <script src="assets/js/sweetalert2.min.js"></script> 
                  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> 
                  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
                  <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                  <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                  <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                  <script src="assets/plugins/moment/moment.min.js"></script>
                  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
                     <!-- AdminLTE App -->
                  <script src="assets/js/adminlte.js"></script>
                  <script src="assets/js/vue.js"></script>
                  <script src="assets/js/vuelidate.min.js"></script> 
                  <script src="assets/js/validators.min.js"></script>
                  <script src="assets/js/app.js"></script>
               <?php
               break; 
   }
?>