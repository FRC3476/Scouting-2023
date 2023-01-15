<?php

echo "In robotTest.php\n";

//use PHPUnit\Framework\TestCase;
include("robot.php");

$robot = new Robot();

echo "After constructing Robot";

$robot->createRobotTable();

echo "After creation of robotTable\n";

$robot->set_teamNumber(3476);
$robot->set_numBatteries(10);
$robot->set_chargedBatteries(2);
$robot->set_codeLanguage("Java");
$robot->set_climbLevel(1);
$robot->set_falconLoctite("ABC");
$robot->set_autoPath("DEF");
$robot->set_comments("GHI");

echo "After setters on robot\n";

echo $robot->get_teamNumber();
echo $robot->get_numBatteries();

$robot->writeRobotData();

echo "After writeRobotData on robot\n";

$robot->readRobotData(3476);

echo "After readRobotData on robot\n";

echo $robot->get_teamNumber();
echo $robot->set_numBatteries();

/*
Robot::createRobotTable();
echo "After createTable on robot\n";

final class robotTest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In robotTest::testClassConstructor\n";

        $robot = new Robot();

        echo "After creation of robot\n";

        $robot->set_teamNumber(3476);
        $robot->set_numBatteries(10);

        $this->assertSame(3476, $robot->get_teamNumber());
        $this->assertSame(10, $robot->get_set_numBatteries());

        echo "After assertions on robot\n";
    }
}

$robotTest = new robotTest();
$robotTest->testClassConstructor;
*/

?>