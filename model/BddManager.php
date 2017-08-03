<?php

class BddManager{
    private $userRepository;

    public function setUserRepository($userRepository){
        $this->UserRepository = $userRepository;
    }

    public function getUserRepository(){
        return $this->UserRepository;
    }

    public function __construct(){
        $this->connexion = Connexion::getConnexion();
        $this->setUserRepository(new UserRepository($this->connexion));
    }

    
    
}