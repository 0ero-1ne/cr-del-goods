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
			$this->price = (float) htmlspecialchars($data['price']);
			$this->productType = strtolower(htmlspecialchars($data['productType']));
			$this->db = $db;
		}

		public function save() {

			$query = "INSERT INTO {$this->table_name} SET sku=:sku, name=:name, price=:price, product_type=:productType, description=:description";

			$sth = $this->db->prepare($query);

			$sth->bindParam(":sku", $this->sku);
			$sth->bindParam(":name", $this->name);
			$sth->bindParam(":price", $this->price);
			$sth->bindParam(":productType", $this->productType);
			$sth->bindParam(":description", $this->description);

			if ($sth->execute()) {
				return true;
			} else {
				return $sth->errorInfo();
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