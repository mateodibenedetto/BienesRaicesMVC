<?php

    // Comprueba si ya se habia iniciado sesion
    if(!isset($_SESSION)) {
        session_start();
    }
    
    // Muestra mensaje condicional
    $auth = $_SESSION['login'] ?? null;

    if(!isset($inicio)) {
        $inicio = false;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <!-- <link rel="stylesheet" href="public/build/css/app.css"> -->
    <link rel="stylesheet" href="/src/scss/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

</head>
<body>
    <!--  Header -->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/public/">
                    <img src="/public/build/img/logo.svg" alt="logotipo de bienes raices">
                </a>

                <button class="switch active" id="switch">
                    <span><i class="fas fa-sun"></i></span>
                    <span><i class="fas fa-moon"></i></span>
                </button>

                <div class="mobile-menu">
                    <img src="/public/build/img/barras.svg" alt="icono menu responsive">
                </div>
                
                <nav data-cy="navegacion-header" class="navegacion">
                    <a href="/public/nosotros">Nosotros</a>
                    <a href="/public/propiedades">Propiedades</a>
                    <a href="/public/blog">Blog</a>
                    <a href="/public/contacto">Contacto</a>
                    <?php if(!$auth): ?>
                        <a href="/public/login">Iniciar Sesión</a>
                    <?php endif; ?>
                    <?php if($auth): ?>
                        <a href="/public/logout">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>

            <?php echo $inicio ? "<h1 data-cy='heading-sitio'>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
            
        </div>
    </header>


    <?php echo $contenido; ?>

    <!--  Footer  -->
    <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav data-cy="navegacion-footer" class="navegacion2">
                    <a href="/public/nosotros">Nosotros</a>
                    <a href="/public/propiedades">Propiedades</a>
                    <a href="/public/blog">Blog</a>
                    <a href="/public/contacto">Contacto</a>
                </nav>
            </div>

            <div data-cy="copyright" class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</div>
        </footer>
        <!-- // Footer -->
        
        <!-- <script src="../public/build/js/bundle.min.js"></script> -->
        <script src="../src/js/app.js"></script>

    </body>
</html>