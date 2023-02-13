<?php
require ('tbaHandler.php');

/*
  Valid GET or POST API requests:
    getEventCode:
      eventCode
    getTeamList:
      [3476, 581. 498, ...]
    getMatchList:
      {'response': {}}
    getCOPR:


  Valid Settings
    eventCode
      String event code to use instead of DB default.
      
*/

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

function getEventCode($tba){
  if (getOrPost('eventCode')){
    return getOrPost('eventCode');
  }
  return $tba->db->settings->get('eventcode');
}

if (getOrPost('getEventCode')){
  $tba = new tbaHandler();
  echo(getEventCode($tba));
}
else if (getOrPost('getTeamList')){
  $tba = new tbaHandler();
  echo (json_encode($tba->getSimpleTeamList(getEventCode($tba))));
}
else if (getOrPost('getMatchList')){
  $tba = new tbaHandler();
  echo (json_encode($tba->getMatches(getEventCode($tba))));
}
else if (getOrPost('getCOPR')){
  $tba = new tbaHandler();
  echo (json_encode($tba->getComponentOPRS(getEventCode($tba))));
}

?>