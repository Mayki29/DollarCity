<?php
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header.php");
?>
<style>
.img {
    height: 100px;
    width: auto;
    object-fit: cover;

}
</style>
<div class="container">
    <div class="table table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
        foreach($lista_carrito as $product):
            $precio = round(is_null($product["PrecioFinal"])?$product["Precio"]:$product["PrecioFinal"],2);
            $subTotal = $precio * $product["Cantidad"];
            $total += $subTotal;
        
        
        ?>

                    <tr class="vertical-align-middle">
                        <td class="text-center"><img class="img img-fluid" src="<?php echo $url_host . $product["URLImagen"]?>" alt=""></td>
                        <td><?=$product["Nombre"]?></td>
                        <td>S/. <?=$precio?></td>
                        <td style="width:100px"><input class="form-control" name="cantidad" type="number" min="1" value="<?=$product["Cantidad"]?>" max="10" onchange="actualizarCantidad(this.value,<?=$product['ProductoID']?>)">
                        </td>
                        <td>S/. <?=$subTotal?></td>
                        <td><button class="btn" onclick="eliminarCariito(<?=$product['ProductoID']?>)">X</button></td>
                    </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td class="text-center"><p class="h4">Total: </p></td>
                        <td colspan="3"></td>
                        <td><p class="h4">S/.<?=$total?></p></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end my-3">
                <div class="col-4">
                    <a href="http://localhost/DollarCity/home/pago" class="btn btn-primary form-control" <?=$total <= 0 ? 'style="pointer-events: none; cursor: default;"' : '' ?>>Realizar Pago</a>
                </div>
            </div>
    </div>

    <script>
        function actualizarCantidad(cantidad, id){
            let inputs = document.getElementsByName("cantidad");
            inputs.forEach(element => {
                element.disabled = true;
            });
            let url = 'http://localhost/DollarCity/home/actualizarcantidad';
            let formData = new FormData();
            formData.append('id', id);
            formData.append('cantidad',cantidad)
            fetch(url,{
                method: 'POST',
                body: formData,
                mode:'cors'
            }).then(response => response.json())
            .then(data =>{
                if(data.ok){
                    location.reload();
                }
                else{
                    alert("Ocurrio un error");
                }
            })
        }

        function eliminarCariito(id){
            let url = 'http://localhost/DollarCity/home/eliminarcariito';
            let formData = new FormData();
            formData.append('id', id);
            fetch(url,{
                method: 'POST',
                body: formData,
                mode:'cors'
            }).then(response => response.json())
            .then(data =>{
                if(data.ok){
                    location.reload();
                }
                else{
                    alert("Ocurrio un error");
                }
            })
        }
    </script>

<?php include("./Views/Layouts/footer.php"); ?>