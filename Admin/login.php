<?php 
 session_start();

 
  if(isset($_SESSION['user']['logged_in']) && ($_SESSION['user']['role'])=='admin') {
      header("Location: adminpage.php");  
      exit();
  }else if (isset($_SESSION['user']['logged_in']) && ($_SESSION['user']['role'])=='user'){
  	header("Location: userlandingpage.php");  
      exit();
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&family=Kantumruy+Pro:wght@300&family=Lato:wght@300&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


<div class="loading-container">
<div id="loader">
  <div class="cell d-0"></div>
  <div class="cell d-1"></div>
  <div class="cell d-2"></div>
  <div class="cell d-1"></div>
  <div class="cell d-2"></div>
  <div class="cell d-2"></div>
  <div class="cell d-3"></div>
  <div class="cell d-3"></div>
  <div class="cell d-4"></div>
</div>
</div>

		<div class="container-login100">

			<div class="wrap-login100">
				<div class="login100-pic" >
					<img src="img/batangascitylogo.png" alt="IMG">
				</div>

				<form class="login100-form" id="login-form">
					<span class="login100-form-title">
						Login
					</span>
						<div class="wrap-input100">
						<input class="input100 is-invalid" type="text" id="userEmail" name="userEmail" placeholder="Email" autocomplete>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					
					</div>
					<div class="wrap-input100">
						<input class="input100" type="password" name="userPassword" id="userPassword" placeholder="Password" autocomplete>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
					<button type="submit" name="login-submit" class="login100-form-btn">
						<span class="submit-text">Login</span>
					</button>
					<!-- <span id="loading"></span> -->
			
					</div>
					<div class="pt-3"><a href="">Forgot password?</a></div>
					
					
				</form>
			</div>
		</div>

	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script type="text/javascript" src="scripts/mdb.min.js"></script>
	<script src="scripts/sweetalert2.all.min.js"></script>

	<script>
		$(document).ready(()=>{
			$('#login-form').on('submit',(e)=>{
				e.preventDefault();	
				let userEmail= $('#userEmail').val();
				let userPassword = $('#userPassword').val();

				let isInvalid= false;
				let emailVali = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

				let data= {
					submitBtn:'',
					userEmail:userEmail,
					userPassword:userPassword,
				}
				if (!userEmail){
					$('#userEmail').css('border','1px solid #c80000');
					isInvalid=true;
				}
				else if(emailVali.test(userEmail) == false){
					Swal.fire({
					title: 'Warning',
					text: 'Invalid email address',
					icon: 'warning',
					confirmButtonColor: '#20d070' // Change the color value here
					});
					$('#userEmail').css('border','1px solid #c80000');
					isInvalid=true;
				}
				else{
					$('#userEmail').css('border','none');
				}
				if(!userPassword){
					$('#userPassword').css('border','1px solid #c80000');
					isInvalid=true;
				}
				else{
					$('#userPassword').css('border','none');
				}

				if(isInvalid){
					return false;
				}

				$.ajax({
					url:"include/login.inc.php",
					method:"POST",
					data:data,
					beforeSend:()=>{
						$('button[type="submit"]').prop('disabled', true);
						$('#loader').addClass('loader');
						$('.container-login100').addClass('blur-filter-class')
					},
					success:(data)=>{
						if (data==='admin'){
						 	setTimeout(() => {
								// Enable the submit button and hide the loading animation
						 		$('button[type="submit"]').prop('disabled', false);
						 		$('#loader').removeClass('loader');
						 		Swal.fire({
				 		 	  	title: 'Hello Admin',
				 		 	  	text: "You are logged in",
				 		 	  	icon: 'success',
				 		 	  	confirmButtonColor: '#20d070',
				 		 	  	confirmButtonText: 'OK',
				 		 	  	allowOutsideClick: false
				 		 	  })
						 	   setTimeout(()=>{
						 		window.location.href="./Dashboard/Dashboard.php";
						 	},1000)
         				 	 }, 1500);
							
						  }
						  if (data==='user'){
						 	setTimeout(() => {
								$('button[type="submit"]').prop('disabled', false);
						 		$('#loader').removeClass('loader');
						 		Swal.fire({
				 		 	  	title: 'Hello User',
				 		 	  	text: "You are logged in",
				 		 	  	icon: 'success',
				 		 	  	confirmButtonColor: '#20d070',
				 		 	  	confirmButtonText: 'OK',
				 		 	  	allowOutsideClick: false
				 		 	  })
						 	   setTimeout(()=>{
						 		window.location.href="../Admin/UsersModule/UserCreateRequest.php";
						 	},1000)
         				 	 }, 1500);
						  }
						  if (data== "Invalid email or password."){
							setTimeout(()=>{
								Swal.fire({
						 		title: 'Error',
						 		text: data,
						 		icon: 'error',
						 		confirmButtonColor: '#20d070',
						 		confirmButtonText: 'OK',
						 		allowOutsideClick: false
						 	})
						 	$('button[type="submit"]').prop('disabled', false);
						 	$('#loader').removeClass('loader'); 
							$('.container-login100').removeClass('blur-filter-class')
						 	$('#userEmail').val('');
						 	$('#userPassword').val('');
						 	$('#userEmail').css('border','1px solid #c80000');
						 	$('#userPassword').css('border','1px solid #c80000');
							},1500)
						 	
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
				})
			})
		})
	</script>
</body>
</html>
