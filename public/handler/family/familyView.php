<?php
require_once '../../bootstart.php';    
 
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
				<!-- SELECT2 EXAMPLE ข้อมูลครัวเรือน -->
				        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">ข้อมูลครัวเรือน [ที่อยู่ตามทะเบียนบ้าน]</h3>

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
                  <label>บ้านเลขที่ :</label>
                  <input type="text" name="txtHouseId" id="txtHouseId" class="form-control" placeholder="บ้านเลขที่  ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>หมู่ที่ - ชื่อหมู่บ้าน :</label>
					<select class="form-control">
						<option>หมู่ที่ 1 - บ้านแสลงคง</option>
						<option>หมู่ที่ 2 - บ้านตาแก</option>
						<option>หมู่ที่ 3 - บ้านโคกขมิ้น</option>
						<option>หมู่ที่ 4 - บ้านเขว้า</option>
						<option>หมู่ที่ 5 - บ้านตาพระ</option>
						<option>หมู่ที่ 6 - บ้านศรีสมบูรณ์</option>
						<option>หมู่ที่ 7 - บ้านลำเดง</option>
						<option>หมู่ที่ 8 -  บ้านหนองขอน</option>
						<option>หมู่ที่ 9 - บ้านพลับ</option>
						<option>หมู่ที่ 10 - บ้านโคกบัว</option>
						<option>หมู่ที่ 11 - บ้านโคกขมิ้น</option>
						<option>หมู่ที่ 12 - บ้านโคกเพชร</option>
						<option>หมู่ที่ 13 - บ้านทะเมนชัย</option>
						<option>หมู่ที่ 14 - บ้านพงษ์ศิริ</option>
						<option>หมู่ที่ 15 - บ้านหนองอุดม</option>
					  </select>

                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label>ตำบล :</label>
                     <input type="text"  name="txtSubDstrict" value="โคกขมิ้น" id="txtSubDstrict" class="form-control" placeholder="ตำบล  ...">
                 </div>
                 <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <!-- /.row -->           
             <div class="row">

               <div class="col-md-4">
                 <div class="form-group">
                   <label>อำเภอ:</label>
                   <input type="text"  name="txtDistrict" value="พลับพลาชัย  " id="txtDistrict" class="form-control" placeholder="อำเภอ  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <div class="form-group">
                   <label>จังหวัด:</label>
                   <input type="text"  name="txtProvince" value="บุรีรัมย์ " id="txtProvince" class="form-control" placeholder="จังหวัด  ...">
                 </div>
                 <!-- /.form-group -->
               </div>
                <div class="col-md-4">
                      <div class="form-group">
                          <label>รหัสไปรษณีย์:</label>
                          <input type="text"   name="txtPostalCode" value="31250" id="txtPostalCode" class="form-control" placeholder="รหัสไปรษณีย์  ...">
                      </div>
                        <!-- /.form-group -->
                  </div>
                <!-- /.col -->
             </div>

          </div>
          <!-- /.card-header -->

          <!-- /.card-body
          <div class="card-footer">
            xxx about  the plugin.
          </div>-->
        </div>
        <!-- /.card -->

				<!-- SELECT2 EXAMPLE ข้อมูลสมาชิกในครัวเรือน -->
				<div class="card card-default">
				  <div class="card-header">
					<h3 class="card-title">ข้อมูลสมาชิกในครัวเรือน</h3> &nbsp;  &nbsp;

					<div class="card-tools">
					  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
					  <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
					</div>
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body">
					<h5>ลำดับที่ : 1
					 </h5>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-group">
						  <label>คำนำหน้า:</label>
						  <select class="form-control">
							<option>เด็กชาย</option>
							<option>เด็กหญิง</option>
							<option>นาย</option>
							<option>นางสาว</option>
							<option>อื่นๆ </option>
						  </select>
						</div>
						<!-- /.form-group -->
					  </div>
					  <div class="col-md-3">
						<div class="form-group">
						  <label>ชื่อเจ้าบ้าน :</label>
						  <input  readonly type="text" name="txtFName" value="ประเดิม" id="txtFName" class="form-control" placeholder="ประเดิม  ...">
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						<div class="form-group">
						  <label>นามสกุล:</label>
						  <input  readonly type="text" name="txtLName" value="วงค์กระโซ่" id="txtLName" class="form-control" placeholder="วงค์กระโซ่  ...">
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						<div class="form-group">
						  <label>เลขที่ประจำตัวประชาชน  :</label>
							<input  readonly type="text" name="txtCitizenId" value="14904xxxx2528" id="txtCitizenId" class="form-control" placeholder="เลขที่ประจำตัวประชาชน  ...">
						</div>
						<!-- /.form-group -->
					  </div>

					</div>
					<!-- /row -->

					<div class="row">
					  <div class="col-md-3">
						<div class="form-group">
						  <label>สถานภาพ :</label>
						  <div class="form-group clearfix">
							<div class="icheck-primary d-inline">
							  <input  readonly type="radio" id="radioPrimary1" name="xFstatusRd" checked>
							  <label for="radioPrimary1">เจ้าบ้าน
							  </label>
							</div>
							<div class="icheck-primary d-inline">
							  <input  readonly type="radio" id="radioPrimary2" name="xFstatusRd">
							  <label for="radioPrimary2">ผู้อยู่อาศัย
							  </label>
							</div>
						  </div>
						</div>
						<!-- /.form-group -->
					  </div>
					  <div class="col-md-3">
						<div class="form-group">
						  <label>เพศ  :</label>
						  <div class="form-group clearfix">
							<div class="icheck-primary d-inline">
							  <input  readonly type="radio" id="radioPrimary3" name="sexRd" checked>
							  <label for="radioPrimary3">ชาย
							  </label>
							</div>
							<div class="icheck-primary d-inline">
							  <input  readonly type="radio" id="radioPrimary4" name="sexRd">
							  <label for="radioPrimary4">หญิง
							  </label>
							</div>
							<div class="icheck-primary d-inline">
							  <input  readonly type="radio" id="radioPrimary5" name="sexRd">
							  <label for="radioPrimary5">อื่นๆ
							  </label>
							</div>
						  </div>
						</div>
						<!-- /.form-group -->
					  </div>
					  <!-- /.col -->

					  <div class="col-md-3">
						<div class="form-group">
						  <label>สัญชาติ  :</label>
						  <input  readonly type="text" name="txtNational" value="ไทย " id="txtNational" class="form-control" placeholder="สัญชาติ  ...">
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						 <div class="form-group">
							<label>ศาสนา :</label>
							<select class="form-control">
							  <option>พุทธ</option>
							  <option>อิสลาม</option>
							  <option>คริสต์ศาสนา</option>
							  <option>อื่นๆ</option>
							</select>
						  </div>
						  <!-- /.form-group -->
						</div>
					   <!-- /.col -->
					</div>
					<!-- /row -->


					<div class="row">

					  <div class="col-md-3">
						<div class="form-group">
						  <label>วันเดือนปีเกิด :</label>
						  <div class="input-group date" id="reservationdate" data-target-input="nearest">
							  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
							  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
								  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
							  </div>
						  </div>
						</div>
						<!-- /.form-group -->
					  </div>
					  <!-- /.col -->

						<!-- /.col -->
						<div class="col-md-3">
						   <div class="form-group">
							  <label>ระดับการศึกษา :</label>
							  <select class="form-control">
								<option>ต่ำกว่าปริญญาตรี</option>
								<option>ปริญญาตรี</option>
								<option>ปริญญาโท</option>
								<option>ปริญญาเอก</option>
							  </select>
							</div>
							<!-- /.form-group -->
						  </div>
						 <!-- /.col -->
						 <div class="col-md-3">
							<div class="form-group">
							   <label>ความสัมพันธ์ในครัวเรือน  :</label>
							   <select class="form-control">
								 <option>หัวหน้าครอบครัว</option>
								 <option>สามี/ภรรยา</option>
								 <option>ลูก</option>
								 <option>บุตร</option>
								 <option>บิดา/มารดา</option>
								 <option>ปู่/ย่า/ตา/ยาย</option>
								 <option>พี่/น้อง</option>
								 <option>หลาน/แหลน</option>
								 <option>อื่นๆ</option>
							   </select>
							 </div>
							 <!-- /.form-group -->
						   </div>
					   <!-- /.col -->

					   <div class="col-md-3">
							<div class="form-group">
									<label>กลุ่มอาชีพ :</label>
									 <select class="form-control">
									 <option>กลุ่มอาชีพ 1</option>
									 <option>กลุ่มอาชีพ 1</option>
									 <option>กลุ่มอาชีพ 1</option>
									 <option>กลุ่มอาชีพ 1</option>
									 <option>กลุ่มอาชีพ 1</option>
									</select>
							 </div>
							   <!-- /.form-group -->
						</div>
						<div class="col-md-3">
							<div class="form-group">
									<label>อาชีพหลัก :</label>
									 <select class="form-control">
									 <option>ว่างงาน/ ไม่มีงานทำ</option>
									 <option>ทำนา</option>
									 <option>ทำไร่</option>
									 <option>ทำสวน</option>
									 <option>เลี้ยงสัตย์</option>
									 <option>เพาะเลี้ยงสัตย์น้ำ</option>
									 <option>ทำประมง</option>
									 <option>รับจ้างทั่วไป/ บริการ</option>
									 <option>ทำงานบ้าน</option>
									 <option>กรรมกร</option>
									 <option>ค้าขาย/ ธุรกิจส่วนตัว</option>
									 <option>อุตสาหกรรมในครัวเรือน</option>
									 <option>รับราชการ</option>
									 <option>รัฐวิสาหกิจ</option>
									 <option>พนักงาน/ ลูกจ้างเอกชน</option>
									 <option>นักเรียน/ นักศึกษา</option>
									 <option>อื่นๆ</option>
									</select>
							 </div>
							   <!-- /.form-group -->
						</div>
						 <div class="col-md-3">
							<div class="form-group">
									<label>อาชีพรอง :</label>
									 <select class="form-control">
									 <option>ไม่มี</option>
									  <option>ทำนา</option>
									 <option>ทำไร่</option>
									 <option>ทำสวน</option>
									 <option>เลี้ยงสัตย์</option>
									 <option>เพาะเลี้ยงสัตย์น้ำ</option>
									 <option>ทำประมง</option>
									 <option>รับจ้างทั่วไป/ บริการ</option>
									 <option>ทำงานบ้าน</option>
									 <option>กรรมกร</option>
									 <option>ค้าขาย/ ธุรกิจส่วนตัว</option>
									 <option>อุตสาหกรรมในครัวเรือน</option>
									 <option>อื่นๆ</option>
									</select>
							 </div>
							   <!-- /.form-group -->
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>รายได้/ต่อปี  :</label>								
								<input type="number" name="netIncome" id="netIncome" class="form-control btn-xs" placeholder="รายได้/ต่อปี...">
							</div>
							<!-- /.form-group -->
						 </div>

					</div>
					<!-- /row -->
					<!-- row -->
					<hr>
					<h5>ลำดับที่ : 2  </h5>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-group">
						  <label>คำนำหน้า:</label>
							<select class="form-control">
							<option>เด็กชาย</option>
							<option>เด็กหญิง</option>
							<option>นาย</option>
							<option>นางสาว</option>
							<option>อื่นๆ </option>
						  </select>
						</div>
						<!-- /.form-group -->
					  </div>
					  <div class="col-md-3">
						<div class="form-group">
						  <label>ชื่อ :</label>
						  <input type="text" name="txtFName" value="ประเดิม" id="txtFName" class="form-control" placeholder="ประเดิม  ...">
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						<div class="form-group">
						  <label>นามสกุล:</label>
						  <input type="text" name="txtLName" value="วงค์กระโซ่" id="txtLName" class="form-control" placeholder="วงค์กระโซ่  ...">
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						<div class="form-group">
						  <label>เลขที่ประจำตัวประชาชน  :</label>
							<input type="text" name="txtCitizenId" value="14904xxxx2528" id="txtCitizenId" class="form-control" placeholder="เลขที่ประจำตัวประชาชน  ...">
						</div>
						<!-- /.form-group -->
					  </div>

					</div>
					<!-- /row -->

					<div class="row">
					  <div class="col-md-3">
						<div class="form-group">
						  <label>สถานภาพ :</label>
						  <div class="form-group clearfix">
							<div class="icheck-primary d-inline">
							  <input type="radio" id="radioPrimary3" name="xFstatusRd2" >
							  <label for="radioPrimary3">เจ้าบ้าน
							  </label>
							</div>
							<div class="icheck-primary d-inline">
							  <input type="radio" id="radioPrimary4" name="xFstatusRd2" checked>
							  <label for="radioPrimary4">ผู้อยู่อาศัย
							  </label>
							</div>
						  </div>
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						<div class="form-group">
						  <label>เพศ  :</label>
						  <div class="form-group clearfix">
							<div class="icheck-primary d-inline">
							  <input type="radio" id="radioPrimary5" name="sexRd2" checked>
							  <label for="radioPrimary5">ชาย
							  </label>
							</div>
							<div class="icheck-primary d-inline">
							  <input type="radio" id="radioPrimary6" name="sexRd2">
							  <label for="radioPrimary6">หญิง
							  </label>
							</div>
							<div class="icheck-primary d-inline">
							  <input type="radio" id="radioPrimary7" name="sexRd2">
							  <label for="radioPrimary7">อื่นๆ
							  </label>
							</div>
						  </div>
						</div>
						<!-- /.form-group -->
					  </div>
					  <!-- /.col -->

					  <div class="col-md-3">
						  <div class="form-group">
						  <label>สัญชาติ  :</label>
							  <input type="text" name="txtNational" value="ไทย " id="txtNational" class="form-control" placeholder="สัญชาติ  ...">
							</div>
						  <!-- /.form-group -->
					</div>

					  <div class="col-md-3">
						 <div class="form-group">
							<label>ศาสนา :</label>
							<select class="form-control">
							  <option>พุทธ</option>
							  <option>อิสลาม</option>
							  <option>คริสต์ศาสนา</option>
							  <option>อื่นๆ</option>
							</select>
						  </div>
						  <!-- /.form-group -->
						</div>
					   <!-- /.col -->

					</div>
					<!-- /row -->

					<div class="row">
					  <div class="col-md-3">
						<div class="form-group">
						  <label>วันเดือนปีเกิด :</label>
						  <div class="input-group date" id="reservationdate" data-target-input="nearest">
							  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
							  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
								  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
							  </div>
						  </div>
						</div>
						<!-- /.form-group -->
					  </div>
					  <!-- /.col -->

					   <div class="col-md-3">
						  <div class="form-group">
							 <label>ระดับการศึกษา :</label>
							 <select class="form-control">
							   <option>ต่ำกว่าปริญญาตรี</option>
							   <option>ปริญญาตรี</option>
							   <option>ปริญญาโท</option>
							   <option>ปริญญาเอก</option>
							 </select>
						   </div>
						   <!-- /.form-group -->
						 </div>
						<!-- /.col -->
						<div class="col-md-3">
						   <div class="form-group">
							  <label>ความสัมพันธ์ในครัวเรือน  :</label>
							  <select class="form-control">
								<option>หัวหน้าครอบครัว</option>
								<option>สามี/ภรรยา</option>
								<option>ลูก</option>
								<option>บุตร</option>
								<option>บิดา/มารดา</option>
								<option>ปู่/ย่า/ตา/ยาย</option>
								<option>พี่/น้อง</option>
								<option>หลาน/แหลน</option>
								<option>อื่นๆ</option>
							  </select>
							</div>
							<!-- /.form-group -->
						  </div>
						 <!-- /.col -->

						   <div class="col-md-3">
							  <div class="form-group">
							   <label>กลุ่มอาชีพ :</label>
								 <select class="form-control">
								 <option>กลุ่มอาชีพ 1</option>
								 <option>กลุ่มอาชีพ 1</option>
								 <option>กลุ่มอาชีพ 1</option>
								 <option>กลุ่มอาชีพ 1</option>
								 <option>กลุ่มอาชีพ 1</option>
								</select>
							   </div>
							 <!-- /.form-group -->
							 </div>
							  <!-- /.col -->
							<div class="col-md-3">
							<div class="form-group">
									<label>อาชีพหลัก :</label>
									 <select class="form-control">
									 <option>ว่างงาน/ ไม่มีงานทำ</option>
									 <option>ทำนา</option>
									 <option>ทำไร่</option>
									 <option>ทำสวน</option>
									 <option>เลี้ยงสัตย์</option>
									 <option>เพาะเลี้ยงสัตย์น้ำ</option>
									 <option>ทำประมง</option>
									 <option>รับจ้างทั่วไป/ บริการ</option>
									 <option>ทำงานบ้าน</option>
									 <option>กรรมกร</option>
									 <option>ค้าขาย/ ธุรกิจส่วนตัว</option>
									 <option>อุตสาหกรรมในครัวเรือน</option>
									 <option>รับราชการ</option>
									 <option>รัฐวิสาหกิจ</option>
									 <option>พนักงาน/ ลูกจ้างเอกชน</option>
									 <option>นักเรียน/ นักศึกษา</option>
									 <option>อื่นๆ</option>
									</select>
							 </div>
							   <!-- /.form-group -->
						</div>
						 <div class="col-md-3">
							<div class="form-group">
									<label>อาชีพรอง :</label>
									 <select class="form-control">
									 <option>ไม่มี</option>
									  <option>ทำนา</option>
									 <option>ทำไร่</option>
									 <option>ทำสวน</option>
									 <option>เลี้ยงสัตย์</option>
									 <option>เพาะเลี้ยงสัตย์น้ำ</option>
									 <option>ทำประมง</option>
									 <option>รับจ้างทั่วไป/ บริการ</option>
									 <option>ทำงานบ้าน</option>
									 <option>กรรมกร</option>
									 <option>ค้าขาย/ ธุรกิจส่วนตัว</option>
									 <option>อุตสาหกรรมในครัวเรือน</option>
									 <option>อื่นๆ</option>
									</select>
							 </div>
							   <!-- /.form-group -->
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>รายได้/ต่อปี  :</label>								
								<input type="number" name="netIncome" id="netIncome" class="form-control btn-xs" placeholder="รายได้/ต่อปี...">
							</div>
							<!-- /.form-group -->
						 </div>

					</div>
					<!-- /row -->
				  </div>
				  <!-- /.card-header -->

				  <!-- /.card-body
				  <div class="card-footer">
				  <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
					<button type="reset" class="btn btn-warning">รีเซ็ท</button>
				  </div>  -->

				</div>
				<!-- /.card -->

			   <!-- SELECT2 EXAMPLE ข้อมูลพื้นที่การเกษตร -->
				<div class="card card-default">
				  <div class="card-header">
					<h3 class="card-title">ข้อมูลพื้นที่การเกษตร </h3>

					<div class="card-tools">
					  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
					  <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
					</div>
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body">

					<h5 class="d-sm-inline-block">โฉนด</h5>
					<div class="row">
					  <div class="col-md-12">

							<table class="table table-sm" >
									<thead>
									  <tr>
										<th style="width: 5px">#</th>
										<th style="width: 20px">จังหวัด</th>
										<th style="width: 20px">อำเภอ</th>
										<th style="width: 20px">เลขที่โฉนด</th>
										<th style="width: 10px">พื้นที่(ไร่)</th>
										<th style="width: 10px">พื้นที่(งาน)</th>
										<th style="width: 10px">พื้นที่(ตรว.)</th>										
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<td>1.</td>
										<td>
										  <div class="form-group">
											 <select class="form-control  btn-xs">
											<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
											<option value="81">กระบี่</option>
											<option value="10">กรุงเทพมหานคร</option>
											<option value="71">กาญจนบุรี</option>
											<option value="46">กาฬสินธุ์</option>
											<option value="62">กำแพงเพชร</option>
											<option value="40">ขอนแก่น</option>
											<option value="22">จันทบุรี</option>
											<option value="24">ฉะเชิงเทรา</option>
											<option value="20">ชลบุรี</option>
											<option value="18">ชัยนาท</option>
											<option value="36">ชัยภูมิ</option>
											<option value="86">ชุมพร</option>
											<option value="57">เชียงราย</option>
											<option value="50">เชียงใหม่</option>
											<option value="92">ตรัง</option>
											<option value="23">ตราด</option>
											<option value="63">ตาก</option>
											<option value="26">นครนายก</option>
											<option value="73">นครปฐม</option>
											<option value="48">นครพนม</option>
											<option value="30">นครราชสีมา</option>
											<option value="80">นครศรีธรรมราช</option>
											<option value="60">นครสวรรค์</option>
											<option value="12">นนทบุรี</option>
											<option value="96">นราธิวาส</option>
											<option value="55">น่าน</option>
											<option value="38">บึงกาฬ</option>
											<option value="31" selected="selected">บุรีรัมย์</option>
											<option value="13">ปทุมธานี</option>
											<option value="77">ประจวบคีรีขันธ์</option>
											<option value="25">ปราจีนบุรี</option>
											<option value="94">ปัตตานี</option>
											<option value="14">พระนครศรีอยุธยา</option>
											<option value="56">พะเยา</option>
											<option value="82">พังงา</option>
											<option value="93">พัทลุง</option>
											<option value="66">พิจิตร</option>
											<option value="65">พิษณุโลก</option>
											<option value="76">เพชรบุรี</option>
											<option value="67">เพชรบูรณ์</option>
											<option value="54">แพร่</option>
											<option value="83">ภูเก็ต</option>
											<option value="44">มหาสารคาม</option>
											<option value="49">มุกดาหาร</option>
											<option value="58">แม่ฮ่องสอน</option>
											<option value="35">ยโสธร</option>
											<option value="95">ยะลา</option>
											<option value="45">ร้อยเอ็ด</option>
											<option value="85">ระนอง</option>
											<option value="21">ระยอง</option>
											<option value="70">ราชบุรี</option>
											<option value="16">ลพบุรี</option>
											<option value="52">ลำปาง</option>
											<option value="51">ลำพูน</option>
											<option value="42">เลย</option>
											<option value="33">ศรีสะเกษ</option>
											<option value="47">สกลนคร</option>
											<option value="90">สงขลา</option>
											<option value="91">สตูล</option>
											<option value="11">สมุทรปราการ</option>
											<option value="75">สมุทรสงคราม</option>
											<option value="74">สมุทรสาคร</option>
											<option value="27">สระแก้ว</option>
											<option value="19">สระบุรี</option>
											<option value="17">สิงห์บุรี</option>
											<option value="64">สุโขทัย</option>
											<option value="72">สุพรรณบุรี</option>
											<option value="84">สุราษฎร์ธานี</option>
											<option value="32">สุรินทร์</option>
											<option value="43">หนองคาย</option>
											<option value="39">หนองบัวลำภู</option>
											<option value="15">อ่างทอง</option>
											<option value="37">อำนาจเจริญ</option>
											<option value="41">อุดรธานี</option>
											<option value="53">อุตรดิตถ์</option>
											<option value="61">อุทัยธานี</option>
											<option value="34">อุบลราชธานี</option>
											</select>
										   </div>								
										</td>
										<td>
										<div class="form-group btn-xs">
										 <select class="form-control btn-xs">
										 <option>พลับพลาชัย </option>
										 <option>เมืองบุรีรัมย์</option>
										 <option>คูเมือง</option>
										 <option>กระสัง</option>
										 <option>นางรอง</option>
										 <option>ละหานทราย</option>
										 <option>ประโคนชัย</option>
										</select>
									   </div>
										</td>								
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
										  </div>
										</td>

									  </tr>

									</tbody>
								  </table>

					  </div>
					</div>
					
										
					<h5 class="d-sm-inline-block">นส.3ก</h5>
					<div class="row">
					  <div class="col-md-12">

							<table class="table table-sm" >
									<thead>
									  <tr>
										<th style="width: 5px">#</th>
										<th style="width: 20px">จังหวัด</th>
										<th style="width: 20px">อำเภอ</th>
										<th style="width: 20px">เลขที่โฉนด</th>
										<th style="width: 10px">พื้นที่(ไร่)</th>
										<th style="width: 10px">พื้นที่(งาน)</th>
										<th style="width: 10px">พื้นที่(ตรว.)</th>										
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<td>1.</td>
										<td>
										  <div class="form-group">
											 <select class="form-control  btn-xs">
											<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
											<option value="81">กระบี่</option>
											<option value="10">กรุงเทพมหานคร</option>
											<option value="71">กาญจนบุรี</option>
											<option value="46">กาฬสินธุ์</option>
											<option value="62">กำแพงเพชร</option>
											<option value="40">ขอนแก่น</option>
											<option value="22">จันทบุรี</option>
											<option value="24">ฉะเชิงเทรา</option>
											<option value="20">ชลบุรี</option>
											<option value="18">ชัยนาท</option>
											<option value="36">ชัยภูมิ</option>
											<option value="86">ชุมพร</option>
											<option value="57">เชียงราย</option>
											<option value="50">เชียงใหม่</option>
											<option value="92">ตรัง</option>
											<option value="23">ตราด</option>
											<option value="63">ตาก</option>
											<option value="26">นครนายก</option>
											<option value="73">นครปฐม</option>
											<option value="48">นครพนม</option>
											<option value="30">นครราชสีมา</option>
											<option value="80">นครศรีธรรมราช</option>
											<option value="60">นครสวรรค์</option>
											<option value="12">นนทบุรี</option>
											<option value="96">นราธิวาส</option>
											<option value="55">น่าน</option>
											<option value="38">บึงกาฬ</option>
											<option value="31" selected="selected">บุรีรัมย์</option>
											<option value="13">ปทุมธานี</option>
											<option value="77">ประจวบคีรีขันธ์</option>
											<option value="25">ปราจีนบุรี</option>
											<option value="94">ปัตตานี</option>
											<option value="14">พระนครศรีอยุธยา</option>
											<option value="56">พะเยา</option>
											<option value="82">พังงา</option>
											<option value="93">พัทลุง</option>
											<option value="66">พิจิตร</option>
											<option value="65">พิษณุโลก</option>
											<option value="76">เพชรบุรี</option>
											<option value="67">เพชรบูรณ์</option>
											<option value="54">แพร่</option>
											<option value="83">ภูเก็ต</option>
											<option value="44">มหาสารคาม</option>
											<option value="49">มุกดาหาร</option>
											<option value="58">แม่ฮ่องสอน</option>
											<option value="35">ยโสธร</option>
											<option value="95">ยะลา</option>
											<option value="45">ร้อยเอ็ด</option>
											<option value="85">ระนอง</option>
											<option value="21">ระยอง</option>
											<option value="70">ราชบุรี</option>
											<option value="16">ลพบุรี</option>
											<option value="52">ลำปาง</option>
											<option value="51">ลำพูน</option>
											<option value="42">เลย</option>
											<option value="33">ศรีสะเกษ</option>
											<option value="47">สกลนคร</option>
											<option value="90">สงขลา</option>
											<option value="91">สตูล</option>
											<option value="11">สมุทรปราการ</option>
											<option value="75">สมุทรสงคราม</option>
											<option value="74">สมุทรสาคร</option>
											<option value="27">สระแก้ว</option>
											<option value="19">สระบุรี</option>
											<option value="17">สิงห์บุรี</option>
											<option value="64">สุโขทัย</option>
											<option value="72">สุพรรณบุรี</option>
											<option value="84">สุราษฎร์ธานี</option>
											<option value="32">สุรินทร์</option>
											<option value="43">หนองคาย</option>
											<option value="39">หนองบัวลำภู</option>
											<option value="15">อ่างทอง</option>
											<option value="37">อำนาจเจริญ</option>
											<option value="41">อุดรธานี</option>
											<option value="53">อุตรดิตถ์</option>
											<option value="61">อุทัยธานี</option>
											<option value="34">อุบลราชธานี</option>
											</select>
										   </div>								
										</td>
										<td>
										<div class="form-group btn-xs">
										 <select class="form-control btn-xs">
										 <option>พลับพลาชัย </option>
										 <option>เมืองบุรีรัมย์</option>
										 <option>คูเมือง</option>
										 <option>กระสัง</option>
										 <option>นางรอง</option>
										 <option>ละหานทราย</option>
										 <option>ประโคนชัย</option>
										</select>
									   </div>
										</td>								
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
										  </div>
										</td>

									  </tr>

									</tbody>
								  </table>

					  </div>
					</div>
					
					
					<h5 class="d-sm-inline-block">สปก.</h5>

					<div class="row">
					  <div class="col-md-12">

					   <table class="table table-sm" >
									<thead>
									  <tr>
										<th style="width: 5px">#</th>
										<th style="width: 20px">จังหวัด</th>
										<th style="width: 20px">อำเภอ</th>
										<th style="width: 20px">เลขที่โฉนด</th>
										<th style="width: 10px">พื้นที่(ไร่)</th>
										<th style="width: 10px">พื้นที่(งาน)</th>
										<th style="width: 10px">พื้นที่(ตรว.)</th>

									  </tr>
									</thead>
									<tbody>
									  <tr>
										<td>1.</td>
										<td>
										  <div class="form-group">
											 <select class="form-control  btn-xs">
											<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
											<option value="81">กระบี่</option>
											<option value="10">กรุงเทพมหานคร</option>
											<option value="71">กาญจนบุรี</option>
											<option value="46">กาฬสินธุ์</option>
											<option value="62">กำแพงเพชร</option>
											<option value="40">ขอนแก่น</option>
											<option value="22">จันทบุรี</option>
											<option value="24">ฉะเชิงเทรา</option>
											<option value="20">ชลบุรี</option>
											<option value="18">ชัยนาท</option>
											<option value="36">ชัยภูมิ</option>
											<option value="86">ชุมพร</option>
											<option value="57">เชียงราย</option>
											<option value="50">เชียงใหม่</option>
											<option value="92">ตรัง</option>
											<option value="23">ตราด</option>
											<option value="63">ตาก</option>
											<option value="26">นครนายก</option>
											<option value="73">นครปฐม</option>
											<option value="48">นครพนม</option>
											<option value="30">นครราชสีมา</option>
											<option value="80">นครศรีธรรมราช</option>
											<option value="60">นครสวรรค์</option>
											<option value="12">นนทบุรี</option>
											<option value="96">นราธิวาส</option>
											<option value="55">น่าน</option>
											<option value="38">บึงกาฬ</option>
											<option value="31" selected="selected">บุรีรัมย์</option>
											<option value="13">ปทุมธานี</option>
											<option value="77">ประจวบคีรีขันธ์</option>
											<option value="25">ปราจีนบุรี</option>
											<option value="94">ปัตตานี</option>
											<option value="14">พระนครศรีอยุธยา</option>
											<option value="56">พะเยา</option>
											<option value="82">พังงา</option>
											<option value="93">พัทลุง</option>
											<option value="66">พิจิตร</option>
											<option value="65">พิษณุโลก</option>
											<option value="76">เพชรบุรี</option>
											<option value="67">เพชรบูรณ์</option>
											<option value="54">แพร่</option>
											<option value="83">ภูเก็ต</option>
											<option value="44">มหาสารคาม</option>
											<option value="49">มุกดาหาร</option>
											<option value="58">แม่ฮ่องสอน</option>
											<option value="35">ยโสธร</option>
											<option value="95">ยะลา</option>
											<option value="45">ร้อยเอ็ด</option>
											<option value="85">ระนอง</option>
											<option value="21">ระยอง</option>
											<option value="70">ราชบุรี</option>
											<option value="16">ลพบุรี</option>
											<option value="52">ลำปาง</option>
											<option value="51">ลำพูน</option>
											<option value="42">เลย</option>
											<option value="33">ศรีสะเกษ</option>
											<option value="47">สกลนคร</option>
											<option value="90">สงขลา</option>
											<option value="91">สตูล</option>
											<option value="11">สมุทรปราการ</option>
											<option value="75">สมุทรสงคราม</option>
											<option value="74">สมุทรสาคร</option>
											<option value="27">สระแก้ว</option>
											<option value="19">สระบุรี</option>
											<option value="17">สิงห์บุรี</option>
											<option value="64">สุโขทัย</option>
											<option value="72">สุพรรณบุรี</option>
											<option value="84">สุราษฎร์ธานี</option>
											<option value="32">สุรินทร์</option>
											<option value="43">หนองคาย</option>
											<option value="39">หนองบัวลำภู</option>
											<option value="15">อ่างทอง</option>
											<option value="37">อำนาจเจริญ</option>
											<option value="41">อุดรธานี</option>
											<option value="53">อุตรดิตถ์</option>
											<option value="61">อุทัยธานี</option>
											<option value="34">อุบลราชธานี</option>
											</select>
										   </div>								
										</td>
										<td>
										<div class="form-group btn-xs">
										 <select class="form-control btn-xs">
										 <option>พลับพลาชัย </option>
										 <option>เมืองบุรีรัมย์</option>
										 <option>คูเมือง</option>
										 <option>กระสัง</option>
										 <option>นางรอง</option>
										 <option>ละหานทราย</option>
										 <option>ประโคนชัย</option>
										</select>
									   </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
										  </div>
										</td>

									  </tr>
									  <tr>
										<td>2.</td>
										<td>
										  <div class="form-group">
											 <select class="form-control  btn-xs">
											<option  value="- กรุณาเลือกจังหวัด -">- กรุณาเลือกจังหวัด -</option>
											<option value="81">กระบี่</option>
											<option value="10">กรุงเทพมหานคร</option>
											<option value="71">กาญจนบุรี</option>
											<option value="46">กาฬสินธุ์</option>
											<option value="62">กำแพงเพชร</option>
											<option value="40">ขอนแก่น</option>
											<option value="22">จันทบุรี</option>
											<option value="24">ฉะเชิงเทรา</option>
											<option value="20">ชลบุรี</option>
											<option value="18">ชัยนาท</option>
											<option value="36">ชัยภูมิ</option>
											<option value="86">ชุมพร</option>
											<option value="57">เชียงราย</option>
											<option value="50">เชียงใหม่</option>
											<option value="92">ตรัง</option>
											<option value="23">ตราด</option>
											<option value="63">ตาก</option>
											<option value="26">นครนายก</option>
											<option value="73">นครปฐม</option>
											<option value="48">นครพนม</option>
											<option value="30">นครราชสีมา</option>
											<option value="80">นครศรีธรรมราช</option>
											<option value="60">นครสวรรค์</option>
											<option value="12">นนทบุรี</option>
											<option value="96">นราธิวาส</option>
											<option value="55">น่าน</option>
											<option value="38">บึงกาฬ</option>
											<option value="31" selected="selected">บุรีรัมย์</option>
											<option value="13">ปทุมธานี</option>
											<option value="77">ประจวบคีรีขันธ์</option>
											<option value="25">ปราจีนบุรี</option>
											<option value="94">ปัตตานี</option>
											<option value="14">พระนครศรีอยุธยา</option>
											<option value="56">พะเยา</option>
											<option value="82">พังงา</option>
											<option value="93">พัทลุง</option>
											<option value="66">พิจิตร</option>
											<option value="65">พิษณุโลก</option>
											<option value="76">เพชรบุรี</option>
											<option value="67">เพชรบูรณ์</option>
											<option value="54">แพร่</option>
											<option value="83">ภูเก็ต</option>
											<option value="44">มหาสารคาม</option>
											<option value="49">มุกดาหาร</option>
											<option value="58">แม่ฮ่องสอน</option>
											<option value="35">ยโสธร</option>
											<option value="95">ยะลา</option>
											<option value="45">ร้อยเอ็ด</option>
											<option value="85">ระนอง</option>
											<option value="21">ระยอง</option>
											<option value="70">ราชบุรี</option>
											<option value="16">ลพบุรี</option>
											<option value="52">ลำปาง</option>
											<option value="51">ลำพูน</option>
											<option value="42">เลย</option>
											<option value="33">ศรีสะเกษ</option>
											<option value="47">สกลนคร</option>
											<option value="90">สงขลา</option>
											<option value="91">สตูล</option>
											<option value="11">สมุทรปราการ</option>
											<option value="75">สมุทรสงคราม</option>
											<option value="74">สมุทรสาคร</option>
											<option value="27">สระแก้ว</option>
											<option value="19">สระบุรี</option>
											<option value="17">สิงห์บุรี</option>
											<option value="64">สุโขทัย</option>
											<option value="72">สุพรรณบุรี</option>
											<option value="84">สุราษฎร์ธานี</option>
											<option value="32">สุรินทร์</option>
											<option value="43">หนองคาย</option>
											<option value="39">หนองบัวลำภู</option>
											<option value="15">อ่างทอง</option>
											<option value="37">อำนาจเจริญ</option>
											<option value="41">อุดรธานี</option>
											<option value="53">อุตรดิตถ์</option>
											<option value="61">อุทัยธานี</option>
											<option value="34">อุบลราชธานี</option>
											</select>
										   </div>								
										</td>
										<td>
										<div class="form-group btn-xs">
										 <select class="form-control btn-xs">
										 <option>พลับพลาชัย </option>
										 <option>เมืองบุรีรัมย์</option>
										 <option>คูเมือง</option>
										 <option>กระสัง</option>
										 <option>นางรอง</option>
										 <option>ละหานทราย</option>
										 <option>ประโคนชัย</option>
										</select>
									   </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="เลขที่โฉนด  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ไร่)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(งาน)  ...">
										  </div>
										</td>
										<td>
										  <div class="form-group">
											<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="พื้นที่(ตรว.)  ...">
										  </div>
										</td>

									  </tr>

									</tbody>
								  </table>

					  </div>
					</div>
					<h5 class="d-sm-inline-block">ภบท 5</h5>

					<div class="row">
					  <div class="col-md-12">

						  <table class="table table-sm" >
									<thead>
									  <tr>
										<th style="width: 5px">#</th>
										<th style="width: 20px">จังหวัด</th>
										<th style="width: 20px">อำเภอ</th>
										<th style="width: 20px">เลขที่โฉนด</th>
										<th style="width: 10px">พื้นที่(ไร่)</th>
										<th style="width: 10px">พื้นที่(งาน)</th>
										<th style="width: 10px">พื้นที่(ตรว.)</th>
										
									  </tr>
									</thead>
									<tbody>
									  <tr >
										<td align="center" colspan="6">*** ยังไม่มีข้อมูล ***</td>                                
									  </tr>

									</tbody>
								  </table>

					  </div>
					</div>

					<div class="row">
					  <div class="col-md-6">
						<div class="form-group">
						  <label>อื่นๆ :</label>
						  <textarea class="form-control" name="txtOhterLandDesc" id="txtOhterLandDesc" rows="2" placeholder="อื่นๆ ..."></textarea>
						</div>
					  </div>
				  </div>


				  </div>
				  <!-- /.card-header -->

				  <!-- /.card-body
				  <div class="card-footer">
				  </div> -->
				</div>
				<!-- /.card -->

				<!-- SELECT2 EXAMPLE xxxx -->
				<div class="card card-default">
				  <div class="card-header">
					<h3 class="card-title">ข้อมูลทั่วไปของครัวเรือน</h3>

					<div class="card-tools">
					  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
					  <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
					</div>
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body">
					<h5> เศรษฐกิจครัวเรือน</h5>
					<div class="row">					  
					  <div class="col-md-3">
						<div class="form-group">
						  <label>อาชีพในครัวเรือน:</label>
						  <select class="form-control">
							<option>ทำนา</option>
							<option>ทำสวน</option>
							<option>ประมง</option>
							<option>ทำไร่</option>
							<option>เลี้ยงสัตว์</option>
							<option>อุตสหกรรมครัวเรือน</option>
							<option>รับจ้างทั่วไป</option>
						  <!--  <option>ค้าขาย</option>
							<option>รับราชการ</option>
						  -->
						  </select>
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						<div class="form-group">
						  <label>เป้าหมายการผลิต :</label>
						  <select class="form-control">
							<option>ผลิตเพื่อบริโภค</option>
							<option>ผลิตเพื่อจำหน่าย</option>
							<option>ผลิตเพื่อบริโภคและจำหน่าย</option>
						  </select>
						</div>
						<!-- /.form-group -->
					  </div>

					  <div class="col-md-3">
						<div class="form-group">
						  <label>แหล่งเงินทุน (ครัวเรือน) :</label>
						  <select class="form-control">
							<option>เงินทุนส่วนตัว</option>
							<option>กู้มาลงทุน</option>
							<option>กู้บ้างสวน</option>
						  </select>
						</div>
						<!-- /.form-group -->
					  </div>

					</div>
					<!-- /row -->
					<div class="row">

					  <div class="col-md-4">
									<!-- Date range -->
									<div class="form-group">
									  <label>ช่วงเวลาการผลิต:</label>

									  <div class="input-group">
										<div class="input-group-prepend">
										  <span class="input-group-text">
											<i class="far fa-calendar-alt"></i>
										  </span>
										</div>
										<input type="text" class="form-control float-right" id="reservation">
									  </div>
									  <!-- /.input group -->
									</div>
									<!-- /.form group -->
					  </div>

					  <div class="col-md-6">
						<div class="form-group">
						  <label>ต้นทุนการผลิต :</label>
						  <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="ต้นทุนการผลิต  ..."></textarea>
						</div>
						<!-- /.form-group -->
					  </div>

					</div>
					<!-- /row -->

					<label>เครื่องมืออำนวยความสะดวกทางการเกษตร</label>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-check">
						  <label class="form-check-label">
						  <input class="form-check-input" type="checkbox">
							รถไถ แทรกเตอร์ </label>
						</div>
						<div class="form-group">
							<input type="number" id="inputSpentBudget" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
						</div>
						</div>
						<!-- /.form-group -->

						<div class="col-md-3">
						  <div class="form-check">
						   <label class="form-check-label">
							<input class="form-check-input" type="checkbox">
							รถไถเดินตาม</label>
						  </div>
						  <div class="form-group">
							  <input type="number" id="inputSpentBudget" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
						  </div>
						  </div>
						  <!-- /.form-group -->
						  <div class="col-md-3">
							<div class="form-check">
							  <label class="form-check-label">
							  <input class="form-check-input" type="checkbox">
							รถตุ๊กตุ๊ก</label>
							</div>
							<div class="form-group">
								<input type="number" id="inputSpentBudget"  placeholder="จำนวน...คัน" class="form-control" value="" step="1">
							</div>
							</div>
						 <!-- /.form-group -->
						 <div class="col-md-3">
						  <div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox">
							รถเกี่ยว</label>
						  </div>
						  <div class="form-group">
							  <input type="number" id="inputSpentBudget"  placeholder="จำนวน...คัน" class="form-control" value="" step="1">
						  </div>
						  </div>
					</div>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-check">
							<label class="form-check-label">
						   <input class="form-check-input" type="checkbox">
							รถอัดฟาง</label>
						</div>
						<div class="form-group">
							<input type="number" id="inputSpentBudget" class="form-control" placeholder="จำนวน...คัน" value="" step="1">
						</div>
						</div>
						<!-- /.form-group -->

						<!-- /.form-group -->
						<div class="col-md-4">
						  <div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox">อื่นๆ</label>
						  </div>
						  <div class="form-group">
							  <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="อื่นๆ  ..."></textarea>
						  </div>
						  </div>
						  <!-- /.form-group -->

					</div>

					<label> สัตว์เลี้ยง</label>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-check">
						   <label class="form-check-label">
						  <input class="form-check-input" type="checkbox">
													โค</label>
						</div>
						<div class="form-group">
							<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
						</div>
						</div>
						<!-- /.form-group -->

						<div class="col-md-3">
						  <div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox">
														  กระบือ</label>
						  </div>
						  <div class="form-group">
							  <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
						  </div>
						  </div>
						  <!-- /.form-group -->
						  <div class="col-md-3">
							<div class="form-check">
							   <label class="form-check-label">
							  <input class="form-check-input" type="checkbox">
																สุกร</label>
							</div>
							<div class="form-group">
								<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
							</div>
							</div>
						 <!-- /.form-group -->
						 <div class="col-md-3">
						  <div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox">
														  สุนัข</label>
						  </div>
						  <div class="form-group">
							  <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
						  </div>
						  </div>
					</div>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-check">
						   <label class="form-check-label">
						  <input class="form-check-input" type="checkbox">
							แมว</label>
						</div>
						<div class="form-group">
							<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
						</div>
						</div>
						<!-- /.form-group -->
						<div class="col-md-3">
						  <div class="form-check">
							  <label class="form-check-label">
							  <input class="form-check-input" type="checkbox">
								 หนูนา</label>
						  </div>
						  <div class="form-group">
							  <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
						  </div>
						  </div>
						  <!-- /.form-group -->
						  <div class="col-md-3">
							<div class="form-check">
							<label class="form-check-label">
							  <input class="form-check-input" type="checkbox">
								ไก่บ้าน</label>
							</div>
							<div class="form-group">
								<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
							</div>
							</div>
							<!-- /.form-group -->
							<div class="col-md-3">
							  <div class="form-check">
							  <label class="form-check-label">
								<input class="form-check-input" type="checkbox">
									ไก่ชน</label>
							  </div>
							  <div class="form-group">
								  <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
							  </div>
							  </div>
							  <!-- /.form-group -->
					</div>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-check">
						<label class="form-check-label">
						  <input class="form-check-input" type="checkbox">
							กบ</label>
						</div>
						<div class="form-group">
							<input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
						</div>
						</div>
						<!-- /.form-group -->
						<div class="col-md-3">
						  <div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox">ปลา</label>
						  </div>
						  <div class="form-group">
							  <input type="number" name="txtHouseId" id="txtHouseId" class="form-control btn-xs" placeholder="จำนวน...ตัว">
						  </div>
						  </div>
						  <!-- /.form-group -->
						<!-- /.form-group -->
						<div class="col-md-4">
						  <div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox">อื่นๆ</label>
						  </div>
						  <div class="form-group">
							  <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="อื่นๆ  ..."></textarea>
						  </div>
						  </div>
						  <!-- /.form-group -->

					</div>

					<label>สิ่งแวดล้อม</label>
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
						  <label class="form-check-label">ปัญหาสิ่งแวดล้อมในครัวเรือน :</label>
						  <div class="form-group clearfix">
							<div class="icheck-primary d-inline">
							  <input type="radio" id="radioPrimary8" name="xEnvironmental" >
							  <label for="radioPrimary8">ไม่มี
							  </label>
							</div>
							<div class="icheck-primary d-inline">
							  <input type="radio" id="radioPrimary9" name="xEnvironmental" checked>
							  <label for="radioPrimary9">มี (ระบุ)					  
							  </label>
								<textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="มี (ระบุ)..."></textarea>
							</div>
						  </div>
						</div>
						</div>
						<!-- /.form-group -->
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-check-label">การจัดการสิ่งแวดล้อม :</label>
							<div class="form-group clearfix">
							  <div class="icheck-primary d-inline">
								<input type="radio" id="radioPrimary10" name="xEnvironmental2" >
								<label for="radioPrimary10">ไม่มี
								</label>
							  </div>
							  <div class="icheck-primary d-inline">
								<input type="radio" id="radioPrimary11" name="xEnvironmental2" checked>
								<label for="radioPrimary11">มี(ระบุ)
								</label>
								 <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="มี (ระบุ)..."></textarea>
							  </div>
							</div>
						  </div>
						  </div>
						  <!-- /.form-group -->
						  <div class="col-md-4">
							  <div class="form-group">
								<label class="form-check-label">การอนุรักษ์สิ่งแวดล้อม</label>
								<textarea class="form-control" name="txtDesc" id="txtDesc" rows="2" placeholder="การอนุรักษ์สิ่งแวดล้อม  ..."></textarea>
							  </div>
							</div>
							<!-- /.form-group -->

					</div>
					
		  
					<div class="row">

					  <div class="col-md-3">
						<label>ภัยธรรมชาติ</label>
						<div class="form-check">
						  <label class="form-check-label">
						  <input class="form-check-input" type="checkbox">
							ภัยแล้ง </label>
						</div>
						  <div class="form-check">
						   <label class="form-check-label">
							<input class="form-check-input" type="checkbox">
							น้ำท่วม</label>
						  </div>
							<div class="form-check">
							  <label class="form-check-label">
							  <input class="form-check-input" type="checkbox">
							วาตภัย</label>
							</div>	
							<div class="form-check">
							  <label class="form-check-label">
							  <input class="form-check-input" type="checkbox">
								อัคคีภัย </label>
							</div>					
						</div>
						
						<!-- /.form-group -->
					   <div class="col-md-3">
					   <label>&nbsp;</label>

						  <div class="form-check">
						   <label class="form-check-label">
							<input class="form-check-input" type="checkbox">
							โรคระบาด</label>
						  </div>
						<div class="form-check">
							<label class="form-check-label">
						   <input class="form-check-input" type="checkbox">
							อื่นๆ</label>
						</div>
						<div class="form-group">
							 <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="อื่นๆ  ..."></textarea>
						</div>
						</div>
						<!-- /.form-group -->
		  
						<!-- /.form-group -->
						<div class="col-md-6">
						  <div class="form-group">
							<label >เคยได้รับความช่วยเหลือ :</label>
							<div class="form-group clearfix">
							  <div class="icheck-primary d-inline">
								<input type="radio" id="radioPrimary12" name="xEnvironmental2" >
								<label for="radioPrimary12">ไม่เคย
								</label>
							  </div>
							  <div class="icheck-primary d-inline">
								<input type="radio" id="radioPrimary13" name="xEnvironmental2" checked>
								<label for="radioPrimary13">เคย(ระบุความช่วยเหลือจากหน่วยงานไหน)
								</label>
								 <textarea class="form-control" name="txtDesc" id="txtDesc" rows="2" placeholder="เคย (ความช่วยเหลือจากหน่วยงานไหน)..."></textarea>
							  </div>
							</div>
						  </div>
						  </div>
						  <!-- /.form-group -->				  
					</div>

					<label>ข่าวสารทางด้านการเกษตร</label>
					<div class="row">
					  <div class="col-md-3">
						<div class="form-check">
						  <input class="form-check-input" type="checkbox">
						  <label class="form-check-label">ปากต่อปาก</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox">
							<label class="form-check-label">การใช้โทรศัพท์มือถือ</label>
						 </div>				
						 <div class="form-check">
							  <input class="form-check-input" type="checkbox">
							  <label class="form-check-label">การใช้คอมพิวเตอร์และอินเทอร์เน็ต</label>
						 </div>	
						 
						</div>
						<!-- /.form-group -->

						<div class="col-md-3">
						
						  <div class="form-check">
							<input class="form-check-input" type="checkbox">
							<label class="form-check-label">การส่งหนังสือแจ้ง/การส่งจดหมาย</label>
						  </div>
						 <div class="form-check">
						  <input class="form-check-input" type="checkbox">
						  <label class="form-check-label">หอกระจายข่าว</label>
						</div>
						 <div class="form-check">
							<input class="form-check-input" type="checkbox">
							<label class="form-check-label">วิทยุชุมชน</label>
						  </div>
					  
					  
						</div>
						<!-- /.form-group -->
						<div class="col-md-3">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox">
							  <label class="form-check-label">เวทีประชุม/ประชาคม</label>
							</div>					
						   <div class="form-group">
							 <label class="form-check-label">อื่นๆ</label>
							 <textarea class="form-control" name="txtDesc" id="txtDesc" rows="1" placeholder="อื่นๆ  ..."></textarea>
						   </div>	
						 </div>
						 <!-- /.form-group -->
					</div>

					<div class="row">

					  <div class="col-md-3">
						<div class="form-group">
						  <label>วันเดือนปีสำรวจ :</label>
						  <div class="input-group date" id="reservationdate2" data-target-input="nearest">
							  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
							  <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
								  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
							  </div>
						  </div>
						</div>
						<!-- /.form-group -->
					  </div>
					  <!-- /.col -->
					</div>

				  </div>
				  <!-- /.card-header -->

				  <!-- /.card-body 
				  <div class="card-footer">
					<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
					  <button type="reset" class="btn btn-warning">รีเซ็ท</button>
				  </div> -->
				</div>
				<!-- /.card -->

			  </div><!-- /.container-fluid -->
			</section>
 <?php }else{  
?>
<h4 class="modal-title">ไม่พบแสดงข้อมูล!</h4>
<?php
 }?>