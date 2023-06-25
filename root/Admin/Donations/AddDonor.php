<?php require_once "../include/protect.php";
require_once "../include/profile.inc.php";
require_once "../include/sidebar.php";
require_once '../include/FunctionSelectBox.php';

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
  <!--Necessary Plugins-->
  <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="icon" href="../img/batangascitylogo.png" type="image/x-icon">
	<link rel="shortcut icon" href="../img/batangascitylogo.png" type="image/x-icon">
  <!--Necessary Plugins-->
  <title>Donors</title>
</head>

<body>
  <?php echo showAdminModal($conn) ?>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar"><?php echo adminSidebar(); ?></div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb pt-4 me-5">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Add Donors</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="../Dashboard/Dashboard.php" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="Donors.php" class="text-muted bc-path">Donors</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Add Donors</a>
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
            <?php echo adminMenu($conn) ?>
          </div>
        </div>
      </div>
      <!--Header -->
      <div class="custom-container pb-3 me-5">
        <div class="card">
          <div class="card-body overflow-auto">
            <!--Place table here --->
              <div class="mt-2 mt-md-3 mb-3">
                <h4 class="text-muted title-1">1. Personal Details</h4>
              </div>
            <form id="add-form">
              <?php
              require_once "../../../config/config.php";
              $sql = "SELECT * FROM donation_items_picking";
              $result = mysqli_query($conn, $sql);
              foreach ($result as $row) {
                $referenceId = $row['reference_id'];
              }
              ?>
              <input hidden id="reference_id" value="<?php echo htmlentities($referenceId); ?>" readonly>
              <div class="row pb-2 gy-2">
                <div class="col-12 col-md-6">
                  <div class="form-outline">
                    <input class="form-control" type="text" name="fname" id="fname" required />
                    <label class="form-label" for="fname">Full Name</label>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-outline">
                    <input class="form-control" type="text" name="email" id="email">
                    <label class="form-label" for="email">Email</label>
                  </div>
                </div>
              </div>
              <div class="row pb-3 gy-2">
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label class="form-label d-none d-md-inline" for="fname">Region</label>
                    <select class="form-control dropdown" name="region" id="region">
                      <option value="">-Select-</option>
                      <?php echo fill_region_select_box($conn); ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="province" class="form-label d-none d-md-inline">Province</label>
                    <select class="form-control dropdown" name="province" id="province">
                      <option value="">-Select-</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="municipality" class="form-label d-none d-md-inline">Municipality</label>
                    <select class="form-control dropdown" name="municipality" id="municipality">
                      <option value="">-Select-</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="barangay" class="form-label d-none d-md-inline">Barangay</label>
                    <select class="form-control dropdown" name="barangay" id="barangay">
                      <option value="">-Select-</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row pb-3 gy-2">
                <div class="col-12 col-md-6">
                  <div class="form-outline">
                    <input class="form-control" type="text" id="contact" name="contact">
                    <label class="form-label" for="contact">Contact</label>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-outline datepicker">
                    <input class="form-control" id="donation_date" type="date" name="donation_date" data-mdb-toggle="datepicker">
                    <label for="donation_date" class="form-label">Select a date</label>
                  </div>
                </div>
              </div>
              <div class="mt-2 mt-md-3 mb-3">
                <h4 class="text-muted title-1">2. Donation Type and Category</h4>
              </div>
              <div class="mt-2">
                <div class="form-check form-check-inline table-responsive">
                  <input class="form-check-input selectCateg" type="checkbox" id="box1" value="can-noodles">
                  <label class="form-check-label" for="">Can Goods & Noodles</label>
                </div>
                <div id="can-noodles"></div>
                <div class="form-check form-check-inline table-responsive">
                  <input class="form-check-input selectCateg" type="checkbox" id="box2" value="hygine-essentials">
                  <label class="form-check-label" for="">Hygine Essentials</label>
                </div>
                <div id="hygine-essentials"></div>
                <div class="form-check form-check-inline table-responsive">
                  <input class="form-check-input selectCateg" type="checkbox" id="box3" value="infant-items">
                  <label class="form-check-label" for="">Infant Items</label>
                </div>
                <div id="infant-items"></div>
                <div class="form-check form-check-inline table-responsive">
                  <input class="form-check-input selectCateg" type="checkbox" id="box4" value="drinking-water">
                  <label class="form-check-label" for="">Drinking Water</label>
                </div>
                <div id="drinking-water"></div>
                <div class="form-check form-check-inline table-responsive">
                  <input class="form-check-input selectCateg" type="checkbox" id="box5" value="meat-grains">
                  <label class="form-check-label" for="">Meat/Grains</label>
                </div>
                <div id="meat-grains"></div>
                <div class="form-check form-check-inline table-responsive">
                  <input class="form-check-input selectCateg" type="checkbox" id="box6" value="medicine">
                  <label class="form-check-label" for="">Medicine</label>
                </div>
                <div id="medicine"></div>
                <div class="form-check form-check-inline table-responsive">
                  <input class="form-check-input selectCateg" type="checkbox" id="box7" value="others">
                  <label class="form-check-label" for="">Others</label>
                </div>
                <div id="others"></div>
              </div>
              <div class="d-flex justify-content-end mt-3">
                <div class="me-3">
                  <button type="button" class="btn btn-danger cancelBtn btn-rounded" id="cancelBtn">Cancel</button>
                </div>
                <div>
                  <button type="submit" class="btn btn-success waves-effect waves-light btn-rounded" id="saveButton">
                    <span class="submit-text">Save</span>
                    <span class="spinner-border spinner-border-sm  d-none" role="status" aria-hidden="true"></span>
                  </button>
                </div>
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
  <!--Necessary Plugins -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!--Necessary Plugins -->
  <script src="scripts/AddDonorTable.js"></script>
  <script src="scripts/LocationSelect.js"></script>
  <script src="scripts/AddDonorProcess.js"></script>
  <script src="scripts/AutoCompleteProducts.js"></script>
  <script src="../scripts/CancelButton.js"></script>
  <script src="../scripts/ShowNotification.js"></script>
</body>

</html>