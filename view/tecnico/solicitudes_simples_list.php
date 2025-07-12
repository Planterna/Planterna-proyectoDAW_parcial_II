<!--Autor: Lopez Anthony-->

<?php require_once HEADER; ?>



<main id="contenedor">
    <div class="container mt-4">
        <h2 class="titulos_h2 text-center mb-4">Listado de Solicitudes Simples de Servicio</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); unset($_SESSION['color']); ?>
        <?php endif; ?>

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="index.php?c=Tecnico&f=listar" class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i> Volver a Técnicos
            </a>
            <a href="index.php?c=Tecnico&f=limpiar_solicitudes_simples" class="btn btn-danger"
               onclick="return confirm('¿Estás SEGURO de que deseas eliminar TODAS las solicitudes simples? Esta acción es irreversible.');">
                <i class="fa-solid fa-broom"></i> Limpiar Tabla de Solicitudes
            </a>
        </div>

        <?php if (empty($solicitudes_simples)): ?>
            <div class="alert alert-info text-center" role="alert">
                No hay solicitudes simples de servicio registradas.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID Registro</th>
                            <th>Técnico Solicitado</th>
                            <th>Fecha de Solicitud</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudes_simples as $sol): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($sol['id_registro']); ?></td>
                                <td><?php echo htmlspecialchars($sol['nombre_tecnico'] ?: 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($sol['fecha_solicitud']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once FOOTER; ?>