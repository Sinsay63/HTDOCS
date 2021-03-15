<?php

class ArticleDTO{
    private $idArticle;
    private $titre;
    private $dateParution;
    private $content;
    
    
    function getIdArticle(){
        return $this->idArticle;
    }
    
    function getTitre(){
        return $this->titre;
    }
    
    function getDateParution(){
        return $this->dateParution;
    }
    
    function getContent(){
        return $this->content;
    }
    
    
    
    function setIdArticle($idArticle){
        $this->idArticle=$idArticle;
    }
    
    function setTitre($titre){
        $this->titre=$titre;
    }
    
    function setDateParution($dateparu){
        $this->dateParution=$dateparu;
    }
    
    function setContent($content){
        $this->content=$content;
    }
    
}

