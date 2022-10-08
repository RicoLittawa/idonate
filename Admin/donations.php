<?php
session_start();

	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../Admin/css/donations.css">

	<title>Donations</title>
</head>
<body>


	<!-- SIDEBAR -->	
	<section id="sidebar">
		<a href="#" class="brand">
			
			<span ><img class="img" src="/Admin/img/logo.png" alt=""></span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="adminpage.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="#">
					<i class='bx bxs-box' ></i>
					<span class="text">Donations</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-envelope' ></i>
					<span class="text">Requests</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-chat' ></i>
					<span class="text">Announcement</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="/Admin/login/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>Good Day
			<a href="#" class="profile"><span> <?php echo $_SESSION['name']; ?></span></a>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Donations</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
	
					<span><button class="btn btn-success adddata" type="submit"><i class="fa-solid fa-plus"></i> Add donations</button></span>
				</a>
			</div>
			<div class="modal fade" id="addform">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Donations</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
     
		
		<div class="modal-body">
		<form action="../Admin/include/add.inc.php" class="validate-form" method="POST">
			
	  					<input type="hidden" name="update_id">
	  					<div class="form-group validate-input" data-validate = "Fullname is required">
							<input class="form-control" type="text" name="fname" id="Ufullname" placeholder="Full name">
						</div>
						<div class="form-group validate-input" data-validate = "Address is required">
							<input class="form-control" type="text" name="address" id="Uaddress" placeholder="Address">
						</div>
						<div class="form-group validate-input" data-validate = "Valid email is required: ex@abc.xyz">
							<input class="form-control" type="text" name="email" id="Uemail"  placeholder="Email">
						</div>
						<div class="form-group validate-input" data-validate = "Date is required">
							<input class="form-control" type="date" name="donation_date" id="Udonation_date" placeholder="Date">
						</div>
						<div class="form-group validate-input" data-validate = "Please select to the given options">
								<label for="items">Select:</label>
								<select class="form-control"  name="category" id="Ucategory" class="required">
								<option value="">Choose...</option>
								<option value="food">Food</option>
								<option value="clothes">Clothes</option>
								<option value="beverages">Beverages</option>
								<option value="others">Others</option>
								</select>
						</div>
						<div class="form-group validate-input" data-validate = "Please select to the given options">
							<label for="quanti">Select:</label>
								<select class="form-control"  name="variant" id="Uvariant" class="required">
								<option value="">Choose...</option>
								<option value="Per Box">Per Box</option>
								<option value="Pieces">Pieces</option>
								<option value="Others">Others</option>
								</select>
						</div>
						<div class="form-group validate-input" data-validate = "Product name is required">
							<input class="form-control" type="text" id="UproductName" name="productName"placeholder="Product Name">
						</div>
						<div class="form-group validate-input" data-validate = "This field is required">
							<input class="form-control" type="number" id="Uquantity" name="quantity" placeholder="Quantity">
						</div>     
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" name="submit-donations" class="btn btn-primary submitBtn">Save</button>
      </div>
	  </form>	

    </div>
  </div>
