<?= $header ?>

<?php
    $bdd = new BddManager();
    $locationRepository = $bdd->getLocationRepository();
    $location = $locationRepository->getAllLocation();
    foreach ($location as $loca) {
        echo "<br><a href='location/".$loca['id']."'>";
        var_dump($loca);
        echo"</a><br>";
    }
?>

<?= $footer ?>