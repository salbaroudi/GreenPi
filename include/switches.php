<?php

//Relay 0: Fans. WPi Code: 4. Recepticle 1.
   $i = 4; //This is the WPi pin code, for GPIO. Not BCM pin number.
   $status = array(-1);
   unset($status);
   system("gpio mode ".$i." out");
   exec("gpio read ".$i, $status);

   if ($status[0] == 0 ) {
     echo ("<img id='fan_button' src='./data/buttonimage/fans_off.png' alt='off'/><br>");
     }
     //if on
   if ($status[0] == 1 ) {
     echo ("<img id='fan_button' src='./data/buttonimage/fans_on.png' alt='on'/><br>");
   }

//Relay 1: Lights. WPi Code: 6. Recepticle 1.
  $i = 6; //This is the WPi pin code, for GPIO. Not BCM pin number.
  $status = array(-1);
  unset($status);
  system("gpio mode ".$i." out");
  exec("gpio read ".$i, $status);

  if ($status[0] == 0 ) {
    echo ("<img id='lights_button' src='./data/buttonimage/lights_off.png' alt='off'/><br>");
    }
    //if on
  if ($status[0] == 1 ) {
    echo ("<img id='lights_button' src='./data/buttonimage/lights_on.png' alt='on'/><br>");
  }

//Relay 0: Heater. WPi Code: 1. Recepticle 2.
  $i = 1; //This is the WPi pin code, for GPIO. Not BCM pin number.
  $status = array(-1);
  unset($status);
  system("gpio mode ".$i." out");
  exec("gpio read ".$i, $status);

  if ($status[0] == 0 ) {
    echo ("<img id='heater_button' src='./data/buttonimage/heaters_off.png' alt='off'/><br>");
    }
    //if on
  if ($status[0] == 1 ) {
    echo ("<img id='heater_button' src='./data/buttonimage/heaters_on.png' alt='on'/><br>");
  }

//Relay 1: Heater. WPi Code: 5. Recepticle 2.
  $i = 5; //This is the WPi pin code, for GPIO. Not BCM pin number.
  $status = array(-1);
  unset($status);
  system("gpio mode ".$i." out");
  exec("gpio read ".$i, $status);

  if ($status[0] == 0 ) {
    echo ("<img id='pumps_button' src='./data/buttonimage/pumps_off.png' alt='off'/><br>");
    }
    //if on
  if ($status[0] == 1 ) {
    echo ("<img id='pumps_button' src='./data/buttonimage/pumps_on.png' alt='on'/><br>");
  }
?>
