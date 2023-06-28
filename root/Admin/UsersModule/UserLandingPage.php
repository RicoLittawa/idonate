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
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <link rel="shortcut icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.css" rel="stylesheet" />
  <title>Home</title>
</head>

<body>
  <?php echo showUserModal($conn) ?>
  <input type="hidden" id="userID" value="<?php echo htmlentities($userID) ?>">
  <div class="main-container">
    <!-- Desktop SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo userSidebar(); ?></div>
    <!-- Desktop SIDEBAR -->
    <!-- Mobile nav -->
    <nav class="mobide-nav navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#mobileAdminNavbar" aria-controls="mobileAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-light"></i>
        </button>
        <div class="collapse navbar-collapse" id="mobileAdminNavbar">
          <?php echo showMobileUserNav() ?>
        </div>
        <div class="d-flex align-items-center">
          <?php echo showNotificationUserMobile($conn) ?>
          <div class="dropdown">
            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?> </a>
            <?php echo userMenu($conn); ?>
          </div>
        </div>
      </div>
    </nav>
    <!-- Mobile nav -->
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb pt-4 me-5">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Welcome, <span class="text-muted"><?php echo htmlentities($firstname) ?></span></h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="#" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Welcome</a>
            </h6>
          </nav>
        </div>
        <div class="profile-container ms-auto">
          <div class="dropdown allowed">
            <a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?>
            </a>
            <?php echo userMenu($conn) ?>
          </div>
        </div>
      </div>
      <!--Header -->
      <div class="custom-container pb-3 me-2 me-md-5">
        <div class="card">
          <div class="card-body">
            <!-- Carousel wrapper -->
            <div class="first-layer">
              <div id="cdrrmo-information" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                  <button type="button" data-mdb-target="#cdrrmo-information" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-mdb-target="#cdrrmo-information" data-mdb-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-mdb-target="#cdrrmo-information" data-mdb-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <!-- Inner -->
                <div class="carousel-inner rounded">
                  <div class="carousel-item active">
                    <img src="../img/photo1.png" class="d-block w-100 carousel-image" alt="" />
                    <div class="carousel-caption d-none d-md-block"></div>
                  </div>
                  <div class="carousel-item">
                    <img src="../img/photo2.jpg" class="d-block w-100 carousel-image" alt="Canyon at Night" />
                  </div>
                  <div class="carousel-item">
                    <img src="../img/photo3.jpg" class="d-block w-100 carousel-image" alt="Canyon at Night" />
                  </div>
                </div>
                <!-- Inner -->
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-mdb-target="#cdrrmo-information" data-mdb-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#cdrrmo-information" data-mdb-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              <div>
                <h6 class="text-center fs-4 fw-bold text-dark mt-3">Mission</h6>
                <p class="text-center text-body lead fs-6">
                  The Batangas City Disaster Risk and Reduction Management Office aims to advance policy, reduce disaster risks,
                  manage and analyze the casual factors of disaster, reduce exposure to hazards, lessen vulnerability of people and property,
                  wise management of land and the environment, and improved preparedness in developing and implementing best practices in disaster risk reduction and mitigation program.

                  The office aims to continue the development, minimize the risk and vulnerabilities, limit the adverse impact of hazards,
                  ensure the safety and security of Batangueños, and to enhance the contributions
                  of City Disaster Risk Reduction and Management Office, in a more cost-effective, systematic and sustainable manner,
                  towards the protection of lives, livelihoods and property, through enhanced capabilities and cooperation
                  in the field of disaster risk reduction.
                </p>
              </div>
            </div>

            <!-- Carousel wrapper -->
            <div class="second-layer d-flex justify-content-end">
              <img src="../img/batangascitylogo.png" class="bg-image img-thumbnail me-3 mt-5 img-fluid d-none d-md-block" alt="">
              <div class="mt-5 pt-xl-5">
                <h6 class="fs-4 fw-bold text-dark mt-3">Vision</h6>
                <p class="lead fs-6">
                  The Batangas City Disaster Risk Reduction and Management Office seeks to provide an effective approach in disaster
                  management towards the protection of lives, livelihoods and property caused by both natural and human induced hazards
                  through innovation, coordination and partnership, and build a safe, adaptive and resilient Batangas City.
                </p>
              </div>
            </div>

            <div class="third-layer d-flex">
              <div class="mt-5 pt-xl-5">
                <h6 class="fs-4 fw-bold text-dark mt-3">Quanlity Policy</h6>
                <p class="text-wrap lead fs-6">
                  The Batangas City Disaster Risk Reduction and Management Office is committed to ensure that the community
                  will reside in a safe, adaptive and resilient City, which takes into consideration the existing geographical
                  risk, the aggravating factors, and the evolving climate situation, and works in coordination with all sectors
                  and stakeholders of society to create a multi-sectoral and varietal approach to disaster risk reduction and
                  management which will benefit the citizens of Batangas City.
                </p>
              </div>
              <img src="../img/photo4.jpg" class="bg-image img-thumbnail ms-3 rounded p-2 mt-5 img-fluid d-none d-md-block" alt="">
            </div>
            <div class="d-flex justify-content-center my-5">
              <button class="btn btn-secondary" onclick="showProducts()">Show Available Items</button>
            </div>

            <section class="maps pb-5 pt-5" id="maps">
              <h2 class="text-dark pb-4 fw-bold"><i class="fa-solid fa-location-dot"></i> Maps</h2>
              <div class="rounded border shadow" id="map"></div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="products" tabindex="-1" aria-labelledby="productsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="productsLabel">Available Products</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
        <div class="d-flex justify-content-between">
          <div><button class="btn btn-success me-3"><a href="UserCreateRequest.php" class="text-light">Create Request</a></button></div>
          <div class="d-flex">
          <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle btn-rounded" type="button" id="pageTable" data-mdb-toggle="dropdown" aria-expanded="false">
                  Select
                </button>
                <ul class="dropdown-menu" aria-labelledby="pageTable">
                  <li><a class="dropdown-item select-row" href="#" data-length="10">10 rows</a></li>
                  <li><a class="dropdown-item select-row" href="#" data-length="25">25 rows</a></li>
                  <li><a class="dropdown-item select-row" href="#" data-length="50">50 rows</a></li>
                  <li><a class="dropdown-item select-row" href="#" data-length="-1">All</a></li>
                </ul>
              </div>
              <div class="ms-3" id="category_filter"></div>
          </div>    
          
            </div>
        <table class="table align-middle mb-0 bg-white table-hover w-100" id="products_data">
              <thead class="bg-light">
                <tr>
                  <th>Category</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../scripts/mdb.min.js"></script>
  <script src="../scripts/sweetalert2.all.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="../scripts/timeout.js"></script>
  <script src="../scripts/ShowNotification.js"></script>
  <script src="../scripts/DisplayMaps.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.js"></script>
  <script src="scripts/ProductsTable.js"></script>
  <script>
    let userID = $("#userID").val();
    const showUserAlertNotification = (id) => {
      $.ajax({
        url: `../include/GetUserNotification.php?userID=${id}`,
        method: "GET",
        dataType: "json",
        success: (response) => {
          if (response.count != 0) {
            $("#showUserNotification").modal("show");
          }
        },
        error: (xhr, status, error) => {
          console.error(error);
        }
      });
    };
    showUserAlertNotification(userID);
    const showProducts = () => {
      $("#products").modal("show");
    }
  </script>


</body>

</html>