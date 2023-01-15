<!DOCTYPE html>

<html>
<?php
include("header.php") ?>
<script src="js/bootstrap.min.js"></script>

<body>
    <?php 
        include("navBar.php");
        include("matchResultBA.php");
        include("matchScoutingDetails.php");
    
        function getCorrectData($match, $tournament, $allianceColor, $category){
            $MatchBA = new MatchResultBA();
            $MatchBA->readMatchResultBAData($tournament, $match, "qm");

            if($category == "blue_auto_upper"){
                return $MatchBA->get_blue_auto_upper();
            }
            if($category == "blue_teleop_upper"){
                return $MatchBA->get_blue_teleop_upper();
            }
            if($category == "blue_auto_lower"){
                return $MatchBA->get_blue_auto_lower();
            }
            if($category == "blue_teleop_lower"){
                return $MatchBA->get_blue_teleop_lower();
            }

            if($category == "red_auto_upper"){
                return $MatchBA->get_red_auto_upper();
            }
            if($category == "red_teleop_upper"){
                return $MatchBA->get_red_teleop_upper();
            }
            if($category == "red_auto_lower"){
                return $MatchBA->get_red_auto_lower();
            }
            if($category == "red_teleop_lower"){
                return $MatchBA->get_red_teleop_lower();
            }

            if($category == "blue1_end_game"){
                return $MatchBA->get_blue1_end_game();
            }
            if($category == "blue2_end_game"){
                return $MatchBA->get_blue2_end_game();
            }
            if($category == "blue3_end_game"){
                return $MatchBA->get_blue3_end_game();
            }
            if($category == "red1_end_game"){
                return $MatchBA->get_red1_end_game();
            }
            if($category == "red2_end_game"){
                return $MatchBA->get_red2_end_game();
            }
            if($category == "red3_end_game"){
                return $MatchBA->get_red3_end_game();
            }
        }

        function getClimbByNumber($teamNumber, $tournament, $match){
            $MatchBA = new MatchResultBA();
            $MatchBA->readMatchResultBAData($tournament, $match, "qm");
            if($MatchBA->get_blue1_teamNumber() == $teamNumber){
                $climbValue = $MatchBA->get_blue1_end_game();
            }else if($MatchBA->get_blue2_teamNumber() == $teamNumber){
                $climbValue = $MatchBA->get_blue2_end_game();
            }else if($MatchBA->get_blue3_teamNumber() == $teamNumber){
                $climbValue = $MatchBA->get_blue3_end_game();
            }else if($MatchBA->get_red1_teamNumber() == $teamNumber){
                $climbValue = $MatchBA->get_red1_end_game();
            }else if($MatchBA->get_red2_teamNumber() == $teamNumber){
                $climbValue = $MatchBA->get_red2_end_game();
            }else if($MatchBA->get_red3_teamNumber() == $teamNumber){
                $climbValue = $MatchBA->get_red3_end_game();
            }

            if($climbValue == "None"){
                return "0";
            }else if($climbValue == "Low"){
                return "1";
            }else if($climbValue == "Mid"){
                return "2";
            }else if($climbValue == "High"){
                return "3";
            }else if($climbValue == "Traversal"){
                return "4";
            }

        }

        function getTarmacByNumber($teamNumber, $tournament, $match){
            $MatchBA = new MatchResultBA();
            $MatchBA->readMatchResultBAData($tournament, $match, "qm");
            if($MatchBA->get_blue1_teamNumber() == $teamNumber){
                $tarmacValue = $MatchBA->get_blue1_taxi();
            }else if($MatchBA->get_blue2_teamNumber() == $teamNumber){
                $tarmacValue = $MatchBA->get_blue2_taxi();
            }else if($MatchBA->get_blue3_teamNumber() == $teamNumber){
                $tarmacValue = $MatchBA->get_blue3_taxi();
            }else if($MatchBA->get_red1_teamNumber() == $teamNumber){
                $tarmacValue = $MatchBA->get_red1_taxi();
            }else if($MatchBA->get_red2_teamNumber() == $teamNumber){
                $tarmacValue = $MatchBA->get_red2_taxi();
            }else if($MatchBA->get_red3_teamNumber() == $teamNumber){
                $tarmacValue = $MatchBA->get_red3_taxi();
            }

            if($tarmacValue == "Yes"){
                return "1";
            }else if($tarmacValue == "No"){
                return "0";
            }
        }

        $BATour = new MatchResultBA();
        $BATour->readAllMatchResultBAData();
        $tName = $BATour->get_tournamentName();
    
    ?>

    <div id="content">
        <div class="">
            <div class="well column  col-lg-112  col-sm-12 col-xs-12 overflow-auto" id="content">
                <h1>Data Validation</h1>
                <form action="" method="get">
                    Enter Tournament:
                    <input type="text" name="tournament" id="tournament" value="<?=$tName?>" size="8">
                    Enter Match Number:
                    <input type="text" name="match" id="match" size="8">
                    <button id="submit" class="btn btn-primary" onclick="">Display</button>
                    <br>
                    <br>
                    <?php

                    $matchDet = new MatchScoutingDetails();
                    $result = $matchDet->getAllMatchDataTor($_GET["tournament"]);

                    if ($result != null) {
                        $totalAutoUpper = 0;
                        $totalTeleopUpper = 0;
                        $totalAutoLower = 0;
                        $totalTeleopLower = 0;
                        $climb = 0;
                        $teamNumber = "";
                        $redTeamNumber = "";

                        $totalredAutoUpper = 0;
                        $totalredTeleopUpper = 0;
                        $totalredAutoLower = 0;
                        $totalredTeleopLower = 0;
                        $climbred = 0;
                        $tournament = $_GET["tournament"];
                        $match = $_GET["match"];

                        echo ('<div class="overflow-auto"><table  class="table table-hover" id="RawData" border="1"></div>');
                            foreach ($result as $row_key => $row) {
                                if ($i == 0) {
                                    echo ("<tr>");
                                    foreach ($row as $key => $value) {
                                        if (!is_numeric($key) && (($key != "auto_path") && ($key != "shot_location") && ($key != "comments") && ($key != "defComments") && ($key != "defense") && ($key != "dnp") && ($key != "issues"))) {
                                            echo ("<td>" . $key . "</td>");
                                        }
                                    }
                                    $i++;
                                    echo ("</tr>");
                                }
                            

                            echo ("<tr>");
                                foreach ($row as $key => $value) {
                                    if (!is_numeric($key) and $row["matchNumber"] == $_GET["match"] and $row["allianceColor"] == "blue") {
                                        if ($key == "matchNumber") {
                                            $value = '<a>' . $value . '</a>';
                                            echo ("<td bgcolor=lightblue align='center'>" . $value . "</td>");
                                        } else if ($key !=  "auto_path" && $key != "shot_location" && $key != "comments" && $key != "defComments" && $key != "defense" && $key != "dnp" && $key != "issues") {
                                            if ($key == "auto_upper_goal") {
                                                $babc = getCorrectData($match, $tournament, "blue", "blue_auto_upper");
                                                echo ("<td bgcolor=lightblue align='center'>" . $value . " - " . $babc . "</td>");
                                            } else if ($key == "teleop_upper_goal") {
                                                $babc1 = getCorrectData($match, $tournament, "blue", "blue_teleop_upper");
                                                echo ("<td bgcolor=lightblue align='center'>" . $value . " - " . $babc1 . "</td>");
                                            } else if ($key == "auto_lower_goal") {
                                                $babc2 = getCorrectData($match, $tournament, "blue", "blue_auto_lower");
                                                echo ("<td bgcolor=lightblue align='center'>" . $value . " - " . $babc2 . "</td>");
                                            } else if ($key == "teleop_lower_goal") {
                                                $babc3 = getCorrectData($match, $tournament, "blue", "blue_teleop_lower");
                                                echo ("<td bgcolor=lightblue align='center'>" . $value . " - " . $babc3 . "</td>");
                                            }else if ($key == "climb") {
                                                $climbValidate = getClimbByNumber($teamNumber, $tournament, $match);
                                                echo ("<td bgcolor=lightblue align='center'>" . $value . " - " . $climbValidate . "</td>");
                                                $climb += $value*$value;
                                            }else if ($key == "exit_tarmac") {
                                                $exitValidate = getTarmacByNumber($teamNumber, $tournament, $match);
                                                echo ("<td bgcolor=lightblue align='center'>" . $value . " - " . $exitValidate . "</td>");
                                            }else {
                                                echo ("<td bgcolor=lightblue align='center'>" . $value . "</td>");
                                            }
                                        }
                                        if (($key == "auto_upper_goal")) {
                                            $totalAutoUpper += $value;
                                        }
                                        if (($key == "teleop_upper_goal")) {
                                            $totalTeleopUpper += $value;
                                        }
                                        if (($key == "auto_lower_goal")) {
                                            $totalAutoLower += $value;
                                        }
                                        if (($key == "teleop_lower_goal")) {
                                            $totalTeleopLower += $value;
                                        }
                                        if (($key == "teamNumber")) {
                                            $teamNumber = $value;
                                        }
                                    }
                                }

                            foreach ($row as $key => $value) {
                                if (!is_numeric($key) and $row["matchNumber"] == $_GET["match"] and $row["allianceColor"] == "red") {
                                    if ($key == "matchNumber") {
                                        $value = '<a>' . $value . '</a>';
                                        echo ("<td bgcolor=lightsalmon align='center'>" . $value . "</td>");
                                    } else if ($key !=  "auto_path" && $key != "shot_location" && $key != "comments" && $key != "defComments" && $key != "defense" && $key != "dnp" && $key != "issues") {
                                        if ($key == "auto_upper_goal") {
                                            $rabc = getCorrectData($match, $tournament, "red", "red_auto_upper");
                                            echo ("<td bgcolor=lightsalmon align='center'>" . $value . " - " . $rabc . "</td>");
                                        } else if ($key == "teleop_upper_goal") {
                                            $rabc1 = getCorrectData($match, $tournament, "red", "red_teleop_upper");
                                            echo ("<td bgcolor=lightsalmon align='center'>" . $value . " - " . $rabc1 . "</td>");
                                        } else if ($key == "auto_lower_goal") {
                                            $rabc2 = getCorrectData($match, $tournament, "red", "red_auto_lower");
                                            echo ("<td bgcolor=lightsalmon align='center'>" . $value . " - " . $rabc2 . "</td>");
                                        } else if ($key == "teleop_lower_goal") {
                                            $rabc3 = getCorrectData($match, $tournament, "red", "red_teleop_lower");
                                            echo ("<td bgcolor=lightsalmon align='center'>" . $value . " - " . $rabc3 . "</td>");
                                        }else if ($key == "climb") {
                                            $climbValidate = getClimbByNumber($redTeamNumber, $tournament, $match);
                                            echo ("<td bgcolor=lightsalmon align='center'>" . $value . " - " . $climbValidate . "</td>");
                                            $climbred += $value*$value;
                                        }else if ($key == "exit_tarmac") {
                                            $exitValidate = getTarmacByNumber($redTeamNumber, $tournament, $match);
                                            echo ("<td bgcolor=lightsalmon align='center'>" . $value . " - " . $exitValidate . "</td>");
                                        }else {
                                            echo ("<td bgcolor=lightsalmon align='center'>" . $value . "</td>");
                                        }
                                    }
                                    if (($key == "auto_upper_goal")) {
                                        $totalredAutoUpper += $value;
                                    }
                                    if (($key == "teleop_upper_goal")) {
                                        $totalredTeleopUpper += $value;
                                    }
                                    if (($key == "auto_lower_goal")) {
                                        $totalredAutoLower += $value;
                                    }
                                    if (($key == "teleop_lower_goal")) {
                                        $totalredTeleopLower += $value;
                                    }
                                    if (($key == "teamNumber")) {
                                        $redTeamNumber = $value;
                                    }
                                }
                            }
                            echo ("</tr>");
                            }
                        echo ("</table>");
                    }



                    $blueClimbCheck = 0;
                    $redClimbCheck = 0;

                    if (getCorrectData($match, $tournament, "blue", "blue1_end_game") == "Traversal") {
                        $blueClimbCheck += 16;
                    } else if (getCorrectData($match, $tournament, "blue", "blue1_end_game") == "High") {
                        $blueClimbCheck += 9;
                    } else if (getCorrectData($match, $tournament, "blue", "blue1_end_game") == "Mid") {
                        $blueClimbCheck += 4;
                    } else if (getCorrectData($match, $tournament, "blue", "blue1_end_game") == "Low") {
                        $blueClimbCheck += 1;
                    }
                    if (getCorrectData($match, $tournament, "blue", "blue2_end_game") == "Traversal") {
                        $blueClimbCheck += 16;
                    } else if (getCorrectData($match, $tournament, "blue", "blue2_end_game") == "High") {
                        $blueClimbCheck += 9;
                    } else if (getCorrectData($match, $tournament, "blue", "blue2_end_game") == "Mid") {
                        $blueClimbCheck += 4;
                    } else if (getCorrectData($match, $tournament, "blue", "blue2_end_game") == "Low") {
                        $blueClimbCheck += 1;
                    }
                    if (getCorrectData($match, $tournament, "blue", "blue3_end_game") == "Traversal") {
                        $blueClimbCheck += 16;
                    } else if (getCorrectData($match, $tournament, "blue", "blue3_end_game") == "High") {
                        $blueClimbCheck += 9;
                    } else if (getCorrectData($match, $tournament, "blue", "blue3_end_game") == "Mid") {
                        $blueClimbCheck += 4;
                    } else if (getCorrectData($match, $tournament, "blue", "blue3_end_game") == "Low") {
                        $blueClimbCheck += 1;
                    }

                    if (getCorrectData($match, $tournament, "red", "red1_end_game") == "Traversal") {
                        $redClimbCheck += 16;
                    } else if (getCorrectData($match, $tournament, "red", "red1_end_game") == "High") {
                        $redClimbCheck += 9;
                    } else if (getCorrectData($match, $tournament, "red", "red1_end_game") == "Mid") {
                        $redClimbCheck += 4;
                    } else if (getCorrectData($match, $tournament, "red", "red1_end_game") == "Low") {
                        $redClimbCheck += 1;
                    }
                    if (getCorrectData($match, $tournament, "red", "red2_end_game") == "Traversal") {
                        $redClimbCheck += 16;
                    } else if (getCorrectData($match, $tournament, "red", "red2_end_game") == "High") {
                        $redClimbCheck += 9;
                    } else if (getCorrectData($match, $tournament, "red", "red2_end_game") == "Mid") {
                        $redClimbCheck += 4;
                    } else if (getCorrectData($match, $tournament, "red", "red2_end_game") == "Low") {
                        $redClimbCheck += 1;
                    }
                    if (getCorrectData($match, $tournament, "red", "red3_end_game") == "Traversal") {
                        $redClimbCheck += 16;
                    } else if (getCorrectData($match, $tournament, "red", "red3_end_game") == "High") {
                        $redClimbCheck += 9;
                    } else if (getCorrectData($match, $tournament, "red", "red3_end_game") == "Mid") {
                        $redClimbCheck += 4;
                    } else if (getCorrectData($match, $tournament, "red", "red3_end_game") == "Low") {
                        $redClimbCheck += 1;
                    }

                    if ($redClimbCheck != $climbred) {
                        echo '<span style="color:#F00;text-align:center;"> Red Climb  / </span>';
                    }
                    
                    if(($totalredAutoUpper != $rabc) and ($totalredAutoUpper+1 != $rabc) and ($totalredAutoUpper-1 != $rabc)){
                        echo '<span style="color:#F00;text-align:center;"> Red Auto Upper  / </span>';
                    }
                    if(($totalredTeleopUpper != $rabc1) and ($totalredTeleopUpper+1 != $rabc1) and ($totalredTeleopUpper-1 != $rabc1)){
                        echo '<span style="color:#F00;text-align:center;"> Red Teleop Upper  / </span>';
                    }
                    if(($totalredAutoLower != $rabc2) and ($totalredAutoLower+1 != $rabc2) and ($totalredAutoLower-1 != $rabc2)){
                        echo '<span style="color:#F00;text-align:center;"> Red Auto Lower  / </span>';
                    }
                    if(($totalredTeleopLower != $rabc3) and ($totalredTeleopLower+1 != $rabc3) and ($totalredTeleopLower-1 != $rabc3)){
                        echo '<span style="color:#F00;text-align:center;"> Red Teleop Lower  / </span>';
                    }

                    if ($blueClimbCheck != $climb) {
                        echo '<span style="color:#00f;text-align:center;"> Blue Climb  / </span>';
                    }

                    if(($totalAutoUpper != $babc) and ($totalAutoUpper+1 != $babc) and ($totalAutoUpper-1 != $babc)){
                        echo '<span style="color:#00f;text-align:center;"> Blue Auto Upper  / </span>';
                        echo $babc;
                        echo $totalAutoUpper;
                    }
                    if(($totalTeleopUpper != $babc1) and ($totalTeleopUpper+1 != $babc1) and ($totalTeleopUpper-1 != $babc1)){
                        echo '<span style="color:#00f;text-align:center;"> Blue Teleop Upper  / </span>';
                    }
                    if(($totalAutoLower != $babc2) and ($totalAutoLower+1 != $babc2) and ($totalAutoLower-1 != $babc2)){
                        echo '<span style="color:#00f;text-align:center;"> Blue Auto Lower  / </span>';
                    }
                    if(($totalTeleopLower != $babc3) and ($totalTeleopLower+1 != $babc3) and ($totalTeleopLower-1 != $babc3)){
                        echo '<span style="color:#00f;text-align:center;"> Blue Teleop Lower  / </span>';
                    }

                ?>
            </div>
        </div>
    </div>


</body>

</html>

<?php include("footer.php") ?>