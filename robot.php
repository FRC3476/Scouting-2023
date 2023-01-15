<?php
if($config_included == "") {
	include("config.php");
}

if($dataBase_included == "") {
	include("database.php");
}

class Robot {

	// Create properties for robots
	private $teamNumber;
	private $teamName;
	private $numBatteries;
	private $chargedBatteries;
	private $codeLanguage;
	private $climbLevel;
	private $falconLoctite;
	private $autoPath;
	private $comments;


	// Default Constructor
	public function __construct () {
	}

	// Getter function for each class property
	public function get_teamNumber() {
		return $this->teamNumber;
	}

	public function get_teamName() {
		return $this->teamName;
	}

	public function get_numBatteries() {
		return $this->numBatteries;
	}

	public function get_chargedBatteries() {
		return $this->chargedBatteries;
	}

	public function get_codeLanguage() {
		return $this->codeLanguage;
	}

	public function get_climbLevel() {
		return $this->climbLevel;
	}

	public function get_falconLoctite() {
		return $this->falconLoctite;
	}

	public function get_autoPath() {
		return $this->autoPath;
	}

	public function get_comments() {
		return $this->comments;
	}


	// Setter function for each class property
	public function set_teamNumber($teamNumber) {
		$this->teamNumber = $teamNumber;
	}

	public function set_teamName($teamName) {
		$this->teamName = $teamName;
	}

	public function set_numBatteries($numBatteries) {
		$this->numBatteries = $numBatteries;
	}

	public function set_chargedBatteries($chargedBatteries) {
		$this->chargedBatteries = $chargedBatteries;
	}

	public function set_codeLanguage($codeLanguage) {
		$this->codeLanguage = $codeLanguage;
	}

	public function set_climbLevel($climbLevel) {
		$this->climbLevel = $climbLevel;
	}

	public function set_falconLoctite($falconLoctite) {
		$this->falconLoctite = $falconLoctite;
	}

	public function set_autoPath($autoPath) {
		$this->autoPath = $autoPath;
	}

	public function set_comments($comments) {
		$this->comments = $comments;
	}



	// Create Table
	public static function createRobotTable() {
		global $dbnane;
		global $robotTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $robotTable . " (
			teamNumber VARCHAR(10) NOT NULL,
			teamName VARCHAR(50) NOT NULL,
			numBatteries INT NOT NULL,
			chargedBatteries INT NOT NULL,
			codeLanguage VARCHAR(20) NOT NULL,
			climbLevel INT NOT NULL,
			falconLoctite VARCHAR(100) NOT NULL,
			autoPath LONGTEXT NOT NULL,
			comments LONGTEXT NOT NULL,
			PRIMARY KEY (teamNumber)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readRobotData($teamNumber) {
		global $robotTable;
		$queryString = "SELECT * FROM `" . $robotTable . "` WHERE teamNumber = '" . $teamNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createRobotTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		if (count($result) > 0) {
			$this->teamNumber = $result[0]['teamNumber'];
			$this->teamName = $result[0]['teamName'];
			$this->numBatteries = $result[0]['numBatteries'];
			$this->chargedBatteries = $result[0]['chargedBatteries'];
			$this->codeLanguage = $result[0]['codeLanguage'];
			$this->climbLevel = $result[0]['climbLevel'];
			$this->falconLoctite = $result[0]['falconLoctite'];
			$this->autoPath = $result[0]['autoPath'];
			$this->comments = $result[0]['comments'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	// Write to Table
	public function writeRobotData() {
		global $robotTable;
		$queryString = "REPLACE INTO `" . $robotTable . "` (teamNumber, teamName, numBatteries, chargedBatteries, codeLanguage, climbLevel, falconLoctite, autoPath, comments)";
		$queryString = $queryString . ' VALUES ("' . $this->teamNumber . '","' . $this->teamName . '","' . $this->numBatteries . '","' . $this->chargedBatteries . '","' . $this->codeLanguage . '","' . $this->climbLevel . '","' . $this->falconLoctite . '","' . $this->autoPath . '","' . $this->comments . '")';
		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createRobotTable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
