<?php
    $reponse = $bdd->prepare('select aut.Pseudo, art.titre, art.description, art.id, art.ID_auteur from auteurs as aut inner join articles as art on aut.id = art.id_auteur ');
    $reponse->execute(array());
    $resultes = $reponse->fetchAll();
    ?>
