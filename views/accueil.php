<?= $header ?>

<?php
    $bdd = new BddManager();
    $locationRepository = $bdd->getLocationRepository();
    $location = $locationRepository->getAllLocation();
    $imageRepository = $bdd->getImageRepository();
    echo "<section class='loc'>";
    foreach ($location as $loca) {
        
	
        $image = $imageRepository->bddShowImageofLocation($loca["id"]);
        if(count($image) > 0) {
            echo "<div id='slideshow'><a href='location/".$loca['id']."'><p>".$loca["titre"]."</p><p>".$loca["prix"]."</p><p>".$loca["description"]."</p></a>
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