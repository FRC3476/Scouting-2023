<?php
include("config.php");
include("database.php");

class Team {

	// Create properties to identify teams
	private $teamNumber;
	private $teamName;
	private $teamCountry;
	private $teamState;
	private $teamCity;


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

	public function get_teamCountry() {
		return $this->teamCountry;
	}

	public function get_teamState() {
		return $this->teamState;
	}

	public function get_teamCity() {
		return $this->teamCity;
	}


	// Setter function for each class property
	public function set_teamNumber($teamNumber) {
		$this->teamNumber = $teamNumber;
	}

	public function set_teamName($teamName) {
		$this->teamName = $teamName;
	}

	public function set_teamCountry($teamCountry) {
		$this->teamCountry = $teamCountry;
	}

	public function set_teamState($teamState) {
		$this->teamState = $teamState;
	}

	public function set_teamCity($teamCity) {
		$this->teamCity = $teamCity;
	}



	// Create Table
	public static function createTeamTable() {
		global $dbnane;
		global $teamTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $teamTable . " (
			teamNumber VARCHAR(10) NOT NULL,
			teamName VARCHAR(100) NOT NULL,
			teamCountry VARCHAR(100) NOT NULL,
			teamState VARCHAR(100) NOT NULL,
			teamCity VARCHAR(100) NOT NULL,
			PRIMARY KEY (teamNumber)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readTeamData($teamNumber) {
		global $teamTable;
		$queryString = "SELECT * FROM `" . $teamTable . "` WHERE teamNumber = '" . $teamNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createTeamTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		if (count($result) > 0) {
			$this->teamNumber = $result[0]['teamNumber'];
			$this->teamName = $result[0]['teamName'];
			$this->teamCountry = $result[0]['teamCountry'];
			$this->teamState = $result[0]['teamState'];
			$this->teamCity = $result[0]['teamCity'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	// Write to Table
	public function writeTeamData() {
		global $teamTable;
		$queryString = "REPLACE INTO `" . $teamTable . "` (teamNumber, teamName, teamCountry, teamState, teamCity)";
		$queryString = $queryString . ' VALUES ("' . $this->teamNumber . '","' . $this->teamName . '","' . $this->teamCountry . '","' . $this->teamState . '","' . $this->teamCity . '")';
		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createTeamTable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
