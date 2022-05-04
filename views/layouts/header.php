<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API REST PHP</title>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/menu.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/forms.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/api-docs.css">
</head>
<body>
    <nav>
        <a href="<?= base_url ?>" id="logo">PHP API REST</a>
        <div id="menu-items">
            <a href="<?= base_url ?>">Inicio</a>
            <?php if(isset($_SESSION['login'])) :?>
                <a href="<?= base_url ?>user/index">Configuración</a>
                <a href="<?= base_url ?>user/logout">Cerrar sesión</a>
            <?php else : ?>
                <a href="<?= base_url ?>user/register">Registrarse</a>
                <a href="<?= base_url ?>user/login">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </nav>
    <div id="content">

    
