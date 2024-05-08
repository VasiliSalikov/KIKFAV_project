<?php
        session_start();

        $username=$_POST['username'];
        $password=$_POST['password'];

        $password = md5($password);

        require 'sql.php';   //include the credentials

        //prepare and bind
        //NOTE we cannot do select "*" (all) from the database
        //we MUST specify what is to be returned

        $stmt = $conn->prepare("SELECT userid,username,email,forename,surname,street_address,city,postcode,access_level FROM tw_users WHERE username = ? AND password = ?");

        $stmt->bind_param("ss", $username, $password);   //things to send

        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userid,$username,$email,$forename,$surname,$street_address,$city,$postcode,$access_level);   //things to retrieve

        $row_count = $stmt->num_rows;   //get the number of rows. If it is 1, we are logged in! If 0 we found no match.

        echo 'number of rows.....'.$row_count.'<br>';

        while ($stmt->fetch()) {
                echo $forename.'<br>';
                echo $surname.'<br>';
                echo $street_address.'<br>';
                echo $city.'<br>';
                echo $postcode.'<br>';
                echo $email.'<br>';
                echo $username.'<br>';
                echo $access_level.'<br>';
        };

        $stmt->close();   //close the sql
        $conn->close();   //close the connection



        //so how do we tell we are logged in??

        if ($row_count ==1)
          {
                echo 'Logged in!<br>';
                $_SESSION['loggedin'] = 'yes';
		$_SESSION['forename'] = $forename;
		$_SESSION['surname'] = $surname;
		$_SESSION['userid'] = $userid;
                echo '<pre>';
                print_r($_SESSION);
                echo '</pre>';

	//Now we redirect to relevant pages.

                // if($access_level == 1){
                //         $_SESSION['admin'] = 'yes';
                //         header('location:admin.php');
                // }else{
                //         header('location:homepage.php');
                // };
                header('location:index.php');

          } else {
                session_unset();
                session_destroy();

                //todo
                //wrong password, try again
                
                header('location:index.php');
        };

        //What about access level?
        echo 'Access level = '.$access_level;

//MAKE NOTE OF THE SECTION ABOVE!!! this is how you direct to other pages. remember this.

?>
