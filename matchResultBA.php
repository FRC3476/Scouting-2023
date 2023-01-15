<?php
if($config_included == "") {
	include("config.php");
}

if($dataBase_included == "") {
	include("database.php");
}

$matchResultsBA_included = "Y";

class MatchResultBA {

	// Create properties for match results from blue alliance
	private $tournamentName;
	private $matchNumber;
	private $matchType;
	private $blue1_teamNumber;
	private $blue2_teamNumber;
	private $blue3_teamNumber;
	private $red1_teamNumber;
	private $red2_teamNumber;
	private $red3_teamNumber;
	
	// Data collected from theblueAlliance.com via API/Screen Scraping
	private $blue1_taxi;
	private $blue2_taxi;
	private $blue3_taxi;
	private $red1_taxi;
	private $red2_taxi;
	private $red3_taxi;
	private $blue_auto_lower;
	private $blue_auto_upper;
	private $red_auto_lower;
	private $red_auto_upper;
	private $blue_total_auto;
	private $red_total_auto;
	private $blue_teleop_lower;
	private $blue_teleop_upper;
	private $red_teleop_lower;
	private $red_teleop_upper;
	private $blue_total_teleop;
	private $red_total_teleop;
	private $blue_cargo_bonus;
	private $red_cargo_bonus;
	private $blue1_end_game;
	private $blue2_end_game;
	private $blue3_end_game;
	private $red1_end_game;
	private $red2_end_game;
	private $red3_end_game;
	private $blue_hanger_points;
	private $red_hanger_points;
	private $blue_hangar_bonus;
	private $red_hangar_bonus;
	private $blue_fouls;
	private $red_fouls;
	private $blue_total_score;
	private $red_total_score;
	private $blue_ranking_points;
	private $red_ranking_points;
	private $winning_alliance;


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

	public function get_blue1_taxi() {
		return $this->blue1_taxi;
	}

	public function get_blue2_taxi() {
		return $this->blue2_taxi;
	}

	public function get_blue3_taxi() {
		return $this->blue3_taxi;
	}

	public function get_red1_taxi() {
		return $this->red1_taxi;
	}

	public function get_red2_taxi() {
		return $this->red2_taxi;
	}

	public function get_red3_taxi() {
		return $this->red3_taxi;
	}

	public function get_blue_auto_lower() {
		return $this->blue_auto_lower;
	}

	public function get_blue_auto_upper() {
		return $this->blue_auto_upper;
	}

	public function get_red_auto_lower() {
		return $this->red_auto_lower;
	}

	public function get_red_auto_upper() {
		return $this->red_auto_upper;
	}

	public function get_blue_total_auto() {
		return $this->blue_total_auto;
	}

	public function get_red_total_auto() {
		return $this->red_total_auto;
	}

	public function get_blue_teleop_lower() {
		return $this->blue_teleop_lower;
	}

	public function get_blue_teleop_upper() {
		return $this->blue_teleop_upper;
	}

	public function get_red_teleop_lower() {
		return $this->red_teleop_lower;
	}

	public function get_red_teleop_upper() {
		return $this->red_teleop_upper;
	}

	public function get_blue_total_teleop() {
		return $this->blue_total_teleop;
	}

	public function get_red_total_teleop() {
		return $this->red_total_teleop;
	}

	public function get_blue_cargo_bonus() {
		return $this->blue_cargo_bonus;
	}

	public function get_red_cargo_bonus() {
		return $this->red_cargo_bonus;
	}

	public function get_blue1_end_game() {
		return $this->blue1_end_game;
	}

	public function get_blue2_end_game() {
		return $this->blue2_end_game;
	}

	public function get_blue3_end_game() {
		return $this->blue3_end_game;
	}

	public function get_red1_end_game() {
		return $this->red1_end_game;
	}

	public function get_red2_end_game() {
		return $this->red2_end_game;
	}

	public function get_red3_end_game() {
		return $this->red3_end_game;
	}

	public function get_blue_hanger_points() {
		return $this->blue_hanger_points;
	}

	public function get_red_hanger_points() {
		return $this->red_hanger_points;
	}

	public function get_blue_hangar_bonus() {
		return $this->blue_hangar_bonus;
	}

	public function get_red_hangar_bonus() {
		return $this->red_hangar_bonus;
	}

	public function get_blue_fouls() {
		return $this->blue_fouls;
	}

	public function get_red_fouls() {
		return $this->red_fouls;
	}

	public function get_blue_total_score() {
		return $this->blue_total_score;
	}

	public function get_red_total_score() {
		return $this->red_total_score;
	}

