<?= $header ?>

<?php 
    $bdd = new BddManager();
    $locationRepository = $bdd->getLocationRepository();
    $imageRepository = $bdd->getImageRepository();
    $commentaireRepository = $bdd->getCommentaireRepository();
    $location = $locationRepository->getMyLocation();
    $userRepository = $bdd->getUserRepository();
    $user = $userRepository->getIdUser();
    foreach ($location as $loca){
        $image = $imageRepository->bddShowImageofLocation($loca["id"]);
        $comment = $commentaireRepository->showCommentofLocation($loca["id"]);
        echo"<div id='location'><form action='supprLocationService' method='POST'>
                <input type='hidden' name='user_id' value='".$loca["user_id"]."'>
                <input type='hidden' name='id' value='".$loca["id"]."'>
                <input type='submit' value='X'>
            </form>";
        if(count($image) > 0) {
            echo"<div>";
            foreach ($image as $images) {
                echo"<form action='supprImageService' method='POST' id='supprimg'>
                        <input type='hidden' name='image' value='".$images["image"]."'>
                        <input type='hidden' name='id' value='".$images["location_id"]."'>
                        <input type='submit' value='X'>
                    </form>";
                echo "<img src='images/".$images['image']."'>";
            }
            echo"</div>";
        }
        echo"<div><form enctype='multipart/form-data' method='post' action='imageService'>
                <input name='file' type='file'>
                <input type='hidden' name='id' value='".$loca['id']."'>
                <input type='submit' value='Ajouter'>
            </form></div>";
        echo "<div>";
        echo "<p>Titre : ".$loca['titre']."</p><br><p>Prix : ".$loca['prix']." par jour </p><br><p>Description : ".$loca['description']."</p><br><p>Lieu : ".$loca['lieu']."</p><br>";
        echo"</div><div><form action='commentaireService' method='POST'>
                <input type='hidden' name='id' value='".$loca["id"]."'>
                <input type='text' name='comment'>
                <input type='submit' value='Comment'>
            </form>";
        echo "</div>";
        
        if(count($comment) > 0) {
            foreach ($comment as $comments) {
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
                $idcom = $userRepository->getUserById($comments['user_id']);
                echo "<div><p>User : ".$idcom['username']." // Date : ".$comments['datecreate']."</p><br><p>Commentaire : ".$comments['comment']."</p><br>";
                echo "</div>";
            }
        }
        echo "</div>";
    }
    
?>

<?= $footer ?>