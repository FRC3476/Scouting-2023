<title>Match Strategy</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3 justify-content-md-center">
      
        <!-- Left column -->
        <div class="col-md-6 col-sm-12 col-xs-12 gx-3">
          <div class="card">
            <div class="card-body">

                <div id='ourMatches'></div>

                <div class="input-group mb-3">
                  <select class="form-select" id="writeCompLevel" aria-label="Comp Level Select">
                    <option value="qm">QM</option>
                    <option value="sf">SF</option>
                    <option value="f">F</option>
                  </select>
                  <input id="writeMatchNumber" type="text" class="form-control" placeholder="Match Number" aria-label="writeMatchNumber">
                  <button id="loadMatch" type="button" class="btn btn-primary">Load Match</button>
                </div>

                <h3 id='matchBanner'>Match:</h3>
                <h4 id='timeBanner'>Time:</h4>

                <table class='table'>
                  <thead>
                    <th scope="col"></th>
                    <th scope="col" class="table-danger">Red</th>
                    <th scope="col" class="table-primary">Blue</th>
                  </thead>
                  <tbody id='summaryTable'></tbody>
                </table>
            
            </div>
          </div>
        </div>
      </div>
      <div class="row pt-3 pb-3 mb-3 gap-0 row-gap-3">
        <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-danger">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingRed1">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picRed1Accordian" aria-expanded="true" aria-controls="picRed1Accordian">
                    <h4><div id='teamHeadingRed1'>Team</div></h4>
                    <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </div>
                  </button>
                </h2>
                <div id="picRed1Accordian" class="accordion-collapse collapse" aria-labelledby="headingRed1">
                  <div id='picRed1' class="accordion-body">

                  </div>
                </div>
              </div>

              <div class='overflow-auto'>
                <table class='table text-bg-danger'>
                  <thead>
                    <th scope="col">Avg Auto Pieces</th>
                    <th scope="col">Auto Engage OR Dock</th>
                    <th scope="col">Avg Telop Pieces</th>
                    <th scope="col">Avg Telop Cones</th>
                    <th scope="col">Avg Telop Cubes</th>
                    <th scope="col">Telop Engage %</th>
                    <th scope="col">Telop Dock %</th>
                  </thead>
                  <tbody id='dataRed1'></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-danger">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingRed2">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picRed2Accordian" aria-expanded="true" aria-controls="picRed2Accordian">
                    <h4><div id='teamHeadingRed2'>Team</div></h4>
                    <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </div>
                  </button>
                </h2>
                <div id="picRed2Accordian" class="accordion-collapse collapse" aria-labelledby="headingRed2">
                  <div id='picRed2' class="accordion-body">

                  </div>
                </div>
              </div>

              <div class='overflow-auto'>
                <table class='table text-bg-danger'>
                  <thead>
                    <th scope="col">Avg Auto Pieces</th>
                    <th scope="col">Auto Engage OR Dock</th>
                    <th scope="col">Avg Telop Pieces</th>
                    <th scope="col">Avg Telop Cones</th>
                    <th scope="col">Avg Telop Cubes</th>
                    <th scope="col">Telop Engage %</th>
                    <th scope="col">Telop Dock %</th>
                  </thead>
                  <tbody id='dataRed2'></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        
        <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-danger">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingRed3">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picRed3Accordian" aria-expanded="true" aria-controls="picRed3Accordian">
                    <h4><div id='teamHeadingRed3'>Team</div></h4>
                    <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </div>
                  </button>
                </h2>
                <div id="picRed3Accordian" class="accordion-collapse collapse" aria-labelledby="headingRed3">
                  <div id='picRed3' class="accordion-body">

                  </div>
                </div>
              </div>

              <div class='overflow-auto'>
                <table class='table text-bg-danger'>
                  <thead>
                    <th scope="col">Avg Auto Pieces</th>
                    <th scope="col">Auto Engage OR Dock</th>
                    <th scope="col">Avg Telop Pieces</th>
                    <th scope="col">Avg Telop Cones</th>
                    <th scope="col">Avg Telop Cubes</th>
                    <th scope="col">Telop Engage %</th>
                    <th scope="col">Telop Dock %</th>
                  </thead>
                  <tbody id='dataRed3'></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row pt-3 pb-3 mb-3 justify-content-md-center gap-0 row-gap-3">

      <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-primary">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingBlue1">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picBlue1Accordian" aria-expanded="true" aria-controls="picBlue1Accordian">
                    <h4><div id='teamHeadingBlue1'>Team</div></h4>
                    <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </div>
                  </button>
                </h2>
                <div id="picBlue1Accordian" class="accordion-collapse collapse" aria-labelledby="headingBlue1">
                  <div id='picBlue1' class="accordion-body">
                  
                  </div>
                </div>
              </div>

              <div class='overflow-auto'>
                <table class='table text-bg-primary'>
                  <thead>
                    <th scope="col">Avg Auto Pieces</th>
                    <th scope="col">Auto Engage OR Dock</th>
                    <th scope="col">Avg Telop Pieces</th>
                    <th scope="col">Avg Telop Cones</th>
                    <th scope="col">Avg Telop Cubes</th>
                    <th scope="col">Telop Engage %</th>
                    <th scope="col">Telop Dock %</th>
                  </thead>
                  <tbody id='dataBlue1'></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-primary">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingBlue2">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picBlue2Accordian" aria-expanded="true" aria-controls="picBlue2Accordian">
                   <h4><div id='teamHeadingBlue2'>Team</div></h4>
                    <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </div>
                  </button>
                </h2>
                <div id="picBlue2Accordian" class="accordion-collapse collapse" aria-labelledby="headingBlue2">
                  <div id='picBlue2' class="accordion-body">

                  </div>
                </div>
              </div>

              <div class='overflow-auto'>
                <table class='table text-bg-primary'>
                  <thead>
                    <th scope="col">Avg Auto Pieces</th>
                    <th scope="col">Auto Engage OR Dock</th>
                    <th scope="col">Avg Telop Pieces</th>
                    <th scope="col">Avg Telop Cones</th>
                    <th scope="col">Avg Telop Cubes</th>
                    <th scope="col">Telop Engage %</th>
                    <th scope="col">Telop Dock %</th>
                  </thead>
                  <tbody id='dataBlue2'></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        
        <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-primary">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingBlue3">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picBlue3Accordian" aria-expanded="true" aria-controls="picBlue3Accordian">
                    <h4><div id='teamHeadingBlue3'>Team</div></h4>
                    <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </div>
                  </button>
                </h2>
                <div id="picBlue3Accordian" class="accordion-collapse collapse" aria-labelledby="headingBlue3">
                  <div id='picBlue3' class="accordion-body">

                  </div>
                </div>
              </div>

              <div class='overflow-auto'>
                <table class='table text-bg-primary'>
                  <thead>
                    <th scope="col">Avg Auto Pieces</th>
                    <th scope="col">Auto Engage OR Dock</th>
                    <th scope="col">Avg Telop Pieces</th>
                    <th scope="col">Avg Telop Cones</th>
                    <th scope="col">Avg Telop Cubes</th>
                    <th scope="col">Telop Engage %</th>
                    <th scope="col">Telop Dock %</th>
                  </thead>
                  <tbody id='dataBlue3'></tbody>
                </table>
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

