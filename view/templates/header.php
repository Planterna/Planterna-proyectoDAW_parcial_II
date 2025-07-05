<?php  
if (!isset($_SESSION))  session_start();
        
// if(empty($_SESSION['user'])){ //simulacion manejo de variables de sesion
//      // redireccionar al login
     
// }
?>

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
                        <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
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
                <a href="#" class="ms-3"><i class="fa-solid fa-question text-dark"></i></a>
                <a href="index.php?c=login&f=index" class="ms-3"><i class="fa-solid fa-user text-dark"></i></a>
            </div>
        </div>
    </nav>
</header>
<?php
       
        if (!empty($_SESSION['mensaje'])) {
            ?>
            <div style="margin-top: 65px;" class="alert alert-<?php echo $_SESSION['color']; ?>
             alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['mensaje']; ?>  
            </div>
            <?php
            //eliminando las variables de sesion
            unset($_SESSION['mensaje']);
            unset($_SESSION['color']);
        } else{?>
        <div style="margin-top: 65px"></div>
            <?php
        }//end if 
        ?>

    

