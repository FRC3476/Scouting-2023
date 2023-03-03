<title>Rankings</title>
<html lang="en">

<?php include('navbar.php');?>


<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">

        <div class='overflow-auto'>
          <table id='fullDataTable' class='table sortable'>
            <thead>
              <tr>
                <th col='scope'>Team</th>
                <th col='scope'>Avg Points</th>
                <th col='scope'>Max Points</th>
                <th col='scope'>Avg Auto Pieces</th>
                <th col='scope'>Max Auto Pieces</th>
                <th col='scope'>Can Auto Dock/Engage</th>
                <th col='scope'>Avg Teleop Pieces</th>
                <th col='scope'>Max Teleop Cones</th>
                <th col='scope'>Max Teleop Cubes</th>
              </tr>
            </thead>
            <tbody id="dataTable">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include("footer.php"); ?>
<script type="text/javascript" src="js/matchDataProcessor.js"></script>

<script>

  var dataLookUp = [];

  function safeLookup(key, obj){
    if (key in obj){
      return obj[key];
    }
    return 0;
  }

  function reDrawTable(){
    $('#dataTable').html('');
    for (var i = 0; i != dataLookUp.length; i++){
      var teamData = dataLookUp[i];
      var rows = [
        `<tr>`,
        `  <td scope='row'><a href='./teamData.php?team=${safeLookup('team', teamData)}'>${safeLookup('team', teamData)}</a></td>`,
        `  <td scope='row'>${safeLookup('avgPoints', teamData)}</td>`,
        `  <td scope='row'>${safeLookup('maxPoints', teamData)}</td>`,
        `  <td scope='row'>${safeLookup('avgAutoPieces', teamData)}</td>`,
        `  <td scope='row'>${safeLookup('maxAutoPieces', teamData)}</td>`,
        `  <td scope='row'>${safeLookup('canAutoEngageDock', teamData)}</td>`,
        `  <td scope='row'>${safeLookup('avgTeleopPieces', teamData)}</td>`,
        `  <td scope='row'>${safeLookup('maxTeleopCones', teamData)}</td>`,
        `  <td scope='row'>${safeLookup('maxTeleopCubes', teamData)}</td>`,
        `</tr>`
      ].join('');
      $('#dataTable').append(rows);
    }

    var fullTable = document.getElementById('fullDataTable');
    sorttable.makeSortable(fullTable);
  }

  function matchDataToDataLookup(data){
    var teamToDataList = {};
    for (var i = 0; i != data.length; i++){
      var match = data[i];
      if (!(match['teamNumber'] in teamToDataList)){
        teamToDataList[match['teamNumber']] = [];
      }
      teamToDataList[match['teamNumber']].push(match);
    }

    // Process data for each team.
    for (let team in teamToDataList){
      var matchCount = 0;
      var totalPoints = 0;
      var maxPoints = 0;
      var totalAutoPieces = 0;
      var maxAutoPieces = 0;
      var canAutoEngageDock = 'No'
      var totalTeleopPiece = 0;
      var maxTeleopCones = 0;
      var maxTeleopCubes = 0;
      for (var i = 0; i != teamToDataList[team].length; i++){
        var match = teamToDataList[team][i];
        matchCount++;
        totalPoints += getMatchPoints(match);
        maxPoints = Math.max(maxPoints, getMatchPoints(match));
        totalAutoPieces += getPiecesAuto(match);
        maxAutoPieces = Math.max(maxAutoPieces, getPiecesAuto(match));
        canAutoEngageDock = getDockAuto(match) || getEngageAuto(match) ? 'Yes' : canAutoEngageDock;
        totalTeleopPiece += getPiecesTeleop(match);
        maxTeleopCones = Math.max(maxTeleopCones, getConesTeleop(match));
        maxTeleopCubes = Math.max(maxTeleopCubes, getCubesTeleop(match));
      }

      // Add to dataLookUp.
      var lookup = {};
      lookup['team'] = team;
      lookup['avgPoints'] = roundInt(totalPoints / matchCount);
      lookup['maxPoints'] = roundInt(maxPoints);
      lookup['avgAutoPieces'] = roundInt(totalAutoPieces / matchCount);
      lookup['maxAutoPieces'] = roundInt(maxAutoPieces);
      lookup['canAutoEngageDock'] = canAutoEngageDock;
      lookup['avgTeleopPieces'] = roundInt(totalTeleopPiece / matchCount);
      lookup['maxTeleopCones'] = roundInt(maxTeleopCones);
      lookup['maxTeleopCubes'] = roundInt(maxTeleopCubes);

      dataLookUp.push(lookup);
    }
  }

  function loadMatchData(){
    $.get('readAPI.php', {
      'readAllMatchData': 1
    }).done(function(data) { 
      var data = JSON.parse(data); 
      matchDataToDataLookup(data);
      reDrawTable();
    });
  }

  $(document).ready(function () {
    loadMatchData();
  });

</script>
</html>