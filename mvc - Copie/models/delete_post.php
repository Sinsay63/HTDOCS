<?php
        function delete($bdd){
            $reponse = $bdd->prepare('delete from articles where id= ?');
            $reponse->execute(array($_GET['id']));
            
        }
?>