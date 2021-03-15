<?php

$a=2;
$b=4;

$operation= new Operation;
$c=$operation->add($a,$b);
$d=$operation->multiply($a,$b);

echo $c.$d;


class Operation {
    
    public function add($a,$b) {
        return$a+$b;
}
    public function multiply($a,$b){
    
        return $a*$b;
}
}