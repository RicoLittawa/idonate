<?php require_once '../include/protect.php';
require_once '../include/profile.inc.php';
require_once 'include/RequestGetData.php';
require_once "../include/sidebar.php";
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
	<title>View Request Receipt</title>
</head>

<body>
	<div class="main-container">
		<!-- SIDEBAR -->
		<div class="sidebar" id="sidebar"><?php echo userSidebar() ?></div>
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
					<div class="dropdown allowed">
						<a class="dropdown-toggle border border-0" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
							<?php if ($profile == null) { ?>
								<img src="../img/default-admin.png" class="rounded-circle avatar-size" alt="Avatar" />
							<?php } else { ?>
								<img src="../include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
							<?php } ?>
						</a>
						<?php echo userAccountUpdate() ?>
					</div>
				</div>
			</div>
			<!--Header -->
			<div class="custom-container pb-3">
				<div class="card">
					<div class="card-body overflow-auto">
						<!--Place table here --->
						<div class="d-flex justify-content-end">
							<button id="printReceipt" class="btn btn-success btn-rounded" type="click"><i class="fa-solid fa-print"></i></button>
						</div>
						<form id="form-container" class="form-container mt-5 ms-5">
							<div class="d-inline-flex">
								<h6 class="number-title">1</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted">Receipt Details</h4>
								</div>
							</div>
							<div class="p-3 ms-4 me-3">
								<div class="d-flex justify-content-between">
									<span class="d-flex justify-content-start py-2">
										<h6>Receipt No:</h6>
										<h6 class="fw-light">&nbsp;&nbsp;&nbsp;<?php echo htmlentities($dateTrimmed) . "-00" . htmlentities($reference) ?></h6>
									</span>
									<span class="d-flex justify-content-end py-2">
										<h6>Request Date:</h6>
										<h6 class="fw-light">&nbsp;&nbsp;&nbsp;<?php echo htmlentities($requestdate) ?></h6>
									</span>
								</div>
								<hr class="hr" />
								<div class="row">
									<div class="col py-3">
										<span>
											<h6>Fullname:</h6>
											<h6 class="fw-light">&nbsp;&nbsp;&nbsp;<?php echo htmlentities($fname) . " " . htmlentities($lname) ?></h6>
										</span>
									</div>
									<div class="col py-3">
										<span>
											<h6>Position</h6>
											<h6 class="fw-light">&nbsp;&nbsp;&nbsp;<?php echo htmlentities($position) ?></h6>
										</span>
									</div>
								</div>
								<div class="row">
									<div class="col py-3">
										<span>
											<h6>For (No. of Evacuees/Families):</h6>
											<h6 class="fw-light">&nbsp;&nbsp;&nbsp;<?php echo htmlentities($evacuees_qty) ?></h6>
										</span>
									</div>
									<div class="col py-3">
										<span>
											<h6>Email:</h6>
											<h6 class="fw-light">&nbsp;&nbsp;&nbsp;<?php echo htmlentities($requestemail) ?></h6>
										</span>
									</div>
								</div>
								<span class="d-flex py-2">
									<h6>Status:</h6>&nbsp;&nbsp;&nbsp;
									<?php
									$badgeClass = ($status === "Ready for Pick-up" || $status === "Request was processed" || $status === "Request completed" || $status === "Request cannot be completed") ? "badge-success" : "badge-info";
									?>
									<span class="badge <?php echo htmlentities($badgeClass) ?>"><?php echo htmlentities($status) ?></span>
								</span>
							</div>
							<div class="d-inline-flex">
								<h6 class="number-title">2</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted"><?php echo ($status !== "pending") ? "Requested Items" : "Requested Category"; ?></h4>
								</div>
							</div>
							<!--2nd table -->
							<div class="px-4 ms-5 mt-4">
								<table id="table-container" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th><?php echo ($status !== "pending") ? "Product Name" : "Category Name"; ?></th>
											<th>Quantity</th>
										</tr>
									</thead>
									<tbody>
										<?php
										function getCategoryName($category, $conn)
										{
											$stmt = $conn->prepare("SELECT category FROM category WHERE categCode = ?");

											if (!$stmt) {
												throw new Exception('There was a problem preparing the query: ' . $conn->error);
											}

											$stmt->bind_param('i', $category);

											if (!$stmt->execute()) {
												throw new Exception('There was a problem executing the query: ' . $conn->error);
											}

											$result = $stmt->get_result();

											if ($result->num_rows === 0) {
												throw new Exception("No category found in the database.");
											}

											$fetched = $result->fetch_assoc();

											return $fetched['category'];
										}

										try {
											$stmt = ($status !== "pending")
												? $conn->prepare("SELECT * FROM on_process WHERE reciept_number = ?")
												: $conn->prepare("SELECT rc.categoryName, rc.quantity, c.category FROM request_category rc JOIN category c ON rc.categoryName = c.categCode WHERE rc.request_id = ?");

											if (!$stmt) {
												throw new Exception('There was a problem preparing the query: ' . $conn->error);
											}

											$stmt->bind_param('i', $reference);

											if (!$stmt->execute()) {
												throw new Exception('There was a problem executing the query: ' . $conn->error);
											}

											$result = $stmt->get_result();

											if ($result->num_rows === 0) {
												throw new Exception("No data found in the database.");
											}

											while ($row = $result->fetch_assoc()) {
												$productName = ($status !== "pending")
													? htmlentities($row['productName'])
													: getCategoryName($row['categoryName'], $conn);

												$quantity = htmlentities($row['quantity']);
										?>
												<tr>
													<td class="fw-bold"><?php echo $productName; ?></td>
													<td><?php echo $quantity; ?></td>
												</tr>
										<?php
											}
										} catch (Exception $e) {
											echo $e->getMessage();
										}
										?>
									</tbody>
								</table>
							</div>
							<div class="d-flex justify-content-end me-3">
								<button type="button" class="btn btn-danger cancelBtn btn-rounded" id="goBack"><i class="fa-solid fa-arrow-left"></i> Go back</button>
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
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="../scripts/mdb.min.js"></script>
	<script src="../scripts/sweetalert2.all.min.js"></script>
	<script src="../scripts/TableFilterButtons.js"></script>
	<script src="../scripts/CancelButton.js"></script>
</body>

</html>