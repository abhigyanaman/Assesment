<?php
include("config.php");
if ($conn->connect_error)
{
    echo "not connected";
    die("Connection failed: " . $conn->connect_error);
}
else
{ 
    session_start(); //to ensure you are using same session
	session_destroy(); //destroy the session
    header('Location: ./login.html');
    exit();
}
?>