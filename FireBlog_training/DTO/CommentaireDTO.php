<?php

class CommentaireDTO {

    private $id_commentaire;
    private $pseudo;
    private $date_parution;
    private $contenu;
    private $id_article;

    function getId_commentaire() {
        return $this->id_commentaire;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getDate_parution() {
        return $this->date_parution;
    }

    function getContenu() {
        return $this->contenu;
    }

    function getId_article() {
        return $this->id_article;
    }

    function setId_commentaire($id_commentaire) {
        $this->id_commentaire = $id_commentaire;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setDate_parution($date_parution) {
        $this->date_parution = $date_parution;
    }

    function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    function setId_article($id_article) {
        $this->id_article = $id_article;
    }

}
