<!--autor: Jonathan Alejandro Baquerizo-->

<?php require_once HEADER ?>
<div class="container-sm">
    <h2 class="titulos_h2 text-center mb-4">Servicios disponibles</h2>
    <div class="row">
        <div class="col-12">
            <div id="carouselPhoto" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/servicioReparaciones.jpg" class="d-block w-100" alt="Servicio Reparaciones">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Reparaciones</h5>
                            <p>El servicio de reparaciones automotrices abarca la detección, diagnóstico y corrección de fallas mecánicas,
                                 eléctricas y electrónicas en vehículos. Incluye trabajos como la reparación de motores, transmisiones,
                                  sistemas de frenos, suspensión, dirección, sistema de enfriamiento, escape y componentes eléctricos. 
                                  Su objetivo es restaurar el funcionamiento seguro y eficiente del vehículo, utilizando herramientas 
                                  especializadas, repuestos de calidad y personal técnico capacitado. Este servicio es esencial para mantener 
                                  la confiabilidad del automóvil y cumplir con los estándares de seguridad y rendimiento.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/servicioTecnico.jpeg" class="d-block w-100" alt="Servicio Tecnico">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Servicio Tecnico</h5>
                            <p>El servicio mecánico consiste en el diagnóstico, mantenimiento preventivo y reparación de vehículos automotores para garantizar su correcto funcionamiento, seguridad y eficiencia. 
                                Este servicio abarca desde cambios de aceite, revisión de frenos, alineación y balanceo, hasta reparaciones más complejas del motor, la transmisión y el sistema eléctrico. 
                                El objetivo es prolongar la vida útil del vehículo, prevenir fallos mecánicos y asegurar el desempeño óptimo del automóvil bajo cualquier condición.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/servicioMantenimientoPreventivo.jpg" class="d-block w-100" alt="Servicio de Mantenimiento">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Mantenimineto Preventivo</h5>
                                <p>El mantenimiento preventivo consiste en la ejecución planificada de inspecciones, ajustes, limpieza, lubricación
                                     y sustitución de piezas o componentes antes de que se produzcan fallas. Este servicio se aplica a equipos,
                                      maquinarias, vehículos o sistemas con el fin de prolongar su vida útil, mejorar su rendimiento y reducir 
                                      los tiempos de inactividad no programados. A través de rutinas periódicas y controles técnicos, el mantenimiento
                                    preventivo minimiza el riesgo de averías costosas, garantiza la seguridad operativa y optimiza la productividad.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPhoto" data-bs-slide="prev" style="z-index: 2;">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPhoto" data-bs-slide="next" style="z-index: 2;">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-12 mt-4 text-center">
            <?php if ($rol == 2) { ?>
                <div class="d-grid gap-2 col-md-6 mx-auto">
                    <a href="index.php?c=Servicios&f=formSearch" class="btn btn-secondary btn-lg w-100 buttonLinkSec" role="button">Estado de Servicios</a>
                </div>
            <?php } elseif ($rol == 1 || $rol == 3 || $rol == 0) { ?>
                <div class="d-grid gap-2 col-md-6 mx-auto">

                    <a href="index.php?c=Servicios&f=formInit" class="btn btn-primary btn-lg w-100 buttonLinkPri" role="button">Solicitar Servicios</a>

                    <a href="index.php?c=Servicios&f=formSearch" class="btn btn-secondary btn-lg w-100 buttonLinkSec" role="button">Estado de Servicios</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php require_once FOOTER ?>