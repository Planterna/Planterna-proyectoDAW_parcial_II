<!--autor: Jonathan Alejandro Baquerizo-->

<?php require_once HEADER ?>
<div class="container-sm">
    <h2 class="titulos_h2" style="text-align: center;">Estado de Solicitudes</h2>
    <div class="row">
        <div class="col-sm-6">
            <form class="d-flex" role="search" action="index.php?c=servicios&f=search" method="POST">
                <input class="form-control me-2" type="text" name="b" id="busqueda" placeholder="buscar..." />
                <button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="col-sm-6 d-flex flex-column align-items-end">
            <a href="index.php?c=servicios&f=formInit">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Nuevo</button>
            </a>
        </div>
    </div>
    <?php
    if ($rol == 1) {
    ?>
        <div class="table-responsive mt-2">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <th>Nombre </th>
                    <th>Cédula </th>
                    <th>Teléfono </th>
                    <th>Correo </th>
                    <th>Marca </th>
                    <th>Placa </th>
                    <th>Tipo de Servicio </th>
                    <th>Estado </th>
                    <th>Acciones </th>
                </thead>
                <tbody class="tabladatos">
                    <?php
                    foreach ($resultados as $servicio) {
                    ?>
                        <tr>
                            <td><?php echo $servicio['nombre']; ?></td>
                            <td><?php echo $servicio['cedula']; ?></td>
                            <td><?php echo $servicio['telefono']; ?></td>
                            <td><?php echo $servicio['correo']; ?></td>
                            <td><?php echo $servicio['marcaVehiculo'] ?></td>
                            <td><?php echo $servicio['placaVehiculo'] ?></td>
                            <td><?php echo $servicio['tipoServicio'] ?></td>
                            <td><?php echo $servicio['estado'] ?></td>

                            <td>
                                <?php if ($servicio['estado'] == "EN ESPERA") { ?>
                                    <a class="btn btn-primary" href="index.php?c=servicios&f=view_edit&id=<?php echo $servicio['id_Registro']; ?>">Editar</a>
                                    <a class="btn btn-primary" onclick="if(!confirm('Estas Seguro?'))return false" href="index.php?c=servicios&f=delete&id=<?php echo $servicio['id_Registro']; ?>">Eliminar</a>
                                <?php
                                } ?>
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
<div class="container-sm d-flex justify-content-end">
    <a class="my-2 d-block" href="index.php?c=servicios&f=index">Regresar</a>
</div>
</div>

<?php } elseif ($rol == 2) {
?>
    <div class="table-responsive mt-2">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Nombre </th>
                <th>Telefono </th>
                <th>Correo </th>
                <th>Marca </th>
                <th>Placa </th>
                <th>Tipo de Servicio </th>
                <th>Estado </th>
                <th>Acciones </th>
            </thead>
            <tbody class="tabladatos">
                <?php
                foreach ($resultados as $servicio) {
                ?>
                    <tr>
                        <td><?php echo $servicio['nombre']; ?></td>
                        <td><?php echo $servicio['telefono']; ?></td>
                        <td><?php echo $servicio['correo']; ?></td>
                        <td><?php echo $servicio['marcaVehiculo'] ?></td>
                        <td><?php echo $servicio['placaVehiculo'] ?></td>
                        <td><?php echo $servicio['tipoServicio'] ?></td>
                        <td><?php echo $servicio['estado'] ?></td>

                        <td>
                            <?php if ($servicio['estado'] == "EN ESPERA") { ?>
                                <a class="btn btn-primary" href="index.php?c=servicios&f=view_edit&id=<?php echo $servicio['id_Registro']; ?>">Editar</a>
                                <a class="btn btn-primary" onclick="if(!confirm('Estas Seguro?'))return false" href="index.php?c=servicios&f=delete&id=<?php echo $servicio['id_Registro']; ?>">Eliminar</a>
                            <?php
                            } ?>
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
    <div class="container-sm d-flex justify-content-end">
        <a class="my-2 d-block" href="index.php?c=servicios&f=index">Regresar</a>
    </div>
    </div>
<?php
    }
?>

<?php require_once FOOTER ?>