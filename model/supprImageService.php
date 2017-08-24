<?php

class supprImageService{
    public function supprImageLocation($name,$id){
        $bdd = new BddManager();
        $imageRepository = $bdd->getImageRepository();
        $imageRepository->supprImage($name,$id);
    }

}
    
    
   