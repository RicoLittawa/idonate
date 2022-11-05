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

	<title>Monetary Donors</title>
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
							<a class="active" href="request.php" style="font-size: 18px;">Back</a>
						</li>
					</ul>
				</div>
				
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
        <th>Province</th>
        <th>Street</th>
		<th>Region</th>
		<th>Contact Number</th>
		<th>Email</th>
		<th>Date</th>
		<th>Reference Number</th>
		<th>Amount</th>
		<th>Action</th>

      </tr>
    </thead>
    <tbody>
     <?php 
	 require '../Admin/include/connection.php';
	 $sql = "SELECT * FROM monetary_donations ORDER by money_id DESC";
	 $result = mysqli_query($conn,$sql);
	$data = $result->fetch_all(MYSQLI_ASSOC);
	$count= 0;
	foreach ($data as $row){
	   $count = $count+ 1;
	echo '<tr>
	<td>'.$row['money_name'].'</td>
	<td>'.$row['money_province'].'</td>
	<td>'.$row['money_street'].'</td>
	<td>'.$row['money_region'].'</td>
	<td>'.$row['money_contact'].'</td>
	<td>'.$row['money_email'].'</td>
	<td>'.$row['money_date'].'</td>
	<td><button type:"button" id="'.$count.'" name=" referenceNum" class="btn referenceNum" data-toggle="modal" data-target="#referenceImg" value="'.$row['money_id'].'">'.$row['money_reference'].'</button></td>
	<td>₱'.$row['money_amount'].'</td>
	<td><button type:"button" id="'.$count.'" name="viewMoney" class="btn viewMoney" data-toggle="modal" data-target="#moneyRecieve" value="'.$row['money_id'].'"><i  style="color:green;" class="fa-solid fa-eye"></i></button></td>
	</tr>';
	 }
	 ?>
	  </tbody>
  </table>
  <!--Money Form --->
  <div class="modal fade" id="moneyRecieve">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Donor Information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
      </div>
	
	

	<form action="" id="">
	<div class="modal-body">
	<div class="row">

	<div class="col">
		<label for="money_name">Fullname</label>
		<input id="money_name" name="money_name" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="money_province">City</label>
		<input id="" name="" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="">Street</label>
		<input id="" name="" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="">Region</label>
		<input id="" name="" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="">Email</label>
		<input id="" name="" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="">Date</label>
		<input type="date" id="" name="" class="form-control" readonly >
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="">Category</label>
		<input id="" name="" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="">Variant</label>
		<input id="" name="" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="">Quantity</label>
		<input id="" name="" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="">Donor's note</label>
		<textarea class="form-control" name="" id="" cols="30" rows="10" disabled></textarea>
		</div>
	</div>
	  </div>

      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-success">Save</button>
      </div>
	</form>

		

    </div>
  </div>
</div>


<!-- Reference Photo--->
<div class="modal fade" id="referenceImg">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reference Number</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
      </div>
	
	

	<form action="" id="">
	<div class="modal-body">
	
	  

      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-success">Save</button>
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
