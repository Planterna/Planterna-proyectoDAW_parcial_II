<?php require_once HEADER; ?>

<main id="contenedor">
    <div class="container mt-4">
        <h2 class="titulos_h2 text-center mb-4">Editar Cotización</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); unset($_SESSION['color']); ?>
        <?php endif; ?>

        <div class="card p-4 shadow-sm">
            <form action="index.php?c=Cotizacion&f=actualizar" method="POST">
                <input type="hidden" name="id_cotizacion" value="<?php echo htmlspecialchars($cotizacion->getIdCotizacion()); ?>">

                <div class="mb-3">
                    <label for="cliente_nombre" class="form-label">Nombre del Cliente:</label>
                    <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre"
                           value="<?php echo htmlspecialchars($cotizacion->getClienteNombre()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="cliente_correo" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="cliente_correo" name="cliente_correo"
                           value="<?php echo htmlspecialchars($cotizacion->getClienteCorreo()); ?>">
                </div>
                <div class="mb-3">
                    <label for="cliente_telefono" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" id="cliente_telefono" name="cliente_telefono"
                           value="<?php echo htmlspecialchars($cotizacion->getClienteTelefono()); ?>">
                </div>
                <div class="mb-3">
                    <label for="descripcion_servicio" class="form-label">Descripción del Servicio:</label>
                    <textarea class="form-control" id="descripcion_servicio" name="descripcion_servicio" rows="5" required><?php echo htmlspecialchars($cotizacion->getDescripcionServicio()); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="Pendiente" <?php echo ($cotizacion->getEstado() == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="Aceptada" <?php echo ($cotizacion->getEstado() == 'Aceptada') ? 'selected' : ''; ?>>Aceptada</option>
                        <option value="Rechazada" <?php echo ($cotizacion->getEstado() == 'Rechazada') ? 'selected' : ''; ?>>Rechazada</option>
                        <option value="Completada" <?php echo ($cotizacion->getEstado() == 'Completada') ? 'selected' : ''; ?>>Completada</option>
                        <option value="Cancelada" <?php echo ($cotizacion->getEstado() == 'Cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                    </select>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="index.php?c=Cotizacion&f=listar" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once FOOTER; ?>