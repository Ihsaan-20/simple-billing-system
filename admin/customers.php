<?php include_once 'include/header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
    <div class="row"><div class="col-12"><?php alertMessage(); ?></div></div>

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">customers List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <div class="float-sm-right">
            <a href="customer-create.php" class="btn btn-primary">Add new customer</a>
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
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Customer Shop Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Address</th>
                    <th>Action</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $customers = getAll('customers');
                      if(!$customers)
                      {
                        echo '<h1>Opps! something went wrong...</h1>';
                        return false;
                      }
                      if(mysqli_num_rows($customers) > 0)
                      {
                        ?>
                        <?php foreach($customers as $key => $value ): ?>
                          <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['customer_code'] ?></td>
                            <td><?= $value['customer_name'] ?></td>
                            <td><?= $value['customer_shop_name'] ?></td>
                            <td><?= $value['customer_phone'] ?></td>
                            <td><?= $value['customer_address'] ?></td>
                            <td>
                              <a href="customer-edit.php?id=<?= $value['id'] ?>" class="btn btn-primary">Edit</a>
                              <a href="customer-delete.php?id=<?= $value['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        <?php
                      }else{
                        ?>
                        <tr>
                          <td colspan="4" class="text-danger">No record found....</td>
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'include/footer.php'; ?>