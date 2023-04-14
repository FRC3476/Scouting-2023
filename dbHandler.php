<?php
require('siteSettings.php');
/*
  MySQL database handler
*/

class dbHandler
{
  private $charset = 'utf8';
  private $conn = null;
  private $alreadyConnected = false;
  
  public $settings;
  
  private $tableMapping = array(
    'datatable' => array(
      'keys' => array(
        'matchKey' => 'VARCHAR(60) NOT NULL PRIMARY KEY',
        'scout' => 'VARCHAR(60) NOT NULL',
        'matchNumber' => 'VARCHAR(10) NOT NULL',
        'teamNumber' => 'VARCHAR(10) NOT NULL',
        'autoMobility' => 'BOOLEAN NOT NULL',
        'autoConeLevel1' => 'SMALLINT NOT NULL',
        'autoConeLevel2' => 'SMALLINT NOT NULL',
        'autoConeLevel3' => 'SMALLINT NOT NULL',
        'autoCubeLevel1' => 'SMALLINT NOT NULL',
        'autoCubeLevel2' => 'SMALLINT NOT NULL',
        'autoCubeLevel3' => 'SMALLINT NOT NULL',
        'autoChargeStation' => 'VARCHAR(60) NULL',
        'teleopConeLevel1' => 'SMALLINT NOT NULL',
        'teleopConeLevel2' => 'SMALLINT NOT NULL',
        'teleopConeLevel3' => 'SMALLINT NOT NULL',
        'teleopCubeLevel1' => 'SMALLINT NOT NULL',
        'teleopCubeLevel2' => 'SMALLINT NOT NULL',
        'teleopCubeLevel3' => 'SMALLINT NOT NULL',
        'teleopChargeStation' => 'VARCHAR(60) NULL',
        'cannedComments' => 'TEXT NULL',
        'textComments' => 'TEXT NULL'
      )
    ),
    'LSTable' => array(
      'keys' => array(
        'matchNum' => 'VARCHAR(20) NOT NULL',
        'team1' => 'SMALLINT NOT NULL',
        'team2' => 'SMALLINT NOT NULL',
        'team3' => 'SMALLINT NOT NULL',
        'team4' => 'SMALLINT NOT NULL',
        'team5' => 'SMALLINT NOT NULL',
        'team6' => 'SMALLINT NOT NULL'
      )
    ),
    'pitScouttable' => array(
      'keys' => array(
        'pitTeamNumber' => 'VARCHAR(5) NOT NULL PRIMARY KEY',
        'disorganized' => 'VARCHAR(60) NOT NULL',
        'numBatteries' => 'SMALLINT NOT NULL',
        'chargedBatteries' => 'SMALLINT NOT NULL',
        'codeLanguage' => 'VARCHAR(10) NOT NULL',
		'drivetrainType' => 'VARCHAR(60) NOT NULL',
        'autoPath' => 'VARCHAR(60) NOT NULL',
        'framePerimeterDimensions' => 'VARCHAR(60) NOT NULL',
        'pitComments' => 'TEXT NULL'
      )
    ),
	'strikeScouttable' => array(
      'keys' => array(
        'strikeTeamNumber' => 'VARCHAR(5) NOT NULL PRIMARY KEY',
        'vibes' => 'VARCHAR(60) NOT NULL',
        'bumpers' => 'VARCHAR(60) NOT NULL',
        'mechRobustness' => 'VARCHAR(60) NOT NULL',
        'elecRobustness' => 'VARCHAR(60) NOT NULL',
        'strikeComments' => 'TEXT NULL'
      )
    ),
    'tbatable' => array(
      'keys' => array(
        'requestURI' => 'VARCHAR(100) NOT NULL PRIMARY KEY',
        'expiryTime' => 'BIGINT NOT NULL',
        'response' => 'MEDIUMTEXT NOT NULL'
      )
    )
  );
  
  function __construct(){
    $this->settings = new siteSettings();
  }
  
  function refreshSettings(){
    $this->settings = new siteSettings();
  }

