<!--autor: Jonathan Alejandro Baquerizo-->

<?php require_once HEADER ?>
<div class="container-sm">
  <div class="container-sm" id="form-section">
    <div class="contenedor_solicitud">
      <h2>Formulario de Solicitud de Reparación</h2>
      <p>
        Por favor, complete el siguiente formulario para solicitar una
        reparación de su vehículo. Nos pondremos en contacto con usted lo
        antes posible para confirmar la cita y discutir los detalles.
      </p>
      <div class="contenedor_formulario">
        <form method="POST" action="index.php?c=servicios&f=edit" class="formulario">
          <input type="hidden" name="id" id="id" value="<?php echo $serv["id_Registro"] ?>" />
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" value="<?php echo $serv["nombre"] ?>"
            placeholder="Nombre" required>

          <label for="cedula">Cédula:</label>
          <input type="text" id="cedula" name="cedula" value="<?php echo $serv["cedula"] ?>"
            placeholder="0999999999" required>

          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" value="<?php echo $serv["telefono"] ?>"
            placeholder="0999999999" required>

          <label for="correo">Correo:</label>
          <input type="email" id="correo" name="correo" value="<?php echo $serv["correo"] ?>"
            placeholder="example@example.com" required>

          <label for="marca">Marca del Vehículo:</label>
          <input type="text" id="marca" name="marcaVehiculo" value="<?php echo $serv["marcaVehiculo"] ?>"
            placeholder="FORD 150" required>

          <label for="placa">Placa del Vehículo:</label>
          <input type="text" id="placa" name="placaVehiculo" value="<?php echo $serv["placaVehiculo"] ?>"
            placeholder="ABC123" required>

          <label for="tipoServicio">Tipo de Servicio:</label>
          <input type="text" id="tipoServicio" name="tipoServicio" value="<?php echo $serv["tipoServicio"]?>"
          readonly>
          <button type="submit" class="enviar btn btn-primary d-block mx-auto my-1">
            Enviar Solicitud
          </button>
          <div class="d-flex justify-content-end">
            <a class="my-2 d-block" href="index.php?c=servicios&f=formSearch">Regresar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once FOOTER ?>