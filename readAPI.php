<?php
require('dbHandler.php');

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

if (isset($_POST['readAllMatchData'])){
  $db = new dbHandler();
  $match_data = $db->readAllData('datatable');
  echo(json_encode($match_data));
}


?>