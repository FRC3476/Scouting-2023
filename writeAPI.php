<?php
require('dbHandler.php');

/*
  Valid POST API Requests:
    writeSingleMatchData:
      Argument Format:
        {'scout' : '', 'matchNumber' : '', 'teamNumber' : '',
          'autoMobility' : '', 'autoConeLevel1' : '', 'autoConeLevel2' : '', 'autoConeLevel3' : '',
          'autoCubeLevel1' : '', 'autoCubeLevel2' : '', 'autoCubeLevel3' : '', 'autoChargeStation' : '',
          'teleopConeLevel1' : '', 'teleopConeLevel2' : '', 'teleopConeLevel3' : '', 'teleopCubeLevel1' : '',
          'teleopCubeLevel2' : '', 'teleopCubeLevel3' : '', 'teleopChargeStation' : '', 'cannedComments' : '',
          'textComments' : ''}
      Response Format:
        true OR false
*/

if (isset($_POST['writeSingleMatchData'])) {
  $result = new stdClass();
  $result->success = true;
  $db = new dbHandler();
  try {
    $matchData = json_decode($_POST['writeSingleMatchData'], true);
    $matchData['matchKey'] = $matchData['matchNumber'] . '-' . $matchData['teamNumber'];
    $db->writeRowToTable('datatable', $matchData);
  } catch (Exception $e) {
    error_log($e);
    $e = json_decode(json_encode($e));
    $result->error = $e -> errorInfo;
    $result->success = false;
  }

  echo (json_encode($result));
}

if (isset($_POST['writeDataList'])){
  $result = new stdClass();
  $result->success = true;
  $db = new dbHandler();
  $rawDataList = json_decode($_POST['writeDataList'], true);
  foreach($rawDataList as &$matchData){
    try {
      $matchData['matchKey'] = $matchData['matchNumber'] . '-' . $matchData['teamNumber'];
      $db->writeRowToTable('datatable', $matchData);
    } catch (Exception $e) {
      error_log($e);
      $e = json_decode(json_encode($e));
      $result->error = $e -> errorInfo;
      $result->success = false;
    }
  }
  echo (json_encode($result));
}

if (isset($_POST['writePitScoutData'])) {
  $result = new stdClass();
  $result -> success = true;
  $db = new dbHandler();
  //create pitScouttable if it doesn't exist
  if (!$db->getTableExists("pitScouttable")) {
    $db->createTable("pitScouttable");
  }
  $matchData = json_decode($_POST['writePitScoutData'], true);
  $success = true;
  try {
    $db->writeRowToTable('pitScouttable', $matchData);
  } catch (Exception $e) {
    error_log($e);
    $e = json_decode(json_encode($e));
    $result->error = $e -> errorInfo;
    $result -> success = false;
  }

  echo (json_encode($result));
}

if (isset($_POST['writeStrikeScoutData'])) {
  $result = new stdClass();
  $result -> success = true;
  $db = new dbHandler();
  //create strikeScouttable if it doesn't exist
  if (!$db->getTableExists("strikeScouttable")) {
    $db->createTable("strikeScouttable");
  }
  $matchData = json_decode($_POST['writeStrikeScoutData'], true);
  $success = true;
  try {
    $db->replaceRowInTable('strikeScouttable', $matchData);
  } catch (Exception $e) {
    error_log($e);
    $e = json_decode(json_encode($e));
    $result->error = $e -> errorInfo;
    $result -> success = false;
  }

  echo (json_encode($result));
}

if (isset($_GET['saveAllianceRank'])){
  $db = new dbHandler();
  $teamList = json_decode($_GET['saveAllianceRank'], true);
  $match = $_GET['match'];

  $result = array();
  $result['success'] = true;

  # Fill array.
  if (count($teamList) < 6){
    for($i = count($teamList); $i < 6; $i++){
      array_push($teamList, 0);
    }
  }

  $leadScoutData = array();
  $leadScoutData['matchNum'] = $match;
  $leadScoutData['team1'] = $teamList[0];
  $leadScoutData['team2'] = $teamList[1];
  $leadScoutData['team3'] = $teamList[2];
  $leadScoutData['team4'] = $teamList[3];
  $leadScoutData['team5'] = $teamList[4];
  $leadScoutData['team6'] = $teamList[5];

  $db->writeRowToTable('LSTable', $leadScoutData);

  echo (json_encode($result));
}

if (isset($_POST["pitPictureUpload"])) {
  $result = new stdClass();
  $settings = new siteSettings();
  $result -> error = "";
  $result -> success = true;
  $path = './uploads/';
  $target_dir = $path;
  $target_file = $target_dir . $_POST["teamNumber"];
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));

  //check if $path is set
  if (!$path) {
    $result -> error = "pictureFolder is not set in config";
    $uploadOk = 0;
    $result -> success = false;
  }

  //check if directory exists;
  if ($path && !is_dir($path)) {
    $result -> error = "pictureFolder does not exist";
    $uploadOk = 0;
    $result -> success = false;
  }

  // Check if image file is a actual image or fake image
  if (isset($_POST["teamNumber"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
      //$result -> error = "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      $result -> error = "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Append number monotonic number to end of image and check if it exists.
  $i = 0;
  $valid = false;
  while($i < 20){  // Only allow 20 pics per team.
    $new_file_name = strtolower($target_file . '-' . $i . '.' . $imageFileType);
    if (file_exists($new_file_name)){
      $i++;
    }
    else {
      $valid = true;
      break;
    }
  }

  if ($valid){
    $target_file = $new_file_name;
  }
  else {
    $result -> error = "Sorry, too many files under that team.";
    $uploadOk = 0;
  }
  

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 100000000) {
    $result -> error = "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    $result -> error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  $message = "";
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $result -> success = false;
    // if everything is ok, try to upload file
  } else {
    try {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $temp = "The file " . htmlspecialchars($target_file) . " has been uploaded";
      if (file_exists($target_file)) {
        $result -> error = $temp;
      } else {
        $result -> error = "The file " . htmlspecialchars($target_file) . " could not be found on the server";
      }
    }
  } catch (Exception $e) {
    $result -> $error = $e;
  }
  }

  $redirect = "pictureUpload.php";
  $message = json_encode($result);

  header("Location: " . $redirect . "?message=" . $message);
  die();
}
