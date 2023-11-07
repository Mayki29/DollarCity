<?php
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header.php");
?>

<div class="container">
    <div class="row mt-5 align-items-center">
        <div class="col-md-6 text-center">
            <img src="<?=$url_host?>/assets/img/FotoUbicacionDC.png" class="img-thumbnail">
        </div>
        <div class="col-md-6 text-center">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1935.055426101778!2d-75.72957956729351!3d-14.070630840286173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9110e3d4f20171b3%3A0x754bf63330fbfa40!2sDollarcity%20Plaza%20del%20Sol%20Ica!5e0!3m2!1ses-419!2spe!4v1697073654865!5m2!1ses-419!2spe"
                width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!--<img src="assets/img/UbicaionDollar.png" class="img-thumbnail">-->
        </div>
        <div class="col-md-6 px-5 bac">
            <br>
            <h2 class="mb-3">Ica Plaza del Sol</h2>
            <p class="mb-5">Centro Comercial Plaza del Sol, Avenida San Martín #727-763, Ica 11001</p>

            <p>Desde 2009 hasta el día de hoy, seguimos creciendo exponencialmente gracias a un equipo
                comprometido con hacer realidad nuestra visión de llegar a toda Latinoamérica.</p>
        </div>
    </div>

</div>
<?php include("./Views/Layouts/footer.php"); ?>