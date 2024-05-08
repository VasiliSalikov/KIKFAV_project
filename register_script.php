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
					include 'sql.php';

					echo '<div class="container">';

					$username=$_POST['username'];
					$password=$_POST['password'];
					$email=$_POST['email'];
					$forename=$_POST['forename'];
					$surname=$_POST['surname'];
					$street_address=$_POST['street_address'];
					$city=$_POST['city'];
					$postcode=$_POST['postcode'];
					$access_level = 0;


					$password=md5($password);

					// Check if a user with the same username or email already exists
					$stmt = $conn->prepare("SELECT * FROM tw_users WHERE username = ? OR email = ?");
					$stmt->bind_param("ss", $username, $email);
					$stmt->execute();
					$result = $stmt->get_result();

					echo 	'<div class="row">';
					echo 		'<div class="col">';

					if ($result->num_rows > 0) 
					{
						// If a user with the same username or email already exists, display an error message
		    			echo 		'<h5 style="margin-top: 100px;">A user with the same username or email already exists</h5>';
		    			echo 		'<a class="btn btn-primary" href="register.php">Try again</a>';
		    			echo 	'</div>';
		    			echo 	'<div class="col">';
		    			echo 		'<img src="images/fail.png" alt="unable to load image" style="width: 300px;"/>';
		    			echo 	'</div>';

		    		}
		    		else
		    		{
						// echo '<pre>';
						// 		print_r($_POST);
						// echo '</pre>';
						$stmt = $conn->prepare("INSERT INTO tw_users(
											username,
											password,
											email,
											forename,
											surname,
											street_address,
											city,
											postcode,
											access_level
											) VALUES (?,?,?,?,?,?,?,?,?)");

						$stmt->bind_param("ssssssssi", $username,$password,$email,$forename,$surname,$street_address,$city,$postcode, $access_level);

						$result = $stmt->execute(); // выполнение запроса и сохранение результата

						if($result) 
						{
			    			echo '<h5 style="margin-top: 100px;">User created successfully, now you can login</h5>';
			    			echo 		'<a class="btn btn-primary" href="login.php">Login</a>';
			    			echo 	'</div>';
			    			echo 	'<div class="col">';
			    			echo 		'<img src="images/success.webp" alt="unable to load image" style="width: 300px;"/>';
			    			echo 	'</div>';
						} 
						else 
						{
			    			echo '<h5 style="margin-top: 100px;">Error inserting user.' . $conn->error . '</h5>';
				    		echo 		'<a class="btn btn-primary" href="register.php">Try again</a>';
			    			echo 	'</div>';
			    			echo 	'<div class="col">';
			    			echo 		'<img src="images/fail.png" alt="unable to load image" style="width: 300px;"/>';
			    			echo 	'</div>';
						}
					}
					$stmt->close();
					$conn->close();

		?>
		</div>
	</body>
</html>