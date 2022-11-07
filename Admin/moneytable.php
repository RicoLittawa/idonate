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
					<h1>Money Donations</h1>
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
						<h3>Monetary Donors</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
					</div>
					<table class="table table-striped">
    <thead>
      <tr>
        <th>Donor Name</th>
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
	<td>'.$row['money_date'].'</td>
	<td><button type:"button" id="'.$count.' "class="btn viewRef" data-toggle="modal" data-target="#referenceImg" value="'.$row['money_id'].'">'.$row['money_reference'].'</button></td>
	<td>₱'.$row['money_amount'].'.00</td>
	<td><button type:"button" id="'.$count.'"class="btn viewMoney" data-toggle="modal" data-target="#moneyRecieve" value="'.$row['money_id'].'"><i  style="color:green;" class="fa-solid fa-eye"></i></button></td>
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
	<form action="" id="saveMoneyDonations">
	<div class="modal-body">
	<div class="row">

	<div class="col">
		<label for="money_name">Fullname</label>
		<input id="money_name" name="money_name" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="money_province">Province</label>
		<input id="money_province" name="money_province" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="money_street">Street</label>
		<input id="money_street" name="money_street" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="money_region">Region</label>
		<input id="money_region" name="money_region" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="money_contact">Contact Number</label>
		<input id="money_contact" name="money_contact" class="form-control" readonly>
	</div>
	<div class="col">
		<label for="money_email">Email</label>
		<input id="money_email" name="money_email" class="form-control" readonly>
		
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="money_date">Date</label>
		<input type="date" id="money_date" name="money_date" class="form-control" readonly >
	</div>
	<div class="col">
		<label for="money_amount">Amount</label>
		<input id="money_amount" name="money_amount" class="form-control" readonly>
	</div>
	</div>
	<div class="row">
	<div class="col">
		<label for="money_note">Donor's note</label>
		<textarea class="form-control" name="money_note" id="money_note" cols="30" rows="10" disabled></textarea>
		</div>
	</div>
	  </div>
	  <input id="money_category" type="hidden" name="money_category" class="form-control" value="Cash Donations" readonly>
      <input id="money_variant" type="hidden"  name="money_variant" class="form-control" value="Money" readonly>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-success">Accept</button>
      </div>
	</form>

		

    </div>
  </div>
</div>

<!-- Reference Photo--->

<div class="modal fade" id="referenceImg">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reference/Transaction Reciept</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
      </div>
	
	

	<form action="" id="">
	<div class="modal-body">
	<img src="" id="imageContainer" alt="" width="465px" height="100%" style="border-radius:10px;">
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
