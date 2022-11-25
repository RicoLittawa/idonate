<?php
session_start();

	?>
<?php 
require_once 'include/connection.php';
$sql = "SELECT * from set_request";
$result= mysqli_query($conn,$sql);


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

	<title>Requests</title>
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
					<h1>Requests</h1>
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
						<h3>Requests</h3>
						<i class='bx bx-search' ></i>	
						<i class='bx bx-filter' ></i>
					</div>
					<table class="table table-striped table-bordered" style="width:100%" id="table_data">
    <thead>
      <tr>
		<th>Id</th>
		<th>Date</th>
        <th>Donor Name</th>
		<th>Province</th>
		<th>Street</th>
		<th>Region</th>
		<th>Contact Number</th>
		<th>Email</th>
		<th></th>
		<th>Status</th>
        
        
      </tr>
    </thead>
    <tbody>
		<?php foreach ($result as $row): ?>
			<?php 
				$reference_id= $row['reference_id'];
				$req_id= $row['request_id'];
				$reqName= $row['req_name'];
				$reqDate= $row['req_date'];
				$reqStreet= $row['req_street'];
				$reqProvince= $row['req_province'];
				$reqRegion= $row['req_region'];
				$reqContact= $row['req_contact'];
				$reqEmail= $row['req_email'];
				
				?>
		<tr>
			<td><?php echo htmlentities($reference_id); ?></td>
			<td><?php echo htmlentities($reqDate); ?></td>
			<td><?php echo htmlentities($reqName); ?></td>
			<td><?php echo htmlentities($reqProvince); ?></td>
			<td><?php echo htmlentities($reqStreet); ?></td>
			<td><?php echo htmlentities($reqRegion); ?></td>
			<td><?php echo htmlentities($reqContact); ?></td>
			<td><?php echo htmlentities($reqEmail); ?></td>
			<td><button type="button" id="btnNote" class="btn col btnNote" data-toggle="modal" data-target="viewMessage" value="<?php echo htmlentities($req_id); ?>"><i style="color: green;" class="fa-solid fa-message"></i></button>
			<button type="button" class="btn col  validId"  data-toggle="modal" data-target="validImg" value="<?php echo htmlentities($req_id); ?>"><i style="color:green ;" class="fa-regular fa-id-badge"></i></button>
			<a  class="btn col" href="acceptrequest.php?acceptReq=<?php echo htmlentities($req_id); ?>"><i style="color: red;" class="fa-solid fa-circle-check"></i></a>
			</td>
			<td><button class="btn verify" id="verify" data-action="verify" data-email="<?php echo htmlentities($reqEmail); ?>" data-id="<?php echo htmlentities($req_id); ?>" data-name="<?php echo htmlentities($reqName); ?>"><i id="icon" style="color: red ;" class="fa-solid fa-check-double"></i></button></td>
		</tr>
	<?php endforeach; ?>
	  </tbody>
  </table>
 <!--Valid id -->
<div class="modal fade" id="validImg">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Reference/Transaction Reciept</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		
      </div>
	
	

	<form>
	<div class="modal-body">
	<img src="" id="imageContainer" alt="" width="465px" height="100%" style="border-radius:10px;">
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
	</form>

		

    </div>
  </div>
</div>

<!--Note --->
<div class="modal" id="viewMessage">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Donor's Note</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
		<div class="form-group">
			<label for="req_note">Note</label>
		<textarea class="form-control" name="req_note" id="req_note" cols="50" rows="5"></textarea>
		</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
  			
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

<!-- Valid Id-->
<script> 
	$(document).ready(function(){
		$('.validId').click(function(){
			var valueBtn = $(this);
			var request_id =valueBtn.val();
			$.ajax({
				url:'include/viewid.php?viewID='+request_id,
				type: 'GET',
				success: function(data){
						$('#validImg').modal('show');
			 			$('#imageContainer').attr('src','../donors/ValidId/'+data);
				}
			});

		});
	});
</script>
<!--Note -->
<script> 
	$(document).ready(function(){
		$('.btnNote').click(function(){

			var valueBtn = $(this);
			var request_id =valueBtn.val();
			
			  $.ajax({
			  	url:'include/viewid.php?viewNote='+request_id,
			  	type: 'GET',
			  	success: function(data){
			  			$('#viewMessage').modal('show');
						  $('#req_note').val(data);
						
			  			
			  	}
			  });

		});
	});
</script>
<script>
	$(document).ready(function(){
		$('#verify').click(function(){
			var id=  $(this).val();
			var email_data=[];
			var action = $(this).data("action");
			if (action=="verify"){
				email_data.push({
					email: $(this).data("email"),
					uID: $(this).data("id"),
					name: $(this).data("name"),
				});
			}console.log (email_data);

			 $.ajax({
			 	url:'include/verify.php'	,
			 	type:'POST',
			 	data: {email_data:email_data},
				success:function(data){
					if (data== "success"){
						alert(data);
						$('#icon').removeAttr('style','color:red;');
						$('#icon').attr('style','color:green;');

					}
				}
			 });
		});

	});
</script>
	

</body>
</html>
