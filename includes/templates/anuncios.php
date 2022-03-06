<?php 
    // Importar clases
    use Model\Propiedad;

    //** Si está em anuncios.php va a traer todas la porpiedades, pero si está en el index.php solo va a traer 3 propiedades 

    if($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
        // Obteniene todas las propiedades
        $propiedades = Propiedad::all();
    } else {
        // Obteniene 3 porpiedades
        $propiedades = Propiedad::get(3);
    }

?>


<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) { ?>
        <div class="anuncio">
 
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
                
                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
            </div> <!--.contenido-anuncio-->
        </div> <!--.anuncio-->
        <?php } ?>
    </div> <!--.contenedor-anuncios-->