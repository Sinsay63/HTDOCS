<?php

namespace App\Service;


class SushiService {
    public function  getData(){
        return json_decode(file_get_contents("../assets/contenu.json"),true);
    }

    public function getCarte(){
        $data = $this->getData();
        return $data["carte"];
    }

    public function getProduits(){
        return json_encode($this->getCarte()["produits"]);
    }

    public function getAvis(){
        $data = $this->getData();
        return json_encode($data["avis"]);
    }

    public function getContact(){
        $data = $this->getData();
        return json_encode($data["contact"]);
    }
}