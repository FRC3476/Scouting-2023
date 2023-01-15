<?php

$matchResultBAHandler_included = "Y";

function filter($str){
	return filter_var($str, FILTER_SANITIZE_STRING);
}

function getNumberOfMatches($event){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.thebluealliance.com/api/v3/event/" . $event . "/matches?X-TBA-Auth-Key=VPexr6soymZP0UMtFw2qZ11pLWcaDSxCMUYOfMuRj5CQT3bzoExsUGHuO1JvyCyU");
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close ($ch);
    $data = json_decode($json, true);
    return count($data);
}

function getTournamentData($event, $matchIndex){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.thebluealliance.com/api/v3/event/" . $event . "/matches?X-TBA-Auth-Key=VPexr6soymZP0UMtFw2qZ11pLWcaDSxCMUYOfMuRj5CQT3bzoExsUGHuO1JvyCyU");
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close ($ch);
    
    $data = json_decode($json, true);

    return ($data[$matchIndex]);
}

function getTournamentNMatchData($event, $matchType, $matchNumber){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.thebluealliance.com/api/v3/match/" . $event . "_" . $matchType . $matchNumber . "?X-TBA-Auth-Key=VPexr6soymZP0UMtFw2qZ11pLWcaDSxCMUYOfMuRj5CQT3bzoExsUGHuO1JvyCyU");
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close ($ch);

    $data = json_decode($json, true);

    return ($data);
}

