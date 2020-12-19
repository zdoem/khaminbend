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
            <h1>เพิ่มข้อมูลหมู่บ้าน</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">หน้าจัดการข้อมูลหมู่บ้าน</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
     <section class="content">
      <form action="handler/village/village.php" method="post">  
      <?= \Volnix\CSRF\CSRF::getHiddenInputString('token_village_frm') ?>
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลหลักของหมู่บ้าน</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>หมู่ที่ <span class="requiredfeilds">*</span></label>
                  <input type="number" name="txtMoo" id="txtMoo" class="form-control" required pattern="\d*" title="กรุณากรอกหมู่ที่และเป็นตัวเลขเท่านั้น" placeholder="หมู่ที่ ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>ชื่อหมู่บ้าน <span class="requiredfeilds">*</span></label>
                  <input type="text" name="txtVillageName" id="txtVillageName" required class="form-control" title="กรุณากรอกชื่อหมู่บ้าน" placeholder="ชื่อหมู่บ้าน...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>รายละเอียดพอสังเขป :</label>
                  <textarea class="form-control" name="txthomeDesc" id="txthomeDesc" rows="2" placeholder="รายละเอียดพอสังเขป  ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-header -->

          <!-- /.card-body
          <div class="card-footer">
            xxx about  the plugin.
          </div>-->
        </div>
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อทั่วไปของหมู่บ้าน</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row bg-light">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>แหล่งน้ำ :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nWater" id="nWater" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งน้ำ:</label>
                  <textarea class="form-control bg-light" name="waterDesc" id="waterDesc" rows="1" placeholder="รายละเอียดแหล่งน้ำ  ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-white">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาผิวดิน :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="water_tap" id="water_tap" class="form-control" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาผิวดิน :</label>
                  <textarea class="form-control" name="water_tap_desc" id="water_tap_desc" rows="1" placeholder="รายละเอียดประปาผิวดิน ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาบาดาล :</label>
                  <input type="number" value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="bowels" id="bowels" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาบาดาล :</label>
                  <textarea class="form-control bg-light" name="bowels_desc" id="bowels_desc" rows="1" placeholder="รายละเอียดประปาบาดาล ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ไฟสาธารณะ :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nElectriclight" id="nElectriclight" class="form-control" placeholder="ไฟสาธารณะจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดไฟสาธารณะ :</label>
                  <textarea class="form-control" name="ElectriclightDesc" id="ElectriclightDesc" rows="1" placeholder="รายละเอียดไฟสาธารณะ ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ถนน :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nRoad" id="nRoad" class="form-control bg-light" placeholder="ถนนจำนวน...เส้น">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดถนน :</label>
                  <textarea class="form-control bg-light" name="RoadDesc" id="RoadDesc" rows="1" placeholder="รายละเอียดถนน ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ป่าชุมชน  :</label>
                  <input type="number"  value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nCommunityForest" id="nCommunityForest" class="form-control" placeholder="ป่าชุมชนจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดป่าชุมชน :</label>
                  <textarea class="form-control" name="CommunityForestDesc" id="CommunityForestDesc" rows="1" placeholder="รายละเอียดป่าชุมชน ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row" bg-light>
              <div class="col-md-6">
                <div class="form-group">
                  <label>แหล่งการเรียนรู้ทางการเกษตร :</label>
                  <input type="number" value="0" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nLearning" id="nLearning" class="form-control bg-light" placeholder="แหล่งการเรียนรู้ทางการเกษตรจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งการเรียนรู้ทางการเกษตร :</label>
                  <textarea class="form-control bg-light" name="LearningDesc" id="LearningDesc" rows="1" placeholder="รายละเอียดแหล่งการเรียนรู้ทางการเกษตร ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>



            <!-- /.row -->
            <div class="row"> 

              <div class="col-md-6">
                <div class="form-group">
                  <label>อื่นๆ :</label>

                    <textarea class="form-control" name="txtOther" id="txtOther" rows="1" placeholder="อื่นๆ ..."></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- row -->

          </div>
          <!-- /.card-header -->

          <!-- /.card-body   -->
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