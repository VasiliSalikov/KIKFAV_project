<?php
        session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clear</title>
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<?php
	session_unset();
	session_destroy();
	echo '<pre>';
        print_r($_SESSION);
    echo '</pre>';
    header('location:index.php');
?>
 
<a href="index.php">homepage</a>
</body>
</html>



