

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
    $reponse = $bdd->prepare('select * from students where Sex = ?');
    $reponse->execute(array('M'));
    $results = $reponse->fetchAll();
    //var_dump($results);
    foreach ($results as $result) {
            echo $result['Name'].' - '.$result['Mail'].'<BR>';

    }
?>