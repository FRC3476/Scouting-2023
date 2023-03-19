<title>Rankings</title>
<html lang="en">

<?php include('navbar.php'); ?>


<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3">
        <div class="float-right">
          <button type="button" id="downloadTable" class="btn btn-primary">Download Table As CSV</button>
        </div>
      </div>

      <div class="row pt-3 pb-3 mb-3">
        <div class='overflow-auto'>
          <table id='fullDataTable' class='table sortable'>
            <thead style="position: sticky;top: 0">
              <tr>
                <th col='scope'>Rank</th>
                <th col='scope'>Team</th>
                <th col='scope'>Avg Points</th>
                <th col='scope'>Max Points</th>
                <th col='scope'>Avg Auto Pieces</th>
                <th col='scope'>Max Auto Pieces</th>
                <th col='scope'>Auto Dock %</th>
                <th col='scope'>Auto Engage %</th>
                <th col='scope'>Avg Teleop Pieces</th>
                <th col='scope'>Max Teleop Pieces</th>
                <th col='scope'>Max Teleop Cones</th>
                <th col='scope'>Max Teleop Cubes</th>
                <th col='scope'>Teleop Park %</th>
                <th col='scope'>Teleop Dock %</th>
                <th col='scope'>Teleop Engage %</th>
                <th col='scope'>Organization Level</th>
                <th col='scope'># Batteries</th>
                <th col='scope'># Chargers</th>
                <th col='scope'>Language</th>
                <th col='scope'>Auto Path</th>
                <th col='scope'>Frame Dimensions</th>
                <th col='scope'>Comments</th>
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
<script type="text/javascript" src="js/matchDataProcessor.js?v=0"></script>

