<?php

	class Database {
		private $host = "localhost";
		private $databaseName = "juniortest";
		private $username = "root";
		private $password = "";
		public $connection = null;

		public function setConnection() {
			try {
				$this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->databaseName."", $this->username, $this->password);
			}
			catch (PDOException $exc)
			{
				echo "Error: ".$exc->getMessage;
			}

			return $this->connection;
		}	
	}

?>