  function connectToDB(){
    if (!$this->alreadyConnected){
      $dsn = 'mysql:host=' . $this->settings->get('server') . ';dbname=' . $this->settings->get('db') . ';charset=' . $this->charset;
      $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
      ];
      $this->conn = new PDO($dsn, $this->settings->get('username'), $this->settings->get('password'), $opt);
      $this->alreadyConnected = true;
    }
    return ($this->conn);
  }

  function connectToServer(){
    $dsn = 'mysql:host=' . $this->settings->get('server') . ';charset=' . $this->charset;
    $opt = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false
    ];
    $this->alreadyConnected = true;

    return (new PDO($dsn, $this->settings->get('username'), $this->settings->get('password'), $opt));
  }
  
  function writeRowToTable($tableType, $data){
    $this->connectToDB();
    $tableName = $this->settings->get($tableType);
    $keySql = '';
    $valueSql = '';
    $first = true;
    foreach ($this->tableMapping[$tableType]['keys'] as $dataName => $dataType){
      if (!$first){
        $keySql .= ', ';
        $valueSql .= ', ';
      }
      $first = false;
      
      $keySql .= $dataName;
      $valueSql .= ':' . $dataName;
    }
    
    $sql = 'INSERT INTO ' . $tableName . '(' . $keySql . ') VALUES(' . $valueSql . ')';
    error_log($sql);
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  function replaceRowInTable($tableType, $data){
    $this->connectToDB();
    $tableName = $this->settings->get($tableType);
    $keySql = '';
    $valueSql = '';
    $first = true;
    foreach ($this->tableMapping[$tableType]['keys'] as $dataName => $dataType){
      if (!$first){
        $keySql .= ', ';
        $valueSql .= ', ';
      }
      $first = false;
      
      $keySql .= $dataName;
      $valueSql .= ':' . $dataName;
    }
    
    $sql = 'REPLACE INTO ' . $tableName . '(' . $keySql . ') VALUES(' . $valueSql . ')';
    error_log($sql);
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  function readAllData($tableType){
    $tableName = $this->settings->get($tableType);
    $this->connectToDB();
    $sql = 'SELECT * FROM ' . $tableName;
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }
  
  function readSomeData($tableType, $whereSql){
    $tableName = $this->settings->get($tableType);
    $this->connectToDB();
    $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $whereSql;
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  function createDB(){
    $connection = $this->connectToServer();
    $statement = $connection->prepare('CREATE DATABASE IF NOT EXISTS ' . $this->settings->get('db'));
    if (!$statement->execute()){
      throw new Exception('createDB Error: CREATE DATABASE query failed.');
    }
  }

  function createTable($tableType){
    $conn = $this->connectToDB();
    $createSql = '';
    $first = true;
    foreach ($this->tableMapping[$tableType]['keys'] as $dataName => $dataType){
      if (!$first){
        $createSql .= ',';
      }
      $first = false;
      
      $createSql .= $dataName . ' ' . $dataType;
    }
    $sql = 'CREATE TABLE ' . $this->settings->get('db') . '.' . $this->settings->get($tableType) . ' (' . $createSql . ')';
    error_log($sql);
    $statement = $conn->prepare($sql);
    if (!$statement->execute()){
      throw new Exception('createTable Error: CREATE TABLE ' . $this->settings->get('db') . '.' . $this->settings->get($tableType) . ' query failed.');
    }
  }
  
  function createAllTables(){
    foreach ($this->tableMapping as $tableType => $tableValues){
      try{
        try {
          $this->createTable($tableType);
        }
        catch (Exception $e){
          error_log($e);
        }
      }
      catch (Error $f){
        error_log($f);
      }
    }
  }
  
  function getServerExists(){
    try{$this->connectToServer();}
    catch (Exception $e){return false;}
    return true;
  }
  
  function getDatabaseExists(){
    try{$this->connectToDB();}
    catch (Exception $e){return false;}
    return true;
  }
  
  function getTableExists($tableType){
    try{$this->readAllData($tableType);}
    catch (Exception $e){return false;}
    return true;
  }
  
  function getStatus(){
    $status = $this->settings->getSanitizedConfig();
    foreach ($this->tableMapping as $key => $value){
      $statusKey = $key . 'Exists';
      $status[$statusKey] = $this->getTableExists($key);
    }
    $status["pictureFolderExists"] = True;
    $status['serverExists'] = $this->getServerExists();
    $status['dbExists'] = $this->getDatabaseExists();
    return $status;
  }
}