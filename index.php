<!DOCTYPE html>
<html lang="en">

<head>
<style>
img {
  opacity: 0.4;
}

</style>
	<meta charset="UTF-8">
	<link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="login.css">
	<title>Login Page</title>
</head>

<body>
<img src="logo.jpg" alt="logo" width="1370" height="500">

	<form action="validate.php" method="post">
		<div class="login-box">
			<h1>Login</h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Username"
						name="username" value="">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password"
						name="password" value="">
			</div>

			<input class="button" type="submit"
					name="login" value="Sign In">

                    <input type="checkbox" checked="checked" name="remember"> Remember me
					<span class="forgot-password">
          <br><br> <a href="" title="Forgot Password" id="link-reset">Forgot Password?</a> </br></br>
    </div>
	
	</form>
</body>

</html>
