<?php
require('dbHandler.php');

function getOrPost($key){
  /* If GET key or POST key exists, return the value. If not, return null. */
  if (isset($_GET[$key])){
    return $_GET[$key];
  }
  if (isset($_POST[$key])){
    return $_POST[$key];
  }
  return null;
}

/*
  Valid POST API Requests:
    readAllMatchData:
        [{'matchKey': '', 'scout' : '', 'matchNumber' : '', 'teamNumber' : '',
          'autoMobility' : '', 'autoConeLevel1' : '', 'autoConeLevel2' : '', 'autoConeLevel3' : '',
          'autoCubeLevel1' : '', 'autoCubeLevel2' : '', 'autoCubeLevel3' : '', 'autoChargeStation' : '',
          'teleopConeLevel1' : '', 'teleopConeLevel2' : '', 'teleopConeLevel3' : '', 'teleopCubeLevel1' : '',
          'teleopCubeLevel2' : '', 'teleopCubeLevel3' : '', 'teleopChargeStation' : '', 'cannedComments' : '',
          'textComments' : ''}]
*/

if (getOrPost('readAllMatchData')){
  $db = new dbHandler();
  $match_data = $db->readAllData('datatable');
  echo(json_encode($match_data, JSON_NUMERIC_CHECK));
}

if (getOrPost('readAllTeamMatchData')){
  $db = new dbHandler();
  $sql = 'teamNumber = "'. getOrPost("readAllTeamMatchData") .'"';
  $team_match_data = $db->readSomeData('datatable', $sql);
  echo(json_encode($team_match_data, JSON_NUMERIC_CHECK));
}

if (getOrPost('readAllTeamPitData')){
  $db = new dbHandler();
  $sql = 'pitTeamNumber = "' . getOrPost("readAllTeamPitData") .'"';
  $team_pit_data = $db->readSomeData('pitScouttable', $sql);
  echo(json_encode($team_pit_data, JSON_NUMERIC_CHECK));
}

if (getOrPost('readAllPitScoutData')){
  $db = new dbHandler();
  $match_data = $db->readAllData('pitScouttable');
  echo(json_encode($match_data, JSON_NUMERIC_CHECK));
}

if (getOrPost('readAllTeamStrikeData')){
  $db = new dbHandler();
  $sql = 'strikeTeamNumber = "' . getOrPost("readAllTeamStrikeData") .'"';
  $team_strike_data = $db->readSomeData('strikeScouttable', $sql);
  echo(json_encode($team_strike_data, JSON_NUMERIC_CHECK));
}

if (getOrPost('readAllStrikeScoutData')){
  $db = new dbHandler();
  $match_data = $db->readAllData('strikeScouttable');
  echo(json_encode($match_data, JSON_NUMERIC_CHECK));
}

if (getOrPost('readAllLSData')){
  $db = new dbHandler();
  $match_data = $db->readAllData('LSTable');
  echo(json_encode($match_data, JSON_NUMERIC_CHECK));
}

if (getOrPost('LSRank')){
  // Need python with trueskill lib!
  $db = new dbHandler();
  $lead_scout_data = $db->readAllData('LSTable');
  $ranking_list = array();
  for($i = 0; $i != count($lead_scout_data); $i++){
    $lead_scout_row = $lead_scout_data[$i];
    array_push($ranking_list, array($lead_scout_row['team1'], $lead_scout_row['team2'], $lead_scout_row['team3'], $lead_scout_row['team4'], $lead_scout_row['team5'] ,$lead_scout_row['team6']));
  }
  // Namecheap doesn't source Python3 normally, so try 1 then the other.
  $python_script = 'python teamSkill.py ' . json_encode($ranking_list, JSON_NUMERIC_CHECK);
  $ls_rank = array();
  $successful = True;
  try {
    $command = 'source /home/wadech/virtualenv/api/3.8/bin/activate;';
    $ls_rank = exec($command . $python_script);
  } catch (Exception $e) {
    $successful = False;
  }
  if (!$successful || strcmp($ls_rank, '') == 0){
    $ls_rank = exec($python_script);
  }
  echo(json_encode($ls_rank, JSON_NUMERIC_CHECK));
}

if (getOrPost('getTeamPictureFilenames')){
  $base_path = './uploads/';
  $team = getOrPost('getTeamPictureFilenames') . '-';
  $team_length = strlen($team);
  $out = array();
  foreach (scandir($base_path) as &$pic_path){
    if ($team_length >= strlen($pic_path)){
      continue;
    }
    if (substr($pic_path, 0, $team_length) === $team){
      array_push($out, $base_path . $pic_path);
    }
  }
  echo(json_encode($out, JSON_NUMERIC_CHECK));
}

if (getOrPost('getAllPictureFilenames')){
  //get the pit scouting pictures folder
  $settings = new siteSettings();
  $settings -> readDbConfig();
  $path = './uploads/';

  $result = new stdClass();
  $result -> success = true;
  $result -> path = $path;
  $result -> files = false;
  $result -> error = $error;
  
  //check if the folder exists
  if (!is_dir($path)) {
    //if $path doesn't exist
    $result -> success = false;
    if (!$error) $result -> error = "The pictureFolder has not been created";
    
  } else {
    //if $path exists
    $temp = array_diff(scandir($path), array('.', '..'));
    $result -> files = $temp;
  }

  $result = (json_encode($result, JSON_NUMERIC_CHECK));
  echo $result;
}

?>