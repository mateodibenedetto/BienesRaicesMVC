<?php

    // Comprueba si ya se habia iniciado sesion
    if(!isset($_SESSION)) {
        session_start();
    }
    
    // Muestra mensaje condicional
    $auth = $_SESSION['login'] ?? null
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="logotipo de bienes raices">
                </a>

                <button class="switch active" id="switch">
                    <span><i class="fas fa-sun"></i></span>
                    <span><i class="fas fa-moon"></i></span>
                </button>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>
                
                <nav class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <?php if(!$auth): ?>
                        <a href="login.php">Iniciar Sesión</a>
                    <?php endif; ?>
                    <?php if($auth): ?>
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>

            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
        </div>
    </header>