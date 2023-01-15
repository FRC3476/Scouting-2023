<?php

echo "In teamTest.php\n";

//use PHPUnit\Framework\TestCase;
include("team.php");

$team = new Team();

echo "After constructing Team";

$team->createTeamTable();

echo "After creation of teamTable\n";

$team->set_teamNumber(3476);
$team->set_teamName('Code Orange');

echo "After setters on team\n";

echo $team->get_teamNumber();
echo $team->get_teamName();

$team->writeTeamData();

echo "After writeTeamData on team\n";

$team->readTeamData(3476);

echo "After readTeamData on team\n";

echo $team->get_teamNumber();
echo $team->get_teamName();

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