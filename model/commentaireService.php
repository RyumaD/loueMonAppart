<?php

class commentaireService{
    
    public function addCommentLocation(){
        $id = $_POST["id"];
        $comment = $_POST["comment"];
        $bdd = new BddManager();
        $commentaireRepository = $bdd->getCommentaireRepository();
        $commentaireRepository->AddComment($id,$comment);
    }
}