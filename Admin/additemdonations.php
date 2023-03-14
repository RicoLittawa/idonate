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
function fill_region_select_box($conn)
{
	$output = '';
	$sql = "SELECT * FROM refregion";
	$stmt=$conn->prepare($sql);
    $stmt->execute();
	$result = $stmt->get_result(); 
	foreach ($result as $row) {
		$regid = htmlentities($row['regCode']);
		$regname = htmlentities($row['regDesc']);
		$output .= '<option value="' . $regid . '">' . $regname . '</option>';
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
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<title>Add Donations</title>
</head>

<body>
	<!-- SIDEBAR -->
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
        <a href="request.php" class="nav-link">
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
        <a href="users.php" class="nav-link ">
          <i class='bx bxs-user-plus ' ></i>
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
    <h1 class="fs-1 breadcrumb-title">Add Donation</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="donations.php" class="text-muted bc-path">Donors</a>
        <span>/</span>
        <a href="#" class="text-reset bc-path active">Add Donation</a>
      </h6>  
    </nav>
  </div>
  <div class="ms-auto">
    <div class="dropdown">
  <a
    class="dropdown-toggle border border-0"
    id="dropdownMenuButton"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
  >
  <?php if ($profile==null){ ?>
    <img src="img/default-admin.png" class="rounded-circle w-100"alt="Avatar" />
  <?php }else{?>
    <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
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
					<div class="d-inline-flex">
							<h6 class="number-title">1</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted">Personal Details</h4>
								</div>
							</div>
						<form id="add-form" class="p-3 ms-4 me-3">
							<?php
							$sql = "SELECT * FROM donation_items_picking";
							$result = mysqli_query($conn, $sql);
							foreach ($result as $row) {
								$referenceId = $row['reference_id'];
							}
							?>
							<input hidden id="reference_id" value="<?php echo htmlentities($referenceId); ?>" readonly>
							<div class="row">
								<div class="col">
									<div class="form-group  mt-3">
										<div class="form-outline">
											<input class="form-control border-success" type="text" name="fname" id="fname">
											<label class="form-label" for="fname">Full Name</label>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="form-group mt-3">
										<div class="form-outline">
											<input class="form-control" type="text" name="email" id="email">
											<label class="form-label" for="email">Email</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group  mt-3">
										<label for="region">Select Region</label>
										<select class="form-control" name="region" id="region">
											<option value="">--</option>
											<?php echo fill_region_select_box($conn); ?>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group  mt-3">
										<label for="province">Province</label>
										<select class="form-control" name="province" id="province">
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group  mt-3">
										<label for="municipality">Municipality</label>
										<select class="form-control" name="municipality" id="municipality">
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group  mt-3">
										<label for="barangay">Barangay</label>
										<select class="form-control" name="barangay" id="barangay">
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group mt-4">
										<div class="form-outline">
											<input class="form-control" type="text" id="contact" name="contact">
											<label class="form-label" for="contact">Contact</label>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="donation_date">Donation Date</label>
										<input class="form-control" id="donation_date" type="date" name="donation">
									</div>
								</div>
							</div>
							<div class="d-inline-flex pt-4"  style="position:relative; right:34px;">
							<h6 class="number-title">2</h6>
								<div class="mt-3 ps-3">
									<h4 class="text-muted">Donation Type and Category</h4>
								</div>
							</div>
					</div>
					
					<div class="row pe-4 ps-5 ms-4">
						<div class="col">
							<div class="form-group cn mt-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input selectCateg" type="checkbox" id="box1" value="cannoodles">
									<label class="form-check-label" for="">Can Goods & Noodles</label>
								</div>
								<table class="table cnTB col table-bordered" id="cnTB">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="cnBody" id="cnBody">
										<tr>
											<td><input type="text" class="form-control name_items pnCN" id="pnCN"></td>
											<td><input type="number" class="form-control qCN" id="qCN"></td>
											<td><button type="button" class="btn btn-success addCN btn-rounded" id="addCN"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group hy">
								<div class="form-check form-check-inline">
									<input class="form-check-input selectCateg" type="checkbox" id="box2" value="hygine">
									<label class="form-check-label" for="">Hygiene Essentials</label>
								</div>
								<table class="table hyTB col table-bordered" id="hyTB">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="hyBody" id="hyBody">
										<tr>
											<td><input type="text" class="form-control name_items pnHY" id="pnHY"></td>
											<td><input type="number" class="form-control qHY" id="qHY"></td>
											<td><button type="button" class="btn btn-success addHY btn-rounded" id="addHY"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group ii">
								<div class="form-check form-check-inline">
									<input class="form-check-input selectCateg" type="checkbox" id="box3" value="infant">
									<label class="form-check-label" for="">Infant Items(*Formula not included)</label>
								</div>
								<table class="table iiTB col table-bordered" id="iiTB">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="iiBody" id="iiBody">
										<tr>
											<td><input type="text" class="form-control name_items pnII" id="pnII"></td>
											<td><input type="number" class="form-control qII" id="qII"></td>
											<td><button type="button" class="btn btn-success addII btn-rounded" id="addII"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group dw">
								<div class="form-check form-check-inline">
									<input class="form-check-input selectCateg" type="checkbox" id="box4" value="drink">
									<label class="form-check-label" for="">Drinking Water</label>
								</div>
								<table class="table dwTB col table-bordered" id="dwTB">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="dwBody" id="dwBody">
										<tr>
											<td><input type="text" class="form-control name_items pnDW" id="pnDW"></td>
											<td><input type="number" class="form-control qDW" id="qDW"></td>
											<td><button type="button" class="btn btn-success addDW btn-rounded" id="addDW"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group mg">
								<div class="form-check form-check-inline">
									<input class="form-check-input selectCateg" type="checkbox" id="box5" value="meat">
									<label class="form-check-label" for="">Meats/Grains</label>
								</div>
								<table class="table mgTB col table-bordered" id="mgTB">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Type</th>
											<th>Quantity</th>
											<th>Unit</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="mgBody" id="mgBody">
										<tr>
											<td><input type="text" class="form-control name_items pnMG" id="pnMG"></td>
											<td><select class="form-control typeMG" name="typeMG" id="typeMG">
													<option value="">--</option>
													<option value="Frozen">Frozen</option>
													<option value="Fresh">Fresh</option>
													<option value="None">None</option>
												</select></td>
											<td><input type="number" class="form-control qMG" id="qMG"></td>
											<td><select class="form-control unitMG" name="unitMG" id="unitMG">
													<option value="">--</option>
													<option value="Kilograms">Kilograms</option>
													<option value="Grams">Grams</option>
												</select></td>
											<td><button type="button" class="btn btn-success addMG btn-rounded" id="addMG"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group me">
								<div class="form-check form-check-inline">
									<input class="form-check-input selectCateg" type="checkbox" id="box6" value="meds">
									<label class="form-check-label" for="">Medicine</label>
								</div>
								<table class="table meTB col table-bordered" id="meTB">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Type</th>
											<th>Quantity</th>
											<th>Unit</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="meBody" id="meBody">
										<tr>
											<td><input type="text" class="form-control name_items pnME" id="pnME"></td>
											<td><select class="form-control typeME" name="typeME" id="typeME">
													<option value="">--</option>
													<option value="Tablet">Tablet</option>
													<option value="Capsule">Capsule</option>
													<option value="Liquid">Liquid</option>
													<option value="None">None</option>
												</select></td>
											<td><input type="number" class="form-control qME" id="qME"></td>
											<td><select class="form-control unitME" name="unitME" id="unitME">
													<option value="">--</option>
													<option value="Milligrams">Milligrams</option>
													<option value="Grams">Grams</option>
													<option value="Micrograms">Micrograms</option>
													<option value="None">None</option>
												</select></td>
											<td><button type="button" class="btn btn-success addME btn-rounded" id="addME"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group ot">
								<div class="form-check form-check-inline">
									<input class="form-check-input selectCateg" type="checkbox" id="box7" value="other">
									<label class="form-check-label" for="">Others (Type n/a if there is no type or unit)</label>
								</div>
								<table class="table otTB col table-bordered" id="otTB">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Type</th>
											<th>Quantity</th>
											<th>Unit</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="otBody" id="otBody">
										<tr>
											<td><input type="text" class="form-control pnOT" id="pnOT"></td>
											<td><input type="text" class="form-control typeOT" id="typeOT"></td>
											<td><input type="number" class="form-control qOT" id="qOT"></td>
											<td><input type="text" class="form-control unitOT" id="unitOT"></td>
											<td><button type="button" class="btn btn-success addOT btn-rounded" id="addOT"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-end mt-3">
						<div class="me-3">
							<button type="button" class="btn btn-danger cancelBtn btn-rounded" id="cancelBtn">Cancel</button>
						</div>
						<div>
							<button type="submit"  class="btn btn-success waves-effect waves-light btn-rounded" id="saveD">
								<span class="submit-text">Save</span>
  								<span class="spinner-border spinner-border-sm  d-none" role="status" aria-hidden="true"></span>
							</button>
						</div>
					</div>
					</form>
				</div>
				<!--End of form-->
			</div>
		</div>
		<!--End of card-->


		
		</div>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="scripts/main.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

	<!--Here is the scripts for functions -->


	<script>
		$(document).ready(()=> {

			let count= 0;
			//function to identify each button and add dynamic row to table
			const addRowButton=(buttonType)=> {
				let html = '';
				let remove = '';
			if (buttonType === 'buttonCN') {
				html += '<tr><td><input type="text" class="form-control name_items pnCN" id="pnCN"></td><td><input type="number" class="form-control qCN" id="qCN"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			}
			else if (buttonType === 'buttonHY') {
				html += '<tr><td><input type="text" class="form-control name_items pnHY" id="pnHY"></td><td><input type="number" class="form-control qHY" id="qHY"></td>';
				if (count > 0) {
					remove += '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			} 
			else if (buttonType=== 'buttonII'){
				html+= '<tr><td><input type="text" class="form-control name_items pnII" id="pnII"></td><td><input type="number" class="form-control qII" id="qII"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>'
				}
				html+= '<td>' + remove + '</td></tr>';
				return html;
			}
			else if (buttonType=== 'buttonDW'){
				html += '<tr><td><input type="text" class="form-control name_items pnDW" id="pnDW"></td><td><input type="number" class="form-control qDW" id="qDW"></td>';
				if (count > 0) {
					remove = '<button type="button"  class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>'
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			}
			else if (buttonType=== 'buttonMG'){
				html += '<tr><td><input type="text" class="form-control name_items pnMG" id="pnMG"></td>' +
					'<td><select class="form-control typeMG" name="typeMG" id="typeMG">' +
					'<option value="">--</option>' +
					'<option value="Frozen">Frozen</option>' +
					'<option value="Fresh">Fresh</option>' +
					'<option value="None">None</option>' +
					'</select></td>' +
					'<td><input type="number" class="form-control qMG" id="qMG"></td>' +
					'<td><select class="form-control unitMG" name="unitMG" id="unitMG">' +
					'<option value="">--</option>' +
					'<option value="Kilograms">Kilograms</option>' +
					'<option value="Grams">Grams</option>' +
					'</select></td>';
				if (count > 0) {
					remove = '<button type="button"  class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>'
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			}
			else if (buttonType=== 'buttonME'){
				html += '<tr><td><input type="text" class="form-control name_items pnME" id="pnME"></td>' +
					'<td><select class="form-control typeME" name="typeME" id="typeME">' +
					'<option value="">--</option>' +
					'<option value="Tablet">Tablet</option>' +
					'<option value="Capsule">Capsule</option>' +
					'<option value="Liquid">Liquid</option>' +
					'<option value="None">None</option>' +
					'</select></td>' +
					'<td><input type="number" class="form-control qME" id="qME"></td>' +
					'<td><select class="form-control unitME" name="unitME" id="unitME">' +
					'<option value="">--</option>' +
					'<option value="Milligrams">Milligrams</option>' +
					'<option value="Grams">Grams</option>' +
					'<option value="Micrograms">Micrograms</option>' +
					'<option value="None">None</option>' +
					'</select></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>'
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			}
			else if (buttonType=== 'buttonOT'){
				html += '<tr><td><input type="text" class="form-control pnOT" id="pnOT"></td>' +
					'<td><input type="text" class="form-control typeOT" id="typeOT"></td>' +
					'<td><input type="number" class="form-control qOT" id="qOT"></td>' +
					'<td><input type="text" class="form-control unituOT" id="unituOT"></td>';
				if (count > 0) {
					remove = '<button type="button"  class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>'
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			}
			}
			//remove row on specific table
			$(document).on('click', '.remove',function(){
				$(this).closest('tr').remove();
			})

			//append table rows
			$('#addCN').click(function(){
				count++;
				$('#cnBody').append(addRowButton('buttonCN'))
				
			})		
			$('#addHY').click(function(){
				count++
				$('#hyBody').append(addRowButton('buttonHY'))
			})
			$('#addII').click(function(){
				count++
				$('#iiBody').append(addRowButton('buttonII'))
			})
			$('#addDW').click(function(){
				count++
				$('#dwBody').append(addRowButton('buttonDW'))
			})

			$('#addMG').click(function(){
				count++
				$('#mgBody').append(addRowButton('buttonMG'))
			})

			$('#addME').click(function(){
				count++
				$('#meBody').append(addRowButton('buttonME'))
			})

			$('#addOT').click(function(){
				count++
				$('#otBody').append(addRowButton('buttonOT'))
			})

			//save the data on  the forms
			$(document).submit('#saveD', function(e) {
				e.preventDefault();			
			// Check which categories are selected
			let result = [];
			let x = 0;
			$('.selectCateg:checked').each(function() {
				result[x++] = $(this).val();
			});

	// Push data into respective arrays
			let inputFields = {
			"CN": {
				"pn":[],
				"q": []
			},
			"HY": {
				"pn":[],
				"q": []
			},
			"II": {
				"pn": [],
				"q": []
			},
			"DW": {
				"pn": [],
				"q":[]
			},
			"MG": {
				"pn": [],
				"type":[],
				"q": [],
				"unit":[] 
			},
			"ME": {
				"pn": [],
				"type": [],
				"q":[],
				"unit":[] 
			},
			"OT": {
				"pn": [],
				"type": [],
				"q": [],
				"unit":[]
			}
			}
		/**Donor Details */
		let ref_id = $('#reference_id').val();
		let fname= $('#fname').val();
		let region= $('#region').val();
		let province= $('#province').val();
		let municipality= $('#municipality').val();
		let barangay=$('#barangay').val();
		let contact= $('#contact').val();
		let email= $('#email').val();
		let donation_date=$('#donation_date').val();
		/**Donor Details */

		/** Validations */
		 let emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		 let varnumbers = /^\d+$/;
		 let isInvalid = false; // variable to keep track if any input is invalid
		 /** Validations */
		
		 	//data object pass to ajax
		 		let inputData = {
		 			saveBtn: '',
		 			result: result,
		 			ref_id: ref_id,
		 			fname: fname,
		 			region: region,
		 			province: province,
		 			municipality: municipality,
		 			barangay:barangay,
		 			contact: contact,
		 			email: email,
		 			donation_date:donation_date,
		 			pnCN_arr: inputFields.CN.pn,
		 			qCN_arr: inputFields.CN.q,
		 			pnHY_arr: inputFields.HY.pn,
		 			qHY_arr: inputFields.HY.q,
		 			pnII_arr: inputFields.II.pn,
		 			qII_arr: inputFields.II.q,
		 			pnDW_arr: inputFields.DW.pn,
		 			qDW_arr: inputFields.DW.q,
		 			pnMG_arr: inputFields.MG.pn,
		 			typeMG_arr: inputFields.MG.type,
		 			qMG_arr: inputFields.MG.q,
		 			unitMG_arr: inputFields.MG.unit,
		 			pnME_arr: inputFields.ME.pn,
		 			typeME_arr: inputFields.ME.type,
		 			qME_arr: inputFields.ME.q,
		 			unitME_arr: inputFields.ME.unit,
		 			pnOT_arr: inputFields.OT.pn,
		 			typeOT_arr: inputFields.OT.type,
		 			qOT_arr: inputFields.OT.q,
		 			unitOT_arr: inputFields.OT.unit
		 		}
		 		
				/**If the box is check it will get the data of each input field then pass it
				to the variable then check it if value of that input field is empty
				  * */
				 if ($('#box1').is(':checked')) {
				 	$('.pnCN').each((index, element)=> {
						inputFields.CN.pn.push($(element).val()); 
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 	
				 	})
				 	 $('.qCN').each((index, element) =>{
						inputFields.CN.q.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	
				 	 })
				 }
				 if ($('#box2').is(':checked')) {
				 	$('.pnHY').each((index,element)=> {
						inputFields.HY.pn.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.qHY').each((index,element)=> {
						inputFields.HY.q.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 }
				 if ($('#box3').is(':checked')) {
				 	$('.pnII').each((index,element)=> {
						inputFields.II.pn.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.qII').each((index,element)=> {
						inputFields.II.q.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 }
				 if ($('#box4').is(':checked')) { 
				 	$('.pnDW').each((index,element)=> {
						inputFields.DW.pn.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.qDW').each((index,element)=> {
						inputFields.DW.q.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 }
				 if ($('#box5').is(':checked')) {
				 	$('.pnMG').each((index,element)=> {
						inputFields.MG.pn.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.typeMG').each((index,element)=> {
						inputFields.MG.type.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.qMG').each((index,element)=> {
						inputFields.MG.q.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.unitMG').each((index,element)=> {
						inputFields.MG.unit.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 }
				 if ($('#box6').is(':checked')) {
				 	$('.pnME').each((index,element)=> {
						inputFields.ME.pn.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.typeME').each((index,element)=> {
						inputFields.ME.type.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.qME').each((index,element)=> {
						inputFields.ME.q.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.unitME').each((index,element)=> {
						inputFields.ME.unit.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 }
				 if ($('#box7').is(':checked')) {
				 	$('.pnOT').each((index,element)=> {
						inputFields.OT.pn.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.typeOT').each((index,element)=> {
						inputFields.OT.type.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.qOT').each((index,element)=> {
						inputFields.OT.q.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 	$('.unitOT').each((index,element)=> {
						inputFields.OT.unit.push($(element).val());
						if ($(element).val()==''){
							$(element).addClass('is-invalid');
      						isInvalid = true;
						}
						else{
							$(element).removeClass('is-invalid');
						}	 
				 	})
				 }

				// Validate the whole form
				 if (!fname) {
					$('#fname').addClass('is-invalid');
					isInvalid = true;
				 }
				 else{
					$('#fname').removeClass('is-invalid');
				 }
				 if (!email){
					$('#email').addClass('is-invalid');
					isInvalid = true;
				 }
				else if(emailVali.test(email) == false){
					Swal.fire({
					title: 'Warning',
					text: 'Invalid email address',
					icon: 'warning',
					confirmButtonColor: '#20d070' // Change the color value here
					});
					$('#email').addClass('is-invalid');
					isInvalid = true;
				 }
				 else{
					$('#email').removeClass('is-invalid');
				 }
				 if (!region){
					$('#region').addClass('is-invalid');
					isInvalid = true;
				 }
				 else{
					$('#region').removeClass('is-invalid');
				 }
				 if (!province){
					$('#province').addClass('is-invalid');
					isInvalid = true;
				 }
				 else{
					$('#province').removeClass('is-invalid');
				 }
				 if (!municipality){
					$('#municipality').addClass('is-invalid');
					isInvalid = true;
				 }
				 else{
					$('#municipality').removeClass('is-invalid');
				 }
				 if (!barangay){
					$('#barangay').addClass('is-invalid');
					isInvalid = true;
				 }
				 else{
					$('#barangay').removeClass('is-invalid');
				 }
				 if(!contact){
					$('#contact').addClass('is-invalid');
				 }
				 else if(varnumbers.test(contact) == false){
					Swal.fire({
					title: 'Warning',
					text: 'Contact can only contain numbers',
					icon: 'warning',
					confirmButtonColor: '#20d070' // Change the color value here
					});
					$('#contact').addClass('is-invalid');
					isInvalid = true;
				 }
				 else if(contact.length > 11){
					Swal.fire({
					title: 'Warning',
					text: 'Contact number exceeds to 11 digits',
					icon: 'warning',
					confirmButtonColor: '#20d070' // Change the color value here
					});
					$('#contact').addClass('is-invalid');
					isInvalid = true;
				 }
				 else{
					$('#contact').removeClass('is-invalid');
				 }
				 if (!donation_date){
					$('#donation_date').addClass('is-invalid');
				 }
				 else{
					$('#donation_date').removeClass('is-invalid');
				 }
				 if (!$('.selectCateg').is(':checked')) {
					Swal.fire({
					title: 'Warning',
					text: 'Please select a category',
					icon: 'warning',
					confirmButtonColor: '#20d070' // Change the color value here
					});
					$('#contact').addClass('is-invalid');
					isInvalid = true;
				  } 
				if (isInvalid) {
    				return false; // prevent form from submitting if any input is invalid
				}
				$.ajax({
					url: 'include/add.inc.php',
					method: 'POST',
					data: inputData,
					beforeSend:()=>{
						$('button[type="submit"]').prop('disabled', true);
						$('.submit-text').text('Saving...');
						$('.spinner-border').removeClass('d-none');

					},
					success:(data)=> {
						if (data==='success'){
							setTimeout(() => {
							// Enable the submit button and hide the loading animation
							$('button[type="submit"]').prop('disabled', false);
							$('.submit-text').text('Save');
							$('.spinner-border').addClass('d-none');
							Swal.fire({
								title: 'Success',
								text: "Data has been added",
								icon: 'success',
								confirmButtonColor: '#20d070',
								confirmButtonText: 'OK',
								allowOutsideClick: false
								})

							setTimeout(()=>{
								window.location.href = "donations.php?NewdataAdded";
							},1000)
							}, 500);
								}
						else{
							$('.submit-text').text('Save');
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
						// Handle errors
						$('.submit-text').text('Save');
						Swal.fire({
							title: 'Error',
							text: xhr.responseText,
							icon: 'error',
							confirmButtonColor: '#20d070',
							confirmButtonText: 'OK',
							allowOutsideClick: false
						})
					}

				})
				 
			})
		});
	</script>
	<script>
		$(document).ready(()=> {
			$('#region').on('change', function(){
				var regCode = $(this).val();
				if (regCode) {
					$.ajax({
						url: 'include/region.php',
						type: 'POST',
						data: 'regCode=' + regCode,
						success: function(data) {
							$('#province').html(data);
						}

					});
				} else {
					swal.fire('Warning', 'Select region', 'warning');
				}
			});
			$('#province').on('change', function(){
				var provCode = $(this).val();
				if (provCode) {
					$.ajax({
						url: 'include/region.php',
						type: 'POST',
						data: 'provCode=' + provCode,
						success: function(data) {
							$('#municipality').html(data);
						}

					});
				} else {
					swal.fire('Warning', 'Select province', 'warning');
				}
			});
			$('#municipality').on('change', function(){
				var citymunCode = $(this).val();
				if (citymunCode) {
					$.ajax({
						url: 'include/region.php',
						type: 'POST',
						data: 'citymunCode=' + citymunCode,
						success: function(data) {
							$('#barangay').html(data);
						}

					});
				} else {
					swal.fire('Warning', 'Select municipality', 'warning');
				}
			});

		});
	</script>
	<Script>
	let $nameItems = $('.name_items');

	function renderItem(ul, item) {
	return $("<li>")
		.append("<div>" + item.label + "</div>")
		.appendTo(ul);
	}

	$(document).on('focus', '.name_items', function(){
	$(this).autocomplete({
		source: function(request, response) {
		$.ajax({
			type: 'POST',
			url: 'include/viewid.php',
			dataType: 'json',
			data: {
			keyword: request.term
			},
			success: function(data) {
			response($.map(data, function(item) {
				return {
				label: item.product_name,
				value: item.product_name
				};
			}));
			}
		});
		},
		minLength: 1,
		select: function(event, ui) {
		$(this).val(ui.item.value);
		return false;
		},
		focus: function(event, ui) {
		$(this).val(ui.item.value);
		return false;
		}
	}).autocomplete("instance")._renderItem = renderItem;
	});

	</Script>




</body>

</html>