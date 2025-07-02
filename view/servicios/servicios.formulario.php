<!--autor: Jonathan Alejandro Baquerizo-->

<?php require_once HEADER ?>
<div class="container-sm" style="margin-top: 75px;">
<div class="container-sm" id="form-section">
  <div class="contenedor_solicitud">
    <h2>Formulario de Solicitud de Reparación</h2>
    <p>
      Por favor, complete el siguiente formulario para solicitar una
      reparación de su vehículo. Nos pondremos en contacto con usted lo
      antes posible para confirmar la cita y discutir los detalles.
    </p>
    <div class="contenedor_formulario">
      <form class="formulario">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>

        <label for="correo">Correo:</label>
        <input type="text" id="correo" name="correo" required>

        <label for="marca">Marca del Vehículo:</label>
        <input type="text" id="marca" name="marca" required>

        <label for="modelo">Modelo del Vehículo:</label>
        <input type="text" id="modelo" name="modelo" required>

        <label>Tipo de Servicio:</label>
        <div class="radio-group">
          <input type="radio" id="mantenimiento" name="servicio" value="Mantenimiento">
          <label for="mantenimiento">Mantenimiento Preventivo</label>

          <input type="radio" id="reparaciones" name="servicio" value="Reparaciones">
          <label for="reparaciones">Reparaciones</label>

          <input type="radio" id="tecnico" name="servicio" value="Servicio Tecnico">
          <label for="tecnico">Servicio Técnico</label>
        </div>
        <button type="button" id="enviar">
          Enviar Solicitud
        </button>
      </form>
    </div>
  </div>
</div>  
</div>
<?php require_once FOOTER ?>