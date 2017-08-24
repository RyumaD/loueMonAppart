<?php

class Location{

    private $user;
    private $prix;
    private $lieu;
    private $description;
    private $titre;

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
public function __construct($donnees = array())
    {
      $this->hydrate($donnees);
    }

    public function hydrate(array $donneesTableau){
        if(empty($donneesPdo) == false){
            foreach ($donneesTableau as $key => $value){
                $newString=$key;
                if(preg_match("#_#",$key)){
                    $word = explode("_",$key);
                    $newString = "";
                    foreach ($word as $w){
                        $newString.=ucfirst($w);
                    }
                }
                $method = "set".ucfirst($newString);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }
            }
        }
    }
}