<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
    include 'links.php';
	?>
    <style type="text/css">
    	body {
    		background: linear-gradient(to bottom, rgba(20, 6, 252, 0.6), rgba(7, 19, 193, 0.73)), url("images/bg1.jpg");
    		background-repeat: no-repeat;
    		background-size: cover;
    		height: 100vh;
			color: #fff;
    	}
    </style>
</head>
<body>
	<div class="container">
		<div class="row" style="height: 100vh;">
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 my-auto">
				<h1 class="display-3">Welcome to G'Bank</h1>
				<a class="btn btn-outline-light btn-lg mt-3" href="./signup.php">Register Here</a>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 my-auto">
				<div id="login_div">
					<form action="loginprocess.php" method="POST">
						<h1 class="text-center p-2 text-white">LOGIN HERE</h1>
						<div class="form-group">
							<input type="email" name="email" class="form-control mb-4" value="user@mail.com" placeholder="user@mail.com" required />
						</div>
						<div class="form-group">
							<input type="password" name="pwd" id="pwd" class="form-control" value="password" placeholder="password" required />
							<input type="checkbox" class="shwPwd" name="" /> Show Password
						</div>
						<div class="form-group text-center mb-0">
							<input type="submit" value="Login" name="" class="btn btn-primary btn-block" />
						</div>
					</form>
					<div class="text-center mt-2">
						<!-- <a class="text-white" href="signup.php" style="float:left;">Sign Up</a> -->
						<a class="text-white" href="#">Forgot Password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$('.shwPwd').click(function(){
			// alert(this.type);
			var x = document.getElementById("pwd");
			if(x.type ==='password'){
				x.type = 'text';
			}
			else{
				x.type = 'password';
			}
		})
	</script>
	<script type="text/javascript" src="../bootstrap/js/popper.js"></script>

	<!-- <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> -->
</body>
</html>
