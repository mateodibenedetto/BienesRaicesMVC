<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input 
        type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        placeholder="Nombre Vendedor" 
        value="<?php echo sanitizar($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input 
        type="text" 
        id="apellido" 
        name="vendedor[apellido]" 
        placeholder="Apellido Vendedor" 
        value="<?php echo sanitizar($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Teléfono:</label>
    <input 
        type="text" 
        id="telefono" 
        name="vendedor[telefono]" 
        placeholder="Teléfono Vendedor" 
        value="<?php echo sanitizar($vendedor->telefono); ?>">

    <label for="imagen">Imagen Vendedor:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]">

    <?php if($vendedor->imagen): ?>
        <img src="/imagenes/<?php echo $vendedor->imagen ?>" class="imagen-small">
    <?php endif; ?>    

</fieldset>