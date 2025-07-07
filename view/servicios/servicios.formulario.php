<<<<<<< HEAD
<?php require_once HEADER?>
  <div class="container-sm" style="margin-top: 75px;">
  <h2 class="titulos_h2 text-center">Servicios disponibles</h2>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/images/servicio1.PNG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/servicio2.PNG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/servicio3.PNG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/servicio4.PNG" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<?php require_once FOOTER?>
=======
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
      <?php if(empty($id) || is_null($id)){?> 
      <div class="contenedor_formulario">
        <form method="POST" action="index.php?c=servicios&f=newService" class="formulario">
          <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user ?>" />
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>

          <label for="cedula">Cédula:</label>
          <input type="text" id="cedula" name="cedula" placeholder="0999999999" required>

          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" placeholder="0999999999" required>

          <label for="correo">Correo:</label>
          <input type="email" id="correo" name="correo" placeholder="example@example.com" required>

          <label for="marca">Marca del Vehículo:</label>
          <input type="text" id="marca" name="marcaVehiculo" placeholder="FORD 150" required>

          <label for="placa">Placa del Vehículo:</label>
          <input type="text" id="placa" name="placaVehiculo" placeholder="ABC123" required>

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
          <div class="d-flex justify-content-end">
            <a class="my-2 d-block" href="index.php?c=servicios&f=index">Regresar</a>
          </div>
        </form>
      </div>
      <?php }else{?>
        <div class="contenedor_formulario">
        <form method="POST" action="index.php?c=servicios&f=edit" class="formulario">
          <input type="hidden" name="id" id="id" value="<?php echo $serv["id_Registro"] ?>" />
          <input type="hidden" name="id_user" id="id_user" value="<?php echo $serv["id_user"] ?>" />
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
       <?php } ?> 
    </div>
  </div>
</div>
<?php require_once FOOTER ?>
>>>>>>> 40858e616dc5bfcb5344e83b7d8a631c8cd99cfc
