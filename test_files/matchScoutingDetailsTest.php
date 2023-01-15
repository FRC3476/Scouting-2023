<?php

echo "In matchDetailTest.php\n";

//use PHPUnit\Framework\TestCase;
include("matchScoutingDetails.php");

$match = new MatchScoutingDetails();

echo "After creation of match\n";

//$match->createMatchScoutingDetailsTable();

// echo "After creation of table\n";

// $match->set_tournamentName('OCR 2023');
// $match->set_matchNumber(1);
// $match->set_teamNumber(3476);
// $match->set_allianceColor('Red');
// $match->set_scouterName('Keyur');

// echo "After setters on match\n";

// echo $match->get_tournamentName();
// echo $match->get_matchNumber();
// echo $match->get_teamNumber();
// echo $match->get_allianceColor();
// echo $match->get_scouterName();

// echo "After getters on match\n";

// $match->writeMatchScoutingDetailsData();

// echo "After writeTable on match\n";

$match->readMatchScoutingDetailsData("2022caoc", "3");

echo "After readTable on match\n";

echo $match->get_tournamentName();
echo $match->get_matchNumber();
echo $match->get_teamNumber();
echo $match->get_allianceColor();
echo $match->get_scouterName();
echo $match->get_eventTime();


/*
Match::createMatchTable();
echo "After createTable on match\n";

final class matchDetailTest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In matchDetailTest::testClassConstructor\n";

        $match = new MatchDetail();

        echo "After creation of match\n";

        $match->set_tournmentName('OCR');
        $match->set_matchNumber(15);
        $match->set_matchType('QUALS');

        $this->assertSame('OCR', $match->get_tournmentName());
        $this->assertSame(15, $match->get_matchNumber());
        $this->assertEmpty($match->get_matchType());

        echo "After assertions on match\n";
    }
}

$matchDetailTest = new MatchDetailDetailTest();
$matchDetailTest->testClassConstructor;
*/

?>