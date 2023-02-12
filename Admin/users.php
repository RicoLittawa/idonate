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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="stylesheet" href="css/style.css">

	<title>User Details</title>
</head>
<body>
	<!-- SIDEBAR -->	
	<section class="bg-success" id="sidebar">
  <a href="#" class="brand d-flex align-items-center justify-content-between">
    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle mx-auto" style="width: 90px; height: 90px;margin-top:6rem;border:solid 5px #fff;">

  </a>

  <nav class="side-menu">
	  <h6 class="ps-5 mb-3 text-light custom-title">Main Menu</h6>
    <ul class="nav">
      <li class="nav-item">
        <a href="adminpage.php" class="nav-link">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="donations.php" class="nav-link">
          <i class='bx bxs-box'></i>
          <span class="text">Donations</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="request.php" class="nav-link">
          <i class='bx bxs-envelope'></i>
          <span class="text">Requests</span>
        </a>
      </li>
		<li class="nav-item">
			<a href="#" class="nav-link">
			<i class='bx bxs-file-archive'></i>
			<span class="text">Records</span>
		</a>
		</li>
      <li class="nav-item">
        <a href="categorytables.php" class="nav-link">
          <i class='bx bxs-package'></i>
          <span class="text">Stocks</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link active">
          <i class='bx bxs-user-plus active'></i>
          <span class="text">Users</span>
        </a>
      </li>
    </ul>
  </nav>
  
</section>


	<!-- SIDEBAR -->


	<section>

	
<div class="mb-4 custom-breadcrumb">
  <h1 class="fs-1 breadcrumb-title">Account Details</h1>
  <nav class="bc-nav d-flex">
    <h6 class="mb-0">
      <a href="" class="text-reset bc-path">Home</a>
      <span>/</span>
      <a href="" class="text-reset bc-path active">Dashboard</a>
    </h6>  
  </nav>
  <!-- Breadcrumb -->
</div>






  <div class="custom-container d-block align-items-center justify-content-between">
  <div class="card custom-card" >
  <div class="card-body">
 <div class="mt-2">

 <span><button class="btn btn-success" type="button" style=" width:200px;height:50px;float:right;"
				id="toggleFormBtn">
				<i class="fas fa-add"></i>Show Form</button></span>
 </div>
	
			<br>
 <div id="registerForm" class="collapse mt-5" data-duration="500">
	<form class="pe-2 mb-3">

  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input type="text" id="fname" class="form-control"/>
        <label class="form-label" for="fname">First name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text" id="lname" class="form-control"/>
        <label class="form-label" for="lname">Last name</label>
      </div>
    </div>
  </div>

  <!-- Email and Password inputs -->
  <div class="form-outline mb-4">
    <input type="email" id="email" class="form-control" />
    <label class="form-label" for="email">Email address</label>
  </div>
  <div class="form-outline mb-4">
    <input type="password" id="password" class="form-control" />
    <label class="form-label" for="password">Password</label>
  </div>

  <!-- Address input -->
  <div class="form-outline mb-4">
    <textarea class="form-control" id="address" rows="3"></textarea>
    <label class="form-label" for="address">Address</label>
  </div>

  <!-- Radio buttons -->
  <div class="d-flex justify-content-center mb-4">
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
      <label class="form-check-label" for="admin">Admin</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="role" id="user" value="user">
      <label class="form-check-label" for="user">User</label>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-success btn-block">Register</button>
</form>

    </div>

	<br>
  <br><br>
	<table  class="table table-striped table-bordered" style="width:100%" id="table_data">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Type</th>
		  <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John Doe</td>
          <td>johndoe@example.com</td>
          <td>Admin</td>
		  <td><span class="badge badge-primary">Active</span></td>
	
        </tr>
        <tr>
          <td>Jane Doe</td>
          <td>janedoe@example.com</td>
          <td>User</td>
		  <td><span class="badge badge-danger">Inactive</span></td>
        </tr>
      </tbody>
    </table>
			</div>
  </div>
  </div>
  
</div>
 

		
	</section>
	

	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  	<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="scripts/mdb.min.js"></script>



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
       $(document).ready(function() {
		$("#toggleFormBtn").click(function() {
			$("#registerForm").collapse('toggle');
			if ($(this).html().includes('<i class="fas fa-minus"></i> Hide Form')) {
				$(this).html('<i class="fas fa-plus"></i> Show Form');
			} else {
				$(this).html('<i class="fas fa-minus"></i> Hide Form');
			}
			});
		});
	</script>




</body>
</html>
