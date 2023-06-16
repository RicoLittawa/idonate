<?php require_once "../include/protect.php";
require_once "../include/profile.inc.php";
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
  <!--Necessary Plugins-->
  <title>User Details</title>
</head>
<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo sidebar() ?> </div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Users</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="../Dashboard/Dashboard.php" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Users</a>
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
      <div class="custom-container pb-3">
        <div class="card">
          <div class="card-body overflow-auto">
            <div id="registerForm" class="collapse mt-5" data-duration="500">
              <form class="pe-2 mb-3" id="add-user">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="fname" class="form-control" />
                      <label class="form-label" for="fname">First name</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="lname" class="form-control" />
                      <label class="form-label" for="lname">Last name</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="position" class="form-control" placeholder="e.g. Brgy Captain/Employee" />
                      <label class="form-label" for="position">Position</label>
                    </div>
                  </div>
                </div>
                <!-- Email and Password inputs -->
                <div class="form-outline mb-4">
                  <input type="text" id="email" class="form-control" />
                  <label class="form-label" for="email">Email address</label>
                </div>
                <div class="input-group form-outline mb-4">
                  <input type="password" class="form-control" id="password">
                  <div class="input-group-append">
                    <button class="btn btn-success h-100" type="button" id="generatePasswordBtn">Generate Password</button>
                  </div>
                  <div class="input-group-append">
                    <button class="btn btn-secondary h-100" type="button" id="togglePass">
                      <i class="fa fa-eye"></i> </button>
                  </div>
                  <label class="form-label" for="password">Password</label>
                </div>
                <!-- Address input -->
                <div class="form-outline mb-4">
                  <input class="form-control" id="address" rows="3"></input>
                  <label class="form-label" for="address">Address</label>
                </div>
                <!-- Radio buttons -->
                <div class="d-flex justify-content-center mb-4">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input typeCheck" type="radio" name="role" id="admin" value="admin">
                    <label class="form-check-label" for="admin">Admin</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input typeCheck" type="radio" name="role" id="user" value="user">
                    <label class="form-check-label" for="user">User</label>
                  </div>
                </div>
                <!-- Submit button -->
                <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-rounded">
                  <span class="submit-text">Create</span>
                  <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
                </button>
                </div>
              </form>
            </div>
            <!----Filter -->
            <div class="d-flex justify-content-end">
              <div id="search-field"></div>
            </div>
            <div class="d-flex justify-content-between py-3">
              <div class="user-download-btn"></div>
              <div class="d-flex">
                <button class="btn btn-success btn-rounded" type="button" id="toggleFormBtn">
                  <i class="fas fa-add"></i> Show Form</button>
                  <div class="ms-2" id="role_filter"></div>
              </div>
            </div>
            <!----Filter -->
            <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white table-hover w-100" id="user_data">
              <thead class="bg-light">
                <tr>
                  <th>UID</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Logged In</th>
                  <th>Logged Out</th>
                  <th>Action</th>
                  <!-- Add more columns here -->
                </tr>
              </thead>
              <tbody></tbody>
            </table>
            </div>
            <!--- For table -->
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
  <script src="../scripts/timeout.js"></script>

  <!--Necessary Plugins -->
  <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
  <!--Necessary Plugins -->
  <script src="../scripts/TableFilterButtons.js"></script>
  <script src="../scripts/ToggleForm.js"></script>
  <script src="scripts/AddUsers.js"></script>
</body>
</html>