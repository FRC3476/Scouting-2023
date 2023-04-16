<title>Graph View</title>
<html lang="en">

<?php include('navbar.php');?>


<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
  
            <div class="row">

              <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                <div class="card mb-3 mt-3">
                  <div class="card-header" id="chartHeader">
                  </div>
                  <div class="card-body">
                    <canvas id="dataChart"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                <div class="card mb-3 mt-3">
                  <div class="card-body">
                    <div class="mb-3">
                      <label for="selectXAxis" class="form-label">X Axis</label>
                      <select class="form-select graphSelect" id="selectXAxis" aria-label="Graph X Axis">
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="selectYAxis" class="form-label">Y Axis</label>
                      <select class="form-select graphSelect" id="selectYAxis" aria-label="Graph Y Axis">
                      </select>
                    </div>
                  </div>
                </div>
              </div>

            </div>

        </div>
    </div>
</body>

<?php include("footer.php"); ?>
<script type="text/javascript" src="js/charts.js"></script>
<script type="text/javascript" src="js/matchDataProcessor.js?cache=6"></script>

<script>
 var teamData = null;
 var dataChart = null;

  function addSelectOptions(){
    var firstTeam = null;
    for (const team in teamData){
      firstTeam = team;
      break;
    }
    for(const key in teamData[firstTeam]){
      $('#selectXAxis').append($(new Option(key, key)));
      $('#selectYAxis').append($(new Option(key, key)));
    }
  }

  function getTeamScatterDatasets(xLabel, yLabel){
    var data = {};
    data['datasets'] = [];
    for (const team in teamData){
      var scatterData = {};
      scatterData['label'] = team;
      scatterData['data'] = [{'x': teamData[team][xLabel], 'y': teamData[team][yLabel]}];
      data['datasets'].push(scatterData);
    }
    return data;
  }

  function drawChart(xLabel, yLabel){
    if (dataChart != null){
      dataChart.destroy();
    }
    $('#chartHeader').html(`${xLabel} / ${yLabel}`);
    var ctx = document.getElementById('dataChart');
    var teamDatasets = getTeamScatterDatasets(xLabel, yLabel);

    dataChart = new Chart(ctx, {
      type: 'scatter',
      data: teamDatasets,
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: `${xLabel} / ${yLabel}`,
          }
        },
        elements: {
          point: {
            radius: 7,
            hoverRadius: 8
          }
        },
        scales: {
          y: {
            title: {
              display: true,
              text: yLabel
            },
          },
          x: {
            title: {
              display: true,
              text: xLabel
            },
          }
        }
      }
    });

  }

  function calculateMatchAverage(matches, func){
    var out = 0;
    for (var i = 0; i != matches.length; i++){
      out += func(matches[i]);
    }
    return out/matches.length;
  }

  function calculateMatchMax(matches, func){
    var out = 0;
    for (var i = 0; i != matches.length; i++){
      out = Math.max(func(matches[i]), out);
    }
    return out;
  }

  function getMatchAutoPlusEndgamePoints(row){
    return getMatchPointsAuto(row) + getTeleopChargeStationPoints(row);
  }

  function matchDataToTeamData(matchData){
    var teamMatchDataLookup = {};
    for (var i = 0; i != matchData.length; i++){
      var team = matchData[i]['teamNumber'];
      if (! (team in teamMatchDataLookup)){
        teamMatchDataLookup[team] = [];
      }
      teamMatchDataLookup[team].push(matchData[i]);
    }

    var teamToData = {};
    for (const team in teamMatchDataLookup){
      var matches = teamMatchDataLookup[team];
      teamToData[team] = {};
      teamToData[team]['Avg Teleop Pieces'] = calculateMatchAverage(matches, getPiecesTeleop);
      teamToData[team]['Avg Teleop Points'] = calculateMatchAverage(matches, getMatchPointsTeleop);
      teamToData[team]['Avg Pieces'] = calculateMatchAverage(matches, getMatchGamePiece);
      teamToData[team]['Avg Points'] = calculateMatchAverage(matches, getMatchPoints);
      teamToData[team]['Avg Auto Pieces'] = calculateMatchAverage(matches, getPiecesAuto);
      teamToData[team]['Avg Auto Points'] = calculateMatchAverage(matches, getMatchPointsAuto);
      teamToData[team]['Avg Auto + Endgame Points'] = calculateMatchAverage(matches, getMatchAutoPlusEndgamePoints);
      teamToData[team]['Avg Cones'] = calculateMatchAverage(matches, getCones);
      teamToData[team]['Avg Cubes'] = calculateMatchAverage(matches, getCubes);

      teamToData[team]['Max Teleop Pieces'] = calculateMatchMax(matches, getPiecesTeleop);
      teamToData[team]['Max Teleop Points'] = calculateMatchMax(matches, getMatchPointsTeleop);
      teamToData[team]['Max Pieces'] = calculateMatchMax(matches, getMatchGamePiece);
      teamToData[team]['Max Points'] = calculateMatchMax(matches, getMatchPoints);
      teamToData[team]['Max Auto Pieces'] = calculateMatchMax(matches, getPiecesAuto);
      teamToData[team]['Max Auto Points'] = calculateMatchMax(matches, getMatchPointsAuto);
      teamToData[team]['Max Auto + Endgame Points'] = calculateMatchMax(matches, getMatchAutoPlusEndgamePoints);
      teamToData[team]['Max Cones'] = calculateMatchMax(matches, getCones);
      teamToData[team]['Max Cubes'] = calculateMatchMax(matches, getCubes);
    }
    return teamToData;
  }

  function initiallyLoadGraph(){
    var xTitle = 'Avg Teleop Pieces';
    var yTitle = 'Avg Points';
    $('#selectXAxis').val(xTitle);
    $('#selectYAxis').val(yTitle);
    drawChart(xTitle, yTitle);
  }

  function loadTeamData(teamNumber){
    $.get('readAPI.php', {
      'readAllMatchData': true
    }).done(function(data) {
      matchData = JSON.parse(data);
      teamData = matchDataToTeamData(matchData);
      addSelectOptions();
      initiallyLoadGraph();
    });
  }

  $(document).ready(function () {
    loadTeamData();
  });

  $('.graphSelect').change(function (){
    var xAxis = $('#selectXAxis').val();
    var yAxis = $('#selectYAxis').val();
    drawChart(xAxis, yAxis);
  });


</script>
</html>