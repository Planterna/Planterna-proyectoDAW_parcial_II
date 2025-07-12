<!--Autor: Lopez Anthony-->
<?php require_once HEADER; ?>

<main id="contenedor">
    <div class="container mt-4">
        <h2 class="titulos_h2 text-center mb-4">Lista de Técnicos Disponibles</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); unset($_SESSION['color']); ?>
        <?php endif; ?>

        <div class="mb-3 d-flex justify-content-between">
            <div>
                <a href="index.php?c=Tecnico&f=vista_registrar" class="btn btn-success me-2">
                    <i class="fa-solid fa-plus"></i> Añadir Nuevo Técnico
                </a>
                <a href="index.php?c=Tecnico&f=listar_solicitudes_simples" class="btn btn-info">
                    <i class="fa-solid fa-clipboard-list"></i> Ver Solicitudes Simples
                </a>
            </div>
        </div>

        <?php if (empty($tecnicos)): ?>
            <div class="alert alert-info text-center" role="alert">
                No hay técnicos registrados o disponibles en este momento.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Cédula</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tecnicos as $tec): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tec->getIdUser()); ?></td>
                                <td><?php echo htmlspecialchars($tec->getNombre()); ?></td>
                                <td><?php echo htmlspecialchars($tec->getCedula()); ?></td>
                                <td><?php echo htmlspecialchars($tec->getTelefono()); ?></td>
                                <td><?php echo htmlspecialchars($tec->getCorreo()); ?></td>
                                <td>
                                    <?php if ($tec->getEstado() == 1): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="index.php?c=Tecnico&f=vista_actualizar&id=<?php echo $tec->getIdUser(); ?>" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="index.php?c=Tecnico&f=eliminar&id=<?php echo $tec->getIdUser(); ?>" class="btn btn-danger btn-sm" title="Desactivar" onclick="return confirm('¿Estás seguro de desactivar a este técnico?');">
                                        <i class="fa-solid fa-trash-alt"></i>
                                    </a>
                                    <a href="index.php?c=Tecnico&f=solicitar_tecnico_simple&id_tecnico=<?php echo $tec->getIdUser(); ?>" class="btn btn-primary btn-sm ms-1" title="Solicitar Servicio">
                                        <i class="fa-solid fa-file-invoice"></i> Solicitar
                                    </a>
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