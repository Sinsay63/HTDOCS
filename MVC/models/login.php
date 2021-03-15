<?php
    $username = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    
    $reponse = $bdd->prepare("SELECT * FROM auteurs WHERE Pseudo=? and Password= ?");
    $reponse->execute(array($username,hash('sha1',$password)));
    $result = $reponse->fetch();

    if($result){
        $_SESSION['Pseudo'] = $result['Pseudo'];
        $_SESSION['id'] = $result['ID'];
        header("Location: index.php?page=accueil");
    }
    else {
        header("Location: index.php?page=to_connexion");
    }

