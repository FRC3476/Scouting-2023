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

/*
Team::createTeamTable();
echo "After createTable on team\n";

final class teamTest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In teamTest::testClassConstructor\n";

        $team = new Team();

        echo "After creation of team\n";

        $team->set_teamNumber(3476);
        $team->set_teamName('Code Orange');

        $this->assertSame(3476, $team->get_teamNumber());
        $this->assertSame('Code Orange', $team->get_teamName());

        echo "After assertions on team\n";
    }
}

$teamTest = new teamTest();
$teamTest->testClassConstructor;
*/

?>