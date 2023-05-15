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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/mdb.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <!--Necessary Plugins-->
  <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <!--Necessary Plugins-->
  <title>Dashboard</title>
</head>

<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo sidebar() ?></div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Dashboard</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="#" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Dashboard</a>
            </h6>
          </nav>
        </div>
        <div class="ms-auto">
          <div class="dropdown allowed">
            <a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?>
            </a>
            <?php echo accountUpdate() ?>
          </div>
        </div>
      </div>
      <!--Header -->

      <!--reports -->
      <div class="custom-container pb-3">
        <div class="row g-3">
          <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card">
              <div class="card-header  bg-gradient bg-success"></div>
              <div class="card-body">
                <div class="row">
                  <span>
                    <h6 class="text-muted card-names">DONORS</h6>
                  </span>
                  <div class="col">
                    <?php echo count_donors($conn); ?>
                  </div>
                  <div class="col">
                    <h4 class="mb-md-2 mt-lg-1 ms-lg-5 text-dark"><i class="fas fa-user  fa-2x"></i></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card">
              <div class="card-header  bg-gradient bg-success"></div>
              <div class="card-body">
                <div class="row">
                  <span>
                    <h6 class="text-muted card-names">Distributed</h6>
                  </span>
                  <div class="col">
                    <?php echo count_distributed($conn); ?>
                  </div>
                  <div class="col">
                    <h4 class="mb-md-2 mt-lg-1 ms-lg-5 text-dark"><i class="fas fa-gift fa-2x"></i></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card">
              <div class="card-header  bg-gradient bg-success"></div>
              <div class="card-body">
                <div class="row">
                  <span>
                    <h6 class="text-muted card-names">REQUESTS</h6>
                  </span>
                  <div class="col">
                    <?php echo count_request($conn); ?>
                  </div>
                  <div class="col">
                    <h4 class="mb-md-2 mt-lg-1 ms-lg-5 text-dark"><i class="fas fa-envelope  fa-2x"></i></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-3 mt-2">
          <div class="col-s-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-start">
                  <h4>Number of items based on Category</h4>
                </div>
                <div class="d-flex justify-content-lg-end py-3">
                  <div class="dropdown  mx-2">
                    <button class="btn btn-secondary dropdown-toggle btn-rounded" type="button" id="selectCategory" data-mdb-toggle="dropdown" aria-expanded="false">
                      Select
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="selectCategory">
                      <li><a class="dropdown-item select-category" href="#" data-value="">Select</a></li>
                      <?php echo add_category($conn); ?>
                    </ul>
                  </div>
                  <div class="ps-3"><button class="btn btn-success btn-rounded" id="printBarChart"><i class="fa-solid fa-print"></i></button></div>
                </div>
                <canvas id="barChart"></canvas>
              </div>
            </div>
          </div>
          <div class="col-s-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-start">
                  <h4 class="mb-3">Total number of donated items</h4>
                </div>
                <div class="d-flex justify-content-between py-3">
                  <div class="category-table"></div>
                </div>
                <table class="table table-striped table-bordered w-100" id="category_data">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-s-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="mb-3">Requests Completed</h1>
                <div class="d-flex justify-content-between py-3">
                  <div class="request-table"></div>
                </div>
                <table class="table table-striped table-bordered w-100" id="request_data">
                  <thead>
                    <tr>
                      <th>Receipt Number</th>
                      <th>Date Completed</th>
                      <th>Status</th>
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
    <!--Necessary Plugins -->
    <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <!--Necessary Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="scripts/TotalNumberCategoryBarChart.js"></script>
    <script src="scripts/DashboardStocksTable.js"></script>
    <script src="../scripts/TableFilterButtons.js"></script>
</body>
</html>