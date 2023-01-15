<html>
<?php 
	include("navBar.php");
	include("robot.php");
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
				<h2><b><u>Pit Scouting:</u></b></h2>
			</a>

			<a href='pitCheck.php'>
        		<button class="btn btn-primary">
            		Pit Check
        		</button>
    		</a>
			<a href='pictureUpload.php'>
        		<button class="btn btn-primary">
            		Picture Upload
        		</button>
    		</a>

			<?php
				if (!empty($_GET)) {
					$tNumber = $_GET["teamNumberG"];

					$robot = new Robot();
					$robot->set_teamNumber($tNumber);
					$returnCode = $robot->readRobotData($tNumber);
					$teamNumber = $tNumber;
					if ($returnCode > 0) {
						$teamNumber = $robot->get_teamNumber();
						$teamName = $robot->get_teamName();
						$numBatteries = $robot->get_numBatteries();
						$chargedBatteries = $robot->get_chargedBatteries();
						$codeLanguage = $robot->get_codeLanguage();
						$climbLevel = $robot->get_climbLevel();
						$falconLoctite = $robot->get_falconLoctite();
						$autoPath = $robot->get_autoPath();
						$comments = $robot->get_comments();
					}
				}

				if (!empty($_POST)) {

					$robot = new Robot();
					$robot->set_teamNumber($_POST["teamNumberP"]);
					$robot->set_teamName($_POST["teamName"]);
					$robot->set_numBatteries($_POST["numBatteries"]);
					$robot->set_chargedBatteries($_POST["chargedBatteries"]);
					$robot->set_codeLanguage($_POST["codeLanguage"]);
					$robot->set_climbLevel($_POST["climbLevel"]);
					$robot->set_falconLoctite($_POST["falconLoctite"]);
					$robot->set_autoPath($_POST["autoPath"]);
					$robot->set_comments($_POST["comments"]);
					$robot->writeRobotData();
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

				<div class="form-group">
					<b><text class="col-lg-2 control-label">Team Name: </text></b>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="teamName" name="teamName" value="<?=$teamName?>" placeholder=" ">
					</div>
				</div>

				<div class="col-lg-2">
					<b><br>Total number of batteries: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="numBatteries" name="numBatteries" value="<?=$numBatteries?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-2">
					<b><br>Total number of charged batteries: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="chargedBatteries" name="chargedBatteries" value="<?=$chargedBatteries?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-2">
					<b><br>Code language: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="codeLanguage" name="codeLanguage" value="<?=$codeLanguage?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-2">
					<b><br>Climb level: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="climbLevel" name="climbLevel" value="<?=$climbLevel?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-2">
					<b><br>Falcon loctite: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="falconLoctite" name="falconLoctite" value="<?=$falconLoctite?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-2">
					<b><br>Auto path: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="autoPath" name="autoPath" value="<?=$autoPath?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-2">
					<b><br>Comments: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="comments" name="comments" value="<?=$comments?>" placeholder=" ">
					<br>
				</div>

				<div class="col-lg-12 col-sm-12 col-xs-12">
					<input id="RobotScouting" type="submit" class="btn btn-primary" value="Submit" onclick="submitForm()">
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