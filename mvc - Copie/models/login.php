<?php
session_start();
  $username = stripslashes($_REQUEST['pseudo']);
  $password = stripslashes($_REQUEST['password']);
  $reponse = $bdd->query("SELECT * FROM auteurs WHERE Pseudo='$username' and Password='$password'");
  $result=$reponse->fetch();
  
  if($result==true){
      $_SESSION['Pseudo'] = $username;
      header("Location: index.php");
  }
  else {
    header("Location: view/form_login.php");
  
  }
