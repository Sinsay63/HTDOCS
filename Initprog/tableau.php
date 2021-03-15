<?php

$P=0;
$A=0;

$liste_nombre=["P","P","A","P","A","P","P","P"];

for ($i=0;$i<count($liste_nombre);$i++) 
{
   if ($liste_nombre[$i]=="P") {
       $P++;
   }
 else {
       $A++;
   }
 
}
$nbtotal=$P+$A;
echo "Le nombre d'absent est de ".$A.". <br>";
echo "Le nombre de présent est de ".$P.". <br>";
echo "Le nombre total est de ".$nbtotal.". <br>";

