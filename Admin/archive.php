<?php
session_start();

	?>
<?php 
require_once 'include/connection.php';
$sql = "SELECT * from donor_record";
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

	<title>Donor Records</title>
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
			<li >
				<a href="request.php">
					<i class='bx bxs-envelope' ></i>
					<span class="text">Requests</span>
				</a>
			</li>
			<li class="active">
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
					<h1>Archive</h1>
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
						<h3>Donor Records</h3>
						<div class="dropdown">
			<button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
			Select Table
			</button>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="archive.php">Recent Donors</a>
				<a class="dropdown-item" href="archiveM.php">Recent Money Donors</a>
				
			
			</div>
			</div>
					</div>
					<table class="table table-striped table-bordered" style="width:100%" id="table_data">
    <thead>
      <tr>
		<th>Id</th>
		<th>Donor Name</th>
		<th>Province</th>
		<th>Street</th>
		<th>Region</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Date</th>
		<th>Certificate</th>
		<th>Status</th>
		
		
		
		
        
        
      </tr>
    </thead>
    <tbody>
		<?php foreach ($result as $row): ?>
			<?php 
				$reference_id= $row['rD_reference'];
				$rd_id= $row['id'];
				$rd_name= $row['rD_name'];
				$rd_province= $row['rD_province'];
				$rd_street= $row['rD_street'];
				$rd_region= $row['rD_region'];
				$rd_email= $row['rD_email'];
				$rd_contact= $row['rD_contact'];
				$rd_date= $row['rD_date'];
				$rd_certificate= $row['rD_certificate'];
				
				
				?>
		<tr>
			<td><?php echo htmlentities($rd_id) ?></td>
			<td><?php echo htmlentities($rd_name) ?></td>
			<td><?php echo htmlentities($rd_province) ?></td>
			<td><?php echo htmlentities($rd_street) ?></td>
			<?php 
			
			 $sql2="SELECT * From regions";
		 	$result2=mysqli_query($conn,$sql2);
		
		 	foreach($result2 as $row1){
			if ($rd_region== $row1['region_id']){
				echo "<td>".htmlentities($row1['region_name'])."</td>
				";
				}
			}
		
		?>
			<td><?php echo htmlentities($rd_email) ?></td>
			<td><?php echo htmlentities($rd_contact) ?></td>
			<td><?php echo htmlentities($rd_date) ?></td>
			<td><button class="btn btnCert" data-toggle="modal" data-target="Certi"  value="<?php echo htmlentities($rd_id) ?>"><?php echo htmlentities($rd_certificate) ?></button></td>
			<td><span><i style="color:green ;" class="fa-solid fa-envelope-circle-check"></i></span><button class="btn"><i style="color: red;" class="fa-sharp fa-solid fa-trash"></i></button></td>
		
		</tr>
	<?php endforeach; ?>
	  </tbody>
  </table>
 
  <div class="modal fade" id="Certi">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Acknowledgement Reciept</h4>
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
		$('.btnCert').click(function(){

			var valueBtn = $(this);
			var request_id =valueBtn.val();
			
		
			  $.ajax({
			  	url:'include/viewid.php?viewCert='+request_id,
			  	type: 'GET',
			  	success: function(data){
					
			  			 $('#Certi').modal('show');
						   $('#imageContainer').attr('src','include/download-certificate/'+data);		   		
			  	}
			  });

		});
	});
</script>

	

</body>
</html>
