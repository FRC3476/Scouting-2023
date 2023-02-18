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

if (isset($_POST['writeSingleMatchData'])){
  $db = new dbHandler();
  $matchData = json_decode($_POST['writeSingleMatchData'], true);
  $matchData['matchKey'] = $matchData['matchNumber'] . '-' . $matchData['teamNumber'];
  $success = true;
  try{
    $db->writeRowToTable('datatable', $matchData);
  }
  catch(Exception $e){
    error_log($e);
    $success = false;
  }

  echo(json_encode($success));
}

if (isset($_POST['writePitScoutData'])){
  $db = new dbHandler();
  $matchData = json_decode($_POST['writePitScoutData'], true);
  $success = true;
  try{
    $db->writeRowToTable('pitScouttable', $matchData);
  }
  catch(Exception $e){
    error_log($e);
    $success = false;
  }

  echo(json_encode($success));
}

if (isset($_POST['writeLSData'])){
  $db = new dbHandler();
  $matchData = json_decode($_POST['writeLSData'], true);
  $success = true;
  try{
    $db->writeRowToTable('LSTable', $matchData);
  }
  catch(Exception $e){
    error_log($e);
    $success = false;
  }

  echo(json_encode($success));
}


?>