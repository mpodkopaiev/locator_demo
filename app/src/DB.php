<?php

	namespace Demo;

	use Pdo;
	use PDOException;

	class DB {
		private const DB = __DIR__ . '/database/destinations.sqlite';
		private PDO $connection;

		public function __construct() {
			try {
				$this->connection = new PDO('sqlite:'. self::DB);
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				die(json_encode(["error" => "Database connection failed: " . $e->getMessage()]));
			}
		}

		public function getConnection() {
			return $this->connection;
		}

		public function __clone() {}

		public function __destruct() {}
	}