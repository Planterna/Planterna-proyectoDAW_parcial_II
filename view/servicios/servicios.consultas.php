  <!--autor: Jonathan Alejandro Baquerizo-->

<?php require_once HEADER ?>
<div class="container-sm main-content" style="margin-top: 45px;">
    <h2 class="titulos_h2 text-center page-title">Estado de Solicitudes</h2>
    <div class="row search-and-add-section">
        <div class="col-sm-6 search-form-container">
            <form class="d-flex" role="search" action="index.php?c=servicios&f=search" method="POST">
                <input class="form-control me-2 search-input" type="text" name="b" id="busqueda" placeholder="Buscar..." />
                <button type="submit" class="btn btn-primary search-button"><i class="fas fa-search"></i> Buscar</button>
            </form>
        </div>
        <?php if($rol == 1 || $rol == 3) {  ?>
            <div class="col-sm-6 d-flex flex-column align-items-end add-new-button-container">
            <a href="index.php?c=servicios&f=formInit">
                <button type="button" class="btn btn-info add-new-button">
                    <i class="fas fa-plus"></i>
                    Nueva Solicitud
                </button>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
    <?php
    if ($rol == 1) {
    ?>
        <div class="table-responsive mt-4 custom-table-container">
            <table class="table table-striped table-bordered custom-table">
                <thead class="table-header-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Marca</th>
                        <th>Placa</th>
                        <th>Tipo de Servicio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-body-data">
                    <?php
                    foreach ($resultados as $servicio) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($servicio['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['cedula']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['correo']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['marcaVehiculo']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['placaVehiculo']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['tipoServicio']); ?></td>
                            <td><span class="status-badge status-<?php echo strtolower(str_replace(' ', '-', $servicio['estado'])); ?>"><?php echo htmlspecialchars($servicio['estado']); ?></span></td>

                            <td>
                                <?php if ($servicio['estado'] == "EN ESPERA") { ?>
                                    <a class="btn btn-sm btn-edit" href="index.php?c=servicios&f=view_edit&id=<?php echo htmlspecialchars($servicio['id_Registro']); ?>">Editar</a>
                                    <a class="btn btn-sm btn-delete" onclick="if(!confirm('¿Estás seguro de eliminar esta solicitud?'))return false" href="index.php?c=servicios&f=delete&id=<?php echo htmlspecialchars($servicio['id_Registro']); ?>">Eliminar</a>
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
<div class="container-sm d-flex justify-content-end return-link-container">
    <a class="my-2 d-block return-link" href="index.php?c=servicios&f=index">Regresar</a>
</div>

<?php } elseif ($rol == 2 || $rol == 3) {
?>
    <div class="table-responsive mt-4 custom-table-container">
        <table class="table table-striped table-bordered custom-table">
            <thead class="table-header-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Marca</th>
                    <th>Placa</th>
                    <th>Tipo de Servicio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-body-data">
                <?php
                foreach ($resultados as $servicio) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($servicio['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($servicio['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($servicio['correo']); ?></td>
                        <td><?php echo htmlspecialchars($servicio['marcaVehiculo']); ?></td>
                        <td><?php echo htmlspecialchars($servicio['placaVehiculo']); ?></td>
                        <td>
                            <form action="index.php?c=servicios&f=changeService" method="POST" class="service-update-form">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($servicio['id_Registro']); ?>">
                                <input type="hidden" name="id_tecnico" id="id_tecnico" value="<?php echo htmlspecialchars($id_tecnico) ?>" />
                                <select id="tipoServicio" name="tipoServicio" class="form-control service-type-select">
                                    <?php
                                    $typeService = ["MANTENIMIENTO PREVENTIVO", "REPARACIONES", "SERVICIO TECNICO"];
                                    foreach ($typeService as $type) {
                                        $selected = ($servicio['tipoServicio'] == $type) ? "selected" : "";
                                    ?>
                                        <option <?php echo $selected; ?> value="<?php echo htmlspecialchars($type); ?>">
                                            <?php echo htmlspecialchars($type); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                        </td>
                        <td>
                            <select id="estado" name="estado" class="form-control status-select">
                                <?php
                                $typeStatus = ["EN ESPERA", "EN PROCESO", "TRABAJANDO", "TERMINADO"];
                                foreach ($typeStatus as $type) {
                                    $selected = ($servicio['estado'] == $type) ? "selected" : "";
                                ?>
                                    <option <?php echo $selected; ?> value="<?php echo htmlspecialchars($type); ?>">
                                        <?php echo htmlspecialchars($type); ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <?php if ($servicio['estado'] !== "TERMINADO") { ?>
                                <button type="submit" class="btn btn-sm btn-save-changes" onclick="return confirm('¿Estás seguro de aplicar los cambios?')">Guardar Cambios</button>
                            <?php
                            }
                            ?>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}
?>