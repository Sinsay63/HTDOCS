<?php

class CommentaireDAO{
    
    static function getCommentaireById($idcommentaire){
        $bdd= DataBaseLinker::getConnexion();

        $repons=$bdd->prepare("SELECT * from commentaire WHERE idCommentaire = ? ");
        $repons->execute(array($idcommentaire));
        $com=$repons->fetchAll();
        
        $commentaireDTO= new CommentaireDTO();
        
        foreach ($com as $value) {
            
        $commentaireDTO->setIdCommentaire($value[0]);
        $commentaireDTO->setPseudo($value[1]);
        $commentaireDTO->setDateParution($value[2]);
        $commentaireDTO->setContent($value[3]);
        $commentaireDTO->setIdArticle($value[4]);
        }
        return $commentaireDTO;
    }
    static function insertCommentaire($commentaireDTO){
        $bdd= DataBaseLinker::getConnexion();
        
        $pseudo=$commentaireDTO->getPseudo();
        $content=$commentaireDTO->getContent();
        $idarticle=$commentaireDTO->getIdArticle();
        
        $repons=$bdd->prepare("INSERT INTO commentaire(pseudo,content,idArticle,dateParution) VALUES(?,?,?,CURDATE()) ");
        $repons->bindParam(1, $pseudo);
        $repons->bindParam(2, $content);
        $repons->bindParam(3, $idarticle);
        $repons->execute();
        if($repons){
            header('location: index.php');
        }
    }
}
