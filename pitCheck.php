<html>
<?php include("navbar.php"); ?>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.red {
			background-color: #ff6969;
		}

		.green {
			background-color: #92f763;
		}
	</style>

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
									<td id="number" class="team">
										<a href="">
										</a>
									</td>
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
	var picData = false;

	//get team list from TBA
	var tbaTeams;
	fetch('./tbaAPI.php?getTeamList=1')
		.then(response => response.json())
		.then((teams) => {
			teams.sort(function(a, b) {
				return a - b;
			});
			tbaTeams = teams;
			tba = true;
		});

	//get pit scout data
	var pitTeams;
	fetch('./readAPI.php?readAllPitScoutData=1')
		.then(response => response.json())
		.then((teams) => {
			pitTeams = teams;
			scoutData = true;
		});

	//get pit scout pictures
	var pictures;
	fetch('./readAPI.php?getAllPictureFilenames=1')
		.then(response => response.json())
		.then((pics) => {
			pictures = pics;
			picData = true;
		});

	var loop = setInterval(() => {
		if (tba && scoutData && picData) {
			clearInterval(loop);
			buildHTML();
		}
	}, 500)

	function isScouted(id) {
		for (var i in pitTeams) {
			if (pitTeams[i].pitTeamNumber == id) {
				return "Yes";
			}
		}
		return "No";
	}

	function tookPictures(id) {
		var list = [];
		for (var i in pictures) {
			list.push(pictures[i].split(".")[0]);
		}
		for (var i in list) {
			if (list[i] == id) return "Yes";
		}
		return "No";
	}

	function buildHTML() {
		var temp = document.getElementById("template").innerHTML;
		for (var i in tbaTeams) {
			var isRed = false;
			if (isScouted(tbaTeams[i]) == "No" || tookPictures(tbaTeams[i]) == "No") isRed = true;
			var row = document.createElement("tr");
			row.innerHTML = temp;
			row.getElementsByTagName("td")[0].getElementsByTagName("a")[0].innerText = tbaTeams[i];
			row.getElementsByTagName("td")[0].getElementsByTagName("a")[0].href = "/matchStrategy.php?team=" + tbaTeams[i];
			row.getElementsByTagName("td")[1].innerText = isScouted(tbaTeams[i]);
			row.getElementsByTagName("td")[2].innerText = tookPictures(tbaTeams[i]);
			if (isRed) row.className = "white";
			else row.className = "green";
			document.getElementById("RawData").appendChild(row);
		}
	}
</script>

<?php include("footer.php") ?>