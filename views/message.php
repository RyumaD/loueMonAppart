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
    <div class="addloc">
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
    $userRepository = $bdd->getUserRepository();
    $user = $userRepository->getIdUser();
    $messagerieRepository = $bdd->getMessagerieRepository();
    $message = $messagerieRepository->showMessage($id);
    echo"<div id='divmsg'>";
    foreach ($message as $messages){
        $idmsg = $userRepository->getUserById($messages['exped_id']);
        echo "<p>User : ".$idmsg["username"]." // Date : ".$messages['datecreate']."</p><br><p>Message : ".$messages['message']."</p><br><br><br>";


    }
    echo"</div><div id='repmsg'><form action='../messageService' method='POST'>
            <input type='hidden' name='id' value='".$id."'>
            <input type='text' name='message'>
            <input type='submit' value='Send'>
        </form></div>";
    
        
?>
<?= $footer ?>