<!-- autor: John Steven Quijije Tovar -->
<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php?c=login&f=index");
    exit();
}

require_once HEADER;

?>

<div class="container-fluid mt-4">
    <div class="row">
        <?php if ($_SESSION['rol'] == 1): ?>
            <!-- CLIENTE -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Mis reparaciones</h5>
                        <p class="card-text">Consulta tus servicios activos.</p>
                        <a href="index.php?c=servicios&f=formSearch" class="btn btn-outline-primary">Ver</a>
                    </div>
                </div>
            </div>
            

        <?php elseif ($_SESSION['rol'] == 2): ?>
            <!-- TÉCNICO -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Reparaciones asignadas</h5>
                        <p class="card-text">Lista de servicios por atender.</p>
                        <a href="index.php?c=servicios&f=formSearch" class="btn btn-outline-warning">Ver asignaciones</a>
                    </div>
                </div>
            </div>
            

        <?php elseif ($_SESSION['rol'] == 3): ?>
            <!-- ADMINISTRADOR -->
            <main class="pt-4" style="margin-left: 240px;">
            <div class="container">
                <div class="row">
                <?php if ($_SESSION['rol'] == 3) { require_once SLIDERBAR; } ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <i class="fa-solid fa-user me-2"></i> Gestión de Usuarios
                        <p class="card-text text-muted">Agregar, editar o eliminar usuarios.</p>
                        <a href="index.php?c=login&f=listarUsuarios" class="btn btn-outline-dark">Administrar</a>
                    </div>
                    </div>
                </div>
            </div>
            </main>
        <?php else: ?>
            <p class="text-danger">Rol no reconocido.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once FOOTER; ?>

