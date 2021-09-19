<html>
    <head>
    </head>
    <body>
        <div class="top">
            <?php
            if (empty($_SESSION['ID']) && $_GET['page'] != 'connexion') {
                ?>
                <div class="btn_connex">
                    <a href="index.php?page=connexion"><button type="button">Se connecter</button></a>
                </div>
                <?php
            } else {
                ?>
                <div class="connecté">
                    <?php
                    require_once("pages/connexion/ControllerConnexion.php");
                    $info_hunter = ControllerConnexion::GetUserInfo($_SESSION['ID']);
                    echo 'Bonjour,<br> ';
                    echo 'Vous êtes connecté en tant que ' . $info_hunter->getPseudo() . '.';
                    ?>

                </div>
                <?php
            }
            ?>

        </div>
    </div>

