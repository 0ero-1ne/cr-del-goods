<?php
	include_once 'config/db.php';
	include_once 'objects/product.php';

	//setting connection with database
	$db = new Database();
	$connection = $db->setConnection();

	//getting list of products
	$product = new Product([], $connection);
	$products = $product->getProducts("products");

	//if products selected and MASS DELETE button clicked
	if ($_POST) {
		$product->deleteProducts($_POST);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/products_list.css">
	<link rel="icon" type="image/x-icon" href="images/favicon.png">
	<style>@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap');</style>
	<title>Products page</title>
</head>
<body>
	<header class="header">
		<h1>Products</h1>
		<div class="header__actions">
			<button class="button"><a href="add-product">ADD</a></button>
			<input type="submit" form="delete-form" id="delete-product-btn" class="button" value="MASS DELETE">
		</div>
	</header>
	<main class="main">
		<form action="<?= $_SERVER['PHP_SELF']?>" id="delete-form" method="POST"></form>
		<div class="products_list">
			<?php
				$product->printProducts($products);
			?>
		</div>
	</main>
	<footer class="footer">
		<p>Scandiweb Test assignment</p>
	</footer>
</body>
</html>