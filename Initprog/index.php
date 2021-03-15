<html>
   <head>
        <title>TEST PHP</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css"/>
   </head>
        <body>
            <h1 class="entete">Initiation Programmation</h1>
            <br> 
            <div class="centrer">
            <div class="style">Calcul du nombre de filles et de garçons:</div>
            <br> 
    <?php
    // Variables:
    $nb_fille=5;
    $nb_garcon=6;
    $nb_total= $nb_fille+$nb_garcon;
    
    echo 'Le nombre de filles est de '.$nb_fille.'.<br>';
   
    echo 'Le nombre de garçons est de '.$nb_garcon.'.<br><br>';


    echo "Le nombre total est de " .$nb_total,'.';
    ?>
            <br> <br>
           
            <div class="style"> <?php echo'Conclusion: <br><br>';?> </div>
            
        <?php
        if ($nb_fille > $nb_garcon){
            echo 'Le nombre de filles est supérieur au nombre de garçons.';
        }

        else if ($nb_fille == $nb_garcon){
            
            echo 'Le nombre de garçons est égal au nombre de filles.';
        }  
 else {
     echo 'Le nombre de garçons est supérieur au nombre de filles.';
 }
            ?>
            </div>
        </body>
</html>
   