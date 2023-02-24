<?php include 'include/protect.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="stylesheet" href="css/style.css">
  <style>
    .card-names{
  color: #a9a9a9;
  font-size: 14px;
}.h1-color{
  color: #2D3436;
}.my-fixed-height {
  height: 355px;
  overflow: auto;
}
  </style>
	<title>Dashboard</title>
</head>
<body>
<div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
    <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
  <nav class="side-menu">
    <ul class="nav">
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <i class='bx bxs-dashboard active'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="donations.php" class="nav-link">
          <i class='bx bxs-box'></i>
          <span class="text">Donors</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class='bx bxs-envelope'></i>
          <span class="text">Requests</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="stocks.php" class="nav-link">
          <i class='bx bxs-package'></i>
          <span class="text">Stocks</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="users.php" class="nav-link">
          <i class='bx bxs-user-plus' ></i>
          <span class="text">Users</span>
        </a>
      </li>
      <li class="nav-item log-item">
        <a href="./include/logout.php" class="nav-link log-link">
        	<i class="fa-solid fa-right-from-bracket"></i>
          <span class="text">Logout</span>
       		</a>
     	</li>
    </ul>
  </nav>
 
    </div>

<!--Main content -->
  <div class="main-content">
   <!--Header -->
   <div class="mb-4 custom-breadcrumb">
  <div class="crumb">
  <h1 class="fs-1 breadcrumb-title">Dashboard</h1>
	<nav class="bc-nav d-flex">
		<h6 class="mb-0">
		<a href="" class="text-reset bc-path">Home</a>
		<span>/</span>
		<a href="" class="text-reset bc-path active">Dashboard</a>
		</h6>  
	</nav>
  </div>
	<div>
  <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" style="width: 100px;"
  alt="Avatar" />
  </div>
	</div>
 <!--Header -->


  <!--reports -->
 <h1>user</h1>

  
<!--End of main content -->
    </div>
  </div>
</div>

  
	
	

	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script> 



	<script>
       $(document).ready(function() {
		$("#toggleFormBtn").click(function() {
			$("#registerForm").collapse('toggle');
			if ($(this).html().includes('<i class="fas fa-minus"></i> Hide Form')) {
				$(this).html('<i class="fas fa-plus"></i> Show Form');
			} else {
				$(this).html('<i class="fas fa-minus"></i> Hide Form');
			}
			});
		});
	</script>

<script>
	$(document).ready(function(){
var ctx = $('#myChart').get(0).getContext('2d');
var myChart = new Chart(ctx, {
type: 'line',
data: {
labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
datasets: [{
data: [86,114,106,106,107,111,133],
label: "Total",
borderColor: "rgb(62,149,205)",
backgroundColor: "rgb(62,149,205,0.1)",
}, {
data: [70,90,44,60,83,90,100],
label: "Accepted",
borderColor: "rgb(60,186,159)",
backgroundColor: "rgb(60,186,159,0.1)",
}, {
data: [10,21,60,44,17,21,17],
label: "Pending",
borderColor: "rgb(255,165,0)",
backgroundColor:"rgb(255,165,0,0.1)",
}, {
data: [6,3,2,2,7,0,16],
label: "Rejected",
borderColor: "rgb(196,88,80)",
backgroundColor:"rgb(196,88,80,0.1)",

}
]
},
});
});
</script>


</body>
</html>