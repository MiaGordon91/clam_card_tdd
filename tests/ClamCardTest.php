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
        $singleRatePrice = $this->clamCard->getJourneyPrice('Asterisk', 'Aldgate');
        
        $this->assertEquals($expectedPrice, $singleRatePrice); 

    }

    public function testZoneASingleJourneyDoesntReturnZoneBDayJourney()
    {
        $notExpectedPrice = '8.00';
        $singleRatePrice = $this->clamCard->getJourneyPrice('Amersham', 'Aldgate');
        
        $this->assertNotEquals($notExpectedPrice, $singleRatePrice);
    }

}