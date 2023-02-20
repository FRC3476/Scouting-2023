<html>
<?php include("navBar.php"); ?>

<head>

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet">
	<script src="jquery-1.11.2.min.js"></script>
	<script src="sorttable.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body class="bg-body">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
			<div class="row pt-3 pb-3 mb-3">


				<div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
					<div class="card">
						<div class="card-header">Pit Check</div>
						<div class="card-body">
							<a href='pictureUpload.php'>
								<button class="btn btn-primary">
									Picture Upload
								</button>
							</a>
							<a href='pitInput.php'>
								<button class="btn btn-primary">
									Pit Input
								</button>
							</a>

							<table class="sortable table table-hover" id="RawData">
								<tr>
									<th>Team Number</th>
									<th>Pit Scouted?</th>
									<th>Picture Taken?</th>
								</tr>
								<tr id="template" hidden>
									<td id="number" class="team"></td>
									<td id="Scouted"></td>
									<td id="Picture"></td>
								</tr>

						</div>
					</div>
					<div id="script"></div>
</body>
<script>
	var tba = false;
	var scoutData = false;

	//get team list from TBA
	var tbaTeams;
	fetch('http://localhost/tbaAPI.php?getTeamList=1')
		.then(response => response.json())
		.then((teams) => {
			teams.sort(function(a, b) { return a - b; });
			tbaTeams = teams;
			tba = true;
		});

		//get pit scout data
		var pitTeams;
		fetch('./readAPI.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'readAllPitScoutData'
            }).then(response => response.json())
            .then((teams) => {
				pitTeams = teams;
				scoutData = true;
			});

			var loop = setInterval(() => {
				if (tba && scoutData) {
					clearInterval(loop);
					buildHTML();
				}
			}, 500)

			function getScouted(id) {
				for (var i in pitTeams) {
					if (pitTeams[i].pitTeamNumber == id) {
						return "Yes";
					}
				}
				return "No";
			}

		function buildHTML() {
			var temp = document.getElementById("template").innerHTML;
			for (var i in tbaTeams) {
				var row = document.createElement("tr");
				row.innerHTML = temp;
				row.getElementsByTagName("td")[0].innerText = tbaTeams[i];
				row.getElementsByTagName("td")[1].innerText = getScouted(tbaTeams[i]);
				row.getElementsByTagName("td")[2].innerText = "???";
				document.getElementById("RawData").appendChild(row);
			}
		}
</script>

<?php include("footer.php") ?>