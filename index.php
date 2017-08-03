<?php
    session_start();
    require 'flight/Flight.php';
    require 'Autoloader.php';


    Flight::render('header', array('heading' => 'Hello'), 'header');
    Flight::render('footer', array('tests' => 'World'), 'footer');

    Flight::route('/', function(){
        Flight::render('login');
    });

    Flight::route('/login', function(){
        Flight::render('login');
    });

    Flight::route('/accueil', function(){
        Flight::render('accueil');
    });

    Flight::route('POST /loginService', function(){
        unset($_SESSION['erreur']);
        $service = new loginService();
        $service->setParams(Flight::request()->data->getData());
        $service->launchControls();
        $service->getError();
        if($service->getError()){
            $_SESSION['erreur']=$service->getError();
            Flight::redirect('/login');
        }
        $_SESSION["user"]= $service->getParams();
        Flight::redirect('/accueil');
    });

    Flight::route('POST /registerService', function(){
        unset($_SESSION['erreur']);
        unset($_SESSION['message']);
        $service = new registerService();
        $service->setParams(Flight::request()->data->getData());
        $service->launchControls();
        $service->getError();
        if($service->getError()){
            $_SESSION['erreur']=$service->getError();
            Flight::redirect('/login');
        }
        $service->registUser();
        $_SESSION['message'] = 'Enregistrement réussi';
        Flight::redirect('/login');
    });

    Flight::start();