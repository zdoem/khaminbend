<?php
defined('ROOT') or exit('No access allowed'); 

defined('ROOTJS')  OR define('ROOTJS', realpath(__DIR__."/..")); 
require_once ROOTJS.'/bootstart.php';
?> 
<?php 
   switch (ENV) {
         case 'prd':
               ?> 
			   <!-- jQuery -->
				<script src="assets/plugins/jquery/jquery.min.js"></script>
				<!-- Bootstrap 4 -->
				<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
				<!-- AdminLTE App -->
				<script src="assets/js/adminlte.min.js"></script>
               <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.runtime.min.js" integrity="sha256-QSjTKFyl+0AHjs8OSm1238CRMQWixK8z7ymX/81u7i0=" crossorigin="anonymous"></script>   
               <?php
               break;  
        case 'dev':
               ?> 
               <!-- jQuery -->
				<script src="assets/plugins/jquery/jquery.min.js"></script>
				<!-- Bootstrap 4 -->
				<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
				<!-- AdminLTE App -->
				<script src="assets/js/adminlte.min.js"></script>
               <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js" integrity="sha256-ufGElb3TnOtzl5E4c/qQnZFGP+FYEZj5kbSEdJNrw0A=" crossorigin="anonymous"></script> 
               <?php
               break; 
   }
?>