<html>
    <head>
        <title>init_prog2</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" media="all"/>
    </head>
    <body>
        <header>
        <h1 id="titre">Mon site web</h1>
        <nav class="nav">
            <ul class="liens">
                <?php 
                $menu=[["index.php","Accueil"],["index.php?page=1","Articles"],["index.php?page=2","Contact"]];
                foreach ($menu as $value) {
                   echo "<li><a href='".$value[0]."'>".$value[1]."</a></li>";
                   
                } ?>
               
            </ul>
        </nav>
        </header>