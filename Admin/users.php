<?php include 'include/protect.php';
require_once 'include/connection.php';
$sql= "SELECT firstname,profile FROM adduser WHERE uID=? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('i',$userID );
try{
  $stmt->execute();
  $result= $stmt->get_result();
  if($result->num_rows == 0) {
    echo "Invalid email or password.";
  }
  else{
    while($row= $result->fetch_assoc()){
     $firstname=  $row['firstname'];
     $profile=  $row['profile'];

    }
  }

}

catch(Exception $e){
  echo "Error". $e->getMessage();

}
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
    </ul>
  </nav>
 
    </div>

<!--Main content -->
  <div class="main-content">
  <!--Header -->
  <div class="mb-4 custom-breadcrumb">
  <div class="crumb">
    <h1 class="fs-1 breadcrumb-title">User Details</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="" class="text-reset bc-path">Home</a>
        <span>/</span>
        <a href="" class="text-reset bc-path active">User Details</a>
      </h6>  
    </nav>
  </div>
  <div style="margin-left: auto;">
    <div class="dropdown">
  <a
    class="dropdown-toggle"
    id="dropdownMenuButton"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
    style="border: none;"
  >
  <?php if ($profile==null){ ?>
    <img src="img/default-admin.png" class="rounded-circle" style="width: 100px; border:1px green;" alt="Avatar" />
  <?php }else{?>
    <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle" style="width: 100px; height:100px; object-fit: cover; border:1px green;" alt="Avatar" />
  <?php }?>

  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><h6 class="dropdown-item">Hello <?php echo htmlentities($firstname);?>!</h6></li>
    <li><a class="dropdown-item" href="updateusers.php"><i class="fa-solid fa-pen"></i> Update Profile</a></li>
    <li><a class="dropdown-item" href="updatepassword.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
    <li><a class="dropdown-item" href="include/logout.php"><i class="fa-sharp fa-solid fa-power-off"></i> Logout</a></li>
  </ul>
</div>
  </div>
