<?php

class Trotinette{
    private static $nbKmParcourus=0;

    static function addkm($nbKilomètres){
        self::$nbKmParcourus+=$nbKilomètres;
    }
    static function displayKmParcourus() {
        echo self::$nbKmParcourus."<br>";
        
    }
}

