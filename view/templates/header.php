<<<<<<< HEAD
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Index</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="font-family: 'Times New Roman', Times, serif;">
        <div class="container-fluid">
            <a class="navbar-brand fs-4 fw-bold" href="#">T-AUTO</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=Servicios&f=index">Reparaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=Repuestos&f=index">Repuestos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cotizaciones/cotizaciones.html">Cotizaciones</a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center">
                <span class="ms-3"><i class="fa-solid fa-question text-dark"></i></span>
                <span class="ms-3"><i class="fa-solid fa-user text-dark"></i></span>
            </div>
        </div>
    </nav>
</header>

    
=======
    <?php  
    if (!isset($_SESSION)) session_start();
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <title>Index</title>
    </head>
    <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="font-family: 'Times New Roman', Times, serif;">
            <div class="container-fluid">
                <a class="navbar-brand fs-4 fw-bold" href="#">T-AUTO</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php 
                                echo (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) 
                                    ? 'index.php?c=login&f=dashboard' 
                                    : 'index.php'; 
                            ?>">Inicio</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="index.php?c=Servicios&f=index">Servicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?c=Repuestos&f=index">Repuestos</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?c=Cotizacion&f=info">Cotizaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?c=Tecnico&f=info">Tecnicos a Domicilio</a></li>
                    </ul>
                </div>

                <div class="d-flex align-items-center">
                    <a href="#" class="ms-3"><i class="fa-solid fa-question text-dark"></i></a>

                    <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true): ?>
                        <span class="ms-3"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                        <a href="index.php?c=login&f=logout" class="ms-3" title="Cerrar sesión">
                            <i class="fa-solid fa-right-from-bracket text-dark"></i>
                        </a>
                    <?php else: ?>
                        <a href="index.php?c=login&f=index" class="ms-3" title="Iniciar sesión">
                            <i class="fa-solid fa-user text-dark"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <?php
    // Mostrar mensaje flash si existe
    if (!empty($_SESSION['mensaje'])) {
        ?>
        <div style="margin-top: 60px;" class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['mensaje']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['color']);
    } else {
        // Para evitar que el contenido se oculte bajo el navbar fijo
        echo '<div style="margin-top: 65px"></div>';
    }
    ?>

    <!-- Aquí va el contenido principal de tu página -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

        
>>>>>>> 40858e616dc5bfcb5344e83b7d8a631c8cd99cfc

