<?php
class DB {
	private static $con   = null;
	private static $query = null;

	public static function setup($host, $user, $password, $db) {
		try {
		self::$con = new PDO("mysql:host=$host;dbname=$db", $user, $password);
		self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) { return false; }
	
		return true;
	}

	public static function getLastInsertId() {
		return self::$con->lastInsertId();
	}

	public static function query($q, $params = []) {
		$query = self::$con->prepare($q);
		self::$query = $query;
		return self::$query->execute($params);
	}

	public static function results() {
		self::$query->setFetchMode(PDO::FETCH_ASSOC);
		return self::$query->fetchAll();
	}
}


// $dbServername = "localhost";
// $dbUsername   = "root";
// $dbPassword   = "root";
// $dbName     = "tamplpay";

// $conn = null;

// try {
// 	$conn = new PDO("mysql:host=$dbServername;dbname=$dbName", $dbUsername, $dbPassword);
// 	// set the PDO error mode to exception
// 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 	// echo "Connected successfully";
// } catch(PDOException $e) {
// 	// echo "Connection failed: " . $e->getMessage();
// }
?>