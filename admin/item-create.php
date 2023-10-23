<?php include_once 'include/header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add New Item</h1>
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
                                <label for="">Item Name <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="item_name" placeholder=" Choco bite ...">
                            </div>
                        </div>
                        <div class="col-6 col-sm-6">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <select class="form-control select2bs4" name="brand_id" style="width: 100%;">
                              <?php 
                                $brands = getAll('brands');
                                if(!$brands)
                                {
                                  echo '<h5> Ops! something went wrong...</h5>';
                                  return false;
                                }
                                if(mysqli_num_rows($brands) > 0)
                                {
                                ?>
                                <option value="" selected="selected" disabled>Select brand</option>
                                <?php foreach($brands as $key => $value ):?>
                                  <option value="<?= $value['id'] ?>"><?= $value['brand_name'] ?></option>
                                <?php endforeach;?>
                                  
                                  <?php
                                }
                              ?>

                                
                            </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="">Price <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="price" placeholder="Rs. 500">
                            </div>
                        </div>

                        <!-- <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="">Price/Pkt <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="price_per_pkt" placeholder="Rs. 500">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="">Price/Ctn <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="price_per_ctn" placeholder="Rs. 1500">
                            </div>
                        </div> -->
                        
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <button type="reset" class="btn btn-info px-3">Reset</button>
                                <button type="submit" name="addItem" class="btn btn-primary px-4">Add</button>
                                <a href="items.php" class="btn btn-light px-3">Go back</a>
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