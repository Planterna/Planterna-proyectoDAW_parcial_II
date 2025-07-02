<?php require_once HEADER;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Repuesto</title>
</head>
<body>
    <div class="main-container">
        <form class="form-container" action="index.php?c=repuesto&f=actualizar" method="POST" name="formulario-actualizar">
             <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            
            <label for="marca">Marca</label>
            <select name="marca" id="marca">
                <option value="">Seleccione</option>
                <option value="Bosch">Bosch</option>
                <option value="NGK">NGK</option>
                <option value="Denso">Denso</option>
                <option value="ACDelco">ACDelco</option>
                <option value="Delphi">Delphi</option>
            </select>
            <label for="modelo">modelo</label>
            <select name="modelo" id="modelo">
                <option value="">Seleccione</option>
            </select>
            <label for="precio">Precio</label>
            <input  type="text" name="precio" id="precio">
            <label for="stock">Stock</label>
            <input type="text" name="stock" id="stock">
            <label for="fecha-registro">Fecha de Registro</label>
            <input type="date" name="fecha-registro" id="fecha-registro">
            <label for="tipo-repuesto">Tipo de Repuesto</label>
            <div class="radio-group">
                <input type="radio" name="tipo_repuesto" id="repuestoO" value="Original" required>
                <label for="repuestoO">Original</label>
                <input type="radio" name="tipo_repuesto" id="repuestoR" value="Remanufacturado">
                <label for="repuestoR">Remanufacturado</label>
                <input type="radio" name="tipo_repuesto" id="repuestoG" value="Generico">
                <label for="repuestoG">Genérico</label>
            </div>
            <button type="submit" name="btnRegistrar" id="btn-form">Registrar</button>
        </form>
    </div>
</body>
</html>