<!--autor: John Steven Quijije Tovar-->

<?php require_once HEADER; ?>

<main class="d-flex flex-column align-items-center justify-content-center bg-light" style="min-height: 80vh; padding-top: 20px;">
  <div class="bg-white p-5 rounded shadow" style="min-width: 350px;">
    <div class="text-center mb-4">
      <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 2.5rem; font-weight: bold;">T-Auto</h1>
      <h2 class="fw-bold mt-3">Inicia Sesión</h2>
      <p class="text-muted">Accede a tu cuenta para gestionar tus servicios</p>
    </div>

    <form action="index.php?c=login&f=validar" method="POST">
      <div class="mb-3">
        <label for="usuario" class="form-label">Usuario o Correo</label>
        <input type="text" placeholder="Ingresa tu usuario o correo" class="form-control" id="usuario" name="usuario" required>
      </div>

      <div class="mb-3">
        <label for="clave" class="form-label">Contraseña</label>
        <div class="input-group">
          <input type="password" placeholder="Ingresa tu contraseña" class="form-control" id="clave" name="clave" required>
          <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1">
            <span id="togglePasswordIcon">&#128065;</span>
          </button>
        </div>
      </div>

      <div class="text-center mb-3">
        <button type="submit" class="btn btn-primary px-4">Ingresar</button>
      </div>

      <div class="text-center">
        <span>¿No tienes cuenta?</span>
        <a href="index.php?c=login&f=registro" class="text-decoration-none">Regístrate aquí</a>
      </div>
    </form>
  </div>
</main>

<script>
  const toggleBtn = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('clave');
  const icon = document.getElementById('togglePasswordIcon');

  toggleBtn.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.textContent = '◠'; 
    } else {
      passwordInput.type = 'password';
      icon.textContent = '👁'; 
    }
  });
</script>

<?php require_once FOOTER; ?>