</div>
			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Donations</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
					</div>
					<table class="table">
					
    <thead>
      <tr>
	  	<th>ID</th>
        <th>Fullname</th>
        <th>Address</th>
        <th>Email</th>
		<th>Donation Date</th>
		<th>Category</th>
		<th>Unit</th>
		<th>Product Name</th>
		<th>Quantity</th>
		<th>Operations</th>
		<th>Certificate</th>
      </tr>
    </thead>
    <tbody>
      <?php
	   require ("../Admin/include/connection.php");
	    
	  $sql = "SELECT *FROM items ";
	  $result = mysqli_query($conn,$sql);
		while($row= mysqli_fetch_assoc($result)){
			?>
			<tr>
				<td> <?php echo $row['id']; ?></td>
				<td> <?php echo $row['fullname']; ?></td>
				<td> <?php echo $row['address']; ?></td>
				<td> <?php echo $row['email']; ?></td>
				<td> <?php echo $row['donationDate']; ?></td>
				<td> <?php echo $row['category']; ?></td>
				<td> <?php echo $row['variant']; ?></td>
				<td> <?php echo $row['productName']; ?></td>
				<td> <?php echo $row['quantity']; ?></td>
				<td><a  class="btnDel" href="../admin/operations/delete.php?deleteid=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash " style="color: red;"></i>
				</a>
				<button type="button" class="btn update"><i class="fa-solid fa-pen-to-square" style="color: green;"></i></button>
					</td>

				<td><button class="btn btn-success" type="submit">Send Certificate</button></td>			
			</tr>
			<?php
	  }
	  ?>  
	  
    </tbody>
	
  </table>
  <div class="modal fade" id="updateform">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update/Edit</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
	  <form action="../Admin/operations/update.php?" method="POST">
		<div class="modal-body">
	  					<input type="hidden" name="update_id" id="update_id">
	  					<div class="form-group" data-validate = "Fullname is required">
							<input class="form-control" type="text" name="fname" id="fname" placeholder="Full name" >
						</div>
						<div class="form-group" data-validate = "Address is required">
							<input class="form-control" type="text" name="address" id="address" placeholder="Address">
						</div>
						<div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
							<input class="form-control" type="text" name="email" id="email" placeholder="Email">
						</div>
						<div class="form-group" data-validate = "Please select to the given options">
								<label for="items">Select:</label>
								<select class="form-control" id="category" name="category" class="required">
								<option value="">Choose...</option>
								<option value="food">Food</option>
								<option value="clothes">Clothes</option>
								<option value="beverages">Beverages</option>
								<option class="editable" value="others">Others</option>
								</select>
								<input class="editOption" style="display:none;"></input>
						</div>
						<div class="form-group" data-validate = "Please select to the given options">
							<label for="quanti">Select:</label>
								<select class="form-control" id="variant" name="variant" class="required">
								<option value="">Choose...</option>
								<option value="Per Box">Per Box</option>
								<option value="Pieces">Pieces</option>
								<option class="editable" value="Others">Others</option>
								</select>
						</div>
						<div class="form-group" data-validate = "Product name is required">
							<input class="form-control" type="text" name="productName" id="productName" placeholder="Product Name">
						</div>
						<div class="form-group" data-validate = "This field is required">
							<input class="form-control" type="text" name="quantity" id="quantity" placeholder="Quantity">
						</div>

       
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="delete btn btn-danger" data-dismiss="modal">Close</button>
		<button type="submit" name="updatedata" id="updatedata" class="btn btn-primary updatedata">Save</button>
      </div>
	  
	  </form>	

    </div>
  </div>
</div>
<!-- End of modal-->
  			
			</div>
		</main>
	
	</section>
	
	

	<script src="../Admin/scripts/landing.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>
	<script src="../Admin/scripts/validation.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



	<script>
		$(document).ready(function(){
			$('.update').on('click',function(){
				$('#updateform').modal('show');
				$tr = $(this).closest('tr');
				var data = $tr.children("td").map(function(){
					return $.trim($(this).text());
				}).get();
				var numData = $tr.children("td").map(function () { return parseInt($(this).text()); }).get();			
			
				$('#update_id').val(data[0]);
				$('#fname').val(data[1]);
				$('#address').val(data[2]);
				$('#email').val(data[3]);
				$('#donation_date').val(data[4]);
				$( "#category" ).find( "option:selected" ).val();     	
				$( "#variant" ).find( "option:selected" ).val();     			 
				$('#productName').val(data[7]);
				$('#quantity').val(numData[8]);
				
			});

		});
	</script>
	<script>
		$(document).ready(function(){
			$('.adddata').on('click',function(){
				$('#addform').modal('show');

			});
		});
		
	</script>
	<script>
		$('.btnDel').on('click',function(e){
			e.preventDefault();
			const href=$(this).attr('href');
						Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				if (result.value) {
					document.location.href=href;
				}
				})
		})			

	</script>


		
		<?php
		
	if (isset($_SESSION['status']) && $_SESSION['status']!='')
	{?>
	<script>
		swal({  
  		title: " Confirm?",  
 		 text: "<?php echo $_SESSION['status']; ?>",  
 		 type: "<?php echo $_SESSION['status_code']; ?>",  
 		 showCancelButton: true,  
		confirmButtonClass: "btn-danger",  
		confirmButtonText: " Confirm, remove it!",  
		closeOnConfirm: false  
		},  
		function(){  
		swal("remove it!", "Imaginary file remove it.", "Confirm");  
		})
		
	</script>
	<script>
			Swal.fire({
			icon: '<?php echo $_SESSION['status_code']; ?>',
			title: '<?php echo $_SESSION['status']; ?>',
			button:"ok, done",
			})
	</script>
	
	<?php
		unset($_SESSION['status']);
	}
	?>



</body>
</html>