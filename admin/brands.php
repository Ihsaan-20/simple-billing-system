<?php include_once 'include/header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
    <div class="row"><div class="col-12"><?php alertMessage(); ?></div></div>

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Brands List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <div class="float-sm-right">
            <a href="brand-create.php" class="btn btn-primary">Add new brand</a>
          </div>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $brands = getAll('brands');
                      if(!$brands)
                      {
                        echo '<h1>Opps! something went wrong...</h1>';
                        return false;
                      }
                      if(mysqli_num_rows($brands) > 0)
                      {
                        ?>
                        <?php foreach($brands as $key => $value ): ?>
                          <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['brand_name'] ?></td>
                            <td>
                              <a href="brand-edit.php?id=<?= $value['id'] ?>" class="btn btn-primary">Edit</a>
                              <a href="brand-delete.php?id=<?= $value['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                          <?php endforeach; ?>
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'include/footer.php'; ?>