<?php

class MessagerieRepository{

    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }
    public function showMessage($id){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $user = $userRepository->getIdUser();
        $object = $this->connexion->prepare('SELECT * FROM messagerie WHERE desti_id=:desti_id AND exped_id=:exped_id UNION SELECT * FROM messagerie WHERE desti_id=:desti2_id AND exped_id=:exped2_id ORDER BY `datecreate`');
        $object->execute(array(
            "desti_id"=>$id,
            "exped_id"=>$user['id'],
            "desti2_id"=>$user['id'],
            "exped2_id"=>$id
        ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
    public function showUserForMessage($id){
        $object = $this->connexion->prepare('SELECT * FROM messagerie WHERE desti_id=:desti_id OR exped_id=:exped_id');
        $object->execute(array(
            "desti_id"=>$id,
            "exped_id"=>$id
        ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function supprMessage($comment,$id,$date){
        //unlink("images/$name");
        $query = "DELETE FROM commentairelocation WHERE comment=:comment AND location_id=:location_id AND datecreate=:datecreate";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("comment"=>$comment, "location_id"=>$id, "datecreate"=>$date)); 
    }
    public function updMessage($comment,$id,$date,$new){
        $query = "UPDATE commentairelocation SET comment=:newcomment WHERE comment=:comment AND location_id=:location_id AND datecreate=:datecreate";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("comment"=>$comment, "location_id"=>$id, "datecreate"=>$date, "newcomment"=>$new)); 
    }
    public function addMessage($id2,$message){
        $query = "INSERT INTO messagerie SET exped_id=:exped_id, desti_id=:desti_id, datecreate=NOW(), message=:message";
        $pdo = $this->connexion->prepare($query);
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $locationRepository = $bdd->getLocationRepository();
        $id = $userRepository->getIdUser();
        $pdo->execute(array("exped_id"=>$id['id'],
                            "desti_id"=>$id2,
                            "message"=>$message
        ));                    
        return $pdo->rowCount();
    }

}