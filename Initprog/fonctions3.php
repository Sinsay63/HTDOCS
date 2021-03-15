<?php


$a=5;
$b=7;
$c=12;

$Somme= somme($a, $b, $c);

echo 'La somme est égale à '.$Somme;





function somme($x,$y,$z) {
    
   $somme= $x+$y+$z;
   
   return $somme;
}

?>