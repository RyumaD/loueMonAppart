<?= $header ?>
    <?php
        $bdd = new BddManager();
        $locationRepository = $bdd->getLocationRepository();
        $location = $locationRepository->getLocationById($id);
            var_dump($location);
    ?>
<?= $footer ?>