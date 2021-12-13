<?php

include_once("../DAO/AventurierDAO.php");

$avent = AventurierDAO::get($_GET['id']);

echo json_encode($avent);

