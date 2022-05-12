<?php 
	session_start();
	include_once 'databaseconnectie.php';
	
	$idUsers = $_SESSION['userId'];
	
	
	
	$product_id = array_column($_SESSION['Cart'], 'product_id');
	while($row = mysqli_fetch_assoc($resultt)){
	foreach($product_id as $id)
	$row['product_id'] == $id;
	}
	
	$sqlll = "INSERT INTO cart (idUsers, product_id) values ($idUsers, $id);";
	
	mysqli_query($conn, $sqlll);
	header("location:../index.php");