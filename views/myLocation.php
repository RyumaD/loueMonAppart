<?= $header ?>

<?php 

    if(!empty($_SESSION['user']))
    {
        var_dump($_SESSION['user']);
    }
    else{
        die("<h1>Die insecte!</h1>");
    }
    $bdd = new BddManager();
    $locationRepository = $bdd->getLocationRepository();
    $imageRepository = $bdd->getImageRepository();
    $commentaireRepository = $bdd->getCommentaireRepository();
    $location = $locationRepository->getMyLocation();
    foreach ($location as $loca){
        $image = $imageRepository->bddShowImageofLocation($loca["id"]);
        $comment = $commentaireRepository->showCommentofLocation($loca["id"]);
        echo"<form action='supprLocationService' method='POST'>
                <input type='hidden' name='user_id' value='".$loca["user_id"]."'>
                <input type='hidden' name='id' value='".$loca["id"]."'>
                <input type='submit' value='X'>
            </form>";
        echo "<pre>";
        var_dump($loca);
        echo"<form action='commentaireService' method='POST'>
                <input type='hidden' name='user_id' value='".$loca["user_id"]."'>
                <input type='hidden' name='id' value='".$loca["id"]."'>
                <input type='text' name='comment'>
                <input type='submit' value='Comment'>
            </form>";
        echo "</pre>";
        echo"<form enctype='multipart/form-data' method='post' action='imageService'>
                <input name='file' type='file'>
                <input type='hidden' name='id' value='".$loca['id']."'>
                <input type='submit' value='Ajouter'>
            </form>";

        if(count($image) > 0) {
            foreach ($image as $images) {
                echo"<form action='supprImageService' method='POST'>
                        <input type='hidden' name='image' value='".$images["image"]."'>
                        <input type='hidden' name='id' value='".$images["location_id"]."'>
                        <input type='submit' value='X'>
                    </form>";
                echo "<pre>";
                var_dump($images["image"]);
                echo "</pre>";
            }
        }
        if(count($comment) > 0) {
            foreach ($comment as $comments) {
                echo"<form action='supprCommentService' method='POST'>
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
                    </form>";
                var_dump($comments);
            }
        }
    }
    
?>

<h1>Creez votre annonce de location dès maintenant!</h1>
<form action="addLocation" method="POST">
<input type="submit" value="Creez">
</form>

<?= $footer ?>