<?php
    function search_all_post($bdd){
    
    $reponse = $bdd->query('select aut.nom, art.titre, art.description, art.id from auteurs as aut inner join articles as art on aut.id = art.id_auteur ');
    $results = $reponse->fetchAll();
    return $results;
    }
    ?>
