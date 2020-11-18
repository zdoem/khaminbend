<?php
$webtitle='จัดการข้อมูลครัวเรือน';
require 'bootstart.php';
require ROOT . '/core/security.php';
require_once 'components/header.php';

?> 
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ข้อมูลครัวเรือน</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                	<em class="fa fa-home"></em>
                <a href="#">Home</a></li>
              <li class="breadcrumb-item active">หน้าจัดการข้อมูลครัวเรือน</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" id="app" v-cloak>
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">เงื่อนไขการค้นหา</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>-->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
				<div class="col-md-3">
						<div class="form-group">
						  <label>ปี :</label>
						  <select class="form-control">
						    <option>2563</option>
							<option>2562</option>
							<option>2561</option>
							<option>2560</option>
							<option>2559</option>
						  </select>

						</div>
						<!-- /.form-group -->
				</div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>บ้านเลขที่ :</label>
                  <input   type="text" name="txtHouseNo" v-model="datainput.txtHouseNo"  id="txtHouseNo" class="form-control" placeholder="บ้านเลขที่...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>ชื่อเจ้าบ้าน :</label>
                  <input   type="text" name="txtHouseholder" v-model="datainput.txtHouseholder" id="txtHouseholder" class="form-control" placeholder="ชื่อเจ้าบ้าน...">
                </div>
                <!-- /.form-group -->
              </div>
			  
              <!-- /.col -->
			  <div class="col-md-3">
                <div class="form-group">
                  <label>เลขที่บัตรประจำตัวประชาชน :</label>
                  <input   type="text" name="txtCitizenId"  id="txtCitizenId" class="form-control" placeholder="14904xxxx2528...">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
			  
            </div>
            <!-- /.row -->

          </div>
          <!-- /.card-header -->

          <!-- /.card-body -->
          <div class="card-footer">
            <a class="btn btn-primary btn-sm">
                <i class="fas fa-search">
                </i> ค้นหา
            </a>
          </div>
        </div>
        <!-- /.card -->

        <!-- Default box -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">รายละเอียดการค้นหา</h3>&nbsp;  &nbsp;
            <a class="btn btn-info btn-sm" href="familyForm.php">
              <i class="fas fa-plus-square">
                </i> เพิ่มข้อมูครัวเรือน
            </a>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 15%">
                        หมู่ที่ -  ชื่อหมู่บ้าน
                        </th>
                        <th style="width: 10%">
                         บ้านเลขที่
                        </th>
						<th style="width: 25%">
		ชื่อเจ้าบ้าน  นามสกุล
                        </th>
						<th style="width: 25%">
		ที่อยู่ตามทะเบียนบ้าน
                        </th>
                        <th style="width: 10%">
                         วันที่สำรวจ       
                        </th>
		                <th style="width: 10%">
                         แก้ไขล่าสุด  
                        </th>				
                        <th style="width: 20%">
                        </th>

                    </tr>
                </thead>
                <tbody>
				    <tr>
						<td colspan="8" align="center">*** ไม่มีข้อมูล ***</td>
					</tr>

				</tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 <script src="assets/js/vuelidate.min.js"></script>
 <script src="assets/js/family.js"></script>
<?php
 require_once 'components/footer.php';  
?>