<title>Match Strategy</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3 justify-content-md-center">
      
        <div class="col-md-6 col-sm-12 col-xs-12 gx-3">
          <div class="card">
            <div class="card-body">

                <div id='ourMatches'></div>

                <h3 id='matchBanner'>Next Match:</h3>
                <h4 id='timeBanner'>Match Start Time:</h4>

            </div>
          </div>
        </div>

      </div>

      <div id="matchCards">
      </div>
    </div>
  </div>
</body>

<?php include("footer.php"); ?>

<script type="text/javascript" src="js/charts.js"></script>
<script type="text/javascript" src="js/matchDataProcessor.js?cache=6"></script>

<script>

var tbaData = 0;
var matchData = 0;
var teamCannedLookup = 0;

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

function createCannedBadge(comment, matchList, container){
  var matches = matchList.join(', ');
  var count = matchList.length;
  var rows = [
    `<button style="margin-right:10px; margin-bottom:10px;" type="button" class="btn btn-primary position-relative" data-bs-container="#${container}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${matches}">`,
    `  ${comment}`,
    `  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">`,
    `    ${count}`,
    `  </span>`,
    `</button>`
  ].join('');
  return rows;
}

function getTeamIssues(team, container){
  if (! (team in teamCannedLookup)){
    return '';
  }
  var out = '';
  var baseRobotIssues = ["Lots of Fouls", "Tipped", "Stuck on Charge Station", "Didn't Move", "Broken", "DNP", "Bumpers Fell Off", "Did Not Show Up"];
  var teamIssues = teamCannedLookup[team];
  for (const issue of baseRobotIssues){
    if (issue in teamIssues){
      out += createCannedBadge(issue, teamIssues[issue], container);
    }
  }
  return out;
}

function addMatchCard(matchNumber, matchTime, isRed, teamA, teamB, teamC) {
  var colorClass = 'primary';
  if (isRed){
    colorClass = 'danger';
  }
  var container = `${matchNumber}-group`;
  var lines = [
    `<div class='pt-3'>`,
    ` <div class='card text-bg-${colorClass}'>`,
    `   <div class='card-header'>`,
    `     Match ${matchNumber} - ${matchTime}`,
    `   </div>`,
    `   <ul class='list-group list-group-flush' id='${container}'>`,
    `     <li class='list-group-item list-group-item-${colorClass}'>${teamToLink(teamA)} ${getTeamIssues(teamA, container)}</li>`,
    `     <li class='list-group-item list-group-item-${colorClass}'>${teamToLink(teamB)} ${getTeamIssues(teamB, container)}</li>`,
    `     <li class='list-group-item list-group-item-${colorClass}'>${teamToLink(teamC)} ${getTeamIssues(teamC, container)}</li>`,
    `   </ul>`,
    ` </div>`,
    `</div>`
  ];
  $('#matchCards').append(lines.join(' '));
}

function teamToLink(team){
  return `<a class='' href='./teamData.php?team=${team}'>${team}</a>`;
}

function matchDataToTeamCannedLookup(){
  var teamToMatchData = {};
  for (var i = 0; i != matchData.length; i++){
    var team = matchData[i]['teamNumber'];
    if (! (team in teamToMatchData)){
      teamToMatchData[team] = [];
    }
    teamToMatchData[team].push(matchData[i]);
  }

  var lookup = {};
  for (var team in teamToMatchData){
    console.log(teamToMatchData[team]);
    lookup[team] = getCannedCommentsDictionary(teamToMatchData[team]);
  }

  return lookup;
}

function loadView(){
  if (tbaData == 0 || matchData == 0){
    return;
  }

  teamCannedLookup = matchDataToTeamCannedLookup();

  $('#matchBanner').html(`Next Match: ${tbaData['current_match']['match_number']}`);
  $('#timeBanner').html(`Match State Time: ${getTimeStringFromNumber(tbaData['current_match']['match_time'])}`);

  var futureTeamMatches = tbaData['future_team_matches'];

  for (var i = 0; i != futureTeamMatches.length; i++){
    var matchRow = futureTeamMatches[i];
    if (matchRow['actual_time'] == null){  // Only display future matches.
      addMatchCard(matchRow['match_number'],
                  getTimeStringFromNumber(matchRow['predicted_time']),
                  matchRow['is_red_alliance'],
                  matchRow['alliance'][0].substring(3),
                  matchRow['alliance'][1].substring(3),
                  matchRow['alliance'][2].substring(3),
      );
    }
    
  }

  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}

function loadTBAData(){
  $.get('tbaAPI.php', {
   'getUserMatchDicts': 1
  }).done(function(data) { 
    tbaData = JSON.parse(data);
    loadView();
  });
}

function loadMatchData(){
  $.get('readAPI.php', {
   'readAllMatchData': 1
  }).done(function(data) { 
    matchData = JSON.parse(data);
    loadView();
  });
}

$(document).ready(function() {
  loadMatchData();
  loadTBAData();
});


</script>

</html>