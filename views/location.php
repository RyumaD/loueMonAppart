<?= $header ?>
    <?php
        $bdd = new BddManager();
        $locationRepository = $bdd->getLocationRepository();
        $imageRepository = $bdd->getImageRepository();
        $commentaireRepository = $bdd->getCommentaireRepository();
        $location = $locationRepository->getLocationById($id);
        $image = $imageRepository->bddShowImageofLocation($id);
        $comment = $commentaireRepository->showCommentofLocation($id);
        $userRepository = $bdd->getUserRepository();
        $user = $userRepository->getIdUser();
        
        var_dump($location);  
        if(count($image) > 0) {
            foreach ($image as $images) {
                echo "<pre>";
                var_dump($images["image"]);
                echo "</pre>";
            }
        }
        echo"<form action='../commentaireService' method='POST'>
                <input type='hidden' name='id' value='".$id."'>
                <input type='text' name='comment'>
                <input type='submit' value='Comment'>
            </form>";
        if(count($comment) > 0) {
            foreach ($comment as $comments) {
                if($user["id"] == $comments["user_id"]){
                    echo"<form action='../supprCommentService' method='POST'>
                            <input type='hidden' name='date' value='".$comments["datecreate"]."'>
                            <input type='hidden' name='id' value='".$comments["location_id"]."'>
                            <input type='hidden' name='comment' value='".$comments["comment"]."'>
                            <input type='submit' value='X'>
                        </form>";
                    echo"<form action='../updCommentService' method='POST'>
                            <input type='hidden' name='date' value='".$comments["datecreate"]."'>
                            <input type='hidden' name='id' value='".$comments["location_id"]."'>
                            <input type='hidden' name='comment' value='".$comments["comment"]."'>
                            <input type='submit' value='Modify'>
                            <input type='text' name='new'>
                        </form>";
                }
                var_dump($comments);
            }
        }
        echo"<form action='../favorisService' method='POST'>
                <input type='hidden' name='id' value='".$id."'>
                <input type='submit' value='<3'>
            </form>";
        if($user["id"] != $location[0]['user_id']){ 
            echo"<form action='../messageService' method='POST'>
                    <input type='hidden' name='id' value='".$location[0]['user_id']."'>
                    <input type='text' name='message'>
                    <input type='submit' value='Send'>
                </form>";
        }
    ?>
<?= $footer ?>