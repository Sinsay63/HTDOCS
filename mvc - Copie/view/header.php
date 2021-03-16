<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <?php
            if (isset($_SESSION['Pseudo'])){
                echo 'Bonjour '.$_SESSION['Pseudo'];
                echo '<a href="deconnexion.php"><input type="button" value="Déconnexion"></a>';
            }
            else{
            ?>
        <p>Bienvenue sur le site</p>
        <a href="view/form_login.php"><input type="button" value="Connexion"></a>
        <?php
            }
            ?>
        </header>
    </body>
</html>
