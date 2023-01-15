<?php
include("config.php");
include("database.php");

class LeadScout {

	// Create properties for robots
	private $matchNumber;
	private $team1;
	private $team2;
	private $team3;
	private $team4;
	private $team5;
	private $team6;


	// Default Constructor
	public function __construct () {
	}

	// Getter function for each class property
	public function get_matchNumber() {
		return $this->matchNumber;
	}

	public function get_team1() {
		return $this->team1;
	}

	public function get_team2() {
		return $this->team2;
	}

	public function get_team3() {
		return $this->team3;
	}

	public function get_team4() {
		return $this->team4;
	}

	public function get_team5() {
		return $this->team5;
	}

	public function get_team6() {
		return $this->team6;
	}


	// Setter function for each class property
	public function set_matchNumber($matchNumber) {
		$this->matchNumber = $matchNumber;
	}

	public function set_team1($team1) {
		$this->team1 = $team1;
	}

	public function set_team2($team2) {
		$this->team2 = $team2;
	}

	public function set_team3($team3) {
		$this->team3 = $team3;
	}

	public function set_team4($team4) {
		$this->team4 = $team4;
	}

	public function set_team5($team5) {
		$this->team5 = $team5;
	}

	public function set_team6($team6) {
		$this->team6 = $team6;
	}



	// Create Table
	public static function createLeadScoutTable() {
		global $dbnane;
		global $leadscoutTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $leadscoutTable . " (
			matchNumber VARCHAR(25) NOT NULL,
			team1 VARCHAR(10) NOT NULL,
			team2 VARCHAR(10) NOT NULL,
			team3 VARCHAR(10) NOT NULL,
			team4 VARCHAR(10) NOT NULL,
			team5 VARCHAR(10) NOT NULL,
			team6 VARCHAR(10) NOT NULL,
			PRIMARY KEY (matchNumber)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readLeadScoutData($matchNumber) {
		global $leadscoutTable;
		$queryString = "SELECT * FROM `" . $leadscoutTable . "` WHERE matchNumber = '" . $matchNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createLeadScoutTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		if (count($result) > 0) {
			$this->matchNumber = $result[0]['matchNumber'];
			$this->team1 = $result[0]['team1'];
			$this->team2 = $result[0]['team2'];
			$this->team3 = $result[0]['team3'];
			$this->team4 = $result[0]['team4'];
			$this->team5 = $result[0]['team5'];
			$this->team6 = $result[0]['team6'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	// Write to Table
	public function writeLeadScoutData() {
		global $leadscoutTable;
		$queryString = "REPLACE INTO `" . $leadscoutTable . "` (matchNumber, team1, team2, team3, team4, team5, team6)";
		$queryString = $queryString . ' VALUES ("' . $this->matchNumber . '","' . $this->team1 . '","' . $this->team2 . '","' . $this->team3 . '","' . $this->team4 . '","' . $this->team5 . '","' . $this->team6 . '")';
		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createLeadScoutTable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
