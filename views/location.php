<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../reset.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<?php 
    $flag = false;
    if(!empty($_SESSION['user']))
    {
        $flag = true;
    }
if($flag == true){?>
    
    <nav>
        <a href="../accueil" class="navis">Accueil</a>
        <a href="../myLocation" class="navis">Mes Locations</a>
        <a href="../messagerie" class="navis">Messagerie</a>
        <a href="../favoris" class="navis">Favoris</a>
        <a href="../reservation" class="navis">Reservation</a>
        <a href="../deconnexion" class="navis">Exit</a>
    </nav>
    <div id="addloc">
        <h1>CREEZ VOTRE ANNONCE DES MAINTENANT!</h1>
        <form action="addLocation" method="POST">
            <input type="submit" value="Creez">
        </form>
    </div>
<?}
else{?>
    <nav>
        <a href="../accueil" class="navis">Accueil</a>
        <a href="../login" class="navis">Inscription/Connexion</a>
    </nav>
    <h1 class="addloc">Connectez vous dès maintenant!</h1>
<?}

if(!empty($_SESSION['message']))
{
    echo '<h3 class="reussite">'.$_SESSION['message'].'</h3>';
} 
if(!empty($_SESSION['erreur']))
{
    foreach ($_SESSION['erreur'] as $valu) {
        echo '<h3 class="erreur">'.$valu.'</h3>';
    }
    
}?>
    <?php
        $bdd = new BddManager();
        $locationRepository = $bdd->getLocationRepository();
        $imageRepository = $bdd->getImageRepository();
        $commentaireRepository = $bdd->getCommentaireRepository();
        $location = $locationRepository->getLocationById($id);
        $image = $imageRepository->bddShowImageofLocation($id);
        $comment = $commentaireRepository->showCommentofLocation($id);
        $userRepository = $bdd->getUserRepository();
        echo "<div id='location'>";
        if($flag == true){
            $user = $userRepository->getIdUser();        
            if($user["id"] != $location[0]['user_id']){
                echo"<div><form action='../favorisService' method='POST'>
                        <input type='hidden' name='id' value='".$id."'>
                        <input type='submit' value='<3'>
                    </form></div>";
            }
        }
        if(count($image) > 0) {
            echo "<div>";
            foreach ($image as $images) {
                echo "<img src='../images/".$images['image']."'>";
            }
        }
        echo "</div><div><p>Titre : ".$location[0]['titre']."</p><br><p>Prix : ".$location[0]['prix']." par jour </p><br><p>Description : ".$location[0]['description']."</p><br><p>Lieu : ".$location[0]['lieu']."</p><br></div>";
        if($flag == true){
        echo"<div><form action='../commentaireService' method='POST'>
                <input type='hidden' name='id' value='".$id."'>
                <input type='text' name='comment'>
                <input type='submit' value='Comment'>
            </form></div>";
        }
        if(count($comment) > 0) {
            foreach ($comment as $comments) {
                if($flag == true){
                    if($user["id"] == $comments["user_id"]){
                        echo"<div><form action='../supprCommentService' method='POST'>
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
                echo"<div><form action='../messageService' method='POST'>
                        <input type='hidden' name='id' value='".$location[0]['user_id']."'>
                        Message :
                        <input type='text' name='message'>
                        <input type='submit' value='Send'>
                    </form></div>";
                echo"<div><form action='../reserveService' method='POST'>
                        <input type='hidden' name='id' value='".$id."'>
                        Reservation :
                        <input type='date' name='debut'>
                        <input type='date' name='fin'>
                        <input type='submit' value='Reserve'>
                    </form></div>";
            }
        }
        echo "</div>";

    ?>
<?= $footer ?>