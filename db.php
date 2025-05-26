<?php

$servername= "localhost";
$username="root";
$password="";
$database="crud";

  $conn = new mysqli($servername, $username, $password, $database);
//die if connection was not successful
if(!$conn)
{
die ("sorry we failed to connect :".mysqli_connect_error());
}
?>