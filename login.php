<!Doctype html>
<html>
	<head>
		<title>
			SQL Login
		</title>
		<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->

		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<?php
			include 'navigation_menu.php';
		?>
		
		<!-- Login Form -->
		<div class="container">
				<div class="row">
					<div class="col">
						<form name="loginform" method="post" action="login_script.php">
							<h5>Please Login</h5>
							<div class="username">
								<input name="username" type="text" size="40" maxlength="40" placeholder="Username" class="mb-2">
							</div>
							<div class="password">
								<input name="password" type="password" size="40" maxlength="40" placeholder="Password" class="mb-2">
							</div>
						    <div class="row">
						        <div class="col">
						            <div class="btn-group mb-3" role="group" aria-label="Horizontal button group">
						                <button type="submit" class="btn btn-primary mr-2" name="Submit">Submit</button>
						                <button type="reset" class="btn btn-primary" name="Submit2">Reset</button>
						            </div>
						        </div>
						    </div>
						</form>
						<p>Don't have an account? <br> Please <a href="register.html"><b>Register</b></a></p>
					</div>
					<div class="col">
						<div class="image">
							<img src="images/login.png" alt="unable to load image" style="width: 300px;" />
						</div>
						
					</div>		
			</div>
		</div>
    </body>
</html>
