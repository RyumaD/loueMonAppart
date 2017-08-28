<?php

class ImageRepository{
    
    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }
    public function bddAddImages($file,$id2){
        $query = "INSERT INTO imagelocation SET user_id=:user_id, image=:image, location_id=:location_id";
        $pdo = $this->connexion->prepare($query);
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $locationRepository = $bdd->getLocationRepository();
        $id = $userRepository->getIdUser();
        $pdo->execute(array("image"=>$file,
                            "user_id"=>$id['id'],
                            "location_id"=>$id2
        ));                    
        return $pdo->rowCount();
    }
    public function bddShowImageOfLocation($id){
        $object = $this->connexion->prepare('SELECT * FROM imagelocation WHERE location_id=:location_id');
        $object->execute(array(
            "location_id"=>$id
        ));
        $users = $object->fetchAll();
        return $users;
    }
    public function supprImage($name,$id){
        //unlink("images/$name");
        $query = "DELETE FROM imagelocation WHERE image=:image AND location_id=:location_id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("image"=>$name, "location_id"=>$id)); 
    }
}