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
                    <option value="qf">QF</option>
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
      <div class="row pt-3 pb-3 mb-3">

        <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-danger">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingRed1">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picRed1Accordian" aria-expanded="true" aria-controls="picRed1Accordian">
                    <div id='teamHeadingRed1'>Team</div>
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
                    <th scope="col">Max Telop Cones</th>
                    <th scope="col">Max Telop Cubes</th>
                    <th scope="col">Telop Engage OR Dock</th>
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
                    <div id='teamHeadingRed2'>Team</div>
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
                    <th scope="col">Max Telop Cones</th>
                    <th scope="col">Max Telop Cubes</th>
                    <th scope="col">Telop Engage OR Dock</th>
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
                    <div id='teamHeadingRed3'>Team</div>
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
                    <th scope="col">Max Telop Cones</th>
                    <th scope="col">Max Telop Cubes</th>
                    <th scope="col">Telop Engage OR Dock</th>
                  </thead>
                  <tbody id='dataRed3'></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row pt-3 pb-3 mb-3 justify-content-md-center">

      <div class="col-lg-4 col-sm-12 col-xs-12 gx-3">
          <div class="card text-bg-primary">
            <div class="card-body">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingBlue1">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#picBlue1Accordian" aria-expanded="true" aria-controls="picBlue1Accordian">
                    <div id='teamHeadingBlue1'>Team</div>
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
                    <th scope="col">Max Telop Cones</th>
                    <th scope="col">Max Telop Cubes</th>
                    <th scope="col">Telop Engage OR Dock</th>
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
                    <div id='teamHeadingBlue2'>Team</div>
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
                    <th scope="col">Max Telop Cones</th>
                    <th scope="col">Max Telop Cubes</th>
                    <th scope="col">Telop Engage OR Dock</th>
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
                    <div id='teamHeadingBlue3'>Team</div>
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
                    <th scope="col">Max Telop Cones</th>
                    <th scope="col">Max Telop Cubes</th>
                    <th scope="col">Telop Engage OR Dock</th>
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
<script type="text/javascript" src="js/matchDataProcessor.js"></script>

<script>

var validBlueTeams = 0;
var validRedTeams = 0

var avgBluePoints = 0;
var avgRedPoints = 0;

var avgBlueGamePieces = 0;
var avgRedGamePieces = 0;


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
  updateSummaryTable();
}

function augmentTotalMatchSummary(data, alliance){

  var avgPieces = 0;
  var avgPoints = 0;
  var matchCount = 0;

  for (var i = 0; i != data.length; i++){
    matchCount++;
    avgPieces += getMatchGamePiece(data[i]);
    avgPoints += getMatchPoints(data[i]);
  }

  if (matchCount == 0){
    return;
  }
  
  avgPieces = roundInt(avgPieces/matchCount);
  avgPoints = roundInt(avgPoints/matchCount);

  if (alliance == 'Red'){
    validRedTeams++;
    avgRedPoints += avgPoints;
    avgRedGamePieces += avgPieces;
  }
  else {
    validBlueTeams++;
    avgBluePoints += avgPoints;
    avgBlueGamePieces += avgPieces;
  }
  updateSummaryTable();
}

function updateSummaryTable(){
  var row = [
    `<tr>`,
    `  <th scope='col'>Avg Points</th>`,
    `  <td scope='col' class="table-danger">${avgRedPoints}</td>`,
    `  <td scope='col' class="table-primary">${avgBluePoints}</td>`,
    `</tr>`,
    `<tr>`,
    `  <th scope='col'>Avg Pieces</th>`,
    `  <td scope='col' class="table-danger">${avgRedGamePieces}</td>`,
    `  <td scope='col' class="table-primary">${avgBlueGamePieces}</td>`,
    `</tr>`,
  ].join('');
  $('#summaryTable').html(row);
}

function augmentTeamDataSummary(data, elementSuffix){
  var matchCount = 0;
  var avgAutoPiece = 0;
  var avgAutoEngageOrDock = 0;
  var avgTelopPiece = 0;
  var maxTeleopCones = 0;
  var maxTeleopCubes = 0;
  var avgTeleopEngageOrDock = 0;
  for (var i = 0; i != data.length; i++){
    var match = data[i];
    matchCount++;
    avgAutoPiece += getPiecesAuto(match);
    avgAutoEngageOrDock += getDockAuto(match) || getEngageAuto(match) ? 1 : 0;
    avgTelopPiece += getPiecesTeleop(match);
    maxTeleopCones = Math.max(maxTeleopCones, getConesTeleop(match));
    maxTeleopCubes = Math.max(maxTeleopCubes, getCubesTeleop(match));
    avgTeleopEngageOrDock += getDockTeleop(match) || getEngageTeleop(match) ? 1 : 0;
  }

  if (matchCount > 0){
    avgAutoPiece = roundInt(avgAutoPiece / matchCount);
    avgAutoEngageOrDock = 100 * roundInt(avgAutoEngageOrDock / matchCount);
    avgTelopPiece = roundInt(avgTelopPiece / matchCount);
    avgTeleopEngageOrDock = 100 * roundInt(avgTeleopEngageOrDock / matchCount);

    var rows = [
      `<tr>`,
      `  <td scope='col'>${avgAutoPiece}</td>`,
      `  <td scope='col'>${avgAutoEngageOrDock}%</td>`,
      `  <td scope='col'>${avgTelopPiece}</td>`,
      `  <td scope='col'>${maxTeleopCones}</td>`,
      `  <td scope='col'>${maxTeleopCubes}</td>`,
      `  <td scope='col'>${avgTeleopEngageOrDock}%</td>`,
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