// Update the Match Result BA table with the data from Blue Alliance
function updateMatchResultBA($tournamentName, $matchType, $matchNumber, $data){

    if ($matchType == ""){
        $matchType = rtrim((explode("_", $data["key"]))[1], "0..9");
    }

    if ($matchNumber == "")
        $matchNumber = $data["match_number"];
    
    // Initialize MatchResultBA class
	$matchResultBA = new MatchResultBA();

    // Call settings on the matchResultBA object
    $matchResultBA->set_tournamentName($tournamentName); 
    $matchResultBA->set_matchType($matchType);
    $matchResultBA->set_matchNumber($matchNumber);

    $matchResultBA->set_blue1_teamNumber(substr($data["alliances"]["blue"]["team_keys"][0], 3,6));
    $matchResultBA->set_blue2_teamNumber(substr($data["alliances"]["blue"]["team_keys"][1], 3,6));
    $matchResultBA->set_blue3_teamNumber(substr($data["alliances"]["blue"]["team_keys"][2], 3,6));
    $matchResultBA->set_red1_teamNumber(substr($data["alliances"]["red"]["team_keys"][0], 3,6));
    $matchResultBA->set_red2_teamNumber(substr($data["alliances"]["red"]["team_keys"][1], 3,6));
    $matchResultBA->set_red3_teamNumber(substr($data["alliances"]["red"]["team_keys"][2], 3,6));

    $matchResultBA->set_blue1_taxi($data["score_breakdown"]["blue"]["taxiRobot1"]);
    $matchResultBA->set_blue2_taxi($data["score_breakdown"]["blue"]["taxiRobot2"]);
    $matchResultBA->set_blue3_taxi($data["score_breakdown"]["blue"]["taxiRobot3"]);
    $matchResultBA->set_red1_taxi($data["score_breakdown"]["red"]["taxiRobot1"]);
    $matchResultBA->set_red2_taxi($data["score_breakdown"]["red"]["taxiRobot2"]);
    $matchResultBA->set_red3_taxi($data["score_breakdown"]["red"]["taxiRobot3"]);

    $matchResultBA->set_blue_auto_lower($data["score_breakdown"]["blue"]["autoCargoLowerBlue"] + $data["score_breakdown"]["blue"]["autoCargoLowerFar"] + $data["score_breakdown"]["blue"]["autoCargoLowerNear"] + $data["score_breakdown"]["blue"]["autoCargoLowerRed"]);
    $matchResultBA->set_red_auto_lower($data["score_breakdown"]["red"]["autoCargoLowerBlue"] + $data["score_breakdown"]["red"]["autoCargoLowerFar"] + $data["score_breakdown"]["red"]["autoCargoLowerNear"] + $data["score_breakdown"]["red"]["autoCargoLowerRed"]);
    $matchResultBA->set_blue_auto_upper($data["score_breakdown"]["blue"]["autoCargoUpperBlue"] + $data["score_breakdown"]["blue"]["autoCargoUpperFar"] + $data["score_breakdown"]["blue"]["autoCargoUpperNear"] + $data["score_breakdown"]["blue"]["autoCargoUpperRed"]);
    $matchResultBA->set_red_auto_upper($data["score_breakdown"]["red"]["autoCargoUpperBlue"] + $data["score_breakdown"]["red"]["autoCargoUpperFar"] + $data["score_breakdown"]["red"]["autoCargoUpperNear"] + $data["score_breakdown"]["red"]["autoCargoUpperRed"]);
    $matchResultBA->set_blue_total_auto($data["score_breakdown"]["blue"]["autoPoints"]);
    $matchResultBA->set_red_total_auto($data["score_breakdown"]["red"]["autoPoints"]);

    $matchResultBA->set_blue_teleop_lower($data["score_breakdown"]["blue"]["teleopCargoLowerBlue"] + $data["score_breakdown"]["blue"]["teleopCargoLowerFar"] + $data["score_breakdown"]["blue"]["teleopCargoLowerNear"] + $data["score_breakdown"]["blue"]["teleopCargoLowerRed"]);
    $matchResultBA->set_red_teleop_lower($data["score_breakdown"]["red"]["teleopCargoLowerBlue"] + $data["score_breakdown"]["red"]["teleopCargoLowerFar"] + $data["score_breakdown"]["red"]["teleopCargoLowerNear"] + $data["score_breakdown"]["red"]["teleopCargoLowerRed"]);
    $matchResultBA->set_blue_teleop_upper($data["score_breakdown"]["blue"]["teleopCargoUpperBlue"] + $data["score_breakdown"]["blue"]["teleopCargoUpperFar"] + $data["score_breakdown"]["blue"]["teleopCargoUpperNear"] + $data["score_breakdown"]["blue"]["teleopCargoUpperRed"]);
    $matchResultBA->set_red_teleop_upper($data["score_breakdown"]["red"]["teleopCargoUpperBlue"] + $data["score_breakdown"]["red"]["teleopCargoUpperFar"] + $data["score_breakdown"]["red"]["teleopCargoUpperNear"] + $data["score_breakdown"]["red"]["teleopCargoUpperRed"]);
    $matchResultBA->set_blue_total_teleop($data["score_breakdown"]["blue"]["teleopPoints"]);
    $matchResultBA->set_red_total_teleop($data["score_breakdown"]["red"]["teleopPoints"]);

    $matchResultBA->set_blue_cargo_bonus($data["score_breakdown"]["blue"]["cargoBonusRankingPoint"]);
    $matchResultBA->set_red_cargo_bonus( $red_cargo_bonus = $data["score_breakdown"]["red"]["cargoBonusRankingPoint"]);

    $matchResultBA->set_blue1_end_game($data["score_breakdown"]["blue"]["endgameRobot1"]);
    $matchResultBA->set_blue2_end_game($data["score_breakdown"]["blue"]["endgameRobot2"]);
    $matchResultBA->set_blue3_end_game($data["score_breakdown"]["blue"]["endgameRobot3"]);
    $matchResultBA->set_red1_end_game($data["score_breakdown"]["red"]["endgameRobot1"]);
    $matchResultBA->set_red2_end_game($data["score_breakdown"]["red"]["endgameRobot2"]);
    $matchResultBA->set_red3_end_game($data["score_breakdown"]["red"]["endgameRobot3"]);

    $matchResultBA->set_blue_hanger_points($data["score_breakdown"]["blue"]["endgamePoints"]);
    $matchResultBA->set_red_hanger_points($red_hanger_points = $data["score_breakdown"]["red"]["endgamePoints"]);
    $matchResultBA->set_blue_hangar_bonus($data["score_breakdown"]["blue"]["hangarBonusRankingPoint"]);
    $matchResultBA->set_red_hangar_bonus($data["score_breakdown"]["red"]["hangarBonusRankingPoint"]);
    $matchResultBA->set_blue_fouls($data["score_breakdown"]["blue"]["foulPoints"]);
    $matchResultBA->set_red_fouls($data["score_breakdown"]["red"]["foulPoints"]);

    $matchResultBA->set_blue_total_score($data["score_breakdown"]["blue"]["totalPoints"]);
    $matchResultBA->set_red_total_score($data["score_breakdown"]["red"]["totalPoints"]);

    $matchResultBA->set_blue_ranking_points($data["score_breakdown"]["blue"]["rp"]);
    $matchResultBA->set_red_ranking_points($data["score_breakdown"]["red"]["rp"]);
    $matchResultBA->set_winning_alliance($data["winning_alliance"]);

    $matchResultBA->writeMatchResultBAData();
}

// Main Flow
$tournamentName = filter($_POST['tournamentNameG']);
$matchType = filter($_POST['matchTypeG']);
$matchNumber = filter($_POST['matchNumberG']);

// echo $tournamentName . "\n";
// echo $matchType . "\n";
// echo $matchNumber . "\n";

// If Match Type or Match Number is not populated, refresh the data for the full tournament
if ($matchType == "" || $matchNumber == ""){
    if($tournamentName != ""){
        $BA = new MatchResultBA();
        $BA->clear();
    }
    $numberOfMatches = getNumberOfMatches($tournamentName);
    for($i = 0; $i < $numberOfMatches; $i++){
        $data = getTournamentData($tournamentName, $i);

        updateMatchResultBA($tournamentName, $matchType, $matchNumber, $data);
    }
} 
// If Match Type and Match Number are populated, refresh data for the specific match in the tournament 
else {
    $matchType = $matchType . "m";
    $data = getTournamentNMatchData($tournamentName, $matchType, $matchNumber);

    updateMatchResultBA($tournamentName, $matchType, $matchNumber, $data);
}
?>