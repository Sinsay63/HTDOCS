<?php

$tab=[2,4,8,5,1,10];

foreach ($tab as $value) {
    foreach ($tab as $valeur){
     
    
    if ($value < $valeur) {
        echo $value;
    }
 else {
        echo 'non';    
    }
   
}
}
