<?php require_once "../include/protect.php";
require_once "../include/profile.inc.php";
require_once "../include/sidebar.php";
require_once "../include/FunctionSelectBox.php";
require_once "../../../config/config.php";

if (isset($_GET["editdonate"])) {
	$encodedId = $_GET["editdonate"];
	$update_id = base64_decode($encodedId);
		$donor = "SELECT * FROM donation_items WHERE donor_id=?";
	$stmt = $conn->prepare($donor);
	$stmt->bind_param("i", $update_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$donorid = $row["donor_id"];
	$donorreference = $row["Reference"];
	$donorname = $row["donor_name"];
	$donorprovince = $row["donor_province"];
	$donorregion = $row["donor_region"];
	$donormunicipality = $row["donor_municipality"];
	$donorbarangay = $row["donor_barangay"];
	$donoremail = $row["donor_email"];
	$donordate = $row["donationDate"];
	$dateTrimmed = str_replace('-', '', $donordate);
	$donorcontact = $row["donor_contact"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
	<link rel="icon" href="../img/batangascitylogo.png" type="image/x-icon">
	<link rel="shortcut icon" href="../img/batangascitylogo.png" type="image/x-icon">
	<title>Update Donors</title>
</head>

<body>
	<!--Print -->
	<div class="modal fade" id="openPrint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Print Donor</h5>
					<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<button id="printReceipt" class="btn btn-secondary">Print</button>
					</div>
					<hr>
					<h4>Donor Details</h4>
					<div id="printable_area" class="me-3 ms-3">
						<div>
							<div class="text-center">
								<img src="../img/logo1.jpg" class="logo-header" alt="">
							</div>
							<p class="mb-0 text-center lead fs-6">City Risk Reduction Management Office</p>
							<p class="mb-0 text-center lead fs-6">Brgy Bolbok, Batangas City, Philippines</p>
						</div>
						<hr class="custom-divider">
						<div class="row">
							<div class="col">
								<p class="lead fs-6 mb-0">Donor Number: <strong><?php echo htmlentities("{$dateTrimmed}-00{$donorid}") ?></strong></p>
							</div>
							<div class="col">
								<p class="lead fs-6 mb-0">Donation Date: <strong><?php echo htmlentities($donordate) ?></strong></p>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<p class="lead fs-6 mb-0">Name: <strong><?php echo htmlentities($donorname) ?></strong></p>
							</div>
							<div class="col">
								<p class="lead fs-6 mb-0">Email: <strong><?php echo htmlentities($donoremail) ?></strong></p>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<p class="lead fs-6 mb-0">Contact Number: <strong><?php echo htmlentities($donorcontact) ?></strong></p>
							</div>
							<div class="col">
								<?php
								$region = $conn->prepare("SELECT * FROM refregion where regCode= ?");
								$region->bind_param('s', $donorregion);
								$region->execute();
								$regionResult = $region->get_result();
								$fetchedRegion = $regionResult->fetch_assoc();
								$regionName = $fetchedRegion['regDesc'];
								?>
								<p class="lead fs-6 mb-0">Region: <strong><?php echo htmlentities($regionName) ?></strong></p>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<?php
								$province = $conn->prepare("SELECT * FROM refprovince where provCode= ?");
								$province->bind_param('s', $donorprovince);
								$province->execute();
								$provinceResult = $province->get_result();
								$fetchedProvince = $provinceResult->fetch_assoc();
								$provinceName = $fetchedProvince['provDesc'];
								?>
								<p class="lead fs-6 mb-0">Province: <strong><?php echo htmlentities($provinceName) ?></strong></p>
							</div>
							<div class="col">
								<?php
								$municipality = $conn->prepare("SELECT * FROM refcitymun where citymunCode= ?");
								$municipality->bind_param('s', $donormunicipality);
								$municipality->execute();
								$municipalityResult = $municipality->get_result();
								$fetchedMunicipality = $municipalityResult->fetch_assoc();
								$municipalityName = $fetchedMunicipality['citymunDesc'];
								?>
								<p class="lead fs-6 mb-0">Municipality: <strong><?php echo htmlentities($municipalityName) ?></strong></p>
							</div>
							<div class="col">
								<?php
								$barangay = $conn->prepare("SELECT * FROM refbrgy where brgyCode= ?");
								$barangay->bind_param('s', $donorbarangay);
								$barangay->execute();
								$barangayResult = $barangay->get_result();
								$fetchedBarangay = $barangayResult->fetch_assoc();
								$barangayName = $fetchedBarangay['brgyDesc'];
								?>
								<p class="lead fs-6 mb-0">Barangay: <strong><?php echo htmlentities($barangayName) ?></strong></p>
							</div>
						</div>
						<div class="table-responsive">
							<table id="table-container" class="table table-sm table-bordered">
								<thead class="bg-light">
									<tr>
										<th>Product Name</th>
										<th>Type</th>
										<th>Unit</th>
										<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM donation_items10 where Reference=?";
									$stmt = $conn->prepare($sql);
									$stmt->bind_param('i', $donorreference);
									$stmt->execute();
									$result = $stmt->get_result();
									$stmt->execute();
									$result = $stmt->get_result();
									while ($row = $result->fetch_assoc()) : ?>
										<tr>
											<td><?php echo $row["productName"]; ?></td>
											<td><?php if ($row['type'] == null) { ?>
													<p class="lead fs-6">N/A</p>
												<?php } else {
													echo $row["type"];
												} ?>
											</td>
											<td><?php if ($row['unit'] == null) { ?>
													<p class="lead fs-6">N/A</p>
												<?php } else {
													echo $row["unit"];
												} ?>
											</td>
											<td><?php echo $row["quantity"]; ?></td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-container">
		<!-- SIDEBAR -->
		<div class="sidebar" id="sidebar"><?php echo sidebar() ?> </div>
		<!--Main content -->
		<div class="main-content">
			<!--Header -->
			<div class="mb-4 custom-breadcrumb">
				<div class="crumb">
					<h1 class="fs-1 breadcrumb-title">Update Donors</h1>
					<nav class="bc-nav d-flex">
						<h6 class="mb-0">
							<a href="../Dashboard/Dashboard.php" class="text-muted bc-path">Home</a>
							<span>/</span>
							<a href="Donors.php" class="text-muted bc-path">Donors</a>
							<span>/</span>
							<a href="#" class="text-reset bc-path active">Update Donors</a>
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
						<div class="d-flex justify-content-end">
							<button data-mdb-toggle="modal" data-mdb-target="#openPrint" class="btn btn-secondary btn-rounded" type="button">View</button>
						</div>
						<div id="update_form">
							<div class="form-container mt-5 ms-5">
								<div class="d-inline-flex">
									<h6 class="number-title">1</h6>
									<div class="mt-3 ps-3">
										<h4 class="text-muted">Personal Details</h4>
									</div>
								</div>
								<!-- Start of Form-->
								<form class="p-3 ms-4 me-3">
									<input type="hidden" name="donor_id" id="donor_id" value="<?php echo htmlentities($donorid); ?>" readonly>
									<input type="hidden" value="<?php echo htmlentities($donorreference); ?>" name="reference_id" id="reference_id" readonly>
									<div class="row">
										<div class="col">
											<div class="form-group  mt-3">
												<div class="form-outline">
													<input class="form-control" type="text" name="fname" id="fname" value="<?php echo htmlentities($donorname); ?>">
													<label class="form-label" for="fname">Fullname</label>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="form-group mt-3">
												<div class="form-outline">
													<input class="form-control" type="text" name="email" id="email" value="<?php echo htmlentities($donoremail); ?>">
													<label class="form-label" for="email">Email</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group  mt-3">
												<label for="region">Select Region</label>
												<select class="form-control region" name="region" id="region">
													<option value="-Select-">-Select-</option>
													<?php
													$sql = "SELECT * FROM refregion";
													$result = mysqli_query($conn, $sql);
													foreach ($result as $row) : ?>
														<option value="
														<?php echo htmlentities($row["regCode"]); ?>" 
														<?php if ($donorregion == $row["regCode"])
														 { echo 'selected="selected"'; } ?>>
														<?php echo htmlentities($row["regDesc"]); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="form-group  mt-3">
												<label for="province">Select Province</label>
												<select class="form-control province" name="province" id="province">
													<option value="-Select-">-Select-</option>
													<?php
													$province = "SELECT provCode, provDesc FROM refprovince where regCode=?";
													$stmt = $conn->prepare($province);
													$stmt->bind_param("s", $donorregion);
													$stmt->execute();
													$resultProv = $stmt->get_result();
													$data = $resultProv->fetch_all(MYSQLI_ASSOC);
													foreach ($data as $row) : ?>
														<option value="
														<?php echo htmlentities($row["provCode"]); ?>" 
														<?php if ($donorprovince == $row["provCode"])
														{ echo 'selected="selected"'; } ?>>
														<?php echo htmlentities($row["provDesc"]); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="form-group  mt-3">
												<label for="municipality">Select Municipality</label>
												<select class="form-control municipality" name="municipality" id="municipality">
													<option value="-Select-">-Select-</option>
													<?php
													$city =
														"SELECT citymunCode, citymunDesc FROM refcitymun where provCode=?";
													$stmt = $conn->prepare($city);
													$stmt->bind_param("s", $donorprovince);
													$stmt->execute();
													$resultProv = $stmt->get_result();
													$data = $resultProv->fetch_all(MYSQLI_ASSOC);
													foreach ($data as $row) : ?>
														<option value="
														<?php echo htmlentities($row["citymunCode"]); ?>" 
														<?php if ($donormunicipality == $row["citymunCode"]) 
														{ echo 'selected="selected"'; } ?>>
														<?php echo htmlentities($row["citymunDesc"]); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="form-group  mt-3">
												<label for="barangay">Select Barangay</label>
												<select class="form-control barangay" name="barangay" id="barangay">
													<option value="-Select-">-Select-</option>
													<?php
													$brgy = "SELECT brgyCode, brgyDesc FROM refbrgy where citymunCode=?";
													$stmt = $conn->prepare($brgy);
													$stmt->bind_param("s", $donormunicipality);
													$stmt->execute();
													$resultProv = $stmt->get_result();
													$data = $resultProv->fetch_all(MYSQLI_ASSOC);
													foreach ($data as $row) : ?>
														<option value="
														<?php echo htmlentities($row["brgyCode"]); ?>" 
														<?php if ($donorbarangay == $row["brgyCode"]) 
														{ echo 'selected="selected"'; } ?>>
														<?php echo htmlentities($row["brgyDesc"]); ?></option> 
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="form-group mt-4">
												<div class="form-outline">
													<input class="form-control" type="text" name="contact" id="contact" value="<?php echo htmlentities($donorcontact); ?>">
													<label class="form-label" for="contact">Contact</label>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="donation_date">Donation Date</label>
												<input class="form-control" type="date" name="donation_date" id="donation_date" value="<?php echo $donordate; ?>">
											</div>
										</div>
									</div>
									<!--Number 2 -->
									<div class="d-inline-flex pt-4 number-two">
										<h6 class="number-title">2</h6>
										<div class="mt-3 ps-3">
											<h4 class="text-muted">Donations</h4>
										</div>
									</div>
							</div>
							<!--2nd table -->
							<div class="pe-4 ps-5 ms-4 mt-4 table-responsive">
								<table class="table table-sm table-bordered update-form" id="update-form">
									<thead>
										<tr>
											<th>Product Name</th>
											<td>Type</td>
											<th>Unit</th>
											<th>Quantity</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM donation_items10 where Reference=?";
										$stmt = $conn->prepare($sql);
										$stmt->bind_param('i', $donorreference);
										$stmt->execute();
										$result = $stmt->get_result();
										$stmt->execute();
										$result = $stmt->get_result();
										while ($row = $result->fetch_assoc()) : ?>
											<tr>
												<td><?php echo $row["productName"]; ?></td>
												<td><?php if ($row['type'] == null) { ?>
														<span class="badge rounded-pill badge-warning">Empty</span>
													<?php } else {
														echo $row["type"];
													} ?>
												</td>
												<td><?php if ($row['unit'] == null) { ?>
														<span class="badge rounded-pill badge-warning">Empty</span>
													<?php } else {
														echo $row["unit"];
													} ?>
												</td>
												<td><?php echo $row["quantity"]; ?></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="d-flex justify-content-end mt-3">
							<div class="me-3">
								<button type="button" class="btn btn-danger cancelBtn btn-rounded" id="cancelBtn">Cancel</button>
							</div>
							<div>
								<button type="submit" class="btn btn-success addDonate btn-rounded" id="updateBtn">
									<span class="submit-text">Update</span>
									<span class="spinner-border spinner-border-sm  d-none" role="status" aria-hidden="true"></span>
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
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="../scripts/mdb.min.js"></script>
	<script src="../scripts/sweetalert2.all.min.js"></script>
	<script src="../scripts/timeout.js"></script>
	<script src="scripts/LocationSelect.js"></script>
	<script src="scripts/UpdateDonor.js"></script>
	<script src="../scripts/CancelButton.js"></script>
	<script src="../scripts/TableFilterButtons.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
</body>
</html>