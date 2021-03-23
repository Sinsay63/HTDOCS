<?php

Class CommentairesDTO{
    
    private $commentaire;
    private $id_chasseur;
    private $id_wanted;
    
    function getCommentaire() {
        return $this->commentaire;
    }

    function getId_chasseur() {
        return $this->id_chasseur;
    }

    function getId_wanted() {
        return $this->id_wanted;
    }

    function setCommentaire($commentaire): void {
        $this->commentaire = $commentaire;
    }

    function setId_chasseur($id_chasseur): void {
        $this->id_chasseur = $id_chasseur;
    }

    function setId_wanted($id_wanted): void {
        $this->id_wanted = $id_wanted;
    }


    
    
}
