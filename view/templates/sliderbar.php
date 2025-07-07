
<!-- Sidebar fijo (izquierdo) -->
<nav class="position-fixed bg-light vh-100 shadow-sm pt-4 px-3"
    style="width: 240px; top: 70px; left: 0; overflow-y: auto; z-index: 1000;">
    <div class="accordion" id="sidebarMenu">

       <!-- Inicio -->
       <a class="text-decoration-none text-dark d-block mb-3"
         href="index.php?c=login&f=dashboard">
          <i class="fa-solid fa-house me-2"></i> Inicio
       </a>

       <!-- Gestión de Usuarios -->
       <div class="accordion-item border-0">
          <h2 class="accordion-header" id="headingUsers">
             <button class="accordion-button bg-light text-dark collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseUsers"
                    aria-expanded="false" aria-controls="collapseUsers">
                <i class="fa-solid fa-user me-2"></i> Gestión de Usuarios
             </button>
          </h2>
          <div id="collapseUsers" class="accordion-collapse collapse"
              aria-labelledby="headingUsers" data-bs-parent="#sidebarMenu">
             <div class="accordion-body py-1">
                <ul class="nav flex-column">
                    <li class="nav-item">
                       <a class="nav-link text-dark" href="index.php?c=login&f=dashboardAdmin">
                          Agregar Usuario
                       </a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link text-dark" href="index.php?c=login&f=listarUsuarios">
                          Listar Usuarios
                       </a>
                    </li>
                </ul>
             </div>
          </div>
       </div>

       <!-- Reportes -->
       <div class="accordion-item border-0 mt-2">
          <h2 class="accordion-header" id="headingReportes">
             <button class="accordion-button bg-light text-dark collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseReportes"
                    aria-expanded="false" aria-controls="collapseReportes">
                <i class="fa-solid fa-chart-column me-2"></i> Reportes
             </button>
          </h2>
          <div id="collapseReportes" class="accordion-collapse collapse"
              aria-labelledby="headingReportes" data-bs-parent="#sidebarMenu">
             <div class="accordion-body py-1">
                <ul class="nav flex-column">
                    <li class="nav-item">
                       <a class="nav-link text-dark" href="index.php?c=reportes&f=dashboard">
                          Resumen del Sistema
                       </a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link text-dark" href="index.php?c=reportes&f=graficos">
                          Gráficos
                       </a>
                    </li>
                </ul>
             </div>
          </div>
       </div>

       <!-- Cerrar sesión -->
       <div class="mt-4">
          <a class="text-decoration-none text-danger d-block"
            href="index.php?c=login&f=logout"
            onclick="return confirm('¿Está seguro de que quiere cerrar sesión?');">
             <i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar sesión
          </a>
       </div>
       
    </div>
</nav>
