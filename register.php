<!DOCTYPE html>
<html>
	<head>
		<title>Register Account</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
		<?php
			include 'navigation_menu.php';
		?>
				<div class="container">
				<div class="row">
					<div class="col">
						<form class="register-form" action="register_script.php" method="POST">
							<h5>Register To Create An Account</h5>
							<div>
                				<input type="text" name="username" size="40" maxlength="40" placeholder="Username" class="mt-2 mb-2" required>
							</div>
							<div>
                				<input type="password" name="password" size="40" maxlength="40" placeholder="Password" class="mb-2" required>
							</div>
                			<div>
			                	<input type="email" name="email" size="40" maxlength="40" placeholder="Email" class="mb-2" required>
                			</div>
			                <div>
			                	<input type="text" name="forename" size="40" maxlength="40" placeholder="Forename" class="mb-2" required>
			                </div>
			                <div>
			                	<input type="text" name="surname" size="40" maxlength="40" placeholder="Surname" class="mb-2" required>
			                </div>
			                <div>
			                	<input type="text" name="street_address" size="40" maxlength="40" placeholder="Street Address" class="mb-2" required>
			                </div>
			                <div>
			                	<input type="text" name="city" size="40" maxlength="40" placeholder="City" class="mb-2" required>
			                </div>
			                <div>
			                	<input type="text" name="postcode" size="40" maxlength="40" placeholder="Postcode" class="mb-2" required>
			                </div>   
                			<button type="submit" class="btn btn-primary">Register</button>
						</form>
					</div>
					<div class="col">
						<div class="image">
							<img src="images/register.png" alt="unable to load image" style="width: 300px;" />
						</div>
						
					</div>		
			</div>
		</div>
	
	</body>
</html>