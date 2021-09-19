    <?php

function getCommentaireByID($id_com) {

    $bdd = DataBaseLinker::getConnexion();

    $response = $bdd->prepare('SELECT * from commentaire WHERE idCommentaire = ?');
    $response->execute(array($id_com));
    $comment = $response->fetch();

    $commentaire = null;
    
    if (sizeof($comment) > 0) {
        
        $commentaire = new CommentaireDTO();

        $commentaire->setId_commentaire($comment['idCOmmentaire']);
        $commentaire->setDate_parution($comment['dateParution']);
        $commentaire->setContenu($comment['content']);
        $commentaire->setPseudo($comment['pseudo']);
        $commentaire->setId_article($comment['idArticle']);
    }
    return $commentaire;
}
