<?php

	class Product {
		private $tableName = "products";
		private $db;
		
		public $sku;
		public $name;
		public $price;
		public $productType;
		public $description;
	
		public function __construct($data, $db) {
			$this->sku = htmlspecialchars($data['sku']);
			$this->name = htmlspecialchars($data['name']);
			$this->price = (float) $data['price'];
			$this->productType = strtolower(htmlspecialchars($data['productType']));
			$this->db = $db;
		}

		public function save() {
			//getting row with sended sku
			$query = "SELECT * FROM $this->tableName WHERE sku = '$this->sku'";
			$check = $this->db->prepare($query);
			$check->execute();

			//checking existing of row with sended sku
			if ($check->fetch(PDO::FETCH_ASSOC) === false) {
				$query = "INSERT INTO {$this->tableName} SET sku=:sku, name=:name, price=:price, product_type=:productType, description=:description";
				$sth = $this->db->prepare($query);

				$sth->bindParam(":sku", $this->sku);
				$sth->bindParam(":name", $this->name);
				$sth->bindParam(":price", $this->price);
				$sth->bindParam(":productType", $this->productType);
				$sth->bindParam(":description", $this->description);
				
				$sth->execute();
				return true;
			} else {
				return "<div class='message error'>SKU $this->sku is already exists</div>";
			}
		}

		public function printProducts($products) {
			if (!empty($products)) {
				while ($row = $products->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='product'>";
						echo "<span>{$row['sku']}</span>";
						echo "<span>{$row['name']}</span>";
						echo "<span>".sprintf("%01.2f", $row['price'])." $</span>";
						echo "<span>{$row['description']}</span>";
						echo "<input type='checkbox' name='delete-id[]' form='delete-form' class='delete-checkbox' value='{$row['id']}' />";
					echo "</div>";
				}
			}
			else
				return "<div class='no-products'>No products...	</div>";
		}

		private function deleteProducts($data) {
			$productsIds = implode(", ", $data['delete-id']);
			$query = "DELETE FROM `products` WHERE `id` IN ($productsIds)";
			$sth = $this->db->prepare($query);
			$sth->execute();

			header("Location: /");
		}

		public function getProducts($tableName) {
			$query = "SELECT * FROM ".$tableName;
			$sth = $this->db->prepare($query);
			$sth->execute();
			
			return $sth;
		}

		public function getDescription($data) {
			$dvd = "Size: ".$data['dvd_size']." MB";
			$book = "Weight: ".$data['book_weight']." KG";
			$furniture = "Dimension: {$data['furniture_height']}x{$data['furniture_width']}x{$data['furniture_length']}";

			return ${$this->productType};
		}
	}

?>