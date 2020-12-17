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
 
 //TODO : request.getparameter from

 $deptCode = '01'; //(isset($_POST['deptCode']) ? $_POST['deptCode'] : '');
 $roleId = (isset($_POST['roleId']) ? $_POST['roleId'] : '');
 $userId = (isset($_POST['userId']) ? $_POST['userId'] : '');
 $fname = (isset($_POST['fname']) ? $_POST['fname'] : '');

 //TODO : for main query
 $resultRow = $db::table('tbl_users as a')
 ->leftJoin('tbl_departments as b', 'a.dept_code', '=', 'b.dept_code')
 ->leftJoin('tbl_role as c', 'a.role_code', '=', 'c.role_code')
 ->select($db::raw("a.*"),$db::raw("b.*"),$db::raw("c.*"))
 ->where([
     ['a.f_status', '=', 'A'],
     ['a.dept_code', '=', $deptCode],
     ['a.user_id', '=', $userId],
 ]);
 if($fname != '') {
     $resultRow->orWhere('a.fname', 'like','%'.$fname.'%');
 }
 $dataList = $resultRow->orderBy('a.user_id', 'asc')
 ->get()->toArray();
 

 /*$listResultRow = $db::table('tbl_users as a');
 if($fname != '') {
     $listResultRow->orWhere('a.fname', 'like','%'.$fname.'%');
 }
 .... join where อะไรก็ว่าไป
 $data = $listResultRow->get()->toArray();
 
 /*
 ->orWhere(function($query) {
     $query->where('a.fname', $fname)
     ->where('a.fname', 'like','%'.$fname.'%');
 })*/
 //->orWhere('a.fname', 'like','%'.$fname.'%')
 /*->orWhere(function($query) {
  $query->where('a.fname', $fname)
  ->where('a.fname', 'like','%'+$fname);
  })*/
 /*->whereColumn([
     ['first_name', '=', 'last_name'],
     ['updated_at', '>', 'created_at'],
 ])->get();
 */

 
?> 
 <!-- Content Header (Page header) -->
 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#bntSearch").click(function(){  
        //alert('xxx');      
        $("#frmUsr").submit(); // Submit the form
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
            <h1 class="m-0 text-dark">รายการผู้ใช้งาน<small></small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  
              <li class="breadcrumb-item"><a href="#">รายการผู้ใช้งาน</a></li>
              <!--<li class="breadcrumb-item active">Top Navigation</li>-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<form action="userRegFarmList.php" id="frmUsr" method="post">  
 <input type="hidden" id="cmd" name="cmd" value="I">
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
  					<select class="form-control" name="deptCode" readonly>
                    <option value='01' selected>กองส่งเสริมการเกษตร</option>
                    <option value='02' >สำนักงานปลัด อบต. </option>
                    <option value='03' >กองช่าง</option>
                    <option value='04' >กองช่าง</option>
					<option value='05' >กองการศึกษาและศาสนา</option>
					<option value='06' >กองสวัสดิการสังคม</option>
					</select>                   
                </div>
                <!-- /.form-group -->
              </div>
			  <div class="col-md-3">
                <div class="form-group">
                  <label>บทบาท :</label>
 					<select class="form-control" name="roleCode">
                    <option value="01">Users</option>
                    <option value="02">Supervisor</option>
                    <option value="88">ปลัดหรือตำแหน่งพิเศษ</option>
                    <option value="99">Admin</option>
					</select>                   
                </div>
                <!-- /.form-group -->
              </div>           
              <div class="col-md-3">
                <div class="form-group">
                  <label>UserId:</label>
                  <input type="text" name="userId" value="<?php echo $userId?>" id="userId" class="form-control" placeholder="UserId ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>ชื่อ-สกุล :</label>
                  <input type="text" name="fname"  id="fname" value='<?php echo $fname?>' class="form-control" placeholder="ชื่อ...">
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
            <a class="btn btn-primary btn-sm" href="#" id='bntSearch'>
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
            <a class="btn btn-info btn-sm" href="userRegFarmForm.php">
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
                        <th style="width: 1%"> # </th>
                        <th style="width: 25%">ชื่อ-นามสกุล</th>
                        <th style="width: 10%">Email </th>
						<th style="width: 10%">เบอร์มือถือ</th>
                        <th style="width: 15%">ตำแหน่ง </th>
                        <th style="width: 20%">แผนก/กอง</th>
		                <th style="width: 10%">บทบาท </th>	
		                <th style="width: 20%"></th>							
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //$selectedx = "";
                    foreach ($dataList as $k => $v) { 
                    ?>
                    <tr>
                        <td>#
                        </td>
                        <td><a><?=$v->fname?> <?=$v->lname?></a>
                            <br/>
                            <small>Created <?=$v->d_create?>
                            </small>
                        </td>
                        <td>
                          <a><?=$v->email?></a>
                        </td>
                        <td class="project_progress"><?=$v->mobile?></td>
						<td >
						     <small><?=$v->position_name?></small>
                        </td>
						<td >
						     <small><?=$v->dept_name?></small>
                        </td>
						<td >
						     <small><?=$v->role_name?></small>
                        </td>	
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-folder"></i> View</a>
                            <a class="btn btn-info btn-xs" href="userRegFarmEdit.php?userId=<?=$v->user_id?>">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <a class="btn btn-danger btn-xs" href="#">
                                <i class="fas fa-trash"></i> Delete </a>
                        </td>  
                    </tr>                        
                        
                      <?php
                    }
                    ?>               
               
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
</form>


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
</div>
<!-- ./wrapper -->

