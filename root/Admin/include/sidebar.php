<?php
//Admin sidebar
function sidebar()
{
  $html =
    '
      <nav class="side-menu">
        <ul class="nav">
          <li class="nav-item">
            <a href="../Dashboard/Dashboard.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "Dashboard.php") !== false
      ? "active"
      : "") .
    '">
              <i class="bx bxs-dashboard ' .
    (strpos($_SERVER["REQUEST_URI"], "Dashboard.php") !== false
      ? "active"
      : "") .
    '"></i>
              <span class="text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../Donations/Donors.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "Donors.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "AddDonor.php") !== false
      ? "active"
      : "") .
    '">
              <i class="bx bxs-box ' .
    (strpos($_SERVER["REQUEST_URI"], "Donors.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "AddDonor.php") !== false
      ? "active"
      : "") .
    '"></i>
              <span class="text">Donors</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../Request/Request.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "Request.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "ViewRequestReceipt.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "ReceiveRequest.php") !== false
      ? "active"
      : "") .
    '">
              <i class="bx bxs-envelope ' .
    (strpos($_SERVER["REQUEST_URI"], "Request.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "ViewRequestReceipt.php") !== false
      ? "active"
      : "") .
    '"></i>
              <span class="text">Requests</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../Stocks/Stocks.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "Stocks.php") !== false ? "active" : "") .
    '">
              <i class="bx bxs-package ' .
    (strpos($_SERVER["REQUEST_URI"], "Stocks.php") !== false ? "active" : "") .
    '"></i>
              <span class="text">Stocks</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../CreateAccount/Users.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "Users.php") !== false ? "active" : "") .
    '">
              <i class="bx bxs-user-plus ' .
    (strpos($_SERVER["REQUEST_URI"], "Users.php") !== false ? "active" : "") .
    '"></i>
              <span class="text">Users</span>
            </a>
          </li>
        </ul>
      </nav>';
  return $html;
}

//Notification modal
function showModal()
{
  $userID = $_SESSION["user"]["uID"];
  $html = '
  <div class="modal fade" id="showNotification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="d-flex justify-content-center" id="toastContainer"></div>
      <div class"me-4 ms-4">
     <div class="d-flex justify-content-between">
     <p id="notifCount" class="lead fs-6"></p>
     <p class="text-primary text-end allowed" id="deleteAll" onClick="deleteAll('.$userID.')">Delete All</p></div>
      <ul class="list-group list-group-light">
      <li id="notification-list" class="list-group-item d-flex justify-content-between align-items-center lead fs-6">
      </li>
    </ul>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  ';
  return $html;
}

//Admin profile menu
function accountUpdate()
{
  $html = '
 <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><a class="dropdown-item" href="../UpdateUsersAccount/UpdateAccount.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
    <li><a class="dropdown-item" href="../UpdateUsersAccount/UpdatePassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
    <li><a class="dropdown-item" href="../Settings/settings.php"><i class="fa-solid fa-gear"></i> Settings</a></li>
    <li><a class="dropdown-item" href="../include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
  </ul>

 ';
  return $html;
}

//User profile menu
function userAccountUpdate($conn)
{
  $userID = $_SESSION["user"]["uID"];
  $getNotifCount = $conn->prepare("SELECT COUNT(*) AS notificationCount FROM notification WHERE userID = ?");
  $getNotifCount->bind_param("i", $userID);
  $getNotifCount->execute();
  $notifCountResult = $getNotifCount->get_result();
  $notifCountRow = $notifCountResult->fetch_assoc();
  $notificationCount = $notifCountRow["notificationCount"];
  $html = '
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><a class="dropdown-item" href="UserUpdateProfile.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
    <li><a class="dropdown-item" href="UserUpdatePassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
    <li><a class="dropdown-item" href="#" onClick="showNotification(' . $userID . ')"><i class="fa-solid fa-envelope"></i> Notifications   
    ';

  if ($notificationCount > 0) {
    $html .= '
          <span class="badge rounded-pill badge-notification bg-danger">' . $notificationCount . '</span>';
  }

  $html .= '
  </a></li>
    <li><a class="dropdown-item" href="../include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
  </ul>';

  return $html;
}

