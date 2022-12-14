<?php

class ClamCard
{
  public array $travelZone = 
  [ 
    'zoneA' => ['Asterisk', 'Amersham', 'Aldgate', 'Angel', 'Anerley'], 
    'zoneB' => ['Bison', 'Bugel', 'Balham', 'Bullhead', 'Barbican']
  ];
  
  public array $travelFares = 
  [
    'zoneA' => ['single' => '2.50', 'day' => '7.00', 'week' => '40.00', 'month' => '145.00'],
    'zoneB' => ['single' => '3.00', 'day' => '8.00', 'week' => '47.00', 'month' => '165.00']
  ];

  public function getTravelZone(string $selectedZone)
  {
    return $this->travelZone[$selectedZone];
  }


  public function getJourneyPrice(array $stations)
  {
     $startingFromZone = [];
     $arrivingAtZone = [];
     $count = 0;

     $travelZone = $this->travelZone;
     $travelFares = $this->travelFares;
    
     
     if(count($stations) % 2 != 0)
     {
      throw new \InvalidArgumentException('You must complete a journey to calculate the price');
     }

     $arrayOfStations = $this->formatStations($stations);
     
     $singleJourneyRates = [];
    
    foreach($arrayOfStations as $stations){
     foreach($travelZone as $key => $value){ 
          if(in_array($stations[0], $value)){
          $startingFromZone[] = $key;
        } if(in_array($stations[1], $value)){
          $arrivingAtZone[] = $key;
        }  
      } 
      $count++; 
      $singleJourneyRates[] = $this->calculateRatePerJourney($count,$startingFromZone,$arrivingAtZone);
    }
  

   if($count > 1)
    {   
      return $this->calculateDayRateForZone(array_merge(...$singleJourneyRates));
    } else {
      return implode(" ", $singleJourneyRates[0]);
    }
  
  }



  private function formatStations(array $stations)
  {
    if(count($stations) == 2)
    {
      $arrayOfStations = [$stations];
    } elseif (count($stations) > 2 && count($stations) % 2 == 0)
    {
      $arrayOfStations = array_chunk($stations, 2);
    } 

    return $arrayOfStations;
  }


  private function calculateRatePerJourney($count, $startingFromZone, $arrivingAtZone)
  {

    $journeyPrice = [];

    $startingFromZone === $arrivingAtZone ? $journeyPrice[] = $this->travelFares[$startingFromZone[0]]["single"] :
    $journeyPrice[] = $this->travelFares["zoneB"]["single"];
    
    return $journeyPrice;

  }


  private function calculateDayRateForZone($singleJourneyRates)
  {

    $zoneASingleRate = $this->travelFares['zoneA']['single'];
    $zoneBSingleRate = $this->travelFares['zoneB']['single'];
    
    $zoneADayRate = $this->travelFares['zoneA']['day'];
    $zoneBDayRate = $this->travelFares['zoneB']['day'];
    

    $totalOfSingleJourneys = array_sum($singleJourneyRates);


      if(in_array($zoneASingleRate, $singleJourneyRates) && in_array($zoneBSingleRate, $singleJourneyRates))
      { 
        $sumOfJourney = array_sum($singleJourneyRates);

        if($sumOfJourney > $zoneADayRate){
          $journeyTotal = $zoneBDayRate;
        } else {
          return $sumOfJourney;
        }
      } elseif (!in_array($zoneASingleRate, $singleJourneyRates) && $totalOfSingleJourneys > $zoneBDayRate)
      {
        return $zoneBDayRate;

      } elseif(!in_array($zoneASingleRate, $singleJourneyRates) && $totalOfSingleJourneys < $zoneBDayRate) 
      {
        return $totalOfSingleJourneys;

      } elseif(!in_array($zoneBSingleRate, $singleJourneyRates) && $totalOfSingleJourneys > $zoneADayRate) 
      {
        
        return $zoneADayRate;

      } elseif(!in_array($zoneBSingleRate, $singleJourneyRates) && $totalOfSingleJourneys < $zoneADayRate) 
      {
        return $totalOfSingleJourneys;

      } 

    }
    
    
  }

  

