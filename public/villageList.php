<?php 
 require 'bootstart.php';   
 require_once 'components/header.php';   
?>
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ข้อมูลหมู่บ้าน</h1>
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>หมู่ที่ :</label>
                  <input type="text" name="txtMoo"  id="txtMoo" class="form-control" placeholder="หมู่ที่ ...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>ชื่อหมู่บ้าน :</label>
                  <input type="text" name="txtVillageName"  id="txtVillageName" class="form-control" placeholder="ชื่อหมู่บ้าน...">
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
            <a class="btn btn-primary btn-sm" href="villageListData.php">
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
            <a class="btn btn-info btn-sm" href="villageForm.php">
              <i class="fas fa-plus-square">
                </i> เพิ่มข้อมูลหมู่บ้าน
            </a>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects" id="tblistdata">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 15%">
                            หมู่ที่
                        </th>
                        <th style="width: 20%">
                            ชื่อหมู่บ้าน
                        </th>
						<th style="width: 25%">
		 ข้อทั่วไปของหมู่บ้าน
                        </th>
                        <th style="width: 15%">
                       แก้ไขล่าสุดเมื่อ             
                        </th>
                        <th style="width: 20%">
                        </th>

                    </tr>
                </thead>
                <tbody> 
                  
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
 <script>
  $(function(){

    $('#tblistdata').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "oLanguage": {
        "sEmptyTable":"*** ยังไม่มีข้อมูล ***"
      }
    }); 

  });
 </script>
<?php
 require_once 'components/footer.php';  
?>