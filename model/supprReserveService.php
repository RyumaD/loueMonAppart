<?php

class supprReserveService{
    
    public function supprReserveNow(){
        $id = $_POST['id'];
        $start = $_POST['debut'];
        $end = $_POST['fin'];
        $bdd = new BddManager();
        $reserveRepository = $bdd->getReserveRepository();
        $reserveRepository->supprReserve($id, $start, $end);
    }
}