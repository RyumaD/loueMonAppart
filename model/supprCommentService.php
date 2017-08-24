<?php

class supprCommentService{
    public function supprCommentLocation($comment,$id,$date){
        $bdd = new BddManager();
        $commentaireRepository = $bdd->getCommentaireRepository();
        $commentaireRepository->supprComment($comment,$id,$date);
    }

}