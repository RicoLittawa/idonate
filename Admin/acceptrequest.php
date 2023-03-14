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

if(isset($_GET['acceptRequest'])){
	$reference= $_GET['acceptRequest'];
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
					<div class="d-flex justify-content-end">
						<button class="btn btn-success">Print</button>
					</div>
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
									// Fetch data for Can/Noodles category
									$query = "SELECT productName, SUM(quantity) as totalQuantity FROM categcannoodles GROUP BY productName";
									$stmt = $conn->prepare($query);
									$stmt->execute();
									$result = $stmt->get_result();
									
									// Display notes if available
									if ($notes != null):?>
										<div class="form-outline mb-3">
											<textarea class="form-control" id="textAreaExample" rows="2" readonly><?php echo htmlentities($notes) ?></textarea>
											<label class="form-label" for="textAreaExample">For Can/Noodles</label>
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
														<option value="">Select Product</option>
														<?php foreach ($result as $row): ?>
														<option value=""><?php echo htmlentities($row['productName'])." (".htmlentities($row['totalQuantity']).") pcs" ?></option>
														<?php endforeach; ?>
													</select>
												</td>
												<td>
													<label for="cnQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control cnQuantity">
												</td>
												<td><button type="button" id="addCn" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "02":	
									$hygineEssential= "SELECT productName,sum(quantity) as totalQuantity from categhygineessential GROUP BY productName";
									$stmt= $conn->prepare($hygineEssential);
									$stmt->execute();
									$hyResult= $stmt->get_result();
								?>
									<?php if ($notes != null): ?>
										<div class="form-outline mb-3">
											<textarea class="form-control" id="textAreaExample" rows="2" readonly><?php echo htmlentities($notes) ?></textarea>
											<label class="form-label" for="textAreaExample">For Drinking Water</label>
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
										<tbody id="hyBody">
											<tr>	
												<td>
													<label for="hyProduct" class="form-label">Available Product</label>
													<select name="hyProduct"  class="form-control hyProduct">
													<option value="">Select Product</option>
													<?php foreach ($hyResult as $hy): ?>
													<option value=""><?php echo htmlentities($hy['productName'])." (".htmlentities($hy['totalQuantity']).") pcs" ?></option>
													<?php endforeach; ?>
													</select>
												</td>
												<td>
													<label for="dhyProduct" class="form-label">Quantity</label>
													<input type="text" class="form-control dhyQuantity"></td>
												<td><button type="button" id="adddhY" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "03":	
									$infantItems= "SELECT productName,sum(quantity) as totalQuantity from categinfant   GROUP BY productName";
									$stmt= $conn->prepare($infantItems);
									$stmt->execute();
									$iiResult= $stmt->get_result();

									if ($notes != null): 
									?>	
									<div class="form-outline mb-3">
										<textarea class="form-control" id="textAreaExample" rows="2" readonly><?php echo htmlentities($notes) ?></textarea>
										<label class="form-label" for="textAreaExample">For Infant Items</label>
									</div>
									<?php endif; ?>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Infant Items</th>
												<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<label for="iiProduct" class="form-label">Available Product</label>
													<select name="iiProduct"  class="form-control iiProduct">
													<option value="">Select Product</option>
													<?php foreach ($iiResult as $ii): ?>
													<option value=""><?php echo htmlentities($ii['productName'])." (".htmlentities($ii['totalQuantity']).") pcs" ?></option>
													<?php endforeach; ?>
													</select>
												</td>
												<td>
													<label for="iiQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control iiQuantity"></td>	
												<td><button type="button" id="addIi" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "04":	
									$drinkingWater= "SELECT productName,sum(quantity) as totalQuantity from categdrinkingwater   GROUP BY productName";
									$stmt= $conn->prepare($drinkingWater);
									$stmt->execute();
									$dwResult= $stmt->get_result();

									if ($notes != null):
								?>
									<div class="form-outline mb-3">
										<textarea class="form-control" id="textAreaExample" rows="2" readonly><?php echo htmlentities($notes) ?></textarea>
										<label class="form-label" for="textAreaExample">For Drinking Water</label>
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
													<option value="">Select Product</option>
													<?php foreach ($dwResult as $dw): ?>
													<option value=""><?php echo htmlentities($dw['productName'])." (".htmlentities($dw['totalQuantity']).") pcs" ?></option>
													<?php endforeach; ?>
													</select>
												</td>
												<td>
													<label for="dwProduct" class="form-label">Quantity</label>
													<input type="text" class="form-control dwQuantity"></td>
												<td><button type="button" id="addDw" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "05":	
									$meatGrains= "SELECT productName,sum(quantity) as totalQuantity from categmeatgrains  GROUP BY productName";
									$stmt= $conn->prepare($meatGrains);
									$stmt->execute();
									$mgResult= $stmt->get_result();

									if ($notes != null):
							?>	
									<div class="form-outline mb-3">
										<textarea class="form-control" id="textAreaExample" rows="2" readonly><?php echo htmlentities($notes) ?></textarea>
										<label class="form-label" for="textAreaExample">For Meat/Grains</label>
									</div>
									<?php endif; ?>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Meat/Grains</th>
												<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
											</tr>
										</thead>
										<tbody>
											<tr>	
												<td>
													<label for="mgProduct" class="form-label">Available Product</label>
													<select name="mgProduct"  class="form-control mgProduct">
													<option value="">Select Product</option>
													<?php foreach ($mgResult as $mg): ?>
													<option value=""><?php echo htmlentities($mg['productName'])." (".htmlentities($mg['totalQuantity']).") pcs" ?></option>
													<?php endforeach; ?>
													</select>
												</td>
												<td>
													<label for="mgQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control mgQuantity"></td>						
												<td><button type="button" id="addMg" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
											</tr>
										</tbody>
									</table>
								<?php break;
								case "06":	
									$medicine= "SELECT productName,sum(quantity) as totalQuantity from categmedicine   GROUP BY productName";
									$stmt= $conn->prepare($medicine);
									$stmt->execute();
									$meResult= $stmt->get_result();
									if ($notes != null):
								?>
									<div class="form-outline mb-3">
										<textarea class="form-control" id="textAreaExample" rows="2" readonly><?php echo htmlentities($notes) ?></textarea>
										<label class="form-label" for="textAreaExample">For Medicine</label>
									</div>
									<?php endif; ?>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Medicine</th>
												<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
											</tr>
										</thead>
										<tbody>
											<tr>	
												<td>
													<label for="meProduct" class="form-label">Available Product</label>
													<select name="meProduct"  class="form-control meProduct">
													<option value="">Select Product</option>
													<?php foreach ($meResult as $me): ?>
													<option value=""><?php echo htmlentities($me['productName'])." (".htmlentities($me['totalQuantity']).") pcs" ?></option>
													<?php endforeach; ?>
													</select>
												</td>
												<td>
													<label for="meQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control meQuantity"></td>
												<td><button type="button" id="addMe" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>											
											</tr>
										</tbody>
									</table>
								<?php break;
								case "07":	
									$others= "SELECT productName,sum(quantity) as totalQuantity from categothers   GROUP BY productName";
									$stmt= $conn->prepare($others);
									$stmt->execute();
									$otResult= $stmt->get_result();
									if ($notes != null):
								?>
									<div class="form-outline mb-3">
										<textarea class="form-control" id="textAreaExample" rows="2" readonly><?php echo htmlentities($notes) ?></textarea>
										<label class="form-label" for="textAreaExample">For Others</label>
									</div>
									<?php endif; ?>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Others</th>
												<th>EST QTY (<?php echo htmlentities($quantity) ?>)</th>
											</tr>
										</thead>
										<tbody>
											<tr>	
												<td>
													<label for="otProduct" class="form-label">Available Product</label>
													<select name="otProduct"  class="form-control otProduct">
													<option value="">Select Product</option>
													<?php foreach ($otResult as $ot): ?>
													<option value=""><?php echo htmlentities($ot['productName'])." (".htmlentities($ot['totalQuantity']).") pcs" ?></option>
													<?php endforeach; ?>
													</select>
												</td>
												<td>
													<label for="otQuantity" class="form-label">Quantity</label>
													<input type="text" class="form-control otQuantity"></td>
												<td><button type="button" id="addOt" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>	
											</tr>
										</tbody>
									</table>
								<?php break; endswitch;?>
							<?php endforeach; $stmt->close(); $conn->close(); ?>
						</div>
					</div>
					<div class="d-flex justify-content-end mt-3">
						<div class="me-3">
							<button type="button" class="btn btn-danger cancelBtn" id="cancelBtn">Cancel</button>
						</div>
						<div>
							<button type="button" class="btn btn-success addDonate" id="addToProcess">
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
		$(document).ready(()=>{
			let count=0;
			const appendNewProduct=(buttontype)=>{
				let html= "";
				let remove ="";
				
				
			}
			$(document).on('click', '.remove',function(){
				$(this).closest('tr').remove();
			})
			$('#addCn').click(()=>{
				count++;
				$('#cnBody').append(appendNewProduct('01'));
			});
			$('#addHy').click(()=>{
				count++;
				$('#hyBody').append(appendNewProduct('02'));
			});
			
		
			$('#addDw').click(()=>{
				count++;
				$('#dwBody').append(appendNewProduct('04'))
			});
		
		
		})
		
	</script>




</body>

</html>