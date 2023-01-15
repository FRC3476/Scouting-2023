<html>
<?php 
	include("navBar.php");
	include("bet.php");
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
				<h2><b><u>Bet Form:</u></b></h2>
			</a>
			<?php
				$BATour = new MatchResultBA();
				$BATour->readAllMatchResultBAData();
				$tName = $BATour->get_tournamentName();
				if (!empty($_POST)) {
					$bet = new Bet();
                    $t=time();
					$bet->set_userName($_POST["name"]);
                    $bet->set_matchNumber($_POST["matchNumber"]);
					$bet->set_matchType($_POST["matchType"]);
                    $bet->set_tournament($_POST["tournament"]);
                    $bet->set_redAutoPredict($_POST["TotalAutoRed"]);
                    $bet->set_blueAutoPredict($_POST["TotalAutoBlue"]);
                    $bet->set_climbWinner($_POST["climbPredict"]);
                    $bet->set_winner($_POST["Winner"]);
                    $bet->set_timeStamp($t);
                    $bet->set_margin($_POST["margin"]);
					$bet->writeBetData();
				}
			?>

			<form action="" method="post" id='myForm'>

				<div class="form-group">
                    <b><text class="col-lg-2 control-label">Name: </text></b>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>
                </div>
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
					<div class="col-lg-10">
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

                <div class="col-lg-2">
                    <b><br>Auto Balls Scored by Red Alliance: </b>
                </div>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="TotalAutoRed" name="TotalAutoRed" placeholder=" ">
                    <br>
                </div>

                <div class="col-lg-2">
                    <b><br>Auto Balls Scored by Blue Alliance: </b>
                </div>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="TotalAutoBlue" name="TotalAutoBlue" placeholder=" ">
                    <br>
                </div>

                <div class="col-lg-2">
                    <b><br>Which Alliance will get more climb points:</b>
                </div>
                <div class="col-lg-10">
                    <select name="climbPredict" class="form-control">
                        <option value="" disabled selected>Choose option</option>
                        <option value='blue'>Blue</option>
                        <option value='red'>Red</option>
                        <option value='equal'>Equal</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <b><br>Which Alliance will Win: </b>
                </div>
                <div class="col-lg-10">
                    <select name="Winner" class="form-control">
                        <option value="" disabled selected>Choose Winner</option>
                        <option value='blue'>Blue</option>
                        <option value='red'>Red</option>
                        <option value='Tie'>Tie</option>
                    </select>
                    <br>
                </div>

                <div class="col-lg-2">
                    <b><br>Margin of Victory:</b>
                </div>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="margin" name="margin" placeholder=" ">
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