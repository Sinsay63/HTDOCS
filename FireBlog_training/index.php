
<?php
require('DAO/ArticleDAO.php');
require('DAO/CommentaireDAO.php');
require('tools/DataBaseLinker.php');
require('DTO/CommentaireDTO.php');
require('DTO/ArticleDTO.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div style="display:flex; flex-wrap: wrap">
            <?php
            $articles = ArticleDAO::getArticles();
            if ($articles != null) {
                foreach ($articles as $article) {
                    ?>
                    <div style="margin-right:25px;">
                        <div> <?php echo 'Titre: ' . $article->getTitre(); ?></div>
                        <div> <?php echo 'Contenu: ' . $article->getContent() ?></div>
                        <div> <?php echo 'Date de parution: ' . $article->getDate(); ?></div>
                        <div>
                            <?php
                            $commentaires = ArticleDAO::getCommentairesByIdArticle($article->getId());
                            if ($commentaires != null) {
                                foreach ($commentaires as $commentaire) {
                                    ?>
                                    <div>
                                        <div> <?php echo 'Pseudo: ' . $commentaire->getPseudo() ?></div>
                                        <div> <?php echo 'Commentaire: ' .$commentaire->getContenu() ?></div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo 'Aucun article nr\'a été trouvé.';
            }
            ?>
        </div>
    </body>
</html>
