<?php 
 require 'bootstart.php';   
 require ROOT . '/core/security.php';
 require_once 'components/header.php';   
?>
<style>
  #tblistdata_info,#tblistdata_paginate{padding:0 1.25rem;}
  .card-header{border-bottom:0}
  table.dataTable{margin-top:0 !important}
</style>
<?= \Volnix\CSRF\CSRF::getHiddenInputString('token_village_frm') ?>
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
                  <input type="text" name="txtMoo"  id="txtMoo" value="<?=(isset($_GET['house_moo'])?$_GET['house_moo']:'')?>" class="form-control" placeholder="หมู่ที่ ...">
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
            <a class="btn btn-primary btn-sm" href="#" id="villageListData">
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
					            	<th style="width: 25%">  รายละเอียดพอสังเขป  </th>
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
  var table=table||{};
  $(function(){ 
    $("#MyModal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget); 
        $(this).find(".modal-body").load(link.attr("href"));
    }); 

      table=$('#tblistdata').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true, 
      'info'        : true,
      'autoWidth'   : false,
      "info": false,
      "dom": '<"top"i>rt<"bottom"flp><"clear">',
      "oLanguage": {
        "sEmptyTable":"*** ยังไม่มีข้อมูล ***"
      },
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'handler/village/villagelist.php',
          "data": function ( d ) {
            return $.extend( {}, d, {
              "vil_moo": $('#txtMoo').val(),
              "vil_name":$('#txtVillageName').val()
            });
          } 
      }, 
      'columns': [ 
         { data: 'rownumber' },
         { data: 'vil_moo' },
         { data: 'vil_name' },
         { data: 'vil_desc' },
         { data: 'd_update' },
         {data: "id" , render : function ( data, type, row, meta ) {  
              return `<a class="btn btn-primary btn-xs" href="handler/village/villageView.php?id=${data}" data-toggle="modal" data-target="#MyModal">  <i class="fas fa-folder">  </i> View </a>
                      <a class="btn btn-info btn-xs" href="villageFormEdit.php?id=${data}"><i class="fas fa-pencil-alt"> </i> Edit</a> 
                      <a class="btn btn-danger btn-xs" onClick="DeleteData(${data}); return false;" href="javascript:void(0)"><i class="fas fa-trash"></i> Delete </a>`;
        }}
      ],
      columnDefs: [ 
        {
        "className": "text-center", 
        "searchable": false,
        "orderable": false,
        "targets": 0
    },  
    {
        "className": "text-center",
        "targets":-2
    }, 
    // {   "orderable": false, 
    //     targets: -1, //-1 es la ultima columna y 0 la primera
    //     data: null,
    //     defaultContent: '<div class="btn-group"> <button type="button" class="btn btn-info btn-xs dt-view" style="margin-right:16px;"><span class="glyphicon glyphicon-eye-open glyphicon-info-sign" aria-hidden="true"></span></button>  <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-danger btn-xs dt-delete"><span class="glyphicon glyphicon-remove glyphicon-trash" aria-hidden="true"></span></button></div>'
    // },
    { orderable: false, searchable: false, targets: -1,"className": "text-center" } //Ultima columna no ordenable para botones
   ],
   "order": [[1, 'asc']] 
    }); 
 
    $('#villageListData').on('click', function () { 
       table.ajax.reload();
      //  table.search(this.value).draw();  
    });

  }); 
  function DeleteData(id){
    Swal.fire({
      title: 'ยืนยันการลบข้อมูล?',
      text: "คุณจะไม่สามารถกู้คืนข้อมูลได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบ',
      cancelButtonText:'ยกเลิก' 
    }).then(function(result){
      if (!result.isConfirmed) return;
        $.ajax({
            url: "handler/village/village.php",
            type: "POST",
            data: {'action':3,'id': id,'token_village_frm':$("input[name*='token_village_frm']").val()},
            dataType: "json",
            success: function (data, status, xhr) { 
                 if(data.status=='deleted'){
                  Swal.fire("Done!", "ลบข้อมูลเรียบร้อย !", "success");
                 }else if(data.status=='delete_used'){
                  Swal.fire("มีการใช้อยู่ไม่สามารถลบข้อมูลได้ !", "Please try again", "error");
                 }else {
                  Swal.fire("Error deleting!", "Please try again", "error");
                 }
                $("input[name*='token_village_frm']").val(data.token); 
                table.ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              Swal.fire("Error deleting!", "Please try again", "error");
            }
        });
    }); 
  }

 </script>
 <!-- Modal html-->
       <div class="modal fade" id="MyModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">แสดงข้อมูล</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Main content -->
              
              <!-- /.content -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!--<button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<?php
 require_once 'components/footer.php';  
?>