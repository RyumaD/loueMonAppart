<?php

class locationService{

    private $user;
    private $prix;
    private $lieu;
    private $description;
    private $titre;
    private $params;
    private $error;

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;
    }
    function setTitre($titre){ 
        $this->titre = $titre; 
    }
    function getTitre(){ 
        return $this->titre; 
    }
    function setDescription($description){ 
        $this->description = $description; 
    }
    function getDescription(){ 
        return $this->description; 
    }

    function setUser($user){ 
        $this->user = $user; 
    }
    function getUser(){ 
        return $this->user; 
    }
    function setPrix($prix){ 
        $this->prix = $prix;
    }
    function getPrix(){ 
        return $this->prix; 
    }
    function setLieu($lieu){ 
        $this->lieu = $lieu; 
    }
    function getLieu(){ 
        return $this->lieu;
    }
    
    public function launchControls(){
        if(empty($this->params['titre'])){
            $this->error['titre'] = 'Titre manquant';
        }

        if(empty($this->params['description'])){
            $this->error['description'] = 'Description manquante';
        }

        if(empty($this->params['prix'])){
            $this->error['prix'] = 'Prix manquant';
        }

        if(empty($this->params['lieu'])){
            $this->error['lieu'] = 'Lieu manquant';
        }

        if(empty($this->error)==false){
            return $this->error;
        }   
    }
    public function registLocation(){
        $bdd = new BddManager();
        $locationRepository = $bdd->getLocationRepository();
        $locationRepository->registerLocation($this);
    }
}