<?php
session_start();
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
    $username = stripslashes($_REQUEST['username']);
    $email = stripslashes($_REQUEST['email']);
    $password = stripslashes($_REQUEST['password']);
    $reponses = $bdd->query("SELECT username,email FROM `users` WHERE username='$username' or email ='$email'");
    $match=$reponses->fetch();
    $oui=0;
    if ($match==true){
        $oui=1;
        $_GET['erreur']=$oui;
    }
    if (!preg_match ( " /^.+@.+.[a-zA-Z]{2,}$/ " , $email )){
        $oui=2;
        $_GET['erreur']=$oui;
    }
    
    else if($oui ==0){
    $reponse = $bdd->prepare('INSERT INTO users(username,email,password) VALUES (?,?,?)');
    $reponse->execute(array($username,$email,hash('sha256',$password)));
      
    if($reponse){?>
       <div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='view/login.php'>connecter</a></p>
       </div>
       <?php
       
    }
    }
}
