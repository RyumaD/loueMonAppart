<?php

class imageService{
    
    
   
    public function addImageLocation(){
        if(isset($_FILES['file'])){ 
            $dossier = 'images/';
            $fichier = basename($_FILES['file']['name']);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
            }
            else
            {
            }
            $id = $_POST["id"];
            $bdd = new BddManager();
            $imageRepository = $bdd->getImageRepository();
            $imageRepository->bddAddImages($_FILES["file"]["name"],$id);
        }
    }
}