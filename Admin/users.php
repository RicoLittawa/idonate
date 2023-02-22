<?php include 'include/protect.php'?>
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
<div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
    <button type="button" id="menuBtn" class="menuBtn"><i class="fa-solid fa-bars"></i></button>
  <nav class="side-menu">
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
          <span class="text">Donors</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class='bx bxs-envelope'></i>
          <span class="text">Requests</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="stocks.php" class="nav-link">
          <i class='bx bxs-package'></i>
          <span class="text">Stocks</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <i class='bx bxs-user-plus active' ></i>
          <span class="text">Users</span>
        </a>
      </li>
      <li class="nav-item log-item">
        <a href="./include/logout.php" class="nav-link log-link">
        	<i class="fa-solid fa-right-from-bracket"></i>
          <span class="text">Logout</span>
       		</a>
     	</li>
    </ul>
  </nav>
 
    </div>

<!--Main content -->
  <div class="main-content">
  <div class="content">
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






  <div class="custom-container pb-3">
  <div class="card">
  <div class="card-body overflow-auto">
 <div class="mt-2">

 <span><button class="btn btn-success" type="button" style=" width:200px;height:50px;float:right;"
				id="toggleFormBtn">
				<i class="fas fa-add"></i>Show Form</button></span>
 </div>
	
			<br>
 <div id="registerForm" class="collapse mt-5" data-duration="500">
	<form class="pe-2 mb-3" id="add-user">

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
    <div class="col">
      <div class="form-outline">
        <input type="text" id="position" class="form-control" placeholder="e.g. Brgy Captain/Employee"/>
        <label class="form-label" for="position">Position</label>
      </div>
    </div>
  </div>

  <!-- Email and Password inputs -->
  <div class="form-outline mb-4">
    <input type="email" id="email" class="form-control" />
    <label class="form-label" for="email">Email address</label>
  </div>

  <div class="input-group form-outline mb-4">
   <input type="password" class="form-control" id="password">
  <div class="input-group-append">
      <button class="btn btn-success h-100" type="button" id="generatePasswordBtn">Generate Password</button>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary h-100" type="button" id="togglePass">
      <i class="fa fa-eye"></i>    </button>
  </div>
  <label class="form-label" for="password">Password</label>
</div>

  <!-- Address input -->
  <div class="form-outline mb-4">
    <input class="form-control" id="address" rows="3"></input>
    <label class="form-label" for="address">Address</label>
  </div>

  <!-- Radio buttons -->
  <div class="d-flex justify-content-center mb-4">
    <div class="form-check form-check-inline">
      <input class="form-check-input typeCheck" type="radio" name="role" id="admin" value="admin">
      <label class="form-check-label" for="admin">Admin</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input typeCheck" type="radio" name="role" id="user" value="user">
      <label class="form-check-label" for="user">User</label>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit " id="adduserBtn" class="btn btn-success btn-block">Register</button>
</form>

    </div>

	<br>
  <br><br>
	<table  class="table table-striped table-bordered" id="table_data">
      <thead>
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Position</th>
          <th>Email</th>
          <th>Address</th>
          <th>Role</th>
		  <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        require_once 'include/connection.php';
        $sql= 'SELECT * from adduser';
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        $result= $stmt->get_result();
        while($row= $result->fetch_assoc()):
        ?>
        <tr>
          <td><?php echo $row['firstname']; ?></td>
          <td><?php echo $row['lastname']; ?></td>
          <td><?php echo $row['position']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['address']; ?></td>
          <?php if($row['role']==='admin') {?>
          <td><span class="badge rounded-pill badge-primary">Admin</span></td>
          <?php }else{?>
          <td><span class="badge rounded-pill badge-info">User</span></td>
            <?php }?>
          <?php if($row['status']==='active') {?>
          <td><span class="badge rounded-pill badge-success">Active</span></td>
          <?php }else{?>
          <td><span class="badge rounded-pill badge-danger">Not active</span></td>
            <?php }?>
          
         
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
			</div>
  </div>
  </div>
  
</div>

  </div>
  

	
  </div>
</div>




	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/main.js"></script>


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

  <script>
    $(document).ready(function(){
      function generatePassword() {
    const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:\'",.<>/?`~';
    let password = '';
    for (let i = 0; i < 8; i++) {
      password += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return password;
  }
  
  var passwordInput = $('#password');
  
  $('#generatePasswordBtn').click(function() {
  passwordInput.val(generatePassword());
  $('label[for="password"]').hide();
});

$('#password').keyup(function() {
  $('label[for="password"]').toggle($('#password').val() === '');
});

$('#togglePass').click(function(){
  if (passwordInput.attr('type') === 'password') {
    passwordInput.attr('type', 'text');
  } else {
    passwordInput.attr('type', 'password');
  }
})

$('#add-user').submit(function(e) {
  e.preventDefault();

  // Get form field values
  var fname = $('#fname').val();
  var lname = $('#lname').val();
  var position = $('#position').val();
  var email = $('#email').val();
  var password = $('#password').val();
  var address = $('#address').val();
  var selectedValue = $('input[name="role"]:checked').val();

  // Check for empty required fields
  if (!fname) {
    $('#fname').addClass('is-invalid');
    return false;
  } else {
    $('#fname').removeClass('is-invalid');
  }

  if (!lname) {
    $('#lname').addClass('is-invalid');
    return false;
  } else {
    $('#lname').removeClass('is-invalid');
  }

  if (!position) {
    $('#position').addClass('is-invalid');
    return false;
  } else {
    $('#position').removeClass('is-invalid');
  }

  if (!email) {
    $('#email').addClass('is-invalid');
    return false;
  } else {
    $('#email').removeClass('is-invalid');
  }

  if (!password) {
    $('#password').addClass('is-invalid');
    return false;
  } else {
    $('#password').removeClass('is-invalid');
  }

  if (!address) {
    $('#address').addClass('is-invalid');
    return false;
  } else {
    $('#address').removeClass('is-invalid');
  }

  if (!selectedValue) {
    $('input[name="role"]').addClass('is-invalid');
    return false;
  } else {
    $('input[name="role"]').removeClass('is-invalid');
  }

  // Submit the form data with AJAX
  var data = {
    submitBtn: '',
    fname: fname,
    lname: lname,
    position: position,
    email: email,
    password: password,
    address: address,
    selectedValue: selectedValue
  };

  $.ajax({
    type: 'POST',
    url: 'include/register.inc.php',
    data: data,
    success: function(data) {
      alert(data);
      window.location.reload();
    }
  });
});

    })
  </script>

</body>
</html>
