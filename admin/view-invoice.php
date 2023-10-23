<?php
require '../config/functions.php';




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usman Traders Dadu</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="wrapper">
    <section class="invoices" id="billingPart">
        
            <div class="row">
                <div class="col-12">
                        <?php
                        if (isset($_GET['invoice'])) {
                            $invoice_no = validate($_GET['invoice']);

                            // fetch customer data;
                            $invoiceData = mysqli_query($conn, " SELECT c.id AS customer_id, i.id AS invoice_id, i.created_at as invoice_created, i.*, c.* FROM
                        customers c, invoices i  WHERE c.id = i.customer_id AND i.id = '$invoice_no' ORDER BY i.id DESC");
                            if ($invoiceData) {
                                if (mysqli_num_rows($invoiceData) > 0) {
                                    $c_row = mysqli_fetch_assoc($invoiceData);
                        ?>
                                    <!-- Main content -->
                                    <!--================-->
                                    <div class="invoice p-3 mb-3" >
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>
                                                    <i class="fas fa-globe"></i> Usman Traders
                                                    <small class="float-right">Date: <?= date('d/M/Y', strtotime($c_row['invoice_created'])) ?></small>


                                                </h4>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-5 invoice-col">
                                                From
                                                <address>
                                                    <strong>Usman Traders Dadu</strong><br>
                                                    Address: Near Miskeen Hotel, Moro Road Dadu<br>
                                                    Phone: 03163274810<br>
                                                    Email: usmantradersdadu@gmail.com
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                To
                                                <address>
                                                    <strong><?= $c_row['customer_name'] ?></strong><br>
                                                    Address: <?= $c_row['customer_address'] ?><br>
                                                    Phone: <?= $c_row['customer_phone'] ?><br>
                                                    Shop Name: <?= $c_row['customer_shop_name'] ?>
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 invoice-col">
                                                Order ID: <b> <?= $c_row['order_number'] ?></b><br>
                                                Invoice No: <b><?= $c_row['invoice_number'] ?></b></br><br>
                                                <!-- <b>Payment Due:</b> 2/22/2014<br>
                                        <b>Account:</b> 968-34567 -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                            <?php
                                }
                            }
                        }
                            ?>
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Price/Unit</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $invoice_id = $c_row['invoice_id'];
                                            $query = "SELECT i.*, ii.*, it.*
                                                FROM invoices i
                                                JOIN invoice_items ii ON i.id = ii.invoice_id
                                                JOIN items it ON ii.item_id = it.id
                                                WHERE i.id = '$invoice_id';";

                                            $result = mysqli_query($conn, $query);
                                            $i = 1;
                                            $totalAmount = 0; // Initialize the total amount variable

                                            if ($result && mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $amount = $row['price'] * $row['quantity'];
                                                    $payment_method = $row['payment_method'];
                                                    $totalAmount = $row['total_amount']; // Update the total amount

                                            ?>
                                                    <tr>
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $row['item_name']; ?></td>
                                                        <td><?= $row['quantity']; ?></td>
                                                        <td><?= $row['unit'] ?? 'null'; ?></td>
                                                        <td>Rs <?= number_format($row['price'], 0); ?>.00</td>
                                                        <td>Rs <?= number_format($amount, 0); ?>.00</td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.row -->

                            <?php if (isset($totalAmount)) { ?>
                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                        <p class="lead">Payment: <?= $payment_method; ?></p>
                                        <div class="mb-4">
                                            <p class="mb-0">AMOUNT IN WORDS</p>
                                            <!-- Amount in words -->
                                            <input type="hidden" id="amount" value="<?= $totalAmount ?>">
                                            <h4 id="words"></h4>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>Rs <?= number_format($totalAmount, 0) ?>.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax (%)</th>
                                                    <td>0%</td>
                                                </tr>
                                                <tr>
                                                    <th>Discount (%)</th>
                                                    <td>0%</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>Rs <?= number_format($totalAmount, 0) ?>.00</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            <?php } ?>



                            <div class="col-12">
                                <p class="text-muted mb-0">Thankyou for doing business with us..</p>
                                <p class="text-muted mb-0 text-right" style="font-size:8px">Developed by: Software Engineer Ihsaan Chandio</p>

                            </div>
                                    </div>
                                    <!-- /.invoice -->
                   <!-- /.col -->
                </div>
            </div><!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <div class="mb-2 float-right">
                    <!-- onclick="downloadPDF(<?= $invoice_id ?>)" -->
                        <!-- <a href="#"  class="btn btn-default"><i class="fas fa-download"></i> Download PDF</a> -->
                        <a href="#" onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    </div>
                </div>
            </div>

    </section>


    <!-- /.content -->
</div>

<!-- Page specific script -->

<script>
  window.addEventListener("load", window.print());
</script>

</body>
</html>
