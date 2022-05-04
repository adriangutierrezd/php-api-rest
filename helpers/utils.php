<?php

/**
 * Comprueba si un usuario está conectado
 * @return bool true si lo está, false si no
 */
function isLogged(){
    if(isset($_SESSION['login'])) return true;
    return false;
}

/**
 * Determina si una solicitud a la api tiene todas las propiedades necesarias
 * @param $props Propiedades que debe incluir
 * @param $data Propiedades recibidas
 * @return bool true si las contiene, false si falta alguna
 */
function hasAllProperties($props, $data){
    foreach($props as $prop){
        if(!property_exists($data, $prop)){
            return false;
        }
    }
    return true;
}

/**
 * Comprueba si una ruta para consumir la API es válida
 * @param $routeRequested Ruta introducida por el usuario
 * @param $routes Rutas válidas
 * @return bool true si lo es, en caso contrario
 */
function validApiRoute($routeRequested, $routes){
    foreach($routes as $route){
        if(!strpos($routeRequested, $route)){
            return false;
        }
    }
    return true;
}
