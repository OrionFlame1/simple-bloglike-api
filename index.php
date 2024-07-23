<?php
    // error reporting
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    // including files
    require_once $_SERVER['DOCUMENT_ROOT'] . '/php/helpers.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/php/Db.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/php/Router.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/php/Model.php';

    $ini = parse_ini_file(getcwd() . "/config.ini"); // reading config file

    $db = new Db($ini); // creating db instance
    $db = $db->connect();

    $router = new Router($db); // router object
    $params = $router->getParams();
    $model = new Model($db, $params); // model object

    $router->setModel($model); // setting model object to router
    
    $router->addRoute('getPosts', 'getPosts', true); // all posts view
    $router->addRoute('getPost', 'getPost', true); // view 1 post content
    $router->addRoute('addPost', 'addPost', true); // to add post
    $router->addRoute('addComment', 'addComment', true); // to add comment on a post

    $router->addRoute('login', 'login', true); // to login by credentials
    $router->addRoute('register', 'register', true); // to register
    
    $format_bool = isset($params['format']) && $params['format'] ? true : false;
    $response = json_encode($router->executeRoute(), JSON_PRETTY_PRINT);
    
    $db->close(); // closing connection to db

    echo format($response, $format_bool);
?>