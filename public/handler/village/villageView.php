<?php
require_once '../../bootstart.php';    
require ROOT . '/core/security.php';
$id=@$_GET['id']; 
$row= $db::table("tbl_mas_vilage")  
    ->where('vil_id', '=', $id)
    ->select($db::raw("
    vil_moo,vil_name,vil_desc,water,water_desc,water_tap,water_tap_desc,bowels,bowels_desc
   ,public_fire,public_fire_desc,road,road_desc,community_forest,community_forest_desc,learning,learning_desc,other,d_create,d_update,create_by,f_status
   "))->first();
    
 if(isset($row->vil_moo)){ 
 ?>
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลหน้าหลักของหมู่บ้าน</h3>

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
                  <input type="text" name="txtMoo" readonly value="<?=$row->vil_moo?>" id="txtMoo" class="form-control" placeholder="หมู่ที่ ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>ชื่อหมู่บ้าน :</label>
                  <input type="text" name="txtVillageName" readonly value="<?=$row->vil_name?>" id="txtVillageName" class="form-control" placeholder="ชื่อหมู่บ้าน...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>รายละเอียดพอสังเขป :</label>
                  <textarea class="form-control" name="txtDesc" id="txtDesc" rows="2" readonly placeholder="รายละเอียดพอสังเขป  ..."><?=$row->vil_desc?>
				  </textarea>
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
                  <input type="text" readonly value="<?=$row->water?>" name="nWater" id="nWater" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งน้ำ:</label>
                  <textarea class="form-control bg-light" readonly name="waterDesc" id="waterDesc" rows="1" placeholder="รายละเอียดแหล่งน้ำ  ...">
                  <?=$row->water_desc?>
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-white">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาผิวดิน :</label>
                  <input type="text" readonly value="<?=$row->water_tap?>" name="nPlumbing" id="nPlumbing" class="form-control" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาผิวดิน :</label>
                  <textarea class="form-control" readonly name="plumbingDesc" id="plumbingDesc" rows="1" placeholder="รายละเอียดประปาผิวดิน ...">
                  <?=$row->water_tap_desc?>
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ประปาบาดาล :</label>
                  <input type="text" readonly value="<?=$row->bowels?>" name="nUndergroundWater" id="nUndergroundWater" class="form-control bg-light" placeholder="แหล่งน้ำจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดประปาบาดาล :</label>
                  <textarea class="form-control bg-light" readonly name="UndergroundWaterDesc" id="UndergroundWaterDesc" rows="1" placeholder="รายละเอียดประปาบาดาล ...">
                  <?=$row->bowels_desc?>
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>ไฟสาธารณะ :</label>
                  <input type="text" readonly value="<?=$row->public_fire?>" name="nElectriclight" id="nElectriclight" class="form-control" placeholder="ไฟสาธารณะจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดไฟสาธารณะ :</label>
                  <textarea class="form-control" readonly name="ElectriclightDesc" id="ElectriclightDesc" rows="1" placeholder="รายละเอียดไฟสาธารณะ ...">
                  <?=$row->public_fire_desc?>
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row bg-light">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ถนน :</label>
                  <input type="text" readonly value="<?=$row->road?>" name="nRoad" id="nRoad" class="form-control bg-light" placeholder="ถนนจำนวน...เส้น">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดถนน :</label>
                  <textarea class="form-control bg-light" readonly name="RoadDesc" id="RoadDesc" rows="1" placeholder="รายละเอียดถนน ...">
                  <?=$row->road_desc?>
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>ป่าชุมชน  :</label>
                  <input type="text" readonly value="<?=$row->community_forest?>" name="nCommunityForest" id="nCommunityForest" class="form-control" placeholder="ป่าชุมชนจำนวน...แห่ง">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดป่าชุมชน :</label>
                  <textarea class="form-control" readonly name="CommunityForestDesc" id="CommunityForestDesc" rows="1" placeholder="รายละเอียดป่าชุมชน ...">
                  <?=$row->community_forest_desc?>
                  </textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row" bg-light>
              <div class="col-md-6">
                <div class="form-group">
                  <label>แหล่งการเรียนรู้ทางการเกษตร :</label>
                  <input type="text" readonly value="<?=$row->learning?>" name="nLearning" id="nLearning" class="form-control bg-light" placeholder="แหล่งการเรียนรู้ทางการเกษตรจำนวน...จุด">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดแหล่งการเรียนรู้ทางการเกษตร :</label>
                  <textarea class="form-control bg-light" readonly name="LearningDesc" id="LearningDesc" rows="1" placeholder="รายละเอียดแหล่งการเรียนรู้ทางการเกษตร ...">
                  <?=$row->learning_desc?>
                  </textarea>
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

                    <textarea class="form-control" readonly name="txtOther" id="txtOther" rows="1" placeholder="อื่นๆ ..."><?=$row->other?></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- row -->

          </div>
          <!-- /.card-header -->

          <!-- /.card-body  
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            <button type="reset" class="btn btn-warning">รีเซ็ท</button>
          </div> -->

        </div>
        <!-- /.card -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
 <?php }else{
?>
<h4 class="modal-title">ไม่พบแสดงข้อมูล!</h4>
<?php
 }?>