<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link <?php if (isset($page_slug)) {if ($page_slug == 'dashboard') {echo "active";}}?>" aria-current="page" href="index.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link  <?php if (isset($page_slug)) {if ($page_slug == 'all-invoice') {echo "active";}}?> " href="all-invoice.php">
                <span data-feather="file"></span>
                All Invoice
              </a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link <?php if (isset($page_slug)) {if ($page_slug == 'create-invoice') {echo "active";}}?>" href="create-invoice.php">
                <span data-feather="file"></span>
                Add New Invoice
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="all-users.php">
                <span data-feather="users"></span>
                All Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create-user.php">
                <span data-feather="users"></span>
                Add New Customer
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="all-products.php">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>
        
            <li class="nav-item">
              <a class="nav-link" href="">
                <span data-feather="bar-chart-2"></span>
                Reports
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="layers"></span>
                Integrations
              </a>
            </li> -->
          </ul>

       
        
        </div>
      </nav>


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">