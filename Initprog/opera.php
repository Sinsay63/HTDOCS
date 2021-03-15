
<?php 
//Variables:
$a=3;
$b=5;
$operation= "+";
$c=NULL;

if ($operation== "+") {
    $c=$a+$b;
}

else if ($operation == "-") {
    $c=$a-$b;
}

else if ($operation =="*") {
    $c=$a*$b;
}

else if ($operation =="/") {
    $c=$a/$b;
}

else {
    echo 'Code opération erroné';
}

if ($c !=NULL) {
    echo 'Le résultat de '.$operation.' est '.$c;
}
?> 