<?php

class reserveService{
    
    public function addReserveNow(){
        $id = $_POST['id'];
        $start = $_POST['debut'];
        $end = $_POST['fin'];
        $bdd = new BddManager();
        $reserveRepository = $bdd->getReserveRepository();
        $reserveRepository->addReserve($id, $start, $end);
    }
}