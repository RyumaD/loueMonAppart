<?= $header ?>

<?php 
    $bdd = new BddManager();;
    $favorisRepository = $bdd->getFavorisRepository();
    $favoris = $favorisRepository->getMyFavoris();
    $array = [];
    $i = 0;
    foreach ($favoris as $favory) {
        if (!in_array($favory['location_id'], $array)) {
            
            echo"<form action='supprFavorisService' method='POST'>
                <input type='hidden' name='id' value='".$favory["location_id"]."'>
                <input type='submit' value='X'>
            </form>";
        
            $array[$i] = $favory['location_id'];
            $i++;
            var_dump($favory);
            echo "<br><br>";
        }
    }
    
?>

<?= $footer ?>