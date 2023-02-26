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

if (isset($_POST['writeLSData'])) {
  $result = new stdClass();
  $result -> success = true;
  $db = new dbHandler();
  $matchData = json_decode($_POST['writeLSData'], true);
  $success = true;
    //create LSTable if it doesn't exist
    if (!$db->getTableExists("LSTable")) {
      $db->createTable("LSTable");
    }
  try {
    $db->writeRowToTable('LSTable', $matchData);
  } catch (Exception $e) {
    error_log($e);
    $e = json_decode(json_encode($e));
    $result->error = $e -> errorInfo;
    $result -> success = false;
  }

  echo (json_encode($result));
}

if (isset($_POST["pitPictureUpload"])) {
  $result = new stdClass();
  $settings = new siteSettings();
  $result -> error = "";
  $target_dir = $settings -> get("pictureFolder");
  $target_dir .= "/";
  $target_file = $target_dir . $_POST["teamNumber"] . "." . time() . "." . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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

  // Check if file already exists
  if (file_exists($target_file)) {
    $result -> error = "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
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
  $result -> success = true;
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $result -> success = false;
    // if everything is ok, try to upload file
  } else {
    try {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $result -> $error = "The file " . htmlspecialchars($target_file) . " has been uploaded";
    }
  } catch (Exception $e) {
    $result -> $error = $e;
  }
  }

  $message = $result -> error;
  $redirect = "pictureUpload.php";
  var_dump($result);
//  header("Location: " . $redirect . "?message=" . $message);
//  die();
}
