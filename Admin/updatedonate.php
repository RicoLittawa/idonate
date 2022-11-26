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
			$donorstreet= $row['donor_street'];
			$donorregion= $row['donor_region'];
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
				<a href="archive.php">
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
											<label for="province">Province</label>
											<input class="form-control border-success" type="text" name="province" id="province"value="<?php echo htmlentities($donorprovince); ?>">
										</div>
									</div>
									<div class="col">
									<div class="form-group">
										<label for="street">Street</label>
										<input class="form-control border-success" type="text" name="street" id="street" value="<?php echo htmlentities($donorstreet); ?>">
											</div>
										</div>
									</div>
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="region">Select Region</label>
											<select class="custom-select region border-success" name="region" id="region">
											<option value="-Select-">-Select-</option>
											<?php 
												$sql = "SELECT * FROM regions";
												$result = mysqli_query($conn,$sql);
												foreach($result	 as $row):
												?>
											<option value="<?php echo htmlentities($row['region_id']);?>"
											<?php if($donorregion == $row['region_id']) {echo 'selected="selected"';}?>>
											<?php echo htmlentities($row['region_name']);?></option>
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
									<label class="form-group" style="font-weight: bold;">Donation Types & Quantity</label>
									<button style="float: right;" type="button" name="btn_additem" class="btn" id="btn_additem"><i style="color: green;font-size:40px;" class="fa-sharp fa-solid fa-plus"></i> 
										</button>
									</div>
								</div>
							</div>
								<?php 
								$sql1="SELECT * from donation_items10 where Reference= $donorreference";
								$result1=mysqli_query($conn,$sql1);
							
								foreach($result1 as $row1):
									$categM= $row1['category'];
									$variantM= $row1['variant'];
									$quantity= $row1['quantity'];
									$reference= $row1['Reference'];
									$item_names= $row1['name_items'];
									$noPerItems= $row1['Items'];
									
								?>
								
							<div id="prevItem">
								<div class="item">
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="category">Select Category</label>
												<select  class="custom-select border-success category" name="category" id="category">
												<option value="-Select-">-Select-</option>
												<?php
													$sql2= "SELECT * from category";
													$result2= mysqli_query($conn,$sql2);
													foreach ($result2 as $row2): 		
																
												?>
									
												<option value="<?php echo htmlentities($row2['categ_id']); ?>"<?php if($categM == $row2['categ_id']) {echo 'selected="selected"';}?>>
												<?php echo htmlentities($row2['category']);?></option>
												
												
													<?php endforeach; ?>
										
													</select>
							
													</div>	
												</div>
											<div class="col">
												<div class="form-group">
													<label>Name of items</label>
													<textarea class="form-control border-success name_items" id="name_items" name="name_items" rows="2" cols="50" ><?php echo htmlentities($item_names); ?></textarea>
														</div>
													</div>
												</div>
										<div class="row">
											<div class="col">
												<div class="form-group">	
													<label for="variant">Select Variant</label>		
													<select  class="custom-select border-success variant" name="variant" id="variant">
													<option value="-Select-">-Select-</option>
													<?php
														$sql3= "SELECT * from variant";
														$result3= mysqli_query($conn,$sql3);
														foreach ($result3 as $row3): 				
													?>
													<option value="<?php echo htmlentities($row3['variant_id']); ?>"<?php if($variantM == $row3['variant_id']) {echo 'selected="selected"';}?>>
													<?php echo htmlentities($row3['variant']);?></option>
														<?php endforeach;?>
													</select>
														</div>
													</div>
												<div class="col">
													<div class="form-group">
														<label for="quantity">Quantity</label>
														<input class="form-control border-success quantity" type="text" name="quantity" id="quantity" value="<?php echo htmlentities($quantity); ?>">
															</div>
														</div>
													</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="">No. of items</label>
														<input class="form-control border-success noPerItems" name="noPerItems" id="noPerItems" type="text" value="<?php echo htmlentities($noPerItems);?>">
													</div>
												</div>

											</div>
												</div>	
											</div>
										<?php endforeach;?>
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
			var count =0;
			function add_input_field(count){
				$('#testBtn').remove();
				$('#cancelBtn').remove();
				var html='';
				
				html+='<div>'
				html+= '<div class="row"><div class="col"><div class="form-group"><label for="category">Select Category</label><select class="custom-select category border-success" name="category" id="category"><option value="-Select-">-Select-</option><?php echo fill_category_select_box($conn); ?></select></div></div>';
	  html+= '<div class="col"><div class="form-group"><label>Name of items</label><textarea class="form-control border-success name_items" id="name_items" name="name_items" rows="2" cols="50"></textarea></div></div></div>'
      html += '<div class="row"><div class="col"><div class="form-group"><label for="variant">Select Variant</label><select class="custom-select variant border-success" name="variant" id="variant"><option value="-Select-">-Select-</option><?php echo fill_variant_select_box($conn); ?></select></div></div>';
      html += '<div class="col"><div class="form-group"><label for="quantity">Quantity</label><input class="form-control quantity border-success" type="text" name="quantity" id="quantity"></div></div></div>';
	  html+='<div class="row"><div class="col"><div class="form-group"><label>Number of Items</label><input class="form-control border-success noPerItems" id="noPerItems" name="noPerItems" ></div></div></div>';
				
				
				var remove_button='';
				if(count>0)
				{
					remove_button='<button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
				}
				html+='<span>'+remove_button+'</span></div>';
				return html;
				}	
			
			
			$('#update-form').append('<button  type="button" class="btn addDonate" id="testBtn">Save</button>');
			$('#update-form').append('<button type="button" class="btn  cancelBtn" id="cancelBtn">Cancel</button>');
			//button remove for previousdata
			$('.item').append('<button type="button" name="prevremove" id="prevremove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>');	
			$(document).on('click','#btn_additem',function(e){
				e.preventDefault();
				count++;
				$('#update-form').append(add_input_field(count))
				$('#update-form').append('<button type="button" class="btn addDonate" id="testBtn">Save</button>');
				$('#update-form').append('<button type="button" class="btn  cancelBtn" id="cancelBtn">Cancel</button>');
					$('#testBtn').click(function(e){
						var valid = this.form.checkValidity();
						if(valid) {	
							e.preventDefault();
						var variant_arr=[];
						var quantity_arr=[];
						var category_arr=[];
						var items_arr=[];
						var itemName_arr=[];
						var totalItem=[];
						var category = $('.category');
						var variant = $('.variant');
						var quantity = $('.quantity');
						var name_items = $('.name_items');
						var noPerItems = $('.noPerItems');
					
						for (var i = 0;i<category.length;i++){
							category_arr.push($(category[i]).val());
							variant_arr.push($(variant[i]).val());
							quantity_arr.push($(quantity[i]).val());
							itemName_arr.push($(name_items[i]).val());
							items_arr.push($(noPerItems[i]).val());
							totalItem.push($(quantity[i]).val() * $(noPerItems[i]).val());	
						}
						var donor_id= $('#donor_id').val();
						var reference_id= $('#reference_id').val();
						var fname = $('#fname').val();
						var province = $('#province').val();
						var street = $('#street').val();
						var region = $('#region').val();
						var email = $('#email').val();
						var contact= $('#contact').val();
						var donation_date = $('#donation_date').val();
				
						var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
       					var varnumbers = /^\d+$/;
        				var inValid = /\s/;
		 if(fname==""){
		 	$('#fname').removeClass('border-success');
             $('#fname').addClass('border-danger');
             return false;
		 }
		 if(province==""){
		 	$('#province').removeClass('border-success');
             $('#province').addClass('border-danger');
             return false;
		 }
		 else if(street==""){
		 	$('#street').removeClass('border-success');
             $('#street').addClass('border-danger');
             return false;
		 }
		 else if(region==""){
		 	Swal.fire('Fields', "Please select a region",'warning');
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
             Swal.fire('Contact', "Numbers only.",'warning');
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
		 	for (var j=0;j<category.length;j++)
		 	{
				if ($(category[j]).val()=="-Select-"){
		 		Swal.fire('Fields', "Please select a category",'warning');
		 		return false;
		 	}
			 else if ($(name_items[j]).val()==""){
		 		Swal.fire('Fields', "Item name is empty",'warning');
		 		return false;
		 	}
		 	else if ($(variant[j]).val()=="-Select-"){
		 		Swal.fire('Fields', "Please select a variant",'warning');
		 		return false;
		 	}
		 	else if ($(quantity[j]).val()==""){
		 		Swal.fire('Fields', "Quantity is empty",'warning');
		 		return false;
		 	}
		 	else if (inValid.test($(quantity[j]).val())==true){	
		 		Swal.fire('Quantity', "Whitespace is prohibited.",'warning');
		 		return false;
		 	}
		 	
			else if(varnumbers.test($(noPerItems[j]).val())=="") {
		 		Swal.fire('Number', "Number of item is empty",'warning');
		 		return false;
						
		 	  }
			   else if (inValid.test($(noPerItems[j]).val())==true){	
		 		Swal.fire('Items', "Whitespace is prohibited.",'warning');
		 		return false;
		 	}
			 else if(varnumbers.test($(noPerItems[j]).val())==false) {
		 		Swal.fire('Items', "Numbers only.",'warning');
		 		return false;
						
		 	  }
		 	}
			 var data = {updateBtn: '' ,donor_id:donor_id,reference_id:reference_id,fname,province:province,street:street,region:region,email:email,contact:contact,donation_date:donation_date,category_arr:category_arr,
			variant_arr:variant_arr,quantity_arr:quantity_arr,itemName_arr:itemName_arr,items_arr:items_arr,totalItem:totalItem};
		
		$.ajax({
						url:'include/edit.inc.php',
						method:'POST',
						data: data,
						success:function(data){
							
							if(data == 'Data-updated') {
							Swal.fire({
						icon: 'success',
						title: 'Success',
						text:data,
						}).then(function() {
							window.location = "donations.php";
						});
				}	
		 	}

		 });
		 }
		
		
	}			
					});
	$('#fname').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	$('#street').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	$('#province').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  $('#contact').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	$('#email').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	$('#donation_date').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  //cancel button
	  $('#cancelBtn').click(function(){
		Swal.fire({
			icon: 'question',
			title: 'Go back to main page?',
			}).then(function() {
			window.location = "donations.php";
			});
	  });
	});
	$(document).on('click','#remove', function(){
		$(this).closest('div').remove();
	});
			//remove previous data
	$(document).on('click','#prevremove', function(){
	$(this).closest('div').remove();
	});

	//single
	$('#testBtn').click(function(e){
		var valid = this.form.checkValidity();
						if(valid) {	
							e.preventDefault();
						var variant_arr=[];
						var quantity_arr=[];
						var category_arr=[];
						var items_arr=[];
						var itemName_arr=[];
						var totalItem=[];
						var category = $('.category');
						var variant = $('.variant');
						var quantity = $('.quantity');
						var name_items = $('.name_items');
						var noPerItems = $('.noPerItems');
					
						for (var i = 0;i<category.length;i++){
							category_arr.push($(category[i]).val());
							variant_arr.push($(variant[i]).val());
							quantity_arr.push($(quantity[i]).val());
							itemName_arr.push($(name_items[i]).val());
							items_arr.push($(noPerItems[i]).val());
							totalItem.push($(quantity[i]).val() * $(noPerItems[i]).val());	
						}
						var donor_id= $('#donor_id').val();
						var reference_id= $('#reference_id').val();
						var fname = $('#fname').val();
						var province = $('#province').val();
						var street = $('#street').val();
						var region = $('#region').val();
						var email = $('#email').val();
						var contact= $('#contact').val();
						var donation_date = $('#donation_date').val();
				
						var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
       					var varnumbers = /^\d+$/;
        				var inValid = /\s/;
		 if(fname==""){
		 	$('#fname').removeClass('border-success');
             $('#fname').addClass('border-danger');
             return false;
		 }
		 if(province==""){
		 	$('#province').removeClass('border-success');
             $('#province').addClass('border-danger');
             return false;
		 }
		 else if(street==""){
		 	$('#street').removeClass('border-success');
             $('#street').addClass('border-danger');
             return false;
		 }
		 else if(region==""){
		 	Swal.fire('Fields', "Please select a region",'warning');
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
             Swal.fire('Contact', "Numbers only.",'warning');
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
		 	for (var j=0;j<category.length;j++)
		 	{
				if ($(category[j]).val()=="-Select-"){
		 		Swal.fire('Fields', "Please select a category",'warning');
		 		return false;
		 	}
			 else if ($(name_items[j]).val()==""){
		 		Swal.fire('Fields', "Item name is empty",'warning');
		 		return false;
		 	}
		 	else if ($(variant[j]).val()=="-Select-"){
		 		Swal.fire('Fields', "Please select a variant",'warning');
		 		return false;
		 	}
		 	else if ($(quantity[j]).val()==""){
		 		Swal.fire('Fields', "Quantity is empty",'warning');
		 		return false;
		 	}
		 	else if (inValid.test($(quantity[j]).val())==true){	
		 		Swal.fire('Quantity', "Whitespace is prohibited.",'warning');
		 		return false;
		 	}
		 	
			else if(varnumbers.test($(noPerItems[j]).val())=="") {
		 		Swal.fire('Number', "Number of item is empty",'warning');
		 		return false;
						
		 	  }
			   else if (inValid.test($(noPerItems[j]).val())==true){	
		 		Swal.fire('Items', "Whitespace is prohibited.",'warning');
		 		return false;
		 	}
			 else if(varnumbers.test($(noPerItems[j]).val())==false) {
		 		Swal.fire('Items', "Numbers only.",'warning');
		 		return false;
						
		 	  }
		 	}
			 var data = {updateBtn: '' ,donor_id:donor_id,reference_id:reference_id,fname,province:province,street:street,region:region,email:email,contact:contact,donation_date:donation_date,category_arr:category_arr,
			variant_arr:variant_arr,quantity_arr:quantity_arr,itemName_arr:itemName_arr,items_arr:items_arr,totalItem:totalItem};
		
		$.ajax({
						url:'include/edit.inc.php',
						method:'POST',
						data: data,
						success:function(data){
							
							if(data == 'Data-updated') {
							Swal.fire({
						icon: 'success',
						title: 'Success',
						text:data,
						}).then(function() {
							window.location = "donations.php";
						});
				}	
		 	}

		 });
		 }
		
		
	}
						
    });
	$('#fname').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  $('#street').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  $('#province').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  $('#contact').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  $('#email').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  $('#donation_date').on('keyup', function() {
        if($(this).val() == '') {
          $(this).removeClass('border-success');
          $(this).addClass('border-danger');
        } else {
          $(this).addClass('border-success');
          $(this).removeClass('border-danger');
        }
      });
	  //cancel button
	  $('#cancelBtn').click(function(){
		Swal.fire({
			icon: 'question',
			title: 'Go back to main page?',
			}).then(function() {
			window.location = "donations.php";
			});
	  });
					
		});
	</script>

</body>
</html>