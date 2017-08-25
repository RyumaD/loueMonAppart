<?= $header ?>
<?php
    $bdd = new BddManager();
    $userRepository = $bdd->getUserRepository();
    $user = $userRepository->getIdUser();
    $messagerieRepository = $bdd->getMessagerieRepository();
    $message = $messagerieRepository->showMessage($id);
    foreach ($message as $messages){
        var_dump($messages);
        echo "<br><br>";


    }
    echo"<form action='../addMessageService' method='POST'>
            <input type='hidden' name='id' value='".$id."'>
            <input type='text' name='message'>
            <input type='submit' value='Send'>
        </form>";
    
        
?>
<?= $footer ?>