<script>
  var matchDataLookUp = {};
  var pitDataLookUp = {};

  function safeDataLookup(key, obj) {
    if (key in obj) {
      return obj[key];
    }
    return {};
  }

  function safeLookup(key, obj) {
    if (key in obj) {
      return obj[key];
    }
    return 0;
  }

  function getTeamList() {
    var matchTeamSet = new Set(Object.keys(matchDataLookUp));
    var pitTeamSet = new Set(Object.keys(pitDataLookUp));
    return Array.from(new Set([...matchTeamSet, ...pitTeamSet]));
  }

  function reDrawTable() {
    $('#dataTable').html('');
    var teams = getTeamList()
    for (var i = 0; i != teams.length; i++) {
      var team = teams[i];
      var matchData = safeDataLookup(team, matchDataLookUp);
      var pitData = safeDataLookup(team, pitDataLookUp);
      var rows = [
        `<tr>`,
        `  <td scope='row'>${i + 1}</td>`,
        `  <td scope='row' sorttable_customkey='${team}'><a href='./teamData.php?team=${team}'>${team}</a></td>`,
        `  <td scope='row'>${safeLookup('avgPoints', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('maxPoints', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('avgAutoPieces', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('maxAutoPieces', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('avgAutoDock', matchData)}%</td>`,
        `  <td scope='row'>${safeLookup('avgAutoEngage', matchData)}%</td>`,
        `  <td scope='row'>${safeLookup('avgTeleopPieces', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('maxTeleopPieces', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('maxTeleopCones', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('maxTeleopCubes', matchData)}</td>`,
        `  <td scope='row'>${safeLookup('avgTeleopPark', matchData)}%</td>`,
        `  <td scope='row'>${safeLookup('avgTeleopDock', matchData)}%</td>`,
        `  <td scope='row'>${safeLookup('avgTeleopEngage', matchData)}%</td>`,
        `  <td scope='row'>${safeLookup('disorganized', pitData)}</td>`,
        `  <td scope='row'>${safeLookup('numBatteries', pitData)}</td>`,
        `  <td scope='row'>${safeLookup('chargedBatteries', pitData)}</td>`,
        `  <td scope='row'>${safeLookup('codeLanguage', pitData)}</td>`,
        `  <td scope='row'>${safeLookup('autoPath', pitData)}</td>`,
        `  <td scope='row'>${safeLookup('framePerimeterDimensions', pitData)}</td>`,
        `  <td scope='row'>${safeLookup('pitComments', pitData)}</td>`,
        `</tr>`
      ].join('');
      $('#dataTable').append(rows);
    }

    var fullTable = document.getElementById('fullDataTable');
    sorttable.makeSortable(fullTable);
  }

  function pitDataToPitDataLookUp(data) {
    for (var i = 0; i != data.length; i++) {
      var pit = data[i];
      var team = pit['pitTeamNumber'];
      pitDataLookUp[team] = pit;
    }
  }

  function matchDataTomatchDataLookUp(data) {
    var teamToDataList = {};
    for (var i = 0; i != data.length; i++) {
      var match = data[i];
      if (!(match['teamNumber'] in teamToDataList)) {
        teamToDataList[match['teamNumber']] = [];
      }
      teamToDataList[match['teamNumber']].push(match);
    }

    // Process data for each team.
    for (let team in teamToDataList) {
      var matchCount = 0;
      var totalPoints = 0;
      var maxPoints = 0;
      var totalAutoPieces = 0;
      var maxAutoPieces = 0;
      var totalAutoDock = 0;
      var totalAutoEngage = 0;
      var totalTeleopPiece = 0;
      var maxTeleopCones = 0;
      var maxTeleopCubes = 0;
      var maxTeleopPieces = 0;
      var avgTeleopPark = 0;
      var avgTeleopDock = 0;
      var avgTeleopEngage = 0;
      for (var i = 0; i != teamToDataList[team].length; i++) {
        var match = teamToDataList[team][i];
        matchCount++;
        totalPoints += getMatchPoints(match);
        maxPoints = Math.max(maxPoints, getMatchPoints(match));
        totalAutoPieces += getPiecesAuto(match);
        maxAutoPieces = Math.max(maxAutoPieces, getPiecesAuto(match));
        totalAutoDock += getDockAuto(match) ? 1 : 0;
        totalAutoEngage += getEngageAuto(match) ? 1 : 0;
        totalTeleopPiece += getPiecesTeleop(match);
        maxTeleopCones = Math.max(maxTeleopCones, getConesTeleop(match));
        maxTeleopCubes = Math.max(maxTeleopCubes, getCubesTeleop(match));
        maxTeleopPieces = Math.max(maxTeleopPieces, getPiecesTeleop(match));
        avgTeleopPark += getParkTeleop(match) ? 1 : 0;
        avgTeleopDock += getDockTeleop(match) ? 1 : 0;
        avgTeleopEngage += getEngageTeleop(match) ? 1 : 0;
      }

      // Add to matchDataLookUp.
      var lookup = {};
      lookup['avgPoints'] = roundInt(totalPoints / matchCount);
      lookup['maxPoints'] = roundInt(maxPoints);
      lookup['avgAutoPieces'] = roundInt(totalAutoPieces / matchCount);
      lookup['maxAutoPieces'] = roundInt(maxAutoPieces);
      lookup['avgAutoDock'] = roundInt((totalAutoDock / matchCount) * 100);
      lookup['avgAutoEngage'] = roundInt((totalAutoEngage / matchCount) * 100);
      lookup['avgTeleopPieces'] = roundInt(totalTeleopPiece / matchCount);
      lookup['maxTeleopPieces'] = maxTeleopPieces;
      lookup['maxTeleopCones'] = roundInt(maxTeleopCones);
      lookup['maxTeleopCubes'] = roundInt(maxTeleopCubes);
      lookup['avgTeleopPark'] = roundInt((avgTeleopPark / matchCount) * 100);
      lookup['avgTeleopDock'] = roundInt((avgTeleopDock / matchCount) * 100);
      lookup['avgTeleopEngage'] = roundInt((avgTeleopEngage / matchCount) * 100);

      matchDataLookUp[team] = lookup;
    }
  }

  function loadMatchData() {
    $.get('readAPI.php', {
      'readAllMatchData': 1
    }).done(function(data) {
      var data = JSON.parse(data);
      matchDataTomatchDataLookUp(data);
      reDrawTable();
    });
  }

  function loadPitData() {
    $.get('readAPI.php', {
      'readAllPitScoutData': 1
    }).done(function(data) {
      var data = JSON.parse(data);
      pitDataToPitDataLookUp(data);
      reDrawTable();
    });
  }


  function getTableAsCSVString() {
    var table_array = [];
    var rows = document.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
      var cols = rows[i].querySelectorAll('td,th');
      var row_array = []
      for (var j = 0; j < cols.length; j++) {
        if (j == 0) { // Strip link from team number in col 1
          var team_link = cols[j].querySelectorAll('a');
          if (team_link.length == 0) {
            row_array.push(cols[j].innerHTML);
          } else {
            row_array.push(team_link[0].innerHTML);
          }
        } else {
          row_array.push(cols[j].innerHTML);
        }
      }
      table_array.push(row_array.join(','));
    }
    return table_array.join('\n');
  }

  function downloadTable() {
    CSVFile = new Blob([getTableAsCSVString()], {
      type: "text/csv"
    });
    var temp_link = document.createElement('a');
    temp_link.download = "rankings.csv";
    var url = window.URL.createObjectURL(CSVFile);
    temp_link.href = url;
    temp_link.style.display = "none";
    document.body.appendChild(temp_link);
    temp_link.click();
    document.body.removeChild(temp_link);
  }

  $('#downloadTable').on('click', function() {
    downloadTable();
  });

  $(document).ready(function() {
    loadMatchData();
    loadPitData();
  });
</script>

</html>