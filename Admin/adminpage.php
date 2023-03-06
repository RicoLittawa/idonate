<?php include 'include/protect.php';
require_once 'include/connection.php';
$sql= "SELECT firstname,profile FROM adduser WHERE uID=? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('i',$userID );
try{
  $stmt->execute();
  $result= $stmt->get_result();
  if($result->num_rows == 0) {
    echo "Invalid email or password.";
  }
  else{
    while($row= $result->fetch_assoc()){
     $firstname=  $row['firstname'];
     $profile=  $row['profile'];

    }
  }

}

catch(Exception $e){
  echo "Error". $e->getMessage();

}
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
  <div style="margin-left: auto;">
    <div class="dropdown">
  <a
    class="dropdown-toggle"
    id="dropdownMenuButton"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
    style="border: none;"
  >
  <?php if ($profile==null){ ?>
    <img src="img/default-admin.png" class="rounded-circle" style="width: 100px; border:1px green;" alt="Avatar" />
  <?php }else{?>
    <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle" style="width: 100px; height:100px; object-fit: cover; border:1px green;" alt="Avatar" />
  <?php }?>

  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><h6 class="dropdown-item">Hello <?php echo htmlentities($firstname);?>!</h6></li>
    <li><a class="dropdown-item" href="updateusers.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
    <li><a class="dropdown-item" href="updatepassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
    <li><a class="dropdown-item" href="include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
  </ul>
</div>
  </div>
</div>
 <!--Header -->


  <!--reports -->
  <div class="custom-container pb-3">
    <div class="row g-3">
    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
      <div class="card">
	      <div class="card-header  bg-gradient bg-success"></div>
          <div class="card-body">
            <div class="row">
              <span><h6 class=" h1-color card-names">DONORS</h6>  </span>
              <div class="col">
              <?php 
                $donors = "SELECT COUNT(*) FROM donation_items";
                $stmt = $conn->prepare($donors);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $count = $row['COUNT(*)'];
              ?>
				        <h1 class="m-md-1 h1-color"><?php echo $count ?></h1>
			          </div>
			        <div class="col">
                <h4 class="mb-md-2 mt-lg-1 ms-lg-5 h1-color"><i class="fas fa-user  fa-2x"></i></h4>
			        </div>
		        </div>
        </div>
      </div>
    </div> 
    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
      <div class="card">
	      <div class="card-header  bg-gradient bg-success"></div>
          <div class="card-body">
            <div class="row">
              <span><h6 class=" h1-color card-names">Distributed</h6></span>
              <div class="col">
				        <h1 class="m-md-1 h1-color">50</h1>
			          </div>
			        <div class="col">
                <h4 class="mb-md-2 mt-lg-1 ms-lg-5 h1-color"><i class="fas fa-gift fa-2x"></i></h4>
			        </div>
		        </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
      <div class="card">
	      <div class="card-header  bg-gradient bg-success"></div>
          <div class="card-body">
            <div class="row">
              <span><h6 class=" h1-color card-names">REQUESTS</h6>  </span>
              <div class="col">
              <?php 
                $request = "SELECT COUNT(*) FROM request";
                $stmt = $conn->prepare($request);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $count = $row['COUNT(*)'];
              ?>
				        <h1 class="m-md-1 h1-color"><?php echo $count ?></h1>
			          </div>
			        <div class="col">
                <h4 class="mb-md-2 mt-lg-1 ms-lg-5 h1-color"><i class="fas fa-envelope  fa-2x"></i></h4>
			        </div>
		        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row g-3 mt-2">
    <div class="col-s-12 col-md-12 col-lg-6">
      <div class="card my-fixed-height">
       <div class="card-body">
         <canvas class="" id="myChart"></canvas>
        </div>
       </div>  
     </div>
     <div class="col-s-12 col-md-12 col-lg-6">
  <div class="card my-fixed-height">
      <div class="card-body">
      <table class="table table-striped table-bordered" style="width:100%" id="table_data">
  <thead>
    <tr>
      <th scope="col">Category</th>
      <th scope="col">Total</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Can Goods/ Noodles</td>
      <td>10000</td>
      <td><a href="">Link</a></td>
    </tr>
    <tr>
      <td>Hygine Essentials</td>
      <td>500</td>
      <td><a href="">Link</a></td>
    </tr>
 
 
  </tbody>
</table>
      </div>
    </div>
  </div>

  
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