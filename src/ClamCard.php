<?php

class ClamCard
{
  public array $travelZone = 
  [ 
    'zoneA' => ['Asterisk', 'Amersham', 'Aldgate', 'Angel', 'Anerley'], 
    'zoneB' => ['Bison', 'Bugel', 'Balham', 'Bullhead', 'Barbican']
  ];
  
  public function getTravelZone(string $selectedZone)
  {
    return $this->travelZone[$selectedZone];
  }

}