<?php

class BddManager{
    private $userRepository;
    private $locationRepository;
    private $imageRepository;
    private $commentaireRepository;
    private $messagerieRepository;
    private $favorisRepository;
    private $reserveRepository;

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
    public function setMessagerieRepository($messagerieRepository){
        $this->MessagerieRepository = $messagerieRepository;
    }
    public function getMessagerieRepository(){
        return $this->MessagerieRepository;
    }
    public function setFavorisRepository($favorisRepository){
        $this->FavorisRepository = $favorisRepository;
    }
    public function getFavorisRepository(){
        return $this->FavorisRepository;
    }
    public function setReserveRepository($reserveRepository){
        $this->ReserveRepository = $reserveRepository;
    }
    public function getReserveRepository(){
        return $this->ReserveRepository;
    }

    public function __construct(){
        $this->connexion = Connexion::getConnexion();
        $this->setUserRepository(new UserRepository($this->connexion));
        $this->setLocationRepository(new LocationRepository($this->connexion));
        $this->setImageRepository(new ImageRepository($this->connexion));
        $this->setCommentaireRepository(new CommentaireRepository($this->connexion));
        $this->setMessagerieRepository(new MessagerieRepository($this->connexion));
        $this->setFavorisRepository(new FavorisRepository($this->connexion));
        $this->setReserveRepository(new ReserveRepository($this->connexion));
    }

    
    
}