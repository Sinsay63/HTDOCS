<?php

function grandeur($x,$y) {
    if ($x > $y){
        return($x);
    }
    else {
     return($y);   
    }
  }
$a=9;
$b=7;

$grand= grandeur($a,$b);

echo 'Le nombre le plus grand est '.$grand.'.';

?>

