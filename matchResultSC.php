<?php
if($config_included == "") {
	include("config.php");
}

if($dataBase_included == "") {
	include("database.php");
}

$matchResultsSC_included = "Y";

class MatchResultSC {

	// Create properties for match results from Code Orange Scouters
	private $tournamentName;
	private $matchNumber;
	private $matchType;
	private $blue1_teamNumber;
	private $blue2_teamNumber;
	private $blue3_teamNumber;
	private $red1_teamNumber;
	private $red2_teamNumber;
	private $red3_teamNumber;
	
	// Data aggregated from match detail table (which is populated by the match scouters)
	private $blue1_upper_auto;
	private $blue2_upper_auto;
	private $blue3_upper_auto;
	private $red1_uper_auto;
	private $red2_upper_auto;
	private $red3_upper_auto;
	private $blue1_lower_auto;
	private $blue2_lower_auto;
	private $blue3_lower_auto;
	private $red1_lower_auto;
	private $red2_lower_auto;
	private $red3_lower_auto;
	private $blue1_upper_teleop;
	private $blue2_upper_teleop;
	private $blue3_upper_teleop;
	private $red1_uper_teleop;
	private $red2_upper_teleop;
	private $red3_upper_teleop;
	private $blue1_lower_teleop;
	private $blue2_lower_teleop;
	private $blue3_lower_teleop;
	private $red1_lower_teleop;
	private $red2_lower_teleop;
	private $red3_lower_teleop;
	private $blue1_climb;
	private $blue2_climb;
	private $blue3_climb;
	private $red1_climb;
	private $red2_climb;
	private $red3_climb;
	private $blue1_defense_score;
	private $blue2_defense_score;
	private $blue3_defense_score;
	private $red1_defense_score;
	private $red2_defense_score;
	private $red3_defense_score;


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

	public function get_blue1_upper_auto() {
		return $this->blue1_upper_auto;
	}

	public function get_blue2_upper_auto() {
		return $this->blue2_upper_auto;
	}

	public function get_blue3_upper_auto() {
		return $this->blue3_upper_auto;
	}

	public function get_red1_uper_auto() {
		return $this->red1_uper_auto;
	}

	public function get_red2_upper_auto() {
		return $this->red2_upper_auto;
	}

	public function get_red3_upper_auto() {
		return $this->red3_upper_auto;
	}

	public function get_blue1_lower_auto() {
		return $this->blue1_lower_auto;
	}

	public function get_blue2_lower_auto() {
		return $this->blue2_lower_auto;
	}

	public function get_blue3_lower_auto() {
		return $this->blue3_lower_auto;
	}

	public function get_red1_lower_auto() {
		return $this->red1_lower_auto;
	}

	public function get_red2_lower_auto() {
		return $this->red2_lower_auto;
	}

	public function get_red3_lower_auto() {
		return $this->red3_lower_auto;
	}

	public function get_blue1_upper_teleop() {
		return $this->blue1_upper_teleop;
	}

	public function get_blue2_upper_teleop() {
		return $this->blue2_upper_teleop;
	}

	public function get_blue3_upper_teleop() {
		return $this->blue3_upper_teleop;
	}

	public function get_red1_uper_teleop() {
		return $this->red1_uper_teleop;
	}

	public function get_red2_upper_teleop() {
		return $this->red2_upper_teleop;
	}

	public function get_red3_upper_teleop() {
		return $this->red3_upper_teleop;
	}

	public function get_blue1_lower_teleop() {
		return $this->blue1_lower_teleop;
	}

	public function get_blue2_lower_teleop() {
		return $this->blue2_lower_teleop;
	}

	public function get_blue3_lower_teleop() {
		return $this->blue3_lower_teleop;
	}

	public function get_red1_lower_teleop() {
		return $this->red1_lower_teleop;
	}

	public function get_red2_lower_teleop() {
		return $this->red2_lower_teleop;
	}

	public function get_red3_lower_teleop() {
		return $this->red3_lower_teleop;
	}

	public function get_blue1_climb() {
		return $this->blue1_climb;
	}

	public function get_blue2_climb() {
		return $this->blue2_climb;
	}

	public function get_blue3_climb() {
		return $this->blue3_climb;
	}

	public function get_red1_climb() {
		return $this->red1_climb;
	}

	public function get_red2_climb() {
		return $this->red2_climb;
	}

	public function get_red3_climb() {
		return $this->red3_climb;
	}

	public function get_blue1_defense_score() {
		return $this->blue1_defense_score;
	}

	public function get_blue2_defense_score() {
		return $this->blue2_defense_score;
	}

	public function get_blue3_defense_score() {
		return $this->blue3_defense_score;
	}

