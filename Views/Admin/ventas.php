<?php 
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header-adminComprasyVentas.php");
?>

<!--INICIO DEL CONTENIDO DE LA TABLA COMPRAS-->
<div class="container-fluid ">

    <!--TARJETA DEL GRAFICO-->
    
    <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Page Heading -->
    <div>

        <div>
            <h1 class="h3 mb-2 text-gray-800">Ventas</h1>
        </div>



        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- TABLA DE LAS COMPRASSS -->
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                

            </div>



            <!--TABLA COMPRAS-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-success">
                            <tr>
                                <th>Codigo Venta</th>
                                <th>Cliente</th>
                                <th>Numero</th>
                                <th>DNI</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>
                                    Detalles
                                </th>

                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php foreach($ventas as $v): ?>
                            <tr>
                                <th><?=$v["Venta"]["VentaID"]?></th>
                                <td><?=$v["Venta"]["Nombres"]." ".$v["Venta"]["Apellidos"]?></td>
                                <td><?=$v["Venta"]["NumeroTelefono"]?></td>
                                <td><?=$v["Venta"]["DNI"]?></td>
                                <td><?=$v["Venta"]["FechaVenta"]?></td>
                                <td><?=$v["Venta"]["TotalVenta"]?></td>

                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-outline-success"
                                            onclick="mostrarDetalle('v-'+<?=$v['Venta']['VentaID']?>)" type="button"
                                            data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-info-circle fa-lg" style="color: #15a826; "></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            <?php endforeach; ?>





                        </tbody>
                    </table>
                </div>
            </div>
            <!-- MODALS-->

            <!-- MODAL DE INFORMACION - DETALLES DE COMPRA-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detalles de Compra</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="detalles-vent" class="modal-body">
                            <?php foreach($ventas as $v): ?>


                            <table id="v-<?=$v["Venta"]["VentaID"]?>" class="table table-striped d-none" name="tbl">
                                <thead>
                                    <tr class="table-success">
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($v["DetalleVenta"] as $dt):  ?>
                                    <tr>

                                        <td><?=$dt["DetalleVentaID"]?></td>
                                        <td><?=$dt["Nombre"]?></td>
                                        <td><?=$dt["Cantidad"]?></td>
                                        <td><?=$dt["SubTotal"]?></td>

                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endforeach;?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DE MODAL DE INFORMACION - DETALLES DE COMPRA-->
        </div>
    </div>
</div>

<script>
function mostrarDetalle(id) {
    let tablas = document.getElementsByName("tbl");
    tablas.forEach(element =>
        element.classList.add('d-none')
    );

    let tblMostrar =document.getElementById(id);
    tblMostrar.classList.remove('d-none');
}
</script>

<?php include("./Views/Layouts/footer-adminComprasyVentas.php");?>

<script src="<?=$url_host?>assets/js/admin/graficoVenta.js"></script>

</body>

</html>