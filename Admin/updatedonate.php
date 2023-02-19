<?php
session_start(); ?>
<?php
require_once "include/connection.php";
if (isset($_GET["editdonate"])) {
  $update_id = $_GET["editdonate"];
  $sql = "SELECT * FROM donation_items WHERE donor_id=?";
  $stmt = $conn->prepare($sql);
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
  $donorcontact = $row["donor_contact"];
}
function fill_category_select_box($conn)
{
  $output = "";
  $sql = "SELECT * From category order by categ_id ASC";
  $result = mysqli_query($conn, $sql);
  foreach ($result as $row) {
    $output .=
      '<option value="' .
      $row["categ_id"] .
      '">' .
      $row["category"] .
      "</option>";
  }
  return $output;
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


	<title>Update Donations</title>
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
        <a href="donations.php" class="nav-link active">
          <i class='bx bxs-box active'></i>
          <span class="text">Donors</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class='bx bxs-envelope'></i>
          <span class="text">Requests</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class='bx bxs-package'></i>
          <span class="text">Stocks</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="users.php" class="nav-link">
          <i class='bx bxs-user-plus' ></i>
          <span class="text">Users</span>
        </a>
      </li>
      <li class="nav-item log-item">
        <a href="./include/logout.php" class="nav-link log-link">
        	<i class="fa-solid fa-right-from-bracket"></i>
          <span class="text">Logout</span>
       		</a>
     	</li>
    </ul>
  </nav>
 
    </div>

<!--Main content -->
  <div class="main-content">
  <div class="content">


  </div>
  
  <div class="mb-4 custom-breadcrumb">
			<h1 class="fs-1 breadcrumb-title">Update Donations</h1>
			<nav class="bc-nav d-flex">
				<h6 class="mb-0">
					<a href="" class="text-reset bc-path">Home</a>
					<span>/</span>
					<a href="donations.php" class="text-reset bc-path active">Donors Information</a>
				</h6>
			</nav>
			<!-- Breadcrumb -->
		</div>

		<div class="custom-container pb-3">
			<div class="card">
				<div class="card-body overflow-auto">


					<!--Place table here --->


					<div class="form-container mt-5 ms-5">
						<div class="personal">
							<h6 style="width: 50px;
							height: 50px;
							border-radius: 25px;
							border: 2px solid #BEBEBE;
							display: flex;
							justify-content: center;
							align-items: center;
							float: left;
							margin-right: 10px;">
								<span style="font-size: 20px;">1</span>
							</h6>
							<div class="mt-3 ps-3" style="display: inline-block; color:#4d5157;">
								<h6 style="font-size:20px;"><span>Personal Details</span></h6>
							</div>
						</div>
						<!-- Start of Form-->
						<form class="p-3 ms-4 me-3" id="update-form">
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
											<input class="form-control" type="text" name="email" id="email" value="<?php echo htmlentities($donoremail) ; ?>">
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
											foreach ($result as $row): ?>
											<option value="<?php echo htmlentities($row["regCode"]); ?>" <?php if (
											$donorregion == $row["regCode"]) 
											{
											echo 'selected="selected"';
											} ?>>
											<?php echo htmlentities($row["regDesc"]); ?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group  mt-3">
										<label for="province">Select Province</label>
										<select class="form-control province" name="province" id="province">
											<option value="-Select-">-Select-</option>
											<?php
											$province ="SELECT provCode, provDesc FROM refprovince where regCode=?";
											$stmt = $conn->prepare($province);
											$stmt->bind_param("s", $donorregion);
											$stmt->execute();
											$resultProv = $stmt->get_result();
											$data = $resultProv->fetch_all(MYSQLI_ASSOC);
											foreach ($data as $row): ?>
											<option value="<?php echo htmlentities($row["provCode"]); ?>" 
											<?php if ($donorprovince == $row["provCode"])
											{
											echo 'selected="selected"';
											} ?>>
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
											foreach ($data as $row): ?>
											<option value="<?php echo htmlentities($row["citymunCode"]); ?>" 
											<?php if ($donormunicipality == $row["citymunCode"]) 
											{
											echo 'selected="selected"';
											} ?>>
											<?php echo htmlentities($row["citymunDesc"]); ?></option>
											<?php endforeach;?>
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
											foreach ($data as $row): ?>
											<option value="<?php echo htmlentities($row["brgyCode"]); ?>" 
											<?php if ($donorbarangay == $row["brgyCode"]) 
											{echo 'selected="selected"';} ?>>
											<?php echo htmlentities($row["brgyDesc"]); ?></option>
											<?php endforeach;?>
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
							<div class="personal pt-5" style="position:relative; right:34px;">
							<h6 style="width: 50px;
							height: 50px;
							border-radius: 25px;
							border: 2px solid #BEBEBE;
							display: flex;
							justify-content: center;
							align-items: center;
							float: left;
							margin-right: 10px;">
							<span style="font-size: 20px;">2</span>
								</h6>
								<div class="mt-3 ps-3" style="display: inline-block; color:#4d5157;">
									<h6 style="font-size:20px;"><span>List of Donations</span></h6>
								</div>
							</div>
						</div>
					<!--2nd table -->
					<div class="row pe-4 ps-5 ms-4 mt-4">
						<div class="col">
							<table class="table table-striped table-bordered" id="table_data">
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
        						$sql= "SELECT * FROM donation_items10 where Reference=?";
								$stmt=$conn->prepare($sql);
								$stmt->bind_param('i', $donorreference);
								$stmt->execute();
								$result = $stmt->get_result();
									$stmt->execute();
									$result = $stmt->get_result();
									while ($row = $result->fetch_assoc()): ?>
									<tr>
										<td><?php echo $row["productName"]; ?></td>
										<?php if ($row['type'] == null) { ?>
										<td><span class="badge rounded-pill badge-warning">Empty</span></td>
										<?php } else { ?>
										<td><?php echo $row["type"]; ?></td>
										<?php } ?>
										<?php if ($row['unit'] == null) { ?>
										<td><span class="badge rounded-pill badge-warning">Empty</span></td>
										<?php } else { ?>
										<td><?php echo $row["unit"]; ?></td>
										<?php } ?>
										<td><?php echo $row["quantity"]; ?></td>
									</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="mt-3" style="float:right;">
						<button type="button" class="btn btn-danger  cancelBtn" id="cancelBtn">Cancel</button>
						<button type="button" class="btn btn-success addDonate" id="testBtn">Save</button>
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
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="scripts/main.js"></script>
	<!--Here is the scripts for functions -->
	<script>
		$(document).ready(function() {
			$('#testBtn').click(function(e) {
				var valid = this.form.checkValidity();
				if (valid) {
					e.preventDefault();
					var donor_id = $('#donor_id').val();
					var reference_id = $('#reference_id').val();
					var fname = $('#fname').val();
					var province = $('#province').val();
					var region = $('#region').val();
					var municipality = $('#municipality').val();
					var barangay = $('#barangay').val();
					var email = $('#email').val();
					var donation_date = $('#donation_date').val();
					var contact = $('#contact').val();
					var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					var varnumbers = /^\d+$/;
					var inValid = /\s/;
					var data = {
						updateBtn: '',
						donor_id: donor_id,
						reference_id: reference_id,
						fname,
						province: province,
						region: region,
						municipality: municipality,
						barangay: barangay,
						contact: contact,
						email: email,
						donation_date: donation_date
					};
					if (fname == "") {
						$('#fname').removeClass('border-success');
						$('#fname').addClass('border-danger');
						return false;
					} else if (region == "-Select-") {
						Swal.fire('Select', "Please select a region", 'warning');
						return false;
					} else if (province == "-Select-") {
						Swal.fire('Select', "Please select a province", 'warning');
						return false;
					} else if (municipality == "-Select-") {
						Swal.fire('Select', "Please select a municipality", 'warning');
						return false;
					} else if (barangay == "-Select-") {
						Swal.fire('Select', "Please select a barangay", 'warning');
						return false;
					} else if (contact == "") {
						$('#contact').removeClass('border-success');
						$('#contact').addClass('border-danger');
					} else if (inValid.test($('#contact').val()) == true) {
						Swal.fire('Contact', "Whitespace is prohibited.", 'warning');
						$('#contact').removeClass('border-success');
						$('#contact').addClass('border-danger');
						return false;
					} else if (varnumbers.test($('#contact').val()) == false) {
						Swal.fire('Number', "Numbers only.", 'warning');
						$('#contact').removeClass('border-success');
						$('#contact').addClass('border-danger');
						return false;
					} else if (contact.length != 11) {
						Swal.fire('Contact', "Enter Valid Contact Number", 'warning');
						$('#contact').removeClass('border-success');
						$('#contact').addClass('border-danger');
						return false;
					} else if (email == "") {
						$('#email').removeClass('border-success');
						$('#email').addClass('border-danger');
						return false;
					} else if (emailVali.test($('#email').val()) == false) {
						Swal.fire('Email', "Invalid email address", 'warning');
						$('#email').removeClass('border-success');
						$('#email').addClass('border-danger');
						return false;
					} else if (donation_date == "") {

						$('#donation_date').removeClass('border-success');
						$('#donation_date').addClass('border-danger');
						return false;
					} else {
						$.ajax({
							url: 'include/edit.inc.php',
							method: 'POST',
							data: data,
							success: function(data) {
								Swal.fire({
									icon: 'success',
									title: 'Success',
									text: data,
								}).then(function() {
									window.location = "donations.php";
								});
							}

						});
					}



				}
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#region').on('change', function() {
				var regCode = $(this).val();
				if (regCode) {
					$.ajax({
						url: 'include/region.php',
						type: 'POST',
						data: 'regCode=' + regCode,
						success: function(data) {
							$('.province').html(data);
						}

					});
				} else {
					swal.fire('Warning', 'Select region', 'warning');
				}
			});
			$('#province').on('change', function() {
				var provCode = $(this).val();
				if (provCode) {
					$.ajax({
						url: 'include/region.php',
						type: 'POST',
						data: 'provCode=' + provCode,
						success: function(data) {
							$('.municipality').html(data);
						}

					});
				} else {
					swal.fire('Warning', 'Select Province', 'warning');
				}
			});
			$('#municipality').on('change', function() {
				var citymunCode = $(this).val();
				if (citymunCode) {
					$.ajax({
						url: 'include/region.php',
						type: 'POST',
						data: 'citymunCode=' + citymunCode,
						success: function(data) {
							$('.barangay').html(data);
						}

					});
				} else {
					swal.fire('Warning', 'Select Province', 'warning');
				}
			});

		});
	</script>
	<script>
		$(document).ready(function(){
			$('#cancelBtn').click(function(){
				window.location.href= ('donations.php');
			})
		});
	</script>







</body>

</html>