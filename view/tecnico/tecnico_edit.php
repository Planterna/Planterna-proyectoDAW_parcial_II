<?php require_once HEADER; ?>

<main id="contenedor">
    <div class="container mt-4">
        <h2 class="titulos_h2 text-center mb-4">Editar Técnico (Usuario)</h2>

        <?php if (!isset($tecnico) || $tecnico === null): ?>
            <div class="alert alert-danger text-center" role="alert">
                No se encontró el técnico para editar.
            </div>
            <div class="text-center">
                <a href="index.php?c=Tecnico&f=listar" class="btn btn-secondary">Volver a la lista</a>
            </div>
        <?php else: ?>
            <div class="card p-4 shadow-sm">
                <form action="index.php?c=Tecnico&f=actualizar" method="POST">
                    <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($tecnico->getIdUser()); ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($tecnico->getNombre()); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula:</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo htmlspecialchars($tecnico->getCedula()); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($tecnico->getCorreo()); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($tecnico->getTelefono()); ?>">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" id="estado" name="estado" <?php echo ($tecnico->getEstado() == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="estado">
                            Activo
                        </label>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2">Actualizar Técnico</button>
                        <a href="index.php?c=Tecnico&f=listar" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once FOOTER; ?>