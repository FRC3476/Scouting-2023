<html>
<?php
include("header.php");
include("matchResultBA.php");
include("matchScoutingDetails.php");
include("bet.php");

function getBetScore($userName){
    $bets = new Bet();
    $BA = new MatchResultBA();
    $bet = $bets->readByName($userName);
    if($bet != null){
        $Score = 0;
        for ($i = 0; $i != sizeof($bet); $i++) {
			$match = $bet[$i]["matchNumber"];
            $tournament = $bet[$i]["tournament"];
			$matchType = $bet[$i]["matchType"];
            $BA->readMatchResultBAData($tournament, $match, $matchType);
            $matchDetails = new MatchScoutingDetails();
            $matchDetails->readMatchScoutingDetailsData($tournament, $match);
            $timeAct = $matchDetails->get_eventTime();
            $betTime = $bet[$i]["timeStamp"];
            $RedScore = $BA->get_red_total_score();
            $BlueScore = $BA->get_blue_total_score();
            $Winner = $BA->get_winning_alliance();

            if($Winner == ""){
                $Winner = "Tie";
            }

            $blueAuto = $BA->get_blue_auto_lower() + $BA->get_blue_auto_upper();
            $redAuto = $BA->get_red_auto_lower() + $BA->get_red_auto_upper();

            $blueHanger = $BA->get_blue_hanger_points();
            $redHanger = $BA->get_red_hanger_points();

            if($blueHanger > $redHanger){
                $climb = "blue";
            }else if($redHanger > $blueHanger){
                $climb = "red";
            }else{
                $climb = "equal";
            }

            if($BlueScore <= $RedScore){
                $margin = $BA->get_red_total_score() - $BA->get_blue_total_score();
            }else{
                $margin = $BA->get_blue_total_score() - $BA->get_red_total_score();
            }
            if($betTime +180000 < $timeAct){
                if ($bet[$i]["margin"] == $margin) {
                    $Score += 5;
                }
                if ($bet[$i]["winner"] == $Winner) {
                    $Score += 3;
                }
                if ($bet[$i]["redAutoPredict"] == $redAuto) {
                    $Score += 2;
                }
                if ($bet[$i]["blueAutoPredict"] == $blueAuto) {
                    $Score += 2;
                }
                if ($bet[$i]["climbWinner"] == $climb) {
                    $Score += 1;
                }
            }
		}
    }
    return $Score;

}






?>
<script src="js/bootstrap.min.js"></script>

<body>
	<?php include("navBar.php") ?>
	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
			<h2>Bet Ranking</h2>
			<table class="sortable table table-hover" id="RawData" border="1">
				<tr>
					<th>User</th>
					<th>Score</th>
					<th>Average</th>
					
				</tr>
				<?php
                $bet = new Bet();
				$userList = $bet->getUserList();
				foreach ($userList as $userName) {

					$i = 0;
					$score = getBetScore($userName);
					//$avg = getBetAvg($userName);
					

					echo ("<tr>
					<th>" . $userName . "</th>
					<th>" . $score . "</th>
					</tr>");

                    //<th>" . $avg . "</th>
				}

				?>
			</table>
		</div>
	</div>
</body>
<?php include("footer.php") ?>