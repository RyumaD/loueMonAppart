<?php

class CommentaireRepository{
    
    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }

    public function getMyComment(){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $id = $userRepository->getIdUser();
        $object = $this->connexion->prepare('SELECT * FROM commentairelocation WHERE user_id=:user_id');
        $object->execute(array(
            "user_id"=>$id[0]['id']
        ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function getCommentOnLocation(){
        $bdd = new BddManager();
        $locationRepository = $bdd->getLocationRepository();
    }
    public function addComment($id2,$comment){
        $query = "INSERT INTO commentairelocation SET user_id=:user_id, location_id=:location_id, datecreate=NOW(), comment=:comment";
        $pdo = $this->connexion->prepare($query);
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $locationRepository = $bdd->getLocationRepository();
        $id = $userRepository->getIdUser();
        $pdo->execute(array("user_id"=>$id[0]['id'],
                            "location_id"=>$id2,
                            "comment"=>$comment
        ));                    
        return $pdo->rowCount();
    }
    public function supprComment($comment,$id,$date){
        //unlink("images/$name");
        $query = "DELETE FROM commentairelocation WHERE comment=:comment AND location_id=:location_id AND datecreate=:datecreate";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("comment"=>$comment, "location_id"=>$id, "datecreate"=>$date)); 
    }
    public function showCommentOfLocation($id){
        $object = $this->connexion->prepare('SELECT * FROM commentairelocation WHERE location_id=:location_id');
        $object->execute(array(
            "location_id"=>$id
        ));
        $users = $object->fetchAll();
        return $users;
    }

    public function updComment($comment,$id,$date,$new){
        $query = "UPDATE commentairelocation SET comment=:newcomment WHERE comment=:comment AND location_id=:location_id AND datecreate=:datecreate";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("comment"=>$comment, "location_id"=>$id, "datecreate"=>$date, "newcomment"=>$new)); 
    }

}