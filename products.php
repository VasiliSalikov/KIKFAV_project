<!DOCTYPE html> 
<html>
    <head> 
	<link rel="stylesheet" type="text/css" href="css/products.css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    	
    <?php
    	
    include 'navigation_menu.php'; //include navigation menu from another file
	include 'sql.php';//include the credentials

	echo '<div class="container">';
	//prepare and bind
	//NOTE we cannot do select * from
	//we MUST specify what is to be returned!!
	$stmt = $conn->prepare("SELECT stockno,description,price,qtyinstock FROM tw_stock");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($stockno,$description,$price,$qtyinstock); //things to retrieve
	$row_count = $stmt->num_rows; //get the number of rows!
	$ammount_message;
		
	if($row_count > 1)
	{
		$ammount_message = '<h5>There are '.$row_count.' items</h5>';
	}
	else 
	{
		$ammount_message = '<h5>There is '.$row_count.' item</h5>';
	}
	echo $ammount_message;

	while ($stmt->fetch()) 
	{
		echo '<div class="item">';
		echo '<img src="images/'.$stockno.'.jpeg">';
		echo '<div>'.$stockno.'</div>';
		echo '<div>'.$description.'</div>';
		echo '<div>'.$price.'£</div>';
		//echo '<div>'.$qtyinstock.'</div>';
		echo '<div><select name="'.$stockno.'" form="orderform">';
			for($i=0; $i <= $qtyinstock; $i++){
				echo '<option value="'.$i.'">'.$i.'</option>';
			}
		echo'</select></div>';
		echo '</div>';
	};
	$stmt->close(); //close the sql
	$conn->close(); //close the connection

	//The code below is needed to ensure that if the user is logged in, they are shown the order button; otherwise, it shouldn't be shown
	session_start();
	if ($_SESSION['loggedin']=='yes')
	{
		echo '<form action="placeorder_script.php" method="POST" id="orderform">
				<input type="submit" value="Add to basket" class="btn btn-primary">
			</form>';

	}
	
    ?>
    	</div>
    </body>
</html>
