<?php

class BddManager{
    private $userRepository;
    private $locationRepository;
    private $imageRepository;
    private $commentaireRepository;

    public function setUserRepository($userRepository){
        $this->UserRepository = $userRepository;
    }
    public function getUserRepository(){
        return $this->UserRepository;
    }
    public function setLocationRepository($locationRepository){
        $this->LocationRepository = $locationRepository;
    }
    public function getLocationRepository(){
        return $this->LocationRepository;
    }
    public function setImageRepository($imageRepository){
        $this->ImageRepository = $imageRepository;
    }
    public function getImageRepository(){
        return $this->ImageRepository;
    }
    public function setCommentaireRepository($commentaireRepository){
        $this->CommentaireRepository = $commentaireRepository;
    }
    public function getCommentaireRepository(){
        return $this->CommentaireRepository;
    }

    public function __construct(){
        $this->connexion = Connexion::getConnexion();
        $this->setUserRepository(new UserRepository($this->connexion));
        $this->setLocationRepository(new LocationRepository($this->connexion));
        $this->setImageRepository(new ImageRepository($this->connexion));
        $this->setCommentaireRepository(new CommentaireRepository($this->connexion));
    }

    
    
}