<?php 
    include("./Views/Layouts/header.php");
    //$productos =  $homeController -> getProducts();

    /*foreach($productos as $producto){
        echo $producto['Nombre'] . "<br>";
    }*/
?>
<div class="contenedor-productos">

    <?php 
$contador = 1;
foreach($productos as $producto):
    ?>

    <div class="card card-producto mb-4 mx-2">
        <?php if($producto->getDescuento() != null): ?>
        <div class="position-absolute top-50 start-50" style="right: 0">
            <h5 class="p-1 card-descuento">-<?=(int)$producto->getDescuento()?>%</h5>
        </div>
        <?php endif ?>
        <div class="container-image-product-card">
            <img src="<?php echo $url_host . $producto->getURLImagen()?>"
                class="card-img-top image-product-card <?=($producto->getCantidadEnStock() <= 0)?'image-agotado':''?>"
                alt="...">
            <?=($producto->getCantidadEnStock() <= 0)?'<span class="text-agotado">AGOTADO</span>':''?>
        </div>

        <div class="contenido-producto-card">
            <div class="titulo">
                <h5 class="card-title nombre-producto-card"><?=$producto->getNombre()?></h5>
            </div>

            <?php if($producto->getDescuento() != null):?>
            <div class="precios">
                <span class="text-center precio-tachado"><s>S/. <?=$producto->getPrecio()?></s></span><br>
                <span class="text-center precio-descuento">S/.
                    <?=round(($producto->getPrecio())-(($producto->getDescuento()/100)*$producto->getPrecio()),2)?></span>
            </div>
            <?php else:?>
            <div class="precios">
                <span class="text-center"><s></s></span><br>
                <span class="text-center">S/. <?=$producto->getPrecio()?></span>
            </div>
            <?php endif?>
            <div class="boton">
                <button class="form-control btn-add-cart <?=($producto->getCantidadEnStock() <= 0)?'btn-agotado':''?>">
                    <i class="fa-solid fa-cart-shopping btn-icon-cart"></i>
                    <span>AGREGAR</span>
                </button>
            </div>

        </div>
    </div>
    <?php endforeach;?>



</div><br>
<?php include("./Views/Layouts/footer.php") ?>