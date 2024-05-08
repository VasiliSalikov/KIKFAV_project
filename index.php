	<!DOCTYPE html>
	<html>
	<head>
	    <title>Online Ordering System</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">

		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>

	<?php
		//opcache_reset(); //
		session_start();


		// //development area

			// echo '<pre>';

		 	// print_r($_SERVER["REQUEST_URI"]);
	   	// echo '</pre>';


		// 	echo '<pre>';

		// 	print_r($_SESSION);
	  //   	echo '</pre>';
	  //   	$user_message;


		include 'navigation_menu.php';

		echo '<div class="container">';

		if ($_SESSION['loggedin']=='yes')
		{
				$user_message = '<p>You are able to take a look at <a href="LINK">Products Page</a>, <a href="LINK">Account</a> and <a href="LINK">Basket</a><br> or <a href="session_clear.php">Logout</a></p>';
		}
		else
		{
			$user_message = '<p>You are able to take a look at <a href="LINK">Products Page</a> <br> but you will have to <a href="login.php">Login</a> or <a href="register.php">Register</a> to see Account and Basket</p>';
		};

		echo '<div class="header">
	            <h1>375 LTD. <br> Supply Ordering System</h1>';
		echo $user_message;
		

	?>	         					
			</div>
				<div class="picture-links">
				<img src="images\stationary.png" alt="No Image"></a>
	            <img src="images\books.webp" alt="No Image"></a>
			</div>
	</div>
	</body>
	</html>


