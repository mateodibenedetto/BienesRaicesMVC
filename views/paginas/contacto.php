<main class="contenedor seccion">
    <h1 data-cy="heading-contacto">Contacto</h1>

    <!-- Mostrar mensaje de error o de enviado correctamente -->
    <?php if($mensaje) { ?>
            <p data-cy="alerta-envio-formulario" class='alerta exito'><?php echo $mensaje; ?></p>;
    <?php } ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webpe">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>

    <h2 data-cy="heading-formulario">Llene el formulario de contacto</h2>

    <!-- Formulario  -->
    <form data-cy="formulario-contacto" class="formulario" action="/public/contacto" method="POST">
        <fieldset> <!--El fieldset separa en varia partes el formulario-->
            <legend>Informacion Personal</legend>
    <!--El for es para cuando le demos click al label aparezca para escribir en el input sin tener que dar click al placeholder-->  
            <label for="nombre">Nombre</label> 
            <input data-cy="input-nombre" type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" >

            <label for="mensaje">Mensaje:</label>
            <textarea data-cy="input-mensaje" id="mesaje" style="resize: none;" name="contacto[mensaje]" ></textarea>

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" >
                <option selected="true" disabled="disabled">-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Pesupuesto</label>
            <input data-cy="input-precio" type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[precio]" >
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser Contactado</p>
            
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input data-cy="forma-contacto" type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" >

                <label for="contactar-email">E-mail</label>
                <input data-cy="forma-contacto" type="radio" value="email" id="contactar-email" name="contacto[contacto]" >
            </div>

            <div id="contacto"></div>

           

        </fieldset>

        <input type="submit" name="Enviar" class="boton-verde">
    </form>
    <!-- // Formulario  -->

</main>
   