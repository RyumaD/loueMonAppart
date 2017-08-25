<?php

class messageService{
    
    public function addMessageToUser(){
        $id = $_POST["id"];
        $message = $_POST["message"];
        $bdd = new BddManager();
        $messagerieRepository = $bdd->getMessagerieRepository();
        $messagerieRepository->AddMessage($id,$message);
    }
}