<?php

class CommentaireDTO{
    
    private $idCommentaire;
    private $pseudo;
    private $dateParution;
    private $content;
    private $idArticle;
    
    function getIdCommentaire(){
        return $this->idCommentaire;
    }
    
    function getPseudo(){
        return $this->pseudo;
    }
    
    function getDateParution(){
        return $this->dateParution;
    }
    
    function getContent(){
        return $this->content;
    }
    
    function getIdArticle(){
        return $this->idArticle;
    }
    
    
    
    function setIdCommentaire($idcom){
        $this->idCommentaire=$idcom;
    }
    
    function setPseudo($pseudo){
        $this->pseudo=$pseudo;
    }
    
    function setDateParution($dateparu){
        $this->dateParution=$dateparu;
    }
    
    function setContent($content){
        $this->content=$content;
    }
    
    function setIdArticle($idArticle){
        $this->idArticle=$idArticle;
    }
}