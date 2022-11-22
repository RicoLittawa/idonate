<?php
session_start();

	?>
<?php 
require_once 'include/connection.php';
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/donations.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

	<title>Accept Requests</title>
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
			<li>
				<a href="donations.php">
					<i class='bx bxs-box' ></i>
					<span class="text">Donations</span>
				</a>
			</li>
			<li class="active">
				<a href="#">
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
					<h1>Requests</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#" style="font-size: 18px;">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="request.php" style="font-size: 18px;">Back</a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="table-data">
				<div class="add">
					<div class="head">
						<h3>Requests</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
					</div>
					<?php 
					if (isset($_GET['acceptReq'])):
						$request_id= $_GET['acceptReq'];
						$sql ="SELECT * from set_request where request_id=?";
						$stmt= $conn->prepare($sql);
						$stmt->bind_param('i',$request_id);
						$stmt->execute();
						$result = $stmt->get_result();
						$data = $result->fetch_all(MYSQLI_ASSOC);
						foreach ($data as $row):
						
						
					?>
					<?php 
					$reference= $row['reference_id'];
					$req_name= $row['req_name'];
					$req_province= $row['req_province'];
					$req_street= $row['req_street'];
					$req_region= $row['req_region'];
					$req_email= $row['req_email'];
					$req_date= $row['req_date'];
					$valid_id= $row['valid_id'];
					
					?>
					<?php 
					$ref ="SELECT * from donation_items_picking";
					$result= mysqli_query($conn,$ref);
					foreach($result as $refR):
					?>
					<form id="requestform">
						<input type="text" id="donateRefId" name="donateRefId" value="<?php echo htmlentities($refR['reference_id']); ?>" readonly>
						<?php endforeach; ?>
						<input type="text" id="request_id" name="request_id" value="<?php echo htmlentities($request_id); ?>"readonly>
						<input type="text" id="req_reference" name="req_reference" value="<?php echo htmlentities($reference); ?>"readonly>
						<input type="text" id="valid_id" name="valid_id" value="<?php echo htmlentities($valid_id); ?>"readonly>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="">Donor Name</label>
									<input type="text" class="form-control border-success" name="req_name" id="req_name" value="<?php echo htmlentities($req_name); ?>">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="">Province</label>
									<input type="text" class="form-control border-success" name="req_province" id="req_province" value="<?php echo htmlentities($req_province); ?>">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="">Street</label>
									<input type="text" class="form-control border-success" name="req_street" id="req_street" value="<?php echo htmlentities($req_street); ?>">
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="">Region</label>
									<select class="custom-select border-success" name="req_region" id="req_region">
									<option value="-Select-">-Select-</option>
									<?php 
									$sql1= "SELECT * from regions";
									$result= mysqli_query($conn,$sql1);
									foreach ($result as $row1):
									?>
									<option value="<?php echo htmlentities($row1['region_id']) ?>"<?php if($req_region== $row1['region_id']){echo 'selected="selected"';} ?>>
									<?php echo htmlentities($row1['region_name']); ?></option>
										<?php endforeach; ?>
									</select>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="req_email">Email</label>
									<input class="form-control border-success" type="text" name="req_email" id="req_email" value="<?php echo htmlentities($req_email); ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="req_date">Date</label>
									<input class="form-control border-success" type="date" name="req_date" id="req_date" value="<?php echo htmlentities($req_date); ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="">Donation Types & Quantity</label>
									<button type="button" style="float: right ;" class="btn" id="btnAdd"><i style="color:green ;font-size: 40px;" class="fa-solid fa-plus"></i></button>
								</div>
							</div>
						</div>
						<?php 
						$sql2= "SELECT * from set_request10 where req_reference=?";
						$stmt= $conn->prepare($sql2);
						$stmt-> bind_param('i',$reference);
						$stmt->execute();
						$result = $stmt->get_result();
						$req = $result->fetch_all(MYSQLI_ASSOC);
						foreach ($req as $row3):
						?>
						<?php
						$req_category= $row3['req_category'];
						$req_variant=$row3['req_variant'];
						$req_quantity=$row3['req_quantity'];

						?>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="req_email">Select Category</label>
									<select class="custom-select border-success category" name="category" id="category">
									<option value="-Select-">-Select-</option>
									<?php 
									$sql3="SELECT * from category ";
									$result1= mysqli_query($conn,$sql3);
									foreach ($result1 as $row4):
									?>
									<option value="<?php echo htmlentities($row4['categ_id']); ?>"<?php if($req_category== $row4['categ_id']){ echo 'selected="selected"';} ?>>
									<?php echo htmlentities($row4['category']); ?></option>
									<?php endforeach; ?>
									</select>
									
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="req_email">Select Variant</label>
									<select class="custom-select border-success variant" name="variant" id="variant">
									<option value="-Select-">-Select-</option>
									<?php 
									$sql4="SELECT * from variant ";
									$result2= mysqli_query($conn,$sql4);
									foreach ($result2 as $row5):
									?>
									<option value="<?php echo htmlentities($row5['variant_id']); ?>"<?php if ($req_variant== $row5['variant_id']){echo 'selected="selected"';} ?>>
								<?php echo htmlentities($row5['variant']); ?></option>
									<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="req_quantity">Quantity</label>
									<input class="form-control border-success quantity" type="text" name="quantity" id="quantity" value="<?php echo htmlentities($req_quantity); ?>">
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						<?php endforeach; ?>
					</form>
  			<?php endif; ?>
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
	  $(document).ready(function () {
    $('#table_data').DataTable({
      "pagingType":"full_numbers",
      "lengthMenu":[
      [10,25,50,-1],
      [10,25,50,"All"]],
      responsive:true,
      language:{
        search:"_INPUT_",
        searchPlaceholder: "Search Records",
      }

    });
});
</script>
<script>
	$(document).ready(function(){
		var count = 0;
		function add_request_field (count){
			$('#testBtn').remove();
			var html='';
			html+='<div>'
				html+= '<div class="row"><div class="col"><div class="form-group"><select class="custom-select category border-success" name="category" id="category"><option value="-Select-">-Select-</option><?php echo fill_category_select_box($conn); ?></select></div></div>';
				html += '<div class="col"><div class="form-group"><select class="custom-select variant border-success" name="variant" id="variant"><option value="-Select-">-Select-</option><?php echo fill_variant_select_box($conn); ?></select></div></div>';
				html += '<div class="col"><div class="form-group"><input class="form-control quantity border-success" type="text" name="quantity" id="quantity"></div></div></div>';

			var remove_button='';
				if(count>0)
				{
					remove_button='<button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>';
				}
				html+='<span>'+remove_button+'</span></div>';
			return html;
		}
	//addfields
	$(document).on('click','#btnAdd',function(){
		count++;
		$('#requestform').append(add_request_field(count));
		$('#requestform').append('<button type="button" style="float: right;" class="btn btn-success addDonate" id="testBtn">Accept</button>');
		$('#testBtn').click(function(e){
			e.preventDefault();
			var valid = this.form.checkValidity();
			if(valid) {
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
				var donateRefId= $('#donateRefId').val();
				var request_id= $('#request_id').val();
				var reference_id= $('#req_reference').val();
				var req_name = $('#req_name').val();
				var req_province = $('#req_province').val();
				var req_street = $('#req_street').val();
				var req_region = $('#req_region').val();
				var req_email = $('#req_email').val();
				var req_date = $('#req_date').val();
				var req_date = $('#req_date').val();
				var valid_id = $('#valid_id').val();
				var data={acceptBtn:'',donateRefId:donateRefId,request_id:request_id,reference_id:reference_id,req_name:req_name,req_province:req_province,req_street:req_street,req_region:req_region,req_email:req_email,req_date:req_date,category_arr:category_arr,
				variant_arr:variant_arr,quantity_arr:quantity_arr,valid_id:valid_id};
				
				alert(valid_id);
				$.ajax({
					url:'include/viewid.php',
					type: 'POST',
					data: data,
					success: function(data){
						alert(data);
						window.location = "donations.php";
					}
					
				});
				
			}
		});
	});


	
//remove
	$('#requestform').append('<button type="button" style="float: right;" class="btn btn-success addDonate" id="testBtn">Accept</button>');
	$(document).on('click','#remove', function(){
		$(this).closest('div').remove();
	});
	});
</script>
	

	

</body>
</html>
