<?php
if($config_included == "") {
	include("config.php");
}

if($dataBase_included == "") {
	include("database.php");
}

include("matchResultBA.php");
include("matchResultSC.php");
include("matchResultVA.php");

class MatchResult {

	// Create properties for match results from all 3 sources: Blue Alliance, Scouters, Video Analysis
	private $tournamentName;
	private $matchNumber;
	private $matchType;
	private $matchResultBA;
	private $matchResultSC;
	private $matchResultVA;

	// Default Constructor
	public function __construct () {
		$this->matchResultBA = new MatchResultBA();
		$this->matchResultSC = new MatchResultSC();		
		$this->matchResultVA = new MatchResultVA();
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

	public function get_matchResultBA() {
		return $this->matchResultBA;
	}

	public function get_matchResultSC() {
		return $this->matchResultSC;
	}

	public function get_matchResultVA() {
		return $this->matchResultVA;
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

	public function set_matchResultBA($matchResultBA) {
		$this->matchResultBA = $matchResultBA;
	}

	public function set_matchResultSC($matchResultSC) {
		$this->matchResultSC = $matchResultSC;
	}

	public function set_matchResultVA($matchResultVA) {
		$this->matchResultVA = $matchResultVA;
	}

	// Read from Table
	public function createMatchResultTable() {
		$this->matchResultBA->createMatchResultBATable();
		$this->matchResultSC->createMatchResultSCTable();
		$this->matchResultVA->createMatchResultVATable();
	}

	// Read from Table
	public function readMatchResultData($tournamentName, $matchNumber) {
		$this->tournamentName = $tournamentName;
		$this->matchNumber = $matchNumber;
		$this->matchResultBA->readMatchResultBAData($tournamentName, $matchNumber);
		$this->matchResultSC->readMatchResultSCData($tournamentName, $matchNumber);
		$this->matchResultVA->readMatchResultVAData($tournamentName, $matchNumber);
	}

	// Write to Table
	public function writeMatchResultData() {
		$this->matchResultBA->writeMatchResultBAData();
		$this->matchResultSC->writeMatchResultSCData();
		$this->matchResultVA->writeMatchResultVAData();
	}
}
?>
