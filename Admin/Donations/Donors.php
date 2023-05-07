<?php include "../include/protect.php";
include "../include/profile.inc.php";
require "../include/sidebar.php";
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
  <!--Necessary Plugins-->
  <title>Donors</title>
</head>
<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo sidebar(); ?></div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Donors</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="#" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Donors</a>
            </h6>
          </nav>
        </div>
        <div class="ms-auto">
          <div class="dropdown">
            <a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle w-100" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?>
            </a>
            <?php echo accountUpdate() ?>
          </div>
        </div>
      </div>
      <!--Header -->
      <div class="custom-container pb-3">
        <div class="card">
          <div class="card-body overflow-auto">
            <!----Filter -->
            <div class="d-flex justify-content-between">
              <div id="search-field"></div>
              <div class="d-flex">
                <button class="btn btn-success btn-rounded me-2 text-wrap" id="printDonors"><i class="fa-solid fa-print"></i></button>
                <button class="btn btn-success btn-rounded me-2 email_button text-wrap" id="bulk_email" data-action="bulk">Send to all</button>
                <button class="btn btn-success btn-rounded text-wrap" id="addPage"><i class="fa-solid fa-plus"></i></button>
              </div>
            </div>
            <div class="d-flex justify-content-between py-3">
              <div class="donor-download-btn"></div>
              <div>
                <input type="checkbox" class="btn-check" id="selectAll" autocomplete="off" />
                <label class="btn btn-secondary btn-rounded" for="selectAll">Select All</label>
              </div>
            </div>
            <!----Filter -->
            <!--Place table here --->
            <div class="table-container">
              <table class="table table-striped table-bordered w-100" id="donors_data">
                <thead>
                  <tr>
                    <th>Donor Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Donation Date</th>
                    <th>Status</th>
                    <th>Certificate</th>
                    <th>Update</th>
                    <th>Check/Delete</th>
                    <!-- Add more columns here -->
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <!--Place table here --->
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../scripts/mdb.min.js"></script>
  <script src="../scripts/sweetalert2.all.min.js"></script>
  <!--Necessary Plugins -->
  <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
  <!--Necessary Plugins -->
  <script src="scripts/Donors.js"></script>
  <script src="../scripts/TableFilterButtons.js"></script>
</body>

</html>