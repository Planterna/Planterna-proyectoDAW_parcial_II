<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php?c=login&f=index");
    exit();
}

require_once HEADER;
require_once SLIDERBAR;

// $usuario puede venir de la lógica del controlador (null para crear, objeto Usuario para editar)
?>

<main class="container pt-4 ml-sidebar">
    <h2 class="fw-semibold mb-4 text-center text-uppercase">
        <?php echo empty($usuario) ? "Usuarios" : "Editar usuario"; ?>
    </h2>

    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-8">
            <form class="row g-4" method="POST" 
                action="index.php?c=login&f=<?php echo empty($usuario) ? 'dashboardAdmin' : 'actualizarUsuario'; ?>">

                <?php if (!empty($usuario)) { ?>
                    <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($usuario->getIdUser()); ?>">
                <?php } ?>

                <!-- Columna izquierda -->
                <div class="col-12 col-lg-4 border-end">
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" name="cedula" id="cedula" class="form-control" 
                               placeholder="0102030405" pattern="\d{10}" required
                               value="<?php echo !empty($usuario) ? htmlspecialchars($usuario->getCedula()) : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" 
                               placeholder="Nombre y Apellido" required
                               value="<?php echo !empty($usuario) ? htmlspecialchars($usuario->getNombre()) : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control" 
                               placeholder="ejemplo@correo.com" required
                               value="<?php echo !empty($usuario) ? htmlspecialchars($usuario->getCorreo()) : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" 
                               placeholder="0999999999" pattern="\d{9,10}" required
                               value="<?php echo !empty($usuario) ? htmlspecialchars($usuario->getTelefono()) : ''; ?>">
                    </div>
                </div>

                <!-- Columna centro -->
                <div class="col-12 col-lg-4 border-end">
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <?php echo empty($usuario) ? 'Contraseña' : 'Nueva contraseña (opcional)'; ?>
                        </label>
                        <input type="password" name="password" id="password" class="form-control"
                               <?php echo empty($usuario) ? 'required' : ''; ?>>
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_password" class="form-label">
                            <?php echo empty($usuario) ? 'Confirmar contraseña' : 'Confirmar nueva contraseña'; ?>
                        </label>
                        <input type="password" name="confirmar_password" id="confirmar_password" class="form-control"
                               <?php echo empty($usuario) ? 'required' : ''; ?>>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="notificaciones" id="notificaciones"
                            <?php 
                                if (!empty($usuario) && $usuario->getRecibirInfo()) echo 'checked'; 
                                elseif (empty($usuario)) echo '';
                            ?>>
                        <label class="form-check-label" for="notificaciones">
                            Deseo recibir información y promociones
                        </label>
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-12 col-lg-4 d-flex flex-column align-items-start">
                    <label class="form-label mb-2">Asignar rol</label>

                    <?php
                    $roles = [
                        3 => 'Administrador',
                        2 => 'Técnico',
                        1 => 'Usuario'
                    ];
                    $rolSeleccionado = !empty($usuario) ? $usuario->getRol() : null;
                    ?>

                    <?php foreach ($roles as $valor => $nombreRol): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="rol" id="rol_<?php echo $nombreRol ?>"
                                   value="<?php echo $valor ?>" required
                                   <?php if ($rolSeleccionado === $valor) echo 'checked'; ?>>
                            <label class="form-check-label" for="rol_<?php echo $nombreRol ?>">
                                <?php echo $nombreRol ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" class="btn btn-success w-100 mt-auto">
                        <?php echo empty($usuario) ? 'Registrar' : 'Actualizar'; ?>
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>

<?php require_once FOOTER; ?>



