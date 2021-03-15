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
                    echo $result['Pseudo'].' - '.$result['titre'].' - '.$result['description']; 
                    if($_SESSION['Pseudo'] == $result['Pseudo']){
                        echo '<a style="padding-left:15px;" href="index.php?page=delete&id='.$result['id'].'">delete</a><br>';
                    }  
                    else{
                        echo '<br><br>'; 
                    }
                }
            }
            else{
                foreach ($resultes as $result) {
                    echo $result['Pseudo'].' - '.$result['titre'].' - '.$result['description']."<br><br>";   
                }  
            }
            ?>
         </label>
    </body>
</html>