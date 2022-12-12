<?php
session_start();

	?>
<?php 
require_once 'include/connection.php';
$sql = "SELECT * from donor_recordm";
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
	<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

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
					<span class="text">Records</span>
				</a>
			</li>
			<li>
				<a href="categorytables.php">
					<i class='bx bxs-package'></i>
					<span class="text">Stocks</span>
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
						<h3>Money Donor Records</h3>
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
		<th>Region</th>
		<th>Province</th>
		<th>Municipality</th>
		<th>Barangay</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Date</th>
		<th>Donated</th>
		<th>Certificate</th>
		<th>Status</th>
      </tr>
    </thead>
    <tbody>
		<?php $count=0; ?>
		<?php foreach ($result as $row): ?>
			<?php 
				$rdm_id= $row['id'];
				$rdm_name= $row['rDM_name'];
				$rdm_province= $row['rDM_province'];
				$rdm_municipality= $row['rDM_municipality'];
				$rdm_barangay= $row['rDM_barangay'];
				$rdm_region= $row['rDM_region'];
				$rdm_email= $row['rDM_email'];
				$rdm_contact= $row['rDM_contact'];
				$rdm_date= $row['rDM_date'];
				$donated= $row['donated'];
				$rdm_certificate= $row['rDM_certificate'];
				$count=$count+1;
				
				
				?>
		<tr>
			<td><?php echo htmlentities($rdm_id) ?></td>
			<td><?php echo htmlentities($rdm_name) ?></td>
			<?php 
			 $sql2="SELECT * From refregion";
		 	$result2=mysqli_query($conn,$sql2);
		
		 	foreach($result2 as $row1){
			if ($rdm_region== $row1['regCode']){
				echo "<td>".htmlentities($row1['regDesc'])."</td>
				";
				}
			}
		?>
		<?php 
			 $sql2="SELECT * From refprovince";
		 	$result2=mysqli_query($conn,$sql2);
		
		 	foreach($result2 as $row1){
			if ($rdm_province== $row1['provCode']){
				echo "<td>".htmlentities($row1['provDesc'])."</td>
				";
				}
			}
		?>
		<?php 
			 $sql2="SELECT * From refcitymun";
		 	$result2=mysqli_query($conn,$sql2);
		
		 	foreach($result2 as $row1){
			if ($rdm_municipality== $row1['citymunCode']){
				echo "<td>".htmlentities($row1['citymunDesc'])."</td>
				";
				}
			}
		?>
		<?php 
			 $sql2="SELECT * From refbrgy";
		 	$result2=mysqli_query($conn,$sql2);
		
		 	foreach($result2 as $row1){
			if ($rdm_barangay== $row1['brgyCode']){
				echo "<td>".htmlentities($row1['brgyDesc'])."</td>
				";
				}
			}
		?>
			<td><?php echo htmlentities($rdm_email) ?></td>
			<td><?php echo htmlentities($rdm_contact) ?></td>
			<td><?php echo htmlentities($rdm_date) ?></td>
			<td>₱<?php echo htmlentities($donated) ?></td>
			<td><button class="btn btnCert"  value="<?php echo htmlentities($rdm_id) ?>"><?php echo htmlentities($rdm_certificate) ?></button></td>
			<td><span><i style="color:green ;" class="fa-solid fa-envelope-circle-check"></i></span><button class="btn deleteBtn" type="button" id="<?php echo $count ?>" value="<?php echo htmlentities($rdm_id); ?>"><i style="color: red;" class="fa-sharp fa-solid fa-trash"></i></button></td>
			
		</tr>
	<?php endforeach; ?>
	  </tbody>
  </table>
 

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
	  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
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
			  	url:'include/viewid.php?viewMoney='+request_id,
			  	type: 'GET',
			  	success: function(data){
			
					printJS('include/money_donor/'+data, 'image')		   		
			  	}
			  });

		});
	});
</script>
<script>
	$(document).ready(function(){
		$('.deleteBtn').click(function(){
			var valueBtn= $(this);
			var donorID= valueBtn.val();
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url:'include/viewid.php?deleteBtnM='+donorID,
						type:'POST',
						success:function(data){
							
							 Swal.fire(
							 'Deleted!',
							 'Your file has been deleted.',
							 'success'
							 ).then((result)=>{
								if(result.isConfirmed){
									location.reload();
								}
							});
						}
					});
					
				}
				});

		});
	})
</script>

</body>
</html>
