<?php

class siteSettings{
  /*Reads and Writes persistent settings for the website.*/
  private $dbIniFile = './db_config.ini';
  private $configKeys = array(
    'server', 'db', 'username', 'password',
    'teamnumber', 'eventcode', 'tbakey',
    'datatable', 'tbatable', 'pitScouttable', 'strikeScouttable', 'LSTable'
  );
  public $settings;
  
  function __construct(){
    $this->settings = $this->readDbConfig();
  }
  
  function readDbConfig(){
    // Read dbIniFile
    // If File doesn't exist, instantiate array as empty
    try {
      $ini_arr = parse_ini_file($this->dbIniFile);
    }
    catch (Exception $e){
      $ini_arr = array();
    }
    // If required keys don't exist, instantiate them to default empty string
    foreach ($this->configKeys as $key){
      if (!isset($ini_arr[$key])){
        $ini_arr[$key] = '';
      }
    }
    return $ini_arr;
  }

  function writeDbConfig($dat){
    // Get values to write
    // If value is not in input, read from current DB config
    $currDBConfig = $this->readDbConfig();
    foreach ($dat as $key => $value){
      $currDBConfig[$key] = $value;
    }
    // Build ini file string
    $data = '';
    foreach ($currDBConfig as $key => $value){
      $data = $data . $key . '=' . $value . PHP_EOL;
    }
    // Write ini file string to actual file
    if ($fp = fopen($this->dbIniFile, 'w')){
      $startTime = microtime(True);
      do {
        $writeLock = flock($fp, LOCK_EX);
        if (!$writeLock){
          usleep(round(34760));
        }
      } while ((!$writeLock) and ((microtime(True) - $startTime) < 5));

      if ($writeLock){
        fwrite($fp, $data);
        flock($fp, LOCK_UN);
      }
      fclose($fp);
    }
  }
  
  function get($key){
    return $this->settings[$key];
  }
  
  function getSanitizedConfig(){
    $out = array();
    $out['server']          	= $this->settings['server'];
    $out['db']              	= $this->settings['db'];
    $out['username']        	= $this->settings['username'];
    $out['teamnumber']      	= $this->settings['teamnumber'];
    $out['eventcode']       	= $this->settings['eventcode'];
    $out['tbakey']          	= substr($this->settings['tbakey'], 0, 3) . '******';
    $out['datatable']       	= $this->settings['datatable'];
    $out['tbatable']        	= $this->settings['tbatable'];
    $out['pitScouttable']   	= $this->settings['pitScouttable'];
	$out['strikeScouttable']   	= $this->settings['strikeScouttable'];
    $out['LSTable']        	   	= $this->settings['LSTable'];
    return $out;
  }
}

?>