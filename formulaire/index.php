<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>formulaire</title>
    </head>
    <body>
        <form action="form.php" method="post">
        <p>Votre prénom : <input type="text" name="prenom" /></p>
        <p>Votre nom : <input type="text" name="nom" /></p>
        <p>Votre email : <input type="email" name="mail" /></p>
        <p>Votre âge : <input type="integer" name="âge" /></p>
        <p>Votre classe : <select name="classe">
            <option value="">--choisissez votre classe--</option>
            <option value="SIO1">BSIO1</option>
            <option value="SIO2">BSIO2</option>
        </select>
        <p>Votre sexe : <select name="sexe">
            <option value="">--choisissez votre sexe--</option>
            <option value="H">Homme</option>
            <option value="F">Femme</option>
        </select>
        </p>
         <p><input type="submit" value="OK"></p>
        </form>
         
    </body>
</html>
