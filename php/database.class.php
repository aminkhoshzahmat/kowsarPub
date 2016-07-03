<?php
	// define configuration
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "password");
	define("DB_NAME", "database");
	
class Database {
	private $host   = DB_HOST;
	private $user   = DB_USER;
	private $pass   = DB_PASS;
	private $dbname = DB_NAME;
	# ------------------------
	private $dbh;
	private $error;
	# ------------------------
	private $stmt;

	public function __construct(){
		// Set DSN
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		// Set Options
		$options = array(
			PDO::ATTR_RESISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->dbh  = new PDO($dsn, $this->user, $this->pass, options);
		} catch(PDOException $e){
			$this->error = $e->getMessage();
	}

	public function query($query) {
		$this->stmt = $this->prepare($query);
	}

	public function bind($param, $value, $type = null) {
		if(is_null($type)) {
			switch(true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($type):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null:
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

	public function beginTransaction() {
		return $this->dbh->beginTransaction();
	}

	public function endTransaction() {
		return $this->dbh->commit();
	}

	public function cancelTransaction() {
		return $this->dbh->rollBack();
	}

	public function debugDumpParams() {
		return $this->stmt->debugDumpParams();
	}



}

?>