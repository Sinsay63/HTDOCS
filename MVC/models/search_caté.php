<?php
    $caté=$bdd->prepare('select * from catégories');
    $caté->execute(array());
    $catégorie=$caté->fetchAll();
