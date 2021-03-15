<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /*
        require('Moto.php');
        $tab=[];
        for($i=0;$i<1000;$i++){
            $tab[$i]= new Moto();
        }
        
        require('Scooter.php');
        $yamaha= new Scooter();
        $yamaha->démarrer();
        echo '<br>';
        $yamaha->accelerer();
        echo '<br>';
        $yamaha->displayCouleur();
        echo '<br>';
        $yamaha->changeCouleur();
        echo '<br>';
        $yamaha->displayCouleur();
        require('Kart.php');
        $kart= new Kart();
        $poids=$kart->getPoids();
        $adhérence=200;
        $kart->setAdhérence($adhérence);
        $adhé=$kart->getAdhérence();
        echo "Le poids est de ".$poids." et l'adhérence est de ".$adhé;
         
        require('Quad.php');
        $couà2 = new Quad(4, "200cc");
        echo "Cylindrée : ".$couà2->getCylyndrée();
        echo '<br>Le nombre de roues motrices est de '.$couà2->getNbRouesMotrices().".";
         */
        require('Trotinette.php');
        Trotinette::addkm(150);
        Trotinette::displayKmParcourus();
        Trotinette::addkm(300);
        Trotinette::displayKmParcourus();
        ?>
    </body>
</html>
