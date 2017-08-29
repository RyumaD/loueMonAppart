<?= $header ?>

<?php 
    $flag = false;
    if(!empty($_SESSION['user']))
    {
        $flag = true;
    }
    $bdd = new BddManager();;
    $reserveRepository = $bdd->getReserveRepository();
    $reserve = $reserveRepository->getMyReserve();

    foreach ($reserve as $reserves) {
            
            $locationRepository = $bdd->getLocationRepository();
            $imageRepository = $bdd->getImageRepository();
            $commentaireRepository = $bdd->getCommentaireRepository();
            $location = $locationRepository->getLocationById($reserves["vendeur_id"]);
            $image = $imageRepository->bddShowImageofLocation($reserves["vendeur_id"]);
            $comment = $commentaireRepository->showCommentofLocation($reserves["vendeur_id"]);
            echo "<div id='location'>";
            echo"<form action='supprReserveService' method='POST'>
                    <input type='hidden' name='id' value='".$reserves["vendeur_id"]."'>
                    <input type='hidden' name='debut' value='".$reserves["date_debut"]."'>
                    <input type='hidden' name='fin' value='".$reserves["date_fin"]."'>
                    <input type='submit' value='X'>
                </form>";
            if($flag == true){
                $userRepository = $bdd->getUserRepository();
                $user = $userRepository->getIdUser();        
            }
            if(count($image) > 0) {
                echo "<div>";
                foreach ($image as $images) {
                    echo "<img src='images/".$images['image']."'>";
                }
            }
            echo "</div><div><p>Titre : ".$location[0]['titre']."</p><br><p>Prix : ".$location[0]['prix']." par jour </p><br><p>Description : ".$location[0]['description']."</p><br><p>Lieu : ".$location[0]['lieu']."</p><br></div>";
            echo"<div><form action='commentaireService' method='POST'>
                    <input type='hidden' name='id' value='".$reserves["vendeur_id"]."'>
                    <input type='text' name='comment'>
                    <input type='submit' value='Comment'>
                </form></div>";
            if(count($comment) > 0) {
                foreach ($comment as $comments) {
                    if($flag == true){
                        if($user["id"] == $comments["user_id"]){
                            echo"<div><form action='supprCommentService' method='POST'>
                                    <input type='hidden' name='date' value='".$comments["datecreate"]."'>
                                    <input type='hidden' name='id' value='".$comments["location_id"]."'>
                                    <input type='hidden' name='comment' value='".$comments["comment"]."'>
                                    <input type='submit' value='X'>
                                </form>";
                            echo"<form action='updCommentService' method='POST'>
                                    <input type='hidden' name='date' value='".$comments["datecreate"]."'>
                                    <input type='hidden' name='id' value='".$comments["location_id"]."'>
                                    <input type='hidden' name='comment' value='".$comments["comment"]."'>
                                    <input type='submit' value='Modify'>
                                    <input type='text' name='new'>
                                </form></div>";
                        }
                    }
                    $idcom = $userRepository->getUserById($comments['user_id']);
                    echo "<div><p>User : ".$idcom['username']." // Date : ".$comments['datecreate']."</p><br><p>Commentaire : ".$comments['comment']."</p><br>";
                    echo "</div>";
                }
            }
            if($flag == true){            
                if($user["id"] != $location[0]['user_id']){
                    echo"<div><form action='messageService' method='POST'>
                            <input type='hidden' name='id' value='".$location[0]['user_id']."'>
                            Message :
                            <input type='text' name='message'>
                            <input type='submit' value='Send'>
                        </form></div>";
                    echo"<div><p>Votre reservation : </p><p>Debut : ".$reserves['date_debut']."</p><p>Fin : ".$reserves['date_fin']."</p></div>";
                }
            }
            echo "</div>";
    }
?>

<?= $footer ?>