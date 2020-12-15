<?php
require_once '../../bootstart.php';    
require ROOT . '/core/security.php';
$id=@$_GET['id']; 
$row= $db::table("tbl_mas_group_occup")  
    ->where('goccup_code', '=', $id)
    ->select($db::raw("goccup_code,goccup_name,goccup_desc,f_status"))->first();
    
 if(isset($row->goccup_code)){ 
 ?>
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default"> 
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>กลุ่มอาชีพ :</label>
                  <input type="text" name="txtMoo" readonly value="<?=$row->goccup_name?>" id="txtMoo" class="form-control" placeholder="กลุ่มอาชีพ ...">
                </div>
                <!-- /.form-group -->
              </div> 

              <div class="col-md-6">
                <div class="form-group">
                  <label>รายละเอียดพอสังเขป :</label>
                  <textarea class="form-control" name="txtDesc" id="txtDesc" rows="2" readonly placeholder="รายละเอียดพอสังเขป  ..."><?=$row->goccup_desc?> </textarea>
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
 
      </div><!-- /.container-fluid -->
    </section>
 <?php }else{
?>
<h4 class="modal-title">ไม่พบแสดงข้อมูล!</h4>
<?php
 }?>