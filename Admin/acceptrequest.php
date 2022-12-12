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
				<a class="settings"  href="settings.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
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
					$req_municipality= $row['req_municipality'];
					$req_barangay= $row['req_barangay'];
					$req_region= $row['req_region'];
					$req_email= $row['req_email'];
					$req_date= $row['req_date'];
					$valid_id= $row['valid_id'];
					$contact= $row['req_contact'];
					
					?>
					<?php 
					$ref ="SELECT * from donation_items_picking";
					$result= mysqli_query($conn,$ref);
					foreach($result as $refR):
					?>
					<form id="requestform">
						<input type="hidden" id="donateRefId" name="donateRefId" value="<?php echo htmlentities($refR['reference_id']); ?>" readonly>
						<?php endforeach; ?>
						<input type="hidden" id="request_id" name="request_id" value="<?php echo htmlentities($request_id); ?>"readonly>
						<input type="hidden" id="req_reference" name="req_reference" value="<?php echo htmlentities($reference); ?>"readonly>
						<input type="hidden" id="valid_id" name="valid_id" value="<?php echo htmlentities($valid_id); ?>"readonly>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="">Donor Name</label>
									<input type="text" class="form-control border-success" name="req_name" id="req_name" value="<?php echo htmlentities($req_name); ?>">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="">Region</label>
									<select class="custom-select border-success" name="req_region" id="req_region">
									<option value="-Select-">-Select-</option>
									<?php 
									$sql1= "SELECT * from refregion";
									$result= mysqli_query($conn,$sql1);
									foreach ($result as $row1):
									?>
									<option value="<?php echo htmlentities($row1['regCode']) ?>"<?php if($req_region== $row1['regCode']){echo 'selected="selected"';} ?>>
									<?php echo htmlentities($row1['regDesc']); ?></option>
										<?php endforeach; ?>
									</select>
									
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="">Province</label>
									<select class="custom-select border-success" name="req_province" id="req_province">
									<option value="-Select-">-Select-</option>
									<?php 
									$province = "SELECT provCode, provDesc FROM refprovince where regCode=?";
									$stmt=$conn->prepare($province);
									$stmt->bind_param('s',$req_region);
									$stmt->execute();
									$resultProv= $stmt->get_result();
									$data = $resultProv->fetch_all(MYSQLI_ASSOC);
									foreach($data as $row1):
									?>
									<option value="<?php echo htmlentities($row1['provCode']) ?>"<?php if($req_province== $row1['provCode']){echo 'selected="selected"';} ?>>
									<?php echo htmlentities($row1['provDesc']); ?></option>
										<?php endforeach; ?>
									</select>
									
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="">Municipality</label>
									<select class="custom-select border-success" name="req_municipality" id="req_municipality">
									<option value="-Select-">-Select-</option>
									<?php 
									$city = "SELECT citymunCode, citymunDesc FROM refcitymun where provCode=?";
									$stmt=$conn->prepare($city);
									$stmt->bind_param('s',$req_province);
									$stmt->execute();
									$resultCity= $stmt->get_result();
									$data = $resultCity->fetch_all(MYSQLI_ASSOC);
									foreach($data as $row1):
									
									?>
									<option value="<?php echo htmlentities($row1['citymunCode']) ?>"<?php if($req_municipality== $row1['citymunCode']){echo 'selected="selected"';} ?>>
									<?php echo htmlentities($row1['citymunDesc']); ?></option>
										<?php endforeach; ?>
									</select>
									
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col">
										<div class="form-group">
										<label for="req_barangay">Select Barangay</label>
											<select class="custom-select border-success" name="req_barangay" id="req_barangay">
											<option value="-Select-">-Select-</option>
											<?php 
												$brgy = "SELECT brgyCode, brgyDesc FROM refbrgy where citymunCode=?";
												$stmt=$conn->prepare($brgy);
												$stmt->bind_param('s',$req_municipality);
												$stmt->execute();
												$resultBrgy= $stmt->get_result();
												$data = $resultBrgy->fetch_all(MYSQLI_ASSOC);
												foreach($data as $row1):
												?>
											
											<option value="<?php echo htmlentities($row1['brgyCode']);?>"
											<?php if($req_barangay == $row1['brgyCode']) {echo 'selected="selected"';}?>>
											<?php echo htmlentities($row1['brgyDesc']);?></option>
											<?php endforeach;  ?>
											</select>
										</div>
									</div>
							<div class="col">
								<div class="form-group">
									<label for="req_contact">Contact</label>
									<input class="form-control border-success" type="text" name="req_contact" id="req_contact" value="<?php echo htmlentities($contact); ?>">
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
									<button style="float: right;" type="button" class="btn btn-success btnAdd" id="btnAdd" name="btnAdd"><i style="color: white;font-size:30px;" class="fa-sharp fa-solid fa-plus"></i> 
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
										<div class="form-group">
										<?php 
								$sql1="SELECT * from set_request10 where req_reference= ?";
								$stmt = $conn->prepare($sql1); 
								$stmt->bind_param("s", $reference);
								$stmt->execute();
								$result = $stmt->get_result();
								$data = $result->fetch_all(MYSQLI_ASSOC);
								foreach ($data as $donor){
									$variantCode= $donor['req_variantCode'];
									$categCode= $donor['req_category'];
									$name_items= $donor['req_nameItem'];
								}
								
							
							
								?>
										<label for="variant">Select Variant</label>
											<select class="custom-select variant border-success" name="variant" id="variant">
											<option value="-Select-">-Select-</option>
											<?php 
												$sql = "SELECT * FROM variant";
												$result = mysqli_query($conn,$sql);
												foreach($result	 as $row):
												?>
											<option value="<?php echo htmlentities($row['variantCode']);?>"
											<?php if($variantCode == $row['variantCode']) {echo 'selected="selected"';}?>>
											<?php echo htmlentities($row['variant']);?></option>
											<?php endforeach;  ?>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label for="">Quantity</label>
											<?php 
											$totalVariant= "SELECT req_quantity from req_varianttotal where req_reference=?";
											$stmt = $conn->prepare($totalVariant);
											$stmt->bind_param('s',$reference);
											$stmt->execute();
											$result= $stmt->get_result();
											$user = $result->fetch_assoc();
											echo "<input class='form-control border-success quantity' name='quantity' id='quantity' value='".$user['req_quantity']."'>";
											?>

										</div>
									</div>
							</div>	
						<table class="table table-bordered">
								<tr>
									<th>Category</th>
									<th>item Name</th>
									<th>Button</th>
								</tr>
								<tbody class="dynamicAdd">
									<tr>
									<?php 
								$total="SELECT * from set_request10 where req_reference= ?";
								$stmt = $conn->prepare($total); 
								$stmt->bind_param("s", $reference);
								$stmt->execute();
								$result = $stmt->get_result();
								$data = $result->fetch_all(MYSQLI_ASSOC);
								foreach ($data as $donor):
									$variantCode= $donor['req_variantCode'];
									$categCode= $donor['req_category'];
									$name_items= $donor['req_nameItem'];
									
							
								?>
										<td><select  class="custom-select border-success category" name="category" id="category">
												<option value="-Select-">-Select-</option>
												<?php
													$sql2= "SELECT * from category";
													$result2= mysqli_query($conn,$sql2);
													foreach ($result2 as $row2): 		
																
												?>
									
												<option value="<?php echo htmlentities($row2['categCode']); ?>"<?php if($categCode == $row2['categ_id']) {echo 'selected="selected"';}?>>
												<?php echo htmlentities($row2['category']);?></option>
												
												
													<?php endforeach; ?>
										
													</select></td>
										<td><input type="text" class="form-control border-success name_items" id="name_items" name="name_items" value="<?php echo htmlentities($name_items); ?>"></td>
									
										<td><button type="button" class="btn btn-danger btnRemove" id="btnRemove">Remove</button></td>
										
									</tr>
									<?php endforeach; ?>
								</tbody>
							
							</table>
						<?php endforeach; ?>
						<input type="hidden" id="valid_id" name="valid_id" value="<?php echo htmlentities($valid_id) ?>">
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
	var appendedTable = '<tr>'+
	'<td><select class="custom-select category border-success" name="category" id="category"><option value="-Select-">-Select-</option><?php echo fill_category_select_box($conn); ?></select></td>'+
	'<td><input class="form-control border-success name_items" id="name_items" name="name_items" autocomplete="off"></td>'+
	'<td><button type="button" class="btn btn-danger btnRemove" id="btnRemove">Remove</button></td></tr>';
	$(document).on('click','.btnRemove', function(){
      $(this).closest('tr').remove();
    });
	$('#requestform').append('<button  type="button" class="btn addDonate" id="testBtn">Save</button>');
	$('#requestform').append('<button type="button" class="btn  cancelBtn" id="cancelBtn">Cancel</button>');
	
	$('.btnAdd').click(function(){
		$('.dynamicAdd').append(appendedTable);
	});
	$('#cancelBtn').click(function(){
		Swal.fire({
                    title: 'Warning',
                    text: "Go back to previous page?",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href="request.php";
                      }
                    }) 
	});
	$('#testBtn').click(function(e){

		var valid = this.form.checkValidity();
        if(valid) { 
            e.preventDefault();
        var category_arr=[];
        var itemName_arr=[];

        var category = $('.category');
        var name_items = $('.name_items');
        // var test_qty = 0;
        for (var i = 0;i<category.length;i++){  
            category_arr.push($(category[i]).val());
            itemName_arr.push($(name_items[i]).val());
            // test_qty += parseInt($(quantity[i]).val());    
        }
		var donateRefId= $('#donateRefId').val()
		var request_id = $('#request_id').val();
		var req_reference = $('#req_reference').val();
		var req_name =$('#req_name').val();
		var req_region =$('#req_region').val();
		var req_province =$('#req_province').val();
		var req_municipality =$('#req_municipality').val();
		var req_barangay =$('#req_barangay').val();
		var req_contact =$('#req_contact').val();
		var req_email =$('#req_email').val();
		var req_date =$('#req_date').val();
		var variant =$('#variant').val();
		var quantity =$('#quantity').val();
		var valid_id = $('#valid_id').val();
        var emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var varnumbers = /^\d+$/;
        var inValid = /\s/;

           if(req_name==""){
               $('#req_name').removeClass('border-success');
               $('#req_name').addClass('border-danger');
               return false;
           }
           else if(req_region=="-Select-"){
               Swal.fire('Select', "Please select a region",'warning');
               return false;
           }
		   else if(req_province=="-Select-"){
               Swal.fire('Select', "Please select a province",'warning');
               return false;
           }
		   else if(req_municipality=="-Select-"){
               Swal.fire('Select', "Please select a municipality",'warning');
               return false;
           }
		   else if(req_barangay=="-Select-"){
               Swal.fire('Select', "Please select a barangay",'warning');
               return false;
           }
           else if(req_contact==""){
               $('#req_contact').removeClass('border-success');
               $('#req_contact').addClass('border-danger');
           }
           else if (inValid.test($('#req_contact').val())==true){
               Swal.fire('Contact', "Whitespace is prohibited.",'warning');
               $('#req_contact').removeClass('border-success');
               $('#req_contact').addClass('border-danger');
               return false;
             }
           else if(varnumbers.test($('#req_contact').val())==false) {
               Swal.fire('Number', "Numbers only.",'warning');
               $('#req_contact').removeClass('border-success');
               $('#req_contact').addClass('border-danger');
               return false;
             } 
           else if(req_contact.length !=11){
               Swal.fire('Contact', "Enter Valid Contact Number",'warning'); 
               $('#req_contact').removeClass('border-success');
               $('#req_contact').addClass('border-danger');
               return false;
             }
           else if(req_email==""){
               $('#email').removeClass('border-success');
               $('#email').addClass('border-danger');
               return false;
           }
           else if(emailVali.test($('#req_email').val())==false){
               Swal.fire('Email', "Invalid email address",'warning'); 
               $('#req_email').removeClass('border-success');
               $('#req_email').addClass('border-danger');
               return false;
           }
        
           else if(req_date==""){

               $('#req_date').removeClass('border-success');
               $('#req__date').addClass('border-danger');
               return false;
           }
		   else if(variant=="-Select-"){
               Swal.fire('Select', "Please select a variant",'warning');
               return false;
           }
		   else if (quantity==""){
                   Swal.fire('Fields', "Quantity is empty",'warning');
                   return false;
               }
			  
		  else if (inValid.test($('#quantity').val())==true){ 
                   Swal.fire('Quantity', "Whitespace is prohibited.",'warning');
                   return false;
               }
		 else if(varnumbers.test($('#quantity').val())==false) {
               Swal.fire('Number', "Numbers only.",'warning');
               $('#quantity').removeClass('border-success');
               $('#quantity').addClass('border-danger');
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
             
               }
            var data = {acceptBtn: '',donateRefId:donateRefId,request_id:request_id,req_reference:req_reference,req_name:req_name,req_region:req_region,req_province:req_province,valid_id:valid_id,
			req_municipality:req_municipality,req_barangay:req_barangay,req_contact:req_contact,req_email:req_email,req_date:req_date,variant:variant,quantity:quantity,category_arr:category_arr,itemName_arr:itemName_arr};
            
			$.ajax({
				url:'include/accept.inc.php',
				method:'POST',
				data:data,
				success:function(data){
					if(data == "Data-submitted"){
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
});
</script>
<script>
	$(document).ready(function(){
	 $('#req_region').on('change',function(){
		var regCode= $(this).val();
		if (regCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'regCode='+regCode,
				success: function (data){
					$('#req_province').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select region', 'warning');
		}
	 });
	 $('#req_province').on('change',function(){
		var provCode= $(this).val();
		if (provCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'provCode='+provCode,
				success: function (data){
					$('#req_municipality').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select province', 'warning');
		}
	 });
	 $('#req_municipality').on('change',function(){
		var citymunCode= $(this).val();
		if (citymunCode){
			$.ajax({
				url:'include/region.php',
				type:'POST',
				data: 'citymunCode='+citymunCode,
				success: function (data){
					$('#req_barangay').html(data);
				}

			});
		}
		else{
			swal.fire('Warning', 'Select municipality', 'warning');
		}
	 });
	
	});
	</script>
	

</body>
</html>
