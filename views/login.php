<?= $header ?>
<?php 

if(!empty($_SESSION['message']))
{
    echo '<h3>'.$_SESSION['message'].'</h3>';
} 
if(!empty($_SESSION['erreur']))
{
    var_dump($_SESSION['erreur']);
} 
?>
<h2>Login</h2>
<p>
    Connectez-vous !
</p>
<form action="loginService" method="post">
    <div class="form-group">
        <label>Username</label>
        <input class="form-control" type="text" name="username" value=""/>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" type="password" name="password" value="" />
    </div>

    <button class="btn btn-primary" type="submit">Login</button>

</form>

<h2>Register</h2>
<p>
    Vous n'êtes pas encore inscrit? Inscrivez-vous maintenant c'est gratuit !
</p>
<form action="registerService" method="post">
    <div class="form-groups">
        <label>Username</label>
        <input class="form-control" type="text" name="username" value="" />
    </div>
    <div class="form-groups">
        <label>password</label>
        <input class="form-control" type="text" name="password" value="" />
    </div>
    <div class="form-groups">
        <label>Confirm password</label>
        <input class="form-control" type="text" name="confpword" value="" />
    </div>
    <div class="form-groups">
        <label>email</label>
        <input class="form-control" type="text" name="email" value="" />
    </div>
    <button class="btn btn-primary" type="submit">S'enregistrer</button>
</form>
<?= $footer ?>