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
 /*->where('f_status', '=', 'A')*/
 ->where([
     ['f_status', '=', 'A'],
     ['role_code', '<>','99']
 ])
 ->orderBy('role_name', 'asc')
 ->get()->toArray();
 
 //TODO : request.getparameter from

 $deptCode = (isset($_POST['deptCode']) ? $_POST['deptCode'] : '');
 if($deptCode==''){
     $deptCode = "01";
 }
 $roleId = (isset($_POST['roleCode']) ? $_POST['roleCode'] : '');
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
     ['c.role_code', '<>','99']
 ]);
 //['a.user_id', '=', $userId],

 if($roleId != '') {
     $resultRow->where('a.role_code', '=', $roleId);
 }
 if($userId != '') {
     $resultRow->where('a.user_id', '=', $userId);
 }
 if($fname != '') {
     $resultRow->orWhere('a.fname', 'like','%'.$fname.'%');
 }
 $dataList = $resultRow->orderBy('a.user_id', 'asc')
 ->get()->toArray();
 

?> 
<style>
table.dataTable thead>tr>th{font-size:.9em;}
#tblistdata_info,#tblistdata_paginate{padding:0 1.25rem;}
.card-header{border-bottom:0}
table.dataTable{margin-top:0 !important}
</style> 
<script>
var table=table||{};
$(document).ready(function(){  

      table=$('#tblistdata').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true, 
      'info'        : false,
      'autoWidth'   : false, 
      "dom": '<"top"i>rt<"bottom"flp><"clear">',
      "oLanguage": {
        "sEmptyTable":"*** ยังไม่มีข้อมูล ***"
      },
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'handler/userDatalist.php',
          "data": function ( d ) {
            return $.extend( {}, d, { 
              "deptCode": $('#deptCode').val(),
              "roleCode": $('#roleCode').val(),
              "userId": $('#userId').val(),
              "fname": $('#fname').val()  
            });
          } 
      }, 
      'columns': [  
         { data: "user_id" , render : function ( data, type, row, meta ) {   
              return `${row.user_id}`;
         }}, 
         { data: "fname" , render : function ( data, type, row, meta ) {   
              return `${row.fullname}`;
         }},   
         { data: 'email' },
         { data: 'mobile' },
         { data: 'position_name' }, 
         { data: 'dept_name' },  
         { data: 'role_name' },     
         {data: "user_id" , render : function ( data, type, row, meta ) {  
              return `<a class="btn btn-info btn-xs" href="userRegFarmEdit.php?userId=${data}"><i class="fas fa-pencil-alt"> </i> Edit</a> 
                      <a class="btn btn-danger btn-xs" onClick="DeleteData('${data}'); return false;" href="javascript:void(0)"><i class="fas fa-trash"></i> Delete </a>`;
         }}
      ],
      columnDefs: [ 
        {"className":"text-center", "searchable": false,"orderable": true,"targets": 0},
        {"className":"text-center" ,"orderable": false,"targets": 1},
        {"className":"project_progress" ,"orderable": false,"targets": 2},
        {"className":"text-center" ,"orderable": false,"targets": 3},
        {"className":"text-center" ,"orderable": false,"targets": 4},
        {"className":"text-center" ,"orderable": false,"targets": 5},
        {"className":"text-center" ,"orderable": true,"targets": 6},
        {"className":"project-actions text-right" ,"orderable": false,"targets": 7} ,
        {"className": "text-center","targets":-2},  
       { orderable: false, searchable: false, targets: -1,"className": "text-center" } //Ultima columna no ordenable para botones
   ],
   "order": [[0, 'ASC']] 
    }); 
 
    $('#btn_search').on('click', function () { 
       table.ajax.reload(); 
    });


});
function DeleteData(id){
    Swal.fire({
      title: "ยืนยันการลลบข้อมูลผู้ใช้งาน\n รหัส  '"+id+"'  Y/n? ",
      text: "คุณจะไม่สามารถกู้คืนข้อมูลได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบ',
      cancelButtonText:'ยกเลิก' 
    }).then(function(result){
      if (!result.isConfirmed) return;
        $("#cmd").val("D");
        $.ajax({
            url: "handler/userRegFarm.php",
            type: "POST",
            data: {'cmd':$("#cmd").val(),'userDelId': id},
            dataType: "json",
             beforeSend: function() {  
              salert=Swal.fire({
              title: 'กำลังทำการลบข้อมูล',
              text: 'กรุณารอสักครู่...',
              showCancelButton: false,
              showConfirmButton: false, 
              allowOutsideClick: false
              });  
              },
            success: function (data, status, xhr) {
                 if(data.status=='deleted'){
                  Swal.fire("Done!", "ลบข้อมูลเรียบร้อย !", "success");
                 }else{
                  Swal.fire("Error deleting!", "Please try again", "error");
                 } 
                salert.close();
                table.ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              salert.close();
              Swal.fire("Error deleting!", "Please try again", "error");
            }
        });
    }); 
  } 

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
 <input type="hidden" id="userDelId" name="userDelId" >
    <!-- Main content -->
    <div class="content">
      <div class="container">

		<div class="row">
          <!-- left column -->
          <div class="col-sm-12">
		   
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">เงื่อนไขการค้นหา</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> 
            </div>
          </div> 
          <div class="card-body">

            <div class="row">
 			  <div class="col-md-3">
                <div class="form-group"> 
                <label>แผนก/กอง :</label>
                <select class="form-control" id="deptCode" name="deptCode" readonly required="required">
                    <?php 
                    $selectedx = "";
                    foreach ($listmas_dept as $k => $v) { 
                        $selectedx = "";
                        if($v->dept_code == $deptCode)
                            $selectedx = "selected"
       
                    ?>
                        <option value="<?=$v->dept_code?>" <?=$selectedx?>><?=$v->dept_code?> <?=$v->dept_name?></option>
                      <?php
                    }
                    ?>
                    </select>                   
                </div>
                <!-- /.form-group -->
              </div>
			  <div class="col-md-3">
                <div class="form-group">
                  <label>บทบาท :</label> 
					<select class="form-control" id="roleCode" name="roleCode" required="required">
                    <option value="">---กรุณาเลือกบทบาท---</option>
                    <?php 
                    foreach ($listmas_role as $k => $v) {
                        $selectedx = "";
                        if($v->role_code == $roleId)
                            $selectedx = "selected"
                    ?>
                        <option value="<?=$v->role_code?>" <?=$selectedx?> ><?=$v->role_name?></option>
                     <?php
                    }
                    ?>
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

          <div class="card-footer">
            <a class="btn btn-primary btn-sm" href="#" id='btn_search'>
                <i class="fas fa-search">
                </i> ค้นหา
            </a>
          </div>
        </div> 
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">รายละเอียดการค้นหา</h3>&nbsp;  &nbsp;
            <a class="btn btn-info btn-sm" href="userRegFarmForm.php">
              <i class="fas fa-plus-square">
                </i> ลงทะเบียนผู้ใช้งาน
            </a>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-responsive table-striped projects" id="tblistdata">
                <thead>
                    <tr>
                        <th style="width: 5%"> ID </th>
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

