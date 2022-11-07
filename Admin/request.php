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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../Admin/css/donations.css">

	<title>Requests</title>
</head>
<body>


	<!-- SIDEBAR -->	
	<section id="sidebar">
		<a href="#" class="brand">
			
			<span ><img class="img" src="img/logo.png" alt=""></span>
		</a>
		<ul class="side-menu top">
			<li>
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
			<li class="active">
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
					<h1>Requests</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#" style="font-size: 18px;">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#" style="font-size: 18px;">Home</a>
						</li>
					</ul>
				</div>
				<span><button class="btn success" type="button" ><a href="moneytable.php">Monetary Donors</a></button></span>
			</div>
			
			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Requests</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
					</div>
					<table class="table table-striped">
    <thead>
      <tr>
        <th>Donor Name</th>
        <th>Date</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
     <?php 
	 require '../Admin/include/connection.php';
	 $sql = "SELECT * FROM set_request ORDER by request_id DESC";
	 $result = mysqli_query($conn,$sql);
	$data = $result->fetch_all(MYSQLI_ASSOC);
	$count= 0;
	foreach ($data as $row){
	   $count = $count+ 1;
		echo '<tr>
		<td>'.$row['req_name'].'</td>
		<td>'.$row['req_date'].'</td>
		<td><button type:"button" id="'.$count.'" name="viewBtn" class="btn viewBtn" data-toggle="modal" data-target="#recieveReq" value="'.$row['request_id'].'"><i  style="color:green;" class="fa-solid fa-eye "></i></button></td>
		</tr>';
	 }
	 ?>
	  </tbody>
  </table>
  <div class="modal fade" id="recieveReq">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Requests</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
      </div>
	
	

	<form  id="saveRequest">
	<div class="modal-body">
	<div class="row">
	<div class="col">
		<label for="req_name">Fullname</label>
		<input id="req_name" name="req_name" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="req_province">Province</label>
		<input id="req_province" name="req_province" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="req_street">Street</label>
		<input id="req_street" name="req_street" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="req_region">Region</label>
		<input id="req_region" name="req_region" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="req_email">Email</label>
		<input id="req_email" name="req_email" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="req_date">Date</label>
		<input type="date" id="req_date" name="req_date" class="form-control" readonly >
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="req_category">Category</label>
		<input id="req_category" name="req_category" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="req_variant">Variant</label>
		<input id="req_variant" name="req_variant" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="req_quantity">Quantity</label>
		<input id="req_quantity" name="req_quantity" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="req_note">Donor's note</label>
		<textarea class="form-control" name="req_note" id="req_note" cols="30" rows="10" disabled></textarea>
		</div>
	</div>
	  </div>

      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-success">Accept</button>
      </div>
	</form>

		

    </div>
  </div>
</div>
  			
			</div>
		</main>
	
	</section>
	
	

	<script src="../Admin/scripts/sidemenu.js"></script>
	<script src="../Admin/scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script src="../Admin/scripts/function.js"></script>
	<script src="../donors/js/sweetalert2.all.min.js"></script>	
	

	

</body>
</html>
