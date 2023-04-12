<html>
<?php include("navbar.php"); ?>
<body class="bg-body">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">

			<div class="row pt-3 pb-3 mb-3 justify-content-md-center">
        <div class="col-md-6 col-sm-12 col-xs-12 gx-3">
          <div class="card">
            <div class="card-body">
                <div class="input-group mb-3">
                  <input id="writeMatchNumber" type="text" class="form-control" placeholder="Match Number" aria-label="writeMatchNumber">
                  <button id="loadMatch" type="button" class="btn btn-primary">Load Match</button>
                </div>
                <h3 id='matchBanner'>Match:</h3>
            </div>
          </div>
        </div>
      </div>

			<div class="row pt-3 pb-3 mb-3 justify-content-md-center">

				<div class="col-6 gx-3">
					<div class="card">
            <div class="card-body">
							<h3>Team List</h3>
							<table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Color</th>
                    <th scope="col">Team #</th>
                  </tr>
                </thead>
                <tbody id="rawAllianceRows">
                </tbody>
              </table>
						</div>
					</div>
				</div>

				<div class="col-6 gx-3">
					<div class="card">
            <div class="card-body">
							<h3>Rank</h3>
							<table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Color</th>
                    <th scope="col">Team #</th>
                  </tr>
                </thead>
                <tbody id="sortedAllianceRank">
                </tbody>
              </table>
						</div>
					</div>
				</div>

			</div>

			<div class="row pt-78 pb-3 mb-3 justify-content-md-center">
      	<button id="submitData" type="button" class="btn btn-success">Submit Ranking</button>
    	</div>


		</div>
	</div>

	<?php include("footer.php"); ?>

	<script type="text/javascript" src="js/sortable.min.js"></script>

	<script>
		var icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-move" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z"/></svg>';
		var currentMatch = 0;

		function clearData(){
			$('#rawAllianceRows').html('');
			$('#sortedAllianceRank').html('');
			$('#matchBanner').html('Match:');
		}

		function stripTeamTags(teamList) {
			var out = []
			for (let i = 0; i != teamList.length; i++) {
				var team = teamList[i];
				team = team.toUpperCase();
				team = team.replace("FRC", "");
				out.push(parseInt(team, 10));
			}
			return out;
		}

		function addRawRow(color, team){
			var classItem = color == 'Red' ? 'table-danger' : 'table-info';
			var rows = [
				`<tr data-team='${team}' class='${classItem}'>`,
				`	<td scope='row' class='pickHandle'>${icon_svg}</td>`,
				`	<td scope='row'>${color}</td>`,
				`	<td scope='row'>${team}</td>`,
				`</tr>`
			].join('');
			$('#rawAllianceRows').append(rows);
		}

		function loadMatch(number){
			currentMatch = number;
			clearData();

			$.get("tbaAPI.php", {
				getTeamsInMatch: number
			}).done(function(data) {
				$('#matchBanner').html(`Match: ${number}`);
				data = JSON.parse(data);
				var redTeams = stripTeamTags(data['red']);
				var blueTeams = stripTeamTags(data['blue']);

				for (let i = 0; i != redTeams.length; i++){addRawRow('Red', redTeams[i]);}
				for (let i = 0; i != blueTeams.length; i++){addRawRow('Blue', blueTeams[i]);}
			});
		}

		function getSortedTeams() {
			var teamList = [];
			for (let tr of $("#sortedAllianceRank tr")) {
				teamList.push(Number($(tr).attr("data-team")));
			}
			return teamList;
		}

		function saveRanking(){
			$.get("writeAPI.php", {
				match: currentMatch,
				saveAllianceRank: JSON.stringify(getSortedTeams())
			}).done(function(data) {
				data = JSON.parse(data);
				console.log(data);
				if (data['success'] != true){
					alert('Data did not submit!');
				}
				else {
					alert("Data successfully submitted!");
					clearData();
				}
			});
		}

		$('#loadMatch').on('click', function(){
			loadMatch($('#writeMatchNumber').val());
		});

		$('#submitData').on('click', function(){
			saveRanking();
		});


		$(document).ready(function() {

			unsortedTable = new Sortable(document.getElementById('rawAllianceRows'), {
				group: 'shared',
				animation: 150,
				sort: true,
				delayOnTouchOnly: true,
				fallbackTolerance: 3,
				scroll: true,
				handle: '.pickHandle'
			});

			sortedTable = new Sortable(document.getElementById('sortedAllianceRank'), {
				group: 'shared',
				animation: 150,
				sort: true,
				delayOnTouchOnly: true,
				fallbackTolerance: 3,
				scroll: true,
				handle: '.pickHandle'
			});

		});

	</script>

</html>