<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Les aventuriers</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all"/>
        <link rel="icon" type="image/png" href="images/icone.png" />

    </head>
    <body>
        <div class="container-aventuriers">
            <?php
            // permet le chargement automatique des fichiers PHP en fonction du nom de la classe
            include_once("tools/autoloader.php");

            $aventuriers = AventurierDAO::getList();

            foreach ($aventuriers as $aventurier) {
                $prenom = $aventurier->getPrenomAventurier();
                $nom = $aventurier->getNomAventurier();
                $id = $aventurier->getIdAventurier();
                ?>
                <div class="box-aventurier" id="<?php echo $aventurier->getIdAventurier(); ?>">
                    <div class="emplacement-fiche" id="<?php echo $aventurier->getPrenomAventurier() . '_' . $aventurier->getNomAventurier(); ?>"></div>

                    <div class="emplacement-competences">
                    </div>

                    <label class="nom-aventurier"><?php echo $aventurier->getPrenomAventurier() . " " . $aventurier->getNomAventurier(); ?></label>
                    <input type="text" id="birthDate">
                </div>
                <?php
            }
            ?>
        </div>
        <script src="ajax/ajax.js" type="text/javascript"></script>
    </body>
</html>