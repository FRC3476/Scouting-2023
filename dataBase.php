<?php
$dataBase_included = "Y";

if($config_included == "") {
	include("config.php");
}

class DataBase {
  // Properties
  private static $conPool = array();
  private static $conStr = null;
  private static $conOpt= null;

  // Default Constructor
  private function __construct() {
    self::init();
  }

  private static function init() {
    //print " In Connection Pool Init\n";

    // Declare global variables sourced from config.php
    global $maxCons;
    global $serverName;
    global $userName;
    global $password;
    global $dbName;
    global $charSet;

    // Prepare to create database connections
    self::$conStr = "mysql:host=" . $serverName . ";dbname=" . $dbName . ";charset=" . $charSet;
    self::$conOpt = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false
    ];

    $noOfCons = count(self::$conPool);
    //print " Initial Size of Connection Pool: " . $noOfCons . "\n";
    //print " Max Connection Pool Size: " . $maxCons . "\n";
    //print " Connection String: " . self::$conStr . "\n";

    // Create database connections and add to the connection pool
    for ($i = $noOfCons; $i < $maxCons; $i++) {
      $con = new PDO(self::$conStr, $userName, $password, self::$conOpt);
      array_push(self::$conPool, $con);
    }

    $noOfCons = count(self::$conPool);
    //print " Final Size of Connection Pool: " . $noOfCons . "\n";
  }

  // Get a Connection from the Connection Pool
  public static function get_con() {
    if (count(self::$conPool) == 0) {
      self::init();
    }
    return self::$conPool[rand(0, count(self::$conPool)-1)];
  }

  // Create a Database
  public static function createDB() {
    $statement = self::get_con()->prepare('CREATE DATABASE IF NOT EXISTS ' . $dbname);
    if (!$statement->execute()) {
      throw new Exception("Database Error: CREATE DATABASE query failed.");
    }
  }

  // Run a Query
  public static function runQuery($queryString) {
    $con = self::get_con();

    try {
      $statement = $con->prepare($queryString);
    } catch (PDOException $e) {
      error_log($e->getMessage());
      error_log($e->getCode());
      throw $e;
    }

    if (!$statement->execute()) {
      die("Failed!");
    }

    try {
      return $statement->fetchAll();
    } catch (Exception $e) {
      return;
    }
  }

}


?>