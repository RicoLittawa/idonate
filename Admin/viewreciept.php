<?php include 'include/protect.php';
require_once 'include/connection.php';

$sql = "SELECT firstname,profile FROM adduser WHERE uID=? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
try {
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows == 0) {
		echo "Invalid email or password.";
	} else {
		while ($row = $result->fetch_assoc()) {
			$firstname =  $row['firstname'];
			$profile =  $row['profile'];
		}
	}
} catch (Exception $e) {
	echo "Error" . $e->getMessage();
}

if (isset($_GET['requestId'])) {
	$reference = $_GET['requestId'];
	$getRequest = "SELECT firstname,lastname,position,email,evacuees_qty,requestdate,status from request where request_id=?";
	$stmt = $conn->prepare($getRequest);
	$stmt->bind_param('i', $reference);
	$stmt->execute();
	$getResult = $stmt->get_result();
	$get = $getResult->fetch_assoc();
	$fname = $get['firstname'];
	$lname = $get['lastname'];
	$position = $get['position'];
	$requestemail = $get['email'];
	$evacuees_qty = $get['evacuees_qty'];
	$requestdate = $get['requestdate'];
	$dateTrimmed = str_replace('-', '', $requestdate);
	$status = $get['status'];
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


	<title>Accept Request</title>
</head>

<body>
	<div class="main-container">
		<!-- SIDEBAR -->
		<div class="sidebar" id="sidebar">
			<button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
			<nav class="side-menu">
				<ul class="nav">
					<li class="nav-item">
						<a href="adminpage.php" class="nav-link">
							<i class='bx bxs-dashboard'></i>
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
						<a href="request.php" class="nav-link active">
							<i class='bx bxs-envelope active'></i>
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
							<i class='bx bxs-user-plus'></i>
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
					<h1 class="fs-1 breadcrumb-title">Process Request</h1>
					<nav class="bc-nav d-flex">
						<h6 class="mb-0">
							<a href="request.php" class="text-muted bc-path">Request</a>
							<span>/</span>
							<a href="#" class="text-reset bc-path active">Process Request</a>
						</h6>
					</nav>
				</div>
				<div class="ms-auto">
					<div class="dropdown">
						<a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
							<?php if ($profile == null) { ?>
								<img src="img/default-admin.png" class="rounded-circle w-100" alt="Avatar" />
							<?php } else { ?>
								<img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
							<?php } ?>

						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<li>
								<h6 class="dropdown-item">Hello <?php echo htmlentities($firstname); ?>!</h6>
							</li>
							<li><a class="dropdown-item" href="updateusers.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
							<li><a class="dropdown-item" href="updatepassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
							<li><a class="dropdown-item" href="include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!--Header -->
			<div class="custom-container pb-3">
				<div class="card">
					<div class="card-body overflow-auto">
						<!--Place table here --->
						<div class="d-flex justify-content-end">
							<button id="printReciept" class="btn btn-success btn-rounded"  onclick="printJS('form-container', 'html')">Print</button>
						</div>
						<div id="form-container" class="form-container mt-5 ms-5">

							<div class="d-inline-flex">
								<h6 class="number-title">1</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted">Reciept Details</h4>
								</div>
							</div>
							<div class="d-block p-3 ms-4 me-3">
								<div class="row">
									<div class="col">
										<span class="d-flex py-2">
											<h6>Reciept No:</h6>
											<h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($dateTrimmed) . "-00" . htmlentities($reference) ?></h6>
										</span>
									</div>
									<div class="col">
										<span class="d-flex justify-content-end py-2">
											<h6>Request Date:</h6>
											<h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($requestdate) ?></h6>
										</span>
									</div>
								</div>
								<hr class="hr" />
								<div class="row">
									<div class="col py-3">
										<span>
											<h6>Fullname:</h6>
											<h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($fname) . " " . htmlentities($lname) ?></h6>
										</span>
									</div>
									<div class="col py-3">
										<span>
											<h6>Position</h6>
											<h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($position) ?></h6>
										</span>
									</div>
								</div>
								<div class="row">
									<div class="col py-3">
										<span>
											<h6>For (No. of Evacuees/Families):</h6>
											<h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($evacuees_qty) ?></h6>
										</span>
									</div>
									<div class="col py-3">
										<span>
											<h6>Email:</h6>
											<h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($requestemail) ?></h6>
										</span>
									</div>
								</div>

								<span class="d-flex py-2">
									<h6>Status:</h6>&nbsp&nbsp&nbsp
									<?php if ($status != "pending") { ?>
										<span class="badge badge-success"><?php echo htmlentities($status) ?></span>
									<?php } else { ?>
										<span class="badge badge-warning"><?php echo htmlentities($status) ?></span>
									<?php  } ?>
								</span>

							</div>
							<div class="d-inline-flex">
								<h6 class="number-title">2</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted">Items</h4>
								</div>
							</div>

							<!--2nd table -->

							<div class="px-4 ms-5 mt-4">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Product name</th>
											<th>Quantity</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$onProcess = "SELECT * from on_process where reciept_number=?";
										$stmt = $conn->prepare($onProcess);
										$stmt->bind_param('i', $reference);
										$stmt->execute();
										$result = $stmt->get_result();
										while ($row = $result->fetch_assoc()) :

										?>
											<tr>
												<td class="fw-bold"><?php echo htmlentities($row['productName']) ?></td>
												<td><?php echo htmlentities($row['quantity']) ?></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>


						<!--End of Container form -->
					</div>

				</div>
			</div>
			<!--End of card-->
		</div>
		<!--End of container-->

	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>
	<script src="scripts/main.js"></script>
	<!--Here is the scripts for functions -->

	<script>
	
	</script>



</body>

</html>