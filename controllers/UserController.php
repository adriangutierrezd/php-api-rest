<?php

require_once 'models/User.php';
require_once 'helpers/utils.php';
require_once 'models/Token.php';

class UserController{
    /**
     * Renderiza la página de login
     */
    public function login(){
        if(isLogged()){
            header('Location: '.base_url);
        }else{
            require_once 'views/users/login.php';
        }
    }

    /**
     * Renderiza la página de registro
     */
    public function register(){
        if(isLogged()){
            header('Location: '.base_url);
        }else{
            require_once 'views/users/register.php';
        }
    }

    /**
     * Renderiza la página principal del usuario donde se muestra el token para la API
     */
    public function index(){
        if(isLogged()){
            $token = new Token();
            $token = $token->getToken();
            require_once 'views/users/index.php';
        }else{
            header('Location: '.base_url);
        }
    }


    /**
     * Comprueba que los datos del usuario son correctos e inicia sesión
     */
    public function log(){
        if(isset($_POST)){
            $errors = false;
            $errorsArr = [];

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if($username == ''){
                $errorsArr['username'] = 'Debes introducir un nombre de usuario';
                $errors = true;
            }
            if($password == ''){
                $errorsArr['password'] = 'Debes introducir una contraseña';
                $errors = true;
            }

            $user = new User();
            $user->setUsername(htmlspecialchars(strip_tags($username)));

            if(!$user->getHashPassword()){
                $errorsArr['username'] = 'Nombre de usuario incorrecto';
                $errors = true;
            }else{
                if(!password_verify($password, $user->getHashPassword())){
                    $errorsArr['password'] = 'Contraseña incorrecta';
                    $errors = true;
                }
            }


            if($errors){
                $_SESSION['errorsArr'] = $errorsArr;
                header('Location: '.base_url.'user/login');
            }else{
                $log = $user->log();
                if($log && is_object($log)){
                    $_SESSION['login'] = $log;
                    header('Location: '.base_url.'user/index');
                }
            }
        }
    }

    /**
     * Recibe los datos del usuario y llama al modelo para registrarlo en la BBDD
     */
    public function save(){
        if(isset($_POST)){

            $errors = false;
            $errorsArr = [];

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $passwordR = trim($_POST['passwordRepeat']);

            if($username == ''){
                $errorsArr['username'] = 'Debes introducir un nombre de usuario';
                $errors = true;
            }
            if($password == ''){
                $errorsArr['password'] = 'Debes introducir una contraseña';
                $errors = true;
            }
            if($passwordR == ''){
                $errorsArr['passwordRepeat'] = 'Debes repetir la contraseña';
                $errors = true;
            }
            if($password != $passwordR){
                $errorsArr['passwordRepeat'] = 'Las contraseñas no coinciden';
                $errors = true;
            }

            $user = new User();
            $user->setUsername(htmlspecialchars(strip_tags($username)));
            $user->setPassword(htmlspecialchars(strip_tags($password)));

            if($user->userExits()){
                $errorsArr['username'] = 'Nombre de usuario ya está en uso';
                $errors = true;
            }

            if($errors){
                $_SESSION['errorsArr'] = $errorsArr;
                header('Location: '.base_url.'user/register');
            }else{
                if ($user->save()) {
                    $log = $user->log();
                    if ($log && is_object($log)){
                        $_SESSION['login'] = $log;
                        $token = new Token();
                        $token->createToken();
                        header('Location: '.base_url.'user/index');
                    }
                }
            }
        }
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(){
        if(isLogged()){
            unset($_SESSION['login']);
        }
        header('Location:'.base_url);
    }


}

?>