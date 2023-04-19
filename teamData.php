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
  
            <div class="row">
                
                <!-- Number + Pictures -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">
                          <h2 id='teamHeading'></h2>
                        </div>
                        <div class="card-body">

                          <div id="robotPicsCarousel" class="carousel slide" data-interval="false">
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


                    <div class="card mb-3 mt-3">
                        <div class="card-header">Pit Data</div>
                        <div class="card-body overflow-auto">

                          <table class='table table-striped'>
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
					
					<div class="card mb-3 mt-3">
                        <div class="card-header">Strike Data</div>
                        <div class="card-body overflow-auto">

                          <table class='table table-striped'>
                            <thead>
                              <th scope="col">Vibe Check</th>
                              <th scope="col">Bumper Check</th>
                              <th scope="col">Mechanical Robustness</th>
                              <th scope="col">Electrical Robustness</th>
                              <th scope="col">Comments</th>
                            </thead>
                            <tbody id='strikeData'></tbody>
                          </table>

                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Summary</div>
                        <div class="card-body">

                          <table class='table table-striped'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Auto</th>
                              <th scope="col">Teleop</th>
							  <th scope="col">Total</th>
                            </thead>
                            <tbody id='totalSummary'></tbody>
                          </table>

                          <h5>Auto Table</h5>
                          <table class='table table-striped'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Average</th>
                              <th scope="col">Max</th>
                            </thead>
                            <tbody id='autoSummaryData'></tbody>
                          </table>

                          <h5>Teleop Table</h5>
                          <table class='table table-striped'>
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

            
                <!-- Comment Data -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                  <div class="card mb-3 mt-3">
                        <div class="card-header">Comments</div>
                        <div class="card-body overflow-auto">

                          <div id='cannedComments' class='container'>
                          </div>
                        </div>
                    </div>
                </div>

                <!-- Comments -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                  <div class="card mb-3 mt-3">
                        <div class="card-header">Written Comments</div>
                        <div class="card-body overflow-auto">

                          <div id='writtenComments' class='container'>
                          </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Auto Piece Chart</div>
                        <div class="card-body">
                          <canvas id="dataChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Teleop Piece Chart</div>
                        <div class="card-body">
                          <canvas id="pieceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("footer.php"); ?>
<script type="text/javascript" src="js/charts.js"></script>
<script type="text/javascript" src="js/matchDataProcessor.js"></script>

