<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fireblog </title>
        <link rel="stylesheet" href="css/main.css"/>
    </head>
    <body>
        <div class="page_container">
            <div class="top">
                <h1>FIREBLOG</h1>
            </div>
            <div class="main">
                <p class="">LES ARTICLES</p>
                <?php
                require('DataBaseLinker.php');
                require('DAO/CommentaireDAO.php');
                require('DTO/CommentaireDTO.php');
                require('DAO/ArticleDAO.php');
                require('DTO/ArticleDTO.php');
                $articles=ArticleDAO::getArticles();      
                
                foreach ($articles as $art) { 
                    
                    ?>
                    <div class="article_container">
                        <div class="article">
                            <div class="titre">
                                <p><?php echo $art['titre']; ?> </p>
                            </div>

                            <div class="art_contenu">
                            <p><?phpecho $art['content'];?></p>
                            </div>
                            <div class="date">
                            <p><?php echo "Paru le ".$art['dateParution']; ?></p>
                             </div>
                        </div>
                         <?php
                         $commentaires=ArticleDAO::getCommentairesByArticle($art['idArticle']);
                         if($commentaires!=null){
                            foreach ($commentaires as $com) { 
                                ?>
                            <div class="commentaires">
                                <p><?php echo $com->getContent();?></p>
                                <p>Écrit par <?php echo $com->getPseudo();?></p>
                            </div>
                            <?php  
                            }
                         }
                            ?>
                        <div class="comment_container">
                            <p>Écrivez votre propre commentaire:</p>
                            <form action="" method="post">
                                    <input id="pseudo_bar" name="pseudo" type="text" placeholder="Entrez votre pseudo" maxlength="20">
                                    <input id="comment_bar" name="commentaire" type="text" placeholder="Entrez votre commentaire" maxlength="60">
                                    <input type="hidden" name="<?php echo $_POST['idArticle'];?>">
                                    <div class="submit"><input id="btn_envoi" type="submit" value="Envoyer"></div>
                            </form>
                        </div>
                    </div>
                    <?php
                    
                }
                if(isset($_POST['pseudo'])&& isset($_POST['commentaire'])){
                        $commentaireDTO= new CommentaireDTO();
                        $commentaireDTO->setPseudo($_POST['pseudo']);
                        $commentaireDTO->setContent($_POST['commentaire']);
                        $commentaireDTO->setIdArticle($_POST['idArticle']);
                        CommentaireDAO::insertCommentaire($commentaireDTO);
                    }
                ?>
            </div>
        </div>
    </body>
</html>
