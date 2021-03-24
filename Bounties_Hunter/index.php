<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>World Bounty Hunters Agency</title>		
    </head>
    <body>
    <?php
    session_name("oui");
    session_start();
    
        require_once("tools/SuperController.php");
        if(!empty($_GET['page'])) {
            $page = $_GET['page'];
        }
        SuperController::callPage($page);
        if(isset($_SESSION['ID'])){
            require_once("pages/Connexion/ControllerConnexion.php");
            $info_user=ControllerConnexion::GetUserInfo($_SESSION['ID']);
            echo "Bonjour ".$info_user->getPrénom().' '.$info_user->getBirthday();
        }
    ?>		
    </body>
</html>