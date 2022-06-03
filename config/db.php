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
	}

?>