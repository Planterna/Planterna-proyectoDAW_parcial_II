<?php require_once HEADER; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Repuestos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <h2>Listado de Repuestos</h2>

        <div class="row mb-3">
            <div class="col-sm-6">
                <form action="index.php?c=repuestos&f=search" method="POST" class="d-flex">
                    <input type="text" name="b" id="btn btn-busqueda" placeholder="Buscar..." class="form-control me-2">
                    <button type="submit" class="btn btn-buscar">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </form>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="index.php?c=repuestos&f=view_new">
                    <button type="button" class="btn btn-nuevo">
                        <i class="fas fa-plus"></i> Nuevo
                    </button>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Tipo de Repuesto</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="tabladatos">
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $fila): ?>
                            <tr>
                                <td><?= $fila['rep_nombre'] ?></td>
                                <td><?= $fila['rep_descripcion'] ?></td>
                                <td><?= $fila['rep_precio'] ?></td>
                                <td><?= $fila['rep_stock'] ?></td>
                                <td><?= $fila['rep_tipoRepuesto'] ?></td>
                                <td><?= $fila['mar_nombre'] ?></td>
                                <td><?= $fila['mod_nombre'] ?></td>
                                <td><?= $fila['rep_estado'] ?></td>
                                <td class="acciones">
                                    <a class="btn btn-editar" href="index.php?c=repuestos&f=view_edit&id=<?= $fila['rep_id'] ?>">Editar</a>
                                    <a class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este repuesto?');" href="index.php?c=repuestos&f=delete&id=<?= $fila['rep_id'] ?>">Eliminar</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No se encontraron resultados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require_once FOOTER; ?>
</body>
</html>
