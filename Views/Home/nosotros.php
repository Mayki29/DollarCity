<?php
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header.php");
?>

<div class="container">
    <div class="row mt-5 align-items-center">
        <div class="col-md-6 text-center">
            <img src="<?=$url_host?>assets/img/nosotros-1.jpg" class="img-thumbnail">
        </div>
        <div class="col-md-6 px-5 bac">
            <h2 class="mb-3">Mision</h2>
            <p class="mb-5">Nuestra misión es agregar valor a nuestros clientes, ofreciendo una experiencia de
                compra única a través de una amplia variedad de productos de buena calidad a excelentes
                precios.</p>

            <h2 class="mb-3">Vision</h2>
            <p>Desde 2009 hasta el día de hoy, seguimos creciendo exponencialmente gracias a un equipo
                comprometido con hacer realidad nuestra visión de llegar a toda Latinoamérica.</p>
        </div>
    </div>
    <div class="row my-5 align-items-center">

        <div class="col-md-6 px-5 bac">
            <h2 class="mb-3">Somos parte de algo grande</h2>
            <p class="mb-5">Sabemos que nuestra gente nos hace grande. Por ello, desde el día uno, buscamos
                construir una empresa exitosa enfocada en nuestra gente. Es gracias a su pasión, trabajo en equipo
                y esfuerzo que seguimos rompiendo fronteras, abriendo más tiendas, generando más oportunidades y
                formando parte de algo grande.</p>


        </div>
        <div class="col-md-6 text-center">
            <img src="<?=$url_host?>assets/img/nosotros-2.jpg" class="img-thumbnail">
        </div>
    </div>

</div>
<?php include("./Views/Layouts/footer.php"); ?>