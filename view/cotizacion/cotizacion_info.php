<!--Autor: Dean Leon-->
<?php require_once HEADER; ?>

<main id="contenedor">
    <div class="container mt-4">
        <h2 class="titulos_h2 text-center mb-4">Información sobre Cotizaciones de Servicio</h2>

        <div class="card p-4 shadow-sm">
            <p>Aquí puedes gestionar las solicitudes de cotización de los clientes para diversos servicios automotrices.</p>
            <p>Los clientes pueden enviar sus requerimientos y nosotros registraremos su solicitud para revisarla y proporcionarles una estimación de costos.</p>
            <p>Este módulo permite:</p>
            <ul>
                <li>Registrar nuevas solicitudes de cotización.</li>
                <li>Ver un listado de todas las cotizaciones pendientes.</li>
                <li>Actualizar el estado de las cotizaciones (Pendiente, Cotizado, Aceptado, Rechazado, etc.).</li>
            </ul>
            <p>Utiliza el formulario de "Solicitar Cotización" para registrar un nuevo requerimiento, o "Ver Cotizaciones" para revisar el estado de las solicitudes existentes.</p>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                <a href="index.php?c=Cotizacion&f=form_registrar" class="btn btn-primary">
                    <i class="fa-solid fa-file-invoice"></i> Solicitar Cotización
                </a>
                <a href="index.php?c=Cotizacion&f=listar" class="btn btn-secondary">
                    <i class="fa-solid fa-list-alt"></i> Ver Cotizaciones
                </a>
            </div>
        </div>
    </div>
</main>

<?php require_once FOOTER; ?>