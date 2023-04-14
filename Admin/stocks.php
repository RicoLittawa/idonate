<?php require_once 'include/protect.php';
require_once 'include/profile.inc.php';

function fill_select_category($conn)
{
  $output = '';
  $selectCateg = "SELECT * from category";
  $stmt = $conn->prepare($selectCateg);
  $stmt->execute();
  $result = $stmt->get_result();
  foreach ($result as $row) {
    $categoryName = htmlentities($row['category']);
    $categCode = htmlentities($row['categCode']);
    $output .= '<option value="' . $categCode . '">' . $categoryName . '</option>';
  }

  return $output;
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

  <title>Stocks</title>
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
            <a href="donations.php" class="nav-link">
              <i class='bx bxs-box'></i>
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
            <a href="#" class="nav-link active">
              <i class='bx bxs-package active'></i>
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
          <h1 class="fs-1 breadcrumb-title">Stocks</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="request.php" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Stocks</a>
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

            <div class="d-flex justify-content-end">
              <div class="form-group w-25">
                <label class="form-label">Select Category:</label>
                <div id="role_filter"></div>
              </div>
            </div>
            <div class="py-3">
              <table class="table table-striped table-bordered w-100" id="table_data">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>New Quantity</th>
                    <th>Total Distributed</th>
                    <th>Add Expiry</th>
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
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

  <script>
    $(document).ready(() => {
      $('#table_data').DataTable({
        responsive: true,
        ajax: 'include/DataForDataTables/stocksdata.php',
        columns: [{
            data: 'category'
          },
          {
            data: 'product',
            render:(data,type,row)=>{
              return `${data}<span class="badge rounded-pill badge-info">${row.type}</span>`
            }
          },
          {
            data: null,
            createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {
              let previousQuantity = parseInt(rowData.quantity, 10) + parseInt(rowData.distributed, 10);
              if (rowData.distributed !== 0) {
                $(cell).html(`<h6>${previousQuantity}<span class="fw-light">&nbsp${rowData.unit}</span><br><span class="badge rounded-pill badge-danger">-${rowData.distributed}</span></h6>`);
              } else {
                $(cell).html(`${rowData.quantity}<span class="fw-light">&nbsp${rowData.unit}</span>`);
              }
            }
          },
          {
            data: 'quantity',
            render: (data, type, row) => {
              if (row.distributed === 0) {
                return `<span class="badge rounded-pill badge-warning">N/A</span>`;
              }
              return `${data}<span class="fw-light">&nbsp${row.unit}</span>` ;

            }
          },
          {
            data: 'distributed',
            render: (data, type, row) => {
              return data !== 0 ? data : `<span class="badge rounded-pill badge-warning">N/A</span>`;
            }
          },
          {
            data: null,
            render: function(data, type, row) {
              return `<button type="button" class="btn btn-success btn-rounded" id="addExpiry"><i class="fa-solid fa-plus"></i></button>`;
            }
          }
        ],
        order: [
          [0, 'asc']
        ],
        displayLength: 10,
        initComplete: function() {
          this.api().columns(0).every(function() {
            const column = this;
            const select = $('<select class="form-select"><option value="">All</option></select>')
              .appendTo($('#role_filter'))
              .on('change', function() {
                const val = $.fn.dataTable.util.escapeRegex(
                  $(this).val()
                );

                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column.data().unique().sort().each(function(d, j) {
              select.append('<option value="' + d + '">' + d + '</option>')
            });
          });
        },

      });

      $(document).on('click', '#addExpiry', () => {
        alert("working");
      })
    })
  </script>
</body>

</html>