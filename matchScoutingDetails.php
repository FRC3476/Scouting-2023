<?php

if($config_included == "") {
	include("config.php");
}

if($dataBase_included == "") {
	include("database.php");
}

$matchScoutingDetails_included = "Y";

class MatchScoutingDetails {

	// Match scouting identifiers
	private $tournamentName;
	private $matchNumber;
	private $scouterName;
	private $teamNumber;
	private $allianceColor;
	private $eventTime;
	
	// Auto properties
	private $exit_tarmac;
	private $auto_path;
	private $auto_upper_goal;
	private $auto_upper_goal_miss;
	private $auto_lower_goal;
	private $auto_lower_goal_miss;
	
	// Teleop properties
	private $shot_location;
	private $teleop_upper_goal;
	private $teleop_upper_goal_miss;
	private $teleop_lower_goal;
	private $teleop_lower_goal_miss;
	private $climb;
	private $penalties;
	private $issues;
	private $dnp;
	private $defense;
	private $defComments;
	private $comments;


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

	public function get_scouterName() {
		return $this->scouterName;
	}

	public function get_teamNumber() {
		return $this->teamNumber;
	}

	public function get_allianceColor() {
		return $this->allianceColor;
	}

	public function get_eventTime() {
		return $this->eventTime;
	}

	public function get_exit_tarmac() {
		return $this->exit_tarmac;
	}

	public function get_auto_path() {
		return $this->auto_path;
	}

	public function get_auto_upper_goal() {
		return $this->auto_upper_goal;
	}

	public function get_auto_upper_goal_miss() {
		return $this->auto_upper_goal_miss;
	}

	public function get_auto_lower_goal() {
		return $this->auto_lower_goal;
	}

	public function get_auto_lower_goal_miss() {
		return $this->auto_lower_goal_miss;
	}

	public function get_shot_location() {
		return $this->shot_location;
	}

	public function get_teleop_upper_goal() {
		return $this->teleop_upper_goal;
	}

	public function get_teleop_upper_goal_miss() {
		return $this->teleop_upper_goal_miss;
	}

	public function get_teleop_lower_goal() {
		return $this->teleop_lower_goal;
	}

	public function get_teleop_lower_goal_miss() {
		return $this->teleop_lower_goal_miss;
	}

	public function get_climb() {
		return $this->climb;
	}

	public function get_penalties() {
		return $this->penalties;
	}

	public function get_issues() {
		return $this->issues;
	}

	public function get_dnp() {
		return $this->dnp;
	}

	public function get_defense() {
		return $this->defense;
	}

	public function get_defComments() {
		return $this->defComments;
	}

	public function get_comments() {
		return $this->comments;
	}


	// Setter function for each class property
	public function set_tournamentName($tournamentName) {
		$this->tournamentName = $tournamentName;
	}

	public function set_matchNumber($matchNumber) {
		$this->matchNumber = $matchNumber;
	}

	public function set_scouterName($scouterName) {
		$this->scouterName = $scouterName;
	}

	public function set_teamNumber($teamNumber) {
		$this->teamNumber = $teamNumber;
	}

	public function set_allianceColor($allianceColor) {
		$this->allianceColor = $allianceColor;
	}

	public function set_eventTime($eventTime) {
		$this->eventTime = $eventTime;
	}

	public function set_exit_tarmac($exit_tarmac) {
		$this->exit_tarmac = $exit_tarmac;
	}

	public function set_auto_path($auto_path) {
		$this->auto_path = $auto_path;
	}

	public function set_auto_upper_goal($auto_upper_goal) {
		$this->auto_upper_goal = $auto_upper_goal;
	}

	public function set_auto_upper_goal_miss($auto_upper_goal_miss) {
		$this->auto_upper_goal_miss = $auto_upper_goal_miss;
	}

	public function set_auto_lower_goal($auto_lower_goal) {
		$this->auto_lower_goal = $auto_lower_goal;
	}

	public function set_auto_lower_goal_miss($auto_lower_goal_miss) {
		$this->auto_lower_goal_miss = $auto_lower_goal_miss;
	}

	public function set_shot_location($shot_location) {
		$this->shot_location = $shot_location;
	}

	public function set_teleop_upper_goal($teleop_upper_goal) {
		$this->teleop_upper_goal = $teleop_upper_goal;
	}

	public function set_teleop_upper_goal_miss($teleop_upper_goal_miss) {
		$this->teleop_upper_goal_miss = $teleop_upper_goal_miss;
	}

	public function set_teleop_lower_goal($teleop_lower_goal) {
		$this->teleop_lower_goal = $teleop_lower_goal;
	}

	public function set_teleop_lower_goal_miss($teleop_lower_goal_miss) {
		$this->teleop_lower_goal_miss = $teleop_lower_goal_miss;
	}

	public function set_climb($climb) {
		$this->climb = $climb;
	}

	public function set_penalties($penalties) {
		$this->penalties = $penalties;
	}

	public function set_issues($issues) {
		$this->issues = $issues;
	}

	public function set_dnp($dnp) {
		$this->dnp = $dnp;
	}

	public function set_defense($defense) {
		$this->defense = $defense;
	}

	public function set_defComments($defComments) {
		$this->defComments = $defComments;
	}

	public function set_comments($comments) {
		$this->comments = $comments;
	}



