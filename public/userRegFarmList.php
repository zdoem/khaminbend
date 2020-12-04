<?php
 require 'bootstart.php';   
 require_once 'components/headerPortal.php';    
 
 require ROOT . '/core/security.php';
 
 
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
 
 //TODO : for main query
 
 
 
?> 
 <!-- Content Header (Page header) -->


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
      <div class="container">

		<div class="row">
          <!-- left column -->
          <div class="col-sm-12">
		  
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
                  <label>แผนก/กอง :</label>
  					<select class="form-control">
                    <option>กองส่งเสริมการเกษตร</option>
                    <option>สำนักงานปลัด อบต. </option>
                    <option>กองช่าง</option>
					<option>กองการศึกษาและศาสนา</option>
					<option>กองสวัสดิการสังคม</option>
					<option>ฝ่ายดูแลระบบ</option>
					</select>                   
                </div>
                <!-- /.form-group -->
              </div>
			  <div class="col-md-3">
                <div class="form-group">
                  <label>บทบาท :</label>
 					<select class="form-control">
                    <option>User</option>
                    <option>Supervisor</option>
                    <option>Admin</option>
					</select>                   
                </div>
                <!-- /.form-group -->
              </div>           
              <div class="col-md-3">
                <div class="form-group">
                  <label>UserId:</label>
                  <input type="text" name="txtMoo" value=" " id="txtMoo" class="form-control" placeholder="UserId ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>ชื่อ-สกุล :</label>
                  <input type="text" name="txtVillageName"  id="txtVillageName" class="form-control" placeholder="ชื่อ-สกุล...">
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
            <a class="btn btn-primary btn-sm" href="villageListData.html">
                <i class="fas fa-search">
                </i> ค้นหา
            </a>
          </div>
        </div>
        <!-- /.card -->

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">รายละเอียดการค้นหา</h3>&nbsp;  &nbsp;
            <a class="btn btn-info btn-sm" href="villageForm.html">
              <i class="fas fa-plus-square">
                </i>ลงทะเบียนผู้ใช้งาน
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
                            ชื่อ-นามสกุล
                        </th>
                        <th style="width: 20%">
                            อีเมลย์
                        </th>
						<th style="width: 25%">
		   เบอร์มือถือ
                        </th>
                        <th style="width: 15%">
                           ตำแหน่ง        
                        </th>
                        <th style="width: 20%">
		แผนก/กอง				
                        </th>
		                 <th style="width: 20%">
		บทบาท			
                        </th>	
		                 <th style="width: 20%">
                        </th>							

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
									หมู่1
                            </a>
                            <br/>
                            <small>
                                Created 01.01.2019
                            </small>
                        </td>
                        <td>
                          <a>
                              บ้านตาแก
                          </a>
                        </td>
                        <td class="project_progress">
							ที่ตั้งของหมู่บ้านในเขตองค์การบริหารส่วนต าบลโคกขมิ้น
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>	
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-xs" href="villageFormEdit.html">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-xs" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>  
                    </tr>
					                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
									หมู่2 
                            </a>
                            <br/>
                            <small>
                                Created 01.01.2019 
                            </small>
                        </td>
                        <td>
                          <a>
                           บ้านโคกขมิ้น 
                          </a>
                        </td>
                        <td class="project_progress">
							ที่ตั้งของหมู่บ้านในเขตองค์การบริหารส่วนต าบลโคกขมิ้น
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>						
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-xs" href="#">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-xs" href="villageFormEdit.html">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-xs" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>  
                    </tr>
					                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
									หมู่3
                            </a>
                            <br/>
                            <small>
                                Created 01.01.2019 
                            </small>
                        </td>
                        <td>
                          <a>
                              บ้านเขว้า 
                          </a>
                        </td>
                        <td class="project_progress">
							ที่ตั้งของหมู่บ้านในเขตองค์การบริหารส่วนต าบลโคกขมิ้น
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>	
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-xs" href="#">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-xs" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-xs" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>  
                    </tr>
					                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
									หมู่4
                            </a>
                            <br/>
                            <small>
                                Created 01.01.2019 
                            </small>
                        </td>
                        <td>
                          <a>
                              บ้านตาพระ
                          </a>
                        </td>
                        <td class="project_progress">
							ที่ตั้งของหมู่บ้านในเขตองค์การบริหารส่วนต าบลโคกขมิ้น
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>	
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-xs" href="#">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-xs" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-xs" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>  
                    </tr>
					                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
									หมู่5
                            </a>
                            <br/>
                            <small>
                                Created 01.01.2019 
                            </small>
                        </td>
                        <td>
                          <a>
                              บ้านศรีสมบูรณ์
                          </a>
                        </td>
                        <td class="project_progress">
							ที่ตั้งของหมู่บ้านในเขตองค์การบริหารส่วนต าบลโคกขมิ้น
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>
						<td >
						     <small>
							 01/01/2563 11:15
							 </small>
                        </td>	
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-xs" href="#">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-xs" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-xs" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>  
                    </tr>

                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
          </div>
          <!--/.col (left) -->


      </div><!-- /.container-fluid -->
    </div>
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

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

