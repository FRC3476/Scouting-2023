<html>
<?php 
	include("navBar.php");
	if ($matchResults_included == "") {
    	include("matchResult.php");
	}
	if ($matchResultBAHandler_included == "") {
		include("matchResultBAHandler.php");
	}
	// if ($matchResultSCHandler_included == "") {
	// 	include("matchResultSCHandler.php");
	// }
?>

<head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet">
	<script src="jquery-1.11.2.min.js"></script>
	<script src="sorttable.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<style>
		#overallForm {
			font-size: 15px;
			display: inline-block;
		}
	</style>

	<script>
		function repost(){
			
		}
		
		function alertSuccess(){
			alert("Submission Success!");
		}
		
		function alertFailure(){
			alert("Submission Failure!");
		}
	</script>

	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
			<a>
				<h2><b><u>API Refresh:</u></b></h2>
			</a>

			<form action="" method="post" id='myTournamentBAForm'>
				<div class="form-group">
					<b><text class="col-lg-2 control-label">Tournament Name: </text></b>
					<div class="col-lg-10">
						<input class="control-label" type="text" id="tournamentNameG" name="tournamentNameG" size="10" height="10" width="40">
					</div>
					<!-- This calls the Blue Alliance API to refresh match results for all matches for that tournment -->
					<!--<button id="refreshTournamentBA" class="btn btn-primary" onclick="baRefreshTournamentBA();">Refresh from Blue Alliance</button>-->
				</div>
				<button id="refreshTournamentBA" value="refreshTournamentBA" class="btn btn-primary" onclick="">Refresh from Blue Alliance</button>
			</form>

			<form action="" method="post" id='myTournamentNMatchBAForm'>
				<div class="form-group">

					<b><text class="col-lg-2 control-label">Tournament Name: </text></b>
					<div class="col-lg-10">
						<input class="control-label" type="text" id="tournamentNameG" name="tournamentNameG" size="10" height="10" width="40">
					</div>

					<b><text class="col-lg-2 control-label">Match Type: </text></b>
					<div class="col-lg-10">
						<input class="control-label" type="text" id="matchTypeG" name="matchTypeG" size="10" height="10" width="40">
					</div>

                    <b><text class="col-lg-2 control-label">Match Number: </text></b>
                    <div class="col-lg-10">
						<input class="form-control" type="text" id="matchNumberG" name="matchNumberG" size="10" height="10" width="40">
					</div>
				</div>
				<button id="refreshTournamentNMatchBA" value="refreshTournamentNMatchBA" class="btn btn-primary" onclick="">Refresh from Blue Alliance</button>
			</form>

			<form action="" method="" id='myTournamentNMatchSCForm'>
				<div class="form-group">

					<b><text class="col-lg-2 control-label">Tournament Name: </text></b>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="tournamentNameG" name="tournamentNameG" placeholder=" ">
					</div>

                    <b><text class="col-lg-2 control-label">Match Type: </text></b>
                    <div class="col-lg-10">
						<input type="text" class="form-control" id="matchTypeG" name="matchTypeG" placeholder=" ">
					</div>

                    <b><text class="col-lg-2 control-label">Match Number: </text></b>
                    <div class="col-lg-10">
						<input type="text" class="form-control" id="matchNumberG" name="matchNumberG" placeholder=" ">
					</div>
				</div>
				<button id="refreshTournamentNMatchSC" value="refreshTournamentNMatchSC" class="btn btn-primary" onclick="">Refresh from Scouting</buttom>
			</form>
		</div>
	</div>

	<script>
		function refreshResults(){
			type = "";
			number = "";
			var nums = {
				'tournamentNameG': document.getElementById('tournamentNameG').value,
		 		'matchTypeG': document.getElementById('matchTypeG').value,
		 		'matchNumberG': document.getElementById('matchNumberG').value
			};

			console.log(JSON.stringify(nums));

			if (document.getElementById('tournamentNameG').value == "refreshTournamentBA" || 
				document.getElementById('tournamentNameG').value == "refreshTournamentNMatchBA") {
				$.post("matchResultBAHandler.php", nums).done(function(data) {}).done(function() {
					location.reload(true);
					alert("Submission Succeeded!");
				}).fail(function() {
					alert("Submission Failed!");
				});
			} else {
				$.post("matchResultSCHandler.php", nums).done(function(data) {}).done(function() {
					location.reload(true);
					alert("Submission Succeeded!");
				}).fail(function() {
					alert("Submission Failed!");
				});				
			}
		}
	</script>

	<style>
		/* The container */
		.container2 {
			display: inline-block;
			position: relative;
			cursor: pointer;
			font-size: 22px;
			bottom: 10px;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		/* Hide the browser's default checkbox */
		.container2 input {
			position: absolute;
			opacity: 0;
			cursor: pointer;
			height: 0;
			width: 0;
			margin-left: 100%;

		}

		/* Create a custom checkbox */
		.checkmark {
			position: absolute;
			top: 0;
			left: 0;
			height: 25px;
			width: 25px;
			background-color: #eee;
			border-radius: 5px;
		}

		.container:hover input~.checkmark {
			background-color: orange;
		}

		.container2 input:checked~.checkmark {
			background-color: rgb(15, 129, 120);
		}

		/* Create the checkmark/indicator (hidden when not checked) */
		.checkmark:after {
			content: "";
			position: absolute;
			display: none;
		}

		/* Show the checkmark when checked */
		.container2 input:checked~.checkmark:after {
			display: block;
		}

		/* Style the checkmark/indicator */
		.container2 .checkmark:after {
			left: 9px;
			top: 5px;
			width: 5px;
			height: 10px;
			border: solid white;
			border-width: 0 3px 3px 0;
			-webkit-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			transform: rotate(45deg);
		}
	</style>

</body>

<?php include ("footer.php") ?>

</html>