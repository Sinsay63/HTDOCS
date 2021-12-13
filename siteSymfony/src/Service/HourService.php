<?php

namespace App\Service;

class HourService {


    public function getHour() {
        return date("H:i:s");
    }

}