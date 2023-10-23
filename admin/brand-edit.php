<?php include_once 'include/header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Update brand</h1>
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
                            <?php alertMessage(); ?>
                            <form action="process.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        if ($_GET['id'] != '') {
                                            $brand_id = $_GET['id'];
                                        } else {
                                            echo '<h5>ID not found!</h5>';
                                            return false;
                                        }
                                    } else {
                                        echo '<h5>No ID given in params</h5>';
                                        return false;
                                    }

                                    $brandData = getById('brands', $brand_id);

                                    if ($brandData) {
                                        if ($brandData['status'] == 200) {
                                    ?>
                                            <!-- all fields -->
                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="">Brand Name <span class="text-danger">*</span> </label>
                                                    <input type="hidden" class="form-control" name="brand_id" value="<?= $brandData['data']['id'] ?>" >
                                                    <input type="text" class="form-control" name="brand_name" value="<?= $brandData['data']['brand_name'] ?>" placeholder="Candyland ...">
                                                </div>
                                            </div>
                                    <?php
                                        } else {
                                            echo '<h5>' . $brandData['message'] . '</h5>';
                                        }
                                    } else {
                                        echo '<h5>Opps! something went wrong..</h5>';
                                        return false;
                                    }

                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <button type="reset" class="btn btn-info px-3">Reset</button>
                                            <button type="submit" name="updateBrand" class="btn btn-primary px-4">Update</button>
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