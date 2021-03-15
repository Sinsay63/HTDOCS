<?php
$plus=0;
$moins=0;
$moy=0;
$sommes=0;
$liste_note=[5,12,15,12,12,15]; 
 

for ($i=0;$i < count($liste_note);$i++){
    
    if ($liste_note [$i] >10){
    $plus++;
   
}
if ($liste_note [$i] <10) {
    $moins++;   
}  

$sommes=$sommes + $liste_note[$i];
$moy= $sommes / count($liste_note);
$nbnotes= count($liste_note);        
}
 echo 'Il y a '.$plus.' note(s) supérieure(s) à 10. <br>';
 echo 'Il y a '.$moins.' note(s) inférieure(s) à 10. <br>';
 echo 'La moyenne des '.$nbnotes.' notes est de '.$moy.'.';

?>