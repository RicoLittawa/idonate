<?php include 'include/protect.php';
require_once 'include/connection.php';

$sql= "SELECT * FROM adduser WHERE uID=? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('i',$userID);
try{
  $stmt->execute();
  $result= $stmt->get_result();
  if($result->num_rows == 0) {
    echo "Invalid email or password.";
  }
  else{
    while($row= $result->fetch_assoc()){
     $firstname=  $row['firstname'];
     $lastname=  $row['lastname'];
     $position=  $row['position'];
     $email=  $row['email'];
     $address=  $row['address'];
     $profile=  $row['profile'];
     $role=  $row['role'];
     

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
  <style>.picture-container{
    position: relative;
    cursor: pointer;
    text-align: center;
}
.picture{
    width: 106px;
    height: 106px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}
.picture:hover{
    border-color: #20d070;
}
.content.ct-wizard-green .picture:hover{
    border-color: #05ae0e;
}
.content.ct-wizard-blue .picture:hover{
    border-color: #3472f7;
}
.content.ct-wizard-orange .picture:hover{
    border-color: #ff9500;
}
.content.ct-wizard-red .picture:hover{
    border-color: #ff3b30;
}
.picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
}

.picture-src{
    width: 100%;
    height: 100%;
    object-fit: cover;
  
    
}</style>
  
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
    <h1 class="fs-1 breadcrumb-title">Update Account</h1>
    <nav class="bc-nav d-flex">
      <h6 class="mb-0">
        <a href="" class="text-reset bc-path">Home</a>
        <span>/</span>
        <a href="" class="text-reset bc-path active">Update Account</a>
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


	<form class="pe-2 mb-3" id="update-user"  enctype="multipart/form-data">
    <!--Change profile -->
    <div class="mb-5" style="border:1px;">
        <div class="picture-container">
            <div class="picture">
                <?php if($profile==null){ ?>
                <img src="img/default-admin.png" class="picture-src" id="wizardPicturePreview" title="">
                <?php } else{?>
                  <img src="include/profile/<?php echo htmlentities($profile) ?>" class="picture-src" id="wizardPicturePreview" title="">
                <?php }?>
                <input type="file" name="profileImg" id="wizard-picture" value="<?php echo htmlentities($profile)  ?>">
            </div>
            <label>Upload image <i class="fa-sharp fa-solid fa-file-arrow-up"></i></label>

        </div>
    </div>

  <input type="text" id="uID" name="uID" value="<?php echo $userID?>" hidden />
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <input type="text" id="fname" name="fname" class="form-control" value="<?php echo  htmlentities($firstname );?>"/>
        <label class="form-label" for="fname">First name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text" id="lname" name="lname" class="form-control" value="<?php echo htmlentities($lastname);?>"/>
        <label class="form-label" for="lname">Last name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <input type="text" id="position" name="position" class="form-control" placeholder="e.g. Brgy Captain/Employee" value="<?php echo htmlentities($position)?>"/>
        <label class="form-label" for="position">Position</label>
      </div>
    </div>
  </div>

  <!-- Email and Password inputs -->
  <div class="form-outline mb-4">
    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlentities($email)?>"/>
    <label class="form-label" for="email">Email address</label>
  </div>
  <!-- Address input -->
  <div class="form-outline mb-4">
    <input class="form-control" id="address" name="address" value="<?php echo htmlentities($address)?>"/>
    <label class="form-label" for="address">Address</label>
  </div>

 

  <!-- Submit button -->
  <button type="submit"  class="btn btn-success btn-block">
  <span class="submit-text">Update</span>
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
      $('#update-user').submit((e)=>{
          e.preventDefault();

    
        let fd = new FormData($('#update-user')[0]);//JavaScript object that allows you to 
        //easily construct and send form data (including files) via AJAX.
        fd.append('updateBtn',true);

        //  for (let [key, value] of fd.entries()) {
        //  console.log(`${key}: ${value}`);}

        //validation
        let fname = fd.get('fname');
        let lname = fd.get('lname');
        let position = fd.get('position');
        let email = fd.get('email');
        let address = fd.get('address');
        
        /**Validation */
        let isInvalid= false

        let fileInput = $('input[type="file"]');
        let file = fileInput[0].files[0];
        if (file) {
          let extension = file.name.split('.').pop().toLowerCase();
          if (['gif', 'png', 'jpg', 'jpeg'].indexOf(extension) === -1) {
            // Invalid file extension
            // Display an error message or highlight the input field
            Swal.fire('Image', "Invalid file extension.",'warning');
            fileInput.val('');
            isInvalid=true;
          }
        } 
        if (!fname){
          $('#fname').addClass('is-invalid');
          isInvalid=true;
        }
        else{
          $('#fname').removeClass('is-invalid');
        }
        if (!lname){
          $('#lname').addClass('is-invalid');
          isInvalid=true;
        }
        else{
          $('#lname').removeClass('is-invalid');
        }
        if (!position){
          $('#position').addClass('is-invalid');
          isInvalid=true;
        }
        else{
          $('#position').removeClass('is-invalid');
        }
        if (!email){
          $('#email').addClass('is-invalid');
          isInvalid=true;
        }
        else{
          $('#email').removeClass('is-invalid');
        }
        if (!address){
          $('#address').addClass('is-invalid');
          isInvalid=true;
        }
        else{
          $('#address').removeClass('is-invalid');
        }

        if(isInvalid){
          return false;
        }
        
        $.ajax({
          url:"include/update-user.php",
          method:"POST",
          processData: false,
          contentType: false,
          dataType:'text',
          data:fd,
          beforeSend:()=>{
            $('button[type="submit"]').prop('disabled', true);
            $('.submit-text').text('Updating...');
            $('.spinner-border').removeClass('d-none');

          },
          success:(data)=>{
            if (data==='success'){
              setTimeout(() => {
            // Enable the submit button and hide the loading animation
            $('button[type="submit"]').prop('disabled', false);
            $('.submit-text').text('Update');
            $('.spinner-border').addClass('d-none');
            Swal.fire({
				 			  	title: 'Success',
				 			  	text: "Your profile is updated",
				 			  	icon: 'success',
				 			  	confirmButtonColor: '#3085d6',
				 			  	confirmButtonText: 'OK',
				 			  	allowOutsideClick: false
				 			  }).then((result) => {
				 			  	if (result.isConfirmed) {
				 			  		window.location.href = "users.php?Updated";
				 			  	}
				 			  })
          }, 1500);
            }
          else if (data == 'Error: Email already exists'){
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
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK',
              allowOutsideClick: false
            })
          }
            
          },
          error: (xhr, status, error)=>{
            // Handle errors
            Swal.fire({
                title: 'Error',
                text: xhr.responseText,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                allowOutsideClick: false
            })
        }
        })
      })
    });
  </script>
  <script>
    $(document).ready(()=>{
// Prepare the preview for profile picture
    $("#wizard-picture").change(()=>{
        readURL(this);
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = (e)=> {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
  </script>
</body>
</html>
