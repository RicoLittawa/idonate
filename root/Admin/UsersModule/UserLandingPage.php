<?php require_once "../include/protect.php";
require_once "../include/profile.inc.php";
require_once "../include/sidebar.php";

require_once "../../../config/config.php";

$getUser = $conn->prepare("SELECT firstname from adduser where uID=?");
$getUser->bind_param("i", $userID);
$getUser->execute();
$result = $getUser->get_result();
$row = $result->fetch_assoc();
$firstname = $row["firstname"];
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
  <title>Home</title>
</head>

<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo userSidebar() ?></div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Welcome, <span class="text-muted"><?php echo htmlentities($firstname) ?></span></h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
            <a href="#" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Welcome Page</a>
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
            <?php echo userAccountUpdate() ?>
          </div>
        </div>
      </div>

      <!--Header -->

      <div class="custom-container pb-3">
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
                <p class="text-center text-body">
                  The Batangas City Disaster Risk Reduction Management Office aims to advance policy, reduce disaster risks,
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
              <img src="../img/batangascitylogo.png" class="bg-image img-thumbnail me-3 mt-5 img-fluid" alt="">
              <div class="mt-5 pt-xl-5">
                <h6 class="fs-4 fw-bold text-dark mt-3">Vision</h6>
                <p>
                  The Batangas City Disaster Risk Reduction and Management Office seeks to provide an effective approach in disaster
                  management towards the protection of lives, livelihoods and property caused by both natural and human induced hazards
                  through innovation, coordination and partnership, and build a safe, adaptive and resilient Batangas City.
                </p>
              </div>
            </div>

            <div class="third-layer d-flex">
              <div class="mt-5 pt-xl-5">
                <h6 class="fs-4 fw-bold text-dark mt-3">Quanlity Policy</h6>
                <p class="text-wrap fs-6">
                  The Batangas City Disaster Risk Reduction and Management Office is committed to ensure that the community
                  will reside in a safe, adaptive and resilient City, which takes into consideration the existing geographical
                  risk, the aggravating factors, and the evolving climate situation, and works in coordination with all sectors
                  and stakeholders of society to create a multi-sectoral and varietal approach to disaster risk reduction and
                  management which will benefit the citizens of Batangas City.
                </p>
              </div>
              <img src="../img/photo4.jpg" class="bg-image img-thumbnail ms-3 rounded p-2 mt-5 img-fluid" alt="">
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
  <script src="../scripts/timeout.js"></script>

</body>

</html>