<html>
<?php 
	include("navBar.php");
	include("teamRanker.php");
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
				<h2><b><u>Team Ranker:</u></b></h2>
			</a>

			<?php
				if (!empty($_POST)) {
					//Setting initial scores for team 1 if not already there
					$team1 = new teamRanker();
					$score1 = $team1->readteamRankerData($_POST["teamNumber1"]);
					if($score1 == 0){
						$team1->set_teamNumber($_POST["teamNumber1"]);
						$team1->set_score("1000");
						$team1->writeteamRankerData();
					}

					//Setting initial scores for team 2 if not already there
					$team2 = new teamRanker();
					$score2 = $team2->readteamRankerData($_POST["teamNumber2"]);
					if($score2 == 0){
						$team2->set_teamNumber($_POST["teamNumber2"]);
						$team2->set_score("1000");
						$team2->writeteamRankerData();
					}

					//Set Values
					$team1->readteamRankerData($_POST["teamNumber1"]);
					$team2->readteamRankerData($_POST["teamNumber2"]);
					$score1 = $team1->get_score();
					$score2 = $team2->get_score();
					$equal = $_POST["equal"];

					//Compare Current Score

					//Team 1 did better
					if ($equal == 0) {
				
						//Negative diff: Team 2 is better rn, Positive diff: Team 1 is better rn
						$dif = $score1 - $score2;
				
						if ($dif < -40) {
							$weight = 40;
						} else if ($dif < 0) {
							$weight = 30;
						} else if ($dif == 0) {
							$weight = 20;
						}
						if ($dif > 50) {
							$weight = 10;
						} else if ($dif > 20) {
							$weight = 20;
						} else if ($dif > 0) {
							$weight = 30;
						}
				
						if ($dif >= 0) {
							$expecScoreteam1 = ($weight * (1 - (1 / (1 + (10 ^ (($score1 - $score2) / 400))))));
							$expecScoreteam2 = ($weight * (1 - (1 / (1 + (10 ^ (($score2 - $score1) / 400))))));
							$team1New = $score1 + $expecScoreteam1;
							$team2New = $score2 - $expecScoreteam2;
						}else{
							$expecScoreteam1 = ($weight * (1 - (1 / (1 + (10 ^ (($score1 - $score2) / 400))))));
							$expecScoreteam2 = ($weight * (1 - (1 / (1 + (10 ^ (($score2 - $score1) / 400))))));
							$team1New = $score1 + $expecScoreteam1;
							$team2New = $score2 - $expecScoreteam2;
						}
				
						$team1->set_score($team1New);
						$team2->set_score($team2New);
						$team1->writeteamRankerData();
						$team2->writeteamRankerData();


					} else if ($equal == 1) {
				
						$dif = $score2 - $score1;
				
						if ($dif < -40) {
							$weight = 40;
						} else if ($dif < 0) {
							$weight = 30;
						} else if ($dif == 0) {
							$weight = 30;
						}
						if ($dif > 50) {
							$weight = 10;
						} else if ($dif > 0) {
							$weight = 20;
						}
				
						if ($dif >= 0) {
							$expecScoreteam1 = ($weight * (1 - (1 / (1 + (10 ^ (($score1 - $score2) / 400))))));
							$expecScoreteam2 = ($weight * (1 - (1 / (1 + (10 ^ (($score2 - $score1) / 400))))));
							$team1New = $score1 - $expecScoreteam1;
							$team2New = $score2 + $expecScoreteam2;
						}else{
							$expecScoreteam1 = ($weight * (1 - (1 / (1 + (10 ^ (($score1 - $score2) / 400))))));
							$expecScoreteam2 = ($weight * (1 - (1 / (1 + (10 ^ (($score2 - $score1) / 400))))));
							$team1New = $score1 - $expecScoreteam1;
							$team2New = $score2 + $expecScoreteam2;
						}
				
						$team1->set_score($team1New);
						$team2->set_score($team2New);
						$team1->writeteamRankerData();
						$team2->writeteamRankerData();

					} else if ($equal == 2) {
				
						$dif = $score1 - $score2;
				
						if ($dif < -40) {
							$weight = 15;
						} else if ($dif < 0) {
							$weight = 8;
						} else if ($dif == 0) {
							$weight = 5;
						}
						if ($dif > 40) {
							$weight = 15;
						} else if ($dif > 0) {
							$weight = 8;
						}
				
						if ($dif >= 0) {
							$expecScoreteam1 = ($weight * (1 - (1 / (1 + (10 ^ (($score1 - $score2) / 400))))));
							$expecScoreteam2 = ($weight * (1 - (1 / (1 + (10 ^ (($score2 - $score1) / 400))))));
							$team1New = $score1 - $expecScoreteam1;
							$team2New = $score2 + $expecScoreteam2;
						} else {
							$expecScoreteam1 = ($weight * (1 - (1 / (1 + (10 ^ (($score1 - $score2) / 400))))));
							$expecScoreteam2 = ($weight * (1 - (1 / (1 + (10 ^ (($score2 - $score1) / 400))))));
							$team1New = $score1 + $expecScoreteam1;
							$team2New = $score2 - $expecScoreteam2;
						}
						
						$team1->set_score($team1New);
						$team2->set_score($team2New);
						$team1->writeteamRankerData();
						$team2->writeteamRankerData();

					}
				}
			?>

			<form action="" method="post" id='myForm'>
				<div class="form-group">
					<b><text class="col-lg-2 control-label">Team 1: </text></b>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="teamNumber1" name="teamNumber1" placeholder=" ">
					</div>
				</div>

				<div class="col-lg-2">
					<b><br>Team 2: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamNumber2" name="teamNumber2"  placeholder=" ">
				</div>

				<div class="col-lg-2">
					<b><br>Compare: </b>
				</div>
				<div class="col-lg-10">
					<select id="equal" name="equal" class="form-control">
						<option value="" disabled selected>Select</option>
						<option value='0'>Team 1 is Better</option>
						<option value='1'>Team 2 is Better</option>
						<option value='2'>Equal</option>
					</select>
				</div>

				<div class="col-lg-12 col-sm-12 col-xs-12">
					<input id="submit" type="submit" class="btn btn-primary" value="Submit" onclick="submitForm()">
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