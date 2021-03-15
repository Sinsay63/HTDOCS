<?php

    $dsn = 'mysql:host=192.168.153.10;dbname=202021_projetmvc_mlarnaudie';
    $user = 'mlarnaudie';
    $password = 'SanSheep2346^^';
    try {
            $bdd = new PDO($dsn,$user,$password);

    }
    catch(PDOException $e)
    {
            die('erreur : '.$e->getMessage());
    }
    ?>
