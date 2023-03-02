<title>Team Data</title>
<html lang="en">

<?php include('navbar.php');?>


<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
            <br>
            <div class="input-group mb-3">
                <input id="inputTeamNumber" type="text" class="form-control" placeholder="Enter Team Number">
                <button id="readAllTeamMatchData" type="button" class="btn btn-primary">Load Team Data</button>
            </div>
  
            <div class="row pt-3 pb-3 mb-3">
                
                <!-- Number + Pictures -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card">
                        <div class="card-header"><h2 id='teamNumber'>Team</h2></div>
                        <div class="card-body">

                          <div id="robotPicsCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div id="robotPics" class="carousel-inner">

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                            
                        </div>
                    </div>

                    <br>

                    <div class="card">
                        <div class="card-header">Pit Data</div>
                        <div class="card-body overflow-auto">

                          <table class='table'>
                            <thead>
                              <th scope="col">Pit Org</th>
                              <th scope="col">Batteries</th>
                              <th scope="col">Chargers</th>
                              <th scope="col">Language</th>
                              <th scope="col">Auto</th>
                              <th scope="col">Perimeter</th>
                              <th scope="col">Comments</th>
                            </thead>
                            <tbody id='pitData'></tbody>
                          </table>

                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card">
                        <div class="card-header">Summary</div>
                        <div class="card-body">

                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Auto</th>
                              <th scope="col">Teleop</th>
                            </thead>
                            <tbody id='totalSummary'></tbody>
                          </table>

                          <h5>Auto Table</h5>
                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Average</th>
                              <th scope="col">Max</th>
                            </thead>
                            <tbody id='autoSummaryData'></tbody>
                          </table>

                          <h5>Teleop Table</h5>
                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Average</th>
                              <th scope="col">Max</th>
                            </thead>
                            <tbody id='teleopSummaryData'></tbody>
                          </table>
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="row pt-3 pb-3 mb-3">
                <!-- Pit Data -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                  <div class="card">
                        <div class="card-header">Comments</div>
                        <div class="card-body overflow-auto">

                          <div id='cannedComments' class='container'>
                          </div>

                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card">
                        <div class="card-header">Charts</div>
                        <div class="card-body">
                          <canvas id="dataChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("footer.php"); ?>
<script type="text/javascript" src="js/charts.js"></script>

