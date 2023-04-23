<?php require_once 'include/protect.php';
require_once 'include/profile.inc.php';
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
        <a href="request.php" class="nav-link">
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
    <h1 class="fs-1 breadcrumb-title">Update Password</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="#" class="text-muted bc-path">Home</a>
        <span>/</span>
        <a href="#" class="text-reset bc-path active">Update Password</a>
      </h6>  
    </nav>
  </div>
  <div class="ms-auto">
    <div class="dropdown">
  <a
    class="dropdown-toggle border border-0"
    id="dropdownMenuButton"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
  >
  <?php if ($profile==null){ ?>
    <img src="img/default-admin.png" class="rounded-circle w-100"alt="Avatar" />
  <?php }else{?>
    <img src="include/profile/<?php echo htmlentities($profile); ?>" class="rounded-circle avatar-size" alt="Avatar" />
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
  <div class="d-flex justify-content-end">
    <input type="checkbox" id="showPass"/>
    <label class="ps-1" for="newPass">Show Password</label>
  </div>

 

  <!-- Submit button -->
  <button type="submit" class="btn btn-success btn-block btn-rounded my-3">
    <span class="submit-text">Change</span>
    <span class="spinner-border spinner-border-sm  d-none" aria-hidden="true"></span>
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
      $('#password-update').submit((e)=>{
        e.preventDefault();
        let fd = new FormData($('#password-update')[0]);
        fd.append('updatePassword',true);
          // for (let [key, value] of fd.entries()) {
          // console.log(`${key}: ${value}`);}

          let currpass = fd.get("currentPass");
          let newpass = fd.get("newPass");
          let isInvalid= false;
         if (!currpass){
          $("#currentPass").addClass("is-invalid");
          isInvalid=true;
         }
         else{
          $("#currentPass").removeClass("is-invalid");
         }
         if (!newpass){
          $("#newPass").addClass("is-invalid");
          isInvalid=true;
         }
         else{
          $("#newPass").removeClass("is-invalid");
         }

         if (isInvalid){
          return false
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
              $('.submit-text').text('Changing...');
              $('.spinner-border').removeClass('d-none');
            },
            success:(data)=>{
              if (data==='success'){
                setTimeout(()=>{
                $('button[type="submit"]').prop("disabled",false);
                $('.submit-text').text('Change');
                $('.spinner-border').addClass('d-none');
                Swal.fire({
				 			  	title: 'Success',
				 			  	text: "Your password is updated",
				 			  	icon: 'success',
				 			  	confirmButtonColor: '#20d070',
				 			  	confirmButtonText: 'OK',
				 			  	allowOutsideClick: false
				 			  })
                setTimeout(()=>{
                  window.location.href = "users.php?Updated";
                },1000)
              }
              ,1500)
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
              $('button[type="submit"]').prop("disabled",false);
              $('.submit-text').text('Change');
              $('.spinner-border').addClass('d-none');
              $('#currentPass').val('');
              $('#newPass').val('');
              $('#currentPass').addClass('is-invalid');
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