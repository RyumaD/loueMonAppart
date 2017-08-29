<?= $header ?>

<?php
    $bdd = new BddManager();
    $locationRepository = $bdd->getLocationRepository();
    $location = $locationRepository->getAllLocation();
    $imageRepository = $bdd->getImageRepository();
    echo "<section class='loc'>";
    foreach ($location as $loca) {
        
	
        $image = $imageRepository->bddShowImageofLocation($loca["id"]);
        if(count($image) > 2) {
            echo "<div id='slideshow'><a href='location/".$loca['id']."'><br><p>Titre : ".$loca["titre"]."</p><br><p>Prix : ".$loca["prix"]." par jour</p><br><p> Description : ".$loca["description"]."</p></a>
                    <ul id='sContent'> ";
            foreach ($image as $images) {
                $img = $images["image"];
                echo "<li><img src='images/".$img."'></li>";
                
            }
        }
        
        echo "</ul></div>";
        
    }
    
    echo "</section>";
?>



<?= $footer ?>