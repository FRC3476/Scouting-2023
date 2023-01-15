<?php
echo "In matchResultTest.php\n";

//use PHPUnit\Framework\TestCase;
include("matchResult.php");

$matchResult = new MatchResult();

echo "After creation of matchResult\n";

$matchResult->createMatchResultTable();

echo "After creation of matchTable\n";

$matchResult->get_matchResultBA()->set_tournamentName('OCR 2023');
$matchResult->get_matchResultBA()->set_matchNumber('15');
$matchResult->get_matchResultBA()->set_matchType('Qualifiers');
$matchResult->get_matchResultBA()->set_blue1_teamNumber('B012');
$matchResult->get_matchResultBA()->set_blue2_teamNumber('B356');
$matchResult->get_matchResultBA()->set_blue3_teamNumber('B789');
$matchResult->get_matchResultBA()->set_red1_teamNumber('R012');
$matchResult->get_matchResultBA()->set_red2_teamNumber('R356');
$matchResult->get_matchResultBA()->set_red3_teamNumber('R789');

echo "After setters on matchResult\n";

echo $matchResult->get_matchResultBA()->get_tournamentName();
echo $matchResult->get_matchResultBA()->get_matchNumber();
echo $matchResult->get_matchResultBA()->get_matchType();
echo $matchResult->get_matchResultBA()->get_blue1_teamNumber();
echo $matchResult->get_matchResultBA()->get_blue2_teamNumber();
echo $matchResult->get_matchResultBA()->get_blue3_teamNumber();
echo $matchResult->get_matchResultBA()->get_red1_teamNumber();
echo $matchResult->get_matchResultBA()->get_red2_teamNumber();
echo $matchResult->get_matchResultBA()->get_red3_teamNumber();

echo "After getters on matchResult\n";

$matchResult->writeMatchResultData();

echo "After writeTable on matchResult\n";

$matchResult->readMatchResultData('OCR 2023', 1);

echo "After readTable on matchResult\n";

echo $matchResult->get_matchResultBA()->get_tournamentName();
echo $matchResult->get_matchResultBA()->get_matchNumber();
echo $matchResult->get_matchResultBA()->get_matchType();
echo $matchResult->get_matchResultBA()->get_blue1_teamNumber();
echo $matchResult->get_matchResultBA()->get_blue2_teamNumber();
echo $matchResult->get_matchResultBA()->get_blue3_teamNumber();
echo $matchResult->get_matchResultBA()->get_red1_teamNumber();
echo $matchResult->get_matchResultBA()->get_red2_teamNumber();
echo $matchResult->get_matchResultBA()->get_red3_teamNumber();

/*
Match::createMatchTable();
echo "After createTable on match\n";

final class matchResultTest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In matchResultTest::testClassConstructor\n";

        $matchResult = new match();

        echo "After creation of match\n";

        $matchResult->set_tournmentName('OCR');
        $matchResult->set_matchNumber(15);
        $matchResult->set_matchType('QUALS');

        $this->assertSame('OCR', $matchResult->get_tournmentName());
        $this->assertSame(15, $matchResult->get_matchNumber());
        $this->assertEmpty($matchResult->get_matchType());

        echo "After assertions on match\n";
    }
}

$matchResultResultBATest = new matchResultTest();
$matchResultResultBATest->testClassConstructor;
*/

?>