<?php

class LocationRepository{
    
    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }
    public function getLocationById($id){
        $object = $this->connexion->prepare('SELECT * FROM location WHERE id=:id');
        $object->execute(array("id"=>$id));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function getAllLocation(){
        $object = $this->connexion->prepare('SELECT * FROM location');
        $object->execute(array());
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function getMyLocation(){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $id = $userRepository->getIdUser();
        $object = $this->connexion->prepare('SELECT * FROM location WHERE user_id=:user_id');
        $object->execute(array(
            "user_id"=>$id[0]['id']
        ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function supprLocation($user,$id){
        $query = "DELETE FROM location WHERE user_id=:user_id AND id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("user_id"=>$user, "id"=>$id));

    }
    public function registerLocation(locationService $reg){
        $query = "INSERT INTO location SET username=:username, titre=:titre, description=:description, lieu=:lieu, prix=:prix, user_id=:user_id";
        $pdo = $this->connexion->prepare($query);
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $id = $userRepository->getIdUser();
        $pdo->execute(array("username"=>$_SESSION['user']['username'],
                            "prix"=> $reg->getParams()['prix'],
                            "titre"=>$reg->getParams()['titre'],
                            "description"=> $reg->getParams()['description'],
                            "lieu"=>$reg->getParams()['lieu'],
                            "user_id"=>$id[0]['id']
        ));                    
        return $pdo->rowCount();
    }
}
