<h1>Liste des avis de recherches</h1>
<?php 
if(!empty($_SESSION['ID'])){
    $wanted= ControllerWanted::SearchAllWanted();
    if($wanted!=null){
        foreach ($wanted as $value) {
            ?>
<div class="box_wanted">
                <div class="avatar"></div>
                <div class="wanted_name">
                    <?php echo $value->getPrénom().' '.$value->getNom(); ?>
                </div>
                <div class="prime">
                    <?php echo $value->getPrime().'$'; ?>
                </div>
                <div class="description">
                    <?php echo $value->getDescription(); ?>
                </div>
            </div>
    <?php
        }
    }
    else{
        echo 'Aucun avis de recherche';
    }
}
else{
    header('location: index.php?page=connexion');
}
?>

