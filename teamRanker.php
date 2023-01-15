<?php
include("config.php");
include("database.php");

class teamRanker {

	// Create properties for teamRanker
	private $score;
	private $teamNumber;


	// Default Constructor
	public function __construct () {
	}

	// Getter function for each class property
	public function get_score() {
		return $this->score;
	}

	public function get_teamNumber() {
		return $this->teamNumber;
	}


	// Setter function for each class property
	public function set_score($score) {
		$this->score = $score;
	}

	public function set_teamNumber($teamNumber) {
		$this->teamNumber = $teamNumber;
	}



	// Create Table
	public static function createteamRankerTable() {
		global $dbnane;
		global $teamrankerTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $teamrankerTable . " (
			score INT(11) NOT NULL,
			teamNumber VARCHAR(10) NOT NULL,
			PRIMARY KEY (teamNumber)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readteamRankerData($teamNumber) {
		global $teamrankerTable;
		$queryString = "SELECT * FROM `" . $teamrankerTable . "` WHERE teamNumber = '" . $teamNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createteamRankerTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		if (count($result) > 0) {
			$this->score = $result[0]['score'];
			$this->teamNumber = $result[0]['teamNumber'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	// Write to Table
	public function writeteamRankerData() {
		global $teamrankerTable;
		$queryString = "REPLACE INTO `" . $teamrankerTable . "` (score, teamNumber)";
		$queryString = $queryString . ' VALUES ("' . $this->score . '","' . $this->teamNumber . '")';
		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createteamRankerTable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
