<?php include_once 'include/header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add New Brand</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol> -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
  <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">All admin list here</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <?php alertMessage();?>
               <form action="process.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="">Brand Name <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="brand_name" placeholder="Candyland ...">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <button type="reset" class="btn btn-info px-3">Reset</button>
                                    <button type="submit" name="addBrand" class="btn btn-primary px-4">Add</button>
                                    <a href="brands.php" class="btn btn-light px-3">Go back</a>
                                </div>
                            </div>
                    </div>
               </form>
              </div>    
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'include/footer.php'; ?>