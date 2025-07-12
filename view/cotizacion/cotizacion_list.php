<!--Autor: Dean Leon-->
<?php require_once HEADER; ?>

<main id="contenedor">
    <div class="container mt-4">
        <h2 class="titulos_h2 text-center mb-4">Listado de Cotizaciones de Servicio</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); unset($_SESSION['color']); ?>
        <?php endif; ?>

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="index.php?c=Cotizacion&f=form_registrar" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Registrar Nueva Cotización
            </a>
        </div>

        <?php if (empty($cotizaciones)): ?>
            <div class="alert alert-info text-center" role="alert">
                No hay cotizaciones de servicio registradas.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Fecha Solicitud</th>
                            <th>Acciones</th> </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cotizaciones as $cot): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cot->getIdCotizacion()); ?></td>
                                <td><?php echo htmlspecialchars($cot->getClienteNombre()); ?></td>
                                <td><?php echo htmlspecialchars($cot->getClienteCorreo()); ?></td>
                                <td><?php echo htmlspecialchars($cot->getClienteTelefono()); ?></td>
                                <td><?php echo htmlspecialchars(substr($cot->getDescripcionServicio(), 0, 50)) . (strlen($cot->getDescripcionServicio()) > 50 ? '...' : ''); ?></td>
                                <td><?php echo htmlspecialchars($cot->getEstado()); ?></td>
                                <td><?php echo htmlspecialchars($cot->getFechaSolicitud()); ?></td>
                                <td>
                                    <a href="index.php?c=Cotizacion&f=form_editar&id=<?php echo $cot->getIdCotizacion(); ?>" class="btn btn-warning btn-sm me-1" title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="index.php?c=Cotizacion&f=eliminar&id=<?php echo $cot->getIdCotizacion(); ?>" class="btn btn-danger btn-sm me-1" title="Eliminar"
                                       onclick="return confirm('¿Estás seguro de que deseas eliminar esta cotización? Esta acción es irreversible.');">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownEstado<?php echo $cot->getIdCotizacion(); ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                            Estado
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownEstado<?php echo $cot->getIdCotizacion(); ?>">
                                            <li><a class="dropdown-item" href="index.php?c=Cotizacion&f=cambiar_estado&id=<?php echo $cot->getIdCotizacion(); ?>&estado=Pendiente">Pendiente</a></li>
                                            <li><a class="dropdown-item" href="index.php?c=Cotizacion&f=cambiar_estado&id=<?php echo $cot->getIdCotizacion(); ?>&estado=Aceptada">Aceptada</a></li>
                                            <li><a class="dropdown-item" href="index.php?c=Cotizacion&f=cambiar_estado&id=<?php echo $cot->getIdCotizacion(); ?>&estado=Rechazada">Rechazada</a></li>
                                            <li><a class="dropdown-item" href="index.php?c=Cotizacion&f=cambiar_estado&id=<?php echo $cot->getIdCotizacion(); ?>&estado=Completada">Completada</a></li>
                                            <li><a class="dropdown-item" href="index.php?c=Cotizacion&f=cambiar_estado&id=<?php echo $cot->getIdCotizacion(); ?>&estado=Cancelada">Cancelada</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once FOOTER; ?>