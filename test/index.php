<?php
$tab = [["nomProduit" => "Savoyard"],["nomProduit" => "Savoyard"]];
foreach($tab as $ta){
    if(array_search("Savoyard",$ta)){
        echo "oui";
    }
    else{
        echo "non";
    }
}
?>