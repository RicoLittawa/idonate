<?php
function sidebar() {
    $html = '
      <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
      <nav class="side-menu">
        <ul class="nav">
          <li class="nav-item">
            <a href="../Dashboard/Dashboard.php" class="nav-link '.(strpos($_SERVER['REQUEST_URI'], 'Dashboard.php') !== false ? 'active' : '').'">
              <i class="bx bxs-dashboard '.(strpos($_SERVER['REQUEST_URI'], 'Dashboard.php') !== false ? 'active' : '').'"></i>
              <span class="text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../Donations/Donors.php" class="nav-link '.(strpos($_SERVER['REQUEST_URI'], 'Donors.php') !== false || strpos($_SERVER['REQUEST_URI'], 'AddDonor.php') !== false ? 'active' : '').'">
              <i class="bx bxs-box '.(strpos($_SERVER['REQUEST_URI'], 'Donors.php') !== false || strpos($_SERVER['REQUEST_URI'], 'AddDonor.php') !== false ? 'active' : '').'"></i>
              <span class="text">Donors</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../Request/Request.php" class="nav-link '.(strpos($_SERVER['REQUEST_URI'], 'Request.php') !== false ? 'active' : '').'">
              <i class="bx bxs-envelope '.(strpos($_SERVER['REQUEST_URI'], 'Request.php') !== false ? 'active' : '').'"></i>
              <span class="text">Requests</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../Stocks/Stocks.php" class="nav-link '.(strpos($_SERVER['REQUEST_URI'], 'Stocks.php') !== false ? 'active' : '').'">
              <i class="bx bxs-package '.(strpos($_SERVER['REQUEST_URI'], 'Stocks.php') !== false ? 'active' : '').'"></i>
              <span class="text">Stocks</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../CreateAccount/Users.php" class="nav-link '.(strpos($_SERVER['REQUEST_URI'], 'Users.php') !== false ? 'active' : '').'">
              <i class="bx bxs-user-plus '.(strpos($_SERVER['REQUEST_URI'], 'Users.php') !== false ? 'active' : '').'"></i>
              <span class="text">Users</span>
            </a>
          </li>
        </ul>
      </nav>';
    return $html;
  }
function accountUpdate (){
 $html= '
 <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><h6 class="dropdown-item">Hello <?php echo htmlentities($firstname);?>!</h6></li>
    <li><a class="dropdown-item" href="../UpdateUsersAccount/UpdateAccount.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
    <li><a class="dropdown-item" href="../UpdateUsersAccount/UpdatePassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
    <li><a class="dropdown-item" href="../include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
  </ul>

 ';
 return $html;
}