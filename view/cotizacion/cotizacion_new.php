<!--Autor: Dean Leon-->
<?php require_once HEADER; ?>

<main id="contenedor">
    <div class="container mt-4">
        <h2 class="titulos_h2 text-center mb-4">Registrar Nueva Cotización</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); unset($_SESSION['color']); ?>
        <?php endif; ?>

        <div class="card p-4 shadow-sm">
            <form action="index.php?c=Cotizacion&f=registrar" method="POST">
                <div class="mb-3">
                    <label for="cliente_nombre" class="form-label">Nombre del Cliente:</label>
                    <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" required
                           value="<?php echo isset($_SESSION['old_input']['cliente_nombre']) ? htmlspecialchars($_SESSION['old_input']['cliente_nombre']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="cliente_correo" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="cliente_correo" name="cliente_correo" required
                           value="<?php echo isset($_SESSION['old_input']['cliente_correo']) ? htmlspecialchars($_SESSION['old_input']['cliente_correo']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="cliente_telefono" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" id="cliente_telefono" name="cliente_telefono"
                           value="<?php echo isset($_SESSION['old_input']['cliente_telefono']) ? htmlspecialchars($_SESSION['old_input']['cliente_telefono']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="descripcion_servicio" class="form-label">Descripción del Servicio:</label>
                    <textarea class="form-control" id="descripcion_servicio" name="descripcion_servicio" rows="5" required><?php echo isset($_SESSION['old_input']['descripcion_servicio']) ? htmlspecialchars($_SESSION['old_input']['descripcion_servicio']) : ''; ?></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Registrar Cotización</button>
                    <a href="index.php?c=Cotizacion&f=listar" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once FOOTER; ?>