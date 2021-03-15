<?php

class ArticleDAO{
    
    static function getArticleById($idarticle){
        $bdd= DataBaseLinker::getConnexion();

        $repons=$bdd->prepare("SELECT * from article WHERE idArticle = ? ");
        $repons->execute(array($idarticle));
        $art=$repons->fetchAll();
        
        $articleDTO= new ArticleDTO();
        
        foreach ($art as $value) {
            
        $articleDTO->setIdArticle($value[0]);
        $articleDTO->setTitre($value[1]);
        $articleDTO->setDateParution($value[2]);
        $articleDTO->setContent($value[3]);
        }
        return $articleDTO;
    }
    static function getArticles(){
        $bdd= DataBaseLinker::getConnexion();

        $repons=$bdd->prepare("SELECT * from article ");
        $repons->execute(array());
        $art=$repons->fetchAll();
        return $art;
    }
    static function getCommentairesByArticle($idart){
        $bdd= DataBaseLinker::getConnexion();

        $rep=$bdd->prepare("SELECT com.pseudo,com.dateParution,com.content from article as art,commentaire as com where art.idArticle = ? and art.idArticle = com.idArticle");
        $rep->execute(array($idart));
        $allcom=$rep->fetchAll();
        return $allcom;
    }
}