var validBlueTeams = 0;
var validRedTeams = 0

var avgBluePoints = 0;
var avgRedPoints = 0;

var avgBlueGamePieces = 0;
var avgRedGamePieces = 0;

var avgAutoBlueChargeStationPoints = 0;
var avgTeleopBlueChargeStationPoints = 0;
var avgAutoRedChargeStationPoints = 0;
var avgTeleopRedChargeStationPoints = 0;


function clearData(){
  $('dataRed1').html('')
  $('dataRed2').html('')
  $('dataRed3').html('')
  $('dataBlue1').html('')
  $('dataBlue2').html('')
  $('dataBlue3').html('')
  clearMainSummary();
}

function clearMainSummary(){
  validBlueTeams = 0;
  validRedTeams = 0;

  avgBluePoints = 0;
  avgRedPoints = 0;

  avgBlueGamePieces = 0;
  avgRedGamePieces = 0;

  avgAutoBlueChargeStationPoints = 0;
  avgTeleopBlueChargeStationPoints = 0;
  avgAutoRedChargeStationPoints = 0;
  avgTeleopRedChargeStationPoints = 0;
    
  updateSummaryTable();
}

function augmentTotalMatchSummary(data, alliance){

  var avgPieces = 0;
  var avgPoints = 0;
  var avgAutoChargeStationPoints = 0;
  var avgTeleopChargeStationPoints = 0;
  var matchCount = 0;

  for (var i = 0; i != data.length; i++){
    matchCount++;
    avgPieces += getMatchGamePiece(data[i]);
    avgPoints += getMatchPoints(data[i]);
    avgAutoChargeStationPoints += getAutoChargeStationPoints(data[i]);
    avgTeleopChargeStationPoints += getTeleopChargeStationPoints(data[i]);
  }

  if (matchCount == 0){
    return;
  }
  
  avgPieces = roundInt(avgPieces/matchCount);
  avgPoints = roundInt(avgPoints/matchCount);
  avgAutoChargeStationPoints = roundInt(avgAutoChargeStationPoints/matchCount);
  avgTeleopChargeStationPoints = roundInt(avgTeleopChargeStationPoints/matchCount);

  if (alliance == 'Red'){
    validRedTeams++;
    avgRedPoints += avgPoints;
    avgRedGamePieces += avgPieces;
    avgAutoRedChargeStationPoints += avgAutoChargeStationPoints;
    avgTeleopRedChargeStationPoints += avgTeleopChargeStationPoints;
  }
  else {
    validBlueTeams++;
    avgBluePoints += avgPoints;
    avgBlueGamePieces += avgPieces;
    avgAutoBlueChargeStationPoints += avgAutoChargeStationPoints;
    avgTeleopBlueChargeStationPoints += avgTeleopChargeStationPoints;
  }
  updateSummaryTable();
}

