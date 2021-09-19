<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
    <body>
        <?php 
        session_start();
        if ($oui==1){
            $message="L'email ou le pseudo est déjà existant.";
        }
        else if($oui==2){
            $message="L'email saisie est incorrecte.";
        }
        else{
            header('location: register.php');
        }
?>
        <form class="box" action="after_inscri.php" method="post">
            <h1 class="box-logo box-title"><a href="../index.php">Accueil</a></h1>
            <h1 class="box-title">S'inscrire</h1>
            <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
            <input type="text" class="box-input" name="email" placeholder="Email" required />
            <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
            <input type="submit" name="submit" value="S'inscrire" class="box-button" />
            <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
            <p class="errorMessage"><?php echo $message; ?></p>
        </form>
    </body>
</html>
