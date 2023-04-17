$(document).ready(() => {
    const sidebar = () => {
      let html = '';
      html += `
        <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
        <nav class="side-menu">
          <ul class="nav">
            <li class="nav-item">
              <a href="../Dashboard/Dashboard.php" class="nav-link ${window.location.pathname.includes('Dashboard.php') ? 'active' : ''}">
                <i class='bx bxs-dashboard  ${window.location.pathname.includes('Dashboard.php') ? 'active' : ''}'></i>
                <span class="text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Donations/donations.php" class="nav-link ${window.location.pathname.includes('donations.php') ? 'active' : ''}">
                <i class='bx bxs-box'></i>
                <span class="text">Donors</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Request/Request.php" class="nav-link ${window.location.pathname.includes('Request.php') ? 'active' : ''}">
                <i class='bx bxs-envelope ${window.location.pathname.includes('Request.php') ? 'active' : ''}'></i>
                <span class="text">Requests</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Stocks/Stocks.php" class="nav-link ${window.location.pathname.includes('Stocks.php') ? 'active' : ''}">
                <i class='bx bxs-package ${window.location.pathname.includes('Stocks.php') ? 'active' : ''}'></i>
                <span class="text">Stocks</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="users.php" class="nav-link ${window.location.pathname.includes('users.php') ? 'active' : ''}">
                <i class='bx bxs-user-plus'></i>
                <span class="text">Users</span>
              </a>
            </li>
          </ul>
        </nav>`;
  
      return html;
    };
  
    $('#sidebar').append(sidebar());
    
  });
  