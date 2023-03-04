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
    <h1 class="fs-1 breadcrumb-title">Change Password</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="" class="text-reset bc-path">Home</a>
        <span>/</span>
        <a href="" class="text-reset bc-path active">Update Password</a>
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
	<form class="pe-2 mb-3" id="password-update">
  <input type="text"hidden name="uID" value="<?php echo $userID ?>"/>
  <!-- Email and Password inputs -->
  <div class="form-outline mb-4">
    <input type="password" name="currentPass" autocomplete="currentPass" id="currentPass" class="form-control"/>
    <label class="form-label" for="currentPass">Current Password</label>
  </div>
  <!-- Address input -->
  <div class="form-outline mb-4">
    <input class="form-control" type="password" autocomplete="newPass" name="newPass" id="newPass"/>
    <label class="form-label" for="newPass">New Password</label>
  </div>
  <div style="float:right;">
    <input type="checkbox" id="showPass"/>
    <label class="form-label" for="newPass">Show Password</label>
  </div>

 

  <!-- Submit button -->
  <button type="submit" id="updatePassword" class="btn btn-success btn-block">
    <span class="submit-text">Change Password</span>
    <span class="spinner-border spinner-border-sm  d-none" role="status" aria-hidden="true"></span>
  </button>
</form>
	


	
   
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
    $(document).ready(()=>{
      $(document).submit('updatePassword',(e)=>{
        e.preventDefault();
        let fd = new FormData($('#password-update')[0]);
        fd.append('updatePassword',true);
          // for (let [key, value] of fd.entries()) {
          // console.log(`${key}: ${value}`);}

          let currpass = fd.get("currentPass");
          let newpass = fd.get("newPass");
         if (!currpass){
          $("#currentPass").addClass("is-invalid");
         }
         else{
          $("#currentPass").removeClass("is-invalid");
         }
         if (!newpass){
          $("#newPass").addClass("is-invalid");
         }
         else{
          $("#newPass").removeClass("is-invalid");
         }
          $.ajax({
            url:"include/update-user.php",
            method:"POST",
            processData: false,
            contentType: false,
            dataType:'text',
            data:fd,
            beforeSend:()=>{
              $('button[type="submit"]').prop("disabled",true);
              $('.submit-text').addClass('d-none');
              $('.spinner-border').removeClass('d-none');
            },
            success:(data)=>{
              if (data==='success'){
                setTimeout(()=>{
                $('button[type="submit]"').prop("disabled",false);
                $('.submit-text').removeClass('d-none');
                $('.spinner-border').addClass('d-none');
                Swal.fire({
				 			  	title: 'Success',
				 			  	text: "Your password is updated",
				 			  	icon: 'success',
				 			  	confirmButtonColor: '#3085d6',
				 			  	confirmButtonText: 'OK',
				 			  	allowOutsideClick: false
				 			  }).then((result) => {
				 			  	if (result.isConfirmed) {
				 			  		window.location.href = "users.php?Updated";
				 			  	}
				 			  })
              }
              ,1500)
              }
              else{
                Swal.fire({
                title: 'Error',
                text: data,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                allowOutsideClick: false
              }).then((result) => {
				 			  	if (result.isConfirmed) {
				 			  		window.location.reload();
				 			  	}
				 			  });
              }
            },
            error: function(xhr, status, error) {
            // Handle errors
            Swal.fire({
                title: 'Error',
                text: xhr.responseText,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                allowOutsideClick: false
            }) .then((result) => {
                      if (result.isConfirmed) {
                        window.location.reload();
                      }
                    });
            }
          });
      });
    })
  </script>

</body>
</html>