</div>
 <!--Header -->

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
  <button type="submit " class="btn btn-success btn-block">
  <span class="submit-text">Create</span>
  <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
  </button>
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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
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
          <?php if($row['status']==='offline') {?>
          <td><span class="badge rounded-pill badge-danger">Offline</span></td>
          <?php }else{?>
          <td><span class="badge rounded-pill badge-success">Active</span></td>
            <?php }?>
          <td><div class="row"><a class="col" href=""><i style="color:red;" class="fa-solid fa-trash"></i></a>
          <a class="col" href=""><i style="color:green;" class="fa-solid fa-pen-to-square"></i></a></div></td>
          
         
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




	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
  <script src="scripts/main.js"></script>
  <script src="scripts/sweetalert2.all.min.js"></script>


	<script>
       $(document).ready(()=> {
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
    $(document).ready(()=>{
      const generatePassword=()=> {
    const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:\'",.<>/?`~';
    let password = '';
    for (let i = 0; i < 8; i++) {
      password += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return password;
  }
  
  let passwordInput = $('#password');
  
  $('#generatePasswordBtn').click(()=> {
  passwordInput.val(generatePassword());
  $('label[for="password"]').hide();
});

$('#password').keyup(()=> {
  $('label[for="password"]').toggle($('#password').val() === '');
});

$('#togglePass').click(function(){
  if (passwordInput.attr('type') === 'password') {
    passwordInput.attr('type', 'text');
  } else {
    passwordInput.attr('type', 'password');
  }
})

$('#add-user').submit((e)=> {
  e.preventDefault();

  // Get form field values
  let fname = $('#fname').val();
  let lname = $('#lname').val();
  let position = $('#position').val();
  let email = $('#email').val();
  let password = $('#password').val();
  let address = $('#address').val();
  let selectedValue = $('input[name="role"]:checked').val();


  /**Validations */
  let emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  let isInvalid = false;

  // Check for empty required fields
  if (!fname) {
    $('#fname').addClass('is-invalid');
    isInvalid=true;
  } else {
    $('#fname').removeClass('is-invalid');
  }

  if (!lname) {
    $('#lname').addClass('is-invalid');
    isInvalid=true;
  } else {
    $('#lname').removeClass('is-invalid');
  }

  if (!position) {
    $('#position').addClass('is-invalid');
    isInvalid=true;
  } else {
    $('#position').removeClass('is-invalid');
  }

  if (!email) {
    $('#email').addClass('is-invalid');
    isInvalid=true;
  }
  else if(emailVali.test(email) == false){
    Swal.fire({
    title: 'Warning',
    text: 'Invalid email address',
    icon: 'warning',
    confirmButtonColor: '#20d070' // Change the color value here
    });
    $('#email').addClass('is-invalid');
    isInvalid = true;
    }
  else {
    $('#email').removeClass('is-invalid');
  }

  if (!password) {
    $('#password').addClass('is-invalid');
    isInvalid=true;
  } else {
    $('#password').removeClass('is-invalid');
  }

  if (!address) {
    $('#address').addClass('is-invalid');
    isInvalid=true;
  } else {
    $('#address').removeClass('is-invalid');
  }

  if (!selectedValue) {
    $('input[name="role"]').addClass('is-invalid');
    isInvalid=true;
  } else {
    $('input[name="role"]').removeClass('is-invalid');
  }

  // Submit the form data with AJAX
  let data = {
    submitBtn: '',
    fname: fname,
    lname: lname,
    position: position,
    email: email,
    password: password,
    address: address,
    selectedValue: selectedValue
  };
  if (isInvalid){
    return false;
  }
  $.ajax({
    type: 'POST',
    url: 'include/register.inc.php',
    data: data,
    beforeSend:()=>{
            $('button[type="submit"]').prop('disabled', true);
            $('.submit-text').text('Creating...');
            $('.spinner-border').removeClass('d-none');
          },
    success: (data) =>{
      if (data==='success'){
        setTimeout(() => {
            // Enable the submit button and hide the loading animation
            $('button[type="submit"]').prop('disabled', false);
            $('.submit-text').text('Create');            
            $('.spinner-border').addClass('d-none');
            Swal.fire({
				 			  	title: 'Success',
				 			  	text: "Account is successfully created",
				 			  	icon: 'success',
				 			  	confirmButtonColor: '#20d070',
				 			  	confirmButtonText: 'OK',
				 			  	allowOutsideClick: false
				 			  })
          setTimeout(()=>{
            $('#fname').val("");
            $('#lname').val("");
            $('#position').val("");
            $('#email').val("");
            $('#password').val("");
            $('#address').val("");
            $('input[name="role"]').prop('checked', false);
          },1000)
          }, 500);
            }
            else if (data=='Error: Email already exists'){
              Swal.fire({
                title: 'Error',
                text: data,
                icon: 'error',
                confirmButtonColor: '#20d070',
                confirmButtonText: 'OK',
                allowOutsideClick: false
              })
              $('button[type="submit"]').prop('disabled', false);
              $('.submit-text').text('Create');            
              $('.spinner-border').addClass('d-none');
              $('#email').val('');
              $('#email').addClass('is-invalid');
            }
            else{
              Swal.fire({
                title: 'Error',
                text: data,
                icon: 'error',
                confirmButtonColor: '#20d070',
                confirmButtonText: 'OK',
                allowOutsideClick: false
              })
            }
    },
    error: (xhr, status, error)=> {
        // Handle errors
        Swal.fire({
            title: 'Error',
            text: xhr.responseText,
            icon: 'error',
            confirmButtonColor: '#20d070',
            confirmButtonText: 'OK',
            allowOutsideClick: false
        })
    }
  });
});

    })
  </script>

</body>
</html>
