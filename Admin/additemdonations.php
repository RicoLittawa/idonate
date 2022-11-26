<?php
session_start();

	?>
  <?php 
  include '../Admin/include/connection.php';
  function fill_category_select_box($conn)
  {
    $output= '';
    $sql= "SELECT * From category order by categ_id ASC";
    $result = mysqli_query($conn,$sql);
	    foreach($result as $row){
			$categid= htmlentities($row['categ_id']);
			$categname= htmlentities($row["category"]);
      $output .= '<option value="'.$categid.'">'.$categname.'</option>';
    }
    return $output;
  }
  
  function fill_variant_select_box($conn){
    $output= '';
    $sql= "SELECT * From variant order by variant_id ASC";
    $result = mysqli_query($conn,$sql);
    foreach($result as $row){
		$varid= htmlentities($row['variant_id']);
		$varname= htmlentities($row['variant']);
      $output .= '<option value="'.$varid.'">'.$varname.'</option>';
    }
    return $output;
  }
  function fill_region_select_box($conn){
	$output='';
	$sql = "SELECT * FROM regions";
    $result = mysqli_query($conn,$sql);
	foreach($result as $row){
		$regid= htmlentities($row['region_id']);
		$regname= htmlentities($row['region_name']);
	$output .= '<option value="'.$regid.'">'.$regname.'</option>';
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
	<link rel="stylesheet" href="css/donations.css">
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

	<title>Add donations</title>
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
							<a href="#" style="font-size: 18px;">Dashboard</a>
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
			<h3>Add Donations</h3>					
        <div>
        </div>
		</div>
		<form id="add-form">
  			<?php 
				$referenceId = "";
				$sql = "SELECT * FROM donation_items_picking";
                $result = mysqli_query($conn,$sql);
				foreach($result as $row){
					$referenceId = $row['reference_id'];
				}
                
			?>
          <input type="hidden"  id="reference_id" value="<?php echo htmlentities($referenceId); ?>" readonly>
		  <div class="row">
			<div class="col">
				<div class="form-group">
				<label for="fname">Fullname</label>
				<input class="form-control border-success" type="text" name="fname" id="fname">
            </div>
			</div>
			<div class="col">
				<div class="form-group">
				<label for="province">Province</label>
				<input class="form-control border-success" type="text" name="province" id="province">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
				<label for="street">Street</label>
				<input class="form-control border-success" type="text" name="street" id="street">
				</div>
			</div>
		  </div>	
		  <div class="row"> 
			<div class="col">
            <div class="form-group">
              <label for="region">Select Region</label>
              <select class="custom-select border-success" name="region" id="region">
              <option value="">-Select-</option>
              <?php echo fill_region_select_box($conn); ?>
            </select>
			</div>  
		</div> 
		<div class="col">
			<div class="form-group">
				<label for="donor_contact"> Contact</label>
				<input class="form-control border-success" type="text" id="contact" name="contact">
			</div>
		</div>
	</div>
			
            <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control border-success" type="text" name="email" id="email">
            </div>
			
            <div class="form-group">
            <label for="donation_date">Donation Date</label>
            <input class="form-control border-success" type="date" name="donation_date" id="donation_date">
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
			
          </form>
				
  			
			</div>
		</main>
	
	</section>
	
	

	<script src="scripts/sidemenu.js"></script>
	<script src="scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>	
  	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
 	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
 
 
 <script>  
   $(document).ready(function(){
    var count= 0;
	
    function add_input_field(count){
	  $('#testBtn').remove();
	  $('#cancelBtn').remove();
      var html='';
      html+= '<div id="items">';
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
	$('#add-form').append(add_input_field(count[0]))
	$('#add-form').append('<button  type="button" class="btn addDonate" id="testBtn">Save</button>');
	$('#add-form').append('<button type="button" class="btn  cancelBtn" id="cancelBtn">Cancel</button>');
    $(document).on('click', '#btn_additem',function(){
		count++;
      $('#add-form').append(add_input_field(count));

	  $('#add-form').append('<button type="button" class="btn addDonate" id="testBtn">Save</button>');
	  $('#add-form').append('<button type="button" class="btn  cancelBtn" id="cancelBtn">Cancel</button>');
	  
	  $('#testBtn').click(function(e){
		
		var valid = this.form.checkValidity();
        if(valid) {	
			e.preventDefault();
			var fd = new FormData();
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
		
	
		var reference_id= $('#reference_id').val();
		var fname = $('#fname').val();
		var province = $('#province').val();
		var street = $('#street').val();
		var region = $('#region').val();
		var email = $('#email').val();
		var donation_date = $('#donation_date').val();
		var contact= $('#contact').val();
		

		var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var varnumbers = /^\d+$/;
        var inValid = /\s/;

		 if(fname==""){
		 	$('#fname').removeClass('border-success');
             $('#fname').addClass('border-danger');
             return false;
		 }
		 else if(province==""){
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
		 	Swal.fire('Select', "Please select a region",'warning');
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
		 	for(var j=0;j<category.length;j++){
			
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
			var data = {saveBtn: '',reference_id:reference_id,fname,province:province,street:street,region:region,email:email,contact:contact,donation_date:donation_date,category_arr:category_arr,variant_arr:variant_arr,quantity_arr:quantity_arr,
				itemName_arr:itemName_arr,items_arr:items_arr,totalItem:totalItem};
				console.log(data);
			
		 	$.ajax({
		 	url:'include/add.inc.php',
		 	method:'POST',
		 	data: data,
		 	success:function(data){
		 		if(data == "Data added"){
                   Swal.fire({
                   title: 'Success',
                   text: "Successfully Added",
                   icon: 'success',
                   confirmButtonColor: '#3085d6',
                   confirmButtonText: 'OK',
                   allowOutsideClick: false
                   }).then((result) => {
                     if (result.isConfirmed) {
                       window.location.href="donations.php?inserted";
                     }
                   }) 
                 } else {
                   Swal.fire('Error', data,'error')
                 }
		 	},
		 	error: function(data){
                 Swal.fire('Error', "There were some errors while inserting the data.",'error')
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
	$('#testBtn').click(function(e){

		var valid = this.form.checkValidity();
        if(valid) {	
			e.preventDefault();
			var fd = new FormData();
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
		
	
		var reference_id= $('#reference_id').val();
		var fname = $('#fname').val();
		var province = $('#province').val();
		var street = $('#street').val();
		var region = $('#region').val();
		var email = $('#email').val();
		var donation_date = $('#donation_date').val();
		var contact= $('#contact').val();
		

		var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var varnumbers = /^\d+$/;
        var inValid = /\s/;

		 if(fname==""){
		 	$('#fname').removeClass('border-success');
             $('#fname').addClass('border-danger');
             return false;
		 }
		 else if(province==""){
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
		 	Swal.fire('Select', "Please select a region",'warning');
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
		 	for(var j=0;j<category.length;j++){
			
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
			var data = {saveBtn: '',reference_id:reference_id,fname,province:province,street:street,region:region,email:email,contact:contact,donation_date:donation_date,category_arr:category_arr,variant_arr:variant_arr,quantity_arr:quantity_arr,
				itemName_arr:itemName_arr,items_arr:items_arr,totalItem:totalItem};
				console.log(data);
			
		 	$.ajax({
		 	url:'include/add.inc.php',
		 	method:'POST',
		 	data: data,
		 	success:function(data){
		 		if(data == "Data added"){
                   Swal.fire({
                   title: 'Success',
                   text: "Successfully Added",
                   icon: 'success',
                   confirmButtonColor: '#3085d6',
                   confirmButtonText: 'OK',
                   allowOutsideClick: false
                   }).then((result) => {
                     if (result.isConfirmed) {
                       window.location.href="donations.php?inserted";
                     }
                   }) 
                 } else {
                   Swal.fire('Error', data,'error')
                 }
		 	},
		 	error: function(data){
                 Swal.fire('Error', "There were some errors while inserting the data.",'error')
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
	  $('#email').on('keyup', function() {
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