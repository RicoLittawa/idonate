<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../Admin/css/add.css">

	<title>Add Donations</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			
			<span ><img class="img" src="/Admin/img/logo.png" alt=""></span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="adminpage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="../Admin/donations.php">
					<i class='bx bxs-box' ></i>
					<span class="text">Donations</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-envelope' ></i>
					<span class="text">Requests</span>
				</a>
			</li>
			<li class="active">
				<a href="#">
					<i class='bx bxs-add-to-queue' ></i>
					<span class="text">Add Donations</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-chat' ></i>
					<span class="text">Announcement</span>
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
					<h1>Add Donations</h1>
					<ul class="breadcrumb">
						<li>
							<a href="../Admin/donations.php">Donations</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Add Donations</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
					</div>
					<form class="donationform" action="../Admin/include/add.inc.php" method="POST">
						<div class="form-group" data-validate = "">
							<input class="form-control" type="text" name="fname" placeholder="Full name">
						</div>
						<div class="form-group" data-validate = "">
							<input class="form-control" type="text" name="address" placeholder="Address">
						</div>
						<div class="form-group" data-validate = "">
							<input class="form-control" type="text" name="email" placeholder="Email">
						</div>
						<div class="form-group" data-validate = "">
							<input class="form-control" type="date" name="donation_date" placeholder="Date">
						</div>
						<div class="form-group" data-validate = "">
								<label for="items">Select:</label>
								<select class="form-control" id="categ" name="category">
								<option value="food">Food</option>
								<option value="clothes">Clothes</option>
								<option value="beverages">Beverages</option>
								<option value="others">Others</option>
								</select>
						</div>
						<div class="form-group" data-validate = "">
							<label for="quanti">Select:</label>
								<select class="form-control" id="quanti" name="variant">
								<option value="Per Box">Per Box</option>
								<option value="Pieces">Pieces</option>
								<option value="Others">Others</option>
								</select>
						</div>
						<div class="form-group" data-validate = "">
							<input class="form-control" type="text" name="productName" placeholder="Product Name">
						</div>
						<div class="form-group" data-validate = "">
							<input class="form-control" type="number" name="quantity" placeholder="Quantity">
						</div>
						<div class="button">
							
							<button type="submit" name="submit-donations" class="btn">Submit</button>
						</div>


					</form>
				
			</div>
		</main>
	
	</section>
	
	

	<script src="../Admin/scripts/add.js"></script>
</body>
</html>