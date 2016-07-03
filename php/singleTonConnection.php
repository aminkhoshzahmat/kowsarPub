<?php
	define("DB_HOST","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","database");

	# DESIGN PATTERN : SingleTon
	# ==========================
	# 1) private static $instance = null;
	# 2) private function __construct
	# 3) public static function getInstance()connect

	class Database {
		# database config
		private $host   = DB_HOST;
		private $user   = DB_USER;
		private $pass   = DB_PASS;
		private $dbname = DB_NAME;
		# handlers
		private $error;
		private $dbh;
		# statement
		private $stmt;
		# SingleTon
		private static $instance = null;


		private function __construct(){
			// Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			// Options for connection
			$options = array(
				PDO::ATTR_RESISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			// attempting to coonect
			try {
				$this->dbh = new PDO($dsn, $this->user, $this->pass);
			} catch(PDOExeption $e) {
				$this->error = $e->getMessage();
			}
		}

		// check if there is only one instance
		public static function getInstance() {
			if(self::$instance == null) {
				self::$instance = new Database();
			}

			return self::$instance;
		}

		// Stop Clonning
		private function __clone()  {}
		// stop serial
		private function __wakeup() {}

		public function query($query) {
			$this->stmt = $this->prepare($query);
		}

		public function bind($param, $value, $type = null){
			if(is_null($type)){
				switch(true) {
					case is_int($value):
						$type = PDO::PAAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$this->stmt->bindValue($param, $value, $type);
		}

		public function execute() {
			return $this->stmt->execute();
		}

		public function resultSet() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function single() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}

		public function rowCount() {
			return $this->stmt->rowCount();
		}

		public function lastInsertId() {
			return $this->dbh->lastInsertId();
		}

	}

?>