<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>delete</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container"><div>
        <?php
            $dsn = 'mysql:host=localhost;dbname=godefroy';
            $user = 'root';
            $password = '';
            try {
               $bdd = new PDO($dsn,$user,$password);
            }
            catch(PDOException $e)
            {
                    die('erreur : '.$e->getMessage());
            }
            $reponse = $bdd->query('select * from students');
            $results = $reponse->fetchAll();
            foreach ($results as $result) {
                echo $result[0].' - '.$result[1].' - '.$result[2].' - '.$result[3].' - '.$result[4].' - '.$result[5].' - '.$result[6].'<a href="delete2.php" style="padding-left:10px;"> <input type="button" value="Supprimer"> </a> <br><br>';
            }
?>
            </div>
            
            
        </div>
       

    </body>
</html>

