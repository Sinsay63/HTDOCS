<?php

class ArticleDAO{
    
    static function getArticleById($idarticle){
        $bdd= DataBaseLinker::getConnexion();

        $repons=$bdd->prepare("SELECT * from article WHERE idArticle = ? ");
        $repons->execute(array($idarticle));
        $art=$repons->fetchAll();
        
        if($art){
        $articleDTO= new ArticleDTO();
        
        foreach ($art as $value) {
            
        $articleDTO->setIdArticle($value[0]);
        $articleDTO->setTitre($value[1]);
        $articleDTO->setDateParution($value[2]);
        $articleDTO->setContent($value[3]);
        }
        return $articleDTO;
        }
        else{
            return null;
        }
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
        
        if($allcom){
            $tab=[];
        foreach ($allcom as $value) {
            $com= new CommentaireDTO();
            
            $com->setPseudo($value['pseudo']);
            $com->setContent($value['content']);
            $tab[]=$com;
        }
        
        return $tab;
        }
        else{
            return null;
        }
    }
}
