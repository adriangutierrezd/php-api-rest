<?php

if(!strpos($_SERVER['REQUEST_URI'], 'api/')){
    ob_start();
    session_start();

    require_once 'config/parameters.php';
    require_once 'autoload.php';
    require_once 'config/Database.php';
    require_once 'helpers/form-validation.php';
    require_once 'views/layouts/header.php';

    if(isset($_GET['controller'])){
        $nombreControlador = ucfirst($_GET['controller'].'Controller');
    }else if(!isset($_GET['controller']) && !isset($_GET['action'])){
        // Cargar controlador por defecto
        $nombreControlador = controller_default;
    }

    if($nombreControlador){
        $controlador = new $nombreControlador();
        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            $controlador->$action();
        }else if(!isset($_GET['controller']) && !isset($_GET['action'])){
            $default_action = action_default;
            $controlador->$default_action();
        }
    }

    require_once 'views/layouts/footer.php';
}else{
    require_once 'helpers/utils.php';
    /* Rutas válidas para consumir la API */
    $routesArr = [
        '/api/post/posts.php',
        '/api/post/posts.php?id=',
        '/api/post/create.php',
        '/api/post/delete.php',
        '/api/post/update.php'
    ];

    if(!validApiRoute($_SERVER['REQUEST_URI'], $routesArr)){
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(array('message' => 'Error en la solicitud'));
    }

}


?>

