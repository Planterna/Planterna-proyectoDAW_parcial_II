<!--Autor: Lopez Anthony-->
<?php require_once HEADER; ?>

<main id="contenedor">
    <div class="info-section">
        <h2 class="titulos_h2 text-center mb-4">Nuestros Técnicos a Domicilio</h2>
        
        <div class="info-card">
            <img src="assets/images/tecnico_a_domicilio.jpg" alt="Técnico a Domicilio" class="info-image">
            <div class="info-content">
                <h3>¿Qué es el Servicio de Técnico a Domicilio?</h3>
                <p>
                    En T-AUTO entendemos que tu tiempo es valioso. Por eso, ofrecemos un servicio de técnico a domicilio para que recibas atención experta sin salir de casa o la oficina. Nuestros técnicos certificados se desplazan a tu ubicación para realizar diagnósticos, mantenimientos y reparaciones menores, brindándote comodidad y eficiencia.
                </p>
                <p>
                    Este servicio está diseñado para atender tus necesidades automotrices urgentes o programadas, desde revisiones de rutina hasta soluciones a problemas específicos, justo donde lo necesitas.
                </p>
            </div>
        </div>

        <div class="info-card reverse">
            <img src="assets/images/experiencia_tecnicos.jpg" alt="Experiencia de Técnicos" class="info-image">
            <div class="info-content">
                <h3>Profesionales Certificados y Confiables</h3>
                <p>
                    Contamos con un equipo de técnicos altamente cualificados, con años de experiencia en diversas especialidades automotrices. Cada uno de nuestros profesionales está capacitado para diagnosticar y resolver una amplia gama de problemas en tu vehículo.
                </p>
                <p>
                    Nuestra prioridad es tu seguridad y la de tu vehículo. Por ello, solo trabajamos con personal de confianza, asegurando un servicio de calidad y la tranquilidad que te mereces.
                </p>
            </div>
        </div>

        <div class="info-card">
            <img src="assets/images/beneficios_domicilio.jpg" alt="Beneficios del Servicio a Domicilio" class="info-image">
            <div class="info-content">
                <h3>Beneficios del Servicio a Domicilio</h3>
                <ul>
                    <li><i class="fa-solid fa-check-circle"></i> Comodidad: Recibe atención sin mover tu vehículo.</li>
                    <li><i class="fa-solid fa-check-circle"></i> Ahorro de Tiempo: Evita traslados y esperas en el taller.</li>
                    <li><i class="fa-solid fa-check-circle"></i> Flexibilidad: Agenda citas según tu disponibilidad.</li>
                    <li><i class="fa-solid fa-check-circle"></i> Transparencia: Observa el proceso de reparación en persona.</li>
                    <li><i class="fa-solid fa-check-circle"></i> Atención Personalizada: Nuestros técnicos se enfocan en tu vehículo.</li>
                </ul>
            </div>
        </div>

        <div class="cta-section text-center">
            <h3>¿Listo para solicitar un técnico a domicilio?</h3>
            <p>Contáctanos hoy mismo para programar una visita y obtener una cotización.</p>
            <a href="index.php?c=Tecnico&f=listar" class="btn-primary">Ver Nuestros Técnicos Disponibles</a>
        </div>
    </div>
</main>

<?php require_once FOOTER; ?>

<style>
    .info-section {
        padding: 40px 20px;
        max-width: 1000px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    .info-section h2 {
        color: #333;
        font-size: 2.5em;
        margin-bottom: 30px;
    }

    .info-card {
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
    }

    .info-card.reverse {
        flex-direction: row-reverse;
    }

    .info-image {
        width: 40%;
        height: auto;
        object-fit: cover;
    }

    .info-content {
        width: 60%;
        padding: 30px;
    }

    .info-content h3 {
        color: #007bff; /* Color primario */
        font-size: 1.8em;
        margin-bottom: 15px;
    }

    .info-content p {
        line-height: 1.6;
        color: #555;
        margin-bottom: 15px;
    }

    .info-content ul {
        list-style: none;
        padding: 0;
    }

    .info-content ul li {
        margin-bottom: 10px;
        color: #555;
    }

    .info-content ul li i {
        color: #28a745; /* Color de éxito */
        margin-right: 10px;
    }

    .cta-section {
        margin-top: 50px;
        padding: 30px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .cta-section h3 {
        color: #333;
        font-size: 2em;
        margin-bottom: 15px;
    }

    .cta-section p {
        color: #666;
        font-size: 1.1em;
        margin-bottom: 25px;
    }

    .cta-section .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 12px 25px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1.1em;
        transition: background-color 0.3s ease;
    }

    .cta-section .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Media Queries para responsividad */
    @media (max-width: 768px) {
        .info-card {
            flex-direction: column;
        }
        .info-card.reverse {
            flex-direction: column;
        }
        .info-image,
        .info-content {
            width: 100%;
        }
        .info-content {
            padding: 20px;
        }
        .info-section h2 {
            font-size: 2em;
        }
        .info-content h3 {
            font-size: 1.5em;
        }
    }
</style>