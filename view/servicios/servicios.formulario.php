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
        <form method="POST" action="index.php?c=servicios&f=newService" class="formulario">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" required>

          <label for="cedula">Cédula:</label>
          <input type="text" id="cedula" name="cedula" required>

          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" required>

          <label for="correo">Correo:</label>
          <input type="text" id="correo" name="correo" required>

          <label for="marca">Marca del Vehículo:</label>
          <input type="text" id="marca" name="marcaVehiculo" required>

          <label for="placa">Placa del Vehículo:</label>
          <input type="text" id="placa" name="placaVehiculo" required>

          <label>Tipo de Servicio:</label>
          <select name="tipoServicio">
            <option value="NINGUNA" selected>Ninguna</option>
            <option value="MANTENIMIENTO PREVENTIVO">Mantenimiento Preventivo</option>
            <option value="REPARACIONES">Reparaciones</option>
            <option value="SERVICIO TECNICO">Servicio Técnico</option>
          </select>
          <button type="submit" class="enviar btn btn-primary d-block mx-auto my-1">
            Enviar Solicitud
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once FOOTER ?>