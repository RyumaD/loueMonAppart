<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= $heading ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="../reset.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
    <h1>Creez votre annonce de location dès maintenant!</h1>
    <form action="addLocation" method="POST">
        <input type="submit" value="Creez">
    </form>
    <nav>
        <a href="login" class="navis">Inscrire/Connexion</a>
        <a href="myLocation" class="navis">Mes Locations</a>
        <a href="accueil" class="navis">Accueil</a>
        <a href="messagerie" class="navis">Messagerie</a>
        <a href="favoris" class="navis">Favoris</a>
        <a href="reservation" class="navis">Reservation</a>
        <a href="deconnexion" class="navis">Exit</a>
    </nav>
<?}
else{?>
    <nav>
        <a href="accueil" class="navis">Accueil</a>
        <a href="login" class="navis">Inscription/Connexion</a>
    </nav>
<?}

if(!empty($_SESSION['message']))
{
    echo '<h3>'.$_SESSION['message'].'</h3>';
} 
if(!empty($_SESSION['erreur']))
{
    foreach ($_SESSION['erreur'] as $valu) {
        echo '<h3 class="erreur">'.$valu.'</h3>';
    }
    
}

