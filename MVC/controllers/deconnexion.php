<?php
  
  if(session_destroy())
  {
    header("Location: index.php?page=accueil");
  }
?>