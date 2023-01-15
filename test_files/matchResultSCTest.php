<?php

echo "In matchResultSCTest.php\n";

//use PHPUnit\Framework\TestCase;
include("matchResultSC.php");

$matchResultSC = new matchResultSC();

echo "After creation of matchResultSC\n";

//$matchResultSC->creatematchResultSCTable();

echo "After creation of matchTable\n";

$matchResultSC->set_tournamentName('OCR 2023');
$matchResultSC->set_matchNumber('15');
$matchResultSC->set_matchType('Qualifiers');
$matchResultSC->set_blue1_teamNumber('B011');
$matchResultSC->set_blue2_teamNumber('B355');
$matchResultSC->set_blue3_teamNumber('B788');
$matchResultSC->set_red1_teamNumber('R011');
$matchResultSC->set_red2_teamNumber('R355');
$matchResultSC->set_red3_teamNumber('R788');

echo "After setters on matchResultSC\n";

echo $matchResultSC->get_tournamentName();
echo $matchResultSC->get_matchNumber();
echo $matchResultSC->get_matchType();
echo $matchResultSC->get_blue1_teamNumber();
echo $matchResultSC->get_blue2_teamNumber();
echo $matchResultSC->get_blue3_teamNumber();
echo $matchResultSC->get_red1_teamNumber();
echo $matchResultSC->get_red2_teamNumber();
echo $matchResultSC->get_red3_teamNumber();

echo "After getters on matchResultSC\n";

$matchResultSC->writematchResultSCData();

echo "After writeTable on matchResultSC\n";

$matchResultSC->readmatchResultSCData('OCR 2023', 1);

echo "After readTable on matchResultSC\n";

echo $matchResultSC->get_tournamentName();
echo $matchResultSC->get_matchNumber();
echo $matchResultSC->get_matchType();
echo $matchResultSC->get_blue1_teamNumber();
echo $matchResultSC->get_blue2_teamNumber();
echo $matchResultSC->get_blue3_teamNumber();
echo $matchResultSC->get_red1_teamNumber();
echo $matchResultSC->get_red2_teamNumber();
echo $matchResultSC->get_red3_teamNumber();

/*
Match::createMatchTable();
echo "After createTable on match\n";

final class matchResultSCTest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In matchResultSCTest::testClassConstructor\n";

        $matchResultSC = new match();

        echo "After creation of match\n";

        $matchResultSC->set_tournmentName('OCR');
        $matchResultSC->set_matchNumber(15);
        $matchResultSC->set_matchType('QUALS');

        $this->assertSame('OCR', $matchResultSC->get_tournmentName());
        $this->assertSame(15, $matchResultSC->get_matchNumber());
        $this->assertEmpty($matchResultSC->get_matchType());

        echo "After assertions on match\n";
    }
}

$matchResultSCResultBATest = new matchResultSCTest();
$matchResultSCResultBATest->testClassConstructor;
*/

?>