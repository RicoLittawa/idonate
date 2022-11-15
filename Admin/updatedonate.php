<?php
session_start();
?>
 <?php
	 include "include/connection.php";
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
			$donorstreet= $row['donor_street'];
			$donorregion= $row['donor_region'];
			$donoremail= $row['donor_email'];
			$donordate= $row['donationDate'];
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
  
  function fill_variant_select_box($conn){
    $output= '';
    $sql= "SELECT * From variant order by variant_id ASC";
    $result = mysqli_query($conn,$sql);
    foreach($result as $row){
      $output .= '<option value="'.$row['variant_id'].'">'.$row['variant'].'</option>';
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
				<a href="#">
        <i class='bx bxs-file-archive'></i>
					<span class="text">Archive</span>
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
					<input type="text" placeholder="Search..." name="search" >
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
							<a href="#" style="font-size: 18px;">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#" style="font-size: 18px;">Home</a>
						</li>
					</ul>
				</div>
				
				   
			</div>

			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Update Donations</h3>
						<button type="button" name="btn_additem" class="btn btn-success" id="btn_additem"><i class="fa-sharp fa-solid fa-plus"></i> 
                          </button>
						</div>
						<form action="" id="update-form">
							<div>
								<input type="text" name="donor_id" name="donor_id" value="<?php echo $donorid;?>">
								<input type="text" value="<?php echo $donorreference;?>" name="reference_id" id="reference_id">
								<div class="form-group">
									<label for="fname">Fullname</label>
									<input class="form-control" type="text" name="fname" id="fname" value="<?php echo $donorname; ?>">
									</div>
								<div class="row">
  								<div class="col">
								<div class="form-group">
									<label for="province">Province</label>
									<input class="form-control" type="text" name="province" id="province"value="<?php echo $donorprovince; ?>">
									</div>
									</div>
								<div class="col">
								<div class="form-group">
									<label for="street">Street</label>
									<input class="form-control" type="text" name="street" id="street" value="<?php echo $donorstreet; ?>">
									</div>
									</div>
									</div>
								<div class="form-group">
									<label for="region">Select Region</label>
									
									<select class="custom-select region" name="region" id="region">
									
									<option>-Choose Region-</option>
									<?php 
										$sql = "SELECT * FROM regions";
										$result = mysqli_query($conn,$sql);
										foreach($result	 as $row):
										?>
									<option value="<?php echo $row['region_id'];?>"
										<?php if($donorregion == $row['region_id']) {echo 'selected="selected"';}?>>
									<?php echo $row['region_name'];?></option>
									<?php endforeach;  ?>
									</select>
									
									</div>    
								<div class="form-group">
									<label for="email">Email</label>
									<input class="form-control" type="text" name="email" id="email" value="<?php echo $donoremail; ?>">
									</div>
								<div class="form-group">
									<label for="donation_date">Donation Date</label>
									<input class="form-control" type="date" name="donation_date" id="donation_date" value="<?php echo $donordate; ?>">
									</div>
							</div>
							
							<label class="form-group" style="font-weight: bold;">Donation Types & Quantity</label>
								<?php 
								$sql1="SELECT * from donation_items10 where Reference= $donorreference";
								$result1=mysqli_query($conn,$sql1);
								$counter=1;
								foreach($result1 as $row1):
									$categM= $row1['category'];
									$variantM= $row1['variant'];
									$quantity= $row1['quantity'];
								?>
							<div id="prevItem">
								<div class="item">
							<div class="row">
							<div class="col">
							<div class="form-group">
								<label for="category">Select Category</label>
								<select  class="custom-select category" name="category" id="category">
								<option>-Choose Category-</option>
									<?php
										$sql2= "SELECT * from category";
										$result2= mysqli_query($conn,$sql2);
										foreach ($result2 as $row2): 				
									?>
								<option value="<?php echo $row2['categ_id']; ?>"<?php if($categM == $row2['categ_id']) {echo 'selected="selected"';}?>>
								<?php echo $row2['category'];?></option>
									<?php endforeach;?>
								</select>
								</div>	
								</div>
							<div class="col">
							<div class="form-group">	
								<label for="category">Select Variant</label>		
								<select  class="custom-select variant" name="variant" id="variant">
								<option>-Choose Category-</option>
									<?php
										$sql3= "SELECT * from variant";
										$result3= mysqli_query($conn,$sql3);
										foreach ($result3 as $row3): 				
									?>
								<option value="<?php echo $row3['variant_id']; ?>"<?php if($variantM == $row3['variant_id']) {echo 'selected="selected"';}?>>
								<?php echo $row3['variant'];?></option>
									<?php endforeach;?>
								</select>
								</div>
								</div>
							<div class="col">
							<div class="form-group">
								<label for="quantity">Quantity</label>
								<input class="form-control quantity" type="text" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
								</div>
								</div>
								</div>
								</div>	
								</div>
								<?php  $counter++; endforeach;?>
								
						</form>	
			</div>
		</main>	
	</section>
	<script src="../Admin/scripts/sidemenu.js"></script>
	<script src="../Admin/scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="../donors/js/sweetalert2.all.min.js"></script>	
	<script>
		$(document).ready(function(){
			var count =0;
			function add_input_field(count){
				$('#testBtn').remove();
				var html='';
				
				html+='<div>'
				html+= '<div class="row"><div class="col"><div class="form-group"><select class="custom-select category" name="category" id="category"><option value="">Choose Category</option><?php echo fill_category_select_box($conn); ?></select></div></div>';
				html += '<div class="col"><div class="form-group"><select class="custom-select variant" name="variant" id="variant"><option value="">Choose Variant</option><?php echo fill_variant_select_box($conn); ?></select></div></div>';
				html += '<div class="col"><div class="form-group"><input class="form-control quantity" type="text" name="quantity" id="quantity"></div></div></div>';
				
				var remove_button='';
				if(count>0)
				{
					remove_button='<button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
				}
				html+='<span>'+remove_button+'</span></div>';
				return html;
				}	
			//button remove for previousdata
			$('#update-form').append('<button  type="button" style="float: right;" class="btn btn-success addDonate" id="testBtn">Save</button>');
			$('.item').append('<button type="button" name="prevremove" id="prevremove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>');	
			$(document).on('click','#btn_additem',function(){
				count++;
				$('#update-form').append(add_input_field(count))
				$('#update-form').append('<button type="button" style="float: right;" class="btn btn-success addDonate" id="testBtn">Save</button>');
					$('#testBtn').click(function(e){
						e.preventDefault();
						var variant_arr=[];
						var quantity_arr=[];
						var category_arr=[];
						var region_arr=[];
						var category = $('.category');
						var variant = $('.variant');
						var quantity = $('.quantity');
						

						for (var i = 0;i<category.length;i++){
							category_arr.push($(category[i]).val());
							variant_arr.push($(variant[i]).val());
							quantity_arr.push($(quantity[i]).val());
							
						}
						var donor_id= $('#donor_id').val();
						var reference_id= $('#reference_id').val();
						var fname = $('#fname').val();
						var province = $('#province').val();
						var street = $('#street').val();
						var region = $('#region').val();
						var email = $('#email').val();
						var donation_date = $('#donation_date').val();

						var data = {updateBtn: '',donor_id:donor_id,reference_id:reference_id,fname,province:province,street:street,region:region,email:email,donation_date:donation_date,category_arr:category_arr,variant_arr:variant_arr,quantity_arr:quantity_arr}
						console.log(data);
		// 				$.ajax({
		// 	url:'include/edit.inc.php',
		// 	method:'POST',
		// 	data: data,
		// 	success:function(data){
		// 		alert (data);
		// 	}

		// });
						
					});
					});
			$(document).on('click','#remove', function(){
				$(this).closest('div').remove();
				});
			//remove previous data
			$(document).on('click','#prevremove', function(){
				$(this).closest('div').remove();
				});
				$('#testBtn').click(function(e){
						e.preventDefault();
						var variant_arr=[];
						var quantity_arr=[];
						var category_arr=[];
						var category = $('.category');
						var variant = $('.variant');
						var quantity = $('.quantity');
						for (var i = 0;i<category.length;i++){
							category_arr.push($(category[i]).val());
							variant_arr.push($(variant[i]).val());
							quantity_arr.push($(quantity[i]).val());		
						}
						var donorid=$('#donor_id').val();
						var reference_id= $('#reference_id').val();
						var fname = $('#fname').val();
						var province = $('#province').val();
						var street = $('#street').val();
						var region= $('#region').val();
						var email = $('#email').val();
						var donation_date = $('#donation_date').val();
						

						var data = {saveBtn: '',donorid:donorid,reference_id:reference_id,fname,province:province,street:street,region:region,email:email,donation_date:donation_date,category_arr:category_arr,variant_arr:variant_arr,quantity_arr:quantity_arr}
					
					});


					
		});
	</script>

</body>
</html>