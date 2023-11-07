<?php 
    include("./Views/Layouts/header.php");
    //$productos =  $homeController -> getProducts();

    /*foreach($productos as $producto){
        echo $producto['Nombre'] . "<br>";
    }*/
?>
<div class="container mt-5">

    <?php 
$contador = 1;
foreach($productos as $producto){
echo ($contador == 1)? '<div class="row mb-4">' :'';
    ?>

    <div class="col-md-2">
        <a href="producto.html" class="text-dark">
            <div class="card">
                <img src="<?php echo $url_host ?>assets/img/exprimidor-limon.png" class="card-img-top" alt="">
                <div class="card-body">
                    <p><?=$producto->getNombre()?></p>
                    <p class="font-weight-light">S/.<?=$producto->getPrecio()?></p>
                    <button class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping"></i> Agregar</button>
                </div>
            </div>
        </a>
    </div>
    <?php 

echo ($contador == 6)? '</div>' :'';

$contador = ($contador == 6)?1:$contador+1;
} 
?>



</div><br>
<?php include("./Views/Layouts/footer.php") ?>