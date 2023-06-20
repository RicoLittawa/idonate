<?php require_once '../include/protect.php';
require_once '../include/profile.inc.php';
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
  <link rel="icon" href="../img/batangascitylogo.png" type="image/x-icon">
	<link rel="shortcut icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <title>Requests</title>
</head>

<body>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
          <button type="button" class="btn-close closeModal"></button>
        </div>
        <div class="modal-body">
          <input hidden id="reference" type="text">
          <div class="form-group">
            <label for="selectStatus" class="form-label">Select Status</label>
            <select id="selectStatus" class="form-select">
              <option value="">Select Status</option>
              <option value="Ready for Pick-up">Ready for Pick-up</option>
              <option value="Request cannot be completed">Request cannot be proccessed</option>
              <option value="Request completed">Request completed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closeModal">Close</button>
          <button type="button" id="saveStatus" class="btn btn-success">
            <span class="submit-text">Save changes</span>
            <span class="spinner-border spinner-border-sm  d-none" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!--Print -->
  <div class="modal fade" id="openPrint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Print Receipt</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <button id="printReceipt" class="btn btn-secondary">Print</button>
          </div>
          <hr>
          <h4>Receipt Details</h4>
          <div id="printable_area" class="me-3 ms-3">
            <div>
              <div class="text-center">
                <img src="../img/logo1.jpg" class="logo-header" alt="">
              </div>
              <p class="mb-0 text-center lead fs-6">City Risk Reduction Management Office</p>
              <p class="mb-0 text-center lead fs-6">Brgy Bolbok, Batangas City, Philippines</p>
            </div>
            <hr class="custom-divider">
            <div class="row">
              <div class="col">
                <p class="lead fs-6 mb-0">Receipt Number: <strong id="receipt_number"></strong></p>
              </div>
              <div class="col">
                <p class="lead fs-6 mb-0">Request Date: <strong id="request_date"></strong></p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="lead fs-6 mb-0">Name: <strong id="name"></strong></p>
              </div>
              <div class="col">
                <p class="lead fs-6 mb-0">Position: <strong id="position"></strong></p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="lead fs-6 mb-0">No. of Evacuees/Families: <strong id="evacuees_qty"></strong></p>
              </div>
              <div class="col">
                <p class="lead fs-6 mb-0">Status: <strong id="status"></strong></p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="lead fs-6 mb-0">Email: <strong id="email"></strong></p>
              </div>
              <div class="col">
                <p class="lead fs-6 mb-0">Receive Date: <strong id="receive_date"></strong></p>
              </div>
            </div>
            <div class="table-responsive">
              <table id="table-container" class="table table-sm table-bordered">
                <thead class="bg-light">
                  <tr>
                    <th>Quantity</th>
                    <th>Product name</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
      <?php echo sidebar($conn); ?>
    </div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Process Request</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="../Dashboard/Dashboard.php" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Request</a>
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
        <div class="card">
          <div class="card-body">
            <!----Filter -->
            <div class="d-flex justify-content-end">
              <div id="search-field"></div>
            </div>
            <div class="d-flex justify-content-between py-3">
              <div class="request-download-btn"></div>
              <div class="form-group">
                <div id="status_filter"></div>
              </div>
            </div>
            <!----Filter -->
            <div class="table-responsive">
              <table class="table align-middle mb-0 bg-white table-hover w-100" id="request_data_main">
                <thead class="bg-light">
                  <tr>
                    <th>Receipt No.</th>
                    <th>Name</th>
                    <th>No. Evacuees</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>View/Accept</th>
                    <th>Delete</th>
                    <!-- Add more columns here -->
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
        <!--End of main content -->
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
  <script src="scripts/RequestTable.js"></script>
  <script src="../scripts/TableFilterButtons.js"></script>
</body>

</html>