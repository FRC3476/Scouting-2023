<?php
echo "In leadScout.php\n";

//use PHPUnit\Framework\TestCase;
include("leadScout.php");

$leadScout = new LeadScout();

echo "After creation of matchResult\n";

$leadScout->createLeadScoutTable();

echo "After creation of teamTable\n";

$leadScout->set_matchNumber("1");
$leadScout->set_team1('3476');
$leadScout->set_team2('3477');
$leadScout->set_team3('3478');
$leadScout->set_team4('3479');
$leadScout->set_team5('3480');
$leadScout->set_team6('3481');


echo "After setters on team\n";

echo $leadScout->get_matchNumber();
echo $leadScout->get_team1();

$leadScout->writeLeadScoutData();

echo "After writeTeamData on team\n";

$leadScout->readLeadScoutData(3476);

echo "After readTeamData on team\n";

echo $leadScout->get_team1();
echo $leadScout->get_matchNumber();
?>
