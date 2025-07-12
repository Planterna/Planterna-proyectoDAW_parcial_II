<?php  
if (!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
                <a href="#" class="ms-3"></a>

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
    <div style="margin-top: 60px; display: flex; justify-content: center;">
        <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show text-center p-2 px-4 small d-flex align-items-center justify-content-between" role="alert" style="max-width: 400px; width: 100%;">
            <span class="flex-grow-1"><?php echo $_SESSION['mensaje']; ?></span>
            <i class="bi bi-x fs-5 ms-3" data-bs-dismiss="alert" role="button" aria-label="Cerrar" style="cursor: pointer;"></i>
        </div>
    </div>
    <?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['color']);
} else {
    echo '<div style="margin-top: 75px;"></div>';
}
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
