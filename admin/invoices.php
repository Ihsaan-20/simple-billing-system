<?php include_once 'include/header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
    <div class="row"><div class="col-12"><?php alertMessage(); ?></div></div>

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Invoices</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <div class="float-sm-right">
            <a href="create-invoice.php" class="btn btn-primary">Create new invoice</a>
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
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Invoice Number</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $query = "SELECT c.id, c.customer_name, c.customer_phone, i.id, i.invoice_number, i.total_amount 
                      FROM customers c 
                      LEFT JOIN invoices i
                      ON c.`id` = i.`customer_id` ORDER BY i.id DESC ";
                      $invoices = mysqli_query($conn, $query);

                      if ($invoices) {
                          if (mysqli_num_rows($invoices) > 0) {
                              foreach ($invoices as $key => $value) {
                                  // Check if the invoice ID exists
                                  if ($value['id']) {
                                      // Invoice ID exists, display the invoice details
                                      ?>
                                      <tr>
                                          <td><?= $key + 1 ?></td>
                                          <td><?= $value['customer_name'] ?></td>
                                          <td><?= $value['customer_phone'] ?></td>
                                          <td><?= $value['invoice_number'] ?></td>
                                          <td><?= number_format($value['total_amount'], 0) ?>.00</td>
                                          <td>
                                              <a href="view-invoice.php?invoice=<?= $value['id']; ?>" class="btn btn-warning">View</a>
                                              <a href="view-invoice.php?invoice=<?= $value['id']; ?>" rel="noopener" target="_blank" class="btn btn-default" class="btn btn-info"><i class="fas fa-print"></i>Print</a>
                                          </td>
                                      </tr>
                                      <?php
                                  } else {
                                     
                                  }
                              }
                          }
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