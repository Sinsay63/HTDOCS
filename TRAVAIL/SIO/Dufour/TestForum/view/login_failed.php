<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <form class="box" action="after_connecté.php" method="post" name="login">
        <h1 class="box-logo box-title"><a href="../index.php">Accueil</a></h1>
        <h1 class="box-title">Connexion</h1>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion " name="submit" class="box-button">
        <p class="box-register">Vous êtes nouveau ici? <a href="view/register.php">S'inscrire</a></p>
        <p class="errorMessage">Le nom d'utilisateur ou le mot de passe est incorrect.</p>
    </form>
</body>

