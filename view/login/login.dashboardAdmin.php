<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php?c=login&f=index");
    exit();
}

require_once HEADER;
?>

<?php require_once SLIDERBAR; ?>

</style>

<main class="container pt-4 ml-sidebar">
    <h2 class="fw-semibold mb-4 text-center text-uppercase">Crear usuario</h2>
    <br><br>
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-8">
            <form class="row g-4" method="POST" action="index.php?c=login&f=registrar">  

                <!-- ===== Columna izquierda ===== -->
                <div class="col-12 col-lg-4 border-end">
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="text" name="cedula" id="cedula" class="form-control"
                               placeholder="0102030405" pattern="\d{10}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                               placeholder="Nombre y Apellido" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control"
                               placeholder="ejemplo@correo.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control"
                               placeholder="0999999999" pattern="\d{9,10}" required>
                    </div>
                </div>

                <!-- ===== Columna centro ===== -->
                <div class="col-12 col-lg-4 border-end">
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_password" class="form-label">Confirmar contraseña</label>
                        <input type="password" name="confirmar_password" id="confirmar_password" 
                               class="form-control" required>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="notificaciones" id="notificaciones">
                        <label class="form-check-label" for="notificaciones">
                            Deseo recibir información y promociones
                        </label>
                    </div>
                </div>

                <!-- ===== Columna derecha ===== -->
                <div class="col-12 col-lg-4 d-flex flex-column align-items-start">
                    <label class="form-label mb-2">Asignar rol</label>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="rol" id="rol_admin" value="3" required>
                        <label class="form-check-label" for="rol_admin">Administrador</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="rol" id="rol_tecnico" value="2" required>
                        <label class="form-check-label" for="rol_tecnico">Técnico</label>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="rol" id="rol_usuario" value="1" required>
                        <label class="form-check-label" for="rol_usuario">Usuario</label>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-auto">
                        Registrar
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>

<?php require_once FOOTER; ?>


