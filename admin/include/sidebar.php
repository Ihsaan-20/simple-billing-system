<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../admin/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Usman Trader</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../admin/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['user']['name'] ?> <span class="badge badge-success right"><?php echo ($_SESSION['user']['status'] == 1) ? 'online' : ''; ?></span></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          <li class="nav-header">POS</li>
          <li class="nav-item">
            <a href="../admin/create-invoice.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Create Invoice
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../admin/invoices.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Invoices
              </p>
            </a>
          </li>
          
          <li class="nav-header">Products Management</li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Items
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../admin/item-create.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Item</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../admin/items.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View All Items</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Brands
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../admin/brand-create.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New brand</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../admin/brands.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View All Brands</p>
                  </a>
                </li>
              </ul>
            </li>
            
          <li class="nav-header">Users Management</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../admin/customer-create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../admin/customers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All Customers</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admins/Staff
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../admin/admins-create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../admin/admins.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View All</p>
                </a>
              </li>
              
            </ul>
          </li>
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

