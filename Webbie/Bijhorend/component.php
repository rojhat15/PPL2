<?php

function component($productname, $productprice, $productimg, $productid, $productbeschrijving){
	$element = "
	
	<div class=\"col-md-3 col-sm-6 my-3 my-md-3\">
			<form action=\"producten.php\" method=\"POST\">
				<div class=\"card shadow\">
					<div>
						<img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
					</div>
					<div class=\"card-body bg-dark\">
						<h5 class=\"card-title text-white\">$productname</h5>
						<h6>
							
						</h6>
						<p class=\"card-text\">
						</p>
						<h5>
							<span class=\"price text-white\">€ $productprice</span>
						</h5>
						
						<button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Toevoegen winkelmand <i class=\"fas fa-shopping-cart\"></i></button>
						<input type='hidden' name='product_id' value='$productid'>
					</div>
				</div>
			</form>
		</div>
	
	";
	echo $element;
}


function cartElement($productimg, $productname, $productprice, $productid, $productbeschrijving){
	$element = "
	
	<form action=\"winkelmand.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
					<div class=\"border rounded\">
						<div class=\"row bg-white\">
							<div class=\"col-md-3 pl-0\">
								<img src=$productimg alt=\"Image1\" class=\"img-fluid\">
							</div>
							<div class=\"col-md-6\">
								<h5 class=\"pt-2\">$productname</h5>
								<small class=\"text-secondary\">$productbeschrijving</small>
								<h5 class=\"pt-2\"'><span id='prijs'>$productprice</h5></span>
								<button type=\"submit\" class=\"btn btn-warning\">Bewaren</button>
								<button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Verwijderen</button>
							</div>
							<div class=\"col-md-3 py-5\">
								<div>
								<br>
									
									<input type=\"number\" name='quantity' id='numberr' value=\"1\" class=\"form-control w-28 d-inline\">	
									<p id='totaal' class='prijsproduct'>Totaal prijs:</p>
								</div>
							</div>
						</div>
					</div>
				</form>
	
	";
	
	echo $element;
}