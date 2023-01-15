<?php

echo "In matchResultBATest.php\n";

//use PHPUnit\Framework\TestCase;
include("matchResultBA.php");

$matchResultBA = new MatchResultBA();

echo "After creation of matchResultBA\n";

//$matchResultBA->createMatchResultBATable();

echo "After creation of matchTable\n";

$matchResultBA->set_tournamentName('OCR 2023');
$matchResultBA->set_matchNumber('15');
$matchResultBA->set_matchType('Qualifiers');
$matchResultBA->set_blue1_teamNumber('B012');
$matchResultBA->set_blue2_teamNumber('B356');
$matchResultBA->set_blue3_teamNumber('B789');
$matchResultBA->set_red1_teamNumber('R012');
$matchResultBA->set_red2_teamNumber('R356');
$matchResultBA->set_red3_teamNumber('R789');

echo "After setters on matchResultBA\n";

echo $matchResultBA->get_tournamentName();
echo $matchResultBA->get_matchNumber();
echo $matchResultBA->get_matchType();
echo $matchResultBA->get_blue1_teamNumber();
echo $matchResultBA->get_blue2_teamNumber();
echo $matchResultBA->get_blue3_teamNumber();
echo $matchResultBA->get_red1_teamNumber();
echo $matchResultBA->get_red2_teamNumber();
echo $matchResultBA->get_red3_teamNumber();

echo "After getters on matchResultBA\n";

$matchResultBA->writeMatchResultBAData();

echo "After writeTable on matchResultBA\n";

$matchResultBA->readMatchResultBAData('OCR 2023', 1, "Qualifiers");

echo "After readTable on matchResultBA\n";

echo $matchResultBA->get_tournamentName();
echo $matchResultBA->get_matchNumber();
echo $matchResultBA->get_matchType();
echo $matchResultBA->get_blue1_teamNumber();
echo $matchResultBA->get_blue2_teamNumber();
echo $matchResultBA->get_blue3_teamNumber();
echo $matchResultBA->get_red1_teamNumber();
echo $matchResultBA->get_red2_teamNumber();
echo $matchResultBA->get_red3_teamNumber();

echo "After read"

//echo $matchResultBA->readTeamList();

/*
Match::createMatchTable();
echo "After createTable on match\n";

final class matchResultBATest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In matchResultBATest::testClassConstructor\n";

        $matchResultBA = new match();

        echo "After creation of match\n";

        $matchResultBA->set_tournmentName('OCR');
        $matchResultBA->set_matchNumber(15);
        $matchResultBA->set_matchType('QUALS');

        $this->assertSame('OCR', $matchResultBA->get_tournmentName());
        $this->assertSame(15, $matchResultBA->get_matchNumber());
        $this->assertEmpty($matchResultBA->get_matchType());

        echo "After assertions on match\n";
    }
}

$matchResultBAResultBATest = new matchResultBATest();
$matchResultBAResultBATest->testClassConstructor;
*/

?>