<?php   session_start();
        //include 'navigation_menu.php';
        include 'sql.php';//go inlude the database credentials!


        // echo '<pre>';
        // print_r($_POST);

        // print_r($_SESSION);
        // echo '</pre>';

        $ammount_of_products = 0;
        foreach ($_POST as $value) {
                $ammount_of_products += $value;
        }

        if($ammount_of_products == 0)
        {
                //echo "<script>alert('You cannot add nothing to basket!');</script>";
                header('location:products.php');
        }
        else
        {
                $userid = $_SESSION['userid'];

                //echo 'USERID'.$userid;

                $stmt = $conn->prepare("INSERT INTO tw_orders (userid) VALUES (?)");
                $stmt->bind_param("i",$userid);
                $stmt->execute();
                echo $userid;

                //now go get the orderno:
                $stmt = $conn->prepare("SELECT orderno FROM tw_orders WHERE userid = ? ORDER BY orderno DESC LIMIT 1");
                $stmt->bind_param("i",$userid);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($orderno);
                $stmt->fetch();

                //echo '<br>Orderno: '.$orderno.'<br>';


                $total=0;


                foreach($_POST as $stockno => $qty){
                        if($qty > 0){


                                $stmt = $conn->prepare("SELECT price FROM tw_stock WHERE stockno = ?");
                                $stmt->bind_param("s",$stockno);//things to send
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($price); //things to retrieve

                                while ($stmt->fetch()) {
                                        $total = $total+($price*$qty);
                                };//end while loop

                                echo $stockno.'--'.$qty.'--'.$price.'<br>';


                                $stmt = $conn->prepare("INSERT INTO tw_orderline VALUES (?,?,?)");
                                $stmt->bind_param("isi",$orderno,$stockno,$qty);
                                $stmt->execute();


                                $stmt_update = $conn->prepare("UPDATE tw_stock SET qtyinstock = (qtyinstock - ?) WHERE stockno = ?");
                                $stmt_update->bind_param("is",$qty,$stockno);
                                $stmt_update->execute();


                        };
                };

                header('location:basket.php');
        }

        // foreach($_SESSION as $key => $value){
        //         echo $key.'&nbsp'.$value.'<br>';
        // };

        // if (empty($_POST)) {
        //         // code...
        // }


        

        //echo $total.'<br>';
        //echo $total*1.2;
        //header('location:basket.php');

?>
