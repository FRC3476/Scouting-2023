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
  
  private $settings = new siteSettings();
  
  
  private $tableMapping = array(
    'datatable' => array(
      'keys' => array(
        'key' => 'VARCHAR(60) NOT NULL PRIMARY KEY',
        'scout' => 'VARCHAR(60) NOT NULL',
        'matchNumber' => 'VARCHAR(10) NOT NULL',
        'teamNumber' => 'VARCHAR(10) NOT NULL',
        'autoMobility' => 'VARCHAR(60) NOT NULL',
        'autoConeLevel1' => 'SMALLINT NOT NULL',
        'autoConeLevel2' => 'SMALLINT NOT NULL',
        'autoConeLevel3' => 'SMALLINT NOT NULL',
        'autoCubeLevel1' => 'SMALLINT NOT NULL',
        'autoCubeLevel2' => 'SMALLINT NOT NULL',
        'autoCubeLevel3' => 'SMALLINT NOT NULL',
        'autoChargeStation' => 'VARCHAR(60) NOT NULL',
        'teleopConeLevel1' => 'SMALLINT NOT NULL',
        'teleopConeLevel2' => 'SMALLINT NOT NULL',
        'teleopConeLevel3' => 'SMALLINT NOT NULL',
        'teleopCubeLevel1' => 'SMALLINT NOT NULL',
        'teleopCubeLevel2' => 'SMALLINT NOT NULL',
        'teleopCubeLevel3' => 'SMALLINT NOT NULL',
        'teleopChargeStation' => 'VARCHAR(60) NOT NULL',
        'cannedComments' => 'TEXT NOT NULL',
        'textComments' => 'TEXT NOT NULL'
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

  function connectToDB(){
    if (!$this->alreadyConnected){
      $dsn = 'mysql:host=' . $this->get('server') . ';dbname=' . $this->get('db') . ';charset=' . $this->charset;
      $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
      ];
      $this->conn = new PDO($dsn, $this->get('username'), $this->get('password'), $opt);
      $this->alreadyConnected = true;
    }
    return ($this->conn);
  }

  function connectToServer(){
    $dsn = 'mysql:host=' . $this->get('server') . ';charset=' . $this->charset;
    $opt = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false
    ];
    $this->alreadyConnected = true;

    return (new PDO($dsn, $this->get('username'), $this->get('password'), $opt));
  }
  
  function writeRowToTable($tableType, $data){
    $tableName = $this->get($tableType);
    $keySql = '';
    $valueSql = '';
    $first = true;
    foreach ($this->tableMapping[$tableType]['keys'] as $dataName => $dataType){
      if (!$first){
        $keySql .= ', '
        $valueSql .= ', '
      }
      $first = false;
      
      $keySql .= $dataName;
      $valueSql .= ':' . $dataName;
    }
    $sql .= ')';
    
    $sql = 'INSERT INTO ' . $tableName . '(' . $keySql . ') VALUES(' . $valueSql . ')';
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  function readAllData($tableType){
    $sql = 'SELECT * FROM ' . $this->get($tableType);
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $this->enforceDataTyping($result);
  }
  
  function readSomeData($tableType, $whereSql){
    $sql = 'SELECT * FROM ' . $this->get($tableType) . ' WHERE ' . $whereSql;
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $this->enforceDataTyping($result);
  }

  function createDB(){
    $connection = $this->connectToServer();
    $statement = $connection->prepare('CREATE DATABASE IF NOT EXISTS ' . $this->get('db'));
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
    $sql = 'CREATE TABLE ' . $this->get('db') . '.' . $this->get($tableType) . ' (' . $createSql . ')';
    $statement = $conn->prepare($query);
    if (!$statement->execute()){
      throw new Exception('createTable Error: CREATE TABLE ' . $this->get('db') . '.' . $this->get($tableType) . ' query failed.');
    }
  }
  
  function createAllTables(){
    foreach ($this->tableMapping as $tableType => $tableValues){
      $this->createTable($tableType);
    }
  }
  
  function getServerExists(){
    try{$this->connectToServer($tableName);}
    catch (PDOException $e){return false;}
    return true;
  }
  
  function getDatabaseExists(){
    try{$this->connectToDB($tableName);}
    catch (PDOException $e){return false;}
    return true;
  }
  
  function getTableExists($tableName){
    try{$this->readAllData($tableName);}
    catch (PDOException $e){return false;}
    return true;
  }
  
  function getStatus(){
    $status = $this->settings->getSanitizedConfig();
    foreach ($this->tableMapping[$tableType] as $key => $value){
      $statusKey = $key . 'Exists';
      $status[$statusKey] = $this->getTableExists($this->get($key));
    }
    $status['serverExists'] = $this->getServerExists();
    $status['dbExists'] = $this->getDatabaseExists;
    return $status;
  }
}