	public function get_red1_defense_score() {
		return $this->red1_defense_score;
	}

	public function get_red2_defense_score() {
		return $this->red2_defense_score;
	}

	public function get_red3_defense_score() {
		return $this->red3_defense_score;
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

	public function set_blue1_upper_auto($blue1_upper_auto) {
		$this->blue1_upper_auto = $blue1_upper_auto;
	}

	public function set_blue2_upper_auto($blue2_upper_auto) {
		$this->blue2_upper_auto = $blue2_upper_auto;
	}

	public function set_blue3_upper_auto($blue3_upper_auto) {
		$this->blue3_upper_auto = $blue3_upper_auto;
	}

	public function set_red1_uper_auto($red1_uper_auto) {
		$this->red1_uper_auto = $red1_uper_auto;
	}

	public function set_red2_upper_auto($red2_upper_auto) {
		$this->red2_upper_auto = $red2_upper_auto;
	}

	public function set_red3_upper_auto($red3_upper_auto) {
		$this->red3_upper_auto = $red3_upper_auto;
	}

	public function set_blue1_lower_auto($blue1_lower_auto) {
		$this->blue1_lower_auto = $blue1_lower_auto;
	}

	public function set_blue2_lower_auto($blue2_lower_auto) {
		$this->blue2_lower_auto = $blue2_lower_auto;
	}

	public function set_blue3_lower_auto($blue3_lower_auto) {
		$this->blue3_lower_auto = $blue3_lower_auto;
	}

	public function set_red1_lower_auto($red1_lower_auto) {
		$this->red1_lower_auto = $red1_lower_auto;
	}

	public function set_red2_lower_auto($red2_lower_auto) {
		$this->red2_lower_auto = $red2_lower_auto;
	}

	public function set_red3_lower_auto($red3_lower_auto) {
		$this->red3_lower_auto = $red3_lower_auto;
	}

	public function set_blue1_upper_teleop($blue1_upper_teleop) {
		$this->blue1_upper_teleop = $blue1_upper_teleop;
	}

	public function set_blue2_upper_teleop($blue2_upper_teleop) {
		$this->blue2_upper_teleop = $blue2_upper_teleop;
	}

	public function set_blue3_upper_teleop($blue3_upper_teleop) {
		$this->blue3_upper_teleop = $blue3_upper_teleop;
	}

	public function set_red1_uper_teleop($red1_uper_teleop) {
		$this->red1_uper_teleop = $red1_uper_teleop;
	}

	public function set_red2_upper_teleop($red2_upper_teleop) {
		$this->red2_upper_teleop = $red2_upper_teleop;
	}

	public function set_red3_upper_teleop($red3_upper_teleop) {
		$this->red3_upper_teleop = $red3_upper_teleop;
	}

	public function set_blue1_lower_teleop($blue1_lower_teleop) {
		$this->blue1_lower_teleop = $blue1_lower_teleop;
	}

	public function set_blue2_lower_teleop($blue2_lower_teleop) {
		$this->blue2_lower_teleop = $blue2_lower_teleop;
	}

	public function set_blue3_lower_teleop($blue3_lower_teleop) {
		$this->blue3_lower_teleop = $blue3_lower_teleop;
	}

	public function set_red1_lower_teleop($red1_lower_teleop) {
		$this->red1_lower_teleop = $red1_lower_teleop;
	}

	public function set_red2_lower_teleop($red2_lower_teleop) {
		$this->red2_lower_teleop = $red2_lower_teleop;
	}

	public function set_red3_lower_teleop($red3_lower_teleop) {
		$this->red3_lower_teleop = $red3_lower_teleop;
	}

	public function set_blue1_climb($blue1_climb) {
		$this->blue1_climb = $blue1_climb;
	}

	public function set_blue2_climb($blue2_climb) {
		$this->blue2_climb = $blue2_climb;
	}

	public function set_blue3_climb($blue3_climb) {
		$this->blue3_climb = $blue3_climb;
	}

	public function set_red1_climb($red1_climb) {
		$this->red1_climb = $red1_climb;
	}

	public function set_red2_climb($red2_climb) {
		$this->red2_climb = $red2_climb;
	}

	public function set_red3_climb($red3_climb) {
		$this->red3_climb = $red3_climb;
	}

	public function set_blue1_defense_score($blue1_defense_score) {
		$this->blue1_defense_score = $blue1_defense_score;
	}

	public function set_blue2_defense_score($blue2_defense_score) {
		$this->blue2_defense_score = $blue2_defense_score;
	}

	public function set_blue3_defense_score($blue3_defense_score) {
		$this->blue3_defense_score = $blue3_defense_score;
	}

	public function set_red1_defense_score($red1_defense_score) {
		$this->red1_defense_score = $red1_defense_score;
	}

	public function set_red2_defense_score($red2_defense_score) {
		$this->red2_defense_score = $red2_defense_score;
	}

	public function set_red3_defense_score($red3_defense_score) {
		$this->red3_defense_score = $red3_defense_score;
	}

	// Create Table
	public static function createMatchResultSCTable() {
		global $dbnane;
		global $matchresultscTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $matchresultscTable . " (
			tournamentName VARCHAR(100) NOT NULL,
			matchNumber VARCHAR(10) NOT NULL,
			matchType VARCHAR(10) NOT NULL,
			blue1_teamNumber VARCHAR(10) NOT NULL,
			blue2_teamNumber VARCHAR(10) NOT NULL,
			blue3_teamNumber VARCHAR(10) NOT NULL,
			red1_teamNumber VARCHAR(10) NOT NULL,
			red2_teamNumber VARCHAR(10) NOT NULL,
			red3_teamNumber VARCHAR(10) NOT NULL,
			blue1_upper_auto VARCHAR(10) NULL,
			blue2_upper_auto VARCHAR(10) NULL,
			blue3_upper_auto VARCHAR(10) NULL,
			red1_uper_auto VARCHAR(10) NULL,
			red2_upper_auto VARCHAR(10) NULL,
			red3_upper_auto VARCHAR(10) NULL,
			blue1_lower_auto VARCHAR(10) NULL,
			blue2_lower_auto VARCHAR(10) NULL,
			blue3_lower_auto VARCHAR(10) NULL,
			red1_lower_auto VARCHAR(10) NULL,
			red2_lower_auto VARCHAR(10) NULL,
			red3_lower_auto VARCHAR(10) NULL,
			blue1_upper_teleop VARCHAR(10) NULL,
			blue2_upper_teleop VARCHAR(10) NULL,
			blue3_upper_teleop VARCHAR(10) NULL,
			red1_uper_teleop VARCHAR(10) NULL,
			red2_upper_teleop VARCHAR(10) NULL,
			red3_upper_teleop VARCHAR(10) NULL,
			blue1_lower_teleop VARCHAR(10) NULL,
			blue2_lower_teleop VARCHAR(10) NULL,
			blue3_lower_teleop VARCHAR(10) NULL,
			red1_lower_teleop VARCHAR(10) NULL,
			red2_lower_teleop VARCHAR(10) NULL,
			red3_lower_teleop VARCHAR(10) NULL,
			blue1_climb VARCHAR(10) NULL,
			blue2_climb VARCHAR(10) NULL,
			blue3_climb VARCHAR(10) NULL,
			red1_climb VARCHAR(10) NULL,
			red2_climb VARCHAR(10) NULL,
			red3_climb VARCHAR(10) NULL,
			blue1_defense_score VARCHAR(10) NULL,
			blue2_defense_score VARCHAR(10) NULL,
			blue3_defense_score VARCHAR(10) NULL,
			red1_defense_score VARCHAR(10) NULL,
			red2_defense_score VARCHAR(10) NULL,
			red3_defense_score VARCHAR(10) NULL,
			PRIMARY KEY (tournamentName, matchNumber)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readMatchResultSCData($tournamentName, $matchNumber) {
		global $matchresultscTable;
		$queryString = "SELECT * FROM `" . $matchresultscTable . "` WHERE tournamentName = '" . $tournamentName . "' and matchNumber = '" . $matchNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultSCTable();
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
			$this->blue1_upper_auto = $result[0]['blue1_upper_auto'];
			$this->blue2_upper_auto = $result[0]['blue2_upper_auto'];
			$this->blue3_upper_auto = $result[0]['blue3_upper_auto'];
			$this->red1_uper_auto = $result[0]['red1_uper_auto'];
			$this->red2_upper_auto = $result[0]['red2_upper_auto'];
			$this->red3_upper_auto = $result[0]['red3_upper_auto'];
			$this->blue1_lower_auto = $result[0]['blue1_lower_auto'];
			$this->blue2_lower_auto = $result[0]['blue2_lower_auto'];
			$this->blue3_lower_auto = $result[0]['blue3_lower_auto'];
			$this->red1_lower_auto = $result[0]['red1_lower_auto'];
			$this->red2_lower_auto = $result[0]['red2_lower_auto'];
			$this->red3_lower_auto = $result[0]['red3_lower_auto'];
			$this->blue1_upper_teleop = $result[0]['blue1_upper_teleop'];
			$this->blue2_upper_teleop = $result[0]['blue2_upper_teleop'];
			$this->blue3_upper_teleop = $result[0]['blue3_upper_teleop'];
			$this->red1_uper_teleop = $result[0]['red1_uper_teleop'];
			$this->red2_upper_teleop = $result[0]['red2_upper_teleop'];
			$this->red3_upper_teleop = $result[0]['red3_upper_teleop'];
			$this->blue1_lower_teleop = $result[0]['blue1_lower_teleop'];
			$this->blue2_lower_teleop = $result[0]['blue2_lower_teleop'];
			$this->blue3_lower_teleop = $result[0]['blue3_lower_teleop'];
			$this->red1_lower_teleop = $result[0]['red1_lower_teleop'];
			$this->red2_lower_teleop = $result[0]['red2_lower_teleop'];
			$this->red3_lower_teleop = $result[0]['red3_lower_teleop'];
			$this->blue1_climb = $result[0]['blue1_climb'];
			$this->blue2_climb = $result[0]['blue2_climb'];
			$this->blue3_climb = $result[0]['blue3_climb'];
			$this->red1_climb = $result[0]['red1_climb'];
			$this->red2_climb = $result[0]['red2_climb'];
			$this->red3_climb = $result[0]['red3_climb'];
			$this->blue1_defense_score = $result[0]['blue1_defense_score'];
			$this->blue2_defense_score = $result[0]['blue2_defense_score'];
			$this->blue3_defense_score = $result[0]['blue3_defense_score'];
			$this->red1_defense_score = $result[0]['red1_defense_score'];
			$this->red2_defense_score = $result[0]['red2_defense_score'];
			$this->red3_defense_score = $result[0]['red3_defense_score'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	// Write to Table
	public function writeMatchResultSCData() {
		global $matchresultscTable;
		$queryString = "REPLACE INTO `" . $matchresultscTable . "` (tournamentName, matchNumber, matchType, blue1_teamNumber, blue2_teamNumber, blue3_teamNumber, red1_teamNumber, red2_teamNumber, red3_teamNumber, blue1_upper_auto, blue2_upper_auto, blue3_upper_auto, red1_uper_auto, red2_upper_auto, red3_upper_auto, blue1_lower_auto, blue2_lower_auto, blue3_lower_auto, red1_lower_auto, red2_lower_auto, red3_lower_auto, blue1_upper_teleop, blue2_upper_teleop, blue3_upper_teleop, red1_uper_teleop, red2_upper_teleop, red3_upper_teleop, blue1_lower_teleop, blue2_lower_teleop, blue3_lower_teleop, red1_lower_teleop, red2_lower_teleop, red3_lower_teleop, blue1_climb, blue2_climb, blue3_climb, red1_climb, red2_climb, red3_climb, blue1_defense_score, blue2_defense_score, blue3_defense_score, red1_defense_score, red2_defense_score, red3_defense_score)";
		$queryString = $queryString . ' VALUES ("' . $this->tournamentName . '","' . $this->matchNumber . '","' . $this->matchType . '","' . $this->blue1_teamNumber . '","' . $this->blue2_teamNumber . '","' . $this->blue3_teamNumber . '","' . $this->red1_teamNumber . '","' . $this->red2_teamNumber . '","' . $this->red3_teamNumber . '","' . $this->blue1_upper_auto . '","' . $this->blue2_upper_auto . '","' . $this->blue3_upper_auto . '","' . $this->red1_uper_auto . '","' . $this->red2_upper_auto . '","' . $this->red3_upper_auto . '","' . $this->blue1_lower_auto . '","' . $this->blue2_lower_auto . '","' . $this->blue3_lower_auto . '","' . $this->red1_lower_auto . '","' . $this->red2_lower_auto . '","' . $this->red3_lower_auto . '","' . $this->blue1_upper_teleop . '","' . $this->blue2_upper_teleop . '","' . $this->blue3_upper_teleop . '","' . $this->red1_uper_teleop . '","' . $this->red2_upper_teleop . '","' . $this->red3_upper_teleop . '","' . $this->blue1_lower_teleop . '","' . $this->blue2_lower_teleop . '","' . $this->blue3_lower_teleop . '","' . $this->red1_lower_teleop . '","' . $this->red2_lower_teleop . '","' . $this->red3_lower_teleop . '","' . $this->blue1_climb . '","' . $this->blue2_climb . '","' . $this->blue3_climb . '","' . $this->red1_climb . '","' . $this->red2_climb . '","' . $this->red3_climb . '","' . $this->blue1_defense_score . '","' . $this->blue2_defense_score . '","' . $this->blue3_defense_score . '","' . $this->red1_defense_score . '","' . $this->red2_defense_score . '","' . $this->red3_defense_score . '")';
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
