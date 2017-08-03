<?= $header ?>

<?php 
    if(!empty($_SESSION['user']))
    {
        var_dump($_SESSION['user']);
    }
?>
<h1>Tu ne maudira point jeune fêlon</h1>

<?= $footer ?>