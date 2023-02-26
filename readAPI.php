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
  echo(json_encode($match_data));
}

if (getOrPost('readAllPitScoutData')){
  $db = new dbHandler();
  $match_data = $db->readAllData('pitScouttable');
  echo(json_encode($match_data));
}

if (getOrPost('readAllLSData')){
  $db = new dbHandler();
  $match_data = $db->readAllData('LSTable');
  echo(json_encode($match_data));
}

if (getOrPost('getAllPictureFilenames')){
  //get the pit scouting pictures folder
  $settings = new siteSettings();
  $settings -> readDbConfig();
  $path = $settings -> get("pictureFolder");
  $path = $path . "/";

  $result = new stdClass();
  $result -> success = true;
  $result -> path = $path;
  $result -> files = false;
  $result -> error = false;
  
  //check if the folder exists
  if (!is_dir($path)) {
    //if $path doesn't exist
    $result -> success = false;
    $result -> error = "pictureFolder is not set in the config file";
  } else {
    //if $path exists
    $temp = array_diff(scandir($path), array('.', '..'));
    $result -> files = $temp;
  }

  //converts the php object to string, then from a string to a json object, then to a string.
  //Essentially converts a php object to a json string.
  //It works, so I'm not touching it lol.
  $result = json_encode(json_decode(json_encode($result)));
  echo $result;
}

?>