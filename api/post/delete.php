<?php 
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require_once '../../config/Database.php';
    require_once '../../models/Post.php';
    require_once '../../models/Token.php';
    require_once '../../helpers/utils.php';

    /* Instanciamos post */
    $post = new Post();

    /* Obtenemos los datos enviados en el body */
    $data = json_decode(file_get_contents("php://input"));

    /** Comprobamos que el usuario haya mandado todas las propiedades */
    $properties = ['id', 'token'];
    if(!hasAllProperties($properties, $data)){
        http_response_code(400);
        echo json_encode(array('message' => 'Error en la solicitud'));
        die();
    }

    /* Seteamos las propiedades en el objeto post */
    $post->setId($data->id);

    /* Obtenemos el token del usuario */
    $token = "";
    if(property_exists($data, 'token') && $data->token != null){
        $token = $data->token;
    }

    /* Si tiene token, permitimos la operación, si no, bloqueamos acceso */
    $t = new Token();
    if($t->existsToken($token)){
        if(!$post->existPost()){
            http_response_code(404);
            echo json_encode(array('message' => 'Post no encontrado'));
        }else{
            if($post->delete()) {
                echo json_encode(array('message' => 'Post eliminado con éxito'));
            } else {
                echo json_encode(array('message' => 'Ha ocurrido un error inesperado'));
            }
        }

    }else{
        http_response_code(401);
        echo json_encode(array('message' => 'Acceso no autorizado'));
    }