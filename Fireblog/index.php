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
                    $commentaires=ArticleDAO::getCommentairesByArticle($art['idArticle']);
                    ?>
                    <div class="article_container">
                        <div class="article">
                            <div class="titre">
                            <?php
                                echo $art['titre'];
                            ?>
                            </div>

                            <div class="art_contenu">
                            <?php
                                echo $art['content'];
                            ?>
                            </div>
                            <div class="date">
                            <?php
                                echo "Paru le ".$art['dateParution'];
                            ?>
                            </div>
                        </div>
                         <?php 
                            foreach ($commentaires as $com) { ?>
                            <div class="commentaires">
                                <p><?php echo $com['content'];?></p>
                                <p>Écrit par <?php echo $com['pseudo'];?></p>
                            </div>
                            <?php  
                            }

                            ?>
                        <div class="comment_container">
                            <p>Écrivez votre propre commentaire:</p>
                            <form action="" method="post">
                                    <input id="pseudo_bar" name="pseudo" type="text" placeholder="Entrez votre pseudo" maxlength="20">
                                    <input id="comment_bar" name="commentaire" type="text" placeholder="Entrez votre commentaire" maxlength="60">
                                    <div class="submit"><input id="btn_envoi" type="submit" value="Envoyer"></div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if(isset($_POST['pseudo'])&& isset($_POST['commentaire'])){
                        $commentaireDTO= new CommentaireDTO();
                        $commentaireDTO->setPseudo($_POST['pseudo']);
                        $commentaireDTO->setContent($_POST['commentaire']);
                        $commentaireDTO->setIdArticle($art['idArticle']);
                        CommentaireDAO::insertCommentaire($commentaireDTO);
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
