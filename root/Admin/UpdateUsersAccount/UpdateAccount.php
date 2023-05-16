<?php include "../include/protect.php";
include "../include/profile.inc.php";
require "../include/sidebar.php";
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
  <style>
    .picture-container {
      position: relative;
      cursor: pointer;
      text-align: center;
    }

    .picture {
      width: 106px;
      height: 106px;
      background-color: #999999;
      border: 4px solid #CCCCCC;
      color: #FFFFFF;
      border-radius: 50%;
      margin: 0px auto;
      overflow: hidden;
      transition: all 0.2s;
      -webkit-transition: all 0.2s;
    }

    .picture:hover {
      border-color: #20d070;
    }

    .content.ct-wizard-green .picture:hover {
      border-color: #05ae0e;
    }

    .content.ct-wizard-blue .picture:hover {
      border-color: #3472f7;
    }

    .content.ct-wizard-orange .picture:hover {
      border-color: #ff9500;
    }

    .content.ct-wizard-red .picture:hover {
      border-color: #ff3b30;
    }

    .picture input[type="file"] {
      cursor: pointer;
      display: block;
      height: 100%;
      left: 0;
      opacity: 0 !important;
      position: absolute;
      top: 0;
      width: 100%;
    }

    .picture-src {
      width: 100%;
      height: 100%;
      object-fit: cover;


    }
  </style>

  <title>User Details</title>
</head>

<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo sidebar(); ?></div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Update Account</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="#" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Update Account</a>
            </h6>
          </nav>
        </div>
        <div class="ms-auto">
          <div class="dropdown">
            <a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
              <?php if ($profile == null) { ?>
                <img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
              <?php } else { ?>
                <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" id="newProfile" alt="Avatar" />
              <?php } ?>
            </a>
            <?php echo accountUpdate(); ?>
          </div>
        </div>
      </div>
      <!--Header -->
      <div class="custom-container pb-3">
        <div class="card">
          <div class="card-body overflow-auto">
            <form class="pe-2 mb-3" id="update-user" enctype="multipart/form-data">
              <!--Change profile -->
              <div class="mb-5">
                <div class="picture-container">
                  <div class="picture">
                    <?php if ($profile == null) { ?>
                      <img src="../img/default-admin.png" class="picture-src" id="wizardPicturePreview" title="">
                    <?php } else { ?>
                      <img src="../include/profile/<?php echo htmlentities($profile); ?>" class="picture-src" id="wizardPicturePreview" title="">
                    <?php } ?>
                    <input type="file" name="profileImg" id="wizard-picture" value="<?php echo htmlentities($profile); ?>">
                  </div>
                  <label>Upload image <i class="fa-sharp fa-solid fa-file-arrow-up"></i></label>
                </div>
              </div>
              <input type="text" id="uID" name="uID" value="<?php echo $userID; ?>" hidden />
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="fname" name="fname" class="form-control" value="<?php echo htmlentities($firstname); ?>" />
                    <label class="form-label" for="fname">First name</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="lname" name="lname" class="form-control" value="<?php echo htmlentities($lastname); ?>" />
                    <label class="form-label" for="lname">Last name</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="position" name="position" class="form-control" placeholder="e.g. Brgy Captain/Employee" value="<?php echo htmlentities($position); ?>" />
                    <label class="form-label" for="position">Position</label>
                  </div>
                </div>
              </div>
              <!-- Email and Password inputs -->
              <div class="form-outline mb-4">
                <input type="text" id="email" name="email" class="form-control" value="<?php echo htmlentities($email); ?>" />
                <label class="form-label" for="email">Email address</label>
              </div>
              <!-- Address input -->
              <div class="form-outline mb-4">
                <input class="form-control" id="address" name="address" value="<?php echo htmlentities($address); ?>" />
                <label class="form-label" for="address">Address</label>
              </div>
              <!-- Submit button -->
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success  btn-rounded">
                  <span class="submit-text">Update</span>
                  <span class="spinner-border spinner-border-sm  d-none" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </form>
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
  <script src="scripts/UpdateAccount.js"></script>
</body>

</html>