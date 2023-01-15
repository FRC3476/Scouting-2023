<?php

echo "In teamRankerTest.php\n";

//use PHPUnit\Framework\TestCase;
include("teamRanker.php");

$team = new teamRanker();

echo "After constructing Team";

echo "After creation of teamTable\n";

$team->set_teamNumber("3476");
$team->set_score("1001");

echo "After setters on team\n";

echo $team->get_teamNumber();
echo $team->get_score();

$team->writeteamRankerData();

echo "After writeteamRankerData on team\n";

echo $team->readteamRankerData("4201");

echo "After readteamRankerData on team\n";

echo $team->get_teamNumber();
echo $team->get_score();


?>