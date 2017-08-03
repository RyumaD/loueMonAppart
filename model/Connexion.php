<?php

class Connexion{
    
    static private $connexion;


    static public function getConnexion(){
        
        if(empty(self::$connexion)){
            self::$connexion= new PDO( "mysql:host=localhost;dbname=loueMonAppart", "root", "root");
            self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        }
        return self::$connexion;
    }

    private function __construct(){

    }
}