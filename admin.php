<title>Admin</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
      
        <!-- Left column -->
        <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
          <div class="card">
            <div class="card-header">Status</div>
            <div class="card-body">
              <h4>SQL Server Status: <span id="serverStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Database Status: <span id="databaseStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Data Table Status: <span id="dataTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>TBA Table Status: <span id="tbaTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Pit Table Status: <span id="pitScoutTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>LS Table Status: <span id="LSTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Server: <span id="serverName" class="badge bg-primary">????</span></h4>
              <h4>Database: <span id="databaseName" class="badge bg-primary">????</span></h4>
              <h4>Username: <span id="userName" class="badge bg-primary">????</span></h4>
              <h4>TBA Key: <span id="tbaKey" class="badge bg-primary">????</span></h4>
              <h4>Event Code: <span id="eventCode" class="badge bg-primary">????</span></h4>
              <h4>Data Table: <span id="dataTableName" class="badge bg-primary">????</span></h4>
              <h4>TBA Table: <span id="tbaTableName" class="badge bg-primary">????</span></h4>
              <h4>Pit Scout Table: <span id="pitScoutTableName" class="badge bg-primary">????</span></h4>
              <h4>LS Table: <span id="LSTableName" class="badge bg-primary">????</span></h4>
            </div>
          </div>
        </div>
        
        <!-- Left column -->
        <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
          <div class="card">
            <div class="card-header">Configuration</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="writeServer" class="form-label"> MySQL Server URL</label>
                <input type="text" class="form-control" id="writeServer" aria-describedby="serverName">
              </div>
              <div class="mb-3">
                <label for="writeDatabase" class="form-label">Database Name</label>
                <input type="text" class="form-control" id="writeDatabase" aria-describedby="databaseName">
              </div>
              <div class="mb-3">
                <label for="writeDataTable" class="form-label">Data Table Name</label>
                <input type="text" class="form-control" id="writeDataTable" aria-describedby="writeTableName">
              </div>
              <div class="mb-3">
                <label for="writeTBATable" class="form-label">TBA Table Name</label>
                <input type="text" class="form-control" id="writeTBATable" aria-describedby="writeTBATable">
              </div>
              <div class="mb-3">
                <label for="writePitScoutTable" class="form-label">Pit Scout Table Name</label>
                <input type="text" class="form-control" id="writePitScoutTable" aria-describedby="writePitScoutTable">
              </div>
              <div class="mb-3">
                <label for="writeLSTable" class="form-label">LS Table Name</label>
                <input type="text" class="form-control" id="writeLSTable" aria-describedby="writeLSTable">
              </div>
              <div class="mb-3">
                <label for="writeUsername" class="form-label">User Name</label>
                <input type="text" class="form-control" id="writeUsername" aria-describedby="userName">
              </div>
              <div class="mb-3">
                <label for="writePassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="writePassword" aria-describedby="password">
              </div>
              <div class="mb-3">
                <label for="writeTBAKey" class="form-label">TBA Key</label>
                <input type="text" class="form-control" id="writeTBAKey" aria-describedby="tbaKey">
              </div>
              <div class="mb-3">
                <label for="writeEventCode" class="form-label">Event Code</label>
                <input type="text" class="form-control" id="writeEventCode" aria-describedby="tbaEventCode">
              </div>
              
              <button id="writeConfig" class="btn btn-primary">Write Config</button>
              <button id="createDB" class="btn btn-primary">Create DB</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include("footer.php"); ?>

<script>
  function setStatusBadge(isSuccess, id) {
    if (isSuccess) {
      $("#" + id).text("Connected");
      $("#" + id).addClass("bg-success");
      $("#" + id).removeClass("bg-warning");
      $("#" + id).removeClass("bg-danger");
    } else {
      $("#" + id).text("Not Connected");
      $("#" + id).addClass("bg-danger");
      $("#" + id).removeClass("bg-warning");
      $("#" + id).removeClass("bg-success");
    }
  }
  
  function updateStatusValues(statusArray) {
    $("#serverName").text(statusArray["server"]);
    $("#databaseName").text(statusArray["db"]);
    $("#userName").text(statusArray["username"]);
    $("#tbaKey").text(statusArray["tbakey"]);
    $("#eventCode").text(statusArray["eventcode"]);
    $("#dataTableName").text(statusArray["datatable"]);
    $("#tbaTableName").text(statusArray["tbatable"]);
    $("#pitScoutTableName").text(statusArray["pitScouttable"]);
    $("#LSTableName").text(statusArray["LSTable"]);
    
    setStatusBadge(statusArray["dbExists"], "databaseStatus");
    setStatusBadge(statusArray["serverExists"], "serverStatus");
    setStatusBadge(statusArray["datatableExists"], "dataTableStatus");
    setStatusBadge(statusArray["tbatableExists"], "tbaTableStatus");
    setStatusBadge(statusArray["pitScouttableExists"], "pitScoutTableStatus");
    setStatusBadge(statusArray["LSTableExists"], "LSTableStatus");
    
    console.log(statusArray);
  }
  
  function getWriteDataArray(){
    var allWriteData = {'server' : $('#writeServer').val(),
                        'db' : $('#writeDatabase').val(),
                        'username' : $('#writeUsername').val(),
                        'password' : $('#writePassword').val(),
                        'eventcode' : $('#writeEventCode').val(),
                        'tbakey' : $('#writeTBAKey').val(),
                        'datatable' : $('#writeDataTable').val(),
                        'tbatable' : $('#writeTBATable').val(),
                        'pitScouttable' : $('#writePitScoutTable').val(),
                        'LSTable' : $('#writeLSTable').val(),
                        'pictureFolder' : "uploads"};
    var writeData = {};
    for (const prop in allWriteData){
      if (allWriteData[prop] != ''){
        writeData[prop] = allWriteData[prop];
      }
    }
    return writeData;
  }
  
  $(document).ready(function() {
    // Load data from adminAPI.php.
    $.post("adminAPI.php", {
      "getConfig": true
    }, function(data) {
      console.log(data);
      updateStatusValues(JSON.parse(data));
    });
  });
  
  $("#createDB").on('click', function(event) {
    $.post("adminAPI.php", {
      "createDB": true
    }, function(data) {
      updateStatusValues(JSON.parse(data));
    });
  });
  
  $("#writeConfig").on('click', function(event) {
    var data = getWriteDataArray();
    if (Object.keys(data).length > 0){
      $.post("adminAPI.php", {
        "writeConfig": JSON.stringify(data)
      }, function(data) {
        updateStatusValues(JSON.parse(data));
      });
    }
  });
  
</script>

</html>