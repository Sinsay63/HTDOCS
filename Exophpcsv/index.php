<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exo csv</title>
    </head>
    <body>
        <p>Début du programme</p>
        <?php
            $file1 = fopen('students.csv','r');
            $nb_ligne=1;
            $nb_erreurstot=0;
            $nbtot=0;
            $données=[];
            while (($data=fgetcsv($file1,1024,';'))!= false){
                $données[$nbtot]=$data;
                $nb_erreurs=0;         
                if (empty($data[0])){
                    echo 'Le nom est obligatoire.<br>';
                    $nb_erreurs++;
                }
                if (empty($data[1])){
                    $nb_erreurs++;
                    echo "L'email est obligatoire.<br>"; 
                }
                if (empty($data[2])){
                    $nb_erreurs++;
                   echo "L'âge est obligatoire.<br>";    
                }
                else if (!is_numeric($data[2])){
                    $nb_erreurs++;
                    echo "La valeur de l'âge est erronée.<br>";   
                }
                else if ($data[2]<0 or $data[2]>120) {
                    $nb_erreurs++;
                    echo "L'âge indiqué n'est pas compris entre 0 et 120.<br>";
                }

                if (empty($data[3])){
                    $nb_erreurs++;
                    echo "La classe est obligatoire.<br>";    
                }
                if (empty($data[4])){
                    $nb_erreurs++;
                    echo 'Le sexe est obligatoire.<br>';    
                }
                else if ($data[4] != 'F' and $data[4] != 'M') {
                    $nb_erreurs++;
                    echo 'Le sexe renseigné est mal indiqué.<br>';
                }

                if (strlen($data[3])>=10) {
                    $nb_erreurs++;
                    echo 'Le nombre de caractères maximal est atteint (10).<br>';
                }
                
                if (!preg_match ("/^.+@.+\.[a-zA-Z]{2,}$/",$data[1])) {
                    $nb_erreurs++;
                    echo "L'adresse mail est invalide.<br>";
                }
                
                if ($nb_erreurs!=0){
                    echo " Il y a ".$nb_erreurs.' erreur(s) à la ligne '.$nb_ligne.".<br>";
                }
                $nb_ligne++;
                $nb_erreurstot=$nb_erreurstot+$nb_erreurs;
                echo '<br>';
                $nbtot++;          
                }
                echo '<br>';
                echo "Le nombre d'erreurs total est de ".$nb_erreurstot.'.<br>';
                
                if ($nb_erreurstot == 0) {
                    echo "Pas d'erreur, on va pouvoir passer à l'enregistrement dans la base de donnéees.<BR>";
                    $dsn = 'mysql:host=localhost;dbname=godefroy';
                    $user = 'root';
                    $password = '';
                    try {
                        $bdd = new PDO($dsn,$user,$password);
                    }
                    catch(PDOException $e) {
                        die('erreur : '.$e->getMessage());
                    }
                    foreach ($données as $ligne) {
                            $reponse = $bdd->prepare('INSERT INTO students(name,mail,age,class,sex) VALUES (?,?,?,?,?)');
                            $reponse->execute(array($ligne[0],$ligne[1],$ligne[2],$ligne[3],$ligne[4]));
                    }
                    }
                else {
                    echo 'Corrigez les erreurs!<br>';
            }  
        ?>

    </body>
</html>