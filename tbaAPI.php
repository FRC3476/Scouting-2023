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

if (getOrPost('getTeamsInMatch')){
  $tba = new tbaHandler();
  $queryMatchNumber = getOrPost('getTeamsInMatch');
  $teamList = array('red' => array(), 'blue' => array());
  $rawMatches = $tba->getSimpleMatches(getEventCode($tba));
  foreach($rawMatches as &$matchRow){
    if ($matchRow['comp_level'] === 'qm' && $matchRow['match_number'] == $queryMatchNumber){
      $teamList['red'] = $matchRow['alliances']['red']['team_keys'];
      $teamList['blue'] = $matchRow['alliances']['blue']['team_keys'];
      break;
    }
  } 
  echo(json_encode($teamList));
}

if (getOrPost('getMatchData')){
  $matchNumber = getOrPost('number');
  $matchLevel = getOrPost('level');
  $tba = new tbaHandler();
  $rawMatches = $tba->getSimpleMatches(getEventCode($tba));
  $number_key = 'match_number';
  if ($matchLevel == 'sf'){
    $number_key = 'set_number';
  }
  foreach($rawMatches as &$matchRow){
    if ($matchRow['comp_level'] == $matchLevel && $matchRow[$number_key] == $matchNumber){
      echo(json_encode($matchRow));
      return;
    }
  }
  echo(json_encode(array()));
}

if (getOrPost('getUserMatchDicts')){
  $tba = new tbaHandler();
  $firstUnplayed = true;
  $nextUnplayedMatch = array();
  $nextUnplayedMatch['match_number'] = 0;
  $nextUnplayedMatch['match_time'] = '0';
  $matches = array();
  $team = 'frc' . $tba->db->settings->get('teamnumber');
  $rawMatches = $tba->getSimpleMatches(getEventCode($tba));
  foreach($rawMatches as &$matchRow){
    # Check if first unplayed match.
    if ($firstUnplayed  && $matchRow['actual_time'] == null){
      $firstUnplayed = false;
      if ($matchData['comp_level'] == 'sf'){
        $nextUnplayedMatch['match_number'] = $matchRow['set_number'];
      } else {
        $nextUnplayedMatch['match_number'] = $matchRow['match_number'];
      }
      $nextUnplayedMatch['match_time'] = $matchRow['predicted_time'];
    }

    # Check if team played in match.
    if ($matchRow['alliances']['red']['team_keys'][0] == $team || 
        $matchRow['alliances']['red']['team_keys'][1] == $team ||
        $matchRow['alliances']['red']['team_keys'][2] == $team || 
        $matchRow['alliances']['blue']['team_keys'][0] == $team || 
        $matchRow['alliances']['blue']['team_keys'][1] == $team || 
        $matchRow['alliances']['blue']['team_keys'][2] == $team){
    
      $matchData = array();
      $matchData['comp_level'] = $matchRow['comp_level'];
      if ($matchData['comp_level'] == 'sf'){
        $matchData['match_number'] = $matchRow['set_number'];
      } else {
        $matchData['match_number'] = $matchRow['match_number'];
      }

      if ($matchRow['alliances']['red']['team_keys'][0] == $team || 
          $matchRow['alliances']['red']['team_keys'][1] == $team ||
          $matchRow['alliances']['red']['team_keys'][2] == $team ) {
        $matchData['is_red_alliance'] = true;
        $matchData['alliance'] = array(
          $matchRow['alliances']['red']['team_keys'][0],
          $matchRow['alliances']['red']['team_keys'][1],
          $matchRow['alliances']['red']['team_keys'][2]
        );
      } else {
        $matchData['is_red_alliance'] = false;
        $matchData['alliance'] = array(
          $matchRow['alliances']['blue']['team_keys'][0],
          $matchRow['alliances']['blue']['team_keys'][1],
          $matchRow['alliances']['blue']['team_keys'][2]
        );
      }

      $matchData['actual_time'] = $matchRow['actual_time'];
      $matchData['predicted_time'] = $matchRow['predicted_time'];

      array_push($matches, $matchData);
    }
  }
  usort($matches, function($a, $b){
    $aLevel = $a['comp_level'];
    $aNumber = $a['match_number'];

    $bLevel = $b['comp_level'];
    $bNumber = $b['match_number'];
    
    if ($aLevel == $bLevel){
      return $aMatch <=> $bMatch;
    }
    $lookup = array('p' => 0, 'qm' => 1, 'qf' => 2, 'sf' => 3, 'f' => 4);
    return $lookup[$aLevel] <=> $lookup[$bLevel];
  });
  $output = array();
  $output['current_match'] = $nextUnplayedMatch;
  $output['future_team_matches'] = $matches;
  echo(json_encode($output));
}

if (getOrPost('getUserMatches')){
  $tba = new tbaHandler();
  $matches = array();
  $team = 'frc' . $tba->db->settings->get('teamnumber');
  $rawMatches = $tba->getSimpleMatches(getEventCode($tba));
  foreach($rawMatches as &$matchRow){
    if ($matchRow['alliances']['red']['team_keys'][0] == $team || 
        $matchRow['alliances']['red']['team_keys'][1] == $team ||
        $matchRow['alliances']['red']['team_keys'][2] == $team || 
        $matchRow['alliances']['blue']['team_keys'][0] == $team || 
        $matchRow['alliances']['blue']['team_keys'][1] == $team || 
        $matchRow['alliances']['blue']['team_keys'][2] == $team){
      $matchNumber = $matchRow['match_number'];
      if ($matchRow['comp_level'] == 'sf'){
        $matchNumber = $matchRow['set_number'];
      }
      array_push($matches, array($matchRow['comp_level'], $matchNumber));
    }
  }
  usort($matches, function($a, $b){
    if ($a[0] == $b[0]){
      return $a[1] <=> $b[1];
    }
    $lookup = array('p' => 0, 'qm' => 1, 'qf' => 2, 'sf' => 3, 'f' => 4);
    return $lookup[$a[0]] <=> $lookup[$b[0]];
  });
  echo(json_encode($matches));
}

if (getOrPost('getRankings')){
  $tba = new tbaHandler();
  $rawRankings = $tba->getRank(getEventCode($tba))['rankings'];
  $rankings = array();
  foreach($rawRankings as &$rankRow){
    $rankings[$rankRow['team_key']] = $rankRow['rank'];
  }
  echo(json_encode($rankings));
}

?>