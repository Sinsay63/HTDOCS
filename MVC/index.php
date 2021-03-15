<?php
session_start();
if (isset($_GET['page'])){
    $page=$_GET['page'];
    if ($page=='accueil'){
        require('controllers/accueil.php');
    }
    if($page=='connexion'){
        require('controllers/to_connexion.php');
    }
    if($page=='deconnexion'){
        require('controllers/deconnexion.php');
    }
    if($page=='connecté'){
        require('controllers/connexion.php');
    }
    if($page=='delete'){
        if(isset($_GET['id'])){
            require('controllers/delete.php');
        }
    }
    if($page=='to_post'){
        require('controllers/to_post.php');
    }
    if($page=='post'){
        require('controllers/crea_post.php');
    }
}
else{
    require('controllers/accueil.php');
}
   


