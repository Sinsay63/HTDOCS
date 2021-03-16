
<?php
session_start();
require ('models/connexion.php');
require('view/header.php');
require('models/search_all_posts.php');
$resultes=search_all_post($bdd);
require('view/list_posts.php');
require('view/footer.php');

