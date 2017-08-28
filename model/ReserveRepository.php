<?php

class ReserveRepository{
    
    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }

    public function addReserve($id2, $start, $end){
        $query = "INSERT INTO reservation SET acheteur_id=:acheteur_id, vendeur_id=:vendeur_id, date_debut=:date_debut,date_fin=:date_fin";
        $pdo = $this->connexion->prepare($query);
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $locationRepository = $bdd->getLocationRepository();
        $id = $userRepository->getIdUser();
        $pdo->execute(array("acheteur_id"=>$id['id'],
                            "vendeur_id"=>$id2,
                            "date_debut"=>$start,
                            "date_fin"=>$end
        ));                    
        return $pdo->rowCount();
    }
    public function getMyReserve(){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $id = $userRepository->getIdUser();
        $object = $this->connexion->prepare('SELECT * FROM reservation WHERE acheteur_id=:acheteur_id');
        $object->execute(array(
            "acheteur_id"=>$id['id']
        ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function supprReserve($id, $start, $end){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $id2 = $userRepository->getIdUser();
        $query = "DELETE FROM reservation WHERE vendeur_id=:vendeur_id AND date_debut=:date_debut AND date_fin=:date_fin";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("vendeur_id"=>$id, "date_debut"=>$start, "date_fin"=>$end)); 
    }
}