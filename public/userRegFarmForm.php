<?php
 require 'bootstart.php';   
 require ROOT . '/core/security.php';
 require_once 'components/headerPortal.php';  
 
 //require 'bootstart.php';
 require ROOT . '/core/security.php';
 //require_once 'components/header.php';
 
 $listmas_dept = $db::table("tbl_departments")
 ->select($db::raw("dept_code,dept_name,dept_desc"))
 ->where('f_status', '=', 'A')
 ->orderBy('dept_name', 'asc')
 ->get()->toArray();
 
 $listmas_role = $db::table("tbl_role")
 ->select($db::raw("role_code,role_name,role_desc"))
 ->where('f_status', '=', 'A')
 ->orderBy('role_name', 'asc')
 ->get()->toArray();
 
?> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
//$(document).ready(function() { 
//$("#btn").click(function() { 
	$(document).ready(function() { 
         $("#btnCancel").click(function(e){  
        	 window.location = "portal.php";
         });
    });       
	
     $(document).ready(function() { 
         $("#btnVerify").click(function(e){    
             e.preventDefault();
             disableButton();  
    	     //alert("xxx :"+$("#userId").val());
    		 if($("#userId").val()== ''){
    			 alert("กรุณาระบุ UserId ที่ต้องการตรวจสอบด้วย !");
    			 $("#userId").focus();			 
    		 }else{	          
    	          $.ajax({
    	            type: 'post',
    	            dataType: 'JSON',
    	            url: 'handler/userRegVerify.php',
    	            data: $('form').serialize(),
    	            success: function (jsonRes) {
    	               //alert('form was submitted');
    	            	var len = jsonRes.length;
    	            	var xStatus = jsonRes[0].xStatus;
    	            	var xMsg = jsonRes[0].xDesc;
    	            	enableButton();
    	            	//alert(len);
    	            	
    	            	if(xStatus=='Y'){ //available
    	            		$("#msgVerfiy" ).html("<span class='bg-success text-white'>"+xMsg+"</span>");
    	            		enableSubmit();
    	            	}else if(xStatus=='N'){ //No use id
    	            		$("#msgVerfiy" ).html("<span class='bg-danger text-white'>"+xMsg+"</span>");
    	            		$("#userId").focus();	
    	            		$('#btnSubmit').prop('disabled', true);
    	            	}
    	            	/*
    	            	msgVerfiy
                      <span class="bg-success text-white">Looks good!</span>
    	            	for(var i=0; i<len; i++){
    	                     var xid = jsonRes[i].xId;
    	                     var xuserId = jsonRes[i].xUserId;
    	                     var xStatus = jsonRes[i].xStatus;
    	                     //var email = response[i].email;
    	            	 }*/
    	           	    //alert(jsonRes[0].xUserId+","+jsonRes[0].xDesc+","+jsonRes[0].xStatus);
    	            }
    	          });			 
    		 }
        });
      });

      $(document).ready(function(){
    	  $('#userId').keyup(function () {
    		    if ($(this).val() == '') {
    		        //Check to see if there is any text entered
    		        // If there is no text within the input ten disable the button
    		        $('#btnVerify').prop('disabled', true);
    		    } else {
    		        //If there is text in the input, then enable the button
    		        $('#btnVerify').prop('disabled', false);
    		    }
    		});         
      });

      function disableButton(){
	        // If there is no text within the input ten disable the button
	        $('#btnVerify').prop('disabled', true);
      }
      function enableButton(){
	        //If there is text in the input, then enable the button
	        $('#btnVerify').prop('disabled', false);
      }
      function enableSubmit(){
	       //If there is text in the input, then enable the button
	       $('#btnSubmit').prop('disabled', false);
      }
      $(document).ready(function(){
    	  $('#btnVerify').prop('disabled', true);
    	  $('#btnSubmit').prop('disabled', true);
      });
    </script>
    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ลงทะเบียนผู้ใช้งาน<small></small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  
              <li class="breadcrumb-item"><a href="#">ลงทะเบียนผู้ใช้งาน</a></li>
              <!--<li class="breadcrumb-item active">Top Navigation</li>-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   

    <!-- Main content -->
    <div class="content">
      <form action="handler/userRegFarm.php" method="post" role="form" data-toggle="validator">  
       <input type="hidden" id="cmd" name="cmd" value="I">
       <div class="container">

		<div class="row">
          <!-- left column -->
          <div class="col-sm-12">

            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">ลงทะเบียนผู้ใช้งาน</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" >
                <div class="card-body">
				   <div class="form-group row">
                    <label for="userId" class="col-sm-2 col-form-label">ชื่อ Login ในระบบ</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="userId" name="userId" required="required" placeholder="user Id"
                      pattern="^[_A-z0-9]{1,}$" maxlength="15">
                      <span id="msgVerfiy"></span>
                    </div>
					 <div class="col-sm-2">
                      <button type="button" id="btnVerify" class="btn btn-info">ตรวจสอบชื่อ Login</button>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="txtPwd" class="col-sm-2 col-form-label">รหัสผ่าน</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="txtPwd" name="txtPwd"  placeholder="Password" required="required">
                    </div>
                  </div>
				   <div class="form-group row">
                    <label for="txtfName" class="col-sm-2 col-form-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="txtfName" name="txtfName" placeholder="ชื่อ" required="required">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="inputName" name="txtlName" placeholder="นามสกุล" required="required">
                    </div>
                  </div>				  

				  <div class="form-group row">
                    <label for="txtEmail" class="col-sm-2 col-form-label">อีเมลย์</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="aaaa@ddd.com">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="txtMobile" class="col-sm-2 col-form-label">เบอร์มือถือ</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="txtMobile" name="txtMobile" placeholder="08xxxxxxxx">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="txtPosition" class="col-sm-2 col-form-label">ตำแหน่ง</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="txtPositon" name="txtPosition" placeholder="ตำแหน่ง">
                    </div>
                  </div>	
				  <div class="form-group row">
                    <label for="deptId" class="col-sm-2 col-form-label">แผนก/กอง</label>
                    <div class="col-sm-6">
                    <select class="form-control" id="deptId" name="deptId" readonly required="required">
                    <?php 
                    $selectedx = "";
                    foreach ($listmas_dept as $k => $v) { 
                        $selectedx = "";
                        if($v->dept_code == '01')
                            $selectedx = "selected"
       
                    ?>
                        <option value="<?=$v->dept_code?>" <?=$selectedx?>><?=$v->dept_code?> <?=$v->dept_name?></option>
                      <?php
                    }
                    ?>
                    </select> 
  					<!--  
  					<select class="form-control" id="deptId" name="deptId">
                        <option value="">กองส่งเสริมการเกษตร</option>
                        <option value="">สำนักงานปลัด อบต. </option>
                        <option value="">กองช่าง</option>
    					<option value="">กองการศึกษาและศาสนา</option>
    					<option value="">กองสวัสดิการสังคม</option>
    					<option value="">ฝ่ายดูแลระบบ</option>
					</select>  
					-->                      
                    </div>
                  </div>	
				  <div class="form-group row">
                    <label for="roleId" class="col-sm-2 col-form-label">บทบาท</label>
                    <div class="col-sm-6">
                    <select class="form-control" id="roleId" name="roleId" required="required">
                    <option value="">---กรุณาเลือกบทบาท---</option>
                    <?php 
                    foreach ($listmas_role as $k => $v) {
                    ?>
                        <option value="<?=$v->role_code?>"><?=$v->role_name?></option>
                     <?php
                    }
                    ?>
                    </select>
                    <!-- 
					<select class="form-control" id="roleId" name="roleId">
                        <option value="">User</option>
                        <option value="">Supervisor</option>
                        <option value="">Admin</option>
					</select>   
					 -->                   
                    </div>
                  </div>				  

                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer row">
                  <div class="col-md-6">
					<button type="submit" id="btnSubmit" class="btn btn-info float-right">ลงทะเบียน</button>
				  </div>
                  <div class="col-md-6">
					<button type="submit" id="btnCancel" class="btn btn-default">Cancel</button></div>
				  </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
		  

      </div><!-- /.container-fluid -->
    </div>
     </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

<?php
 require_once 'components/footerX.php';  
?>