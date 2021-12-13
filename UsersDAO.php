<?php

require_once('tools/DataBaseLinker.php');
require_once('DTO/UsersDTO.php');
require_once ('DTO/ClientsDTO.php');

Class UsersDAO {

    static function registerUser($nom, $prénom, $email, $age, $pseudo, $password, $password2) {

        $bdd = DataBaseLinker::getConnexion();


        $state = $bdd->prepare("SELECT pseudo from users where pseudo = ? ");
        $state->execute(array($pseudo));
        $username = $state->fetch();

        $state2 = $bdd->prepare("SELECT email from users where email = ? ");
        $state2->execute(array($email));
        $mail = $state2->fetch();
        $error = 0;

        if (!preg_match(" /^.+@.+.[a-zA-Z]{2,}$/ ", $email)) {
            $error++;
            return 1;
        }

        if ($mail) {
            $error++;
            return 2;
        }
        if ($username) {
            $error++;
            return 3;
        }

        if ($password != $password2) {
            $error++;
            return 4;
        }
        if ($error == 0) {
            $reponse = $bdd->prepare("INSERT INTO users(nom,prenom,pseudo,password,email,age,cagnotte,IsAdmin) VALUES(?,?,?,?,?,?,?,?) ");
            $reponse->execute(array($nom, $prénom, $pseudo, sha1($password), $email, $age, 0, 0));
            return 0;
        }
    }

    static function CheckUsers($pseudo, $password) {

        $bdd = DataBaseLinker::getConnexion();

        $reponse = $bdd->prepare("SELECT * from users where pseudo = ? and password = ? ");
        $reponse->execute(array($pseudo, sha1($password)));
        $users = $reponse->fetch();

        if ($users) {
            $user = new UsersDTO();

            $user->setId($users['Id']);
            $user->setIsAdmin($users['isAdmin']);

            return $user;
        } else {
            return null;
        }
    }

    static function getUserInfo($id) {

        $bdd = DataBaseLinker::getConnexion();

        $reponse = $bdd->prepare("SELECT * from users where Id = ?");
        $reponse->execute(array($id));
        $users = $reponse->fetch();

        if ($users) {
            $user = new UsersDTO();

            $user->setId($users['Id']);
            $user->setNom($users['nom']);
            $user->setPrénom($users['prenom']);
            $user->setPseudo($users['pseudo']);
            $user->setEmail($users['email']);
            $user->setAge($users['age']);
            $user->setCagnotte($users['cagnotte']);
            $user->setIsAdmin($users['isAdmin']);

            return $user;
        }
    }

    static function getInfoClient($id) {
        $bdd = DataBaseLinker::getConnexion();

        $reponse = $bdd->prepare("SELECT * from clients where Id_Users = ? ");
        $reponse->execute(array($id));
        $clients = $reponse->fetch();

        if ($clients != null) {
            $client = new ClientsDTO();

            $client->setAdresse($clients['adresse']);
            $client->setVille($clients['ville']);
            $client->setCp($clients['code_postal']);
            $client->setTelephone($clients['telephone']);

            return $client;
        } else {
            return null;
        }
    }

    static function deleteUser($id) {
        $bdd = DataBaseLinker::getConnexion();

        $reponse = $bdd->prepare("DELETE from users where Id= ? ");
        $reponse->execute(array($id));
    }

    static function modifProfil($idUser, $info, $quoi) {
        $bdd = DataBaseLinker::getConnexion();
        if ($quoi == 'adresse') {
            if (!is_numeric($info[1]) && is_numeric($info[2])) {
                $state = $bdd->prepare("UPDATE clients SET adresse = ?, ville = ?,code_postal =? where Id_Users = ?");
                $state->execute(array($info[0], $info[1], $info[2], $idUser));
            } else {
                return 2;
            }
        } else if ($quoi == 'telephone') {
            if (is_numeric($info)) {
                $state = $bdd->prepare("UPDATE clients SET telephone=? where Id_Users = ?");
                $state->execute(array($info, $idUser));
            } else {
                return 3;
            }
        } else {
            if ($quoi == 'password') {
                $state = $bdd->prepare('SELECT password from users where Id = ?');
                $state->execute(array($idUser));
                $passwd = $state->fetch();

                if ($passwd['password'] != $info[0]) {
                    if ($info[1] != $info[2]) {
                        return 4;
                    }
                    $info = sha1($info[1]);
                }
            }

            if ($quoi == 'email') {
                if (!preg_match(" /^.+@.+.[a-zA-Z]{2,}$/ ", $info)) {
                    return 1;
                }
            }

            $state = $bdd->prepare("UPDATE users SET $quoi = ? where Id = ?");
            $state->execute(array($info, $idUser));
            $insert = $state->fetchAll();
            if ($insert == false) {
                return 5;
            }
        }
        return 0;
    }

    static function getAllUsers() {
        $bdd = DataBaseLinker::getConnexion();

        $state = $bdd->prepare('SELECT * from users where Id != ?');
        $state->execute(array($_SESSION['ID']));
        $users = $state->fetchAll();

        $tab = [];
        foreach ($users as $value) {
            $user = new UsersDTO();

            $user->setPrénom($value['prenom']);
            $user->setNom($value['nom']);
            $user->setPseudo($value['pseudo']);
            $user->setId($value['Id']);

            $stat = $bdd->prepare('SELECT COUNT(Id_Clients) from commandes where Id_Clients = ?');
            $stat->execute(array($value['Id']));
            $cmd = $stat->fetchAll();

            if ($cmd == null) {
                $cmd[0] = 0;
            }
            $tabi = [$user, $cmd[0]];
            $tab[] = $tabi;
        }
        return $tab;
    }

}
