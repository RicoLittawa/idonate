<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../Admin/css/landing.css">
	
	<title>Dashboard</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			
			<span ><img class="img" src="img/logo.png" alt=""></span>
		</a>
		<ul class="side-menu top">
			<li  class="active">
				<a href="adminpage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="donations.php">
					<i class='bx bxs-box' ></i>
					<span class="text">Donations</span>
				</a>
			</li>
			<li>
				<a href="request.php">
					<i class='bx bxs-envelope' ></i>
					<span class="text">Requests</span>
				</a>
			</li>
			<li>
				<a href="#">
				<i class='bx bxs-file-archive'></i>
					<span class="text">Archive</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="/Admin/login/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>Good Day
			<a href="#" class="profile"><span> <?php echo $_SESSION['name']; ?></span></a>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
				<i class='bx bxs-group' ></i>
				<span class="text">
				<?php
				include '../Admin/include/connection.php'; 
			 $sql="select count('1') from donation_items";
			 $result=mysqli_query($conn,$sql);
			 $row=mysqli_fetch_array($result);
			 echo "<h3 style=font-size:45px>$row[0]</h3>";
			 mysqli_close($conn); ?>
		
						<h4 style="color: grey;">Donor</h4>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>

					<span class="text">
					<?php
				include '../Admin/include/connection.php'; 
			 $sql="select sum(money_amount) from monetary_donations";
			 $result=mysqli_query($conn,$sql);
			 $row=mysqli_fetch_array($result);
			 echo "<h3 style=font-size:45px>₱ $row[0]</h3>";
			 mysqli_close($conn); ?>
		
					<h4 style="color: grey;">Funds</h4>
					</span>
				</li>
			</ul>

				</div>
			</div>
			
			<div class="table-data">

				<div class="add">
				<iframe title="idonate" width="970" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiMDNjMGUyZWYtMWU2ZS00ODc0LWIxMTQtOWM0ZmRhYjU0MTRmIiwidCI6IjYxMTExODkxLTNkYzgtNDVmZi1hZjcwLWZjMGFmM2NjYjBmOCIsImMiOjEwfQ%3D%3D&pageName=ReportSection" frameborder="0" allowFullScreen="true"></iframe>	
				</div>
					
					
			</div>
		</main>
	
	</section>
	
	

	<script src="../Admin/scripts/sidemenu.js"></script>
	<script src="../Admin/scripts/jQuery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
	
</body>
</html>