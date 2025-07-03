<!--autor: Jonathan Alejandro Baquerizo-->

<?php require_once HEADER ?>
<div class="container-sm" style="margin-top: 75px;">
    <h2 class="titulos_h2" style="text-align: center;">Estado de Solicitudes</h2>
    <div class="row">
        <div class="col-sm-6">
            <form action="index.php?c=productos&f=search" method="POST">
                <input type="text" name="b" id="busqueda" placeholder="buscar..." />
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Buscar</button>
            </form>
        </div>
        <div class="col-sm-6 d-flex flex-column align-items-end">
            <a href="index.php?c=productos&f=view_new">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Nuevo</button>
            </a>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Nombre </th>
                <th>Categoría </th>
                <th>Precio </th>
                <th>Estado </th>
                <th>Acciones </th>
            </thead>
            <tbody class="tabladatos">
                <?php
                foreach ($resultados as $producto) {
                ?>
                    <tr>
                        <td><?php echo $producto['prod_nombre']; ?></td>
                        <td><?php echo $producto['cat_nombre']; ?></td>
                        <td><?php echo $producto['prod_precio']; ?></td>
                        <td><?php echo $producto['prod_estado'] ?></td>
                        <td>
                            <a class="btn btn-primary" href="index.php?c=productos&f=view_edit&id=<?php echo $producto['prod_id']; ?>">Editar</a>
                            <a class="btn btn-primary" onclick="if(!confirm('Estas Seguro?'))return false" href="index.php?c=productos&f=delete&id=<?php echo $producto['prod_id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php require_once FOOTER ?>