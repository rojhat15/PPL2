<?php
// start session 
session_start();


require_once('Bijhorend/databaseconnectie.php');
require_once('./Bijhorend/component.php');


if(isset($_POST['add'])){
	/// print_r($_POST['product_id']);
	if(isset($_SESSION['Cart'])){
		
		$item_array_id = array_column($_SESSION['Cart'], "product_id");
		
		if(in_array($_POST['product_id'], $item_array_id)){
			echo "<script>alert('Product is already added in the cart..!')</script>";
			echo "<script>window.location = 'producten.php'</script>";
		}else{
			
			$count = count($_SESSION['Cart']);
			$item_array = array(
				'product_id' => $_POST['product_id']
			);
			
			$_SESSION['Cart'][$count] = $item_array;
		}
		
	}else{
		
		$item_array = array(
			'product_id' => $_POST['product_id']
		);
		
		// create new session variable
		$_SESSION['Cart'][0] = $item_array;
	}
}
error_reporting(0);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Producten</title>
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
	
	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<link rel="stylesheet" href="Style/Styling.css">
	<!-- (verplicht inloggen om producten pagina te bereiken)
		<?php if (isset($_SESSION['userId'])) { 
				
			} else {
			echo "<script>alert('Registreer/Log eerst in')</script>";
			echo "<script>window.location = 'signup.php'</script>";
			}?> --> 
</head>
<body class="my-5">

<?php require_once("Bijhorend/header.php");?>




<div class="container">
<br>
<br>
<b>Sorteren op:</b>
<a href="producten.php?sort=desc">Productnummer</a>
<a href="producten.php?sort=status">Omschrijving</a>
<a href="producten.php?sort=prijs">Prijs</a>
	<div class="row text-center py-5">	
	
			
		<?php
			$DBConnect5 = new mysqli("localhost:3307","root","Mypass","webbie");
			$result = "SELECT * FROM producten";
			$resultt = $DBConnect5->query($result);
			$resss = "SELECT * from producten order by product_id";
			$resulttt = $DBConnect5->query($resss);
			$ressss = "SELECT * from producten order by product_name";
			$resultttt = $DBConnect5->query($ressss);
			$prijs = "select * from producten order by product_price";
			$prijss = $DBConnect5->query($prijs);
		
		
			while($row = mysqli_fetch_assoc($resultt))
			{
			
			if($_GET['sort'] == 'desc')
			{
			$row = mysqli_fetch_array($resulttt);
			}
			if($_GET['sort'] == 'status')
			{
			 $row = mysqli_fetch_array($resultttt);
			}
			if($_GET['sort'] == 'prijs')
			{
			 $row = mysqli_fetch_array($prijss);
			}
				
				
	component($row['product_name'], $row['product_price'], $row['product_image'], $row['product_id'], $row['product_beschrijving']);
			}
		?>
		
	</div>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<?php require_once("bijhorend/footer.php");?>
</html>