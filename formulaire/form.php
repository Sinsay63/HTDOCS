<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>formulaire</title>
    </head>
    <body>
        <?php
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['mail']);
            $âge = htmlspecialchars($_POST['âge']);
            $classe = htmlspecialchars($_POST['classe']);
            $sexe = htmlspecialchars($_POST['sexe']);
            if (empty($prenom)) {
                echo 'Le prénom est obligatoire.';
                    }
            elseif (empty($nom)) {
                echo 'Le nom est obligatoire.';
                    }
            elseif (empty ($email)){
                echo "L'adresse mail est obligatoire.";  
                    }
            elseif (empty ($âge)){
                echo "L'âge est obligatoire."; 
                    }
            elseif (empty ($classe)){
                echo "La classe est obligatoire.";

                    }
            elseif (empty($sexe)) {
                echo 'Le sexe est obligatoire.';
                    }
            else {
            echo '<p>Bonjour</p> '.$prenom.' '.$nom. ' '.$email.' '.$âge.'ans'.' '.$classe.' '.$sexe ;
            }
            $infos=[$prenom,$nom,$email,$âge,$classe,$sexe];
            $dsn = 'mysql:host=localhost;dbname=godefroy';
            $user = 'root';
            $password = '';
            try {
                $bdd = new PDO($dsn,$user,$password);
            }
            catch(PDOException $e) {
                die('erreur : '.$e->getMessage());
            }
            $reponse = $bdd->prepare('INSERT INTO students(prénom,name,mail,age,class,sex) VALUES (?,?,?,?,?,?)');
            $reponse->execute(array($infos[0],$infos[1],$infos[2],$infos[3],$infos[4],$infos[5]));
                    
        ?>
    </body>
</html>
