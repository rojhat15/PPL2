<?php
	session_start();
	include_once 'Bijhorend/databaseconnectie.php';
	if(!isset($_SESSION['userId'])){ //if login in session is not set
    header("Location: index.php");
}
	$id=$_GET["id"];
	$cart_status="";
	$rese=mysqli_query($conn, "select cart_status from cart where idUsers=$id");
	while($row=mysqli_fetch_array($rese))
	{
		$cart_status=$row["cart_status"];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		
	<title>Webbie</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />	
	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<link rel="stylesheet" href="Style/Styling.css">

</head>
<body class="container">
<?php require_once("bijhorend/header.php");?>


	<br><br><br><br><br><br><br>
	            <table class="container">
                <thead>
                    <tr>
                        <th>Aantal</th>
                        <th>Omschrijving</th>
                        <th>Prijs</th>
					</tr>
                </thead>
				 <tbody>
<?php
echo"<div class='border border-secondary'>";		 
$res=mysqli_query($conn, "SELECT product_name, Aantal, product_price FROM cart join cartproducten on cart.cart_id = cartproducten.cart_id where cart.cart_id = $id");
$ress=mysqli_query($conn, "SELECT * FROM cart join cartproducten on cart.cart_id = cartproducten.cart_id where cart.cart_id = $id");
$resss=mysqli_query($conn, "SELECT * FROM cart join cartproducten on cart.cart_id = cartproducten.cart_id join users where users.idUsers = $id");
$totaal =0;
echo '<h4>Bestelling</h4>';

if($row=mysqli_fetch_assoc($ress))
		{
		echo'Datum: ';echo $row['cart_date']; echo '<br>'; 
		echo 'Bestelnummer: '; echo $row['cart_id']; echo '<br><br>'; 
		
		
	?>
	<form action="" method="POST">
		<input type="text" name="status" placeholder="status" value="<?php echo $cart_status; ?>">
		<button type="submit" name="update">Update</button>
	</form>
	<br>
	<?php

	}
	if($row=mysqli_fetch_assoc($resss))
		{
		echo'Klant / Afleveradres <br>';echo $row['voornaamUsers']; echo '<br>'; 
		echo ''; echo $row['AdresUsers']; echo '<br>'; 
		echo 'postcode: '; echo $row['PostcodeUsers']; echo '<br><br>';

	}
	echo'<h6>Producten</h6>';
while($row=mysqli_fetch_assoc($res))
	{
		$totaal=$totaal+$row['Aantal']*$row['product_price'];
			
			
			
		echo"<tr>";	
		echo"<td>";echo $row['Aantal']; echo "</td>";
		echo"<td>"; echo $row['product_name']; echo "</td>";
		echo"<td>"; echo"??? "; echo $row['product_price'];  echo "</td>";
		echo"</tr>";
	
	}

	
	?>
		</tbody>
	</table>
	<b>Totaal: <?php if($totaal <= 200){
		$totaal=$totaal+12.50;
		echo "??? "; echo $totaal;
		echo "<br>(Incl. ???12,50 verzendkosten)";
	}else{
	echo "??? "; echo $totaal;
	echo "<br>(Gratis verzendkosten)";} echo"</div>";?></b>


	<?php
if(isset($_POST["update"]))
{
	mysqli_query($conn,"update cart set cart_status='$_POST[status]' where idUsers=$id");
	
	?>
	<script type="text/javascript">
		window.location="bestellingen.php";
	</script>
	<?php
	
	
}
?>
	
	
	
<?php
	require "bijhorend/footer.php";
?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