//User sidebar
function userSidebar()
{
  $html =
    '
      <nav class="side-menu">
        <ul class="nav">
        <li class="nav-item">
            <a href="UserLandingPage.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "UserLandingPage.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "UserLandingPage.php") !== false
      ? "active"
      : "") .
    '">
              <i class="bx bxs-home ' .
    (strpos($_SERVER["REQUEST_URI"], "UserLandingPage.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "UserLandingPage.php") !== false
      ? "active"
      : "") .
    '"></i>
              <span class="text">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="UserCreateRequest.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "UserCreateRequest.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "ViewCreatedRequest.php") !== false
      ? "active"
      : "") .
    '">
              <i class="bx bxs-cart-add ' .
    (strpos($_SERVER["REQUEST_URI"], "UserCreateRequest.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "ViewCreatedRequest.php") !== false
      ? "active"
      : "") .
    '"></i>
              <span class="text">Create</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="UserUpdateProfile.php" class="nav-link ' .
    (strpos($_SERVER["REQUEST_URI"], "UserUpdateProfile.php") !== false ||
      strpos($_SERVER["REQUEST_URI"], "UserUpdatePassword.php") !== false
      ? "active"
      : "") .
    '">
              <i class="bx bxs-user ' .
    (strpos($_SERVER["REQUEST_URI"], "UserUpdateProfile.php") ||
      strpos($_SERVER["REQUEST_URI"], "UserUpdatePassword.php") !== false
      ? "active"
      : "") .
    '"></i>
              <span class="text">Account</span>
            </a>
          </li>
        </ul>
      </nav>
  ';
  return $html;
}

//Add to notification function
function addToNotification($conn, $request_id,$statusMessage)
{
  //Notification
  $manilaTimezone = new DateTimeZone('Asia/Manila');
  $currentDateTime = new DateTime('now', $manilaTimezone);
  $timestamp = $currentDateTime->format('Y-m-d H:i:s');
  $selectRequesterId = $conn->prepare("SELECT userID,requestdate from request where request_id=?");
  $selectRequesterId->bind_param("i", $request_id);
  $selectRequesterId->execute();
  $requesterIdResult = $selectRequesterId->get_result();
  try {
    if ($requesterIdResult->num_rows === 0) {
      throw new Exception("Request id cannot be found");
    } else {
      $fetchedRequesterId = $requesterIdResult->fetch_assoc();
      $userID = $fetchedRequesterId["userID"];
      $requestdate = $fetchedRequesterId["requestdate"];
      $date = date('Y-m-d', strtotime($requestdate));
      $receiptNumber = str_replace('-', '', $date);
      $message = "Your request {$receiptNumber}-00{$request_id} {$statusMessage}";
      $insertNotif = $conn->prepare("INSERT INTO notification (userID, message, timestamp) VALUES (?, ?, ?)");
      $insertNotif->bind_param("iss", $userID, $message, $timestamp);
      $insertNotif->execute();
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

//Update request status
function updateRequestStatus($conn,$status,$request_id){
  $manilaTimezone = new DateTimeZone('Asia/Manila');
  $currentDateTime = new DateTime('now', $manilaTimezone);
  $timestamp = $currentDateTime->format('Y-m-d H:i:s');
  $updateStatus = $conn->prepare("UPDATE receive_request SET status=?,status_timestamp=? WHERE request_id=?");
  $updateStatus->bind_param('ssi', $status,$timestamp ,$request_id);
  $updateStatus->execute();
  $updateUserRequestStatus = $conn->prepare("UPDATE request SET status=?,status_timestamp=? WHERE request_id=?");
  $updateUserRequestStatus->bind_param('ssi', $status,$timestamp ,$request_id);
  $updateUserRequestStatus->execute();
}
