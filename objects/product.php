<?php

	class Product {
		private $table_name = "products";
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
			$query = "SELECT * FROM $this->table_name WHERE sku = '$this->sku'";
			$check = $this->db->prepare($query);
			$check->execute();

			//checking existing of row with sended sku
			if ($check->fetch(PDO::FETCH_ASSOC) === false) {
				$query = "INSERT INTO {$this->table_name} SET sku=:sku, name=:name, price=:price, product_type=:productType, description=:description";
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

		public function getDescription($data) {
			$dvd = "Size: ".$data['dvd_size']." MB";
			$book = "Weight: ".$data['book_weight']." KG";
			$furniture = "Dimension: {$data['furniture_height']}x{$data['furniture_width']}x{$data['furniture_length']}";

			return ${$this->productType};
		}
	}

?>