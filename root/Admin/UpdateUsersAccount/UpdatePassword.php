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
  <link rel="icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <link rel="shortcut icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <title>User Details</title>
</head>

<body>
  <?php echo showAdminModal($conn) ?>
  <div class="main-container">
    <!-- Desktop SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo adminSidebar(); ?></div>
    <!-- Desktop SIDEBAR -->
    <!-- Mobile nav -->
    <nav class="mobide-nav navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#mobileAdminNavbar" aria-controls="mobileAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-light"></i>
        </button>
        <div class="collapse navbar-collapse" id="mobileAdminNavbar">
          <?php echo showMobileAdminNav() ?>
        </div>
        <div class="d-flex align-items-center">
          <?php echo showNotificationAdminMobile($conn) ?>
          <div class="dropdown">
            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?> </a>
            <?php echo adminMenu($conn); ?>
          </div>
        </div>
      </div>
    </nav>
    <!-- Mobile nav -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb pt-4 me-md-5">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Update Password</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="../Dashboard/Dashboard.php" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Update Password</a>
            </h6>
          </nav>
        </div>
        <div class="profile-container ms-auto">
          <div class="dropdown">
            <a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } ?>
            </a>
            <?php echo adminMenu($conn) ?>
          </div>
        </div>
      </div>
      <!--Header -->
      <div class="custom-container pb-3 me-2 me-md-5">
        <div class="card">
          <div class="card-body overflow-auto">
            <form class="pe-2 mb-3" id="password-update">
              <input type="text" hidden name="uID" value="<?php echo $userID ?>" />
              <!-- Email and Password inputs -->
              <div class="form-outline mb-4">
                <input type="password" name="currentPass" autocomplete="currentPass" id="currentPass" class="form-control" />
                <label class="form-label" for="currentPass">Current Password</label>
              </div>
              <!-- Address input -->
              <div class="form-outline mb-4">
                <input class="form-control" type="password" autocomplete="newPass" name="newPass" id="newPass" />
                <label class="form-label" for="newPass">New Password</label>
              </div>
              <div class="d-flex justify-content-end">
                <input type="checkbox" id="togglePass" />
                <label class="ps-1" for="newPass">Show Password</label>
              </div>
              <!-- Submit button -->
              <div class="d-flex justify-content-end pt-3">
                <button type="submit" class="btn btn-success btn-rounded">
                  <span class="submit-text">Change</span>
                  <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
                </button>
              </div>
            </form>
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
  <script src="../scripts/UpdatePassword.js"></script>
  <script src="../scripts/ShowNotification.js"></script>
</body>

</html>