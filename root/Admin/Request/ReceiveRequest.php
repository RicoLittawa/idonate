<?php
require_once "../../../config/config.php";
require_once '../include/protect.php';
require_once '../include/profile.inc.php';
require_once 'include/RequestGetData.php';
require_once '../include/sidebar.php';
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
		<div class="sidebar" id="sidebar"><?php echo sidebar() ?></div>
		<!--Main content -->
		<div class="main-content">
			<!--Header -->
			<div class="mb-4 custom-breadcrumb">
				<div class="crumb">
					<h1 class="fs-1 breadcrumb-title">Process Request</h1>
					<nav class="bc-nav d-flex">
						<h6 class="mb-0">
							<a href="../Dashboard/Dashboard.php" class="text-muted bc-path">Home</a>
							<span>/</span>
							<a href="Request.php" class="text-muted bc-path">Request</a>
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
						<?php echo accountUpdate() ?>
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
									<h6>Status:</h6>&nbsp;&nbsp;&nbsp;
									<?php
									$badgeClass = "";
									if ($status === "Ready for Pick-up") {
										$badgeClass = "badge-warning";
									} elseif ($status === "Request was processed" || $status === "Request completed") {
										$badgeClass = "badge-success";
									} elseif ($status === "Deleted" || $status === "Request cannot be completed") {
										$badgeClass = "badge-danger";
									} elseif ($status === "pending") {
										$badgeClass = "badge-info";
									}
									?>
									<span class="badge <?php echo htmlentities($badgeClass) ?>"><?php echo htmlentities($status) ?></span>
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
														<th>EST QTY <span class="badge badge-info"><?php echo htmlentities($quantity) ?></span></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="CanNoodles">
													<tr>
														<td>
															<label class="form-label">Available Product</label>
															<select class="form-control can-noodles-product"></select>
														</td>
														<td>
															<label class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="CanNoodles"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control can-noodles-quantity quantity" value=0 data-input-category="CanNoodles">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="CanNoodles"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button id="can-noodles" type="button" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
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
														<th>EST QTY <span class="badge badge-info"><?php echo htmlentities($quantity) ?></span></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="Hygine">
													<tr>
														<td>
															<label class="form-label">Available Product</label>
															<select class="form-control hygine-essentials-product"></select>
														</td>
														<td>
															<label class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Hygine"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control hygine-essentials-quantity quantity" value=0 data-input-category="Hygine">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Hygine"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" id="hygine-essentials" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
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
														<th>EST QTY <span class="badge badge-info"><?php echo htmlentities($quantity) ?></span></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="InfantItems">
													<tr>
														<td>
															<label class="form-label">Available Product</label>
															<select class="form-control infant-items-product"></select>
														</td>
														<td>
															<label class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="InfantItems"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control infant-items-quantity quantity" value=0 data-input-category="InfantItems">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="InfantItems"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" id="infant-items" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
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
														<th>EST QTY <span class="badge badge-info"><?php echo htmlentities($quantity) ?></span></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="DrinkingWater">
													<tr>
														<td>
															<label class="form-label">Available Product</label>
															<select class="form-control drinking-water-product">
															</select>
														</td>
														<td>
															<label class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="DrinkingWater"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control drinking-water-quantity quantity" value=0 data-input-category="DrinkingWater">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="DrinkingWater"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" id="drinking-water" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
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
														<th>EST QTY <span class="badge badge-info"><?php echo htmlentities($quantity) ?></span></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="MeatGrains">
													<tr>
														<td>
															<label class="form-label">Available Product</label>
															<select class="form-control meat-grains-product"></select>
														</td>
														<td>
															<label class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="MeatGrains"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control meat-grains-quantity quantity" value=0 data-input-category="MeatGrains">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="MeatGrains"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" id="meat-grains" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
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
														<th>EST QTY <span class="badge badge-info"><?php echo htmlentities($quantity) ?></span></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="Medicine">
													<tr>
														<td>
															<label class="form-label">Available Product</label>
															<select name="product" class="form-control medicine-product"></select>
														</td>
														<td>
															<label class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Medicine"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control medicine-quantity quantity" value=0 data-input-category="Medicine">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Medicine"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" id="medicine" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
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
														<th>EST QTY <span class="badge badge-info"><?php echo htmlentities($quantity) ?></span></th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody data-body-category="Others">
													<tr>
														<td>
															<label class="form-label">Available Product</label>
															<select class="form-control others-product"></select>
														</td>
														<td>
															<label class="form-label">Quantity</label>
															<div class="d-flex justify-content-center border">
																<button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Others"><i class="fa-solid fa-minus"></i></button>
																<input type="number" class="form-control others-quantity quantity" value=0 data-input-category="Others">
																<button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Others"><i class="fa-solid fa-plus"></i></button>
															</div>
														</td>
														<td><button type="button" id="others" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
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
									<button type="submit" class="btn btn-success btn-block btn-rounded">
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
	<script type="text/javascript" src="../scripts/mdb.min.js"></script>
	<script src="../scripts/sweetalert2.all.min.js"></script>
	<script src="scripts/AcceptRequest.js"></script>
	<script src="../scripts/CancelButton.js"></script>
</body>

</html>