<?= $header ?>

<?php 
    if(!empty($_SESSION['user']))
    {
        var_dump($_SESSION['user']);
    }
    if(!empty($_SESSION['message']))
    {
         var_dump($_SESSION['message']);
    } 
    if(!empty($_SESSION['erreur']))
    {
        var_dump($_SESSION['erreur']);
    }
?>
<h1></h1>
<form action="locationService" method="POST">
    <label>Titre</label><input type="text" name="titre">
    <label>Prix</label><input type="text" name="prix">
    <label>Lieu</label><input type="text" name="lieu">
    <label>Description</label><input type="text" name="description">
    <input type="submit" value="Send">
</form>

<a href="myLocation">Mes Locations</a>
<a href="accueil">Accueil</a>

<?= $footer ?>