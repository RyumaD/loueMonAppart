<?php

class favorisService{
    
    public function addFavorisForLater(){
        $id = $_POST["id"];
        $bdd = new BddManager();
        $favorisRepository = $bdd->getFavorisRepository();
        $favorisRepository->AddFavoris($id);
    }
}