	// Create Table
	public static function createMatchScoutingDetailsTable() {
		global $dbnane;
		global $matchscoutingdetailsTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $matchscoutingdetailsTable . " (
			tournamentName VARCHAR(100) NOT NULL,
			matchNumber VARCHAR(10) NOT NULL,
			scouterName VARCHAR(100) NOT NULL,
			teamNumber VARCHAR(10) NOT NULL,
			allianceColor VARCHAR(10) NOT NULL,
			eventTime VARCHAR(100) NOT NULL,
			exit_tarmac BOOLEAN NOT NULL,
			auto_path LONGTEXT NOT NULL,
			auto_upper_goal INT NOT NULL,
			auto_upper_goal_miss INT NOT NULL,
			auto_lower_goal INT NOT NULL,
			auto_lower_goal_miss INT NOT NULL,
			shot_location LONGTEXT NOT NULL,
			teleop_upper_goal INT NOT NULL,
			teleop_upper_goal_miss INT NOT NULL,
			teleop_lower_goal INT NOT NULL,
			teleop_lower_goal_miss INT NOT NULL,
			climb INT NOT NULL,
			penalties VARCHAR(10) NOT NULL,
			issues VARCHAR(100) NOT NULL,
			dnp INT NOT NULL,
			defense INT NOT NULL,
			defComments VARCHAR(1000) NOT NULL,
			comments VARCHAR(1000) NOT NULL,
			PRIMARY KEY (tournamentName, matchNumber, teamNumber, allianceColor, scouterName, eventTime)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readMatchScoutingDetailsData($tournamentName, $matchNumber) {
		global $matchscoutingdetailsTable;
		$queryString = "SELECT * FROM `" . $matchscoutingdetailsTable . "` WHERE tournamentName = '" . $tournamentName . "' and matchNumber = '" . $matchNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchScoutingDetailsTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		if (count($result) > 0) {
			$this->tournamentName = $result[0]['tournamentName'];
			$this->matchNumber = $result[0]['matchNumber'];
			$this->scouterName = $result[0]['scouterName'];
			$this->teamNumber = $result[0]['teamNumber'];
			$this->allianceColor = $result[0]['allianceColor'];
			$this->eventTime = $result[0]['eventTime'];
			$this->exit_tarmac = $result[0]['exit_tarmac'];
			$this->auto_path = $result[0]['auto_path'];
			$this->auto_upper_goal = $result[0]['auto_upper_goal'];
			$this->auto_upper_goal_miss = $result[0]['auto_upper_goal_miss'];
			$this->auto_lower_goal = $result[0]['auto_lower_goal'];
			$this->auto_lower_goal_miss = $result[0]['auto_lower_goal_miss'];
			$this->shot_location = $result[0]['shot_location'];
			$this->teleop_upper_goal = $result[0]['teleop_upper_goal'];
			$this->teleop_upper_goal_miss = $result[0]['teleop_upper_goal_miss'];
			$this->teleop_lower_goal = $result[0]['teleop_lower_goal'];
			$this->teleop_lower_goal_miss = $result[0]['teleop_lower_goal_miss'];
			$this->climb = $result[0]['climb'];
			$this->penalties = $result[0]['penalties'];
			$this->issues = $result[0]['issues'];
			$this->dnp = $result[0]['dnp'];
			$this->defense = $result[0]['defense'];
			$this->defComments = $result[0]['defComments'];
			$this->comments = $result[0]['comments'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	public function getAllMatchData() {
		global $matchscoutingdetailsTable;
		$queryString = "SELECT * FROM `" . $matchscoutingdetailsTable . "`";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchScoutingDetailsTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		
		return $result;
	}

	public function getAllMatchDataTor($tournament) {
		global $matchscoutingdetailsTable;
		$queryString = "SELECT * FROM `" . $matchscoutingdetailsTable . "` WHERE tournamentName = '" . $tournament . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchScoutingDetailsTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		
		return $result;
	}


	// Write to Table
	public function writeMatchScoutingDetailsData() {
		global $matchscoutingdetailsTable;
		$queryString = "REPLACE INTO `" . $matchscoutingdetailsTable . "` (tournamentName, matchNumber, scouterName, teamNumber, allianceColor, eventTime, exit_tarmac, auto_path, auto_upper_goal, auto_upper_goal_miss, auto_lower_goal, auto_lower_goal_miss, shot_location, teleop_upper_goal, teleop_upper_goal_miss, teleop_lower_goal, teleop_lower_goal_miss, climb, penalties, issues, dnp, defense, defComments, comments)";
		$queryString = $queryString . ' VALUES ("' . $this->tournamentName . '","' . $this->matchNumber . '","' . $this->scouterName . '","' . $this->teamNumber . '","' . $this->allianceColor . '","' . $this->eventTime . '","' . $this->exit_tarmac . '","' . $this->auto_path . '","' . $this->auto_upper_goal . '","' . $this->auto_upper_goal_miss . '","' . $this->auto_lower_goal . '","' . $this->auto_lower_goal_miss . '","' . $this->shot_location . '","' . $this->teleop_upper_goal . '","' . $this->teleop_upper_goal_miss . '","' . $this->teleop_lower_goal . '","' . $this->teleop_lower_goal_miss . '","' . $this->climb . '","' . $this->penalties . '","' . $this->issues . '","' . $this->dnp . '","' . $this->defense . '","' . $this->defComments . '","' . $this->comments . '")';
		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchScoutingDetailsTable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
