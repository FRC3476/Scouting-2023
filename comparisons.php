<title>Cosffsmparison</title>
<html lang="en">

<?php include('navbar.php');?>


<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
            <br>
            <div class="input-group mb-3">
                <input id="inputTeamNumber1" type="text" class="form-control" placeholder="Enter Team Number">
                <button id="loadTeamData1" type="button" class="btn btn-primary">Load Team Data 1</button>
            </div>
  
            <div class="row">
                
                <!-- Number + Pictures -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">
                          <h2 id='teamHeading1'></h2>
                        </div>
                        <div class="card-body">

                          <div id="robotPicsCarousel" class="carousel slide" data-interval="false">
                            <div id="robotPics1" class="carousel-inner">

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
                            <tbody id='pitData1'></tbody>
                          </table>

                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Summary</div>
                        <div class="card-body">

                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Auto</th>
                              <th scope="col">Teleop</th>
                            </thead>
                            <tbody id='totalSummary1'></tbody>
                          </table>

                          <h5>Auto Table</h5>
                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Average</th>
                              <th scope="col">Max</th>
                            </thead>
                            <tbody id='autoSummaryData1'></tbody>
                          </table>

                          <h5>Teleop Table</h5>
                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Average</th>
                              <th scope="col">Max</th>
                            </thead>
                            <tbody id='teleopSummaryData1'></tbody>
                          </table>
                            
                        </div>
                    </div>
                </div>

            
                <!-- Comment Data -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                  <div class="card mb-3 mt-3">
                        <div class="card-header">Comments</div>
                        <div class="card-body overflow-auto">

                          <div id='cannedComments1' class='container'>
                          </div>
                        </div>
                    </div>
                </div>

                <!-- Comments -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                  <div class="card mb-3 mt-3">
                        <div class="card-header">Written Comments</div>
                        <div class="card-body overflow-auto">

                          <div id='writtenComments1' class='container'>
                          </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Auto Piece Chart</div>
                        <div class="card-body">
                          <canvas id="dataChart1"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Teleop Piece Chart</div>
                        <div class="card-body">
                          <canvas id="pieceChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
            <br>
            <div class="input-group mb-3">
                <input id="inputTeamNumber2" type="text" class="form-control" placeholder="Enter Team Number">
                <button id="loadTeamData2" type="button" class="btn btn-primary">Load Team Data 2</button>
            </div>
  
            <div class="row">
                
                <!-- Number + Pictures -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">
                          <h2 id='teamHeading2'></h2>
                        </div>
                        <div class="card-body">

                          <div id="robotPicsCarousel" class="carousel slide" data-interval="false">
                            <div id="robotPics2" class="carousel-inner">

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
                            <tbody id='pitData2'></tbody>
                          </table>

                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Summary</div>
                        <div class="card-body">

                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Auto</th>
                              <th scope="col">Teleop</th>
                            </thead>
                            <tbody id='totalSummary2'></tbody>
                          </table>

                          <h5>Auto Table</h5>
                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Average</th>
                              <th scope="col">Max</th>
                            </thead>
                            <tbody id='autoSummaryData2'></tbody>
                          </table>

                          <h5>Teleop Table</h5>
                          <table class='table'>
                            <thead>
                              <th scope="col"></th>
                              <th scope="col">Average</th>
                              <th scope="col">Max</th>
                            </thead>
                            <tbody id='teleopSummaryData2'></tbody>
                          </table>
                            
                        </div>
                    </div>
                </div>

            
                <!-- Comment Data -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                  <div class="card mb-3 mt-3">
                        <div class="card-header">Comments</div>
                        <div class="card-body overflow-auto">

                          <div id='cannedComments2' class='container'>
                          </div>
                        </div>
                    </div>
                </div>

                <!-- Comments -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                  <div class="card mb-3 mt-3">
                        <div class="card-header">Written Comments</div>
                        <div class="card-body overflow-auto">

                          <div id='writtenComments2' class='container'>
                          </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Auto Piece Chart</div>
                        <div class="card-body">
                          <canvas id="dataChart2"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 col-xs-12 gx-3">
                    <div class="card mb-3 mt-3">
                        <div class="card-header">Teleop Piece Chart</div>
                        <div class="card-body">
                          <canvas id="pieceChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("footer.php"); ?>
