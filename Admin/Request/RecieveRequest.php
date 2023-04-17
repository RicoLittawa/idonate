<?php
require_once '../include/connection.php';
require_once '../include/protect.php';
require_once '../include/profile.inc.php';
require_once 'include/RequestGetData.php';
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
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="../css/style.css">
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
								<img src="../img/default-admin.png" class="rounded-circle w-100" alt="Avatar" />
							<?php } else { ?>
								<img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
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
						<div class="form-container mt-5 ms-5">
							<div class="d-inline-flex">
								<h6 class="number-title">1</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted">Request Details</h4>
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
										<span class="badge badge-warning"><?php echo "nothing" ?></span>
									<?php } else { ?>
										<span class="badge badge-warning"><?php echo htmlentities($status) ?></span>
									<?php  } ?>
								</span>
							</div>
							<div class="d-inline-flex">
								<h6 class="number-title">2</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted">Requested Category</h4>
								</div>
							</div>
						</div>
						<!--2nd table -->
						<form id="processForm">
							<input hidden type="text" id="request_id" value="<?php echo htmlentities($reference) ?>">
							<div class="px-4 ms-5 mt-4">
								<?php
								$reqCategory = "SELECT categoryName,quantity,notes from request_category where request_id=?";
								$stmt = $conn->prepare($reqCategory);
								$stmt->bind_param('i', $reference);
								$stmt->execute();
								$getCategory = $stmt->get_result();
								foreach ($getCategory as $categ) :
								?>
									<?php
									$category = $categ['categoryName'];
									$quantity = $categ['quantity'];
									$notes = $categ['notes'];
									?>
									<?php
									switch ($category):
										case "01":
											// Display notes if available
											if ($notes != null) : ?>
												<div class="note note-success mb-3">
													<strong>Can/Noodles:</strong>&nbsp<?php echo htmlentities($notes) ?>
												</div>
											<?php endif; ?>
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Can/Noodles</th>
														<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="CanNoodles">
													<tr>
														<td>
															<label for="product" class="form-label">Available Product</label>
															<select class="form-control product" data-product="CanNoodles">
															</select>
														</td>
														<td>
															<label for="quantity" class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="CanNoodles"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control quantity" value=0 data-input-category="CanNoodles">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="CanNoodles"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" data-btn-category="CanNoodles" class="btn btn-success btn-rounded addNewRow"><i class="fa-solid fa-plus"></i></button></td>
													</tr>
												</tbody>
											</table>
											<?php break;
										case "02":
											if ($notes != null) :
											?>
												<div class="note note-success mb-3">
													<strong>Hygine Essentials:</strong>&nbsp<?php echo htmlentities($notes) ?>
												</div>
											<?php endif; ?>
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Hygine Essentials</th>
														<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="Hygine">
													<tr>
														<td>
															<label for="product" class="form-label">Available Product</label>
															<select class="form-control product" data-product="Hygine">
															</select>
														</td>
														<td>
															<label for="quantity" class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Hygine"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control quantity" value=0 data-input-category="Hygine">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Hygine"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" data-btn-category="Hygine" class="btn btn-success btn-rounded addNewRow"><i class="fa-solid fa-plus"></i></button></td>
													</tr>
												</tbody>
											</table>
											<?php break;
										case "03":
											if ($notes != null) :
											?>
												<div class="note note-success mb-3">
													<strong>Infant Items:</strong>&nbsp<?php echo htmlentities($notes) ?>
												</div>
											<?php endif; ?>
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Infant Items</th>
														<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
													</tr>
												</thead>
												<tbody data-body-category="InfantItems">
													<tr>
														<td>
															<label for="product" class="form-label">Available Product</label>
															<select class="form-control product" data-product="InfantItems">
															</select>
														</td>
														<td>
															<label for="quantity" class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="InfantItems"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control quantity" value=0 data-input-category="InfantItems">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="InfantItems"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" data-btn-category="InfantItems" class="btn btn-success btn-rounded addNewRow"><i class="fa-solid fa-plus"></i></button></td>
													</tr>
												</tbody>
											</table>
											<?php break;
										case "04":
											if ($notes != null) :
											?>
												<div class="note note-success mb-3">
													<strong>Drinking Water:</strong>&nbsp<?php echo htmlentities($notes) ?>
												</div>
											<?php endif; ?>
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Drinking Water</th>
														<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="DrinkingWater">
													<tr>
														<td>
															<label for="product" class="form-label">Available Product</label>
															<select class="form-control product" data-product="DrinkingWater">
															</select>
														</td>
														<td>
															<label for="quantity" class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="DrinkingWater"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control quantity" value=0 data-input-category="DrinkingWater">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="DrinkingWater"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" data-btn-category="DrinkingWater" class="btn btn-success btn-rounded addNewRow"><i class="fa-solid fa-plus"></i></button></td>
													</tr>
												</tbody>
											</table>
											<?php break;
										case "05":
											if ($notes != null) :
											?>
												<div class="note note-success mb-3">
													<strong>Meat/Grains:</strong>&nbsp<?php echo htmlentities($notes) ?>
												</div>
											<?php endif; ?>
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Meat/Grains</th>
														<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="MeatGrains">
													<tr>
														<td>
															<label for="product" class="form-label">Available Product</label>
															<select class="form-control product" data-product="MeatGrains">
															</select>
														</td>
														<td>
															<label for="quantity" class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="MeatGrains"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control quantity" value=0 data-input-category="MeatGrains">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="MeatGrains"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" data-btn-category="MeatGrains" class="btn btn-success btn-rounded addNewRow"><i class="fa-solid fa-plus"></i></button></td>
													</tr>
												</tbody>
											</table>
											<?php break;
										case "06":
											if ($notes != null) :
											?>
												<div class="note note-success mb-3">
													<strong>Medicine:</strong>&nbsp<?php echo htmlentities($notes) ?>
												</div>
											<?php endif; ?>
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Medicine</th>
														<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="Medicine">
													<tr>
														<td>
															<label for="product" class="form-label">Available Product</label>
															<select name="product" class="form-control product" data-product="Medicine">
															</select>
														</td>
														<td>
															<label for="quantity" class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Medicine"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control quantity" value=0 data-input-category="Medicine">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Medicine"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" data-btn-category="Medicine" class="btn btn-success btn-rounded addNewRow"><i class="fa-solid fa-plus"></i></button></td>
													</tr>
												</tbody>
											</table>
											<?php break;
										case "07":
											if ($notes != null) :
											?>
												<div class="note note-success mb-3">
													<strong>Others:</strong>&nbsp<?php echo htmlentities($notes) ?>
												</div>
											<?php endif; ?>
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Others</th>
														<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
													</tr>
												</thead>
												<tbody data-body-category="Others">
													<tr>
														<td>
															<label for="product" class="form-label">Available Product</label>
															<select class="form-control product" data-product="Others">
															</select>
														</td>
														<td>
															<label for="quantity" class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Others"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control quantity" value=0 data-input-category="Others">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Others"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" data-btn-category="Others" class="btn btn-success btn-rounded addNewRow"><i class="fa-solid fa-plus"></i></button></td>
													</tr>
												</tbody>
											</table>
									<?php break;
									endswitch; ?>
								<?php endforeach;
								$stmt->close();
								$conn->close(); ?>
							</div>
							<div class="d-flex justify-content-end mt-3">
								<div class="me-3">
									<button type="button" class="btn btn-danger cancelBtn btn-rounded" id="cancelBtn">Cancel</button>
								</div>
								<div>
									<button type="submit" class="btn btn-success btn-rounded" id="addToProcess">
										<span class="submit-text">Process</span>
										<span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
									</button>
								</div>
							</div>
						</form>
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
	<script type="text/javascript" src="../scripts/mdb.min.js"></script>
	<script src="../scripts/sweetalert2.all.min.js"></script>
	<script src="../scripts/main.js"></script>
	<script src="scripts/AcceptRequest.js"></script>
</body>

</html>