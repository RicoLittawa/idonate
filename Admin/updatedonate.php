<?php
session_start();
?>
 <?php
	 require_once "include/connection.php";
    if (isset($_GET["editdonate"]))
    {
       	$update_id= $_GET['editdonate'];
		$sql = "SELECT * FROM donation_items WHERE donor_id=?";
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("i", $update_id);
		$stmt->execute();
		$result = $stmt->get_result(); 
		$row = $result->fetch_assoc();
			$donorid= $row['donor_id'];
			$donorreference= $row['Reference'];
			$donorname= $row['donor_name'];
			$donorprovince= $row['donor_province'];
			$donorregion= $row['donor_region'];
			$donormunicipality= $row['donor_municipality'];
			$donorbarangay= $row['donor_barangay'];
			$donoremail= $row['donor_email'];
			$donordate= $row['donationDate'];
			$donorcontact= $row['donor_contact'];
			}
	function fill_category_select_box($conn)
  {
    $output= '';
    $sql= "SELECT * From category order by categ_id ASC";
    $result = mysqli_query($conn,$sql);
	    foreach($result as $row){
      $output .= '<option value="'.$row['categ_id'].'">'.$row['category'].'</option>';
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../Admin/css/donations.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

	<title>Update Donations</title>
</head>
<body>


	<!-- SIDEBAR -->	
	<section id="sidebar">
		<a href="#" class="brand">
			
			<span ><img class="img" src="img/logo.png" alt=""></span>
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
				<a href="request.php">
					<i class='bx bxs-envelope' ></i>
					<span class="text">Requests</span>
				</a>
			</li>
			<li>
				<a href="archive.php">
        			<i class='bx bxs-file-archive'></i>
					<span class="text">Records</span>
				</a>
			</li>
			<li>
				<a href="categorytables.php">
					<i class='bx bxs-package'></i>
					<span class="text">Stocks</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class='bx bxs-user-plus'></i>
					<span class="text">Users</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a class="settings" href="settings.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="include/logout.php" class="logout">
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
			<i style="font-size:40px;" class='bx bx-menu' ></i>
			<form action="#">
				
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
							<a href="adminpage.php" style="font-size: 18px;">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="donations.php" style="font-size: 18px;">Back</a>
						</li>
					</ul>
				</div>
				
				   
			</div>

			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Update Donations</h3>
						
						</div>
						<form action="" id="update-form">
							<div>
								<input type="hidden" name="donor_id" id="donor_id" value="<?php echo htmlentities($donorid);?>" readonly	>
								<input type="hidden" value="<?php echo htmlentities($donorreference);?>" name="reference_id" id="reference_id" readonly>
								<div class="form-group">
									<label for="fname">Fullname</label>
									<input class="form-control border-success" type="text" name="fname" id="fname" value="<?php echo htmlentities($donorname); ?>">
									</div>
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="region">Select Region</label>
											<select class="custom-select region border-success" name="region" id="region">
											<option value="-Select-">-Select-</option>
											<?php 
												$sql = "SELECT * FROM refregion";
												$result = mysqli_query($conn,$sql);
												foreach($result	 as $row):
												?>
											<option value="<?php echo htmlentities($row['regCode']);?>"
											<?php if($donorregion == $row['regCode']) {echo 'selected="selected"';}?>>
											<?php echo htmlentities($row['regDesc']);?></option>
											<?php endforeach;  ?>
											</select>
										</div>
									</div> 
									<div class="col">
										<div class="form-group">
										<label for="province">Select Province</label>
											<select class="custom-select province border-success" name="province" id="province">
											<option value="-Select-">-Select-</option>
											<?php 
												$province = "SELECT provCode, provDesc FROM refprovince where regCode=?";
												$stmt=$conn->prepare($province);
												$stmt->bind_param('s',$donorregion);
												$stmt->execute();
												$resultProv= $stmt->get_result();
												$data = $resultProv->fetch_all(MYSQLI_ASSOC);
												foreach($data as $row):
												?>
											<option value="<?php echo htmlentities($row['provCode']);?>"
											<?php if($donorprovince == $row['provCode']) {echo 'selected="selected"';}?>>
											<?php echo htmlentities($row['provDesc']);?></option>
											<?php endforeach;  ?>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
										<label for="municipality">Select Municipality</label>
											<select class="custom-select municipality border-success" name="municipality" id="municipality">
											<option value="-Select-">-Select-</option>
											<?php 
												$city = "SELECT citymunCode, citymunDesc FROM refcitymun where provCode=?";
												$stmt=$conn->prepare($city);
												$stmt->bind_param('s',$donorprovince);
												$stmt->execute();
												$resultProv= $stmt->get_result();
												$data = $resultProv->fetch_all(MYSQLI_ASSOC);
												foreach($data as $row):
												?>
											<option value="<?php echo htmlentities($row['citymunCode']);?>"
											<?php if($donormunicipality == $row['citymunCode']) {echo 'selected="selected"';}?>>
											<?php echo htmlentities($row['citymunDesc']);?></option>
											<?php endforeach;  ?>
											</select>
										</div>
									</div>
									</div>
								<div class="row">
								<div class="col">
										<div class="form-group">
										<label for="barangay">Select Barangay</label>
											<select class="custom-select barangay border-success" name="barangay" id="barangay">
											<option value="-Select-">-Select-</option>
											<?php 
												$brgy = "SELECT brgyCode, brgyDesc FROM refbrgy where citymunCode=?";
												$stmt=$conn->prepare($brgy);
												$stmt->bind_param('s',$donormunicipality);
												$stmt->execute();
												$resultProv= $stmt->get_result();
												$data = $resultProv->fetch_all(MYSQLI_ASSOC);
												foreach($data as $row):
												?>
											<option value="<?php echo htmlentities($row['brgyCode']);?>"
											<?php if($donorbarangay == $row['brgyCode']) {echo 'selected="selected"';}?>>
											<?php echo htmlentities($row['brgyDesc']);?></option>
											<?php endforeach;  ?>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label for="contact">Contact</label>
											<input class="form-control border-success" type="text" name="contact" id="contact" value="<?php echo htmlentities($donorcontact); ?>">
											</div>
										</div>
									</div>   
									<div class="form-group">
										<label for="email">Email</label>
										<input class="form-control border-success" type="text" name="email" id="email" value="<?php echo $donoremail; ?>">
									</div>
									<div class="form-group">
										<label for="donation_date">Donation Date</label>
										<input class="form-control border-success" type="date" name="donation_date" id="donation_date" value="<?php echo $donordate; ?>">
										</div>
									</div>
							<div class="row">
								<div class="col">
									<div class="form-group">
									<label class="form-group" style="font-weight: bold;">Donations</label>										</button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Product Name</th>
												<th>Type</th>
												<th>Unit</th>
												<th>Quantity</th>
											</tr>
										</thead>
										<tbody>
											<tr><?php 
												$sql = "SELECT * FROM donation_items10 WHERE Reference=?";
												$stmt = $conn->prepare($sql); 
												$stmt->bind_param("i", $donorreference);
												$stmt->execute();
												$result = $stmt->get_result();
												while ($row = $result->fetch_assoc()):
													
												?>
												<td><?php echo $row['productName'] ?></td>
												<td><?php echo $row['type'] ?></td>
												<td><?php echo $row['unit'] ?></td>
												<td><?php echo $row['quantity'] ?></td>
												
											</tr>
											<?php endwhile; ?>
											</tbody>
									</table>
								</div>
							</div>
						</form>					
			</div>
		</main>	
	</section>
	<script src="scripts/sidemenu.js"></script>
	<script src="scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>	
	<script>
		$(document).ready(function(){
	$('#update-form').append('<button  type="button" class="btn addDonate" id="testBtn">Save</button>');
	$('#update-form').append('<button type="button" class="btn  cancelBtn" id="cancelBtn">Cancel</button>');
	$('#testBtn').click(function(e){
		var valid = this.form.checkValidity();
        if(valid) { 
            e.preventDefault();
		var donor_id=$('#donor_id').val();
        var reference_id= $('#reference_id').val();
        var fname = $('#fname').val();
        var province = $('#province').val();
        var region = $('#region').val();
		var municipality = $('#municipality').val();
		var barangay = $('#barangay').val();
        var email = $('#email').val();
        var donation_date = $('#donation_date').val();
        var contact= $('#contact').val();
        var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var varnumbers = /^\d+$/;
        var inValid = /\s/;
		var data = {updateBtn: '',donor_id:donor_id,reference_id:reference_id,fname,province:province,region:region,municipality:municipality,barangay:barangay,contact:contact,
			email:email,donation_date:donation_date};
          if(fname==""){
              $('#fname').removeClass('border-success');
              $('#fname').addClass('border-danger');
              return false;
          }
          else if(region=="-Select-"){
              Swal.fire('Select', "Please select a region",'warning');
              return false;
          }
		  else if(province=="-Select-"){
              Swal.fire('Select', "Please select a province",'warning');
              return false;
          }
		  else if(municipality=="-Select-"){
              Swal.fire('Select', "Please select a municipality",'warning');
              return false;
          }
		  else if(barangay=="-Select-"){
              Swal.fire('Select', "Please select a barangay",'warning');
              return false;
          }
          else if(contact==""){
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
          }
          else if (inValid.test($('#contact').val())==true){
              Swal.fire('Contact', "Whitespace is prohibited.",'warning');
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
              return false;
            }
          else if(varnumbers.test($('#contact').val())==false) {
              Swal.fire('Number', "Numbers only.",'warning');
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
              return false;
            } 
          else if(contact.length !=11){
              Swal.fire('Contact', "Enter Valid Contact Number",'warning'); 
              $('#contact').removeClass('border-success');
              $('#contact').addClass('border-danger');
              return false;
            }
          else if(email==""){
              $('#email').removeClass('border-success');
              $('#email').addClass('border-danger');
              return false;
          }
          else if(emailVali.test($('#email').val())==false){
              Swal.fire('Email', "Invalid email address",'warning'); 
              $('#email').removeClass('border-success');
              $('#email').addClass('border-danger');
              return false;
          }
        
          else if(donation_date==""){

              $('#donation_date').removeClass('border-success');
              $('#donation_date').addClass('border-danger');
              return false;
          }
		
          else{
			$.ajax({
						url:'include/edit.inc.php',
						method:'POST',
						data: data,
						success:function(data){
				 		Swal.fire({
				 		icon: 'success',
				 		title: 'Success',
				 		text:data,
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
	$(document).ready(function(){
	 $('#region').on('change',function(){
		var regCode= $(this).val();
		if (regCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'regCode='+regCode,
				success: function (data){
					$('.province').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select region', 'warning');
		}
	 });
	 $('#province').on('change',function(){
		var provCode= $(this).val();
		if (provCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'provCode='+provCode,
				success: function (data){
					$('.municipality').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select Province', 'warning');
		}
	 });
	 $('#municipality').on('change',function(){
		var citymunCode= $(this).val();
		if (citymunCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'citymunCode='+citymunCode,
				success: function (data){
					$('.barangay').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select Province', 'warning');
		}
	 });
	
	});
</script>


</body>
</html>