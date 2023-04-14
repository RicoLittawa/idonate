<?php include 'include/protect.php';
require_once 'include/connection.php';

$sql = "SELECT firstname,profile FROM adduser WHERE uID=? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
try {
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows == 0) {
    echo "Invalid email or password.";
  } else {
    while ($row = $result->fetch_assoc()) {
      $firstname =  $row['firstname'];
      $profile =  $row['profile'];
    }
  }
} catch (Exception $e) {
  echo "Error" . $e->getMessage();
}
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
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .dataTables_filter {
      display: none;
    }

    #dateFilter {
      width: 200px;
      height: 40px;
      padding: 5px 10px;
      cursor: pointer;
      position: relative;
    }

    #dateLabel {
      font-size: 16px;
      line-height: 30px;
      color: #6c757d;
      font-weight: 500;
      display: inline-block;
      margin-right: 10px;
    }

    #dateIcon {
      position: absolute;
      top: 50%;
      right: 8px;
      transform: translateY(-50%);
      transition: transform 0.2s ease-in-out;
    }

    #dateIcon.up {
      transform: translateY(-50%) rotate(180deg);
    }

    .form-control:focus {
      border-color: none;
      box-shadow: none;
      outline: none;
    }
  </style>

  <title>Donors</title>
</head>

<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
      <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
      <nav class="side-menu">
        <ul class="nav">
          <li class="nav-item">
            <a href="adminpage.php" class="nav-link">
              <i class='bx bxs-dashboard'></i>
              <span class="text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class='bx bxs-box active'></i>
              <span class="text">Donors</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="request.php" class="nav-link">
              <i class='bx bxs-envelope'></i>
              <span class="text">Requests</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="stocks.php" class="nav-link">
              <i class='bx bxs-package'></i>
              <span class="text">Stocks</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class='bx bxs-user-plus'></i>
              <span class="text">Users</span>
            </a>
          </li>
        </ul>
      </nav>

    </div>

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
                <img src="img/default-admin.png" class="rounded-circle w-100" alt="Avatar" />
              <?php } else { ?>
                <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
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

      <div class="custom-container pb-3">
        <div class="card">
          <div class="card-body overflow-auto">



            <!----Filter -->
            <div class="d-flex justify-content-between py-3">
              <div class="d-flex justify-content-start">
                <div id="dateFilter" class="border border-success rounded-pill px-5 py-1" style="cursor:pointer;">
                  <span id="dateLabel">Date</span>
                  <i id="dateIcon" class="fa fa-caret-down me-2"></i>
                </div>



                <div class="form-group ps-3 ">
                  <button class="btn btn-success addPage btn-rounded">
                    <i class="fa-solid fa-plus"></i></button>
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <input type="text" class="form-control rounded-pill border-success" id="customSearch" placeholder="Search..." />
              </div>
            </div>

            <div class="d-flex justify-content-end">
              <div class="pe-2">
                <button class="btn btn-outline-success rounded-pill email_button" id="bulk_email" data-action="bulk">Send to all</button>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll" />
                <label class="form-check-label" for="flexCheckDefault">Select All</label>
              </div>
            </div>

            <!----Filter -->

            <!--Place table here --->
            <div class="table-container">
              <table class="table table-striped table-bordered w-100" id="table_data">
                <thead>
                  <tr>
                    <th></th>
                    <th>Donor Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Donation Date</th>
                    <th>Status</th>
                    <th>Certificate</th>
                    <th></th>
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


  </div>
  </div>






  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/sweetalert2.all.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script src="scripts/sendemailcertificate.js"></script>

  <!-- <script src="scripts/sidebar.js"></script> -->

  <!--Here is the scripts for functions -->




  <script>
    $(document).ready(() => {
     
      /****View Certificate */
      $(document).on('click', '#btnCert', (event) => {
        let donor_id = $(event.target).attr('data-donor-id');
        $.ajax({
          url: 'include/viewid.php?viewCert=' + donor_id,
          method: 'GET',
          success: function(data) {
            printJS('./include/download-certificate/' + data, 'image')
          }
        });
      });

      /****Go to addpage */
      $('.addPage').click(() => {
        window.location.href = "additemdonations.php?fillupform";
      });
      /***Select all checkbox */
      $("#selectAll").click((event) => {
        $("input[type=checkbox]").prop('checked', $(event.target).prop('checked'));

      });
    });
  </script>
</body>

</html>