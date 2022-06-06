<?php

	class Database {
		private $host = "localhost";
		private $db_name = "juniortest";
		private $username = "root";
		private $password = "";
		public $connection = null;

		public function setConnection() {
			
			try {
				$this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name."", $this->username, $this->password);
			}
			catch (PDOException $exc)
			{
				echo "Error: ".$exc->getMessage;
			}

			return $this->connection;
		}

		public function getProducts($table_name) {
			$query = "SELECT * FROM ".$table_name;
			$sth = $this->connection->prepare($query);
			$sth->execute();
			return $sth;
		}

		public function printProducts($data) {
			$counter = 0;
			while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='product'>";
					echo "<span>{$row['sku']}</span>";
					echo "<span>{$row['name']}</span>";
					echo "<span>".sprintf("%01.2f", $row['price'])." $</span>";
					echo "<span>{$row['description']}</span>";
					echo "<input type='checkbox' name='delete-id[]' form='delete-form' class='delete-checkbox' value='{$row['id']}' />";
				echo "</div>";
				$counter++;
			}

			if ($counter == 0) echo "<div class='no-products'>No products...	</div>";
		}

		public function deleteProducts($data) {
			$products_ids = implode(", ", $data['delete-id']);
			$query = "DELETE FROM `products` WHERE `id` IN ($products_ids)";
			$sth = $this->connection->prepare($query);
			$sth->execute();
			header("Location: /");
		}	
	}

?>