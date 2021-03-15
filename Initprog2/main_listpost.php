<main>
    <nav class="nav2">
        <div>
            <ul>
                <?php 
                    $post=[["Nom:"],["Dupont"],["Durant"],["Martin"]];
                    foreach ($post as $nom) {
                        echo $nom[0],"<br>";
                    }
                ?>
            </ul>
        </div>
             <div class="arti">
                    <ul>
                   <?php
                      $post2=[["Article:"],["CSS"],["HTML"],["PHP"]];
                      foreach ($post2 as $article) {
                           echo $article[0]."<br>";
                      }
                    ?>
                    </ul>
        </div>
    </nav>
</main>