<?php

/**
 * Muestra el mensaje de error de un campo del formulario
 * @param $field campo en el que existe un error
 */
function showError($field){
    if(isset($_SESSION['errorsArr']) && isset($_SESSION['errorsArr'][$field])){
        echo $_SESSION['errorsArr'][$field];
    }
}

/**
 * Elimina los mensajes de error que se muestran en los formulario
 */
function deleteErrors(){
    if(isset($_SESSION['errorsArr'])){
        $_SESSION['errorsArr'] = null;
        unset($_SESSION['errorsArr']);
    }
}
?>