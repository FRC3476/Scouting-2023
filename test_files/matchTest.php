<?php

echo "In matchTest.php\n";

//use PHPUnit\Framework\TestCase;
include("match.php");

$match = new Match();

echo "After creation of match\n";

$match->createMatchTable();

echo "After creation of matchTable\n";

$match->set_tournamentName('OCR 2023');
$match->set_matchNumber('15');
$match->set_matchType('Qualifiers');

echo "After setters on match\n";

echo $match->get_tournamentName();
echo $match->get_matchNumber();
echo $match->get_matchType();

echo "After getters on match\n";

$match->writeMatchData();

echo "After writeTable on match\n";

$match->readMatchData('OCR 2023', 1);

echo "After readTable on match\n";

/*
Match::createMatchTable();
echo "After createTable on match\n";

final class matchTest extends TestCase
{
    // Tests will go here

    public function testClassConstructor() {

        echo "In matchTest::testClassConstructor\n";

        $match = new match();

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

$matchTest = new matchTest();
$matchTest->testClassConstructor;
*/

?>