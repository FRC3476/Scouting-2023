<?php
include("matchScoutForm.php");
//include("matchScoutingDetails");

function filter($str)
{
	return filter_var($str, FILTER_SANITIZE_STRING);
}
	$tournamentName = filter($_POST['tournamentName']);
	$matchNumber = filter($_POST['matchNumber']);
	$scouterName = filter($_POST['scouterName']);
	$teamNumber = filter($_POST['teamNumber']);
	$allianceColor = filter($_POST['allianceColor']);
	$eventTime = filter($_POST['eventTime']);

    $exit_tarmac = filter($_POST['exit_tarmac']);
	$auto_path = filter($_POST['auto_path']);
	$auto_upper_goal = filter($_POST['auto_upper_goal']);
	$auto_upper_goal_miss = filter($_POST['auto_upper_goal_miss']);
	$auto_lower_goal = filter($_POST['auto_lower_goal']);
	$auto_lower_goal_miss = filter($_POST['auto_lower_goal_miss']);

    $shot_location = filter($_POST['shot_location']);
	$teleop_upper_goal = filter($_POST['teleop_upper_goal']);
	$teleop_upper_goal_miss = filter($_POST['teleop_upper_goal_miss']);
	$teleop_lower_goal = filter($_POST['teleop_lower_goal']);
	$teleop_lower_goal_miss = filter($_POST['teleop_lower_goal_miss']);

	$climb = filter($_POST['climb']);
    $penalties = filter($_POST['penalties']);
	$issues = filter($_POST['issues']);
	$defense = filter($_POST['defense']);
	$comments = filter($_POST['comments']);
    $dnp = filter($_POST['dnp']);
    $defComments = filter($_POST['defComments']);


	$matchScoutingDetails = new MatchScoutingDetails();

    $matchScoutingDetails->set_tournamentName($tournamentName);
    $matchScoutingDetails->set_matchNumber($matchNumber);
    $matchScoutingDetails->set_scouterName($scouterName);
    $matchScoutingDetails->set_teamNumber($teamNumber);
    $matchScoutingDetails->set_allianceColor($allianceColor);
    $matchScoutingDetails->set_eventTime($eventTime);
    
    $matchScoutingDetails->set_exit_tarmac($exit_tarmac);
    $matchScoutingDetails->set_auto_path($auto_path);
    $matchScoutingDetails->set_auto_upper_goal($auto_upper_goal);
    $matchScoutingDetails->set_auto_upper_goal_miss($auto_upper_goal_miss);
    $matchScoutingDetails->set_auto_lower_goal($auto_lower_goal);
    $matchScoutingDetails->set_auto_lower_goal_miss($auto_lower_goal_miss);

    $matchScoutingDetails->set_shot_location($shot_location);
    $matchScoutingDetails->set_teleop_upper_goal($teleop_upper_goal);
    $matchScoutingDetails->set_teleop_upper_goal_miss($teleop_upper_goal_miss);
    $matchScoutingDetails->set_teleop_lower_goal($teleop_lower_goal);
    $matchScoutingDetails->set_teleop_lower_goal_miss($teleop_lower_goal_miss);

    $matchScoutingDetails->set_climb($climb);
    $matchScoutingDetails->set_penalties($penalties);
    $matchScoutingDetails->set_issues($issues);
    $matchScoutingDetails->set_defense($defense);
    $matchScoutingDetails->set_defComments($defComments);
    $matchScoutingDetails->set_dnp($dnp);
    $matchScoutingDetails->set_comments($comments);

    $matchScoutingDetails->writeMatchScoutingDetailsData();
?>