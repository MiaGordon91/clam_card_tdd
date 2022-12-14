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
        $expectedZoneAStations = $this->clamCard->getTravelZone('zoneA');

        $this->assertEquals($expectedResult, $expectedZoneAStations);
    }

}