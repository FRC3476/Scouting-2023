<?php

include("matchResultBA.php");
include("robot.php");

$robot = new Robot();
$matchResultBA = new MatchResultBA();

function getPicture($teamNumber)
{
	if (file_exists("uploads/" . $teamNumber . "-0.jpg")) {
		return ("Yes");
	} else if (file_exists("uploads/" . $teamNumber . "-0.png")) {
		return ("Yes");
	} else if (file_exists("uploads/" . $teamNumber . "-0.jpeg")) {
		return ("Yes");
	} else {
		return ("No");
	}
}

function getPit($teamNumber)
{
	global $pitScoutTable;
	$qs1 = "SELECT * FROM `" . $pitScoutTable . "` WHERE teamNumber = " . $teamNumber . "";
	$result = runQuery($qs1);
	$pitExists = False;
	if ($result != FALSE) {
		$pitExists = True;
		return ("Yes");
	}
	if (!$pitExists) {
		return ("No");
	}
}

?>

<html>
<?php
include("header.php") ?>
<script src="js/bootstrap.min.js"></script>

<body>
	<?php include("navBar.php") ?>

	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
			<h2>Pit Scout Check</h2>

			<a href='robotScoutForm.php'>
        		<button class="btn btn-primary">
            		PS Form
        		</button>
    		</a>
			<a href='pictureUpload.php'>
        		<button class="btn btn-primary">
            		Picture Upload
        		</button>
    		</a>

			<table class="sortable table table-hover" id="RawData" border="1">
				<tr>
					<th>Team Number</th>
					<th>Pit Scouted?</th>
					<th>Picture Taken?</th>		
				</tr>
				<?php
				include("databaseLibrary.php");
				$teamList = $matchResultBA->getEventTeams();
				foreach ($teamList as $teamNumber) {
					$i = 0;
					$pitScouted = $robot->readRobotData($teamNumber);
					$pictureTaken = getPicture($teamNumber);
					
					if($pitScouted == 0){
						$pitScouted = "No";
					}else{
						$pitScouted = "Yes";
					}

					if($pitScouted == "Yes"){
						$Pitcolor = "lightgreen";
					}else{
						$Pitcolor = "White";
					}

					if($pictureTaken == "Yes"){
						$Piccolor = "lightgreen";
					}else{
						$Piccolor = "White";
					}

					if(($pictureTaken == "Yes")&&($pitScouted == "Yes")){
						$color = "lightgreen";
					}else{
						$color = "White";
					}

					echo ("<tr>
					<td bgcolor=".$color."><a href='matchStrategy.php?team=" . $teamNumber . "'>" . $teamNumber . "</a></td>
					<td bgcolor=".$Pitcolor."><a href='robotScoutForm.php?teamNumberG=" . $teamNumber . "'>" . $pitScouted . "</a></td>
					<td bgcolor=".$Piccolor."><a href='pictureUpload.php?teamNumber=" . $teamNumber . "'>" . $pictureTaken . "</a></td>
					</tr>");
				}

				?>
			</table>
		</div>
	</div>
</body>
<?php include("footer.php") ?>