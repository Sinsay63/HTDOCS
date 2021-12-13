<?php

require('../DAO/AventurierDAO.php');
$data = json_decode(file_get_contents("php://input"), true);

$aventurier = AventurierDAO::get($data["idAventurier"]);

if ($aventurier != null) {
    $aventurier->setDateNaissance($data['dateNaissance']);
    AventurierDAO::update($aventurier);
}

