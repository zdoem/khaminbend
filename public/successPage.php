<?php
 require 'bootstart.php';   
 require ROOT . '/core/security.php';
 require_once 'components/headerPortal.php';  
 
 
 $pMessage='';$card_status='danger';$card_text='Error';
 
 switch (@$_GET['status']) {
     case "OK":$pMessage='บันทึกข้อมูลเรียบร้อย!';$card_status='success';$card_text='success';  break;
     case "duplicate":$pMessage='ข้อมูลซ้ำจากที่มีอยู่ไม่สามรถบันทึกข้อมูลได้!';  break;
     case "notfound":$pMessage='ข้อมูลซ้ำจากที่มีอยู่ไม่สามรถบันทึกข้อมูลได้!';  break;
     case "deleted":$pMessage='ลบข้อมูลสำเร็จ!';  break;
     case "deletefail":$pMessage='ลบข้อมูลไม่สำเร็จ!';  break;
     default:$pMessage='Error!';
 }
?> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() { 
    $("#btnHome").click(function(e){  
   	 window.location = "index.php";
    });
}); 

$(document).ready(function() { 
    $("#btnOk").click(function(e){  
   	 window.location = "<?=@$_GET['refer_urlmain']?>";
    });
}); 
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">MESSAGE <small></small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  
              <li class="breadcrumb-item"><a href="#">บันทึกข้อมูลสำเร็จ</a></li>
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
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">บันทึกข้อมูลสำเร็จ</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->
              <form class="form-horizontal" >
                <div class="card-body">
                <div class="form-group row">
                </div>
                 <div class="form-group row">
                  <div class="col-sm-12">
					 <p><h4>บันทึกข้อมูลสำเร็จ</h4></p>
                    </div>
                </div>
                <div class="form-group row">
                </div>

				</div>
                <div class="card-footer row">
                  <div class="col-md-6">
					<button type="button" id="btnOk" class="btn btn-success float-right">OK</button>
				  </div>
                  <div class="col-md-6">
					<button type="button" id="btnHome" class="btn btn-info">Home</button></div>
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
  <br>
  <br>
    <br>
  <br>

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