<?php 
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header-adminComprasyVentas.php");
?>
<!--Datos de la compra -->
<script>
let dataDetalle = <?=json_encode($compras)?>;
let dataProductos = <?=json_encode($productos)?>;
</script>
<!--INICIO DEL CONTENIDO DE LA TABLA COMPRAS-->
<div class="container-fluid ">

    <!--TARJETA DEL GRAFICO-->
    <div class="col-xl-8 col-lg-7   align-items-center justify-content-center">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                <h5>Compras</h5>
            </div>
            <!-- Card Body -->
            <div class="card-body justify-content-center  align-items-center">
                <div class="chart-area">
                    <canvas id="chartCompra"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Page Heading -->
    <div>

        <div>
            <h1 class="h3 mb-2 text-gray-800">Compras</h1>
        </div>



        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- TABLA DE LAS COMPRASSS -->
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Compras</h5>
                <br>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-success " type="button" id="btnBuscarTabla">Buscar</button>
                    </div>
                    <input type="text" class="form-control bg-emphasis border-1 small" placeholder="Buscar..."
                        aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
                <!-- BOTON PARA AGREGAR COMPRA -->
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fas fa-cash-register"> Agregar Compra</i>
                </button>

            </div>



            <!--TABLA COMPRAS-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-success">
                            <tr>
                                <th>CodigoCompra</th>
                                <th>Empleado</th>
                                <th>Proveedor</th>
                                <th>Fecha</th>
                                <th>Total</th>

                                <th>
                                    <div style=" display: flex;">
                                        <i class="fas fa-tools"></i>
                                    </div>

                                </th>
                                <th>
                                    Detalles
                                </th>

                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php foreach($compras as $compra): ?>
                            <tr id="tr<?=$compra->getCompraID()?>">
                                <th><?=$compra->getCompraID()?></th>
                                <td><?=$compra->getUsuario()->getNombres()." ".$compra->getUsuario()->getApellidos()?>
                                </td>
                                <td><?=$compra->getProveedor()->getRazonSocial()?></td>
                                <td><?=$compra->getFechaCompra()?></td>
                                <td>S/.<span><?=$compra->getTotalCompra()?></span></td>

                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-outline-warning " type="button" data-toggle="modal"
                                            data-target="#staticBackdrop2"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-outline-danger" type="button" data-toggle="modal"
                                            data-target="#EliminarCompra"
                                            onclick="setCodigoEliminar(<?=$compra->getCompraID()?>)">
                                            <i class="fas fa-trash-alt "></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-outline-success"
                                            onclick="cargarTablaDetalleCompra(<?=$compra->getCompraID()?>)"
                                            type="button" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-info-circle fa-lg" style="color: #15a826; "></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            <?php endforeach ?>




                        </tbody>
                    </table>
                </div>
            </div>
            <!-- FIN DE LA TABLA COMPRAS-->


            <!-- MODALS-->
            <!--MODAL DE AGREGAR LA COMPRA-->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Agregar Compra</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="frmRegistrarCompra">

                                <!-- Agrega aquí los campos del formulario para agregar datos -->
                                <table>
                                    <tr>
                                        <fieldset disabled>
                                            <div class="form-group">
                                                <label for="disabledTextInput">Empleado: </label>
                                                <input type="hidden" id="disabledTextInput" name="txtIdEmpleado"  class="form-control" value="<?= $_SESSION['user']->getUsuarioID() ?>">
                                                <input type="text" id="disabledTextInput" class="form-control" value="<?=$_SESSION['user']->getNombres().$_SESSION['user']->getApellidos()?>"
                                                    placeholder="Empleado1">
                                            </div>

                                    </tr>

                                    <tr>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"
                                                    for="inputGroupSelect01">Proveedor</label>

                                            </div>
                                            <select class="custom-select" id="inputGroupSelect01" name="slcProveedor">
                                                <?php foreach($proveedores as $proveedor):?>
                                                <option value="<?= $proveedor->getProveedorID()?>">
                                                    <?= $proveedor->getRazonSocial()?>
                                                </option>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </tr>

                                    <tr>
                                        <td> <label for="apellido">Fecha:</label></td>
                                        <td><input type="datetime-local" class="form-control" rows="3" id="apellido"
                                                placeholder="Descripcion..." name="dtFecha"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Producto</td>
                                        <td>Cantidad</td>

                                        <td></td>
                                    </tr>

                                    <tr>
                                        <!--datalist id="dlOpcionesProductos">
                                            <option value="Opción 1">
                                            
                                        </datalist-->
                                        <td><input type="text" class="form-control productoCompra"
                                                id="txtProductosAgregar" placeholder="Producto..."
                                                list="dlOpcionesProductos" onchange="//cargarDataListProductos()"
                                                required></td>

                                        <td>
                                            <input type="number" class="form-control cantidadCompra"
                                                placeholder="Cantidad..." min="1" required>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-outline-success agregarProducto">
                                                <i class="fas fa-cash-register"></i>
                                            </button>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>

                                </table>
                                <table>
                                    <h6>Productos a comprar</h6>
                                    <div class="form-control productosSeleccionados"
                                        style="height: auto; overflow-y: auto;"></div>


                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                </table>

                                <table>
                                    <!--tr>
                                        <td><label for="Subtotal">Subtotal: </label></td>
                                        <td> <input type="text" class="form-control" name="subtotal" placeholder="0.0"
                                                id="subtotal"></td>
                                    </tr-->
                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>


                                        <td><label for="disabledTextInput">TOTAL: </label></td>
                                        <td><input type="text" id="disabledTextInput" class="form-control txtTotal"
                                                placeholder="0.0" disabled></td>
                                    </tr>

                                </table>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-outline-success"
                                onclick="registrarCompra()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--SCRIPT PARA AGREGAR PRODUCTOS AL MOMENTO-->
            <script>
            //Temporal
            function buscarProductoPorIdLocal(id) {
                let prod;
                for (let producto of dataProductos) {
                    if (producto.ProductoID === id.toString()) {
                        prod = producto;
                        return prod;

                    }
                }
                return null;
            }
            let precioTotal = 0;
            function calcularTotal(precio, operacion){
                switch(operacion){
                    case "suma": precioTotal += parseFloat(precio); break;
                    case "resta": precioTotal -= parseFloat(precio); break;
                }
                document.getElementsByClassName("txtTotal").disabledTextInput.value = precioTotal.toFixed(2);
            }
            document.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('agregarProducto')) {
                    const productoInput = event.target.closest('tr').querySelector('.productoCompra');
                    const cantidadInput = event.target.closest('tr').querySelector('.cantidadCompra');

                    const producto = productoInput.value.trim();
                    const cantidad = cantidadInput.value.trim();

                    if (producto !== '' && cantidad > 0) {
                        let p = buscarProductoPorIdLocal(producto); //function temporal
                        const productoDiv = document.createElement('div');
                        productoDiv.className = 'd-flex justify-content-between producto-seleccionado';
                        productoDiv.innerHTML = `
                                                    <input type="hidden" class="form-control producto-deshabilitado productoCompraL" value="${p.ProductoID}" disabled>
                                                    <input type="hidden" class="form-control producto-deshabilitado cantidadCompraL" value="${cantidad}" disabled>
                                                    <input type="text" class="form-control producto-deshabilitado" value="${p.Nombre} x ${cantidad} -> S/ ${(cantidad * p.Precio).toFixed(2)}" disabled>
                                                    <input type="hidden" class="form-control producto-deshabilitado subTotal" name="txtSubtotal" value="${(cantidad * p.Precio).toFixed(2)}" disabled>
                                                    <button type="button" class="btn btn-outline-danger btn-sm eliminarProducto">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                `;

                        document.querySelector('.productosSeleccionados').appendChild(productoDiv);

                        calcularTotal((cantidad * p.Precio).toFixed(2), "suma");

                        productoInput.value = '';
                        cantidadInput.value = '';
                    }
                }

                if (event.target && event.target.classList.contains('eliminarProducto')) {
                    let subT = event.target.closest('.producto-seleccionado').getElementsByClassName("subTotal").txtSubtotal.value;
                    calcularTotal(subT, "resta");
                    event.target.closest('.producto-seleccionado').remove();
                }
            });
            </script>

            <!--FIN DEL SCRIPT-->
            <!--SCRIPT BUSCAR-->
            <script>
            $(document).ready(function() {
                $('#btnBuscarTabla').on('click', function() {
                    const textoBusqueda = $('#buscarTabla').val().toLowerCase();
                    $('#dataTable tbody tr').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(textoBusqueda) > -
                            1);
                    });
                });
            });
            </script>

            <!--FIN DEL FORMULARIO PARA AGREGAR LA COMPRA-->


            <!-- MODAL ELIMINAR COMPRA -->
            <div class="modal fade" id="EliminarCompra" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar Compra</h5>
                            <input type="number" id="deleteCod" name="deleteCod" style="display: none;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que quieres cancelar esta compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-outline-primary" onclick="eliminarCompra()">Sí</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DEL MODAL PARA ELIMINAR COMPRA -->




            <!-- MODAL PARA MODIFICAR LA COMPRA-->
            <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modificar Compra</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- FORMULARIO-->
                            <form>

                                <!-- Agrega aquí los campos del formulario para modificar datos -->
                                <table>
                                    <tr>
                                        <div class="form-group">
                                            <label for="empleado">Empleado:</label>
                                            <input type="text" class="form-control" id="empleado"
                                                placeholder="Empleado1">
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="proveedor">Proveedor</label>
                                            </div>
                                            <select class="custom-select" id="proveedor">
                                                <option selected>Elige un proveedor...</option>
                                                <option value="1">proveedor1</option>
                                                <option value="2">proveedor2</option>
                                                <option value="3">proveedor3</option>
                                            </select>
                                        </div>
                                    </tr>

                                    <tr>
                                        <td><label for="fecha">Fecha:</label></td>
                                        <td><input type="datetime-local" class="form-control" id="fecha" name="fecha"
                                                placeholder="Fecha..."></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Producto</td>
                                        <td>Cantidad</td>
                                        <td></td>
                                    </tr>

                                    <!-- Aquí puedes agregar campos para editar productos existentes -->

                                    <tr>
                                        <td><input type="text" class="form-control productoCompra"
                                                placeholder="Producto..." required></td>
                                        <td><input type="number" class="form-control cantidadCompra"
                                                placeholder="Cantidad..." min="1" required></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-success agregarProducto">
                                                <i class="fas fa-cash-register"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                </table>

                                <table>
                                    <h6>Productos a comprar</h6>
                                    <div class="form-control productosSeleccionados"
                                        style="max-height: 150px; overflow-y: auto;"></div>
                                    <!-- Aquí puedes agregar campos para mostrar productos relacionados -->

                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                </table>

                                <table>
                                    <tr>
                                        <td><label for="subtotal">Subtotal: </label></td>
                                        <td><input type="text" class="form-control" name="subtotal" placeholder="0.0"
                                                id="subtotal"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="total">TOTAL: </label></td>
                                        <td><input type="text" class="form-control" name="total" placeholder="0.0"
                                                id="total"></td>
                                    </tr>
                                </table>



                            </form>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-outline-success"
                                onclick="modificarCompra()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FIN DE MODIFICACION DE COMPRA-->



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
                        <div class="modal-body">
                            <table id="tbDetalleCompra" class="table table-striped">
                                <thead>
                                    <tr class="table-success">
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="">
                                        <td>asf</td>
                                        <td>as</td>
                                        <td>s</td>
                                        <td>s</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- FIN DE MODAL DE INFORMACION - DETALLES DE COMPRA-->



            <?php include("./Views/Layouts/footer-adminComprasyVentas.php");?>

            <script src="<?=$url_host?>assets/js/admin/graficoCompra.js"></script>
            <script src="<?=$url_host ?>assets/js/admin/compras.js"></script>

            </body>

            </html>