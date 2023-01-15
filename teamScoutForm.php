<html>
<?php 
	include("navBar.php");
	include("team.php");
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
				<h2><b><u>Team Info:</u></b></h2>
			</a>

			<?php
				if (!empty($_GET)) {
					$tNumber = $_GET["teamNumberG"];

					$team = new Team();
					$team->set_teamNumber($tNumber);
					$returnCode = $team->readTeamData($tNumber);
					$teamNumber = $tNumber;
					if ($returnCode > 0) {
						$teamNumber = $team->get_teamNumber();
						$teamName = $team->get_teamName();
						$teamCountry = $team->get_teamCountry();
						$teamState = $team->get_teamState();
						$teamCity = $team->get_teamCity();
					}
				}

				if (!empty($_POST)) {

					$team = new Team();
					$team->set_teamNumber($_POST["teamNumberP"]);
					$team->set_teamName($_POST["teamName"]);
					$team->set_teamCountry($_POST["teamCountry"]);
					$team->set_teamState($_POST["teamState"]);
					$team->set_teamCity($_POST["teamCity"]);
					$team->writeTeamData();
				}
			?>

			<form action="" method="get">
			Enter Team Number: <input class="control-label" type="number" name="teamNumberG" id="teamNumberG" size="10" height="10" width="40">
				<button id="submit" class="btn btn-primary" onclick="">Display</button>
			</form>

			<form action="" method="post" id='myForm'>
				<div class="form-group">
					<b><text class="col-lg-2 control-label">Team Number: </text></b>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="teamNumberP" name="teamNumberP" value="<?=$teamNumber?>" placeholder=" ">
					</div>
				</div>

				<div class="col-lg-2">
					<b><br>Team Name: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamName" name="teamName" value="<?=$teamName?>" placeholder=" ">
				</div>

				<div class="col-lg-2">
					<b><br>Team Country: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamCountry" name="teamCountry" value="<?=$teamCountry?>" placeholder=" ">
				</div>

				<div class="col-lg-2">
					<b><br>Team State: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamState" name="teamState" value="<?=$teamState?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-2">
					<b><br>Team City: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamCity" name="teamCity" value="<?=$teamCity?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-12 col-sm-12 col-xs-12">
					<input id="TeamScouting" type="submit" class="btn btn-primary" value="Submit" onclick="submitForm()">
			</form>
		</div>
		<br>
	</div>
	</div>

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

	<?php include("footer.php"); ?>

</html>