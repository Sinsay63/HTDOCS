<?php
if(isset($_POST['description']) && isset($_POST['titre']) && isset($_POST['catégories']) && isset($_SESSION['id'])){

    $description=$_POST['description'];
    $titre=$_POST['titre'];
    $cat=$_POST['catégories'];
    
    $repons = $bdd->prepare('INSERT INTO articles(Titre,Description,ID_auteur,Date_Publication) VALUES (?,?,?,CURRENT_TIMESTAMP)');
    $repons->execute(array($titre,$description,$_SESSION['id']));
    $lastId = $bdd->lastInsertId();
    
    foreach ( $cat as $valeur) {
        $reponse = $bdd->prepare('INSERT INTO articles_catégories(ID_Articles,ID_Catégories) VALUES (?,?)');
        $reponse->execute(array($lastId,$valeur));
}
}