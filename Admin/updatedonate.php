<?php include 'include/protect.php' ;
require_once 'include/connection.php';

$sql= "SELECT firstname,profile FROM adduser WHERE uID=? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('i',$userID );
try{
  $stmt->execute();
  $result= $stmt->get_result();
  if($result->num_rows == 0) {
    echo "Invalid email or password.";
  }
  else{
    while($row= $result->fetch_assoc()){
     $firstname=  $row['firstname'];
     $profile=  $row['profile'];

    }
  }

}

catch(Exception $e){
  echo "Error". $e->getMessage();

}
if (isset($_GET["editdonate"])) {
	$update_id = $_GET["editdonate"];
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
	$donorcontact = $row["donor_contact"];
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
        <a href="stocks.php" class="nav-link">
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
    </ul>
  </nav>
 
    </div>

<!--Main content -->
  <div class="main-content">
  <!--Header -->
  <div class="mb-4 custom-breadcrumb">
  <div class="crumb">
    <h1 class="fs-1 breadcrumb-title">Update Donor</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="" class="text-reset bc-path">Home</a>
        <span>/</span>
        <a href="" class="text-reset bc-path active">Update Donor</a>
      </h6>  
    </nav>
  </div>
  <div style="margin-left: auto;">
    <div class="dropdown">
  <a
    class="dropdown-toggle"
    id="dropdownMenuButton"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
    style="border: none;"
  >
  <?php if ($profile==null){ ?>
    <img src="img/default-admin.png" class="rounded-circle" style="width: 100px; border:1px green;" alt="Avatar" />
  <?php }else{?>
    <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle" style="width: 100px; height:100px; object-fit: cover; border:1px green;" alt="Avatar" />
  <?php }?>

  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><h6 class="dropdown-item">Hello <?php echo htmlentities($firstname);?>!</h6></li>
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
					<div class="d-flex justify-content-end mt-3">
						<div class="me-3">
							<button type="button" class="btn btn-danger cancelBtn" id="cancelBtn">Cancel</button>
						</div>
						<div>
							<button type="button" class="btn btn-success addDonate" id="testBtn">
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
				let valid = this.form.checkValidity();
				if (valid) {
					e.preventDefault();
					let donor_id = $('#donor_id').val();
					let reference_id = $('#reference_id').val();
					let fname = $('#fname').val();
					let province = $('#province').val();
					let region = $('#region').val();
					let municipality = $('#municipality').val();
					let barangay = $('#barangay').val();
					let email = $('#email').val();
					let donation_date = $('#donation_date').val();
					let contact = $('#contact').val();
					let emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					let varnumbers = /^\d+$/;
					let inValid = /\s/;
					let data = {
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
							beforeSend:()=>{
								$('button[type="submit"]').prop('disabled', true);
								$('.submit-text').text('Updating...');
								$('.spinner-border').removeClass('d-none');

							},
							success: function(data) {
								if (data==='success'){
							setTimeout(() => {
							// Enable the submit button and hide the loading animation
							$('button[type="submit"]').prop('disabled', false);
							$('.submit-text').text('Update');
							$('.spinner-border').addClass('d-none');
							Swal.fire({
								title: 'Success',
								text: "Data has been updated",
								icon: 'success',
								confirmButtonColor: '#20d070',
								confirmButtonText: 'OK',
								allowOutsideClick: false
								}).then((result) => {
								if (result.isConfirmed) {
									window.location.href = "donations.php?dataUpdated";
								}
								})
							}, 1000);
								}
								else{
								$('.submit-text').text('Update');
								$('.spinner-border').addClass('d-none');
								Swal.fire({
									title: 'Error',
									text: data,
									icon: 'error',
									confirmButtonColor: '#20d070',
									confirmButtonText: 'OK',
									allowOutsideClick: false
								})
									}
							},
							error: (xhr, status, error)=>{
								$('.submit-text').text('Update');
								$('.spinner-border').addClass('d-none');
								// Handle errors
								Swal.fire({
									title: 'Error',
									text: xhr.responseText,
									icon: 'error',
									confirmButtonColor: '#20d070',
									confirmButtonText: 'OK',
									allowOutsideClick: false
								})
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
				let regCode = $(this).val();
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
				let provCode = $(this).val();
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
				let citymunCode = $(this).val();
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