
<?php 
//Variables:
$a=10;
$b=10;
$operation= "/";
$c=NULL;

switch ($operation) {
case "+":
    $c=$a+$b;
     echo 'Le résultat de '.$operation.' est '.$c;
    break;
case "-":
    $c=$a-$b;
     echo 'Le résultat de '.$operation.' est '.$c;
    break;

case "*":
     $c=$a*$b;
     echo 'Le résultat de '.$operation.' est '.$c;
     break;
 
case "/":
     $c=$a/$b;
     echo 'Le résultat de '.$operation.' est '.$c;
     break;

default:
echo 'Erreur code opération';
}
?>