function updateSummaryTable(){
  var row = [
    `<tr>`,
    `  <th scope='col'>Avg Points</th>`,
    `  <td scope='col' class="table-danger">${roundInt(avgRedPoints)}</td>`,
    `  <td scope='col' class="table-primary">${roundInt(avgBluePoints)}</td>`,
    `</tr>`,
    `<tr>`,
    `  <th scope='col'>Avg Pieces</th>`,
    `  <td scope='col' class="table-danger">${roundInt(avgRedGamePieces)}</td>`,
    `  <td scope='col' class="table-primary">${roundInt(avgBlueGamePieces)}</td>`,
    `</tr>`,
    `<tr>`,
    `  <th scope='col'>Avg Charge Station Points</th>`,
    `  <td scope='col' class="table-danger">${roundInt(Math.min(avgAutoRedChargeStationPoints, 12) + avgTeleopRedChargeStationPoints)}</td>`,
    `  <td scope='col' class="table-primary">${roundInt(Math.min(avgAutoBlueChargeStationPoints, 12) + avgTeleopBlueChargeStationPoints)}</td>`,
    `</tr>`,
  ].join('');
  $('#summaryTable').html(row);
}

function augmentTeamDataSummary(data, elementSuffix){
  var matchCount = 0;
  var avgAutoPiece = 0;
  var avgAutoEngageOrDock = 0;
  var avgTelopPiece = 0;
  var avgTeleopCones = 0;
  var avgTeleopCubes = 0;
  var avgTeleopEngage = 0;
  var avgTeleopDock = 0;
  for (var i = 0; i != data.length; i++){
    var match = data[i];
    matchCount++;
    avgAutoPiece += getPiecesAuto(match);
    avgAutoEngageOrDock += getDockAuto(match) || getEngageAuto(match) ? 1 : 0;
    avgTelopPiece += getPiecesTeleop(match);
    avgTeleopCones += getConesTeleop(match);
    avgTeleopCubes += getCubesTeleop(match);
    avgTeleopEngage += getEngageTeleop(match) ? 1 : 0;
    avgTeleopDock += getDockTeleop(match) ? 1 : 0;
  }

  if (matchCount > 0){
    avgAutoPiece = roundInt(avgAutoPiece / matchCount);
    avgAutoEngageOrDock = roundInt(100 * avgAutoEngageOrDock / matchCount);
    avgTelopPiece = roundInt(avgTelopPiece / matchCount);
    avgTeleopCones = roundInt(avgTeleopCones / matchCount);
    avgTeleopCubes = roundInt(avgTeleopCubes / matchCount);
    avgTeleopEngage = roundInt(100 * avgTeleopEngage / matchCount);
    avgTeleopDock = roundInt(100 * avgTeleopDock / matchCount);

    var rows = [
      `<tr>`,
      `  <td scope='col'>${avgAutoPiece}</td>`,
      `  <td scope='col'>${avgAutoEngageOrDock}%</td>`,
      `  <td scope='col'>${avgTelopPiece}</td>`,
      `  <td scope='col'>${avgTeleopCones}</td>`,
      `  <td scope='col'>${avgTeleopCubes}</td>`,
      `  <td scope='col'>${avgTeleopEngage}%</td>`,
      `  <td scope='col'>${avgTeleopDock}%</td>`,
      `</tr>`
    ].join('');
    $(`#data${elementSuffix}`).html(rows);
  }
}

