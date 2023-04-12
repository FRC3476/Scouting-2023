<?php
require('dbHandler.php');

class tbaHandler {
  /* Wraps TBA functionality with local caching options. */
  
  function __construct(){
    $this->db = new dbHandler();
    $this->apiKey = $this->db->settings->get('tbakey');
    $this->apiURL = "https://www.thebluealliance.com/api/v3";
  }

  function _makeCachedDBCall($uri){
    /* Returns fresh or cached response from TBA.
    
    Args:
      uri: TBA URI specified by API.
    
    Returns:
      Response from TBA.
    */
    $currTime = time();
    $dbResponse = $this->_readResponseFromDB($uri);

    // Return DB response if fresh.
    if ($currTime < $dbResponse["expiryTime"]){
      return $dbResponse;
    }

    // Return TBA call if valid.
    try {
      $apiResponse = $this->_readURIFromTBA($uri);
      $this->_writeResponseToDB($uri, $apiResponse);
      return $apiResponse;
    }
    // On error, return DB response if exists.
    catch (Exception $e) {
      if ($dbResponse['response'] != null){
        return $dbResponse;
      }
    }
    throw new Exception('TBA Handler can not get response from ' . $uri);
  }

  function _readResponseFromDB($uri){
    /* If it exists, returns cached response from DB.
    
    Args:
      uri: TBA URI specified by API.
    
    Returns:
      Cached response from DB, with keys
        'expiryTime': int value of when cache value expires.
        'response': JSON dict of TBA response.
    */
    $sql = 'requestURI="'.$uri.'"';
    $dbData = $this->db->readSomeData('tbatable', $sql);
    $data = array("expiryTime" => 0, "response" => null);
    if (count($dbData) > 0){
      $data['expiryTime'] = intval($dbData[0]["expiryTime"]);
      $data['response'] = json_decode($dbData[0]["response"], true);
    }
    return $data;
  }

  function _writeResponseToDB($uri, $response){
    /* Write URI and response to DB for caching.
    
    Args:
      uri: TBA URI specified by API.
      response: Associated JSON response
    */
    $data = array();
    $data['requestURI'] = $uri;
    $data['expiryTime'] = $response['expiryTime'];
    $data['response'] = json_encode($response['response']);
    $this->db->replaceRowInTable('tbatable', $data);
  }

  function _readURIFromTBA($uri){
    /* Accesses URI on TBA with API key.
    
    Args:
      uri: TBA URI specified by API.
    
    Returns:
      JSON of Response.
    */
    $url = $this->apiURL . $uri . "?X-TBA-Auth-Key=" . $this->apiKey;
    $ch = curl_init();
    curl_setopt_array(
      $ch,
      array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER => true
      )
    );
    $response = curl_exec($ch);
    if (curl_errno($ch)){
      throw new Exception(curl_error($ch));
    }
    curl_close($ch);

    list($headers, $content) = explode("\r\n\r\n", $response, 2);

