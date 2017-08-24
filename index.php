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

    Flight::route('/addLocation', function(){
        Flight::render('addLocation');
    });

    Flight::route('/myLocation', function(){
        Flight::render('myLocation');
    });
    
    Flight::route('/location/@id', function($id){
        Flight::render('location', array("id"=>$id));
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

    Flight::route('POST /locationService', function(){
        unset($_SESSION['erreur']);
        $service = new locationService();
        $service->setParams(Flight::request()->data->getData());
        $service->launchControls();
        $service->getError();
        if($service->getError()){
            $_SESSION['erreur']=$service->getError();
            Flight::redirect('/addLocation');
        }
        $service->registLocation();
        Flight::redirect('/myLocation');
    });

    Flight::route('POST /imageService', function(){
        unset($_SESSION['erreur']);
        $service = new imageService();
        $service->addImageLocation();
        Flight::redirect('/myLocation');
    });
    
    Flight::route('POST /supprImageService', function(){
        unset($_SESSION['erreur']);
        $service = new supprImageService();
        $service->supprImageLocation($_POST['image'],$_POST['id']);
        Flight::redirect('/myLocation');
    });

    Flight::route('POST /supprLocationService', function(){
        unset($_SESSION['erreur']);
        $service = new supprLocationService();
        $service->supprLocations($_POST['user_id'],$_POST['id']);
        Flight::redirect('/myLocation');
    });

    Flight::route('POST /commentaireService', function(){
        unset($_SESSION['erreur']);
        $service = new commentaireService();
        $service->addCommentLocation();
        Flight::redirect('/myLocation');
    });

    Flight::route('POST /supprCommentService', function(){
        unset($_SESSION['erreur']);
        $service = new supprCommentService();
        $service->supprCommentLocation($_POST['comment'],$_POST['id'],$_POST['date']);
        Flight::redirect('/myLocation');
    });

    Flight::route('POST /updCommentService', function(){
        unset($_SESSION['erreur']);
        $service = new updCommentService();
        $service->updCommentLocation($_POST['comment'],$_POST['id'],$_POST['date'],$_POST['new']);
        Flight::redirect('/myLocation');
    });

    Flight::start();