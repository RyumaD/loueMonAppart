<?= $header ?>

<?php 
    if(!empty($_SESSION['user']))
    {
        var_dump($_SESSION['user']);
    }
?>
<h1>Creez votre annonce de location dès maintenant!</h1>
<form action="addLocation" method="POST">
<input type="submit" value="Creez">
</form>
<a href="myLocation">Mes Locations</a>
<a href="accueil">Accueil</a>
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