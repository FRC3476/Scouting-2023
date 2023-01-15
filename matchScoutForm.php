<html>

<head>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet">
	<link href="bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet">
	<script src="jquery-1.11.2.min.js"></script>
	<script src="sorttable.js"></script>
	<script src="Orange-Rind/js/orangePersist.js"></script>
	<script src="matchScoutFormDynamic.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
include("navBar.php");
include("matchScoutingDetails.php");
include("matchResultBA.php");
?>

<body onload="start()">
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

			<?php
				$BA = new MatchResultBA();
				$BA->readAllMatchResultBAData();
				$tName = $BA->get_tournamentName();
				if (!empty($_GET)) {
					$tourName = $_GET["tournamentName"];
					$sName = $_GET["scouterName"];
					$aColor = $_GET["allianceColor"];

					$matchScoutingDetails = new MatchScoutingDetails();
					$matchScoutingDetails->set_tournamentName($tourName);
					$matchScoutingDetails->set_scouterName($sName);
					$matchScoutingDetails->set_allianceColor($aColor);

					$scouterName = $matchScoutingDetails->get_scouterName();
					$tournamentName = $matchScoutingDetails->get_tournamentName();
					$allianceColor = $matchScoutingDetails->get_allianceColor();
				}
			?>

			<div class="row" style="text-align: center;">
				<div class="col-md-2">
					Scouter Name:
					<input type="text" name="scouterName" onKeyUp="saveUserName()" id="scouterName" size="8" value="<?=$scouterName?>" class="form-control">
				</div>
				<div class="col-md-2">
					Tournament Name:
					<input type="text" name="tournamentName" onKeyUp="saveTournamentName()" id="tournamentName" size="8" value="<?=$tName?>" class="form-control">
				</div>
				<div class="col-md-2">
					Match Number:
					<input type="text" name="matchNumber" id="matchNumber" size="8" class="form-control">
				</div>
				<div class="col-md-2">
					Team Number:
					<input type="text" name="teamNumber" id="teamNumber" size="8" class="form-control">
				</div>
				<div class="col-md-3">
					Alliance Color:
					<select id="allianceColor" onKeyUp="" class="form-control" value="<?=$allianceColor?>">
						<option value="" disabled selected>Choose Alliance</option>
						<option value ="blue" <?php if ($allianceColor == 'blue') echo ' selected="selected"'; ?>>Blue</option>
						<option value='red'  <?php if ($allianceColor == 'red') echo ' selected="selected"'; ?>>Red</option>
					</select>
				</div>
				<div class="col-md-3">
					<button id="Switch" onclick="autotele();" class="btn btn-primary">Teleop</button>
				</div>
			</div>

			<!--Auto Scouting-->
			<!--<form action="" id='myForm'>-->
			<div id="autoscouting">
				<a>
					<h2><b><u>Auto Scouting:</u></b></h2>
				</a>
				<div class="row">
					<div class="col-md-4">
						<div class="togglebutton" id="reach">
							<h4><b>Exited Tarmac:</b></h4>
							<label>
								<input id="exit_tarmac" type="checkbox">
							</label>
						</div>
						<a href="javascript:void(0)" class="btn btn-raised btn-boulder btn-material-teal-600" onclick="clearPath()"><b>CLEAR PATH</b></a>
						<div class="row">
							<canvas id="myCanvas" width=600px height=460px style="border:0px solid #d3d3d3;">
								<script src="Drawing.js"></script>
							</canvas>
						</div>
					</div>
				</div>
				<div>
					<div class="row">
						<a>
							<h3><b><u> Upper Goal:</u></b></h3>
						</a>
						<button class="disable-dbl-tap-zoom-uppera" type="button" onClick="updateupperGoal()" id="bigFont"><a id="upperGoal" class="enlargedtext">0</a> Upper Goal </button>
						<button class="disable-dbl-tap-zoom-uppera" type="button" onClick="updateupperGoalMiss()" id="bigFont"> Upper Goal Miss <a id="upperGoalMiss" class="enlargedtext">0</a></button>
						<button class="disable-dbl-tap-zoom" type="button" onClick="upperGoalClear()" class="enlargedtext stylishUpperMiss" id="bigFont"> Clear <a class="enlargedtext"></a></button>
						<br>
						<br>
						<br>

						<a>
							<h3><b><u>Lower Goal:</u></b></h3>
						</a>
						<button class="disable-dbl-tap-zoom-lowera" type="button" onClick="updatelowerGoal()" class="enlargedtext stylishLower" id="bigFont"><a id="lowerGoal" class="enlargedtext">0</a> Lower Goal </button>
						<button class="disable-dbl-tap-zoom-lowera" type="button" onClick="updatelowerGoalMiss()" class="enlargedtext stylishLower" id="bigFont"> Lower Goal Miss <a id="lowerGoalMiss" class="enlargedtext">0</a></button>
						<button class="disable-dbl-tap-zoom" type="button" onClick="lowerGoalClear()" class="enlargedtext stylishUpperMiss" id="bigFont"> Clear <a class="enlargedtext"></a></button>
						<br>
						<br>
					</div>
				</div>
			</div>
			
			<!--Tepeop scouting section-->
			<div id="teleopscouting">
				<a>
					<h2><b><u>Teleop Scouting:</u></b></h2>
				</a>

				<a>
					<h3><b><u>Upper Goal:</u></b></h3>
				</a>
				<div class="row">
					<button class="disable-dbl-tap-zoom-upper" type="button" onClick="updateupperGoalT()" id="bigFont"><a id="upperGoalT" class="enlargedtext">0</a> Upper Goal</button>
					<button class="disable-dbl-tap-zoom-upper" type="button" onClick="updateupperGoalMissT()" id="bigFont"> Upper Goal Miss <a id="upperGoalMissT" class="enlargedtext">0</a></button>
					<br>
					<br>
					<button class="disable-dbl-tap-zoom-unsave" type="button" onClick="minusupperGoalT()" id="bigFont"><a id="upperGoalT" class="enlargedtext"></a> ---- </button>
					<button class="disable-dbl-tap-zoom-unsave" type="button" onClick="minusupperGoalMissT()" id="bigFont"> ---- <a id="upperGoalMissT" class="enlargedtext"></a></button>


					<a>
						<h3><b><u>Lower Goal:</u></b></h3>
					</a>
					<button class="disable-dbl-tap-zoom-lower" type="button" onClick="updatelowerGoalT()" class="enlargedtext stylishLower" id="bigFont"><a id="lowerGoalT" class="enlargedtext">0</a> Lower Goal </button>
					<button class="disable-dbl-tap-zoom-lower" type="button" onClick="updatelowerGoalMissT()" class="enlargedtext stylishLower" id="bigFont"> Lower Goal Miss <a id="lowerGoalMissT" class="enlargedtext">0</a></button>
					<br>
					<br>
					<button class="disable-dbl-tap-zoom-unsave1" type="button" onClick="minuslowerGoalT()" id="bigFont"><a id="upperGoalT" class="enlargedtext"></a> ---- </button>
					<button class="disable-dbl-tap-zoom-unsave1" type="button" onClick="minuslowerGoalMissT()" id="bigFont"> ---- <a id="upperGoalMissT" class="enlargedtext"></a></button>
					<br>
					<br>
				</div>

				<div>
					<div class="row">
						<canvas id="myCanvas2" width=700px height=350px style="border:0px solid #d3d3d3;">
							<script src="Drawing2.js"></script>
						</canvas>
					</div>

					<button class="disable-dbl-tap-zoom" type="button" onClick="undoDraw()" class="enlargedtext stylishUpperMiss" id="bigFont"> Undo <a class="enlargedtext"></a></button>

				</div>

				<a>
					<h3><b><u>Defense:</u></b></h3>
				</a>
				<div class="togglebutton" id="reach">
					<h4><b>Defense?</b></h4>
					<label>
						<input id="defense" type="checkbox">
					</label>
					<h4><b>Defense Comments</b></h4>

					<textarea placeholder="Please write strategy of the robot or interesting observations of the robot" type="text" id="defComments" class="form-control md-textarea" rows="6"></textarea>

				</div>

				<a>
					<h3><b><u>DNP:</u></b></h3>
				</a>
				<div class="togglebutton" id="reach">
					<h4><b>DNP?</b></h4>
					<label>
						<input id="dnp" type="checkbox">
					</label>
				</div>

				<a>
					<h3><b><u>Climb:</u></b></h3>
				</a>	
				<select id="climb" class="form-control" value="">
						<option value="" disabled selected>Choose Level</option>
						<option value ="0" onClick="climb0()" >None</option>
						<option value="1" onClick="climb1()" >Low</option>
						<option value ="2" onClick="climb2()" >Mid</option>
						<option value="3" onClick="climb3()" >High</option>
						<option value="4" onClick="climb4()" >Traversal</option>
				</select>

				<h4><b><u>Penalties: </u></b></h4>
				<textarea placeholder="Number of Penalties" type="text" id="penalties" class="form-control md-textarea" rows="6">0</textarea>

				<a>
					<h3><b><u>Robot Issues:</u></b></h3>
				</a>
				<select id="issues" value="" class="form-control">
					<option value="N/A">None</option>
					<option value="dead">Dead</option>
					<option value="stopped working">Stopped Working</option>
					<option value="fell over">Fell Over</option>
				</select>

				<h4><b><u>Comments / Strategy: </u></b></h4>
				<textarea placeholder="Please write strategy of the robot or interesting observations of the robot" type="text" id="comments" class="form-control md-textarea" rows="6"></textarea>
				<br>

				<br> <br>
				<div style="padding: 5px; padding-bottom: 10;">
				<!--<input type="button" value="Submit Data" id="submitButton" class="btn btn-primary" onClick="postwith('');">-->
					<input id="MatchScouting" type="submit" class="btn btn-primary" value="Submit" onclick="check()">
				</div>
				<!--</form>-->
			</div>

				<script>

					function climb0(){
						climb = 0;
					}
					function climb1(){
						climb = 1;
					}
					function climb2(){
						climb = 2;
					}
					function climb3(){
						climb = 3;
					}
					function climb4(){
						climb = 4;
					}

					function saveUserName(){
						console.log("SETTING USERNAME");
						localStorage.setItem("scouterName", $("#scouterName").val());
					}

					$(document).ready(function(){
						orangePersist.initializeApp();
						console.log("GETTING USERNAME");
						$("#scouterName").val(localStorage.getItem("scouterName"));
					});

					function saveTournamentName(){
						console.log("SETTING TOURNAMENT");
						localStorage.setItem("tournamentName", $("#tournamentName").val());
					}

					$(document).ready(function(){
						orangePersist.initializeApp();
						console.log("GETTING TOURNAMENT");
						$("#tournamentName").val(localStorage.getItem("tournamentName"));
					});

					function updatelowerGoalMiss() {
						lowerGoalMiss += increment;
						document.getElementById("lowerGoalMiss").innerHTML = lowerGoalMiss;

					}

					function updatelowerGoal() {
						lowerGoal += increment;

						document.getElementById("lowerGoal").innerHTML = lowerGoal;

					}

					function updateupperGoalMiss() {

						upperGoalMiss += increment;

						document.getElementById("upperGoalMiss").innerHTML = upperGoalMiss;

					}

					function updateupperGoal() {
						upperGoal += increment;

						document.getElementById("upperGoal").innerHTML = upperGoal;

					}

					function upperGoalClear() {
						upperGoal = 0;
						upperGoalMiss = 0;

						document.getElementById("upperGoal").innerHTML = upperGoal;
						document.getElementById("upperGoalMiss").innerHTML = upperGoalMiss;

					}

					function lowerGoalClear() {
						lowerGoal = 0;
						lowerGoalMiss = 0;

						document.getElementById("lowerGoal").innerHTML = lowerGoal;
						document.getElementById("lowerGoalMiss").innerHTML = lowerGoalMiss;

					}

					upperGoalT = 0;
					upperGoalMissT = 0;
					lowerGoalT = 0;
					lowerGoalMissT = 0;
					var climb = 0;
					increment = 1;
					cycleCount = "[]";


					function updateupperGoalT() {
						upperGoalT += increment;

						document.getElementById("upperGoalT").innerHTML = upperGoalT;

					}

					function minusupperGoalT() {
						upperGoalT -= increment;

						document.getElementById("upperGoalT").innerHTML = upperGoalT;

					}

					function updateupperGoalMissT() {
						upperGoalMissT += increment;
						document.getElementById("upperGoalMissT").innerHTML = upperGoalMissT;

					}

					function minusupperGoalMissT() {
						upperGoalMissT -= increment;
						document.getElementById("upperGoalMissT").innerHTML = upperGoalMissT;

					}

					function updatelowerGoalT() {
						lowerGoalT += increment;
						document.getElementById("lowerGoalT").innerHTML = lowerGoalT;

					}

					function minuslowerGoalT() {
						lowerGoalT -= increment;
						document.getElementById("lowerGoalT").innerHTML = lowerGoalT;

					}

					function updatelowerGoalMissT() {
						lowerGoalMissT += increment;
						document.getElementById("lowerGoalMissT").innerHTML = lowerGoalMissT;

					}

					function minuslowerGoalMissT() {
						lowerGoalMissT -= increment;
						document.getElementById("lowerGoalMissT").innerHTML = lowerGoalMissT;

					}

					function upperGoalClearT() {
						upperGoalT = 0;
						upperGoalMissT = 0;

						document.getElementById("upperGoalT").innerHTML = upperGoalT;
						document.getElementById("upperGoalMissT").innerHTML = upperGoalMissT;

					}

					function lowerGoalClearT() {
						lowerGoalT = 0;
						lowerGoalMissT = 0;

						document.getElementById("lowerGoalT").innerHTML = lowerGoalT;
						document.getElementById("lowerGoalMissT").innerHTML = lowerGoalMissT;

					}

					function addCoordinate2() {
						coordinateList2.push(tempCoordinateList2[tempCoordinateList2.length - 1]);
						tempCoordinateList2 = [];
					}

					var increment = 1;
					var upperGoal = 0;
					var upperGoalMiss = 0;
					var lowerGoal = 0;
					var lowerGoalMiss = 0;

					var upperGoalT = 0;
					var upperGoalMissT = 0;
					var lowerGoalT = 0;
					var lowerGoalMissT = 0;
					var t = 500;

					function filter($str)
					{
						return filter_var($str, FILTER_SANITIZE_STRING);
					}

					function check() {

						eventCode = "" + document.getElementById('tournamentName').value + "_qm";
						matchNumberCode = eventCode + document.getElementById('matchNumber').value;
						match = document.getElementById('matchNumber').value;

						if (match >= 500) {
							postwith();
						} else {
							fetch('https://www.thebluealliance.com/api/v3/match/' + matchNumberCode + '/simple?X-TBA-Auth-Key=VPexr6soymZP0UMtFw2qZ11pLWcaDSxCMUYOfMuRj5CQT3bzoExsUGHuO1JvyCyU')
								.then(response => {
									return response.json();
								})
								.then(data => {
									team1 = (data["alliances"]["blue"]["team_keys"][0]).substring(3);
									team2 = (data["alliances"]["blue"]["team_keys"][1]).substring(3);
									team3 = (data["alliances"]["blue"]["team_keys"][2]).substring(3);
									team4 = (data["alliances"]["red"]["team_keys"][0]).substring(3);
									team5 = (data["alliances"]["red"]["team_keys"][1]).substring(3);
									team6 = (data["alliances"]["red"]["team_keys"][2]).substring(3);

									let teamNumberInt = document.getElementById('teamNumber').value;
									let teamNumberString = teamNumberInt.toString();

									if ((teamNumberString != team1) && (teamNumberString != team2) && (teamNumberString != team3) && (teamNumberString != team4) && (teamNumberString != team5) && (teamNumberString != team6)) {
										alert("This team is not playing in this match");
										return;
									} else {
										postwith();
									}
								});
						}
					}

				
				function postwith(to) {

					const d = new Date();
					let time = d.getTime();

					if (document.getElementById('penalties').value == "") {
						document.getElementById('penalties').value = 0;
					}

					if (document.getElementById('tournamentName').value == "" || document.getElementById('matchNumber').value == "" || document.getElementById('teamNumber').value == "" || document.getElementById('allianceColor').value == "") {
						alert("Please enter a Team, Alliance Color, and Match Number");
						return;
					}

					var nums = {
						'tournamentName': document.getElementById('tournamentName').value,
						'matchNumber': document.getElementById('matchNumber').value,
						'scouterName': document.getElementById('scouterName').value,
						'teamNumber': document.getElementById('teamNumber').value,
						'allianceColor': document.getElementById('allianceColor').value,
						'eventTime': time,

						'exit_tarmac': document.getElementById('exit_tarmac').checked ? 1 : 0,
						'auto_path': JSON.stringify(coordinateList),
						'auto_upper_goal': upperGoal,
						'auto_upper_goal_miss': upperGoalMiss,
						'auto_lower_goal': lowerGoal,
						'auto_lower_goal_miss': lowerGoalMiss,

						'shot_location': JSON.stringify(coordinateList2),
						'teleop_upper_goal': upperGoalT,
						'teleop_upper_goal_miss': upperGoalMissT,
						'teleop_lower_goal': lowerGoalT,
						'teleop_lower_goal_miss': lowerGoalMissT,

						'climb': climb,
						'penalties': document.getElementById('penalties').value,
						'issues': document.getElementById('issues').value,
						'defense': document.getElementById('defense').checked ? 1 : 0,
						'comments': document.getElementById('comments').value,
						'dnp': document.getElementById('dnp').checked ? 1 : 0,
						'defComments': document.getElementById('defComments').value
					};

					console.log(JSON.stringify(nums));

					$.post("matchScoutHandler.php", nums).done(function(data) {}).done(function() {
						alert("Submission Succeeded! Form Reloading.");
						location.reload(true);
						//href = "matchScoutForm.php?tournamentName=" + document.getElementById('tournamentName').value + "&allianceColor=" + document.getElementById('allianceColor').value;
						//window.location.href = href;
					}).fail(function() {
						alert("Submission Failed! Please alert your head or lead scout!");
					});
				}
				
				</script>

	<style>
		.stylishLower {
			background-color: rgb(58, 133, 129);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(58, 133, 129);
		}

		.stylishLower:hover {
			background-color: Orange;
			border-color: Orange;
		}

		.stylishUpperMiss {
			background-color: rgb(255, 0, 0);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(255, 0, 0);
		}

		.stylishLowerMiss:hover {
			background-color: Orange;
			border-color: Orange;
		}

		.stylishUpper {
			background-color: rgb(255, 120, 50);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(255, 120, 50);
		}

		.stylishUpper:hover {
			background-color: Orange;
			border-color: Orange;
		}

		#bigFont {
			font-size: 20px
		}

		#mediumFont {
			font-size: 15px
		}

		#smallFont {
			font-size: 10px
		}

		.feedback:hover {
			background-color: Orange;
		}

		.disable-dbl-tap-zoom {
			touch-action: manipulation;
		}

		.disable-dbl-tap-zoom-upper {
			touch-action: manipulation;
			background-color: rgb(255, 120, 50);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(255, 120, 50);
			height: 240px;
			width: 564px;
		}

		.disable-dbl-tap-zoom-uppera {
			touch-action: manipulation;
			background-color: rgb(255, 120, 50);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(255, 120, 50);
			height: 100px;
			width: 564px;
		}

		.disable-dbl-tap-zoom-save {
			touch-action: manipulation;
			background-color: rgb(58, 156, 129);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(58, 156, 129);
			height: 240px;
			width: 275px;
		}

		.disable-dbl-tap-zoom-unsave {
			touch-action: manipulation;
			background-color: rgb(171, 95, 82);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(171, 95, 82);
			height: 40px;
			width: 564px;
		}

		.disable-dbl-tap-zoom-unsave1 {
			touch-action: manipulation;
			background-color: rgb(45, 105, 101);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(45, 105, 101);
			height: 40px;
			width: 564px;
		}

		.disable-dbl-tap-zoom-lower {
			touch-action: manipulation;
			background-color: rgb(53, 176, 169);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(53, 176, 169);
			height: 240px;
			width: 564px;
		}

		.disable-dbl-tap-zoom-lowera {
			touch-action: manipulation;
			background-color: rgb(53, 176, 169);
			color: white;
			border-radius: 2px;
			font-family: Helvetica;
			font-weight: bold;
			/*To get rid of weird 3D affect in some browsers*/
			border: solid rgb(53, 176, 169);
			height: 100px;
			width: 564px;
		}
	</style>
</body>

</html>
<?php include("footer.php"); ?>