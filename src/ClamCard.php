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

     $arrayOfStations = $this->formatStations($stations);
     
    //  iterate through each array and save the zones in starting from and arriving at arrays
    // add to the count for each array 
    foreach($arrayOfStations as $stations){
     foreach($travelZone as $key => $value){ 
          if(in_array($stations[0], $value)){
          $startingFromZone[] = $key;
        } if(in_array($stations[1], $value)){
          $arrivingAtZone[] = $key;
        }  
      } 
      $count++; 
    }
    
    if($count == 1 && $startingFromZone === $arrivingAtZone)
    {
      $journeyPrice = $this->travelFares[$startingFromZone[0]]["single"];
    } 
    elseif($count == 1 && $startingFromZone != $arrivingAtZone)
    {
      $journeyPrice = $this->travelFares["zoneB"]["single"];
    }
    elseif($count > 1 && $startingFromZone === $arrivingAtZone)
    {
      $journeyPrice = $this->travelFares[$startingFromZone[0]]["day"];
    }
    else
    {
      $journeyPrice = $this->travelFares["zoneB"]["day"];
    }

    return $journeyPrice;
  
  }


  private function formatStations(array $stations)
  {
    if(count($stations) == 2)
    {
      $arrayOfStations = $stations;
    } elseif(count($stations) > 2 && count($stations) % 2 == 0)
    {
      $arrayOfStations = array_chunk($stations, 2);
    }

    return $arrayOfStations;
  }

}