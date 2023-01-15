<?php
if($config_included == "") {
	include("config.php");
}

if($dataBase_included == "") {
	include("database.php");
}

class MatchResultVA {

	// Create properties for match results from Code Orange Video Analysis
	private $tournamentName;
	private $matchNumber;
	private $matchType;
	private $blue1_teamNumber;
	private $blue2_teamNumber;
	private $blue3_teamNumber;
	private $red1_teamNumber;
	private $red2_teamNumber;
	private $red3_teamNumber;
	
	// Data captured from video analysis of the match (near future)
	private $blue1_headmap;
	private $blue2_headmap;
	private $blue3_headmap;
	private $red1_headmap;
	private $red2_headmap;
	private $red3_headmap;


	// Default Constructor
	public function __construct () {
	}

	// Getter function for each class property
	public function get_tournamentName() {
		return $this->tournamentName;
	}

	public function get_matchNumber() {
		return $this->matchNumber;
	}

	public function get_matchType() {
		return $this->matchType;
	}

	public function get_blue1_teamNumber() {
		return $this->blue1_teamNumber;
	}

	public function get_blue2_teamNumber() {
		return $this->blue2_teamNumber;
	}

	public function get_blue3_teamNumber() {
		return $this->blue3_teamNumber;
	}

	public function get_red1_teamNumber() {
		return $this->red1_teamNumber;
	}

	public function get_red2_teamNumber() {
		return $this->red2_teamNumber;
	}

	public function get_red3_teamNumber() {
		return $this->red3_teamNumber;
	}

	public function get_blue1_headmap() {
		return $this->blue1_headmap;
	}

	public function get_blue2_headmap() {
		return $this->blue2_headmap;
	}

	public function get_blue3_headmap() {
		return $this->blue3_headmap;
	}

	public function get_red1_headmap() {
		return $this->red1_headmap;
	}

	public function get_red2_headmap() {
		return $this->red2_headmap;
	}

	public function get_red3_headmap() {
		return $this->red3_headmap;
	}


	// Setter function for each class property
	public function set_tournamentName($tournamentName) {
		$this->tournamentName = $tournamentName;
	}

	public function set_matchNumber($matchNumber) {
		$this->matchNumber = $matchNumber;
	}

	public function set_matchType($matchType) {
		$this->matchType = $matchType;
	}

	public function set_blue1_teamNumber($blue1_teamNumber) {
		$this->blue1_teamNumber = $blue1_teamNumber;
	}

	public function set_blue2_teamNumber($blue2_teamNumber) {
		$this->blue2_teamNumber = $blue2_teamNumber;
	}

	public function set_blue3_teamNumber($blue3_teamNumber) {
		$this->blue3_teamNumber = $blue3_teamNumber;
	}

	public function set_red1_teamNumber($red1_teamNumber) {
		$this->red1_teamNumber = $red1_teamNumber;
	}

	public function set_red2_teamNumber($red2_teamNumber) {
		$this->red2_teamNumber = $red2_teamNumber;
	}

	public function set_red3_teamNumber($red3_teamNumber) {
		$this->red3_teamNumber = $red3_teamNumber;
	}

	public function set_blue1_headmap($blue1_headmap) {
		$this->blue1_headmap = $blue1_headmap;
	}

	public function set_blue2_headmap($blue2_headmap) {
		$this->blue2_headmap = $blue2_headmap;
	}

	public function set_blue3_headmap($blue3_headmap) {
		$this->blue3_headmap = $blue3_headmap;
	}

	public function set_red1_headmap($red1_headmap) {
		$this->red1_headmap = $red1_headmap;
	}

	public function set_red2_headmap($red2_headmap) {
		$this->red2_headmap = $red2_headmap;
	}

	public function set_red3_headmap($red3_headmap) {
		$this->red3_headmap = $red3_headmap;
	}



	// Create Table
	public static function createMatchResultVATable() {
		global $dbnane;
		global $matchresultvaTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $matchresultvaTable . " (
			tournamentName VARCHAR(100) NOT NULL,
			matchNumber VARCHAR(10) NOT NULL,
			matchType VARCHAR(10) NOT NULL,
			blue1_teamNumber VARCHAR(10) NOT NULL,
			blue2_teamNumber VARCHAR(10) NOT NULL,
			blue3_teamNumber VARCHAR(10) NOT NULL,
			red1_teamNumber VARCHAR(10) NOT NULL,
			red2_teamNumber VARCHAR(10) NOT NULL,
			red3_teamNumber VARCHAR(10) NOT NULL,
			blue1_headmap VARCHAR(1000) NULL,
			blue2_headmap VARCHAR(1000) NULL,
			blue3_headmap VARCHAR(1000) NULL,
			red1_headmap VARCHAR(1000) NULL,
			red2_headmap VARCHAR(1000) NULL,
			red3_headmap VARCHAR(1000) NULL,
			PRIMARY KEY (tournamentName, matchNumber)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readMatchResultVAData($tournamentName, $matchNumber) {
		global $matchresultvaTable;
		$queryString = "SELECT * FROM `" . $matchresultvaTable . "` WHERE tournamentName = '" . $tournamentName . "' and matchNumber = '" . $matchNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultVATable();
			}
			$result = DataBase::runQuery($queryString);
		}
		if (count($result) > 0) {
			$this->tournamentName = $result[0]['tournamentName'];
			$this->matchNumber = $result[0]['matchNumber'];
			$this->matchType = $result[0]['matchType'];
			$this->blue1_teamNumber = $result[0]['blue1_teamNumber'];
			$this->blue2_teamNumber = $result[0]['blue2_teamNumber'];
			$this->blue3_teamNumber = $result[0]['blue3_teamNumber'];
			$this->red1_teamNumber = $result[0]['red1_teamNumber'];
			$this->red2_teamNumber = $result[0]['red2_teamNumber'];
			$this->red3_teamNumber = $result[0]['red3_teamNumber'];
			$this->blue1_headmap = $result[0]['blue1_headmap'];
			$this->blue2_headmap = $result[0]['blue2_headmap'];
			$this->blue3_headmap = $result[0]['blue3_headmap'];
			$this->red1_headmap = $result[0]['red1_headmap'];
			$this->red2_headmap = $result[0]['red2_headmap'];
			$this->red3_headmap = $result[0]['red3_headmap'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	// Write to Table
	public function writeMatchResultVAData() {
		global $matchresultvaTable;
		$queryString = "REPLACE INTO `" . $matchresultvaTable . "` (tournamentName, matchNumber, matchType, blue1_teamNumber, blue2_teamNumber, blue3_teamNumber, red1_teamNumber, red2_teamNumber, red3_teamNumber, blue1_headmap, blue2_headmap, blue3_headmap, red1_headmap, red2_headmap, red3_headmap)";
		$queryString = $queryString . ' VALUES ("' . $this->tournamentName . '","' . $this->matchNumber . '","' . $this->matchType . '","' . $this->blue1_teamNumber . '","' . $this->blue2_teamNumber . '","' . $this->blue3_teamNumber . '","' . $this->red1_teamNumber . '","' . $this->red2_teamNumber . '","' . $this->red3_teamNumber . '","' . $this->blue1_headmap . '","' . $this->blue2_headmap . '","' . $this->blue3_headmap . '","' . $this->red1_headmap . '","' . $this->red2_headmap . '","' . $this->red3_headmap . '")';
		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultVATable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
