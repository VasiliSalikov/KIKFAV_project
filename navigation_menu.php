<?php
	session_start();
	//get and save URL of current page 
	$current_page = $_SERVER["REQUEST_URI"];
	//echo $current_page;

	//declaration all the pages for navigation
	$nav_menu_array = array(
    	"/index.php" => '<a class="nav-link" href="index.php">Home</a>',
    	"/products.php" => '<a class="nav-link" href="products.php">Products</a>',
    	"/account.php" => '<a class="nav-link disabled" href="account.php">Account</a>',
    	"/basket.php" => '<a class="nav-link" href="basket.php">Basket</a>',
    	"/login.php" => '<a class="nav-link" href="login.php">Login</a>',
    	"/register.php" => '<a class="nav-link" href="register.php">Register</a>',
    	"/logout.php" => '<a class="nav-link" href="session_clear.php">Logout</a>'
	);

	$original_string = $nav_menu_array[$current_page];
	$insert_content = " active";
	$insert_position = 18;

	function add_attribute($altering_string, $content, $position)
	{
		//recieve the string (html element) which need to add attribute
		//andaltering it to add attribute 
		if ($altering_string != "")
		{
			$part1 = substr($altering_string, 0, $position);
			$part2 = substr($altering_string, $position);

			$altering_string = $part1.$content.$part2;
		}
		return $altering_string;
	}


	$nav_menu_array[$current_page] = add_attribute($nav_menu_array[$current_page], $insert_content, $insert_position);

	//change the substring which need to insert to disabled value
	$insert_content = " disabled";

	//if user is logged in wee need to disable access to login and register pages
	//otherwise we need to disable logout, basket and account pages
	if ($_SESSION['loggedin']=='yes')
	{
		$nav_menu_array['/login.php'] = add_attribute($nav_menu_array['/login.php'], $insert_content, $insert_position);
		$nav_menu_array['/register.php'] = add_attribute($nav_menu_array['/register.php'], $insert_content, $insert_position);

	}
	else 
	{
		$nav_menu_array['/logout.php'] = add_attribute($nav_menu_array['/logout.php'], $insert_content, $insert_position);
		$nav_menu_array['/basket.php'] = add_attribute($nav_menu_array['/basket.php'], $insert_content, $insert_position);
		$nav_menu_array['/account.php'] = add_attribute($nav_menu_array['/account.php'], $insert_content, $insert_position);
	}


	echo '<nav class="navbar bg-primary mb-3" data-bs-theme="dark">';
	echo 	'<div class="container-fluid">';
	echo 		'<span class="navbar-brand mb-0 h1">KIKFAV</span>';
	echo 		'<div class="nav nav-underline me-auto">';

	 foreach ($nav_menu_array as $key => $value) {
	 				echo $value;
	 }

	echo 		'</div>';
	echo 	'</div>';
	echo '</nav>';
?>