<?php
error_reporting(1);

$conn=mysqli_connect("localhost","root","","jhamobi_assessment");

//$conn=mysqli_connect("yufondo-db.c1xosa2sqoup.ap-south-1.rds.amazonaws.com","admin","Yofundo01$","yofundo");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
{
//echo "connected";
}
// mysqli_query( $conn,'SET character_set_results=utf8');
// mysqli_query( $conn,'SET names=utf8');
// mysqli_query( $conn,'SET character_set_client=utf8');
// mysqli_query( $conn,'SET character_set_connection=utf8');
// mysqli_query( $conn,'SET collation_connection=utf8_general_ci');
// mysqli_query( $conn,'SET character_set_results=utf8');

 
?>

