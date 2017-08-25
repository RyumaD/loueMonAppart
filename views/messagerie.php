<?= $header ?>
<?php
    $bdd = new BddManager();
    $userRepository = $bdd->getUserRepository();
    $user = $userRepository->getIdUser();
    $messagerieRepository = $bdd->getMessagerieRepository();
    $message = $messagerieRepository->showUserForMessage($user["id"]);
    $i=0;
    $array = [];
    foreach ($message as $messages) {
        if($messages['exped_id'] == $user["id"]){
            $other = $userRepository->getUserById($messages['desti_id']);
            $flag = true;
        }
        else{
            $other = $userRepository->getUserById($messages['exped_id']);
            $flag = false;
        }
        if (!in_array($other, $array)) {
            $array[$i] = $other;
            $i++;
            if($flag == true){
                echo "<a href='message/".$messages['desti_id']."'>";
                var_dump($other);
                echo '</a><br><br>';
            }
            else{
                echo "<a href='message/".$messages['exped_id']."'>";
                var_dump($other);
                echo '</a><br><br>';
            }
        }
    }
    
        
?>
<?= $footer ?>