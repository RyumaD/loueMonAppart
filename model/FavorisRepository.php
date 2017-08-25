<?php

class FavorisRepository{
    
    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }

    public function addFavoris($id2){
        $query = "INSERT INTO favoris SET user_id=:user_id, location_id=:location_id";
        $pdo = $this->connexion->prepare($query);
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $locationRepository = $bdd->getLocationRepository();
        $id = $userRepository->getIdUser();
        $pdo->execute(array("user_id"=>$id['id'],
                            "location_id"=>$id2
        ));                    
        return $pdo->rowCount();
    }
    public function getMyFavoris(){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $id = $userRepository->getIdUser();
        $object = $this->connexion->prepare('SELECT * FROM favoris WHERE user_id=:user_id');
        $object->execute(array(
            "user_id"=>$id['id']
        ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function supprFavoris($id){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $id2 = $userRepository->getIdUser();
        $query = "DELETE FROM favoris WHERE location_id=:location_id AND user_id=:user_id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("location_id"=>$id, "user_id"=>$id2['id'])); 
    }
}