    // Parse Header to get max-age
    $maxAge = 0;
    foreach (explode("\r\n", $headers) as $hdr){
      $kv = explode(":", $hdr, 2);
      if (sizeof($kv) == 2){
        list($key, $value) = $kv;
        if ($key == "Cache-Control"){
          foreach (explode(",", $value) as $cacheControlKV){
            $cacheKV = explode("=", $cacheControlKV, 2);
            if (count($cacheKV) == 2 and strcmp($cacheKV[0], "max-age")){
              $maxAge = intval($cacheKV[1]);
            }
          }
        }
      }
    }
    $content = str_replace("'", "", $content);
    $out = array();
    $out["expiryTime"] = time() + $maxAge;
    $out["response"] = json_decode($content, true);
    return $out;
  }

  /* Team List Operations */

  function getTeamList($eventCode)
  {
    $requestURI = "/event/" . $eventCode . "/teams";
    return $this->_makeCachedDBCall($requestURI);
  }

  function getSimpleTeamList($eventCode)
  {
    $tl = $this->getTeamList($eventCode);
    $out = array();
    foreach ($tl["response"] as $teamRow){
      array_push($out, $teamRow["team_number"]);
    }
    return $out;
  }

  function teamListToLookup($teamList)
  {
    $out = array();
    $i = 0;
    foreach ($teamList as $team){
      $out[$team] = $i;
      $out["frc" . $team] = $i;
      $i += 1;
    }
    return $out;
  }

  /* Match Data Operations */

  function getRank($eventCode){
    $requestURI = "/event/" . $eventCode . "/rankings";
    return $this->_makeCachedDBCall($requestURI)['response'];
  }

  function getMatches($eventCode)
  {
    $requestURI = "/event/" . $eventCode . "/matches";
    return $this->_makeCachedDBCall($requestURI);
  }

  function getSimpleMatches($eventCode)
  {
    $ml = $this->getMatches($eventCode);
    return $ml["response"];
  }

  function removeElimMatches($matchData)
  {
    $out = array();
    foreach ($matchData as $matchRow){
      if ($matchRow["comp_level"] == "qm"){
        array_push($out, $matchRow);
      }
    }
    return $out;
  }

  function removeUnplayedMatches($matchData)
  {
    $out = array();
    foreach ($matchData as $matchRow){
      if ($matchRow["alliances"]["red"]["score"] != -1){
        array_push($out, $matchRow);
      }
    }
    return $out;
  }

  function getNumericalBreakdownKeys($matchData)
  {
    $sampleBreakdown = $matchData[0]["score_breakdown"]["red"];
    $out = array();
    foreach ($sampleBreakdown as $key => $value){
      if (is_numeric($value)){
        array_push($out, $key);
      }
    }
    return $out;
  }

  /* COPR Calculation */

  function choleskyDecomposition($A)
  {
    /*
      Args:
        $A - Must be square matrix that is symetric and positive definite
      Returns:
        array("L" => and "Lp" =>) decompositions
      */
    $n  = sizeof($A);

    $L  = array_fill(0, $n, array_fill(0, $n, 0));
    $Lp = array_fill(0, $n, array_fill(0, $n, 0));

    for ($i = 0; $i < $n; $i++){
      for ($j = 0; $j <= $i; $j++){
        $sum = 0;
        for ($k = 0; $k < $j; $k++){
          $sum += $L[$i][$k] * $L[$j][$k];
        }
        if ($i == $j){
          $L[$i][$j]  = sqrt($A[$i][$j] - $sum);
          $Lp[$j][$i] = sqrt($A[$i][$j] - $sum);
        }
        else{
          $L[$i][$j]  = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
          $Lp[$j][$i] = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
        }
      }
    }

    return array("L" => $L, "Lp" => $Lp);
  }

  function forwardSubstitution($A, $B)
  {
    /*
      Args:
        $A - Lower Triangular Square Matrix
        $B - Vector of Length of a side of $A
      Returns:
        $X - Solved vector
      */
    $n = sizeof($A);
    $X = array_fill(0, $n, 0);
    for ($i = 0; $i != $n; $i++){
      $sum = 0;
      for ($j = 0; $j < $i; $j++){
        $sum += $A[$i][$j] * $X[$j];
      }
      $X[$i] = ($B[$i] - $sum) / $A[$i][$i];
    }
    return $X;
  }

  function backwardSubstitution($A, $B)
  {
    /*
      Args:
        $A - Upper Triangular Square Matrix
        $B - Vector of Length of a side of $A
      Returns:
        $X - Solved vector
      */
    $n = sizeof($A);
    $nm = $n - 1;
    $X = array_fill(0, $n, 0);
    for ($i = 0; $i != $n; $i++){
      $sum = 0;
      for ($j = 0; $j < $i; $j++){
        $sum += $A[$nm - $i][$nm - $j] * $X[$nm - $j];
      }
      $X[$nm - $i] = ($B[$nm - $i] - $sum) / $A[$nm - $i][$nm - $i];
    }
    return $X;
  }

  function createABMatricies($teamCount, $teamLookup, $simpleMatchData)
  {
    $aMatrix = array_fill(0, $teamCount, array_fill(0, $teamCount, 0)); // Just for who plays in what matchData
    $bVectors = array(); // Set of data we want to solve for

    $coprKeys = $this->getNumericalBreakdownKeys($simpleMatchData);

    // Initialize B Vectors
    foreach ($coprKeys as $key){
      $bVectors[$key] = array_fill(0, $teamCount, 0);
    }

    // Iterate through matches
    foreach ($simpleMatchData as &$match){
      foreach (array("red", "blue") as $color){
        foreach ($match["alliances"][$color]["team_keys"] as $teamA){
          // Modify A Matrix
          foreach ($match["alliances"][$color]["team_keys"] as $teamB){
            $aMatrix[$teamLookup[$teamA]][$teamLookup[$teamB]] += 1;
          }
          // Modify B Vectors
          foreach ($coprKeys as $coprKey){
            $bVectors[$coprKey][$teamLookup[$teamA]] += $match["score_breakdown"][$color][$coprKey];
          }
        }
      }
    }

    return array("A" => $aMatrix, "B" => $bVectors);
  }

  function getComponentOPRS($eventCode)
  {
    $simpleTeamList = $this->getSimpleTeamList($eventCode);
    $teamLookup = $this->teamListToLookup($simpleTeamList);
    $teamCount = sizeof($simpleTeamList);

    $simpleMatchData = $this->getSimpleMatches($eventCode);
    $simpleMatchData = $this->removeElimMatches($simpleMatchData);
    $simpleMatchData = $this->removeUnplayedMatches($simpleMatchData);
    $matchMatricies = $this->createABMatricies($teamCount, $teamLookup, $simpleMatchData);

    $A    = $matchMatricies["A"];
    $Bs   = $matchMatricies["B"];
    $Xs   = array();

    $Lmat = $this->choleskyDecomposition($A);
    $L  = $Lmat["L"];
    $Lp = $Lmat["Lp"];

    foreach ($Bs as $component => $Ba){
      $y = $this->forwardSubstitution($L, $Ba);
      $x = $this->backwardSubstitution($Lp, $y);
      $Xs[$component] = $x;
    }

    // Repackage Values into Team Value Dicts
    $data = array();
    foreach ($simpleTeamList as $team){
      $data[$team] = array();
      foreach ($Xs as $component => $x){
        $data[$team][$component] = round($x[$teamLookup[$team]], 2);
      }
    }
    $out = array("eventCode" => $eventCode, "data" => $data, "keys" => $this->getNumericalBreakdownKeys($simpleMatchData));

    return $out;
  }

}

?>