function createTeamDataSummary(alliance, index, teamNumber){
  var elementSuffix = `${alliance}${index}`;
  $(`#teamHeading${elementSuffix}`).html(teamNumber);

  // Load pics.
  $(`#pic${elementSuffix}`).html('');   
  $.get('readAPI.php', {
   'getTeamPictureFilenames': teamNumber
  }).done(function(data) { 
    var pics = JSON.parse(data); 
    if (pics.length > 0){
        $(`#pic${elementSuffix}`).html(`<img src='${pics[0]}' class='d-block w-100'>`);
    }
  });

  $.get('readAPI.php', {
   'readAllTeamMatchData': teamNumber
  }).done(function(data) { 
    var data = JSON.parse(data); 
    augmentTeamDataSummary(data, elementSuffix);
    augmentTotalMatchSummary(data, alliance);
  });


}

function createDataSummaries(matchInfo){
  var redTeams = matchInfo['alliances']['red']['team_keys'];
  var blueTeams = matchInfo['alliances']['blue']['team_keys'];
  for(var i = 0; i != redTeams.length; i++){
    createTeamDataSummary('Red', i+1, strTeamToIntTeam(redTeams[i]));
  }
  for(var i = 0; i != blueTeams.length; i++){
    createTeamDataSummary('Blue', i+1, strTeamToIntTeam(blueTeams[i]));
  }
}

function strTeamToIntTeam(team) {
  return parseInt(team.replace(/^(frc)/, ''));
}

function getTimeStringFromNumber(timeNumber){
  var date = new Date(timeNumber * 1000);
  var hours = date.getHours();
  var suff = "AM";
  if (hours > 12) {
    hours = hours - 12;
    suff = "PM"
  }
  var minutes = "0" + date.getMinutes();
  return hours + ":" + minutes.substr(-2) + " " + suff;
}

function updateTime(matchData){
  if (matchData['predicted_time'] != null){
    $('#timeBanner').html(`Predicted Time: ${getTimeStringFromNumber(matchData['predicted_time'])}`);
  }
  else if (matchData['actual_time'] != null){
    $('#timeBanner').html(`Actual Time: ${getTimeStringFromNumber(matchData['actual_time'])}`);
  }
  else {
    $('#timeBanner').html(`Time: Unknown`);
  } 
}


function loadData(compLevel, matchNumber){
  console.log(compLevel);
  console.log(matchNumber);
  clearData();

  $('#matchBanner').html(`Match: ${compLevel}${matchNumber}`);

  $.get('tbaAPI.php', {
   'getMatchData': 1,
   'number' : matchNumber,
   'level' : compLevel
  }).done(function(data) { 
    var match = JSON.parse(data);
    updateTime(match);
    createDataSummaries(match);
  });
}

function loadUserTeamList(){
  $.get('tbaAPI.php', {
   'getUserMatches': 1
  }).done(function(data) {
   matches = JSON.parse(data);
   var rows = [];
   for(const match of matches){
    var level = match[0];
    var num = match[1];
    rows.push(`<a href='./matchStrategy.php?level=${level}&match=${num}'><span class="badge text-bg-primary" style="margin-right:5px; margin-bottom:5px;" >${level}${num}</span></a>`)
   }
   $('#ourMatches').html(rows.join(''));
  });
}

$(document).ready(function() {
  loadUserTeamList();
  const url = new URLSearchParams(window.location.search);
  if (url.has('level') && url.has('match')){
    loadData(url.get('level'), url.get('match'));
  }
});

$('#loadMatch').on('click', function(){
    var matchNumber = $("#writeMatchNumber").val();
    var compLevel = $("#writeCompLevel").val();
    loadData(compLevel, matchNumber);
});

</script>

</html>