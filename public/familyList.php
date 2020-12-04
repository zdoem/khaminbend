<?php
$webtitle='จัดการข้อมูลครัวเรือน';
require 'bootstart.php';
require ROOT . '/core/security.php';
require_once 'components/header.php'; 

$data_date_survey= $db::table("fm_fam_hd")
    ->select($db::raw("YEAR(d_survey) AS d_survey"))  
    ->groupBy($db::raw("YEAR(d_survey)"))
    ->orderBy($db::raw("YEAR(d_survey)"), 'DESC')
    ->get()->toArray();

?> 
<style>
  #tblistdata_info,#tblistdata_paginate{padding:0 1.25rem;}
  .card-header{border-bottom:0}
  table.dataTable{margin-top:0 !important}
</style>
<?= \Volnix\CSRF\CSRF::getHiddenInputString('token_family_frm') ?>
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
				<div class="col-md-3">
						<div class="form-group">
						  <label>ปี :</label>
						  <select class="form-control" name="date_survey" id="date_survey">
              <option value="">เลือกปี</option>
               <?php
                foreach ($data_date_survey as $k => $v) {
                  ?>
                  <option value="<?=$v->d_survey?>"><?=$v->d_survey?></option>
                  <?php
                }
              ?> 
						  </select>

						</div>
						<!-- /.form-group -->
				</div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>บ้านเลขที่ :</label>
                  <input   type="text" name="txtHouseNo" id="txtHouseNo" class="form-control" placeholder="บ้านเลขที่...">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>ชื่อเจ้าบ้าน :</label>
                  <input   type="text" name="owner_house" id="owner_house" class="form-control" placeholder="ชื่อเจ้าบ้าน...">
                </div>
                <!-- /.form-group -->
              </div>
			  
              <!-- /.col -->
			  <div class="col-md-3">
                <div class="form-group">
                  <label>เลขที่บัตรประจำตัวประชาชน :</label>
                  <input   type="text" name="txtCitizenId" id="txtCitizenId" class="form-control" placeholder="14904xxxx2528...">
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
            <a class="btn btn-primary btn-sm" id="btn_search">
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
                </i> เพิ่มข้อมูลครัวเรือน
            </a> 
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button> 
            </div>
          </div>
          <div class="card-body table-responsive no-padding p-0">
            <table class="table table-striped projects" id="tblistdata">
                <thead align="center">
                    <tr>
                        <th style="width: 1%">
                            ลำดับ
                        </th>
                        <th style="width: 16%">
                        หมู่ที่ - ชื่อหมู่บ้าน
                        </th>
                        <th style="width: 9%">
                         บ้านเลขที่
                        </th>
					               <th style="width: 20%">
		                     ชื่อเจ้าบ้าน
                        </th>
					             	<th style="width: 24%">
	                 	      ที่อยู่ตามทะเบียนบ้าน
                        </th>
                        <th style="width: 8%">
                         วันที่สำรวจ       
                        </th>
		                    <th style="width: 7%">
                         แก้ไขล่าสุดเมื่อ     
                        </th>				
                        <th style="width: 15%">
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
          'url':'handler/family/familyDatalist.php',
          "data": function ( d ) {
            return $.extend( {}, d, {
              "date_survey":$('#date_survey').val(),
              "txtHouseNo": $('#txtHouseNo').val(),
              "owner_house": $('#owner_house').val(),
              "txtCitizenId": $('#txtCitizenId').val() 
            });
          } 
      }, 
      'columns': [ 
         { data: 'rownumber' }, 
         { data: "vil_moo" , render : function ( data, type, row, meta ) {   
              return `${row.f_vil_moo}`;
         }},
         { data: 'house_no' }, 
         { data: 'owner_fname' },
         { data: "house_no" , render : function ( data, type, row, meta ) {   
              return `-`;
         }},   
         { data: 'd_survey' }, 
         {data:"d_update" , render : function ( data, type, row, meta ) {   
              return `${row.f_update}`;
         }},
         {data: "id" , render : function ( data, type, row, meta ) {  
              return `<a class="btn btn-primary btn-xs" href="handler/family/familyView.php?id=${data}" data-toggle="modal" data-target="#MyModal">  <i class="fas fa-folder">  </i> View </a>
                      <a class="btn btn-info btn-xs" href="familyForm.php?id=${data}"><i class="fas fa-pencil-alt"> </i> Edit</a> 
                      <a class="btn btn-danger btn-xs" onClick="DeleteData(${data}); return false;" href="javascript:void(0)"><i class="fas fa-trash"></i> Delete </a>`;
        }}
      ],
      columnDefs: [ 
        {"className": "text-center" ,"orderable": false,"targets": 1},
        {"className": "text-center" ,"orderable": false,"targets": 2},
        {"className": "text-center" ,"orderable": false,"targets": 3},
        {"className": "text-center" ,"orderable": false,"targets": 4},
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
   "order": [[5, 'DESC']] 
    }); 
 
    $('#btn_search').on('click', function () { 
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
            url: "handler/family/familySave.php",
            type: "POST",
            data: {'action':3,'id': id,'token_family_frm':$("input[name*='token_family_frm']").val()},
            dataType: "json",
            success: function (data, status, xhr) {
                 if(data.status=='deleted'){
                  Swal.fire("Done!", "ลบข้อมูลเรียบร้อย !", "success");
                 }else{
                  Swal.fire("Error deleting!", "Please try again", "error");
                 }
                $("input[name*='token_family_frm']").val(data.token); 
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
        <div class="modal-dialog modal-xl">
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
            <div class="col-12">
				     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
					
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
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