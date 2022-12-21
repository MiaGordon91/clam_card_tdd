<?php

use PHPUnit\Framework\TestCase;

class ClamCardTest extends TestCase
{

    protected function setup() : void
    {
        $this->clamCard = new ClamCard();
    }

    
    public function testTravelZonesAreSet()
    {
        $expectedResult = ['Asterisk', 'Amersham', 'Aldgate', 'Angel', 'Anerley'];
        $ZoneAStations = $this->clamCard->getTravelZone('zoneA');

        $this->assertEquals($expectedResult, $ZoneAStations);
    }

    public function testZoneASingleRateIsReturned()
    {
        $expectedPrice = '2.50';
        $journey = $this->clamCard->getJourneyPrice(['Asterisk', 'Aldgate']);
        
        $this->assertEquals($expectedPrice, $journey); 

    }

    public function testZoneASingleJourneyDoesntReturnZoneBDayJourney()
    {
        $notExpectedPrice = '8.00';
        $journey = $this->clamCard->getJourneyPrice(['Amersham', 'Aldgate']);
        
        $this->assertNotEquals($notExpectedPrice, $journey);
    }

    public function testZoneAtoZoneBSingleJourneyReturnsCorrectRate()
    {
        $expectedPrice = '3.00';
        $journey =  $this->clamCard->getJourneyPrice(['Aldgate', 'Barbican']);

        $this->assertEquals($expectedPrice, $journey);
    }


    public function testMultipleJourneysInZoneA()
    {
        $expectedPrice = '7.00';
        $journey = $this->clamCard->getJourneyPrice(['Asterisk', 'Amersham', 'Amersham','Anerley', 'Anerley', 'Angel']);

        $this->assertEquals($expectedPrice, $journey);
    }

    public function testMultipleJourneysAcrossBothZones()
    {
        $expectedJourneyPrices = '5.50';

        $journey = $this->clamCard->getJourneyPrice(['Asterisk', 'Aldgate','Asterisk', 'Balham']);
        
        $this->assertEquals($expectedJourneyPrices, $journey);
    }


    // Edge case
    public function testErrorIsThrownIfTheresAnUncompletedJourney()
    {
        $invalidJourney = ['Bison', 'Bugel', 'Balham'];

        $this->expectException(InvalidArgumentException::class);
        $this->clamCard->getJourneyPrice($invalidJourney);
    }

}
    
// need to fix older test cases after changing logic 