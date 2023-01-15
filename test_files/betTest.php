<?php

echo "In bet.php\n";

//use PHPUnit\Framework\TestCase;
include("bet.php");

$bet = new Bet();

echo "After creating Bet";

$bet->set_userName("mihir");
$bet->set_matchNumber("1");
$bet->set_redAutoPredict("5");
$bet->set_blueAutoPredict("4");
$bet->set_climbWinner("Red");
$bet->set_winner("Red");
$bet->set_timeStamp("123126423");
$bet->set_margin("5");

echo "After setters on robot\n";

$bet->writeBetData();

echo "After writeRobotData on robot\n";

// $bet->readBetData("mihir", "1");

// echo "After readRobotData on robot\n";

// echo $bet->get_redAutoPredict();

/*
Robot::createRobotTable();
echo "After createTable on robot\n";

final class robotTest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In robotTest::testClassConstructor\n";

        $bet = new Robot();

        echo "After creation of robot\n";

        $bet->set_teamNumber(3476);
        $bet->set_numBatteries(10);

        $this->assertSame(3476, $bet->get_teamNumber());
        $this->assertSame(10, $bet->get_set_numBatteries());

        echo "After assertions on robot\n";
    }
}

$betTest = new robotTest();
$betTest->testClassConstructor;
*/

?>