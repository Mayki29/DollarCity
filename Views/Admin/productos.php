<?php 
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header-admin.php");


?>
<!--INICIO DEL CONTENIDO DE LA TABLA PRODUCTO-->

<div class="container-fluid">
    <div class="card-body">
        <div class="chart-area">
            <canvas id="chartProducto"></canvas>
        </div>
    </div>

    <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Page Heading -->
    <div>

        <div>
            <h1 class="h3 mb-2 text-gray-800">Productos</h1>
        </div>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- TABLA DEL PERSONAL -->
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Informacion</h5>
                <br>

                <button type="button" class="btn btn-outline-success" id="mostrarFormulario">
                    <i class="fas fa-cash-register"> Agregar Producto</i>
                </button>


            </div>

            <!--MODAL REGISTRAR PRODUCTO-->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <h4>Agregue un producto</h4>
                    <span class="close" id="cerrarModal">&times;</span>

                    <form id="frmResgistrarProducto">

                        <br>
                        <!-- Agrega aquí los campos del formulario para agregar datos -->
                        <table>
                            <!--tr>
                                <td><label for="codigo">Codigo: </label></td>
                                <td><input type="text" class="form-control" name="codigo" id="codigo">
                                </td>

                            </tr-->

                            <tr>
                                <td><label for="nombre">Nombre: </label></td>
                                <td> <input type="text" class="form-control" placeholder="Nombre del producto..."
                                        id="txtNombre" name="nombre" required>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="descripcion">Descripcion:</label></td>
                                <td><textarea class="form-control" rows="5" id="txaDescripcion"
                                        placeholder="Descripcion..." name="descripcion" required></textarea></td>
                            </tr>
                            <tr>
                                <td><label for="precio">Precio: </label></td>
                                <td><input type="number" min="0.00" step="0.01" class="form-control" placeholder="0.00"
                                        name="precio" id="txtPrecio" required></td>
                            </tr>
                            <tr>
                                <td> <label for="stock">Cantidad en Stock: </label></td>
                                <td><input type="number" class="form-control" name="stock" placeholder="0" id="txtStock"
                                        min="0" required>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><label for="categoria">Categoria: </label></td>
                                <td><select class="form-control" name="categoria" id="slCategoria">
                                        <?php foreach($categorias as $categoria):?>
                                        <option value="<?= $categoria->getCategoriaID()?>"><?= $categoria->getNombre()?>
                                        </option>
                                        <?php endforeach?>
                                    </select>
                                    <!--input type="text" class="form-control" name="categoria" placeholder="Categoria..." id="categoria"></td-->
                            </tr>
                     

                    
                            

                        </table>

                        <hr>
                        <!--IMAGEN-->
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01"></span>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                             <label class="custom-file-label" for="inputGroupFile01">Subir imagen</label>
                         </div>
                    </div>
              
                        <button type="button" onclick="registrarProducto()" class="btn btn-success"
                            style="display: block;width: 100%;text-align: center;">
                            Guardar
                        </button>

                    </form>



                </div>

            </div>

            <!--ACTUALIZAR PRODUCTO-->
            <div id="modal4" class="modal">
                <div class="modal-content">
                    <h4>Modificacion del Producto</h4>
                    <span class="close" id="cerrarModal4">&times;</span>

                    <form id="frmModificarProducto">

                        <br>

                        <table>
                            <div>
                                <input type="hidden" class="form-control" name="codigo" id="txtCodigoAc">

                            </div>

                            <tr>
                                <td><label for="nombreProducto">Nombre: </label></td>
                                <td> <input type="text" class="form-control" placeholder="Nombre del Producto..."
                                        id="txtNombreProductoAc" name="nombre">
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="descripcion">Descripcion:</label></td>
                                <td><textarea rows="5" class="form-control" id="txaDescripcionAc" name="descripcion"
                                        placeholder="..." name="descripcion"></textarea></td>
                            </tr>


                            <tr>
                                <td><label for="precio">Precio: </label></td>
                                <td> <input type="number" min="0.00" step="0.01" class="form-control" name="precio"
                                        placeholder="Nuevo Precio..." id="txtPrecioAc"></td>
                            </tr>
                            <tr>
                                <td><label for="stock">Cantidad en Stock: </label></td>
                                <td><input type="number" min="0" class="form-control" name="stock" placeholder="..."
                                        id="txtStockAc">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="categoria">Categoria: </label></td>
                                <td><select class="form-control" name="categoria" id="slCategoriaAc">
                                        <?php foreach($categorias as $categoria):?>
                                        <option value="<?= $categoria->getCategoriaID()?>"><?= $categoria->getNombre()?>
                                        </option>
                                        <?php endforeach?>
                                    </select></td>
                            </tr>
                        </table>    
                        <hr>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01"></span>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                             <label class="custom-file-label" for="inputGroupFile01">Subir imagen</label>
                         </div>
                    </div>

                        <hr>
                        <!-- Otros campos del formulario -->
                        <button type="button" onclick="modificarProducto()" class="btn btn-success"
                            style="display: block;width: 100%;text-align: center;">
                            Modificar
                        </button>

                    </form>



                </div>

            </div>


            <!--TABLA CONTENIDO-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-success">
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Categoria</th>

                                <th>
                                    <div style=" display: flex;">
                                        <i class="fas fa-tools"></i>
                                    </div>

                                </th>

                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php foreach($productos as $producto){ ?>

                            <tr id="tr<?=$producto->getProductoID()?>">
                                <th><?=$producto->getProductoID()?></th>
                                <td><?=$producto->getNombre()?></td>
                                <td><?=$producto->getDescripcion()?></td>
                                <td>S/.<span><?=$producto->getPrecio()?><span></td>
                                <td><?=$producto->getCantidadEnStock()?></td>
                                <td><?=$producto->getCategoria()->getNombre()?></td>

                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-outline-warning mostrarFormulario4" type="button"
                                            onclick="rellenarFormulario(<?=$producto->getProductoID()?>)"><i
                                                class="fas fa-pen"></i></button>
                                        <button class="btn btn-outline-danger" type="button"
                                            onclick="setCodigoEliminar(<?=$producto->getProductoID()?>)"><i
                                                class="fas fa-trash-alt eliminar-button"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <div id="confirmarEliminarModal" class="modal">
        <div class="modal-content">
            <form id="frmEliminarProducto">
                <input type="number" id="deleteCod" name="deleteCod" style="display: none;">
                <p>¿Estás seguro de que deseas eliminar este elemento?</p>
                <button type="button" onclick="eliminarProducto()" id="eliminarConfirmado" class="btn btn-danger">Eliminar</button>
                <br>

            </form>
            <button id="cancelarEliminacion" class="btn btn-secondary">Cancelar</button>

        </div>
    </div>
</div>

<?php include("./Views/Layouts/footer-admin.php");?>
<!--FORMULARIOS-->
<script src="<?php echo $url_host ?>assets/js/admin/productos.js"></script>

<!-- Graficos -->
<script>
    let datos = <?=$grafico?>;
</script>
<script src="<?=$url_host?>assets/js/admin/graficoProducto.js">


</script>

</body>

</html>