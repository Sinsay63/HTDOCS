<?php
require('header.php');

$connex= new PDO('mysql:host=localhost; dbname=hero; charset=utf8','root','');

$éno=$_GET['éno'];
if(isset($_GET['éno'])){
    if($_GET['éno']==0){?>
        <p>Vous avez terminé votre histoire, <a href="navigation.php?éno=1"> cliquez-ici</a> pour recommencer</p>
    <?php
    }
    else{
        $debut=$connex->prepare('SELECT éno.enoncé,ch.choix,ch.ID_énoncés from énoncés as éno, choix as ch, énoncés_choix as éno_ch where éno.ID = ? and éno_ch.ID_énoncés = éno.ID and ch.ID = éno_ch.ID_choix ');
        $debut->bindParam(1, $éno);
        $debut->execute();
        $start=$debut->fetchAll();

        echo $start[0][0]; ?>
        <p> Choix 1: <a href="navigation.php?éno=<?php echo $start[0][2]; ?>"><?php echo $start[0][1]; ?></a></p>
        <p> Choix 2: <a href="navigation.php?éno=<?php echo $start[1][2]; ?>"><?php echo $start[1][1]; ?></a></p>
        <?php    
    }
}
require('footer.php');