<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php?c=login&f=index");
    exit();
}

require_once HEADER;
?>
<?php require_once SLIDERBAR; ?>

<style>
@media (min-width: 992px){
    .ml-sidebar { margin-left:240px; }   /* ancho del sidebar */
}
</style>

<main class="container pt-4 ml-sidebar">
    <h2 class="fw-semibold text-center text-uppercase mb-4">Listado de Usuarios</h2>

    <!-- buscador + filtro -->
    <form class="row row-cols-lg-auto g-2 mb-3" method="POST"
          action="index.php?c=login&f=listarUsuarios">

        <!-- texto de búsqueda -->
        <div class="col">
            <input type="text" name="q" class="form-control"
                   placeholder="Buscar nombre o cédula"
                   value="<?= htmlspecialchars($textoBuscar ?? '') ?>">
        </div>

        <!-- filtro de rol -->
        <div class="col">
            <select name="rolFiltro" class="form-select">
                <option value="">Todos los roles</option>
                <option value="3" <?= ($rolFiltro ?? '')==='3' ? 'selected' : '' ?>>Administrador</option>
                <option value="2" <?= ($rolFiltro ?? '')==='2' ? 'selected' : '' ?>>Técnico</option>
                <option value="1" <?= ($rolFiltro ?? '')==='1' ? 'selected' : '' ?>>Usuario</option>
            </select>
        </div>

        <!-- botón -->
        <div class="col">
            <button type="submit" class="btn btn-outline-success">
                Filtrar
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th><th>Nombre</th><th>Cédula</th><th>Correo</th>
                    <th>Teléfono</th><th>Rol</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id_user'] ?></td>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= $u['cedula'] ?></td>
                    <td><?= $u['correo'] ?></td>
                    <td><?= $u['telefono'] ?></td>
                    <td><?= ['','Usuario','Técnico','Administrador'][$u['rol']] ?></td>

                    <td>
                        <?php if ($u['estado']): ?>
                            <span class="badge bg-success">Activo</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactivo</span>
                        <?php endif; ?>
                    </td>

                    <td class="d-flex gap-1">
                        <!-- Editar -->
                        <a href="index.php?c=login&f=editarUsuario&id=<?= $u['id_user'] ?>" class="btn btn-sm btn-primary">
                            Editar
                        </a>


                        <!-- Activar / Desactivar -->
                        <form method="POST" action="index.php?c=login&f=cambiarEstadoUsuario"
                              onsubmit="return confirm('¿Seguro?');">
                            <input type="hidden" name="id"     value="<?= $u['id_user'] ?>">
                            <input type="hidden" name="estado" value="<?= $u['estado'] ? 0 : 1 ?>">
                            <button type="submit"
                                    class="btn btn-sm <?= $u['estado'] ? 'btn-danger' : 'btn-success' ?>">
                                <?= $u['estado'] ? 'Desactivar' : 'Activar' ?>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once FOOTER; ?>