<script>
  var dataChart = null;
  var pieceChart = null;

  function clearData(){
    $('#teamHeading').html('');
    $('#robotPics').html('');
    $('#pitData').html('');
    $('#autoSummaryData').html('');
    $('#teleopSummaryData').html('');
    $('#totalSummary').html('');
    if(dataChart != null){
      dataChart.destroy();
    }
    if(pieceChart != null){
      pieceChart.destroy();
    }
    $('#cannedComments').html('');
    $('#writtenComments').html('');

  }

  function createSummaryData(data){
    var pointsAuto = 0;
    var pointsTeleop = 0;
	  var pointsTotal = 0;
	  var piecesTotal = 0;
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
      
      pointsAuto += getMatchPointsAuto(row);
      pointsTeleop += getMatchPointsTeleop(row);
	    pointsTotal += getMatchPoints(row);
	    piecesTotal += getMatchGamePiece(row);
      pointsMax = Math.max(pointsMax, getMatchPointsAuto(row));
      piecesMax = Math.max(piecesMax, getMatchGamePiece(row));

      aTotal += getPiecesAuto(row);
      aCones += getConesAuto(row);
      aCubes += getCubesAuto(row)
      aTop += getTopAuto(row);
      aMiddle += getMiddleAuto(row);
      aBottom += getBottomAuto(row);
      aEngage += getEngageAuto(row) ? 1 : 0;
      aDock += getDockAuto(row) ? 1 : 0;
      aMobility += getMobilityAuto(row) ? 1 : 0;
      aTotalMax = Math.max(aTotalMax, getPiecesAuto(row));
      aConesMax = Math.max(aConesMax, getConesAuto(row));
      aCubesMax = Math.max(aCubesMax, getCubesAuto(row));
      aTopMax = Math.max(aTopMax, getTopAuto(row));
      aMiddleMax = Math.max(aMiddleMax, getMiddleAuto(row));
      aBottomMax = Math.max(aBottomMax, getBottomAuto(row));

      tTotal += getPiecesTeleop(row);
      tCones += getConesTeleop(row);
      tCubes += getCubesTeleop(row)
      tTop += getTopTeleop(row);
      tMiddle += getMiddleTeleop(row);
      tBottom += getBottomTeleop(row);
      tEngage += getEngageTeleop(row) ? 1 : 0;
      tDock += getDockTeleop(row) ? 1 : 0;
      tTotalMax = Math.max(tTotalMax, getPiecesTeleop(row));
      tConesMax = Math.max(tConesMax, getConesTeleop(row));
      tCubesMax = Math.max(tCubesMax, getCubesTeleop(row));
      tTopMax = Math.max(tTopMax, getTopTeleop(row));
      tMiddleMax = Math.max(tMiddleMax, getMiddleTeleop(row));
      tBottomMax = Math.max(tBottomMax, getBottomTeleop(row));
      
    }

    // Only add data if over 0.
    if (matchCount > 0){
      // Calculate avg.
      pointsAuto = roundInt(pointsAuto / matchCount);
      pointsTeleop = roundInt(pointsTeleop / matchCount);
	    pointsTotal = roundInt(pointsTotal / matchCount);
	    piecesTotal = roundInt(piecesTotal / matchCount);
      aTotal = roundInt(aTotal / matchCount);
      aCones /= matchCount;
      aCubes /= matchCount;
      aTop /= matchCount;
      aMiddle /= matchCount;
      aBottom /= matchCount;
      aDock = 100 * roundInt(aDock/matchCount);
      aEngage = 100 * roundInt(aEngage/matchCount);
      aMobility = 100 * roundInt(aMobility/matchCount);

      tTotal = roundInt(tTotal / matchCount);
      tCones /= matchCount;
      tCubes /= matchCount;
      tTop /= matchCount;
      tMiddle /= matchCount;
      tBottom /= matchCount;
      tDock = 100 * roundInt(tDock/matchCount);
      tEngage = 100 * roundInt(tEngage/matchCount);

      aCones = roundInt(aCones);
      aCubes = roundInt(aCubes);
      aTop = roundInt(aTop);
      aMiddle = roundInt(aMiddle);
      aBottom = roundInt(aBottom);

      tCones = roundInt(tCones);
      tCubes = roundInt(tCubes);
      tTop = roundInt(tTop);
      tMiddle = roundInt(tMiddle);
      tBottom = roundInt(tBottom);

      // Auto summary.
      var autoSummaryRows = [
        ` <tr><th scope='row'>Total Pieces</th><td scope='row'>${aTotal}</td><td scope='row'>${aTotalMax}</td></tr>`,
        ` <tr><th scope='row'>Cones</th><td scope='row'>${aCones}</td><td scope='row'>${aConesMax}</td></tr>`,
        ` <tr><th scope='row'>Cubes</th><td scope='row'>${aCubes}</td><td scope='row'>${aCubesMax}</td></tr>`,
        ` <tr><th scope='row'>Top</th><td scope='row'>${aTop}</td><td scope='row'>${aTopMax}</td></tr>`,
        ` <tr><th scope='row'>Middle</th><td scope='row'>${aMiddle}</td><td scope='row'>${aMiddleMax}</td></tr>`,
        ` <tr><th scope='row'>Bottom</th><td scope='row'>${aBottom}</td><td scope='row'>${aBottomMax}</td></tr>`,
        ` <tr><th scope='row'>Engage</th><td scope='row'>${aEngage}%</td><td scope='row'>N/A</td></tr>`,
        ` <tr><th scope='row'>Dock</th><td scope='row'>${aDock}%</td><td scope='row'>N/A</td></tr>`,
        ` <tr><th scope='row'>Mobility</th><td scope='row'>${aMobility}%</td><td scope='row'>N/A</td></tr>`,
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
        ` <tr><th scope='row'>Engage</th><td scope='row'>${tEngage}%</td><td scope='row'>N/A</td></tr>`,
        ` <tr><th scope='row'>Dock</th><td scope='row'>${tDock}%</td><td scope='row'>N/A</td></tr>`,
      ].join('');
      $('#teleopSummaryData').append(teleopSummaryRows);

      var totalSummaryRows = [
        ` <tr><th scope='row'>Average Points</th><td scope='row'>${pointsAuto}</td><td scope='row'>${pointsTeleop}</td><td scope='row'>${pointsTotal}</td></tr>`,
        ` <tr><th scope='row'>Average Game Pieces</th><td scope='row'>${aTotal}</td><td scope='row'>${tTotal}</td><td scope='row'>${piecesTotal}</td></tr>`,
      ].join('');
      $('#totalSummary').append(totalSummaryRows);
    }
  }

  function createDataChart(data){
    var matchList = [];
    var highCones = [];
    var midCones = []
    var lowCones = [];
    var highCubes = [];
    var midCubes = []
    var lowCubes = [];
    var dock = [];
    var engage = [];
    var totalPieces = [];
    for (var i = 0; i != data.length; i++){
      var row = data[i];
      matchList.push(row['matchNumber']);

      var hConesAuto = getTopConesAuto(row);
      var mConesAuto = getMiddleConesAuto(row);
      var lConesAuto = getBottomConesAuto(row);

      var hCubesAuto = getTopCubesAuto(row);
      var mCubesAuto = getMiddleCubesAuto(row);
      var lCubesAuto = getBottomCubesAuto(row);

      highCones.push(hConesAuto);
      midCones.push(mConesAuto);
      lowCones.push(lConesAuto);
      highCubes.push(hCubesAuto);
      midCubes.push(mCubesAuto);
      lowCubes.push(lCubesAuto);
      dock.push(getDockAuto(row));
      engage.push(getEngageAuto(row));
      totalPieces.push(getPiecesAuto(row));
    }

    var ctx = document.getElementById('dataChart');

    dataChart = new Chart(ctx, {
      data: {
        datasets: [{
          type: 'bar',
          label: 'Low Cubes',
          data: lowCubes,
          stack: 'Stack 0',
          backgroundColor: 'rgba(70, 40, 230, 0.5)'
        }, {
          type: 'bar',
          label: 'Mid Cubes',
          data: midCubes,
          stack: 'Stack 0',
          backgroundColor: 'rgba(160, 40, 230, 0.5)'
        }, {
          type: 'bar',
          label: 'High Cubes',
          data: highCubes,
          stack: 'Stack 0',
          backgroundColor: 'rgba(230, 40, 230, 0.5)'
        }, {
          type: 'bar',
          label: 'Low Cones',
          data: lowCones,
          stack: 'Stack 1',
          backgroundColor: 'rgba(237, 70, 40, 0.5)'
        }, {
          type: 'bar',
          label: 'Mid Cones',
          data: midCones,
          stack: 'Stack 1',
          backgroundColor: 'rgba(237, 160, 40, 0.5)'
        }, {
          type: 'bar',
          label: 'High Cones',
          data: highCones,
          stack: 'Stack 1',
          backgroundColor: 'rgba(237, 230, 40, 0.5)'
        }, {
          type: 'line',
          label: 'Total Pieces',
          data: totalPieces,
          borderColor: 'rgb(0, 0, 0)'
        }, {
          type: 'bar',
          label: 'Dock',
          data: dock,
          fill: false,
          stack: 'Stack 2',
          backgroundColor: 'rgb(40, 237, 230)'
        }, {
          type: 'bar',
          label: 'Engage',
          data: engage,
          fill: false,
          stack: 'Stack 2',
          backgroundColor: 'rgb(40, 237, 125)'
        }

        ],
        labels: matchList
      }
    });

  }

  function createPieceChart(data){
    var matchList = [];
    var highCones = [];
    var midCones = []
    var lowCones = [];
    var highCubes = [];
    var midCubes = []
    var lowCubes = [];
    var totalPieces = [];
    for (var i = 0; i != data.length; i++){
      var row = data[i];
      matchList.push(row['matchNumber']);

      var hCones = getTopConesTeleop(row);
      var mCones = getMiddleConesTeleop(row);
      var lCones = getBottomConesTeleop(row);

      var hCubes = getTopCubesTeleop(row);
      var mCubes = getMiddleCubesTeleop(row);
      var lCubes = getBottomCubesTeleop(row);

      highCones.push(hCones);
      midCones.push(mCones);
      lowCones.push(lCones);
      highCubes.push(hCubes);
      midCubes.push(mCubes);
      lowCubes.push(lCubes);
      totalPieces.push(getPiecesTeleop(row));
    }

    var ctx = document.getElementById('pieceChart');

    pieceChart = new Chart(ctx, {
      data: {
        datasets: [{
          type: 'bar',
          label: 'Low Cubes',
          data: lowCubes,
          stack: 'Stack 0',
          backgroundColor: 'rgba(70, 40, 230, 0.5)'
        }, {
          type: 'bar',
          label: 'Mid Cubes',
          data: midCubes,
          stack: 'Stack 0',
          backgroundColor: 'rgba(160, 40, 230, 0.5)'
        }, {
          type: 'bar',
          label: 'High Cubes',
          data: highCubes,
          stack: 'Stack 0',
          backgroundColor: 'rgba(230, 40, 230, 0.5)'
        }, {
          type: 'bar',
          label: 'Low Cones',
          data: lowCones,
          stack: 'Stack 1',
          backgroundColor: 'rgba(237, 70, 40, 0.5)'
        }, {
          type: 'bar',
          label: 'Mid Cones',
          data: midCones,
          stack: 'Stack 1',
          backgroundColor: 'rgba(237, 160, 40, 0.5)'
        }, {
          type: 'bar',
          label: 'High Cones',
          data: highCones,
          stack: 'Stack 1',
          backgroundColor: 'rgba(237, 230, 40, 0.5)'
        }, {
          type: 'line',
          label: 'Total Pieces',
          data: totalPieces,
          borderColor: 'rgb(0, 0, 0)'
        },

        ],
        labels: matchList
      }
    });


  }




  function createCannedBadge(comment, matchList){
    var matches = matchList.join(', ');
    var count = matchList.length;
    var rows = [
      `<button style="margin-right:10px; margin-bottom:10px;" type="button" class="btn btn-primary position-relative" data-bs-container="#cannedComments" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${matches}">`,
      `  ${comment}`,
      `  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">`,
      `    ${count}`,
     //  `    <span class="visually-hidden">${comment}</span>`,
      `  </span>`,
      `</button>`
    ].join('');
    $('#cannedComments').append(rows);
  }

  function createCannedComments(data) {
    var commentLookup = getCannedCommentsDictionary(data);

    for(let comment in commentLookup){
      createCannedBadge(comment, commentLookup[comment]);
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

  }

  function createWrittenComments(data) {
    var writtenComments = []
    writtenComments = getWrittenComments(data);

    for(var i = 0; i != writtenComments.length; i+=2){
      var row = [
        `<button style="margin-right:10px; margin-bottom:10px;" type="button" class="btn btn-primary position-relative">`,
        `${writtenComments[i+1]}` + `${writtenComments[i]}`,
        `</button>`
      
      ].join('');
      $('#writtenComments').append(row);
    }

  }

  var ba = 0;

  function sortMatchData(data){
    return data.sort(function(a , b){
      return a['matchNumber'] - b['matchNumber'];
    });
  }

  function loadTeamData(teamNumber){
    $.get('readAPI.php', {
      'readAllTeamMatchData': teamNumber
    }).done(function(data) {
      matchData = JSON.parse(data);
      matchData = sortMatchData(matchData);
      createSummaryData(matchData);
      createDataChart(matchData);
      createPieceChart(matchData);
      createWrittenComments(matchData)
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
        $('#teamHeading').html(`Team ${teamNumber}`);
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
  
  function loadStrikeData(teamNumber){
    $.get('readAPI.php', {
      'readAllTeamStrikeData': teamNumber
    }).done(function(data) {
      var strike = JSON.parse(data);
      if (strike.length > 0){
        strike = strike[0];
        $('#teamHeading').html(`Team ${teamNumber}`);
        var row = [
          `<tr>`,
          ` <td scope='row'>${strike['vibes']}</td>`,
          ` <td scope='row'>${strike['bumpers']}</td>`,
          ` <td scope='row'>${strike['mechRobustness']}</td>`,
          ` <td scope='row'>${strike['elecRobustness']}</td>`,
          ` <td scope='row'>${strike['strikeComments']}</td>`,
          `</tr>`
        ].join('');
        $('#strikeData').append(row);
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
    $('#teamHeading').html('Team ' + teamNumber);

    loadTeamPictures(teamNumber);
    loadPitData(teamNumber);
	loadStrikeData(teamNumber);
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