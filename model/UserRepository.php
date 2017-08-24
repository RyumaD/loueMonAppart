<?php

class UserRepository{

    private $connexion;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }

    public function getAllUser(){
        $object = $this->connexion->prepare('SELECT * FROM user');
        $object->execute(array());
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        $user =[];
        foreach ($users as $index) {
            $user[] = new User($index);
        }
        return $user;
    }
    public function getIdUser(){
        $object = $this->connexion->prepare('SELECT id FROM user WHERE username=:username AND password=:password');
        $object->execute(array(
            'password'=>$_SESSION['user']['password'],
            'username'=>$_SESSION['user']['username']
        ));
        $user = $object->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

//////////////////////LOGIN////////////////////////////
    public function checkLogin(loginService $log){
        $query = 'SELECT id,username FROM user WHERE username=:username AND password=:password';
        $object = $this->connexion->prepare($query);
        $object->execute(array(
            'password'=>$log->getParams()['password'],
            'username'=>$log->getParams()['username']
        ));
        $user = $object->fetchAll(PDO::FETCH_ASSOC);

        if(empty($user)==false){
            return $user;
        }
        return false;
    }
///////////////////REGISTER//////////////////////////
///////////////////VERIFICATION//////////////////////

    public function checkUsername(registerService $reg){
        $object = $this->connexion->prepare('SELECT username FROM user WHERE username=:username');
        $object->execute(array(
            'username'=>$reg->getParams()['username']
        ));
        $user = $object->fetchAll(PDO::FETCH_ASSOC);
        if(empty($user)){
            return $user;
        }
        return false;
    }
    public function checkEmail(registerService $reg){

        $object = $this->connexion->prepare('SELECT email FROM user WHERE email=:email');
        $object->execute(array(
            'email'=>$reg->getParams()['email']
        ));
        $users = $object->fetchAll(PDO::FETCH_ASSOC);
        if(empty($users)){
            return $users;
        }
        return false;
    }
    public function validateEmail(registerService $reg) {
        $regex = "#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#";
        $preg = preg_match($regex, $reg->getParams()['email']);
        return $preg;
    }
    public function validatePassword(registerService $reg){
        return strcmp($reg->getParams()['password'],$reg->getParams()['confpword']);
    }
///////////////////AJOUT/////////////////////////////
    public function register(registerService $reg){
        $query = "INSERT INTO user SET username=:username, email=:email, password=:password";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array("username"=>$reg->getParams()['username'],
                            "email"=> $reg->getParams()['email'],
                            "password"=>$reg->getParams()['password']
        ));                    
        return $pdo->rowCount();
    }
}