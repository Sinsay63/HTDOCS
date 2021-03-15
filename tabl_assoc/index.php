<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $date= date('Y');
            $tab=[];
            $tab[0]=array($date[0],$date[1]);
            $tab[1]=array($date[0],$date[1]);
            foreach ($tab as $value) {
                foreach ($value as $val) {
                    echo $val.'<br>';
                    
                }
            }
            
            ?>
    </body>
</html>
