<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <?php
            if (isset($_SESSION['Pseudo'])){
                ?>
            <div style="margin-bottom:30px;">
                <p>Bonjour <?php echo $_SESSION['Pseudo']; ?></p>
                <a href="index.php?page=deconnexion"><input type="button" value="Déconnexion"></a>
                <a href="index.php?page=to_post"><input type="button" value="Créer un article"></a>
            </div>
                <?php
            }
            else{
            ?>
            <div style="display:flex; margin-bottom:30px;">
                <p style="margin:0; padding-right:25px;">Bienvenue sur le site</p>
                <a href="index.php?page=connexion"><input type="button" value="Connexion"></a>
            </div>
        <?php
            }
            ?>
        </header>
    </body>
</html>
