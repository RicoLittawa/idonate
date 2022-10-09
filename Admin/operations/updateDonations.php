<?php
session_start();
require '../include/connection.php';

	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/donations.css">

	<title>Update Donations</title>
</head>
<body>


	<!-- SIDEBAR -->	
	<section id="sidebar">
		<a href="#" class="brand">
			
			<span ><img class="img" src="/Admin/img/logo.png" alt=""></span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="../adminpage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="#">
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
					<h1>Donations</h1>
					<ul class="breadcrumb">
						<li>
							<a href="../donations.php" style="font-size: 18px;">Donations</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="../donations.php" style="font-size: 18px;">Back</a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Update</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
					</div>
					<table class="table">
						<?php 
							if(isset($_GET['updateid'])){
								$donors= $_GET['updateid'];
								$sql = "SELECT * FROM items WHERE id=?"; // SQL with parameters
								$stmt = $conn->prepare($sql); 
								$stmt->bind_param('i', $donors);
								$stmt->execute();
								$result = $stmt->get_result(); // get the mysqli result
								if ($result->num_rows > "0") {

									$data = $result->fetch_assoc();
									
									?><form action="../operations/update.php?" method="POST" class="validate-form">
										<input type="hidden" name="update_id" id="update_id" value="<?=$data['id']; ?>">
	  					
									<div class="form-group validate-input" data-validate = "Fullname is required">
										<label for="fname">Fullname</label>
									  <input class="form-control" type="text" name="fname" id="fname" value="<?=$data['fullname']; ?>" placeholder="Full name" >
								  </div>
								  <div class="form-group validate-input" data-validate = "Address is required">
									  <label for="address">Address</label>
									  <input class="form-control" type="text" name="address" id="address"  value="<?=$data['address']; ?>" placeholder="Address">
								  </div>
								  <div class="form-group validate-input" data-validate = "Valid email is required: ex@abc.xyz">
								  	  <label for="email">Email</label>
									  <input class="form-control" type="text" name="email" id="email"  value="<?=$data['email']; ?>"placeholder="Email">
								  </div>
								  <div class="form-group validate-input" data-validate = "Date is required">
								  	<label for="donation_date">Donation Date</label>
									<input class="form-control" type="date" name="donation_date" id="donation_date"  value="<?=$data['donationDate']; ?>" placeholder="Date">
								</div>
								  <div class="form-group validate-input" data-validate = "Please select to the given options">
										  <label for="items">Select Category:</label>
										  <select class="form-control" id="category" name="category" class="required">
										  <option value="" disabled selected>Choose...</option>
										  <option value="food" <?php if($data['category']=="food"){?> selected ="selected"<?php } ?>>Food</option>
										  <option value="clothes"<?php if($data['category']=="clothes"){?> selected ="selected"<?php } ?>>Clothes</option>
										  <option value="beverages" <?php if($data['category']=="beverages"){?> selected ="selected"<?php } ?>>Beverages</option>
										  <option value="others" <?php if($data['category']=="others"){?> selected ="selected"<?php } ?>>Others</option>
										  </select>
										  
								  </div>
								  <div class="form-group validate-input" data-validate = "Please select to the given options">
									  <label for="quanti">Select Variant:</label>
										  <select class="form-control" id="variant" name="variant" class="required">
										  <option value="">Choose...</option>
										  <option value="Per Box" <?php if($data['variant']=="Per Box"){?> selected ="selected"<?php } ?>>Per Box</option>
										  <option value="Pieces" <?php if($data['variant']=="Pieces"){?> selected ="selected"<?php } ?>>Pieces</option>
										  <option  value="Others" <?php if($data['variant']=="Others"){?> selected ="selected"<?php } ?>>Others</option>
										  </select>
								  </div>
								  <div class="form-group validate-input" data-validate = "Product name is required">
								  	  <label for="productName">Product Name</label>
									  <input class="form-control" type="text" name="productName" id="productName" value="<?=$data['productName']; ?>" placeholder="Product Name">
								  </div>
								  <div class="form-group validate-input" data-validate = "This field is required">
								  	  <label for="quantity">Quantity</label>
									  <input class="form-control" type="text" name="quantity" id="quantity" value="<?=$data['quantity']; ?>" placeholder="Quantity">
									</div>
									  <span><button class="btn btn-success btnUpdate" name="updatedata" type="submit" style="width: 150px;">Update</button></span>
						  </form> <?php

									
								}else{
								
									echo "0 records found";
								
							}
						}	
						?>
					
  		</table>
 
			</div>
		</main>
	
	</section>
	<script src="../Admin/scripts/landing.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>
	<script src="../scripts/validation.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>