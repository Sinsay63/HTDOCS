<?php

Class ChasseursDTO{
    
    private $id;
    private $nom;
    private $prénom;
    private $pseudo;
    private $password;
    private $birthday;
    private $photo;
    private $admin;
    
    
    function getId() {
        return $this->id;
    }
    function getNom() {
        return $this->nom;
    }

    function getPrénom() {
        return $this->prénom;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getPassword() {
        return $this->password;
    }

    function getBirthday() {
        return $this->birthday;
    }

    function getPhoto() {
        return $this->photo;
    }

    function getAdmin() {
        return $this->admin;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNom($nom): void {
        $this->nom = $nom;
    }

    function setPrénom($prénom): void {
        $this->prénom = $prénom;
    }
    function setPseudo($pseudo): void {
        $this->pseudo = $pseudo;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setBirthday($birthday): void {
        $this->birthday = $birthday;
    }

    function setPhoto($photo): void {
        $this->photo = $photo;
    }

    function setAdmin($admin): void {
        $this->admin = $admin;
    }

    
}

