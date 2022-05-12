<?php
$servername = "localhost:3307";
$user = "root";
$password = "Mypass";
$dBName = "webbie";

$conn = mysqli_connect($servername, $user, $password, $dBName);

if (!$conn) { 
	die("connection failed: ".mysqli_connect_error());
} 
	
// informatie uit database halen	
$result = "SELECT * FROM producten";
$resultt = mysqli_query($conn, $result);