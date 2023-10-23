<?php
include_once 'include/header.php';
if (!isset($_SESSION['productItems'])) {
    echo '
            <script>
                window.location.href = "create-invoice.php";
            </script>
        ';
}
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="col-12">
                <?php alertMessage(); ?>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <?php
                    if (isset($_SESSION['customer_id'])) {
                        $customer_id = $_SESSION['customer_id'];
                        $invoice_number = $_SESSION['invoice_number'];
                        $payment_method = $_SESSION['payment_method'];

                        // fetch customer data;
                        $customerData = mysqli_query($conn, " SELECT * FROM customers WHERE id = '$customer_id' LIMIT 1 ");
                        if ($customerData) {
                            if (mysqli_num_rows($customerData) > 0) {
                                $c_row = mysqli_fetch_assoc($customerData);
                    ?>
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-globe"></i> Usman Traders
                                                <small class="float-right">Date: <?php echo $currentDate = date('d/M/Y'); ?></small>
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
                                            Order ID: <b> <?= $_SESSION['order_number'] ?></b><br>
                                            Invoice No: <b><?= $_SESSION['invoice_number'] ?></b></br><br>
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
                        <?php
                        if (isset($_SESSION['productItems'])) {
                            $sessionItems = $_SESSION['productItems'];
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
                                            $i = 1;
                                            $totalAmount = 0;
                                            foreach ($sessionItems as $key => $row) :
                                                $totalAmount += $row['price'] * $row['quantity'];
                                                $amount = $row['price'] * $row['quantity'];
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row['item_name']; ?></td>
                                                    <td><?= $row['quantity']; ?></td>
                                                    <td><?= $row['unit']; ?></td>
                                                    <td>Rs <?= number_format($row['price'], 0); ?>.00</td>
                                                    <td>Rs <?= number_format($amount, 0); ?>.00</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->



                        <?php
                        }

                        ?>


                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Payment: <?= ($_SESSION['payment_method'] == 'cash') ? 'Cash' : 'Online' ?></p>

                                <div class="mb-4">
                                    <p class="mb-0">AMOUNT IN WORDS</p>
                                     <!-- Amount in words -->
                                    <input type="hidden" id="amount" value="<?= $totalAmount ?>">
                                    <h4 id="words"></h4>
                                </div>



                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <!-- <p class="lead">Amount Due 2/22/2014</p> -->

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

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-6">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

                            </div>
                            <div class="col-6">
                                <div>
                                    <button type="button" id="saveOrder" class="btn btn-success float-right px-4 ml-2">
                                        Save
                                    </button>
                                </div>
                                <a href="create-invoice.php" class="btn btn-primary float-right">Go Back</a>

                            </div>
                            <div class="col-12">
                                <div class="mt-3 d-flex justify-content-between">
                                    <p class="text-muted mb-0">Thankyou for doing business with us..</p>
                                    <p class="text-muted mb-0">Developed by: Software Engineer Ihsaan Chandio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'include/footer.php'; ?>