<script type="text/javascript" src="js/charts.js"></script>
<script type="text/javascript" src="js/matchDataProcessor.js?cache=1"></script>

<!--Team 1 Script-->
<script>
  var dataChart1 = null;
  var pieceChart1 = null;

  function clearData(){
    $('#teamHeading1').html('');
    $('#robotPics1').html('');
    $('#pitData1').html('');
    $('#autoSummaryData1').html('');
    $('#teleopSummaryData1').html('');
    $('#totalSummary1').html('');
    if(dataChart1 != null){
      dataChart1.destroy();
    }
    if(pieceChart1 != null){
      pieceChart1.destroy();
    }
    $('#cannedComments1').html('');
    $('#writtenComments1').html('');

  }

  function createSummaryData(data){
    var points1 = 0;
    var pieces1 = 0;
    var pointsMax1 = 0;
    var piecesMax1 = 0;

    var matchCount1 = 0;
    var aTotal1 = 0;
    var aCones1 = 0;
    var aCubes1 = 0;
    var aTop1 = 0;
    var aMiddle1 = 0;
    var aBottom1 = 0;
    var aEngage1 = 0;
    var aDock1 = 0;
    var aMobility1 = 0;
    var aTotalMax1 = 0;
    var aConesMax1 = 0;
    var aCubesMax1 = 0;
    var aTopMax1 = 0;
    var aMiddleMax1 = 0;
    var aBottomMax1 = 0;

    var tTotal1 = 0;
    var tCones1 = 0;
    var tCubes1 = 0;
    var tTop1 = 0;
    var tMiddle1 = 0;
    var tBottom1 = 0;
    var tEngage1 = 0;
    var tDock1 = 0;
    var tTotalMax1 = 0;
    var tConesMax1 = 0;
    var tCubesMax1 = 0;
    var tTopMax1 = 0;
    var tMiddleMax1 = 0;
    var tBottomMax1 = 0;

    // Process summary data.
    for (var i = 0; i != data.length; i++){
      var row = data[i];
      matchCount1++;
      
      points1 += getMatchPoints(row);
      pieces1 += getMatchGamePiece(row);
      pointsMax1 = Math.max(pointsMax, getMatchPoints(row));
      piecesMax1 = Math.max(piecesMax, getMatchGamePiece(row));

      aTotal1 += getPiecesAuto(row);
      aCones1 += getConesAuto(row);
      aCubes1 += getCubesAuto(row)
      aTop1 += getTopAuto(row);
      aMiddle1 += getMiddleAuto(row);
      aBottom1 += getBottomAuto(row);
      aEngage1 += getEngageAuto(row) ? 1 : 0;
      aDock1 += getDockAuto(row) ? 1 : 0;
      aMobility1 += getMobilityAuto(row) ? 1 : 0;
      aTotalMax1 = Math.max(aTotalMax1, getPiecesAuto(row));
      aConesMax1 = Math.max(aConesMax1, getConesAuto(row));
      aCubesMax1 = Math.max(aCubesMax1, getCubesAuto(row));
      aTopMax1 = Math.max(aTopMax1, getTopAuto(row));
      aMiddleMax1 = Math.max(aMiddleMax1, getMiddleAuto(row));
      aBottomMax1 = Math.max(aBottomMax1, getBottomAuto(row));

      tTotal1 += getPiecesTeleop(row);
      tCones1 += getConesTeleop(row);
      tCubes1 += getCubesTeleop(row)
      tTop1 += getTopTeleop(row);
      tMiddle1 += getMiddleTeleop(row);
      tBottom1 += getBottomTeleop(row);
      tEngage1 += getEngageTeleop(row) ? 1 : 0;
      tDock1 += getDockTeleop(row) ? 1 : 0;
      tTotalMax1 = Math.max(tTotalMax1, getPiecesTeleop(row));
      tConesMax1 = Math.max(tConesMax1, getConesTeleop(row));
      tCubesMax1 = Math.max(tCubesMax1, getCubesTeleop(row));
      tTopMax1 = Math.max(tTopMax1, getTopTeleop(row));
      tMiddleMax1 = Math.max(tMiddleMax1, getMiddleTeleop(row));
      tBottomMax1 = Math.max(tBottomMax1, getBottomTeleop(row));
      
    }

    // Only add data if over 0.
    if (matchCount > 0){
      // Calculate avg.
      pieces1 = roundInt(pieces / matchCount);
      points1 = roundInt(points / matchCount);
      aTotal1 = roundInt(aTotal / matchCount);
      aCones1 /= matchCount;
      aCubes1 /= matchCount;
      aTop1 /= matchCount;
      aMiddle1 /= matchCount;
      aBottom1 /= matchCount;
      aDock1 = 100 * roundInt(aDock/matchCount);
      aEngage1 = 100 * roundInt(aEngage/matchCount);
      aMobility1 = 100 * roundInt(aMobility/matchCount);

      tTotal1 = roundInt(tTotal / matchCount);
      tCones1 /= matchCount;
      tCubes1 /= matchCount;
      tTop1 /= matchCount;
      tMiddle1 /= matchCount;
      tBottom1 /= matchCount;
      tDock1 = 100 * roundInt(tDock/matchCount);
      tEngage1 = 100 * roundInt(tEngage/matchCount);

      aCones1 = roundInt(aCones);
      aCubes1 = roundInt(aCubes);
      aTop1 = roundInt(aTop);
      aMiddle1 = roundInt(aMiddle);
      aBottom1 = roundInt(aBottom);

      tCones1 = roundInt(tCones);
      tCubes1 = roundInt(tCubes);
      tTop1 = roundInt(tTop);
      tMiddle1 = roundInt(tMiddle);
      tBottom1 = roundInt(tBottom);

      // Auto summary.
      var autoSummaryRows1 = [
        ` <tr><th scope='row'>Total Pieces</th><td scope='row'>${aTotal1}</td><td scope='row'>${aTotalMax1}</td></tr>`,
        ` <tr><th scope='row'>Cones</th><td scope='row'>${aCones1}</td><td scope='row'>${aConesMax1}</td></tr>`,
        ` <tr><th scope='row'>Cubes</th><td scope='row'>${aCubes1}</td><td scope='row'>${aCubesMax1}</td></tr>`,
        ` <tr><th scope='row'>Top</th><td scope='row'>${aTop1}</td><td scope='row'>${aTopMax1}</td></tr>`,
        ` <tr><th scope='row'>Middle</th><td scope='row'>${aMiddle1}</td><td scope='row'>${aMiddleMax1}</td></tr>`,
        ` <tr><th scope='row'>Bottom</th><td scope='row'>${aBottom1}</td><td scope='row'>${aBottomMax1}</td></tr>`,
        ` <tr><th scope='row'>Engage</th><td scope='row'>${aEngage1}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Dock</th><td scope='row'>${aDock1}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Mobility</th><td scope='row'>${aMobility1}%</td><td scope='row'>NA</td></tr>`,
      ].join('');
      $('#autoSummaryData1').append(autoSummaryRows1);

      // Teleop summary.
      var teleopSummaryRows1 = [
        ` <tr><th scope='row'>Total Pieces</th><td scope='row'>${tTotal1}</td><td scope='row'>${tTotalMax1}</td></tr>`,
        ` <tr><th scope='row'>Cones</th><td scope='row'>${tCones1}</td><td scope='row'>${tConesMax1}</td></tr>`,
        ` <tr><th scope='row'>Cubes</th><td scope='row'>${tCubes1}</td><td scope='row'>${tCubesMax1}</td></tr>`,
        ` <tr><th scope='row'>Top</th><td scope='row'>${tTop1}</td><td scope='row'>${tTopMax1}</td></tr>`,
        ` <tr><th scope='row'>Middle</th><td scope='row'>${tMiddle1}</td><td scope='row'>${tMiddleMax1}</td></tr>`,
        ` <tr><th scope='row'>Bottom</th><td scope='row'>${tBottom1}</td><td scope='row'>${tBottomMax1}</td></tr>`,
        ` <tr><th scope='row'>Engage</th><td scope='row'>${tEngage1}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Dock</th><td scope='row'>${tDock1}%</td><td scope='row'>NA</td></tr>`,
      ].join('');
      $('#teleopSummaryData1').append(teleopSummaryRows1);

      var totalSummaryRows1 = [
        ` <tr><th scope='row'>Points</th><td scope='row'>${points1}</td><td scope='row'>${pointsMax1}</td></tr>`,
        ` <tr><th scope='row'>Game Pieces</th><td scope='row'>${pieces1}</td><td scope='row'>${piecesMax1}</td></tr>`,
      ].join('');
      $('#totalSummary1').append(totalSummaryRows1);
    }
  }

  function createDataChart(data){
    var matchList1 = [];
    var highCones1 = [];
    var midCones1 = []
    var lowCones1 = [];
    var highCubes1 = [];
    var midCubes1 = []
    var lowCubes1 = [];
    var dock1 = [];
    var engage1 = [];
    var totalPieces1 = [];
    for (var i = 0; i != data.length; i++){
      var row1 = data[i];
      matchList1.push(row['matchNumber']);

      var hConesAuto1 = getTopConesAuto(row);
      var mConesAuto1 = getMiddleConesAuto(row);
      var lConesAuto1 = getBottomConesAuto(row);

      var hCubesAuto1 = getTopCubesAuto(row);
      var mCubesAuto1 = getMiddleCubesAuto(row);
      var lCubesAuto1 = getBottomCubesAuto(row);

      highCones1.push(hConesAuto1);
      midCones1.push(mConesAuto1);
      lowCones1.push(lConesAuto1);
      highCubes1.push(hCubesAuto1);
      midCubes1.push(mCubesAuto1);
      lowCubes1.push(lCubesAuto1);
      dock1.push(getDockAuto(row));
      engage1.push(getEngageAuto(row));
      totalPieces1.push(getPiecesAuto(row));
    }

    var ctx11 = document.getElementById('dataChart1');

    dataChart1 = new Chart(ctx, {
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
        },

        ],
        labels: matchList
      }
    });

  }

  function createPieceChart(data){
    var matchList1 = [];
    var highCones1 = [];
    var midCones1 = []
    var lowCones1 = [];
    var highCubes1 = [];
    var midCube1s = []
    var lowCube1s = [];
    var tDock1 = [];
    var tEngage1 = [];
    var totalPieces1 = [];
    for (var i = 0; i != data.length; i++){
      var row1 = data[i];
      matchList1.push(row['matchNumber']);

      var hCones1 = getTopConesTeleop(row);
      var mCones1 = getMiddleConesTeleop(row);
      var lCones1 = getBottomConesTeleop(row);

      var hCubes1 = getTopCubesTeleop(row);
      var mCubes1 = getMiddleCubesTeleop(row);
      var lCubes1 = getBottomCubesTeleop(row);

      highCones1.push(hCones1);
      midCones1.push(mCones1);
      lowCones1.push(lCones1);
      highCubes1.push(hCubes1);
      midCubes1.push(mCubes1);
      lowCubes1.push(lCubes1);
      tDock1.push(getDockTeleop(row));
      tEngage1.push(getEngageTeleop(row));
      totalPieces1.push(getPiecesTeleop(row));
    }

    var ctx1 = document.getElementById('pieceChart1');

    pieceChart1 = new Chart(ctx, {
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
        },{
          type: 'bar',
          label: 'Teleop Dock',
          data: tDock,
          fill: false,
          stack: 'Stack 2',
          backgroundColor: 'rgb(40, 237, 230)'
        }, {
          type: 'bar',
          label: 'Teleop Engage',
          data: tEngage,
          fill: false,
          stack: 'Stack 2',
          backgroundColor: 'rgb(40, 237, 125)'
        }

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
    $('#cannedComments1').append(rows);
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
      $('#writtenComments1').append(row);
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
        $('#teamHeading1').html(`Team ${teamNumber} - ${pit['pitTeamName']}`);
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
        $('#pitData1').append(row);
      }
    });
  }

  function loadTeamPictures(teamNumber){
    $.get('readAPI.php', {
      'getTeamPictureFilenames': teamNumber
    }).done(function(data) {
      var images1 = JSON.parse(data);
      for(var i = 0; i != images.length; i++){
        var classElement1 = 'carousel-item'
        if (i == 0){
          classElement1 = 'carousel-item active';
        }
        var element1 = [
          `<div class='${classElement1}'>`,
          ` <img src='${images1[i]}' class='d-block w-100'>`,
          `</div>`
        ].join('');
        $('#robotPics1').append(element1);
      }
    });
  }

  function loadTeam(teamNumber){
    clearData();

    // Set Team Number
    $('#teamHeading1').html('Team ' + teamNumber);

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

  $('#loadTeamData1').on('click', function(){
    loadTeam($('#inputTeamNumber1').val());
  });
</script>


<!--Team 2 Script-->
<script>
  var dataChart2 = null;
  var pieceChart2 = null;

  function clearData(){
    $('#teamHeading2').html('');
    $('#robotPics2').html('');
    $('#pitData2').html('');
    $('#autoSummaryData2').html('');
    $('#teleopSummaryData2').html('');
    $('#totalSummary2').html('');
    if(dataChart2 != null){
      dataChart2.destroy();
    }
    if(pieceChart2 != null){
      pieceChart2.destroy();
    }
    $('#cannedComments2').html('');
    $('#writtenComments2').html('');

  }

  function createSummaryData(data){
    var points2 = 0;
    var pieces2 = 0;
    var pointsMax2 = 0;
    var piecesMax2 = 0;

    var matchCount2 = 0;
    var aTotal2 = 0;
    var aCones2 = 0;
    var aCubes2 = 0;
    var aTop2 = 0;
    var aMiddle2 = 0;
    var aBottom2 = 0;
    var aEngage2 = 0;
    var aDock2 = 0;
    var aMobility2 = 0;
    var aTotalMax2 = 0;
    var aConesMax2 = 0;
    var aCubesMax2 = 0;
    var aTopMax2 = 0;
    var aMiddleMax2 = 0;
    var aBottomMax2 = 0;

    var tTotal2 = 0;
    var tCones2 = 0;
    var tCubes2 = 0;
    var tTop2 = 0;
    var tMiddle2 = 0;
    var tBottom2 = 0;
    var tEngage2 = 0;
    var tDock2 = 0;
    var tTotalMax2 = 0;
    var tConesMax2 = 0;
    var tCubesMax2 = 0;
    var tTopMax2 = 0;
    var tMiddleMax2 = 0;
    var tBottomMax2 = 0;

    // Process summary data.
    for (var i = 0; i != data.length; i++){
      var row2 = data[i];
      matchCount++;
      
      points2 += getMatchPoints(row);
      pieces2 += getMatchGamePiece(row);
      pointsMax2 = Math.max(pointsMax, getMatchPoints(row));
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
      pieces = roundInt(pieces / matchCount);
      points = roundInt(points / matchCount);
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
        ` <tr><th scope='row'>Engage</th><td scope='row'>${aEngage}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Dock</th><td scope='row'>${aDock}%</td><td scope='row'>NA</td></tr>`,
        ` <tr><th scope='row'>Mobility</th><td scope='row'>${aMobility}%</td><td scope='row'>NA</td></tr>`,
      ].join('');
      $('#autoSummaryData2').append(autoSummaryRows);

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
      $('#teleopSummaryData2').append(teleopSummaryRows);

      var totalSummaryRows = [
        ` <tr><th scope='row'>Points</th><td scope='row'>${points}</td><td scope='row'>${pointsMax}</td></tr>`,
        ` <tr><th scope='row'>Game Pieces</th><td scope='row'>${pieces}</td><td scope='row'>${piecesMax}</td></tr>`,
      ].join('');
      $('#totalSummary2').append(totalSummaryRows);
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

    var ctx = document.getElementById('dataChart2');

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
        },

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
    var tDock = [];
    var tEngage = [];
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
      tDock.push(getDockTeleop(row));
      tEngage.push(getEngageTeleop(row));
      totalPieces.push(getPiecesTeleop(row));
    }

    var ctx = document.getElementById('pieceChart2');

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
        },{
          type: 'bar',
          label: 'Teleop Dock',
          data: tDock,
          fill: false,
          stack: 'Stack 2',
          backgroundColor: 'rgb(40, 237, 230)'
        }, {
          type: 'bar',
          label: 'Teleop Engage',
          data: tEngage,
          fill: false,
          stack: 'Stack 2',
          backgroundColor: 'rgb(40, 237, 125)'
        }

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
    $('#cannedComments2').append(rows);
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
      $('#writtenComments2').append(row);
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
        $('#teamHeading2').html(`Team ${teamNumber} - ${pit['pitTeamName']}`);
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
        $('#pitData2').append(row);
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
        $('#robotPics2').append(element);
      }
    });
  }

  function loadTeam(teamNumber){
    clearData();

    // Set Team Number
    $('#teamHeading2').html('Team ' + teamNumber);

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

  $('#loadTeamData2').on('click', function(){
    loadTeam($('#inputTeamNumber2').val());
  });
</script>
</html>