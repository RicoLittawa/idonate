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

if(isset($_GET['requestId'])){
	$reference= $_GET['requestId'];
	$getRequest = "SELECT firstname,lastname,position,email,evacuees_qty,requestdate,status from request where request_id=?";
	$stmt=$conn->prepare($getRequest);
	$stmt->bind_param('i',$reference);
	$stmt->execute();
	$getResult= $stmt->get_result();
	$get= $getResult->fetch_assoc();
	$fname= $get['firstname'];
	$lname= $get['lastname'];
	$position= $get['position'];
	$requestemail= $get['email'];
	$evacuees_qty= $get['evacuees_qty'];
	$requestdate= $get['requestdate'];
	$dateTrimmed = str_replace('-', '', $requestdate);
	$status= $get['status'];

	
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
								<h4 class="text-muted">Request Details</h4>
							</div>
						</div>
						<div class="d-block p-3 ms-4 me-3">
							<div class="row">
								<div class="col">
									<span class="d-flex py-2"><h6>Reciept No:</h6><h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($dateTrimmed)."-00".htmlentities($reference) ?></h6></span>
								</div>
								<div class="col">
									<span class="d-flex justify-content-end py-2"><h6>Request Date:</h6><h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($requestdate) ?></h6></span>
								</div>
							</div>
							<hr class="hr" />
							<div class="row">
								<div class="col py-3">
									<span><h6>Fullname:</h6><h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($fname)." ".htmlentities($lname) ?></h6></span>
								</div>
								<div class="col py-3">
									<span><h6>Position</h6><h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($position)?></h6></span>
								</div>
							</div>
							<div class="row">
								<div class="col py-3">
									<span><h6>For (No. of Evacuees/Families):</h6><h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($evacuees_qty)?></h6></span>
								</div>
								<div class="col py-3">
									<span><h6>Email:</h6><h6 class="fw-light"> &nbsp&nbsp&nbsp<?php echo htmlentities($requestemail)?></h6></span>
								</div>
							</div>
							
							<span class="d-flex py-2"><h6>Status:</h6>&nbsp&nbsp&nbsp
							<?php if ($status!="pending"){ ?>
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
					<div class="row pe-4 ps-5 ms-4 mt-4">
						<div class="col">
							<?php 
								$reqCategory = "SELECT categoryName,quantity,notes from request_category where request_id=?";
								$stmt=$conn->prepare($reqCategory);
								$stmt->bind_param('i',$reference);
								$stmt->execute();
								$getCategory= $stmt->get_result();
								foreach($getCategory as $categ):
							?>
							<?php 
							$category= $categ['categoryName'];
							$quantity= $categ['quantity'];
							$notes= $categ['notes'];
							 ?>
							<?php 
							switch ($category):
								case "01":
									// Display notes if available
									if ($notes != null):?>
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
										<tbody id="cnBody">
											<tr>
												<td>
													<label for="cnProduct" class="form-label">Available Product</label>
														<select name="cnProduct" class="form-control cnProduct">
													</select>
												</td>
												<td>
													<label for="cnQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control cnQuantity">
												</td>
												<td><button type="button" id="addCn" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "02":	
									if ($notes != null):
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
										<tbody id="hyBody">
											<tr>	
												<td>
													<label for="hyProduct" class="form-label">Available Product</label>
														<select name="hyProduct"  class="form-control hyProduct">
													</select>
												</td>
												<td>
													<label for="hyProduct" class="form-label">Quantity</label>
													<input type="text" class="form-control hyQuantity"></td>
												<td><button type="button" id="addHy" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "03":	
									if ($notes != null): 
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
										<tbody id="iiBody">
											<tr>
												<td>
													<label for="iiProduct" class="form-label">Available Product</label>
														<select name="iiProduct"  class="form-control iiProduct">
													</select>
												</td>
												<td>
													<label for="iiQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control iiQuantity"></td>	
												<td><button type="button" id="addIi" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "04":	
									if ($notes != null):
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
										<tbody id="dwBody">
											<tr>	
												<td>
													<label for="dwProduct" class="form-label">Available Product</label>
														<select name="dwProduct"  class="form-control dwProduct">
													</select>
												</td>
												<td>
													<label for="dwProduct" class="form-label">Quantity</label>
													<input type="text" class="form-control dwQuantity"></td>
												<td><button type="button" id="addDw" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "05":	
									if ($notes != null):
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
										<tbody id="mgBody">
											<tr>	
												<td>
													<label for="mgProduct" class="form-label">Available Product</label>
														<select name="mgProduct"  class="form-control mgProduct">
													</select>
												</td>
												<td>
													<label for="mgQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control mgQuantity"></td>						
												<td><button type="button" id="addMg" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "06":	
									if ($notes != null):
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
										<tbody id="meBody">
											<tr>	
												<td>
													<label for="meProduct" class="form-label">Available Product</label>
														<select name="meProduct"  class="form-control meProduct">
													</select>
												</td>
												<td>
													<label for="meQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control meQuantity"></td>
												<td><button type="button" id="addMe" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>											
											</tr>
										</tbody>
									</table>
								<?php break;
								case "07":	
									if ($notes != null):
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
										<tbody id="otBody">
											<tr>	
												<td>
													<label for="otProduct" class="form-label">Available Product</label>
														<select name="otProduct"  class="form-control otProduct">
													</select>
												</td>
												<td>
													<label for="otQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control otQuantity"></td>
												<td><button type="button" id="addOt" class="btn btn-success btn-rounded"><i class="fa-solid fa-plus"></i></button></td>	
											</tr>
										</tbody>
									</table>
								<?php break; endswitch;?>
							<?php endforeach; $stmt->close(); $conn->close(); ?>
						</div>
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
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>
	<script src="scripts/main.js"></script>
	<!--Here is the scripts for functions -->

	<script>
		$(document).ready(() => {
    		let count = 0;

			//Get Can/Noodles
			const populateCanNoodles = (select) => {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
						select.empty();
						select.append("<option value=''>Select Product</option>");
						for (let i = 0; i < response.productCn.length; i++) {
							let product = response.productCn[i];
							let qty = response.quantityCn[i];
							let optionText = product + " (" + qty + " pcs)";
							if (qty == 0) {
								optionText += " - Out of stock";
							}
							let option = new Option(optionText, product);
							select.append(option);
						}
					}
				});
			}

			//Get Drinking water
			const populateDrinkingWater = (select) => {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
						select.empty();
						select.append("<option value=''>Select Product</option>");
						for (let i = 0; i < response.productDw; i++) {
							let product = response.productDw[i];
							let qty = response.quantityDw[i];
							let optionText = product + " (" + qty + " pcs)";
							if (qty == 0) {
								optionText += " - Out of stock";
							}
							let option = new Option(optionText, product);
							select.append(option);
						}
					}
				});
			}

			//Get Infant  Items
			const populateInfantItems = (select) => {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
						select.empty();
						select.append("<option value=''>Select Product</option>");
						for (let i = 0; i < response.productIi.length; i++) {
							let product = response.productIi[i];
							let qty = response.quantityIi[i];
							let optionText = product + " (" + qty + " pcs)";
							if (qty == 0) {
								optionText += " - Out of stock";
							}
							let option = new Option(optionText, product);
							select.append(option);
						}
					}
				});
			}
			//Get Hygine Essentials
			const populateHygineEssentials = (select) => {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
						select.empty();
						select.append("<option value=''>Select Product</option>");
						for (let i = 0; i < response.productHy.length; i++) {
							let product = response.productHy[i];
							let qty = response.quantityHy[i];
							let optionText = product + " (" + qty + " pcs)";
							if (qty == 0) {
								optionText += " - Out of stock";
							}
							let option = new Option(optionText, product);
							select.append(option);
						}
					}
				});
			}
			//Get Meat/Grains
			const populateMeatGrains = (select) => {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
						select.empty();
						select.append("<option value=''>Select Product</option>");
						for (let i = 0; i < response.productMg.length; i++) {
							let product = response.productMg[i];
							let qty = response.quantityMg[i];
							let unit = response.unitMg[i];
							let optionText = product + " (" + qty +" "+ unit+ ") ";
							if (qty == 0) {
								optionText += " - Out of stock";
							}
							let option = new Option(optionText, product);
							select.append(option);
						}
					}
				});
			}
			//Get Medicine
			const populateMedicine = (select) => {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
						select.empty();
						select.append("<option value=''>Select Product</option>");
						for (let i = 0; i < response.productMe.length; i++) {
							let product = response.productMe[i];
							let qty = response.quantityMe[i];
							let unit = response.unitMe[i];
							let optionText = product + " (" + qty +" "+ unit+ ")";
							if (qty == 0) {
								optionText += " - Out of stock";
							}
							let option = new Option(optionText, product);
							select.append(option);
						}
					}
				});
			}
			//Get Others
			const populateOthers = (select) => {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
						select.empty();
						select.append("<option value=''>Select Product</option>");
						for (let i = 0; i < response.productOt.length; i++) {
							let product = response.productOt[i];
							let qty = response.quantityOt[i];
							let unit = response.unitOt[i];
							let optionText = product + " (" + qty +" "+ unit+ ")";
							if (qty == 0) {
								optionText += " - Out of stock";
							}
							let option = new Option(optionText, product);
							select.append(option);
						}
					}
				});
			}
		//Function to add new table
		const appendNewProduct = (tableBody, buttontype) => {
			let html = "";
			let remove = "";
			if (buttontype === '01') {
				html += '<tr>';
				html += '<td><select name="cnProduct" class="form-control cnProduct"><option value="">Select Product</option></select></td>';
				html+= '<td><input type="text" class="form-control cnQuantity"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td>'
				tableBody.append(html);
				let select = tableBody.find('tr:last-child .cnProduct');
				populateCanNoodles(select);
			}
			else if (buttontype === '02') {
				html += '<tr>';
				html += '<td><select name="hyProduct" class="form-control hyProduct"><option value="">Select Product</option></select></td>';
				html+= '<td><input type="text" class="form-control hyQuantity"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td>'
				tableBody.append(html);
				let select = tableBody.find('tr:last-child .hyProduct');
				populateHygineEssentials(select);
			}
			else if (buttontype === '03') {
				html += '<tr>';
				html += '<td><select name="iiProduct" class="form-control iiProduct"><option value="">Select Product</option></select></td>';
				html+= '<td><input type="text" class="form-control iiQuantity"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td>'
				tableBody.append(html);
				let select = tableBody.find('tr:last-child .iiProduct');
				populateInfantItems(select);
			}
			else if (buttontype === '04') {
				html += '<tr>';
				html += '<td><select name="dwProduct" class="form-control dwProduct"><option value="">Select Product</option></select></td>';
				html+= '<td><input type="text" class="form-control dwQuantity"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td>'
				tableBody.append(html);
				let select = tableBody.find('tr:last-child .dwProduct');
				populateDrinkingWater(select);
			}
			else if (buttontype === '05') {
				html += '<tr>';
				html += '<td><select name="mgProduct" class="form-control mgProduct"><option value="">Select Product</option></select></td>';
				html+= '<td><input type="text" class="form-control mgQuantity"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td>'
				tableBody.append(html);
				let select = tableBody.find('tr:last-child .mgProduct');
				populateMeatGrains(select);
			}
			else if (buttontype === '06') {
				html += '<tr>';
				html += '<td><select name="meProduct" class="form-control meProduct"><option value="">Select Product</option></select></td>';
				html+= '<td><input type="text" class="form-control meQuantity"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td>'
				tableBody.append(html);
				let select = tableBody.find('tr:last-child .meProduct');
				populateMedicine(select);
			}
			else if (buttontype === '07') {
				html += '<tr>';
				html += '<td><select name="otProduct" class="form-control otProduct"><option value="">Select Product</option></select></td>';
				html+= '<td><input type="text" class="form-control otQuantity"></td>';
				if (count > 0) {
					remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
				}
				html += '<td>' + remove + '</td>'
				tableBody.append(html);
				let select = tableBody.find('tr:last-child .otProduct');
				populateOthers(select);
			}
		}
		//Remove added table row
		$(document).on('click', '.remove', function() {
			$(this).closest('tr').remove();
		})
		//Append new Table
		$('#addCn').click( () => {
			count++;
			let tableBody = $('#cnBody');
			appendNewProduct(tableBody, '01');
		});

		$('#addHy').click(() => {
			count++;
			let tableBody = $('#hyBody');
			appendNewProduct(tableBody, '02');
		});
		$('#addIi').click(() => {
			count++;
			let tableBody = $('#iiBody');
			appendNewProduct(tableBody, '03');
		});

		$('#addDw').click(() => {
			count++;
			let tableBody = $('#dwBody');
			appendNewProduct(tableBody, '04')
		});
		$('#addMg').click(() => {
			count++;
			let tableBody = $('#mgBody');
			appendNewProduct(tableBody, '05')
		});
		$('#addMe').click(() => {
			count++;
			let tableBody = $('#meBody');
			appendNewProduct(tableBody, '06')
		});
		$('#addOt').click(() => {
			count++;
			let tableBody = $('#otBody');
			appendNewProduct(tableBody, '07')
		});


		// Populate product options for existing select elements
		$('.cnProduct').each(function() {
			populateCanNoodles($(this));
		});
		$('.hyProduct').each(function() {
			populateHygineEssentials($(this));
		});
		$('.iiProduct').each(function() {
			populateInfantItems($(this));
		});
		$('.dwProduct').each(function() {
			populateDrinkingWater($(this));
		});
		$('.mgProduct').each(function() {
			populateMeatGrains($(this));
		});
		$('.meProduct').each(function() {
			populateMedicine($(this));
		});
		$('.otProduct').each(function() {
			populateOthers($(this));
		});

		//Get data to each category field
		
		$(document).submit('#addToProcess',(e)=>{
			e.preventDefault();
			let categoryFields={
			'CanNoodles':{
				'pn':[],
				'q':[]
				},
			'Hygine':{
				'pn':[],
				'q':[]
				},
			'Infant':{
				'pn':[],
				'q':[]
				},
			'Drinks':{
				'pn':[],
				'q':[]
				},
			'MeatGrain':{
				'pn':[],
				'q':[]
				},
			'Medicine':{
				'pn':[],
				'q':[]
				},
			'Others':{
				'pn':[],
				'q':[]
				}
			}
			 let isInvalid = false;
			//Push value of elements to objects array
			$('.cnProduct').each((index,element)=>{
				categoryFields.CanNoodles.pn.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.cnQuantity').each((index,element)=>{
				categoryFields.CanNoodles.q.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.hyProduct').each((index,element)=>{
				categoryFields.Hygine.pn.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.hyQuantity').each((index,element)=>{
				categoryFields.Hygine.q.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.iiProduct').each((index,element)=>{
				categoryFields.Infant.pn.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.iiQuantity').each((index,element)=>{
				categoryFields.Infant.q.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.dwProduct').each((index,element)=>{
				categoryFields.Drinks.pn.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.dwQuantity').each((index,element)=>{
				categoryFields.Drinks.q.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.mgProduct').each((index,element)=>{
				categoryFields.MeatGrain.pn.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.mgQuantity').each((index,element)=>{
				categoryFields.MeatGrain.q.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.meProduct').each((index,element)=>{
				categoryFields.Medicine.pn.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
				
			});
			$('.meQuantity').each((index,element)=>{
				categoryFields.Medicine.q.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.otProduct').each((index,element)=>{
				categoryFields.Others.pn.push($(element).val());
				 if($(element).val()==""){
				 	$(element).addClass('is-invalid');
				 	isInvalid=true;
				 }else{
				 	$(element).removeClass('is-invalid');
				 }
			});
			$('.otQuantity').each((index,element)=>{
				categoryFields.Others.q.push($(element).val());
				if($(element).val()==""){
					$(element).addClass('is-invalid');
					isInvalid=true;
				}else{
					$(element).removeClass('is-invalid');

				}
			});
			let request_id= $('#request_id').val();


			//save to data
			let data = {
				submitProcess:"",
				request_id:request_id,
				CanNoodlesPn:categoryFields.CanNoodles.pn,
				CanNoodlesQ:categoryFields.CanNoodles.q,
				HyginePn:categoryFields.Hygine.pn,
				HygineQ:categoryFields.Hygine.q,
				InfantPn:categoryFields.Infant.pn,
				InfantQ:categoryFields.Infant.q,
				DrinkingWaterPn:categoryFields.Drinks.pn,
				DrinkingWaterQ:categoryFields.Drinks.q,
				MeatGrainsPn:categoryFields.MeatGrain.pn,
				MeatGrainsQ:categoryFields.MeatGrain.q,
				MedicinePn:categoryFields.Medicine.pn,
				MedicineQ:categoryFields.Medicine.q,
				OthersPn:categoryFields.Others.pn,
				OthersQ:categoryFields.Others.q,
				
			}
			
		
		const checkProductsIfExist = (categoryFields) => {
				
				for (const category in categoryFields) {
				if (categoryFields[category].pn.length > 0) {
				$.ajax({
					url: 'include/getproduct.php',
					method: 'GET',
					dataType: 'json',
					success: (response) => {
					switch (category) {
						case 'CanNoodles':
							const commonCanNoodles = categoryFields[category].pn.map(pnValue => {
							const index = response.productCn.indexOf(pnValue);
							return response.quantityCn[index];
							});
							for (let i = 0; i < categoryFields[category].q.length; i++) {
								$('.cnQuantity').each(function(i) {
								if (+categoryFields[category].q[i] > +commonCanNoodles[i]) {
									swal.fire({
										title:'Warning',
										html:`<h5>We only have <strong>${commonCanNoodles[i]}</strong> available <strong>${categoryFields[category].pn[i]}</strong> </h5>`,
										icon: 'warning',
										confirmButtonColor: '#20d070' //
									});
									$(this).addClass('is-invalid');
									isInvalid = true;
								}
								});	
							}
						break;
						case 'Hygine':
							const commonHygine = categoryFields[category].pn.map(pnValue => {
							const index = response.productHy.indexOf(pnValue);
							return response.quantityHy[index];
							});
							for (let i = 0; i < categoryFields[category].q.length; i++) {
								$('.hyQuantity').each(function(i) {
									if (+categoryFields[category].q[i] > +commonHygine[i]) {
										swal.fire({
										title:'Warning',
										html:`<h5>We only have <strong>${commonHygine[i]}</strong> available <strong>${categoryFields[category].pn[i]}</strong> </h5>`,
										icon: 'warning',
										confirmButtonColor: '#20d070' //
									});
										$(this).addClass('is-invalid');
										isInvalid = true;
									}
								});						
							}
						break;
						case 'Infant':
							const commonInfant = categoryFields[category].pn.map(pnValue => {
							const index = response.productIi.indexOf(pnValue);
							return response.quantityIi[index];
							});
							for (let i = 0; i < categoryFields[category].q.length; i++) {
								$('.iiQuantity').each(function(i) {
									if (+categoryFields[category].q[i] > +commonInfant[i]) {
										swal.fire({
										title:'Warning',
										html:`<h5>We only have <strong>${commonInfant[i]}</strong> available <strong>${categoryFields[category].pn[i]}</strong> </h5>`,
										icon: 'warning',
										confirmButtonColor: '#20d070' //
									});
										$(this).addClass('is-invalid');
										isInvalid = true;
									}
								});						
							}
						break;
						 case 'Drinks':
							const commonDrinks = categoryFields[category].pn.map(pnValue => {
							const index = response.productDw.indexOf(pnValue);
							return response.quantityDw[index];
							});
							for (let i = 0; i < categoryFields[category].q.length; i++) {
								$('.dwQuantity').each(function(i) {
								if (+categoryFields[category].q[i] > +commonDrinks[i]) {
									swal.fire({
										title:'Warning',
										html:`<h5>We only have <strong>${commonDrinks[i]}</strong> available <strong>${categoryFields[category].pn[i]}</strong> </h5>`,
										icon: 'warning',
										confirmButtonColor: '#20d070' //
									});
									$(this).addClass('is-invalid');
									isInvalid = true;
								}
								});							
							};
						 break;
						 case 'MeatGrain':
							const commonMeatGrains = categoryFields[category].pn.map(pnValue => {
							const index = response.productMg.indexOf(pnValue);
							return response.quantityMg[index];
							});
							for (let i = 0; i < categoryFields[category].q.length; i++) {
								$('.mgQuantity').each(function(i) {
								if (+categoryFields[category].q[i] > +commonMeatGrains[i]) {
									swal.fire({
										title:'Warning',
										html:`<h5>We only have <strong>${commonMeatGrains[i]}</strong> available <strong>${categoryFields[category].pn[i]}</strong> </h5>`,
										icon: 'warning',
										confirmButtonColor: '#20d070' //
									});
									$(this).addClass('is-invalid');
									isInvalid = true;
								}
								});							
							};
						 break;
						 case 'Medicine':
							const commonMedicine = categoryFields[category].pn.map(pnValue => {
							const index = response.productMe.indexOf(pnValue);
							return response.quantityMe[index];
							});
							for (let i = 0; i < categoryFields[category].q.length; i++) {
								$('.meQuantity').each(function(i) {
								if (+categoryFields[category].q[i] > +commonMedicine[i]) {
									swal.fire({
										title:'Warning',
										html:`<h5>We only have <strong>${commonMedicine[i]}</strong> available <strong>${categoryFields[category].pn[i]}</strong> </h5>`,
										icon: 'warning',
										confirmButtonColor: '#20d070' //
									});
									$(this).addClass('is-invalid');
									isInvalid = true;
								}
								});							
							};
						 break;
						 case 'Others':
							const commonOthers = categoryFields[category].pn.map(pnValue => {
							const index = response.productOt.indexOf(pnValue);
							return response.quantityOt[index];
							});
							for (let i = 0; i < categoryFields[category].q.length; i++) {
								$('.otQuantity').each(function(i) {
								if (+categoryFields[category].q[i] > +commonOthers[i]) {
									swal.fire({
										title:'Warning',
										html:`<h5>We only have <strong>${commonOthers[i]}</strong> available <strong>${categoryFields[category].pn[i]}</strong> </h5>`,
										icon: 'warning',
										confirmButtonColor: '#20d070' //
									});
									$(this).addClass('is-invalid');
									isInvalid = true;
								}
								});							
							};
						 break;
						 
						}
					},
					error: () => {
					console.log('Failed to get products data.');
					}
				});
				}
			}
		
	return;
			setTimeout(()=>{
				if(!isInvalid){
					$.ajax({
						url: 'include/ProcessRequest.php',
						method: 'POST',
						data: data,
						
						success: (data) => {
							if(data=="success"){

							}
						},
						error: () => {
							console.log('Failed to save data to the database.');
						}
					});
				}
			},1000)

			};

			checkProductsIfExist(categoryFields);
		})
		// End of button
});

		
	</script>




</body>

</html>