	public function get_blue_ranking_points() {
		return $this->blue_ranking_points;
	}

	public function get_red_ranking_points() {
		return $this->red_ranking_points;
	}

	public function get_winning_alliance() {
		return $this->winning_alliance;
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

	public function set_blue1_taxi($blue1_taxi) {
		$this->blue1_taxi = $blue1_taxi;
	}

	public function set_blue2_taxi($blue2_taxi) {
		$this->blue2_taxi = $blue2_taxi;
	}

	public function set_blue3_taxi($blue3_taxi) {
		$this->blue3_taxi = $blue3_taxi;
	}

	public function set_red1_taxi($red1_taxi) {
		$this->red1_taxi = $red1_taxi;
	}

	public function set_red2_taxi($red2_taxi) {
		$this->red2_taxi = $red2_taxi;
	}

	public function set_red3_taxi($red3_taxi) {
		$this->red3_taxi = $red3_taxi;
	}

	public function set_blue_auto_lower($blue_auto_lower) {
		$this->blue_auto_lower = $blue_auto_lower;
	}

	public function set_blue_auto_upper($blue_auto_upper) {
		$this->blue_auto_upper = $blue_auto_upper;
	}

	public function set_red_auto_lower($red_auto_lower) {
		$this->red_auto_lower = $red_auto_lower;
	}

	public function set_red_auto_upper($red_auto_upper) {
		$this->red_auto_upper = $red_auto_upper;
	}

	public function set_blue_total_auto($blue_total_auto) {
		$this->blue_total_auto = $blue_total_auto;
	}

	public function set_red_total_auto($red_total_auto) {
		$this->red_total_auto = $red_total_auto;
	}

	public function set_blue_teleop_lower($blue_teleop_lower) {
		$this->blue_teleop_lower = $blue_teleop_lower;
	}

	public function set_blue_teleop_upper($blue_teleop_upper) {
		$this->blue_teleop_upper = $blue_teleop_upper;
	}

	public function set_red_teleop_lower($red_teleop_lower) {
		$this->red_teleop_lower = $red_teleop_lower;
	}

	public function set_red_teleop_upper($red_teleop_upper) {
		$this->red_teleop_upper = $red_teleop_upper;
	}

	public function set_blue_total_teleop($blue_total_teleop) {
		$this->blue_total_teleop = $blue_total_teleop;
	}

	public function set_red_total_teleop($red_total_teleop) {
		$this->red_total_teleop = $red_total_teleop;
	}

	public function set_blue_cargo_bonus($blue_cargo_bonus) {
		$this->blue_cargo_bonus = $blue_cargo_bonus;
	}

	public function set_red_cargo_bonus($red_cargo_bonus) {
		$this->red_cargo_bonus = $red_cargo_bonus;
	}

	public function set_blue1_end_game($blue1_end_game) {
		$this->blue1_end_game = $blue1_end_game;
	}

	public function set_blue2_end_game($blue2_end_game) {
		$this->blue2_end_game = $blue2_end_game;
	}

	public function set_blue3_end_game($blue3_end_game) {
		$this->blue3_end_game = $blue3_end_game;
	}

	public function set_red1_end_game($red1_end_game) {
		$this->red1_end_game = $red1_end_game;
	}

	public function set_red2_end_game($red2_end_game) {
		$this->red2_end_game = $red2_end_game;
	}

	public function set_red3_end_game($red3_end_game) {
		$this->red3_end_game = $red3_end_game;
	}

	public function set_blue_hanger_points($blue_hanger_points) {
		$this->blue_hanger_points = $blue_hanger_points;
	}

	public function set_red_hanger_points($red_hanger_points) {
		$this->red_hanger_points = $red_hanger_points;
	}

	public function set_blue_hangar_bonus($blue_hangar_bonus) {
		$this->blue_hangar_bonus = $blue_hangar_bonus;
	}

	public function set_red_hangar_bonus($red_hangar_bonus) {
		$this->red_hangar_bonus = $red_hangar_bonus;
	}

	public function set_blue_fouls($blue_fouls) {
		$this->blue_fouls = $blue_fouls;
	}

	public function set_red_fouls($red_fouls) {
		$this->red_fouls = $red_fouls;
	}

	public function set_blue_total_score($blue_total_score) {
		$this->blue_total_score = $blue_total_score;
	}

	public function set_red_total_score($red_total_score) {
		$this->red_total_score = $red_total_score;
	}

	public function set_blue_ranking_points($blue_ranking_points) {
		$this->blue_ranking_points = $blue_ranking_points;
	}

	public function set_red_ranking_points($red_ranking_points) {
		$this->red_ranking_points = $red_ranking_points;
	}

	public function set_winning_alliance($winning_alliance) {
		$this->winning_alliance = $winning_alliance;
	}

	// Create Table
	public static function createMatchResultBATable() {
		global $dbnane;
		global $matchresultbaTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $matchresultbaTable . " (
			tournamentName VARCHAR(100) NOT NULL,
			matchNumber VARCHAR(10) NOT NULL,
			matchType VARCHAR(100) NOT NULL,
			blue1_teamNumber VARCHAR(10) NOT NULL,
			blue2_teamNumber VARCHAR(10) NOT NULL,
			blue3_teamNumber VARCHAR(10) NOT NULL,
			red1_teamNumber VARCHAR(10) NOT NULL,
			red2_teamNumber VARCHAR(10) NOT NULL,
			red3_teamNumber VARCHAR(10) NOT NULL,
			blue1_taxi VARCHAR(10) NULL,
			blue2_taxi VARCHAR(10) NULL,
			blue3_taxi VARCHAR(10) NULL,
			red1_taxi VARCHAR(10) NULL,
			red2_taxi VARCHAR(10) NULL,
			red3_taxi VARCHAR(10) NULL,
			blue_auto_lower VARCHAR(10) NULL,
			blue_auto_upper VARCHAR(10) NULL,
			red_auto_lower VARCHAR(10) NULL,
			red_auto_upper VARCHAR(10) NULL,
			blue_total_auto VARCHAR(10) NULL,
			red_total_auto VARCHAR(10) NULL,
			blue_teleop_lower VARCHAR(10) NULL,
			blue_teleop_upper VARCHAR(10) NULL,
			red_teleop_lower VARCHAR(10) NULL,
			red_teleop_upper VARCHAR(10) NULL,
			blue_total_teleop VARCHAR(10) NULL,
			red_total_teleop VARCHAR(10) NULL,
			blue_cargo_bonus VARCHAR(10) NULL,
			red_cargo_bonus VARCHAR(10) NULL,
			blue1_end_game VARCHAR(10) NULL,
			blue2_end_game VARCHAR(10) NULL,
			blue3_end_game VARCHAR(10) NULL,
			red1_end_game VARCHAR(10) NULL,
			red2_end_game VARCHAR(10) NULL,
			red3_end_game VARCHAR(10) NULL,
			blue_hanger_points VARCHAR(10) NULL,
			red_hanger_points VARCHAR(10) NULL,
			blue_hangar_bonus VARCHAR(10) NULL,
			red_hangar_bonus VARCHAR(10) NULL,
			blue_fouls VARCHAR(10) NULL,
			red_fouls VARCHAR(10) NULL,
			blue_total_score VARCHAR(10) NULL,
			red_total_score VARCHAR(10) NULL,
			blue_ranking_points VARCHAR(10) NULL,
			red_ranking_points VARCHAR(10) NULL,
			winning_alliance VARCHAR(10) NULL,
			PRIMARY KEY (matchNumber, matchType)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readMatchResultBAData($tournamentName, $matchNumber, $matchType) {
		global $matchresultbaTable;
		$queryString = "SELECT * FROM `" . $matchresultbaTable . "` WHERE tournamentName = '" . $tournamentName . "' and matchNumber = '" . $matchNumber . "' and matchType = '" . $matchType . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultBATable();
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
			$this->blue1_taxi = $result[0]['blue1_taxi'];
			$this->blue2_taxi = $result[0]['blue2_taxi'];
			$this->blue3_taxi = $result[0]['blue3_taxi'];
			$this->red1_taxi = $result[0]['red1_taxi'];
			$this->red2_taxi = $result[0]['red2_taxi'];
			$this->red3_taxi = $result[0]['red3_taxi'];
			$this->blue_auto_lower = $result[0]['blue_auto_lower'];
			$this->blue_auto_upper = $result[0]['blue_auto_upper'];
			$this->red_auto_lower = $result[0]['red_auto_lower'];
			$this->red_auto_upper = $result[0]['red_auto_upper'];
			$this->blue_total_auto = $result[0]['blue_total_auto'];
			$this->red_total_auto = $result[0]['red_total_auto'];
			$this->blue_teleop_lower = $result[0]['blue_teleop_lower'];
			$this->blue_teleop_upper = $result[0]['blue_teleop_upper'];
			$this->red_teleop_lower = $result[0]['red_teleop_lower'];
			$this->red_teleop_upper = $result[0]['red_teleop_upper'];
			$this->blue_total_teleop = $result[0]['blue_total_teleop'];
			$this->red_total_teleop = $result[0]['red_total_teleop'];
			$this->blue_cargo_bonus = $result[0]['blue_cargo_bonus'];
			$this->red_cargo_bonus = $result[0]['red_cargo_bonus'];
			$this->blue1_end_game = $result[0]['blue1_end_game'];
			$this->blue2_end_game = $result[0]['blue2_end_game'];
			$this->blue3_end_game = $result[0]['blue3_end_game'];
			$this->red1_end_game = $result[0]['red1_end_game'];
			$this->red2_end_game = $result[0]['red2_end_game'];
			$this->red3_end_game = $result[0]['red3_end_game'];
			$this->blue_hanger_points = $result[0]['blue_hanger_points'];
			$this->red_hanger_points = $result[0]['red_hanger_points'];
			$this->blue_hangar_bonus = $result[0]['blue_hangar_bonus'];
			$this->red_hangar_bonus = $result[0]['red_hangar_bonus'];
			$this->blue_fouls = $result[0]['blue_fouls'];
			$this->red_fouls = $result[0]['red_fouls'];
			$this->blue_total_score = $result[0]['blue_total_score'];
			$this->red_total_score = $result[0]['red_total_score'];
			$this->blue_ranking_points = $result[0]['blue_ranking_points'];
			$this->red_ranking_points = $result[0]['red_ranking_points'];
			$this->winning_alliance = $result[0]['winning_alliance'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	public function readAllMatchResultBAData() {
		global $matchresultbaTable;
		$queryString = "SELECT * FROM `" . $matchresultbaTable . "`";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultBATable();
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
			$this->blue1_taxi = $result[0]['blue1_taxi'];
			$this->blue2_taxi = $result[0]['blue2_taxi'];
			$this->blue3_taxi = $result[0]['blue3_taxi'];
			$this->red1_taxi = $result[0]['red1_taxi'];
			$this->red2_taxi = $result[0]['red2_taxi'];
			$this->red3_taxi = $result[0]['red3_taxi'];
			$this->blue_auto_lower = $result[0]['blue_auto_lower'];
			$this->blue_auto_upper = $result[0]['blue_auto_upper'];
			$this->red_auto_lower = $result[0]['red_auto_lower'];
			$this->red_auto_upper = $result[0]['red_auto_upper'];
			$this->blue_total_auto = $result[0]['blue_total_auto'];
			$this->red_total_auto = $result[0]['red_total_auto'];
			$this->blue_teleop_lower = $result[0]['blue_teleop_lower'];
			$this->blue_teleop_upper = $result[0]['blue_teleop_upper'];
			$this->red_teleop_lower = $result[0]['red_teleop_lower'];
			$this->red_teleop_upper = $result[0]['red_teleop_upper'];
			$this->blue_total_teleop = $result[0]['blue_total_teleop'];
			$this->red_total_teleop = $result[0]['red_total_teleop'];
			$this->blue_cargo_bonus = $result[0]['blue_cargo_bonus'];
			$this->red_cargo_bonus = $result[0]['red_cargo_bonus'];
			$this->blue1_end_game = $result[0]['blue1_end_game'];
			$this->blue2_end_game = $result[0]['blue2_end_game'];
			$this->blue3_end_game = $result[0]['blue3_end_game'];
			$this->red1_end_game = $result[0]['red1_end_game'];
			$this->red2_end_game = $result[0]['red2_end_game'];
			$this->red3_end_game = $result[0]['red3_end_game'];
			$this->blue_hanger_points = $result[0]['blue_hanger_points'];
			$this->red_hanger_points = $result[0]['red_hanger_points'];
			$this->blue_hangar_bonus = $result[0]['blue_hangar_bonus'];
			$this->red_hangar_bonus = $result[0]['red_hangar_bonus'];
			$this->blue_fouls = $result[0]['blue_fouls'];
			$this->red_fouls = $result[0]['red_fouls'];
			$this->blue_total_score = $result[0]['blue_total_score'];
			$this->red_total_score = $result[0]['red_total_score'];
			$this->blue_ranking_points = $result[0]['blue_ranking_points'];
			$this->red_ranking_points = $result[0]['red_ranking_points'];
			$this->winning_alliance = $result[0]['winning_alliance'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	public function clear(){
		global $matchresultbaTable;
		//SELECT blue1_teamNumber FROM MatchResultBA UNION SELECT blue2_teamNumber FROM MatchResultBA UNION SELECT blue3_teamNumber FROM MatchResultBA UNION SELECT red1_teamNumber FROM MatchResultBA UNION SELECT red2_teamNumber FROM MatchResultBA UNION SELECT red3_teamNumber FROM MatchResultBA
		$queryString = "DELETE FROM `" . $matchresultbaTable . "`";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultBATable();
			}
			$result = DataBase::runQuery($queryString);
		}

	}

	public function getEventTeams() {
		global $matchresultbaTable;
		//SELECT blue1_teamNumber FROM MatchResultBA UNION SELECT blue2_teamNumber FROM MatchResultBA UNION SELECT blue3_teamNumber FROM MatchResultBA UNION SELECT red1_teamNumber FROM MatchResultBA UNION SELECT red2_teamNumber FROM MatchResultBA UNION SELECT red3_teamNumber FROM MatchResultBA
		$queryString = "SELECT `blue1_teamNumber` FROM `" . $matchresultbaTable . "` UNION SELECT `blue2_teamNumber` FROM `" . $matchresultbaTable . "` UNION SELECT `blue3_teamNumber` FROM `" . $matchresultbaTable . "` UNION SELECT `red1_teamNumber` FROM `" . $matchresultbaTable . "` UNION SELECT `red2_teamNumber` FROM `" . $matchresultbaTable . "` UNION SELECT `red3_teamNumber` FROM `" . $matchresultbaTable . "`";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultBATable();
			}
			$result = DataBase::runQuery($queryString);
		}
		$teams = array();
		foreach ($result as $row_key => $row) {
			if (!in_array($row["blue1_teamNumber"], $teams)) {
				array_push($teams, $row["blue1_teamNumber"]);
			}
		}
		return ($teams);
	}

	// Write to Table
	public function writeMatchResultBAData() {
		global $matchresultbaTable;
		$queryString = "REPLACE INTO `" . $matchresultbaTable . "` (tournamentName, matchNumber, matchType, blue1_teamNumber, blue2_teamNumber, blue3_teamNumber, red1_teamNumber, red2_teamNumber, red3_teamNumber, blue1_taxi, blue2_taxi, blue3_taxi, red1_taxi, red2_taxi, red3_taxi, blue_auto_lower, blue_auto_upper, red_auto_lower, red_auto_upper, blue_total_auto, red_total_auto, blue_teleop_lower, blue_teleop_upper, red_teleop_lower, red_teleop_upper, blue_total_teleop, red_total_teleop, blue_cargo_bonus, red_cargo_bonus, blue1_end_game, blue2_end_game, blue3_end_game, red1_end_game, red2_end_game, red3_end_game, blue_hanger_points, red_hanger_points, blue_hangar_bonus, red_hangar_bonus, blue_fouls, red_fouls, blue_total_score, red_total_score, blue_ranking_points, red_ranking_points, winning_alliance)";
		$queryString = $queryString . ' VALUES ("' . $this->tournamentName . '","' . $this->matchNumber . '","' . $this->matchType . '","' . $this->blue1_teamNumber . '","' . $this->blue2_teamNumber . '","' . $this->blue3_teamNumber . '","' . $this->red1_teamNumber . '","' . $this->red2_teamNumber . '","' . $this->red3_teamNumber . '","' . $this->blue1_taxi . '","' . $this->blue2_taxi . '","' . $this->blue3_taxi . '","' . $this->red1_taxi . '","' . $this->red2_taxi . '","' . $this->red3_taxi . '","' . $this->blue_auto_lower . '","' . $this->blue_auto_upper . '","' . $this->red_auto_lower . '","' . $this->red_auto_upper . '","' . $this->blue_total_auto . '","' . $this->red_total_auto . '","' . $this->blue_teleop_lower . '","' . $this->blue_teleop_upper . '","' . $this->red_teleop_lower . '","' . $this->red_teleop_upper . '","' . $this->blue_total_teleop . '","' . $this->red_total_teleop . '","' . $this->blue_cargo_bonus . '","' . $this->red_cargo_bonus . '","' . $this->blue1_end_game . '","' . $this->blue2_end_game . '","' . $this->blue3_end_game . '","' . $this->red1_end_game . '","' . $this->red2_end_game . '","' . $this->red3_end_game . '","' . $this->blue_hanger_points . '","' . $this->red_hanger_points . '","' . $this->blue_hangar_bonus . '","' . $this->red_hangar_bonus . '","' . $this->blue_fouls . '","' . $this->red_fouls . '","' . $this->blue_total_score . '","' . $this->red_total_score . '","' . $this->blue_ranking_points . '","' . $this->red_ranking_points . '","' . $this->winning_alliance . '")';

		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultBATable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
