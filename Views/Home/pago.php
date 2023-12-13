<?php
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h4 class="mb-3">Detalles de Pago</h4>
            <div id="paypal-button-container"></div>
        </div>
        <div class="col-6">
            <div class="table table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>SubTotal</th>
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
                            <td><?=$product["Nombre"]?></td>
                            <td>S/. <?=$subTotal?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>
                                <p class="h4">Total: </p>
                            </td>
                            <td>
                                <p class="h4">S/.<?=$total?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=<?=$_ENV['CLIENT_ID']?>&locale=<?=$_ENV['LOCALE']?>&currency=<?=$_ENV['CURRENCY']?>"></script>
<script>
    paypal.Buttons({
        style:{
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?=round($total*0.2637,2)?>
                    }
                }]
            });
        },
        onApprove: function(data, actions){
            let URL = 'http://localhost/DollarCity/home/registrarventa'
            actions.order.capture().then(function (detalles){
                console.log(detalles)

                return fetch(URL,{
                    method: 'post',
                    headers:{
                        'content-type':'application/json'
                    },
                    body:JSON.stringify({
                        detalles:detalles
                    })

                })
            }).then(response => response.json())
            .then(data =>{
                if(data.ok){
                    location.href="http://localhost/DollarCity/home";
                }
                else{
                    alert("Ocurrio un error");
                    location.href="http://localhost/DollarCity/home";
                }
            });
        },
        onCancel: function(data){
            alert("Pago Cancelado");
            console.log(data)
        }
    }).render('#paypal-button-container')
</script>

<?php include("./Views/Layouts/footer.php"); ?>