<!--Autor: Mero Araujo Jeremy-->
<?php require_once HEADER; ?>
<body class="form-replacement container">
<main class="container">
  <section class="container-form">
    <h2>Registrar Repuesto</h2>

    <form class="form" action="index.php?c=repuestos&f=new" method="POST" name="formulario-crear" id="formulario-crear" novalidate>
      <div id="success-msg" style="display: none; color: green; font-weight: bold; margin-bottom: 15px;"></div>
      <div class="form-section">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $datosFormulario['nombre'] ?? '' ?>">
          <small class="error-message" id="error-nombre"><?= $errores['nombre'] ?? '' ?></small>
        </div>

        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?= $datosFormulario['descripcion'] ?? '' ?>">
          <small class="error-message" id="error-descripcion"><?= $errores['descripcion'] ?? '' ?></small>
        </div>
      </div>

      <div class="form-section">
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="text" name="precio" id="precio" class="form-control" value="<?= $datosFormulario['precio'] ?? '' ?>">
          <small class="error-message" id="error-precio"><?= $errores['precio'] ?? '' ?></small>
        </div>
        
        <div class="form-group">
          <label for="stock">Stock</label>
          <input type="text" name="stock" id="stock" class="form-control" value="<?= $datosFormulario['stock'] ?? '' ?>">
          <small class="error-message" id="error-stock"><?= $errores['stock'] ?? '' ?></small>
        </div>
      </div>

      <div class="form-section">
        <div class="form-group">
          <label for="marca">Marca</label>
          <select id="marca" name="marca" class="form-control">
            <option value="">Seleccione una marca</option>
            <?php foreach ($marcas as $mar): ?>
              <option value="<?= $mar->mar_id ?>" <?= ($datosFormulario['marca'] == $mar->mar_id) ? 'selected' : '' ?>>
                <?= $mar->mar_nombre ?>
              </option>
            <?php endforeach; ?>
          </select>
          <small class="error-message" id="error-marca"><?= $errores['marca'] ?? '' ?></small>
        </div>

        <div class="form-group">
          <label for="modelo">Modelo</label>
          <select id="modelo" name="modelo" class="form-control" <?= empty($modelos) ? 'disabled' : '' ?> data-selected="<?= $datosFormulario['modelo'] ?? '' ?>">
            <option value="">Seleccione un modelo</option>
            <?php if (!empty($modelos)): ?>
              <?php foreach ($modelos as $mod): ?>
                <option value="<?= $mod->mod_id ?>" <?= ($datosFormulario['modelo'] == $mod->mod_id) ? 'selected' : '' ?>>
                  <?= $mod->mod_nombre ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
          <small class="error-message" id="error-modelo"><?= $errores['modelo'] ?? '' ?></small>
        </div>
      </div>

      <fieldset class="fieldset-radio">
        <legend>Tipo de Repuesto</legend>
        <div class="radio-group">
          <label class="radio-label">
            <input type="radio" name="tipoRepuesto" value="Original" <?= ($datosFormulario['tipoRepuesto'] == 'Original') ? 'checked' : '' ?>> Original
          </label>
          <label class="radio-label">
            <input type="radio" name="tipoRepuesto" value="Generico" <?= ($datosFormulario['tipoRepuesto'] == 'Generico') ? 'checked' : '' ?>> Genérico
          </label>
          <label class="radio-label">
            <input type="radio" name="tipoRepuesto" value="Reacondicionado" <?= ($datosFormulario['tipoRepuesto'] == 'Reacondicionado') ? 'checked' : '' ?>> Reacondicionado
          </label>
        </div>
        <small class="error-message" id="error-tipoRepuesto"><?= $errores['tipoRepuesto'] ?? '' ?></small>
      </fieldset>

      <fieldset class="fieldset-radio">
        <legend>Estado</legend>
        <div class="radio-group">
          <input type="checkbox" id="estado" name="estado" value="1" <?= ($datosFormulario['estado'] == '1') ? 'checked' : '' ?>>
          <label for="estado" class="radio-label">Activo</label>
        </div>
      </fieldset>

      <div class="form-group">
        <button type="submit" name="btnRegistrar" id="btn-form" class="btn-submit">Registrar</button>
      </div>
    </form>
  </section>
</main>
<script src="assets/js/script.js"></script>
</body>
<?php require_once FOOTER; ?>
