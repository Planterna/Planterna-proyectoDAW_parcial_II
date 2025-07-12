<!-- autor: John Steven Quijije Tovar -->

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
    @media (min-width: 992px) {
        .ml-sidebar {
            margin-left: 240px;
        }

    }
</style>


<main class="container pt-4 ml-sidebar">
    <h2 class="fw-semibold text-center text-uppercase mb-4">Listado de Usuarios</h2>

    <form class="row row-cols-lg-auto g-2 mb-3" method="POST"
        action="index.php?c=login&f=listarUsuarios">

        <div class="col">
            <input type="text" name="q" class="form-control"
                placeholder="Buscar nombre o cédula"
                value="<?= htmlspecialchars($textoBuscar ?? '') ?>">
        </div>

        <div class="col">
            <select name="rolFiltro" class="form-select">
                <option value="">Todos los roles</option>
                <option value="3" <?= ($rolFiltro ?? '') === '3' ? 'selected' : '' ?>>Administrador</option>
                <option value="2" <?= ($rolFiltro ?? '') === '2' ? 'selected' : '' ?>>Técnico</option>
                <option value="1" <?= ($rolFiltro ?? '') === '1' ? 'selected' : '' ?>>Usuario</option>
            </select>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-outline-success">
                Buscar
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
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
                        <td><?= ['', 'Usuario', 'Técnico', 'Administrador'][$u['rol']] ?></td>

                        <td>
                            <?php if ($u['estado']): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </td>

                        <td class="d-flex gap-1">
                            <a href="index.php?c=login&f=editarUsuario&id=<?= $u['id_user'] ?>" class="btn btn-sm btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z" />
                                    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z" />
                                </svg>
                                Editar
                            </a>


                            <form method="POST" action="index.php?c=login&f=cambiarEstadoUsuario"
                                onsubmit="return confirm('¿Estas seguro de realizar el cambio?');">
                                <input type="hidden" name="id" value="<?= $u['id_user'] ?>">
                                <input type="hidden" name="estado" value="<?= $u['estado'] ? 0 : 1 ?>">
                                <button type="submit"
                                    class="btn btn-sm <?= $u['estado'] ? 'btn-danger' : 'btn-success' ?>">
                                    <?php if ($u['estado']): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                        </svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                        </svg>
                                    <?php endif; ?>
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