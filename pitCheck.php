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
						</div>
					</div>
					<div id="script"></div>
</body>

<?php include("footer.php") ?>

<script>
	var tba = false;
	var scoutData = false;
	var picData = false;
	var tbaTeams;
	var pitTeams;
	var pictures;
	
	
	$(document).ready(function () {
		//get team list from TBA
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
		fetch('./readAPI.php?readAllPitScoutData=1')
			.then(response => response.json())
			.then((teams) => {
				pitTeams = teams;
				scoutData = true;
			});
			
		//get pit scout pictures
		fetch('./readAPI.php?getAllPictureFilenames=1')
			.then(response => response.json())
			.then((data) => {
				console.log(data);
				if (data.success) {
					pictures = data.files;
					picData = true;
				} else {
					alert(data.error);
				}
			});
	});

	//start loop which handles data after both fetch requests are completed
	var loop = setInterval(() => {
		if (tba && scoutData && picData) {
			clearInterval(loop);
			buildHTML();
		}
	}, 500)

	//function to check if a team has pit scout data
	function isScouted(id) {
		for (var i in pitTeams) {
			if (pitTeams[i].pitTeamNumber == id) {
				return true;
			}
		}
		return false;
	}

	//function to check if a team has had pit scout pictures taken
	function tookPictures(id) {
		var list = [];
		for (var i in pictures) {
			list.push(pictures[i].split("-")[0]);
		}
		for (var i in list) {
			if (list[i] == id) return true;
		}
		return false;
	}

	//build the html table to display data
	function buildHTML() {
		for (var i in tbaTeams) {
			addRow(tbaTeams[i]);

		}
	}

	function addRow(team){
		var pitString = 'Yes';
		var pitColor = 'text-bg-success';
		if (!isScouted(team)){
			pitString = 'No';
			pitColor = '';
		}

		var picString = 'Yes';
		var picColor = 'text-bg-success';
		if (!tookPictures(team)){
			picString = 'No';
			picColor = '';
		}

		var row = [
			`<tr>`,
			`	<th><a href='./teamData.php?team=${team}'>${team}</a></th>`,
			`	<td scope='row' class='${pitColor}'>${pitString}</td>`,
			`	<td scope='row' class='${picColor}'>${picString}</td>`,
			`</tr>`
		].join('');
		$('#RawData').append(row);
	}

</script>

