<?= $header ?>

<?php 
    $bdd = new BddManager();;
    $reserveRepository = $bdd->getReserveRepository();
    $reserve = $reserveRepository->getMyReserve();

    foreach ($reserve as $reserves) {
            echo"<form action='supprReserveService' method='POST'>
                <input type='hidden' name='id' value='".$reserves["vendeur_id"]."'>
                <input type='hidden' name='debut' value='".$reserves["date_debut"]."'>
                <input type='hidden' name='fin' value='".$reserves["date_fin"]."'>
                <input type='submit' value='X'>
            </form>";
            var_dump($reserves);
            echo "<br><br>";
    }
?>

<?= $footer ?>