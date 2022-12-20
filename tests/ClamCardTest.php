<?php

use PHPUnit\Framework\TestCase;

class ClamCardTest extends TestCase
{

    protected function setup() : void
    {
        $this->clamCard = new ClamCard();
    }

    // test that travel zone is set 
    public function testTravelZonesAreSet()
    {
        $expectedResult = ['Asterisk', 'Amersham', 'Aldgate', 'Angel', 'Anerley'];
        $ZoneAStations = $this->clamCard->getTravelZone('zoneA');

        $this->assertEquals($expectedResult, $ZoneAStations);
    }


    // test Michaels journey returns correct single rate
    public function testZoneASingleRateIsReturned()
    {
        $expectedPrice = '2.50';
        $journey = $this->clamCard->getJourneyPrice('Asterisk', 'Aldgate');
        
        $this->assertEquals($expectedPrice, $journey); 

    }

    public function testZoneASingleJourneyDoesntReturnZoneBDayJourney()
    {
        $notExpectedPrice = '8.00';
        $journey = $this->clamCard->getJourneyPrice('Amersham', 'Aldgate');
        
        $this->assertNotEquals($notExpectedPrice, $journey);
    }

    public function testZoneAtoZoneBSingleJourneyReturnsCorrectRate()
    {
        $expectedPrice = '3.00';
        $journey =  $this->clamCard->getJourneyPrice('Aldgate', 'Balham');

        $this->assertEquals($expectedPrice, $journey);
    }


    public function testMultipleJourneysInZoneA()
    {
        $expectedPrice = '7.00';
        $journey = $this->clamCard->getJourneyPrice(['Asterisk', 'Amersham', 'Aldgate','Anerley']);

        $this->assertEquals($expectedPrice, $journey);
    }
}