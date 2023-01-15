<html>
<?php 
	include("navBar.php");
	include("leadScout.php");
	include("MatchResultBA.php");
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
				<h2><b><u>Lead Scout:</u></b></h2>
			</a>

			<?php
				$BA = new MatchResultBA();
				$BA->readAllMatchResultBAData();
				$tName = $BA->get_tournamentName();
				if (!empty($_POST)) {
					//Setting initial scores for team 1 if not already there
					$leadScout = new LeadScout();
					$tour = $_POST["tournament"];
                    $a = $_POST["matchType"];
                    $b = $_POST["matchNumber"];
					$leadScout->set_matchNumber($tour . "_" . $a.$b);
					$leadScout->set_team1($_POST["teamNumber1"]);
                    $leadScout->set_team2($_POST["teamNumber2"]);
					$leadScout->set_team3($_POST["teamNumber3"]);
					$leadScout->set_team4($_POST["teamNumber4"]);
					$leadScout->set_team5($_POST["teamNumber5"]);
					$leadScout->set_team6($_POST["teamNumber6"]);
					$leadScout->writeLeadScoutData();
				}
			?>

			<form action="" method="post" id='myForm'>
				<div class="form-group">
					<b><text class="col-lg-2 control-label">Tournament: </text></b>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="tournament" name="tournament" value="<?=$tName?>">
					</div>
				</div>
                <div class="form-group">
					<b><text class="col-lg-2 control-label">Match Number: </text></b>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="matchNumber" name="matchNumber" placeholder=" ">
					</div>
				</div>

                <div class="form-group">
					<b><text class="col-lg-2 control-label">Match Type: </text></b>
					<div class="col-md-3">
					<select id="matchType" name="matchType" class="form-control" >
                        <option value ="qm" selected >Qual</option>
						<option value ="ef1m" >Elim 1</option>
						<option value='ef2m' >Elim 2</option>
                        <option value ="ef3m" >Elim 3</option>
						<option value='ef4m' >Elim 4</option>
                        <option value ="ef5m" >Elim 5</option>
						<option value='ef6m' >Elim 6</option>
                        <option value ="qf1m" >Elim 7</option>
						<option value='qf2m' >Elim 8</option>
                        <option value ="qf3m" >Elim 9</option>
						<option value='qf4m' >Elim 10</option>
                        <option value ="sf1m" >Elim 11</option>
						<option value='sf2m' >Elim 12</option>
                        <option value='f1m' >Elim 13</option>
					</select>
				</div>
				</div>

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
					<b><br>Team 3: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamNumber3" name="teamNumber3"  placeholder=" ">
				</div>

                <div class="col-lg-2">
					<b><br>Team 4: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamNumber4" name="teamNumber4"  placeholder=" ">
				</div>

                <div class="col-lg-2">
					<b><br>Team 5: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamNumber5" name="teamNumber5"  placeholder=" ">
				</div>

                <div class="col-lg-2">
					<b><br>Team 6: </b>
				</div>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamNumber6" name="teamNumber6"  placeholder=" ">
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