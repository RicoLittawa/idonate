<?php
require_once "../include/protect.php";
require_once "../include/profile.inc.php";
require_once "../include/FunctionSelectBox.php";
require_once "../include/sidebar.php";
require_once "../../../config/config.php";

$reqId = "SELECT * from ref_request";
$stmt = $conn->prepare($reqId);
$stmt->execute();
$reqResult = $stmt->get_result();
$refRow = $reqResult->fetch_assoc();
$requestRef = $refRow["request_id"];
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
  <link rel="stylesheet" href="../css/mdb.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <!--Necessary Plugins-->
  <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <!--Necessary Plugins-->
  <title>Create Request</title>
</head>

<body>
  <div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar"> <?php echo userSidebar(); ?></div>
    <!--Main content -->
    <div class="main-content">
      <!--Header -->
      <div class="mb-4 custom-breadcrumb">
        <div class="crumb">
          <h1 class="fs-1 breadcrumb-title">Create Request</h1>
          <nav class="bc-nav d-flex">
            <h6 class="mb-0">
              <a href="UserLandingPage.php" class="text-muted bc-path">Home</a>
              <span>/</span>
              <a href="#" class="text-reset bc-path active">Create Request</a>
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
            <?php echo userAccountUpdate(); ?>
          </div>
        </div>
      </div>
      <!--Header -->
      <div class="custom-container pb-3">
        <div class="card">
          <div class="card-body overflow-auto">
            <div id="createRequest" class="collapse mt-5" data-duration="500">
              <form class="pe-2 mb-3" id="add-request">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <input hidden  type="text" id="requestRef" value="<?php echo htmlentities($requestRef); ?>">
                <div class="form-outline datepicker mb-3">
                  <input class="form-control" id="request_date" type="date" name="donation" data-mdb-toggle="datepicker">
                  <label for="request_date" class="form-label">Select a date</label>
                </div>
                <!-- Email and Password inputs -->
                <div class="form-outline mb-3">
                  <input type="number" id="evacQty" class="form-control"></input>
                  <label class="form-label" for="evacQty">Evacuees/Families Quantity</label>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Available Category</th>
                        <th>Est QTY</th>
                        <th>Notes (Optional)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="requestBody">
                      <tr>
                        <td> <!-- SELECT OPTION -->
                          <select class="form-control category" name="category" id="category">
                            <option value="">--</option>
                            <?php echo add_category_create($conn); ?>
                          </select>
                        </td> <!-- SELECT OPTION -->
                        <td>
                          <input type="number" class="form-control quantity" id="quantity">
                        </td>
                        <td><textarea class="form-control notes" id="notes" cols="30" rows="5" placeholder="e.g. We only need shampoo, soap, and mouthwash"></textarea></td>
                        <td><button class="btn btn-success" type="button" id="addCategory"><i class="fa-solid fa-plus"></i></button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- Submit button -->
                <div class=" d-flex justify-content-end">
                  <button type="submit" class="btn btn-success btn-rounded">
                    <span class="submit-text">Create</span>
                    <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
                  </button>
                </div>
              </form>
            </div>
            <!----Filter -->
            <div class="d-flex justify-content-end">
              <div id="search-field"></div>
            </div>
            <div class="d-flex justify-content-between py-3">
              <div class="create-request-download-btn"></div>
              <div class="d-flex">
                <button class="btn btn-success btn-rounded" type="button" id="toggleFormRequestBtn">
                  <i class="fas fa-add"></i>Show Form</button>
                <div class="ms-2" id="status_filter"></div>
              </div>
            </div>
            <!----Filter -->
            <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white table-hover w-100" id="create_request_data">
              <thead class="bg-light">
                <tr>
                  <th>Receipt No</th>
                  <th>No. Evacuees/Families</th>
                  <th>Request Date</th>
                  <th>Recieve Date</th>
                  <th>Status</th>
                  <th>View</th>
                  <th>Delete</th>
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
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../scripts/mdb.min.js"></script>
  <script src="../scripts/sweetalert2.all.min.js"></script>
  <script src="../scripts/timeout.js"></script>
  <!--Necessary Plugins -->
  <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/date-1.4.0/fh-3.3.2/kt-2.8.2/rg-1.3.1/sc-2.1.1/datatables.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
  <!--Necessary Plugins -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <script src="../scripts/TableFilterButtons.js"></script>
  <script src="scripts/CreateRequest.js"></script>
  <script src="../scripts/ToggleForm.js"></script>
  <script>
    let count = 0;
    const addCategory = () => {
      let remove = '';
      if (count > 0) {
        remove = `<button type="button" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>`;
      }
      const html = `
      <tr id="appendedRows">
        <td>
          <select class="form-control category" name="category" id="category${count}">
            <option value="">--</option>
            <?php echo add_category_create($conn); ?>
          </select>
        </td>
        <td>
          <input type="number" class="form-control quantity" name="quantity" id="quantity${count}">
        </td>
        <td>
          <textarea class="form-control notes" id="notes" cols="30" rows="5" placeholder="e.g. We only need shampoo, soap, and mouthwash"></textarea>
        </td>
        <td>
          ${remove}
        </td>
      </tr>`;
      return html;
    };
    $('#addCategory').click(() => {
      count++;
      $('#requestBody').append(addCategory());
    });
    $(document).on('click', '.remove', function() {
      $(this).closest('tr').remove();
    });
  </script>
</body>
</html>