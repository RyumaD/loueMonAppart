<?php

class updCommentService{
    public function updCommentLocation($comment,$id,$date,$new){
        $bdd = new BddManager();
        $commentaireRepository = $bdd->getCommentaireRepository();
        $commentaireRepository->updComment($comment,$id,$date,$new);
    }

}