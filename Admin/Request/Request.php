<?php require_once '../include/protect.php';
require_once '../include/profile.inc.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <link rel="stylesheet" href="../css/mdb.min.css">
  <link rel="stylesheet" href="../css/style.css">


  <title>Requests</title>
</head>

<body>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
          <button type="button" class="btn-close closeModal"></button>
        </div>
        <div class="modal-body">
          <input hidden id="reference" type="text">

          <select id="selectStatus" class="form-select">
            <option value="">Select Status</option>
            <option value="Ready for Pick-up">Ready for Pick-up</option>
            <option value="Request cannot be proccessed">Request cannot be proccessed</option>
            <option value="Request completed">Request completed</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closeModal">Close</button>
          <button type="button" id="saveStatus" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
    </div>

    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Process Request</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="request.php" class="text-muted bc-path">Request</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Process Request</a>
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
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li>
                <h6 class="dropdown-item">Hello <?php echo htmlentities($firstname); ?>!</h6>
              </li>
              <li><a class="dropdown-item" href="updateusers.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
              <li><a class="dropdown-item" href="updatepassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
              <li><a class="dropdown-item" href="include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--Header -->


      <!--reports -->
      <div class="custom-container pb-3">
        <div class="card">
          <div class="card-body">
            <table class="compact table table-striped table-bordered w-100" id="table_data">
              <thead>
                <tr>
                  <th>Receipt No.</th>
                  <th>Full name</th>
                  <th>Position</th>
                  <th>No. Evacuees/Families</th>
                  <th>Request Date</th>
                  <th>Received Date</th>
                  <th>Status</th>
                  <th>Action</th>
                  <!-- Add more columns here -->
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <!--End of main content -->
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script type="text/javascript" src="../scripts/mdb.min.js"></script>
  <script src="../scripts/main.js"></script>
  <script src="scripts/RequestTable.js"></script>
  <script src="../Sidebar/scripts//SidebarTemplate.js"></script>


</body>

</html>