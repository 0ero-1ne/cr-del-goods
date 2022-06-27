<?php
	include_once 'config/db.php';
	include_once 'objects/product.php';

	//setting connection with database
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
			//if form submited
			if ($_POST) {
				$product = new Furniture($_POST, $connection);
				var_dump($product);
				/*$product->description = $product->getDescription($_POST);
				$result = $product->save();

				if ($result !== true)
					echo $result;
				else
					header('Location: /');*/
			}
		?>
		<form action="add-product" id="product_form" method="POST">
			<div class="form_group">
				<label for="sku">SKU</label>
				<input type="text" id="sku" name="sku" placeholder="SKU..." value="<?= $_POST['sku']?>" required />
			</div>
			<div class="form_group">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" placeholder="Name..." value="<?= $_POST['name']?>" required />
			</div>
			<div class="form_group">
				<label for="price">Price ($)</label>
				<input type="number" step="0.01" id="price" name="price" placeholder="Price..." value="<?= $_POST['price']?>" required />
			</div>
			<div class="form_group">
				<label for="productType">Product Type</label>
				<select name="productType" id="productType" required>
					<option value=""></option>
					<option value="DVD" <?php if ($_POST['productType'] === "DVD") echo "selected" ?>>DVD</option>
					<option value="Book" <?php if ($_POST['productType'] === "Book") echo "selected" ?>>Book</option>
					<option value="Furniture" <?php if ($_POST['productType'] === "Furniture") echo "selected" ?>>Furniture</option>
				</select>
			</div>
			<div class="dvd_input dynamic_block" style="display: none;">
				<p>Please, provide size</p>
				<div class="form_group">
					<label for="size">Size (MB)</label>
					<input type="number" id="size" name="dvd_size" placeholder="Size..." value="<?= $_POST['dvd_size']?>" required />
				</div>
			</div>
			<div class="book_input dynamic_block" style="display: none;">
				<p>Please, provide weight</p>
				<div class="form_group">
					<label for="weight">Weight (KG)</label>
					<input type="number" id="weight" name="book_weight" placeholder="Weight..." value="<?= $_POST['weight']?>" required />
				</div>
			</div>
			<div class="furniture_input dynamic_block" style="display: none;">
				<p>Please, provide dimensions</p>
				<div class="form_group">
					<label for="height">Height (CM)</label>
					<input type="number" id="height" name="furniture_height" placeholder="Height..." value="<?= $_POST['height']?>" required />
				</div>
				<div class="form_group">
					<label for="width">Width (CM)</label>
					<input type="number" id="width" name="furniture_width" placeholder="Width..." value="<?= $_POST['width']?>" required />
				</div>
				<div class="form_group">
					<label for="length">Length (CM)</label>
					<input type="number" id="length" name="furniture_length" placeholder="Length..." value="<?= $_POST['length']?>" required />
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