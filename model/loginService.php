<?php

class loginService
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

        if(empty($this->params['password'])){
            $this->error['password'] = 'Mot de passe manquant';
        }
        if(empty($this->error)==false){
            return $this->error;
        }
        $bdd = new BddManager();
        $userRepository = $bdd->getUserRepository();
        $this->user = $userRepository->checkLogin($this);
        if(empty($this->user)){
            $this->error['identifiants'] = 'Le nom d\'utilisateur ou mot de passe incorrect';
            return $this->error;
        }else{
            return $this->user;
        }
    }
}