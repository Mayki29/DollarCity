<?php 
    include("./Views/Layouts/header.php");
    //$productos =  $homeController -> getProducts();

    /*foreach($productos as $producto){
        echo $producto['Nombre'] . "<br>";
    }*/
?>
<div class="container container-white">
    <div class="row my-5 py-5">
        <div class="col-md-4">
            <img src="assets/img/exprimidor-limon.png" width="100%" alt="">
        </div>
        <div class="col-md-8">
            <h1 class="titulo-precio"><?=$producto->getNombre()?></h1>
            <p><?=$producto->getDescripcion()?></p>
            <div class="ml-5">
                <ul>
                    <li>Tiene un tamaño de 6x20,5x4,7 cm</li>
                </ul>
            </div>
            <div class="mt-5">
                <span class="precio"><?=$producto->getPrecio()?></span>

            </div>
            <div class="mt-3">
                <label id="lblCantidad" for="txtCantidad">Cantidad</label><br>
                <input type="number" class="mb-2" value="1" min="1" name="txtCantidad" id="txtCantidad"><br>
                <button class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Agregar carrito</button>
            </div>

        </div>
    </div>



</div>
<?php include("./Views/Layouts/footer.php") ?>