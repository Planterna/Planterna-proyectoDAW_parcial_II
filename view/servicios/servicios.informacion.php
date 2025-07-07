<!--autor: Jonathan Alejandro Baquerizo--> 

<?php require_once HEADER ?>
<div class="container-sm">
    <h2 class="titulos_h2 text-center mb-4">Servicios disponibles</h2>
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/servicio1.PNG" class="d-block w-100" alt="Servicio Mecanico">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/servicio2.PNG" class="d-block w-100" alt="Servicio Electromecanico">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/servicio3.PNG" class="d-block w-100" alt="Servicio de Mantenimiento">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/servicio4.PNG" class="d-block w-100" alt="Servicio de Reparacion">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev" style="z-index: 2;">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next" style="z-index: 2;">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-12 mt-4 text-center"> 
            <?php if($rol == 2){ ?>
                <div class="d-grid gap-2 col-md-6 mx-auto"> 
                <a href="index.php?c=Servicios&f=formSearch" class="btn btn-secondary btn-lg w-100" role="button">Estado de Servicios</a> 
            </div>
            <?php }elseif($rol == 1 || $rol == 3 || $rol == 0){?>
                 <div class="d-grid gap-2 col-md-6 mx-auto"> 
                
                <a href="index.php?c=Servicios&f=formInit" class="btn btn-primary btn-lg w-100" role="button">Solicitar Servicios</a>
               
                <a href="index.php?c=Servicios&f=formSearch" class="btn btn-secondary btn-lg w-100" role="button">Estado de Servicios</a> 
            </div>
            <?php
            }
            ?> 
        </div>
    </div>
</div>
<?php require_once FOOTER ?>