<?php include 'include/protect.php' ;
require_once 'include/connection.php';

$sql= "SELECT firstname,profile FROM adduser WHERE uID=? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('i',$_SESSION['uID']);
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
function fill_category_select_box($conn)
{
	$output = '';
	$sql = "SELECT * From category order by categ_id ASC";
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row) {
		$categCode = htmlentities($row['categCode']);
		$categname = htmlentities($row["category"]);
		$output .= '<option value="' . $categCode . '">' . $categname . '</option>';
	}
	return $output;
}
function fill_variant_box($conn)
{
	$output = '';
	$sql = "SELECT * From variant order by variantCode ASC";
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row) {
		$variantCode = htmlentities($row['variantCode']);
		$variantName = htmlentities($row["variant"]);
		$output .= '<option value="' . $variantCode . '">' . $variantName . '</option>';
	}
	return $output;
}


function fill_region_select_box($conn)
{
	$output = '';
	$sql = "SELECT * FROM refregion";
	$result = mysqli_query($conn, $sql);
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
    <h1 class="fs-1 breadcrumb-title">Add Donations</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="" class="text-reset bc-path">Home</a>
        <span>/</span>
        <a href="" class="text-reset bc-path active">Add Donations</a>
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
											<option value="-Select-">--</option>
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
									<h6 style="font-size:20px;"><span>Donation Type and Category</span></h6>
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
											<td><button type="button" class="btn btn-success addCN" id="addCN"><i class="fa-solid fa-plus"></i></button></td>
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
											<td><button type="button" class="btn btn-success addHY" id="addHY"><i class="fa-solid fa-plus"></i></button></td>
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
											<td><button type="button" class="btn btn-success addII" id="addII"><i class="fa-solid fa-plus"></i></button></td>
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
											<td><button type="button" class="btn btn-success addDW" id="addDW"><i class="fa-solid fa-plus"></i></button></td>
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
											<td><button type="button" class="btn btn-success addMG" id="addMG"><i class="fa-solid fa-plus"></i></button></td>
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
											<td><button type="button" class="btn btn-success addME" id="addME"><i class="fa-solid fa-plus"></i></button></td>
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
											<td><button type="button" class="btn btn-success addOT" id="addOT"><i class="fa-solid fa-plus"></i></button></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<button type="submit" style="float:right; height:50px;width:100px;" class="btn btn-success waves-effect waves-light" id="saveD">Save</button>
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
		$(document).ready(function() {

			let count= 0;
			//function to identify each button and add dynamic row to table
			const addRowButton=(buttonType)=> {
				let html = '';
				let remove = '';
			if (buttonType === 'buttonCN') {
				html += '<tr><td><input type="text" class="form-control name_items pnCN" id="pnCN"></td><td><input type="number" class="form-control qCN" id="qCN"></td>';
				if (count > 0) {
					remove = '<button type="button" name="removeCN"  class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			}
			else if (buttonType === 'buttonHY') {
				html += '<tr><td><input type="text" class="form-control name_items pnHY" id="pnHY"></td><td><input type="number" class="form-control qHY" id="qHY"></td>';
				if (count > 0) {
					remove += '<button type="button" name="removeHY"  class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			} 
			else if (buttonType=== 'buttonII'){
				html+= '<tr><td><input type="text" class="form-control name_items pnII" id="pnII"></td><td><input type="number" class="form-control qII" id="qII"></td>';
				if (count > 0) {
					remove = '<button type="button" name="removeII" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>'
				}
				html+= '<td>' + remove + '</td></tr>';
				return html;
			}
			else if (buttonType=== 'buttonDW'){
				html += '<tr><td><input type="text" class="form-control name_items pnDW" id="pnDW"></td><td><input type="number" class="form-control qDW" id="qDW"></td>';
				if (count > 0) {
					remove = '<button type="button" name="removeDW" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>'
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
					remove = '<button type="button" name="removeMG" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>'
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
					remove = '<button type="button" name="removeME" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>'
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
					remove = '<button type="button" name="removeOT" id="removeTbOt" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>'
				}
				html += '<td>' + remove + '</td></tr>';
				return html;
			}
			}
			//remove row on specific table
			$(document).on('focus', '.remove',function(){
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
		 let ref_id = $('#reference_id').val();
		 let fname = $('#fname').val();
		 let region = $('#region').val();
		 let province = $('#province').val();
		 let municipality = $('#municipality').val();
		 let barangay = $('#barangay').val();
		 let contact = $('#contact').val();
		 let email = $('#email').val();
		 let donation_date = $('#donation_date').val();
		 let emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		 let varnumbers = /^\d+$/;
		 let inValid = /\s/;
		 let name_items = $('.name_items').val();
		 	//data object pass to ajax
		 		let data = {
		 			saveBtn: '',
		 			result: result,
		 			ref_id: ref_id,
		 			fname: fname,
		 			region: region,
		 			province: province,
		 			municipality: municipality,
		 			barangay: barangay,
		 			contact: contact,
		 			email: email,
		 			donation_date: donation_date,
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
		 		//Variables for checking the empty input fields of checked checkbox
		 		let cnProductName,cnQuantity,hyProductName,hyQuantity,iiProductName,iiQuantity,dwProductName,dwQuantity,
		 		mgProductName,mgQuantity,mgType,mgUnit,meProductName,meQuantity,meType,meUnit,otProductName,otQuantity,otType,otUnit;

				/**If the box is check it will get the data of each input field then pass it
				to the variable then check it if value of that input field is empty
				  * */
				 if ($('#box1').is(':checked')) {
				 	$('.pnCN').each(function() {
						cnProductName= $(this).val();
						inputFields.CN.pn.push($(this).val()); 	 	
				 	})
				 	 $('.qCN').each(function() {
						cnQuantity= $(this).val();
						inputFields.CN.q.push($(this).val());
				 	 })
				 }
				 if ($('#box2').is(':checked')) {
				 	$('.pnHY').each(function() {
						hyProductName= $(this).val();
						inputFields.HY.pn.push($(this).val());
				 	})
				 	$('.qHY').each(function() {
						hyQuantity= $(this).val();
						inputFields.HY.q.push($(this).val());
				 	})
				 }
				 if ($('#box3').is(':checked')) {
				 	$('.pnII').each(function() {
						iiProductName= $(this).val();
						inputFields.II.pn.push($(this).val());
				 	})
				 	$('.qII').each(function() {
						iiQuantity= $(this).val();
						inputFields.II.q.push($(this).val());
				 	})
				 }
				 if ($('#box4').is(':checked')) { 
				 	$('.pnDW').each(function() {
						dwProductName= $(this).val();
						inputFields.DW.pn.push($(this).val());
				 	})
				 	$('.qDW').each(function() {
						dwQuantity= $(this).val();
						inputFields.DW.q.push($(this).val());
				 	})
				 }
				 if ($('#box5').is(':checked')) {
				 	$('.pnMG').each(function() {
						mgProductName= $(this).val();
						inputFields.MG.pn.push($(this).val());
				 	})
				 	$('.typeMG').each(function() {
						mgType= $(this).val();
						inputFields.MG.type.push($(this).val());
				 	})
				 	$('.qMG').each(function() {
						mgQuantity=$(this).val();
						inputFields.MG.q.push($(this).val());
				 	})
				 	$('.unitMG').each(function() {
						mgUnit=$(this).val();
						inputFields.MG.unit.push($(this).val());
				 	})
				 }
				 if ($('#box6').is(':checked')) {
				 	$('.pnME').each(function() {
						meProductName=$(this).val();
						inputFields.ME.pn.push($(this).val());
				 	})
				 	$('.typeME').each(function() {
						meType=$(this).val();
						inputFields.ME.type.push($(this).val());
				 	})
				 	$('.qME').each(function() {
						meQuantity=$(this).val();
						inputFields.ME.q.push($(this).val());
				 	})
				 	$('.unitME').each(function() {
						meUnit=$(this).val();
						inputFields.ME.unit.push($(this).val());
				 	})
				 }
				 if ($('#box7').is(':checked')) {
				 	$('.pnOT').each(function() {
						otProductName=$(this).val();
						inputFields.OT.pn.push($(this).val());
				 	})
				 	$('.typeOT').each(function() {
						otType=$(this).val();
						inputFields.OT.type.push($(this).val());
				 	})
				 	$('.qOT').each(function() {
						otQuantity=$(this).val();
						inputFields.OT.q.push($(this).val());
				 	})
				 	$('.unitOT').each(function() {
						otUnit=$(this).val();
						inputFields.OT.unit.push($(this).val());
				 	})
				 }

				// Validate the whole form
				 if (fname == "") {
				 	Swal.fire('Field', "Please input your fullname", 'warning');
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
				 	Swal.fire('Field', "Please input your contact", 'warning');
				 	return false;
				 } else if (inValid.test($('#contact').val()) == true) {
				 	Swal.fire('Contact', "Whitespace is prohibited.", 'warning');
				 	return false;
				 } else if (varnumbers.test($('#contact').val()) == false) {
				 	Swal.fire('Number', "Numbers only.", 'warning');
				 	return false;
				 } else if (contact.length != 11) {
				 	Swal.fire('Contact', "Enter Valid Contact Number", 'warning');
				 	return false;
				 } else if (email == "") {
				 	Swal.fire('Field', "Please input your email", 'warning');
				 	return false;
				 } else if (emailVali.test($('#email').val()) == false) {
				 	Swal.fire('Email', "Invalid email address", 'warning');
				 	return false;
				 } else if (donation_date == "") {
				 	Swal.fire('Select', "Please select date", 'warning');
				 	return false;
				 } else if (!$('.selectCateg').is(':checked')) {
				 	Swal.fire('Category', "Please select a category", 'warning')
				 }else if (cnProductName =='' || cnQuantity== '') {
				 	Swal.fire('Warning', 'Can & Noodles are empty', 'warning');
				 	return false;
				 } else if (hyProductName ==''|| hyQuantity== '') {
				 	Swal.fire('Warning', 'Hygine Essentials are empty', 'warning');
				 	return false;
				 } else if (iiProductName== ''||iiQuantity== '') {
				 	Swal.fire('Warning', 'Infant Items are empty', 'warning');;
				 	return false;
				 } else if (dwProductName== ''||dwQuantity== '') {
				 	Swal.fire('Warning', 'Drinking Waters are empty', 'warning');
				 	return false;
				 } else if (mgProductName== ''||mgType== ''||mgQuantity== ''||mgUnit== '') {
				 	Swal.fire('Warning', 'Meat & Grains are empty', 'warning');
				 	return false;
				 } else if (meProductName== ''||meType== ''||meQuantity== ''||meUnit== '') {
				 	Swal.fire('Warning', 'Medicines are empty', 'warning');
				 	return false;
				 } else if (otProductName== ''||otType== ''||otQuantity== ''||otUnit== '') {
				 	Swal.fire('Warning', 'Others are empty', 'warning');
				 	return false;
				 } else {
				 	$.ajax({
				 		url: 'include/add.inc.php',
				 		method: 'POST',
				 		data: data,
				 		success:(data)=> {
				 			  Swal.fire({
				 			  	title: 'Success',
				 			  	text: "Successfully Added",
				 			  	icon: 'success',
				 			  	confirmButtonColor: '#3085d6',
				 			  	confirmButtonText: 'OK',
				 			  	allowOutsideClick: false
				 			  }).then((result) => {
				 			  	if (result.isConfirmed) {
				 			  		window.location.href = "donations.php?inserted";
				 			  	}
				 			  })
				 		},
						 error: (jqXHR, textStatus, errorThrown) =>{
							Swal.fire('Error', jqXHR.responseText, 'warning');
						}

				 	})
				 }
			})
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
							$('#province').html(data);
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
							$('#municipality').html(data);
						}

					});
				} else {
					swal.fire('Warning', 'Select province', 'warning');
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
	$(document).on('focus', '.name_items', function() {
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
	}).autocomplete("instance")._renderItem = function(ul, item) {
		return $("<li>")
		.append("<div>" + item.label + "</div>")
		.appendTo(ul);
	};
	});
	</Script>




</body>

</html>