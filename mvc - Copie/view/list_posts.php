<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> 
         <label> 
            <?php 
            if (isset($_SESSION['Pseudo'])){
                foreach ($resultes as $result) {
                echo $result['nom'].' - '.$result['titre'].' - '.$result['description'].'<a style="padding-left:15px;" href="delete.php?id='.$result['id'].'">delete</a><br>';  
            }  
            }
            else{
                foreach ($resultes as $result) {
                    echo $result['nom'].' - '.$result['titre'].' - '.$result['description'];  
                }  
            }
            ?>
         </label>
    </body>
</html>