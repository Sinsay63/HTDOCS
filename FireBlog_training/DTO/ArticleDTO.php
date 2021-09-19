<?php

class ArticleDTO {

    private $id;
    private $date;
    private $content;
    private $titre;

    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getContent() {
        return $this->content;
    }

    function getTitre() {
        return $this->titre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    
    
    
}
