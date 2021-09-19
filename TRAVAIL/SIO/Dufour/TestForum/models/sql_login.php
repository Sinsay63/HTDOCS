<?php
session_start();
if (isset($_POST['username'])){
  $username = stripslashes($_REQUEST['username']);
  $password = stripslashes($_REQUEST['password']);
  $reponse = $bdd->query("SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256',$password)."'");
  $result=$reponse->fetch();
  
  if($result==true){
      $_SESSION['username'] = $username;
      header("Location: connecté.php");
  }
  else {
    header("Location: view/login_failed.php");
  
  }
}
