<?php
include_once("../DAO/CapaciteDAO.php");

$capa= CapaciteDAO::get($_GET['id']);

echo json_encode($capa);

