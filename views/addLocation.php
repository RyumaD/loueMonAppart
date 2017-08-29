<?= $header ?>
<div id="ajoutloc">
    <form action="locationService" method="POST">
        <label>Titre</label><input type="text" name="titre">
        <label>Prix</label><input type="text" name="prix">
        <label>Lieu</label><input type="text" name="lieu">
        <label>Description</label><input type="text" name="description">
        <input type="submit" value="Send">
    </form>
</div>



<?= $footer ?>