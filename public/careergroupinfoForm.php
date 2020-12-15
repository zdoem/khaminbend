<?php
 require 'bootstart.php';   
 require ROOT . '/core/security.php';
 require_once 'components/header.php';    
?> 
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>เพิ่มข้อมูลกลุ่มอาชีพ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">หน้าจัดการข้อมูลกลุ่มอาชีพ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
     <section class="content">
      <form action="handler/careergroupinfo/careergroupinfoSave.php" method="post">  
      <?= \Volnix\CSRF\CSRF::getHiddenInputString('token_careergroupinfo_frm') ?>
      <input type="hidden" id="action" name="action" value="1">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลกลุ่มอาชีพ</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อมูลกลุ่มอาชีพ :</label>
                  <input type="text" name="goccup_name" id="goccup_name" class="form-control" required  title="กรุณากรอกกลุ่มอาชีพและเป็นตัวเลขเท่านั้น" placeholder="กลุ่มอาชีพ ...">
                </div> 
              </div> 
              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดพอสังเขป :</label>
                  <textarea class="form-control" name="goccup_desc" id="goccup_desc" rows="2" placeholder="รายละเอียดพอสังเขป  ..."></textarea>
                </div> 
              </div> 
               
            </div>
            <!-- /.row -->
            <div class="row">

              <div class="col-md-3">
                <div class="form-group"> 
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary8" value="A" name="f_status" checked>
                      <label for="radioPrimary8">เปิด </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary9" value="C" name="f_status">
                      <label for="radioPrimary9">ปิด </label> 
                    </div>
                  </div>
                </div>
                </div> 

            </div>
          </div>
          
          <div class="card-footer"> 
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            <button type="reset" class="btn btn-warning">รีเซ็ท</button>
          </div>

        </div>
        <!-- /.card -->
  
        <!-- /.row -->
      </div><!-- /.container-fluid -->
     </form>
    </section>
    <!-- /.content -->

<?php
 require_once 'components/footer.php';  
?>