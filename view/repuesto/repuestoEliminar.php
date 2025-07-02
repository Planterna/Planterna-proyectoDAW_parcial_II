<?php require_once HEADER;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="search-container">
        <form class="form-buscar" action="index.php?c=repuesto&f=eliminar" method="POST">
            <label for="buscar-repuesto">Buscar</label>
            <input type="text" name="buscar-repuesto" id="buscar-repuesto" placeholder="Ingrese ID del Repuesto">
            <input type="submit" name="btnBuscar" id="btnBuscar" value="Buscars">
        </form>
        <div class="main-container">
            <table class="data-table">
                <thead>
                    <tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Fecha de Registro</th><th>Tipo de Repuesto</th><th>Eliminar</th>
                </thead>
                    <td>1</td>
                    <td>Bujía NGK</td>                
                    <td>NGK</td>
                    <td>30/06/2025</td>
                    <td>Original</td>
                    <td>
                    <button>Eliminar</button>
                    </td>
                </table>
        </div>

    </div>
</body>
</html>