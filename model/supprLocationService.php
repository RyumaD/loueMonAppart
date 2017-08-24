<?php

class supprLocationService{
    public function supprLocations($user,$id){
        $bdd = new BddManager();
        $locationRepository = $bdd->getLocationRepository();
        $locationRepository->supprLocation($user,$id);
    }

}