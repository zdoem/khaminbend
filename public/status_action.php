<?php
 require 'bootstart.php';   
 require ROOT . '/core/security.php';
 require_once 'components/header.php';   
 
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
 <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><?=$pMessage?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                	<em class="fa fa-home"></em>
                <a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$pMessage?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
          <section class="content">
      <div class="container-fluid">


        <!-- /.row xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

		<div class="card card-<?=$card_status?>">
              <div class="card-header">
                <h3 class="card-title"><?=$card_text?> </h3> 
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <?=$pMessage?> 
			   <br>
				<div class="row no-print">
                <div class="col-12">
 
                  <a href="<?=@$_GET['refer_urlmain']?>" type="button" class="btn btn-<?=$card_status?> float-center"><i class="far fa-<?=$card_status?>"></i> OK
                  </a>
                  <!--  <a href="<?//=Get_domain()?>/<?//=@$_GET['refer_urlmain']?>" type="button" class="btn btn-primary float-center"><i class="far fa-home"></i>HOME -->
				  <a href="index.php" type="button" class="btn btn-primary float-center"><i class="far fa-home"></i>HOME
                  </a>
                </div>
              </div>
              </div>
              <!-- /.card-body -->
         </div>
	
        <!-- Main row -->

        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

<?php
 require_once 'components/footer.php';  
?>