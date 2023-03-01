<?php session_start() ?>
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
	
	<div class="">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic" >
					<img src="img/batangascitylogo.png" alt="IMG">
				</div>

				<form class="login100-form" id="login-form" method="POST" action="include/login.inc.php" >
					<span class="login100-form-title">
						Login
					</span>
					<div class="pb-2 d-flex justify-content-center" >
						<?php if (isset($_SESSION['error'])):?>
						<p style="color:red"><?php
							echo $_SESSION['error'];
							unset($_SESSION['error']); ?></p>
						<?php endif?>
					</div>
						<div class="wrap-input100">
				
						<input class="input100 is-invalid" type="text" id="userEmail" name="userEmail" placeholder="Email" autocomplete="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					
					</div>





					<div class="wrap-input100">
						<input class="input100" type="password" name="userPassword" placeholder="Password" autocomplete="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
					<button type="submit" name="login-submit" class="login100-form-btn">Login</button>
					<!-- <span id="loading"></span> -->
			
					</div>
					<div class="pt-3"><a href="">Forgot password?</a></div>
					
					
				</form>
			</div>
		</div>
	</div>
	
	

	
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>	
	<script type="text/javascript" src="scripts/mdb.min.js"></script>

</body>
</html>