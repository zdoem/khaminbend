<?php
 require 'bootstart.php';    
 require ROOT.'/core/security.php';
 require_once 'components/header.php';   
?>
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard Beta V0.1</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                	<em class="fa fa-home"></em>
                <a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Beta V0.1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
       <div class="container-fluid"> 
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">10 Feb. <?=date('yy')?> </span>
              </div> 
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <!-- <span class="time"><i class="fas fa-clock"></i> 12:05</span> -->
                  <h3 class="timeline-header"><a href="#">admin Team</a> sent you an email</h3> 
                  <div class="timeline-body">
                        ทดสอบระบบ
                  </div> 
                </div>
              </div> 
              <!-- END timeline item -->
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
    <!-- /.content -->

<?php
 require_once 'components/footer.php';  
?>