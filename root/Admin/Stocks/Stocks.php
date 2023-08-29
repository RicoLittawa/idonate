<?php require_once "../include/protect.php";
require_once "../include/profile.inc.php";
require_once "../include/FunctionSelectBox.php";
require_once "../include/sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/mdb.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <!--Necessary Plugins-->
  <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <link rel="icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <link rel="shortcut icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <!--Necessary Plugins-->

  <title>Stocks</title>
</head>

<body>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Expiry Date</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="" class="form-label">Product</label>
            <input type="text" class="form-control" id="product" readonly>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="year" class="form-label">Year</label>
                <select name="year" id="year" class="form-select">
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="month" class="form-label">Month</label>
                <select name="month" id="month" class="form-select">
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="day" class="form-label">Day</label>
                <select name="day" id="day" class="form-select">
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Add</button>
        </div>
      </div>
    </div>
  </div>
  <?php echo showAdminModal($conn) ?>
  <div class="main-container">
    <!-- Desktop SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo adminSidebar(); ?></div>
    <!-- Desktop SIDEBAR -->
    <!-- Mobile nav -->
    <nav class="mobide-nav navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#mobileAdminNavbar" aria-controls="mobileAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-light"></i>
        </button>
        <div class="collapse navbar-collapse" id="mobileAdminNavbar">
          <?php echo showMobileAdminNav() ?>
        </div>
        <div class="d-flex align-items-center">
          <?php echo showNotificationAdminMobile($conn) ?>
          <div class="dropdown">
            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?> </a>
            <?php echo adminMenu($conn); ?>
          </div>
        </div>
      </div>
    </nav>
    <!-- Mobile nav -->
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb pt-4 me-md-5">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Stocks</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="../Dashboard/Dashboard.php" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Stocks</a>
            </h6>
          </nav>
        </div>
        <div class="profile-container ms-auto">
          <div class="dropdown allowed">
            <a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?>
            </a>
            <?php echo adminMenu($conn) ?>
          </div>
        </div>
      </div>
      <!--Header -->
      <!--reports -->
      <div class="custom-container pb-3 me-2 me-md-5">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <!----Filter -->
              <div class="d-flex justify-content-md-end">
                <div id="search-field"></div>
              </div>
              <div class="d-flex justify-content-between py-3">
                <div class="stocks-download-btn"></div>
                <div id="category_filter"></div>
              </div>
              <!----Filter -->
              <table class="table align-middle mb-0 bg-white table-hover w-100" id="stocks_data">
                <thead class="bg-light">
                  <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Available Stock</th>
                    <th>Stock Out</th>
                    <th>Add Expiry</th>
                    <!-- Add more columns here -->
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../scripts/mdb.min.js"></script>
  <script src="../scripts/sweetalert2.all.min.js"></script>
  <script src="../scripts/timeout.js"></script>
  <!--Necessary Plugins -->
  <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
  <!--Necessary Plugins -->
  <script src="../scripts/TableFilterButtons.js"></script>
  <script src="scripts/StocksTable.js"></script>
  <script src="scripts/AddExpiry.js"></script>
  <script src="../scripts/ShowNotification.js"></script>
</body>

</html>