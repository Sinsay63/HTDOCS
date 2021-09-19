<?php

class ArticleDAO {
    

    function getArticleByID($id_art) {

        $bdd = DataBaseLinker::getConnexion();

        $response = $bdd->prepare('SELECT * from article WHERE idArticle = ?');
        $response->execute(array($id_art));
        $art = $response->fetch();

        $article = null;

        if (sizeof($art) > 0) {

            $article = new ArticleDTO();

            $article->setId($art['idArticle']);
            $article->setDate($art['DateParution']);
            $article->setContent($art['content']);
            $article->setTitre($art['titre']);
        }
        return $article;
    }

    static function getArticles() {

        $bdd = DataBaseLinker::getConnexion();

        $response = $bdd->prepare('SELECT * from article');
        $response->execute();
        $articles = $response->fetchAll();

        $list_articles = null;

        if (sizeof($articles) > 0) {
            $list_articles = [];
            foreach ($articles as $art) {
                $article = new ArticleDTO();

                $article->setId($art['idArticle']);
                $article->setDate($art['dateParution']);
                $article->setContent($art['content']);
                $article->setTitre($art['titre']);
                $list_articles[] = $article;
            }
        }
        return $list_articles;
    }

    static function getCommentairesByIdArticle($id_article) {

        $bdd = DataBaseLinker::getConnexion();

        $response = $bdd->prepare('SELECT * from commentaire WHERE idArticle = ?');
        $response->execute(array($id_article));
        $coms = $response->fetchAll();

        $list_commentaires = null;

        if (sizeof($coms) > 0) {
            
            $list_commentaires = [];
            foreach ($coms as $com) {
                
                $commentaire = new CommentaireDTO();

                $commentaire->setId_commentaire($com['idCommentaire']);
                $commentaire->setDate_parution($com['dateParution']);
                $commentaire->setContenu($com['content']);
                $commentaire->setPseudo($com['pseudo']);
                $commentaire->setId_article($com['idArticle']);

                $list_commentaires[] = $commentaire;
            }
        }
        return $list_commentaires;
    }
}
