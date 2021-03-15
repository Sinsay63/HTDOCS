<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body> 
        <form action="index.php?page=post" method="post">
            <div>
                <label>
                <p>Titre de l'article:</p> 
                <input type="text" name="titre">
                </label>
                <label>
                    <p>Catégories:</p>
                    <?php
                        foreach ($catégorie as $value) { ?>
                            <label>
                                <label for="<?php echo $value['ID'];?>"><?php echo $value['Nom'];?></label>
                                <input type="checkbox" name="catégories[]" value="<?php echo $value['ID']; ?>"><br>
                            </label>
                <?php   } ?>
                </label>
                <label>
                    <p>Description:</p>
                    <input type="text" name="description">
                </label>
                <div>
                    <input type="submit" value="Créer">
                </div>
            </div>
        </form>
    </body>
</html>



