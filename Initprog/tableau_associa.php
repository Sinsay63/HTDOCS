<?php

$list=[["Michel "," Dupont ",28],["Thierry"," Martin ",48]];

for ($i=0;$i<count($list);$i++) {
      
    for ($j=0;$j<count($list[$i]);$j++){
        echo $list[$i][$j];
    }
    echo '<br>';
}

?>