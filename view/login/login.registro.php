<!--autor: John Steven Quijije Tovar-->

<?php require_once HEADER; ?>
<div class="container py-5 bg-light"> 
  <div class="card p-4 mx-auto" style="max-width: 600px;"> 
    <h1 class="text-center" style="font-family: 'Times New Roman', Times, serif; font-size: 2.5rem; font-weight: bold;">Crear Cuenta</h1>
    <p class="text-center mb-4">Llena el formulario para registrarte en el sistema.</p> 
   
   
    <form method="POST" action="index.php?c=login&f=registrar">

      <div class="mb-3"> <label for="cedula" class="form-label">Cédula:</label>
        <input type="text" id="cedula" name="cedula" class="form-control" placeholder="Ej. 0102030405" required pattern="\d{10}">
      </div>

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre y Apellido" required>
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" class="form-control" placeholder="ejemplo@correo.com" required>
      </div>

      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" class="form-control" placeholder="0999999999" required pattern="\d{9,10}">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="confirmar_password" class="form-label">Confirmar Contraseña:</label>
        <input type="password" id="confirmar_password" name="confirmar_password" class="form-control" required>
      </div>

      <div class="form-check mb-3"> <input type="checkbox" name="notificaciones" id="notificaciones" class="form-check-input">
        <label for="notificaciones" class="form-check-label">Deseo recibir información y promociones</label>
      </div>

      <button type="submit" class="btn btn-primary w-100 mt-3">Registrarse</button>
    </form>

    <div class="text-center mt-3">
    <span>¿Ya tienes cuenta? </span>  
    <a href="index.php?c=login&f=index" class="text-decoration-none"> Inicia sesión</a>
    </div>
  </div>
</div>

<?php require_once FOOTER; ?>

