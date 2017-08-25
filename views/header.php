<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= $heading ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<?php 
    $flag = false;
    if(!empty($_SESSION['user']))
    {
        var_dump($_SESSION['user']);
        $flag = true;
    }
    if(!empty($_SESSION['message']))
    {
        echo '<h3>'.$_SESSION['message'].'</h3>';
    } 
    if(!empty($_SESSION['erreur']))
    {
        var_dump($_SESSION['erreur']);
    } 
if($flag == true){?>
    <h1>Creez votre annonce de location dès maintenant!</h1>
    <form action="addLocation" method="POST">
        <input type="submit" value="Creez">
    </form>
    <a href="myLocation">Mes Locations</a>
    <a href="accueil">Accueil</a>
    <a href="messagerie">Messagerie</a>
    <a href="favoris">Favoris</a>
    <a href="deconnexion">Exit</a>
<?}


