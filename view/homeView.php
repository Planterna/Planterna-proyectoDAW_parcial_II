<?php require_once HEADER; ?>
<main class="contenedor_principal">
    <div class="contenedor_fondo">
      <h1>Servicio Automotriz Profesional</h1>
      <p>Calidad, tecnología y confianza. Accede a los beneficios que ofrecemos</p>
      <div class="buttons">
        <a href="index.php?c=login&f=index" class="btn btn-primary me-3">Accede ya</a>
        <a href="#ofrecemos" class="btn btn-outline-secondary">¿Qué ofrecemos?</a>
      </div>
    </div> 
  </main>
  <section class="seccion">
    <h2>¿Quiénes Somos?</h2>
    <p>
      Somos un taller automotriz con más de 10 años brindando servicios de calidad, profesionalismo y atención personalizada. 
      Nuestro equipo está formado por técnicos altamente capacitados, comprometidos con mantener tu vehículo en óptimas condiciones.
    </p>
    <p>
      Nos especializamos en mantenimiento preventivo, reparación integral, revisión electrónica y diagnóstico por computadora.
      Utilizamos herramientas de última tecnología para asegurar un servicio eficiente y transparente.
    </p>
    <p>
      Nuestro objetivo es brindar una experiencia de confianza y seguridad a cada cliente que nos visita. Estamos ubicados en el centro de la ciudad para tu comodidad.
    </p>
  </section>

  <section id="ofrecemos" class="seccion gris">
  <h2>¿Qué Ofrecemos?</h2>
  <div class="contenedor-deslizante">
    <button class="Deslizante-btn left" onclick="moverDeslizante(-1)">&#10094;</button>

    <div class="Deslizante" id="Deslizante">
      <a href="index.php?c=Servicios&f=index" class="oferta" style="text-decoration: none; color: inherit;">
        <img src="https://www.jacsautocare.com/images/taller-de-mecanica-general-en-guayaquil.jpg" alt="Reparaciones mecanicas" />
        <h3>Reparaciones mecánicas</h3>
        <p>Diagnóstico y solución de problemas del motor, suspensión y frenos.</p>
      </a>
      <a href="index.php?c=Repuestos&f=index" class="oferta" style="text-decoration: none; color: inherit;">
        <img src="https://www.solverdca.com.ar/storage/2019/03/autopartes.e.jpg" alt="Repuestos originales" />
        <h3>Repuestos originales</h3>
        <p>Utilizamos solo piezas originales para garantizar el mejor rendimiento.</p>
      </a>
      <a href="index.php?c=Tecnico&f=info" class="oferta" style="text-decoration: none; color: inherit;">
        <img src="https://www.autoavance.co/wp-content/uploads/2019/10/mecanico-a-domicilio.jpg" alt="Atención tecnica" />
        <h3>Atención tecnica</h3>
        <p>Vamos a donde estés para asistirte con emergencias mecánicas.</p>
      </a>
      <a href="index.php?c=Cotizacion&f=info" class="oferta" style="text-decoration: none; color: inherit;">
        <img src="https://www.css.es/blog/img/cita-previa-taller.jpg" alt="cotizaciones personalizadas" />
        <h3>cotizaciones personalizadas</h3>
        <p>Consulta precios y agenda desde tu celular o computadora.</p>
      </a>
    </div>

    <button class="Deslizante-btn right" onclick="moverDeslizante(1)">&#10095;</button>
  </div>
  
</section>
<script>
  const Deslizante = document.getElementById("Deslizante");
  const Cartillas = Deslizante.children.length;
  const cartillasVista = 3;
  const tamanoCarta = 270; 
  let contador = 0;

  function moverDeslizante(direccion) {
    const maxIndex = Cartillas - cartillasVista;

    contador += direccion;

    if (contador < 0) contador = 0;
    if (contador > maxIndex) contador = maxIndex;

    const scrollAmount = contador * tamanoCarta;
    Deslizante.style.transform = `translateX(-${scrollAmount}px)`;
  }
</script>

<?php
require_once FOOTER; ?>
