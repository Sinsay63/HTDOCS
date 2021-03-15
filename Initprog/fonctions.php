<?php
$somme=20;
$list_achat=[11,3,4,2];
$cumul_achat= somme_achat($list_achat);
 
 if ($cumul_achat > $somme) {
     $tot=$cumul_achat - $somme;
     echo 'Il te manque '.$tot." euros.";
             
 }
 elseif ($cumul_achat == $somme) {
     echo "Tu n'as plus d'argents.";
 
}
else {
    $tot= $somme - $cumul_achat;
    echo 'Il te reste '.$tot." euros.";
}
 



function somme_achat($list_achat) { 
     $res=0;
     foreach ($list_achat as $value) {
         $res=$res + $value;
     }
     return $res; 
 } 



  