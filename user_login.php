<?php

ini_set('display_errors', 1); 
//ini_set('display_startup_errors', 1); 
//error_reporting(E_ALL);

include("config.php");
//echo "Hello Good morning";die();
if ($conn->connect_error) 
{
    echo "not connected";
    die("Connection failed: " . $conn->connect_error);    
}
else
{
    
    session_start();
    if(isset($_POST['email']) && (trim($_POST['email']) != ''))
	{
        $myusername=$_POST['email'];
        $password = $_POST['pass'];
        $result1=mysqli_query($conn,"SELECT * FROM `user` WHERE `userMailId`='$myusername' AND `password`='$password'");
        echo $result1->num_rows;
       if ($result1->num_rows > 0)
        {
            while($row = $result1->fetch_assoc())
            {
				$_SESSION['userId'] = $row['userId'];	
				$_SESSION['userMailId'] = $row['userMailId'];
				$_SESSION['userType'] = $row['userType'];
				header('Location: ./index.php');
			}
        }
        else
        {
            header('Location: ./loginerror.html');
        }
    }
}



?>


