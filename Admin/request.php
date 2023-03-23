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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/style.css">

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
          <select name="" id="" class="form-select">
            <option value="Pick-up">Select Status</option>
            <option value="Pick-up">Ready for Pick-up</option>
            <option value="Pick-up">Request has been processed</option>
            <option value="Pick-up">Request cannot be proccessed</option>
            <option value="Pick-up">Request completed</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closeModal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
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
            <a href="donations.php" class="nav-link">
              <i class='bx bxs-box'></i>
              <span class="text">Donors</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class='bx bxs-envelope active'></i>
              <span class="text">Requests</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="stocks.php" class="nav-link ">
              <i class='bx bxs-package '></i>
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


      <!--reports -->
      <div class="custom-container pb-3">
        <div class="card">
          <div class="card-body">
            <table class="table table-striped table-bordered w-100" id="table_data">
              <thead>
                <tr>
                  <th>Reciept No.</th>
                  <th>Full name</th>
                  <th>Position</th>
                  <th>No. Evacuees/Families</th>
                  <th>Request Date</th>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/main.js"></script>

  <script>
    $(document).ready(() => {
      $(document).on('click', '#acceptBtn', (event) => {
        let requestId = $(event.target).attr('data-request');
        window.location.href = "acceptrequest.php?requestId=" + requestId;
      });
      $(document).on('click', '#viewRecieptBtn', (event) => {
        let viewReciept = $(event.target).attr('data-request');
        window.location.href = "viewreciept.php?requestId=" + viewReciept;
      });
      $('.closeModal').click(() => {
        $('#exampleModal').modal('hide');
        $('.main-content').removeClass('blur-filter-class');
        $('.sidebar').removeClass('blur-filter-class');
      });
      $('#table_data').DataTable({
        responsive: true,
        ajax: 'include/DataForDataTables/requestdata.php',
        columns: [{
            data: 'reference',
            render:(data,type,row)=>{
              return row.dateTrimmed +"-00"+ row.reference
            }
          },
          {
            data: 'Fullname',
            render:(data,type,row)=>{
             return  row.firstname+ " "+ row.lastname
            }
          },
          
          {
            data: 'position'
          },
          {
            data: 'evacuees_qty'
          },
          {
            data: 'requestdate'
          },

          {
            data: 'status',
            render:(data)=>{
              if(data!=='pending'){
                return `<span style="cursor:pointer;" class="badge badge-success" onclick="changeStatus()">${data}</span>`
              }else{
                return `<span class="badge badge-danger user-select-none not-allowed">${data}</span>`

              }
            }
          },

          {
            data: 'reference',
            render: function(data, type, row) {
              if (row.status === 'pending'){
                return `<button type="button" id="acceptBtn" data-request=${row.reference} class="btn btn-success btn-rounded">Accept</button>`;
              }else{
                return `<button type="button" id="viewRecieptBtn" data-request=${row.reference} class="btn btn-success btn-rounded">View</button>`;
              }
            }
          }
        ],
        order: [
          [0, 'desc']
        ],
        displayLength: 10,
       
      });


    })
    const changeStatus = () => {
      $('#exampleModal').modal('show');
      $('.main-content').addClass('blur-filter-class');
      $('.sidebar').addClass('blur-filter-class');
    }
  </script>


</body>

</html>