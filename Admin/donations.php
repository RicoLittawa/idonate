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

    .up {
      transform: rotate(180deg);
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
                <div id="dateFilter" class="border border-success rounded-pill px-4 py-1" style="cursor:pointer;">
                  <span>Date:&nbsp;</span>
                  <span></span> <i class="fa fa-caret-down"></i>
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

            <div class="d-flex justify-content-end m-auto">
              <div class="pe-2">
                <button class="btn btn-success rounded-pill email_button" id="bulk_email" data-action="bulk">Send to all</button>
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

  <!-- <script src="scripts/sidebar.js"></script> -->

  <!--Here is the scripts for functions -->




  <script>
    $(document).ready(function() {

      /**********Populate donors table */
      let table = $('#table_data').DataTable({
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        ajax: 'include/DataForDataTables/donorsdata.php',
        columns: [{
            data: null,
            render: function(data, type, row) {
              if (row.emailStatus === 'not sent') {
                return `<input type = "checkbox"
                name = "single_select"
                class = "single_select form-check-input"
                data-email = "${row.donorEmail}"
                data-name = "${row.donorName}"
                data-id = "${row.donorId}"/>`;
              } else {
                return `<a href="updatedonate.php?editdonate=${row.donorId}"><i class="fa-solid fa-pen-to-square text-success"></i></a>`;
              }
            }
          },
          {
            data: 'donorName'
          },
          {
            data: 'donorEmail',
          },
          {
            data: 'donorContact'
          },
          {
            data: 'donationDate'
          },
          {
            data: 'emailStatus',
            render: (data, type, row) => {
              return data !== 'not sent' ? '<span class="badge badge-success">Sent</span>' :
                `<button type="button" class="btn btn-secondary email_button col btn-rounded" name="email_button" data-id="${row.donorId}" 
              data-email="${row.donorEmail}" data-name="${row.donorName}"  data-action="single">Send</button>`;
            }
          },
          {
            data: 'certificate',
            render: (data, type, row) => {
              return data !== 'cert empty' ? `<button class="btn btn-secondary btn-rounded" data-donor-id="${row.donorId}" id="btnCert">
              <i class="fa-solid fa-print"></i></button>` :
                '<span class="badge badge-warning user-select-none not-allowed">N/A</span'
            }
          },
          {
            data: null,
            render: function(data, type, row) {
              return `<a href="#"><i class="fa-solid fa-trash text-danger"></i></a>`;
            }
          }

        ],
        order: [
          [3, 'desc']
        ],
        displayLength: 10,

      });

      // Custom search
      $("#customSearch").on("keyup", (event) => {
        table.search($(event.target).val()).draw();
      });

      //date filter

      $('#dateFilter').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        }
      });

      $('#dateFilter').click(() => {
        // Toggle the 'up' class on the icon
        $('#dateFilter i.fa-caret-down').toggleClass('up');

        // Rotate the icon using CSS
        if ($('#dateFilter i.fa-caret-down').hasClass('up')) {
          $('#dateFilter i.fa-caret-down').css('transform', 'rotate(180deg)');
          
        } else {
          $('#dateFilter i.fa-caret-down').css('transform', 'rotate(0deg)');
        }
      })








      /**********Send certificate through email */
      $('.email_button').click((event) => {
        let $this = $(event.target);
        let id = $this.attr("id");
        let action = $this.data("action");
        let email_data = [];

        if (action == 'single') {
          email_data.push({
            email: $this.data("email"),
            name: $this.data("name"),
            uID: $this.data('id'),
          });
          $('#bulk_email').attr('disabled', true);
        } else {
          let $checkedBoxes = $('.single_select:checked');
          if ($checkedBoxes.length === 0) {
            $this.attr('disabled', true);
            return;
          }

          $checkedBoxes.each(function() {
            email_data.push({
              email: $(this).data("email"),
              name: $(this).data('name'),
              uID: $(this).data('id'),
            });
          });
        }

        $.ajax({
          url: "include/sendcerti.php",
          method: "POST",
          data: {
            email_data: email_data
          },
          beforeSend: function() {
            $this.html('Sending...');
            $this.addClass('btn btn-danger');
          },
          success: function(data) {
            if (data == 'Inserted') {
              $this.html('sent');
              Swal.fire({
                icon: 'success',
                title: 'Sent',
                text: 'Email has been sent',
              }).then(function() {
                location.reload();
              });
            } else {
              $this.text(data);
            }
          }
        });
      });


      /****View Certificate */
      $(document).on('click', '#btnCert', (event) => {
        let donor_id = $(event.target).attr('data-donor-id');
        $.ajax({
          url: 'include/viewid.php?viewCert=' + donor_id,
          type: 'GET',
          success: function(data) {
            printJS('./include/download-certificate/' + data, 'image')
          }
        });
      });

      /****Go to addpage */
      $('.addPage').click(function() {
        window.location.href = "additemdonations.php?fillupform";
      });
      /***Select all checkbox */
      $("#selectAll").click(function() {
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

      });
    });
  </script>


  <script>
    $(document).ready(function() {

    })
  </script>
</body>

</html>