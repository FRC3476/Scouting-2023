<?php
if($config_included == "") {
	include("config.php");
}

if($dataBase_included == "") {
	include("database.php");
}
class Bet {

	// Create properties for robots
	private $userName;
	private $tournament;
	private $matchType;
	private $matchNumber;
	private $timeStamp;
	private $redAutoPredict;
	private $blueAutoPredict;
	private $climbWinner;
	private $winner;
	private $margin;


	// Default Constructor
	public function __construct () {
	}

	// Getter function for each class property
	public function get_userName() {
		return $this->userName;
	}

	public function get_tournament() {
		return $this->tournament;
	}

	public function get_matchType() {
		return $this->matchType;
	}

	public function get_matchNumber() {
		return $this->matchNumber;
	}

	public function get_timeStamp() {
		return $this->timeStamp;
	}

	public function get_redAutoPredict() {
		return $this->redAutoPredict;
	}

	public function get_blueAutoPredict() {
		return $this->blueAutoPredict;
	}

	public function get_climbWinner() {
		return $this->climbWinner;
	}

	public function get_winner() {
		return $this->winner;
	}

	public function get_margin() {
		return $this->margin;
	}


	// Setter function for each class property
	public function set_userName($userName) {
		$this->userName = $userName;
	}

	public function set_tournament($tournament) {
		$this->tournament = $tournament;
	}

	public function set_matchType($matchType) {
		$this->matchType = $matchType;
	}

	public function set_matchNumber($matchNumber) {
		$this->matchNumber = $matchNumber;
	}

	public function set_timeStamp($timeStamp) {
		$this->timeStamp = $timeStamp;
	}

	public function set_redAutoPredict($redAutoPredict) {
		$this->redAutoPredict = $redAutoPredict;
	}

	public function set_blueAutoPredict($blueAutoPredict) {
		$this->blueAutoPredict = $blueAutoPredict;
	}

	public function set_climbWinner($climbWinner) {
		$this->climbWinner = $climbWinner;
	}

	public function set_winner($winner) {
		$this->winner = $winner;
	}

	public function set_margin($margin) {
		$this->margin = $margin;
	}

	// Create Table
	public static function createBetTable() {
		global $dbnane;
		global $betTable;
		$queryString = "CREATE TABLE " . $dbname . "." . $betTable . " (
			userName VARCHAR(30) NOT NULL,
			tournament VARCHAR(20) NOT NULL,
			matchType VARCHAR(20) NOT NULL,
			matchNumber VARCHAR(20) NOT NULL,
			timeStamp VARCHAR(20) NOT NULL,
			redAutoPredict VARCHAR(20) NOT NULL,
			blueAutoPredict VARCHAR(20) NOT NULL,
			climbWinner VARCHAR(20) NOT NULL,
			winner VARCHAR(20) NOT NULL,
			margin VARCHAR(10) NOT NULL,
			PRIMARY KEY (userName, matchNumber)
		)";
		$result = DataBase::runQuery($queryString);
	}

	// Read from Table
	public function readBetData($userName, $matchNumber) {
		global $betTable;
		$queryString = "SELECT * FROM `" . $betTable . "` WHERE userName = '" . $userName . "' and matchNumber = '" . $matchNumber . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createBetTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		if (count($result) > 0) {
			$this->userName = $result[0]['userName'];
			$this->tournament = $result[0]['tournament'];
			$this->matchType = $result[0]['matchType'];
			$this->matchNumber = $result[0]['matchNumber'];
			$this->timeStamp = $result[0]['timeStamp'];
			$this->redAutoPredict = $result[0]['redAutoPredict'];
			$this->blueAutoPredict = $result[0]['blueAutoPredict'];
			$this->climbWinner = $result[0]['climbWinner'];
			$this->winner = $result[0]['winner'];
			$this->margin = $result[0]['margin'];

			return count($result);
		} else {
			// Unsuccessful return will have a value = 0
			return 0;
		}
	}

	public function readByName($userName) {
		global $betTable;
		$queryString = "SELECT * FROM `" . $betTable . "` WHERE userName = '" . $userName . "'";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createBetTable();
			}
			$result = DataBase::runQuery($queryString);
		}
		return $result;
	}

	public function getUserList() {
		global $betTable;
		$queryString = "SELECT `userName` FROM `" . $betTable . "`";
		try {
			$result = DataBase::runQuery($queryString);
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createMatchResultBATable();
			}
			$result = DataBase::runQuery($queryString);
		}
		$users = array();
		foreach ($result as $row_key => $row) {
			if (!in_array($row["userName"], $users)) {
				array_push($users, $row["userName"]);
			}
		}
		return ($users);
	}



	// Write to Table
	public function writeBetData() {
		global $betTable;
		$queryString = "REPLACE INTO `" . $betTable . "` (userName, tournament, matchType, matchNumber, timeStamp, redAutoPredict, blueAutoPredict, climbWinner, winner, margin)";
		$queryString = $queryString . ' VALUES ("' . $this->userName . '","' . $this->tournament . '","' . $this->matchType . '","' . $this->matchNumber . '","' . $this->timeStamp . '","' . $this->redAutoPredict . '","' . $this->blueAutoPredict . '","' . $this->climbWinner . '","' . $this->winner . '","' . $this->margin . '")';
		try {
			$result = DataBase::runQuery($queryString);
			return 1;
		} catch (PDOException $e) {
			if ($e->getCode() == "42S02") {
				error_log("CREATING TABLES");
				self::createBetTable();
			}
			$result = DataBase::runQuery($queryString);
			return 1;
		}
	}
}
?>
