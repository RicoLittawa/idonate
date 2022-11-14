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
        <button type="button" name="btn_additem" class="btn btn-success" id="btn_additem"><i class="fa-sharp fa-solid fa-plus"></i> 
                          </button>
                          
        </div>
					</div>
					<form id="add-form">
          <div>
  			<?php 
				$referenceId = "";
				$sql = "SELECT * FROM donation_items_picking";
                $result = mysqli_query($conn,$sql);
				if (mysqli_num_rows($result)){
					while($row =mysqli_fetch_assoc($result))
					{
						$referenceId = $row['reference_id'];
					}
				}else{
					echo'No records found';
				}
                
			?>
          <input type="hidden"  id="reference_id" value="<?php echo $referenceId; ?>" readonly>
            <div class="form-group">
            <label for="fname">Fullname</label>
            <input class="form-control" type="text" name="fname" id="fname">
      
            </div>
            <div class="form-group">
            <label for="province">Province</label>
            <input class="form-control" type="text" name="province" id="province">
            </div>
            <div class="form-group">
            <label for="street">Street</label>
            <input class="form-control" type="text" name="street" id="street">
            
            </div>
            <div class="form-group">
              <label for="region">Select Region</label>
              <select class="custom-select" name="region" id="region">
              <option value="default">Choose Region</option>
              <?php 
                $sql = "SELECT * FROM regions";
                $result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row =mysqli_fetch_array($result)){
						
						echo '<option value="'.$row['region_id'].'">'.$row['region_name'].'</option>';
					}
					
				}else{
					echo "No records found";
				}
                
                
                 
                
              ?>
            </select>
			</div>    
            <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email">
            
            </div>
            <div class="form-group">
            <label for="donation_date">Donation Date</label>
            <input class="form-control" type="date" name="donation_date" id="donation_date">
            </div>
         
           
            </div>
			<label class="form-group" style="font-weight: bold;">Donation Types & Quantity</label>
            
          </form>
				
  			
			</div>
		</main>
	
	</section>
	
	

	<script src="../Admin/scripts/sidemenu.js"></script>
	<script src="../Admin/scripts/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="../donors/js/sweetalert2.all.min.js"></script>	
  	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
 	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
  <script>  
   $(document).ready(function(){
    var count= 0;
    function add_input_field(count){
	  $('#testBtn').remove();
      var html='';
      html+= '<div>';
      html+= '<div class="form-group"><select class="form-control category" name="category" id="category"><option value="">Choose Category</option><?php echo fill_category_select_box($conn); ?></select></div>';
      html += '<div class="form-group"><select class="form-control variant" name="variant" id="variant"><option value="">Choose Variant</option><?php echo fill_variant_select_box($conn); ?></select></div>';
      html += '<div class="form-group"><input class="form-control quantity" type="text" name="quantity" id="quantity"></div>';
     
      var remove_button='';
      if(count>0)
      {
        remove_button='<button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
      }
      html+='<span>'+remove_button+'</span></div>';
      return html;
    }
    $('#add-form').append(add_input_field(0));
	$('#add-form').append('<button  type="button" style="float: right;" class="btn btn-success addDonate" id="testBtn">Save</button>');
    $(document).on('click', '#btn_additem',function(){
      count++;
      $('#add-form').append(add_input_field(count));
	  $('#add-form').append('<button type="button" style="float: right;" class="btn btn-success addDonate" id="testBtn">Save</button>');
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
		var reference_id= $('#reference_id').val();
		var fname = $('#fname').val();
		var province = $('#province').val();
		var street = $('#street').val();
		var region = $('#region').val();
		var email = $('#email').val();
		var donation_date = $('#donation_date').val();

		var data = {saveBtn: '',reference_id:reference_id,fname,province:province,street:street,region:region,email:email,donation_date:donation_date,category_arr:category_arr,variant_arr:variant_arr,quantity_arr:quantity_arr}
		$.ajax({
			url:'include/add.inc.php',
			method:'POST',
			data: data,
			success:function(data){
				var data = jQuery.parseJSON(data);
				if(data.status==404){
					Swal.fire({
						icon: 'error',
						title: 'Ooops..',
						text: data.message,
						})
				}else if(data.status == 422) {
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: data.message,
						}).then(function() {
							window.location = "donations.php";
						});
				}	
			}

		});
	});
    });
	
    $(document).on('click','#remove', function(){
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
		var reference_id= $('#reference_id').val();
		var fname = $('#fname').val();
		var province = $('#province').val();
		var street = $('#street').val();
		var region = $('#region').val();
		var email = $('#email').val();
		var donation_date = $('#donation_date').val();

		var data = {saveBtn: '',reference_id:reference_id,fname,province:province,street:street,region:region,email:email,donation_date:donation_date,category_arr:category_arr,variant_arr:variant_arr,quantity_arr:quantity_arr}
		$.ajax({
			url:'include/add.inc.php',
			method:'POST',
			data: data,
			success:function(data){
				var data = jQuery.parseJSON(data);
				if(data.status==404){
					Swal.fire({
						icon: 'error',
						title: 'Ooops..',
						text: data.message,
						})
				}else if(data.status == 422) {
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: data.message,
						}).then(function() {
							window.location = "donations.php";
						});
				}	
			}

		});
	});
	
  });
</script>  

</body>
</html>