<script>
  var dataChart = null;

  function clearData(){
    $('#robotPics').html('');
    $('#pitData').html('');
    $('#autoSummaryData').html('');
    $('#teleopSummaryData').html('');
    $('#totalSummary').html('');
    if(dataChart != null){
      dataChart.destroy();
    }
    $('#cannedComments').html('');
  }

  function createSummaryData(data){
    var points = 0;
    var pieces = 0;
    var pointsMax = 0;
    var piecesMax = 0;

    var matchCount = 0;
    var aTotal = 0;
    var aCones = 0;
    var aCubes = 0;
    var aTop = 0;
    var aMiddle = 0;
    var aBottom = 0;
    var aEngage = 0;
    var aDock = 0;
    var aMobility = 0;
    var aTotalMax = 0;
    var aConesMax = 0;
    var aCubesMax = 0;
    var aTopMax = 0;
    var aMiddleMax = 0;
    var aBottomMax = 0;

    var tTotal = 0;
    var tCones = 0;
    var tCubes = 0;
    var tTop = 0;
    var tMiddle = 0;
    var tBottom = 0;
    var tEngage = 0;
    var tDock = 0;
    var tTotalMax = 0;
    var tConesMax = 0;
    var tCubesMax = 0;
    var tTopMax = 0;
    var tMiddleMax = 0;
    var tBottomMax = 0;
    // Process summary data.
    for (var i = 0; i != data.length; i++){
      var row = data[i];
      matchCount++;

      var matchPoints = 0;
      var matchPieces = 0;

      matchPieces += row['autoConeLevel1'] +  row['autoConeLevel2'] +  row['autoConeLevel3'] + row['autoCubeLevel1'] +  row['autoCubeLevel2'] +  row['autoCubeLevel3'];
      matchPieces += row['teleopConeLevel1'] +  row['teleopConeLevel2'] +  row['teleopConeLevel3'] + row['teleopCubeLevel1'] +  row['teleopCubeLevel2'] +  row['teleopCubeLevel3'];

      matchPoints += 3 * (row['autoMobility']);
      if(row['autoChargeStation'] == 'ENGAGED'){
        matchPoints += 12;
      }
      if(row['autoChargeStation'] == 'DOCKED'){
        matchPoints += 8;
      }
      matchPoints += (6 * (row['autoConeLevel3'] + row['autoCubeLevel3']));
      matchPoints += (4 * (row['autoConeLevel2'] + row['autoCubeLevel2']));
      matchPoints += (3 * (row['autoConeLevel1'] + row['autoCubeLevel1']));
      matchPoints += (6 * (row['teleopConeLevel3'] + row['teleopCubeLevel3']));
      matchPoints += (4 * (row['teleopConeLevel2'] + row['teleopCubeLevel2']));
      matchPoints += (3 * (row['teleopConeLevel1'] + row['teleopCubeLevel1']));
      if(row['teleopChargeStation'] == 'ENGAGED'){
        matchPoints += 10;
      }
      if(row['teleopChargeStation'] == 'DOCKED'){
        matchPoints += 6;
      }

      points += matchPoints;
      pieces += matchPieces;
      pointsMax = Math.max(pointsMax, matchPoints);
      piecesMax = Math.max(piecesMax, matchPieces);

      aTotal += row['autoConeLevel1'] +  row['autoConeLevel2'] +  row['autoConeLevel3'] + row['autoCubeLevel1'] +  row['autoCubeLevel2'] +  row['autoCubeLevel3'];
      aTotalMax = Math.max(aTotalMax, row['autoConeLevel1'] +  row['autoConeLevel2'] +  row['autoConeLevel3'] + row['autoCubeLevel1'] +  row['autoCubeLevel2'] +  row['autoCubeLevel3']);

      aCones += row['autoConeLevel1'] +  row['autoConeLevel2'] +  row['autoConeLevel3'];
      aConesMax = Math.max(aConesMax, row['autoConeLevel1'] +  row['autoConeLevel2'] +  row['autoConeLevel3']);

      aCubes += row['autoCubeLevel1'] +  row['autoCubeLevel2'] +  row['autoCubeLevel3'];
      aCubesMax = Math.max(aCubesMax, row['autoCubeLevel1'] +  row['autoCubeLevel2'] +  row['autoCubeLevel3']);

      aTop += row['autoConeLevel3'] + row['autoCubeLevel3'];
      aTopMax = Math.max(aTopMax, row['autoConeLevel3'] + row['autoCubeLevel3']);

      aMiddle += row['autoConeLevel2'] + row['autoCubeLevel2'];
      aMiddleMax = Math.max(aMiddleMax, row['autoConeLevel2'] + row['autoCubeLevel2']);

      aBottom += row['autoConeLevel1'] + row['autoCubeLevel1'];
      aBottomMax = Math.max(aBottomMax, row['autoConeLevel1'] + row['autoCubeLevel1']);

      if(row['autoChargeStation'] == 'ENGAGED'){
        aEngage++;
      }
      if(row['autoChargeStation'] == 'DOCKED'){
        aDock++;
      }

      aMobility += row['autoMobility'];

      tTotal += row['teleopConeLevel1'] +  row['teleopConeLevel2'] +  row['teleopConeLevel3'] + row['teleopCubeLevel1'] +  row['teleopCubeLevel2'] +  row['teleopCubeLevel3'];
      tTotalMax = Math.max(tTotalMax, row['teleopConeLevel1'] +  row['teleopConeLevel2'] +  row['teleopConeLevel3'] + row['teleopCubeLevel1'] +  row['teleopCubeLevel2'] +  row['teleopCubeLevel3']);
      
      tCones += row['teleopConeLevel1'] +  row['teleopConeLevel2'] +  row['teleopConeLevel3'];
      tConesMax = Math.max(tConesMax, row['teleopConeLevel1'] +  row['teleopConeLevel2'] +  row['teleopConeLevel3']);
      
      tCubes += row['teleopCubeLevel1'] +  row['teleopCubeLevel2'] +  row['teleopCubeLevel3'];
      tCubesMax = Math.max(tCubesMax, row['teleopCubeLevel1'] +  row['teleopCubeLevel2'] +  row['teleopCubeLevel3']);
      
      tTop += row['teleopConeLevel3'] + row['teleopCubeLevel3'];
      tTopMax = Math.max(tTopMax, row['teleopConeLevel3'] + row['teleopCubeLevel3']);
      
      tMiddle += row['teleopConeLevel2'] + row['teleopCubeLevel2'];
      tMiddleMax = Math.max(tMiddleMax, row['teleopConeLevel2'] + row['teleopCubeLevel2']);
      
      tBottom += row['teleopConeLevel1'] + row['teleopCubeLevel1'];
      tBottomMax = Math.max(tBottomMax, row['teleopConeLevel1'] + row['teleopCubeLevel1']);

      if(row['teleopChargeStation'] == 'ENGAGED'){
        tEngage++;
      }
      if(row['teleopChargeStation'] == 'DOCKED'){
        tDock++;
      }
    }

    // Only add data if over 0.
    if (matchCount > 0){
      // Calculate avg.
      aCones /= matchCount;
      aCubes /= matchCount;
      aTop /= matchCount;
      aMiddle /= matchCount;
      aBottom /= matchCount;
      aDock = 100 * (aDock/matchCount);
      aEngage = 100 * (aEngage/matchCount);
      aMobility = 100 * (aMobility/matchCount);

      tCones /= matchCount;
      tCubes /= matchCount;
      tTop /= matchCount;
      tMiddle /= matchCount;
      tBottom /= matchCount;
      tDock = 100 * (tDock/matchCount);
      tEngage = 100 * (tEngage/matchCount);

      // Auto summary.
      var autoSummaryRows = [
        ` <tr><th scope='row'>Total Pieces</th><td scope='row'>${aTotal}</td><td scope='row'>${aTotalMax}</td></tr>`,
        ` <tr><th scope='row'>Cones</th><td scope='row'>${aCones}</td><td scope='row'>${aConesMax}</td></tr>`,
        ` <tr><th scope='row'>Cubes</th><td scope='row'>${aCubes}</td><td scope='row'>${aCubesMax}</td></tr>`,
        ` <tr><th scope='row'>Top</th><td scope='row'>${aTop}</td><td scope='row'>${aTopMax}</td></tr>`,
        ` <tr><th scope='row'>Middle</th><td scope='row'>${aMiddle}</td><td scope='row'>${aMiddleMax}</td></tr>`,
        ` <tr><th scope='row'>Bottom</th><td scope='row'>${aBottom}</td><td scope='row'>${aBottomMax}</td></tr>`,
        ` <tr><th scope='row'>Engage</th><td scope='row'>${aEngage}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Dock</th><td scope='row'>${aDock}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Mobility</th><td scope='row'>${aMobility}%</td><td scope='row'>NA</td></tr>`,
      ].join('');
      $('#autoSummaryData').append(autoSummaryRows);

      // Teleop summary.
      var teleopSummaryRows = [
        ` <tr><th scope='row'>Total Pieces</th><td scope='row'>${tTotal}</td><td scope='row'>${tTotalMax}</td></tr>`,
        ` <tr><th scope='row'>Cones</th><td scope='row'>${tCones}</td><td scope='row'>${tConesMax}</td></tr>`,
        ` <tr><th scope='row'>Cubes</th><td scope='row'>${tCubes}</td><td scope='row'>${tCubesMax}</td></tr>`,
        ` <tr><th scope='row'>Top</th><td scope='row'>${tTop}</td><td scope='row'>${tTopMax}</td></tr>`,
        ` <tr><th scope='row'>Middle</th><td scope='row'>${tMiddle}</td><td scope='row'>${tMiddleMax}</td></tr>`,
        ` <tr><th scope='row'>Bottom</th><td scope='row'>${tBottom}</td><td scope='row'>${tBottomMax}</td></tr>`,
        ` <tr><th scope='row'>Engage</th><td scope='row'>${tEngage}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Dock</th><td scope='row'>${tDock}%</td><td scope='row'>NA</td></tr>`,
      ].join('');
      $('#teleopSummaryData').append(teleopSummaryRows);

      var totalSummaryRows = [
        ` <tr><th scope='row'>Points</th><td scope='row'>${points}</td><td scope='row'>${pointsMax}</td></tr>`,
        ` <tr><th scope='row'>Game Pieces</th><td scope='row'>${pieces}</td><td scope='row'>${piecesMax}</td></tr>`,
      ].join('');
      $('#totalSummary').append(totalSummaryRows);
    }
  }

  function createDataChart(data){
    var matchList = [];
    var totalPoints = [];
    var totalCones = []
    var totalCubes = [];
    for (var i = 0; i != data.length; i++){
      var row = data[i];
      matchList.push(row['matchNumber']);

      var matchPoints = 3 * (row['autoMobility']);
      if(row['autoChargeStation'] == 'ENGAGED'){
        matchPoints += 12;
      }
      if(row['autoChargeStation'] == 'DOCKED'){
        matchPoints += 8;
      }
      matchPoints += (6 * (row['autoConeLevel3'] + row['autoCubeLevel3']));
      matchPoints += (4 * (row['autoConeLevel2'] + row['autoCubeLevel2']));
      matchPoints += (3 * (row['autoConeLevel1'] + row['autoCubeLevel1']));
      matchPoints += (6 * (row['teleopConeLevel3'] + row['teleopCubeLevel3']));
      matchPoints += (4 * (row['teleopConeLevel2'] + row['teleopCubeLevel2']));
      matchPoints += (3 * (row['teleopConeLevel1'] + row['teleopCubeLevel1']));
      if(row['teleopChargeStation'] == 'ENGAGED'){
        matchPoints += 10;
      }
      if(row['teleopChargeStation'] == 'DOCKED'){
        matchPoints += 6;
      }

      var cones = 0;
      cones += row['autoConeLevel1'] +  row['autoConeLevel2'] +  row['autoConeLevel3'];
      cones += row['teleopConeLevel1'] +  row['teleopConeLevel2'] +  row['teleopConeLevel3'];
      
      var cubes = 0;
      cubes += row['autoCubeLevel1'] +  row['autoCubeLevel2'] +  row['autoCubeLevel3'];
      cubes += row['teleopCubeLevel1'] +  row['teleopCubeLevel2'] +  row['teleopCubeLevel3'];

      totalPoints.push(matchPoints);
      totalCones.push(cones);
      totalCubes.push(cubes);

    }

    var ctx = document.getElementById('dataChart');

    dataChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: matchList,
        datasets: [{
        //  label: 'Points',
        //  data: totalPoints,
        //  fill: false,
        //  borderColor: 'rgb(75, 192, 192)'
        //},{
          label: 'Total Cubes',
          data: totalCubes,
          fill: false,
          borderColor: 'rgb(75, 0, 130)'
        },{
          label: 'Total Cones',
          data: totalCones,
          fill: false,
          borderColor: 'rgb(212, 175, 55)'
        }]
      },
      options: {

      }
    });
  }

  function createCannedBadge(comment, count){
    var rows = [
      `<button style="margin-right:10px; margin-bottom:10px;" type="button" class="btn btn-primary position-relative">`,
      `  ${comment}`,
      `  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">`,
      `    ${count}`,
      `    <span class="visually-hidden">${comment}</span>`,
      `  </span>`,
      `</button>`
    ].join('');
    $('#cannedComments').append(rows);
  }

  function createCannedComments(data){
    var commentLookup = {};
    for (var i = 0; i != data.length; i++){
      var row = data[i];
      if (row['cannedComments'] === ''){
        continue;
      }
      var cannedSplit = row['cannedComments'].split(',');
      for (var j = 0; j != cannedSplit.length; j++){
        var comment = cannedSplit[j];
        if (!(comment in commentLookup)){
          commentLookup[comment] = 0;
        }
        commentLookup[comment]++;
      }
    }

    for(let comment in commentLookup){
      createCannedBadge(comment, commentLookup[comment]);
    }
  }

  function loadTeamData(teamNumber){
    $.get('readAPI.php', {
      'readAllTeamMatchData': teamNumber
    }).done(function(data) {
      matchData = JSON.parse(data);
      createSummaryData(matchData);
      createDataChart(matchData);
      createCannedComments(matchData);
    });
  }

  function loadPitData(teamNumber){
    $.get('readAPI.php', {
      'readAllTeamPitData': teamNumber
    }).done(function(data) {
      var pit = JSON.parse(data);
      if (pit.length > 0){
        pit = pit[0];
        var row = [
          `<tr>`,
          ` <td scope='row'>${pit['disorganized']}</td>`,
          ` <td scope='row'>${pit['numBatteries']}</td>`,
          ` <td scope='row'>${pit['chargedBatteries']}</td>`,
          ` <td scope='row'>${pit['codeLanguage']}</td>`,
          ` <td scope='row'>${pit['autoPath']}</td>`,
          ` <td scope='row'>${pit['framePerimeterDimensions']}</td>`,
          ` <td scope='row'>${pit['pitComments']}</td>`,
          `</tr>`
        ].join('');
        $('#pitData').append(row);
      }
    });
  }

  function loadTeamPictures(teamNumber){
    $.get('readAPI.php', {
      'getTeamPictureFilenames': teamNumber
    }).done(function(data) {
      var images = JSON.parse(data);
      for(var i = 0; i != images.length; i++){
        var classElement = 'carousel-item'
        if (i == 0){
          classElement = 'carousel-item active';
        }
        var element = [
          `<div class='${classElement}'>`,
          ` <img src='${images[i]}' class='d-block w-100'>`,
          `</div>`
        ].join('');
        $('#robotPics').append(element);
      }
    });
  }

  function loadTeam(teamNumber){
    clearData();

    // Set Team Number
    $('#teamNumber').html('Team ' + teamNumber);

    loadTeamPictures(teamNumber);
    loadPitData(teamNumber);
    loadTeamData(teamNumber);
  }

  $(document).ready(function () {
    const url = new URLSearchParams(window.location.search);
    if (url.has('team')){
      loadTeam(url.get('team'));
    }
  });

  $('#readAllTeamMatchData').on('click', function(){
    loadTeam($('#inputTeamNumber').val());
  });
</script>
</html>