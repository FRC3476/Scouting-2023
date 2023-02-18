<?php
require('dbHandler.php');

//ADD PIT SCOUT AND LEAD SCOUT TO DOCUMENTATION
/*
  Valid POST API Requests:
    getConfig - Responds with human readable JSON settings for the site and database.
      Response Format:
        {'server' : '', 'db' : '', 'username' : '', 'eventcode' : '', 'tbakey' : '', 'datatable' : '',
        'tbatable' : '', 'datatableExists' : '', 'tbatableExists' : '', 'serverExists' : '', 'dbExists' : ''}
    writeConfig - Write status and respond with status.
      Argument Format:
        {'server' : '', 'db' : '', 'username' : '', 'password' : '',
        'eventcode' : '', 'tbakey' : '', 'datatable' : '', 'tbatable' : ''}
      Response Format:
        {'server' : '', 'db' : '', 'username' : '', 'eventcode' : '', 'tbakey' : '', 'datatable' : '',
        'tbatable' : '', 'datatableExists' : '', 'tbatableExists' : '', 'serverExists' : '', 'dbExists' : ''}
    createDB - Tries to create DB and associated tables.
      Response Format:
        {'server' : '', 'db' : '', 'username' : '', 'eventcode' : '', 'tbakey' : '', 'datatable' : '',
        'tbatable' : '', 'datatableExists' : '', 'tbatableExists' : '', 'serverExists' : '', 'dbExists' : ''}
*/

if (isset($_POST["getConfig"])){
  $db = new dbHandler();
  echo(json_encode($db->getStatus()));
}
else if (isset($_POST["writeConfig"])){
  $db = new dbHandler();
  $db->settings->writeDbConfig(json_decode($_POST["writeConfig"]));
  $db->refreshSettings();
  echo(json_encode($db->getStatus()));
}
else if (isset($_POST["createDB"])){
  $db = new dbHandler();
  try{
    if(! $db->getDatabaseExists()){
      $db->createDB();
    }
    $db->createAllTables();
  }
  catch (Exception $e){
    error_log($e);
  }
  $db->refreshSettings();
  echo(json_encode($db->getStatus()));
}
?>