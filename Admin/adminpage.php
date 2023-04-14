<?php require_once 'include/protect.php';
require_once 'include/profile.inc.php';
require_once 'include/FunctionSelectBox.php';


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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <style>
    .card-names {
      color: #a9a9a9;
      font-size: 14px;
    }

    .my-fixed-height {
      height: 285px;
      overflow: auto;
    }
  </style>
  <title>Dashboard</title>
</head>

<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
      <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
      <nav class="side-menu">
        <ul class="nav">
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class='bx bxs-dashboard active'></i>
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
            <a href="RequestModule/request.php" class="nav-link">
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
                    <?php
                    $donors = "SELECT COUNT(*) FROM donation_items";
                    $stmt = $conn->prepare($donors);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $count = $row['COUNT(*)'];

                    ?>
                    <h1 class="m-md-1 text-dark"><?php echo $count ?></h1>
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
                    <h1 class="m-md-1 text-dark">50</h1>
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
                    <?php
                    $request = "SELECT COUNT(*) FROM request";
                    $stmt = $conn->prepare($request);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $count = $row['COUNT(*)'];
                    ?>
                    <h1 class="m-md-1 text-dark"><?php echo $count ?></h1>
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
                <div class="d-flex justify-content-lg-end">
                  <div class="w-30">
                    <select name="selectCategory" id="selectCategory" class="form-select">
                      <option value="">Select</option>
                      <?php echo add_category($conn) ?>
                    </select>
                  </div>
                  <div class="ps-3"><button class="btn btn-success">Print</button></div>
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
                <div class="d-flex justify-content-lg-end">
                  <div class="ps-3 pb-4"><button class="btn btn-success">Print</button></div>
                </div>

                <table class="table table-striped table-bordered w-100" id="table_data">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $category = "SELECT category,sum(quantity) as totalQuantity  FROM (
            SELECT 'Can and Noodles' AS category,quantity FROM categcannoodles
            UNION ALL
            SELECT 'Drinking Water' AS category,quantity FROM categdrinkingwater
            UNION ALL
            SELECT 'Hygine Essentials' AS category,quantity FROM categhygineessential
            UNION ALL
            SELECT 'Infant Items' AS category,quantity FROM categinfant
            UNION ALL
            SELECT 'Meat and Grains' AS category,quantity FROM categmeatgrains
            UNION ALL
            SELECT 'Medicine' AS category,quantity FROM categmedicine
            UNION ALL
            SELECT 'Others' AS category,quantity FROM categothers
            ) as allProducts 
            GROUP BY category
            ORDER BY totalQuantity DESC";
                    $stmt = $conn->prepare($category);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) :
                    ?>
                      <td class="fw-bold"><?php echo htmlentities($row['category']) ?></td>
                      <td><?php echo htmlentities($row['totalQuantity']) ?></td>
                      </tr>
                    <?php endwhile;
                    $stmt->close();
                    $conn->close(); ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-s-12 col-md-12 col-lg-6">
            <div class="card">
              <div class="card-body">
                <canvas id="lineChart1"></canvas>
              </div>
            </div>
          </div>
          <div class="col-s-12 col-md-12 col-lg-6">
            <div class="card">
              <div class="card-body my-fixed-height">
                <h4 class="mb-3">Total Distributed Items</h4>
                <table class="table table-striped table-bordered w-100" id="table_data">
                  <thead>
                    <tr>
                      <th>Request Reciept No.</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td class="fw-bold"></td>
                    <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-s-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <canvas id="lineChart"></canvas>
              </div>
            </div>
          </div>
          <div class="col-s-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="mb-3">Requests Completed</h1>
                <table class="table table-striped table-bordered w-100" id="table_data">
                  <thead>
                    <tr>
                      <th>Request Reciept No.</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td class="fw-bold"></td>
                    <td></td>
                    </tr>
                  </tbody>
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
    <script src="scripts/sidebar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
      $(document).ready(() => {


        let label = '';
        let data = [];
        let labels = [];
        let backgroundColor = [];


        const allSelected = () => {
          $.ajax({
            url: 'include/GraphsData/graphs.bar.data.php',
            method: "GET",
            dataType: 'json',
            success: (response) => {
              label = response.label;
              data = response.data;
              labels = response.labels;
              let lowestValue = Math.min(...data);
              let highestValue = Math.max(...data);
              for (let i = 0; i < data.length; i++) {
                if (data[i] === lowestValue) {
                  backgroundColor.push('rgb(240, 255, 66)');
                } else if (data[i] === highestValue) {
                  backgroundColor.push('rgb(55, 146, 55)');
                } else {
                  backgroundColor.push('rgb(84, 180, 53)');
                }
              }
              myChart.data.datasets[0].label = label;
              myChart.data.datasets[0].data = data;
              myChart.data.labels = labels;
              myChart.update();
            },
            error: (xhr, status, error) => {
              console.log('Error: ' + error.message);
            }
          });
        }
        allSelected();
        // create the chart
        let ctx = $('#barChart').get(0).getContext('2d');
        let myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: label,
              data: data,
              backgroundColor: backgroundColor,
              borderWidth: 1,
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }

            }
          }
        });

        // update the chart data and label based on the selected category
        $('#selectCategory').on('change', function() {
          const selectedValue = $('#selectCategory').val();
          $.ajax({
            url: 'include/GraphsData/graphs.bar.dynamic.data.php',
            method: 'GET',
            dataType: 'json',
            data: {
              category: selectedValue
            },
            success: (response) => {
              label = response.label;
              data = response.data;
              labels = response.labels;
              let lowestValue = Math.min(...data);
              let highestValue = Math.max(...data);
              for (let i = 0; i < data.length; i++) {
                if (data[i] === lowestValue) {
                  backgroundColor.push('rgb(240, 255, 66)');
                } else if (data[i] === highestValue) {
                  backgroundColor.push('rgb(55, 146, 55)');
                } else {
                  backgroundColor.push('rgb(84, 180, 53)');
                }
              }

              myChart.data.datasets[0].label = label;
              myChart.data.datasets[0].data = data;
              myChart.data.labels = labels;
              myChart.update();
            }
          });
          if (selectedValue == "") {
            allSelected();
          }

        });

      });
    </script>
    <script>
      $(document).ready(() => {
        const data = {
          datasets: [{
            label: 'My First Dataset',
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 1
          }]
        };
        var ctx = $('#lineChart').get(0).getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: data,
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }

        });
      });
    </script>

    <script>
      $(document).ready(() => {
        const data = {
          datasets: [{
            label: 'My First Dataset',
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 1
          }]
        };
        var ctx = $('#lineChart1').get(0).getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: data,
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }

        });
      });
    </script>


</body>

</html>