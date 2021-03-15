<?php

$tab=["P","P","R","A","A","P","R","A"];

$eleve= eleves($tab);
$p=$eleve[0];
$r=$eleve[1];
$a=$eleve[2];


echo "Le nombre d'absents est de ".$a.". <br>";
echo "Le nombre de présents est de ".$p.". <br>";
echo "Le nombre de retardataires est de ".$r.". <br>";
  


// echo "Il y a ".$eleve[0]." élèves présents, ".$eleve[1]." élèves en retard et ".$eleve[2]." élèves absents.";
  


function eleves($tab){
        $tab2=[];
        $pre=0;
        $abs=0;
        $ret=0;
    foreach ($tab as $value){
     
       
    if ($value =="P"){
            $pre++;
            
        }
    elseif ($value=="R") {
            $ret++;
            
                
            }
    elseif($value=="A"){
        $abs++;
        
    } 
    
    }
    $tab2[0]=$pre;
    $tab2[1]=$ret;
    $tab2[2]=$abs;
    
   return $tab2;
    }
    
    