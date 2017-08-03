<?php

class registerService
{

    private $params;
    private $error;
    private $user;


    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function launchControls(){

        if(empty($this->params['username'])){
            $this->error['username'] = 'Nom utilisateur manquant';
        }
        if(empty($this->params['email'])){
            $this->error['email'] = 'Email manquant';
        }
        if(empty($this->params['password'])){
            $this->error['password'] = 'Mot de passe manquant';
        }

        if(empty($this->error)==false){
            return $this->error;
        }

        if(strlen($this->params['username'])<7){
            $this->error['username'] = 'Nom utilisateur trop court';
        }
        if(strlen($this->params['password'])<7){
            $this->error['password'] = 'Mot de passe trop court';
        }
        
        if(empty($this->error)==false){
            return $this->error;
        }

        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $this->user = $userRepository->checkUsername($this);
        if(empty($this->user) == false){
            $this->error['username'] = 'Le nom d\'utilisateur existe deja';
        }
        $this->user = $userRepository->checkEmail($this);
        if(empty($this->user) == false){
            $this->error['email'] = 'L\'email existe deja';
        }
        $email = $userRepository->validateEmail($this);
        if($email == false){
            $this->error['email'] = 'L\'email n\'est pas correct';
        }
        $pass = $userRepository->validatePassword($this);
        if($pass != 0){
            $this->error['password'] = 'les mots de passe ne sont pas equivalent';
        }
        if(empty($this->error)==false){
            return $this->error;
        }
        return $this->user;
    }
    public function registUser(){
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $userRepository->register($this);
    }
}