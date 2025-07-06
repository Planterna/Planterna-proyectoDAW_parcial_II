<!--autor: John Steven Quijije Tovar-->
<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php?c=login&f=index");
    exit();
}

require_once HEADER;

?>

<div class="container mt-4">
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

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Historial</h5>
                        <p class="card-text">Tus servicios anteriores.</p>
                        <a href="#" class="btn btn-outline-secondary">Ver historial</a>
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

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Subir informe</h5>
                        <p class="card-text">Entrega tu diagnóstico técnico.</p>
                        <a href="index.php?c=servicios&f=informe" class="btn btn-outline-success">Subir</a>
                    </div>
                </div>
            </div>

        <?php elseif ($_SESSION['rol'] == 3): ?>
            <!-- ADMINISTRADOR -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de usuarios</h5>
                        <p class="card-text">Agregar, editar o eliminar usuarios.</p>
                        <a href="index.php?c=usuarios&f=listar" class="btn btn-outline-dark">Administrar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Resumen del sistema</h5>
                        <p class="card-text">Total de servicios, técnicos y clientes.</p>
                        <a href="index.php?c=reportes&f=dashboard" class="btn btn-outline-info">Ver panel</a>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <p class="text-danger">Rol no reconocido.</p>
        <?php endif; ?>
    </div>
</div>


<?php require_once FOOTER; ?>