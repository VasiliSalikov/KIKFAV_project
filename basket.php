<!DOCTYPE html> 
<html>
    <head> 
	<link rel="stylesheet" type="text/css" href="css/products.css">
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    	 <?php
    	
    		include 'navigation_menu.php'; //include navigation menu from another file
			include 'sql.php';//include the credentials

			echo '<div class="container">';

			$userid = $_SESSION['userid'];

			$stmt = $conn->prepare("SELECT orderno FROM tw_orders WHERE userid = ? ORDER BY orderno DESC");
	        $stmt->bind_param("i",$userid);
	        $stmt->execute();
	        $result = $stmt->get_result();
	        //$stmt->bind_result($orderno);
	       	//$stmt->fetch();
	       

	        if($result->num_rows > 0)
	        {
	        	$order_numbers = array();
		        	//fetch each order
		       	while ($row = $result->fetch_row())
		       	{
		       		$order_numbers[] = $row[0];
		       		
		       	}

		       

		       	foreach ($order_numbers as $orderno) 
		       	{
		       		$stmt = $conn->prepare("SELECT stockno, qty FROM tw_orderline WHERE orderno = ?");
		       		$stmt->bind_param("s",$orderno);//things to send
	                $stmt->execute();
	                $result = $stmt->get_result();

	                $orderlines = array();
		            while ($row = $result->fetch_assoc())
			       	{
			       		$orderlines[] = $row;
			       		//$orderlines[] = array_merge(array('orderno' => $value),$row);
			       		
			       	}
			       	echo '<div> <h5> Order number: '.$orderno.'</h5>';

			       	$end_price = 0;
			       	foreach ($orderlines as $orderline) 
			       	{
			       		//echo '<div> stockno='.$orderline["stockno"].' qty ='.$orderline['qty'].'</div>';

			       		$stmt = $conn->prepare("SELECT description, price FROM tw_stock WHERE stockno = ?");
		       			$stmt->bind_param("s",$orderline["stockno"]);//things to send
	                	$stmt->execute();
	                	$result = $stmt->get_result();
	                	$product = $result->fetch_assoc();

	                	//echo 'Product desc ='.$product["description"].' price = '.$product["price"];

	                			echo '<div class="item">';
								echo '<img src="images/'.$orderline["stockno"].'.jpeg">';
								echo '<div>'.$orderline["stockno"].'</div>';
								echo '<div>'.$product["description"].'</div>';
								echo '<div>'.$product["price"].'£</div>';
								//echo '<div>'.$qtyinstock.'</div>';
								echo '<div>'.$orderline["qty"].'</div>';
								echo '</div>';
								$end_price += $product["price"]*$orderline["qty"];

				       	}
		   				echo '<div class="mb-3" style="margin-left:74%">';
						$end_price = number_format($end_price, 2);
						echo '<div> End price: '.$end_price.'£</div>';
						echo '<div> End price + VAT: '.number_format($end_price*1.2,2).'£</div>';
						echo '</div>';
				       	echo '</div>';
			       		
				}
	        }
	        else 
	        {
	        	echo '<h5>The basket is empty</h5>';
	        }

	        

		    // foreach ($orderlines as $key => $value) {
		    // 	echo '<div> key = '.$key.' value[0] = '.$value[0].' value[1]='.$value[1].'</div>';
		    // }
		    //print_r($orderlines);

		?>

    	</div>
    </body>
</html>