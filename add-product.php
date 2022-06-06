<?php
	include_once 'config/db.php';
	include_once 'objects/product.php';

	$db = new Database();
	$connection = $db->setConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/add_product.css">
	<link rel="icon" type="image/x-icon" href="images/favicon.png">
	<style>@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap');</style>
	<title>Add product</title>
</head>
<body>
	<header class="header">
		<h1>Product Add</h1>
		<div class="header__actions">
			<input type="submit" value="Save" class="button" form="product_form" />
			<button id="cancel-adding-btn" class="button"><a href="/">Cancel</a></button>
		</div>
	</header>
	<main class="main">
		<?php
			if ($_POST) {
				$product = new Product($_POST, $connection);
				$product->description = $product->getDescription($_POST);
				$result = $product->save();

				if ($result !== true)
					echo $result;
				else
					header('Location: /');
			}
		?>
		<form action="add-product" id="product_form" method="POST">
			<div class="form_group">
				<label for="sku">SKU</label>
				<input type="text" id="sku" name="sku" placeholder="SKU..." required />
			</div>
			<div class="form_group">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" placeholder="Name..." required />
			</div>
			<div class="form_group">
				<label for="price">Price ($)</label>
				<input type="number" step="0.01" id="price" name="price" placeholder="Price..." required />
			</div>
			<div class="form_group">
				<label for="productType">Product Type</label>
				<select name="productType" id="productType" required>
					<option value=""></option>
					<option value="DVD">DVD</option>
					<option value="Book">Book</option>
					<option value="Furniture">Furniture</option>
				</select>
			</div>
			<div class="dvd_input dynamic_block" style="display: none;">
				<p>Please, provide size</p>
				<div class="form_group">
					<label for="size">Size (MB)</label>
					<input type="number" id="size" name="dvd_size" placeholder="Size..." required />
				</div>
			</div>
			<div class="book_input dynamic_block" style="display: none;">
				<p>Please, provide weight</p>
				<div class="form_group">
					<label for="weight">Weight (KG)</label>
					<input type="number" id="weight" name="book_weight" placeholder="Weight..." required />
				</div>
			</div>
			<div class="furniture_input dynamic_block" style="display: none;">
				<p>Please, provide dimensions</p>
				<div class="form_group">
					<label for="height">Height (CM)</label>
					<input type="number" id="height" name="furniture_height" placeholder="Height..." required />
				</div>
				<div class="form_group">
					<label for="width">Width (CM)</label>
					<input type="number" id="width" name="furniture_width" placeholder="Width..." required />
				</div>
				<div class="form_group">
					<label for="length">Length (CM)</label>
					<input type="number" id="length" name="furniture_length" placeholder="Length..." required />
				</div>
			</div>
		</form>
	</main>
	<footer class="footer">
		<p>Scandiweb Test assignment</p>
	</footer>
	<script src="scripts/form_handler.js"></script>
</body>
</html>