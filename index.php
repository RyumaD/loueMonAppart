<?php
    session_start();
    require 'flight/Flight.php';
    require 'Autoloader.php';


    Flight::render('header', array('heading' => 'Hello'), 'header');
    Flight::render('footer', array('tests' => 'World'), 'footer');

    Flight::route('/', function(){
        unset($_SESSION['erreur']);
        Flight::render('accueil');
    });

    Flight::route('/login', function(){
        Flight::render('login');
    });

    Flight::route('/accueil', function(){
        unset($_SESSION['erreur']);
        unset($_SESSION['message']);
        Flight::render('accueil');
    });

    Flight::route('/addLocation', function(){
        unset($_SESSION['erreur']);
        Flight::render('addLocation');
    });

    Flight::route('/myLocation', function(){
        unset($_SESSION['erreur']);
        Flight::render('myLocation');
    });

    Flight::route('/messagerie', function(){
        unset($_SESSION['erreur']);
        Flight::render('messagerie');
    });
    
    Flight::route('/location/@id', function($id){
        unset($_SESSION['erreur']);
        Flight::render('location', array("id"=>$id));
    });

    Flight::route('/message/@id', function($id){
        unset($_SESSION['erreur']);
        Flight::render('message', array("id"=>$id));
    });

    Flight::route('/favoris', function(){
        unset($_SESSION['erreur']);
        Flight::render('myFavoris');
    });

    Flight::route('/reservation', function(){
        unset($_SESSION['erreur']);
        Flight::render('myReserve');
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

    Flight::route('POST /messageService', function(){
        unset($_SESSION['erreur']);
        $service = new addMessageService();
        $service->addMessageToUser();
        Flight::redirect('/messagerie');
    });

    Flight::route('POST /favorisService', function(){
        unset($_SESSION['erreur']);
        $service = new FavorisService();
        $service->addFavorisForLater();
        Flight::redirect('/favoris');
    });

    Flight::route('POST /supprFavorisService', function(){
        unset($_SESSION['erreur']);
        $service = new supprFavorisService();
        $service->supprFavorisForNow($_POST['id']);
        Flight::redirect('/favoris');
    });

    Flight::route('POST /reserveService', function(){
        unset($_SESSION['erreur']);
        $service = new reserveService();
        $service->addReserveNow();
        Flight::redirect('/reservation');
    });

    Flight::route('POST /supprReserveService', function(){
        unset($_SESSION['erreur']);
        $service = new supprReserveService();
        $service->supprReserveNow();
        Flight::redirect('/reservation');
    });

    Flight::route('/deconnexion', function(){
        unset($_SESSION['erreur']);
        session_destroy();
        Flight::redirect('/login');
    });
    


    Flight::start();