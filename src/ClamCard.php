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


  public function getJourneyPrice(string $fromStation, $toStation)
  {
     $startingFromZone = [];
     $arrivingAtZone = [];

     $travelZone = $this->travelZone;

     foreach($travelZone as $key => $value){
      foreach($value as $val){
         if($fromStation === $val){
          $startingFromZone[] = $key;
        } if($toStation === $val){
          $arrivingAtZone[] = $key;
        }  
      }  
    }
     return $startingFromZone === $arrivingAtZone ? $this->travelFares[$startingFromZone[0]]["single"] : null;
  
  }

}