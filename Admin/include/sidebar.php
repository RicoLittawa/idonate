<?php
function sidebar() {
    $html = '';
    $html .= '
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
            <a href="../Donations/Donors.php" class="nav-link '.(strpos($_SERVER['REQUEST_URI'], 'Donors.php') !== false ? 'active' : '').'">
              <i class="bx bxs-box '.(strpos($_SERVER['REQUEST_URI'], 'Donors.php') !== false ? 'active' : '').'"></i>
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
            <a href="users.php" class="nav-link '.(strpos($_SERVER['REQUEST_URI'], 'users.php') !== false ? 'active' : '').'">
              <i class="bx bxs-user-plus"></i>
              <span class="text">Users</span>
            </a>
          </li>
        </ul>
      </nav>';
  
    return $html;
  }
