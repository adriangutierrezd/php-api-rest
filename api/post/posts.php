<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once '../../config/Database.php';
    require_once '../../models/Post.php';

    /* Instanciamos post */
    $post = new Post();

    /* Comprobamos si quieren ver 1 o varios posts */
    if(isset($_GET['id'])){

        /* Obtenemos el id de la URL */
        $post->setId($_GET['id']);

        if(!$post->existPost()){
            http_response_code(404);
            echo json_encode(array('message' => 'Post no encontrado'));
        }else{
            /* Obtenemos el post */
            $post->read_single();

            /* Generamos un array con los resultados */
            $post_arr = array(
                'id' => $post->getId(),
                'category_id' => $post->getCategoryId(),
                'category_name' => $post->getCategoryName(),
                'title' => $post->getTitle(),
                'body' => html_entity_decode($post->getBody()),
                'author' => $post->getAuthor(),
                'created_at' => $post->getCreatedAt()
            );

            echo json_encode($post_arr);
        }
    }else{
        /* Obtenemos los posts */
        $results = $post->read();
        $num = $results->rowCount();

        /* Comprobamos si hay algún post */
        if($num > 0){
            /* Generamos arrays con los resultados de los posts, uno para cada post, y otro para todos los posts */
            $posts_arr = array();
            $posts_arr['data'] = array();

            while($row = $results->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $post_item = array(
                    'id' => $id,
                    'category_id' => $category_id,
                    'category_name' => $category_name,
                    'title' => $title,
                    'body' => html_entity_decode($body),
                    'author' => $author,
                    'created_at' => $created_at
                );

                /* Introducimos el array de cada post en el array data */
                array_push($posts_arr['data'], $post_item);
            }

            echo json_encode($posts_arr);
        }else{
            echo json_encode(array('message' => 'No hay ningún post'));
        }
    }


