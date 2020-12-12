<?php
 require 'bootstart.php';   
 require_once 'components/header.php'; 

$ID=filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); 
 // fetch data for update 
$rows_edit=$db::table("tbl_mas_vilage") 
->where('vil_id','=',$ID) 
->select($db::raw("
      vil_moo,vil_name,vil_desc,water,water_desc,water_tap,water_tap_desc,bowels,bowels_desc
     ,public_fire,public_fire_desc,road,road_desc,community_forest,community_forest_desc,learning,learning_desc,other,f_status  
    "))->first(); 

 if(is_null($rows_edit)){
  ?>
  <script type="text/javascript"> 
   Swal.fire({
    title: 'ไม่พบข้อมูลที่ต้องการแก้ไข!',
    showDenyButton: false,
    showCancelButton: false,
    confirmButtonText: `OK`  
  }).then((result) => {
     window.location = "./villageList.php";
  });  
  </script>
  <?php
  exit();
 }
?> 
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>แก้ไขข้อมูลหมู่บ้าน</h1>
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
      <input type="hidden" name="id" value="<?=@$_GET['id']?>">
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
                  <label>หมู่ที่ :</label>
                  <input type="number" name="txtMoo" id="txtMoo" class="form-control" readonly required pattern="\d*" title="ตัวเลขเท่านั้น" value="<?=$rows_edit->vil_moo?>" placeholder="หมู่ที่ ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>ชื่อหมู่บ้าน :</label>
                  <input type="text" name="txtVillageName" id="txtVillageName" required class="form-control" value="<?=$rows_edit->vil_name?>" placeholder="ชื่อหมู่บ้าน...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>รายละเอียดพอสังเขป :</label>
                  <textarea class="form-control" name="txthomeDesc" id="txthomeDesc" rows="2"   placeholder="รายละเอียดพอสังเขป  ..."><?=$rows_edit->vil_desc?></textarea>
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
                  <input value="<?=$rows_edit->water?>" type="number" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nWater" id="nWater" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งน้ำ:</label>
                  <textarea class="form-control bg-light" name="waterDesc" id="waterDesc" rows="1" placeholder="รายละเอียดแหล่งน้ำ  ..."><?=$rows_edit->water_desc?></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-white">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาผิวดิน :</label>
                  <input value="<?=$rows_edit->water_tap?>" type="number" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="water_tap" id="water_tap" class="form-control" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาผิวดิน :</label>
                  <textarea class="form-control" name="water_tap_desc" id="water_tap_desc" rows="1" placeholder="รายละเอียดประปาผิวดิน ..."><?=$rows_edit->water_tap_desc?></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาบาดาล :</label>
                  <input value="<?=$rows_edit->bowels?>" type="number" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="bowels" id="bowels" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาบาดาล :</label>
                  <textarea class="form-control bg-light" name="bowels_desc" id="bowels_desc" rows="1" placeholder="รายละเอียดประปาบาดาล ..."><?=$rows_edit->bowels_desc?></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ไฟสาธารณะ :</label>
                  <input value="<?=$rows_edit->public_fire?>" type="number" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nElectriclight" id="nElectriclight" class="form-control" placeholder="ไฟสาธารณะจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดไฟสาธารณะ :</label>
                  <textarea  class="form-control" name="ElectriclightDesc" id="ElectriclightDesc" rows="1" placeholder="รายละเอียดไฟสาธารณะ ..."><?=$rows_edit->public_fire_desc?></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ถนน :</label>
                  <input value="<?=$rows_edit->road?>" type="number" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nRoad" id="nRoad" class="form-control bg-light" placeholder="ถนนจำนวน...เส้น">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดถนน :</label>
                  <textarea  class="form-control bg-light" name="RoadDesc" id="RoadDesc" rows="1" placeholder="รายละเอียดถนน ..."><?=$rows_edit->road_desc?></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ป่าชุมชน  :</label>
                  <input value="<?=$rows_edit->community_forest?>" type="number" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nCommunityForest" id="nCommunityForest" class="form-control" placeholder="ป่าชุมชนจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดป่าชุมชน :</label>
                  <textarea class="form-control" name="CommunityForestDesc" id="CommunityForestDesc" rows="1" placeholder="รายละเอียดป่าชุมชน ..."><?=$rows_edit->community_forest_desc?></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row" bg-light>
              <div class="col-md-6">
                <div class="form-group">
                  <label>แหล่งการเรียนรู้ทางการเกษตร :</label>
                  <input value="<?=$rows_edit->learning?>" type="number" pattern="\d*" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="nLearning" id="nLearning" class="form-control bg-light" placeholder="แหล่งการเรียนรู้ทางการเกษตรจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งการเรียนรู้ทางการเกษตร :</label>
                  <textarea  class="form-control bg-light" name="LearningDesc" id="LearningDesc" rows="1" placeholder="รายละเอียดแหล่งการเรียนรู้ทางการเกษตร ..."><?=$rows_edit->learning_desc?></textarea>
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

                    <textarea  class="form-control" name="txtOther" id="txtOther" rows="1" placeholder="อื่นๆ ..."><?=$rows_edit->other?></textarea>
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