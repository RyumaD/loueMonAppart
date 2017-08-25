<?php

class supprFavorisService{
    public function supprFavorisForNow($id){
        $bdd = new BddManager();
        $favorisRepository = $bdd->getFavorisRepository();
        $favorisRepository->supprFavoris($id);
    }

}