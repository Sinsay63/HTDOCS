<?php   
        if(isset($_SESSION['Pseudo'])){
                $reponse = $bdd->prepare('delete from articles where id= ? and ID_auteur= ?');
                $reponse->execute(array($_GET['id'],$_SESSION['id']));
                
                $repon = $bdd->prepare('delete from articles_catégories where ID_Articles= ?');
                $repon->execute(array($_GET['id']));
            }
?>