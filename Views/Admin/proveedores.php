<?php 
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header-admin.php");
//include("./includes/conexion.php");
//$stm = $conn->prepare("exec SP_ListarProveedores");
//$stm -> execute();
//$proveedores = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!--INICIO DEL CONTENIDO DE LA TABLA PROVEEDOR-->

<div class="container-fluid">
    <div class="card-body">
        <div class="chart-area">
            <canvas id="chartProveedor"></canvas>
        </div>
    </div>
    <!-- Page Heading -->
    <div>

        <div>
            <h1 class="h3 mb-2 text-gray-800">Proveedores</h1>
        </div>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- TABLA DEL PERSONAL -->
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Datos</h5>
                <br>

                <button type="button" class="btn btn-outline-success" id="mostrarFormulario">
                    <i class="fas fa-user-plus"> Agregar</i>
                </button>


            </div>
            <!--MODAL REGISTRAR PROVEEDOR-->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <h4>Agregue un proveedor</h4>
                    <span class="close" id="cerrarModal">&times;</span>

                    <form id="frmResgistrarProveedor">

                        <br>
                        <!-- Agrega aquí los campos del formulario para agregar datos -->
                        <table>
                            <!--tr>
                                <td><label for="codigo">Codigo: </label></td>
                                <td><input type="text" class="form-control" name="codigo" id="codigo">
                                </td>

                            </tr-->
                            <tr>
                                <td><label for="razonSocial">Razon Social: </label></td>
                                <td> <input type="text" class="form-control" placeholder="Razon social..."
                                        id="razonSocial" name="razonSocial" required>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="ruc">RUC:</label></td>
                                <td><input type="text" class="form-control" id="ruc" maxlength="11" minlength="11"
                                        placeholder="Ingrese el ruc..." name="ruc" required></td>
                            </tr>


                            <tr>
                                <td><label for="direccion">Direccion: </label></td>
                                <td> <input type="text" class="form-control" name="direccion"
                                        placeholder="Ica, av-XXXXX" id="direccion"></td>
                            </tr>
                            <tr>
                                <td><label for="numero">Telefono: </label></td>
                                <td><input type="tel" class="form-control" name="numero" maxlength="9"
                                        placeholder="XXXXXXXXX" id="numero"></td>
                            </tr>
                            <tr>
                                <td><label for="email">E-mail: </label></td>
                                <td><input type="email" class="form-control" placeholder="example@email.com"
                                        name="email" id="email" required></td>
                            </tr>
                        </table>

                        <hr>
                        <!-- Boton -->
                        <button type="button" onclick="registrarProveedor()" class="btn btn-success"
                            style="display: block;width: 100%;text-align: center;">
                            Guardar
                        </button>

                    </form>



                </div>

            </div>
            <script src="js Dashboard/mostrarFormularioProveedor.js"></script>
            <!--MODAL ACTUALIZAR PROVEEDOR-->
            <div id="modal3" class="modal">
                <div class="modal-content">
                    <h4>Modificacion del Proveedor</h4>
                    <span class="close" id="cerrarModal3">&times;</span>

                    <form id="frmModificarProveedor">

                        <br>

                        <table>
                            <div>
                                <input type="hidden" class="form-control" name="codigo" id="txtCodigoAP">

                            </div>

                            <tr>
                                <td><label for="razonSocial">Razon Social: </label></td>
                                <td> <input type="text" class="form-control" placeholder="..." id="txtRazonSocialAP"
                                        name="razonSocial" required>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="RUC">RUC:</label></td>
                                <td><input type="text" class="form-control" id="txtRucAP" maxlength="11" minlength="11"
                                        placeholder="..." name="ruc" required></td>
                            </tr>


                            <tr>
                                <td><label for="direccion">Direccion: </label></td>
                                <td> <input type="text" class="form-control" name="direccion" placeholder="..."
                                        id="txtDireccionAP"></td>
                            </tr>
                            <tr>
                                <td><label for="numero">Telefono: </label></td>
                                <td><input type="tel" class="form-control" name="numero" maxlength="9" placeholder="..."
                                        id="txtNumeroAP">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="email">E-mail: </label></td>
                                <td><input type="email" class="form-control" placeholder="..." name="email"
                                        id="txtEmailAP" required></td>
                            </tr>
                        </table>

                        <hr>
                        <!-- Otros campos del formulario -->
                        <button type="button" onclick="modificarProveedor()" class="btn btn-success"
                            style="display: block;width: 100%;text-align: center;">
                            Modificar
                        </button>

                    </form>



                </div>

            </div>

            <!--TABLA PROVEEDOR-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-success">
                            <tr>
                                <th>Codigo</th>
                                <th>Razon Social</th>
                                <th>RUC</th>
                                <th>Direccion</th>
                                <th>NumeroTelefono</th>
                                <th>Email</th>
                                <th>
                                    <div style=" display: flex;">
                                        <i class="fas fa-tools"></i>
                                    </div>

                                </th>

                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php foreach($proveedores as $proveedor):?>
                            <tr id="tr<?=$proveedor->getProveedorID()?>">
                                <th><?=$proveedor->getProveedorID()?></th>
                                <td><?=$proveedor->getRazonSocial()?></td>
                                <td><?=$proveedor->getRUC()?></td>
                                <td><?=$proveedor->getDireccion()?></td>
                                <td><?=$proveedor->getTelefono()?></td>
                                <td><?=$proveedor->getEmail()?></td>

                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-outline-warning mostrarFormulario3" type="button"
                                            onclick="rellenarFormulario(<?=$proveedor->getProveedorID()?>)"><i
                                                class="fas fa-user-cog"></i></button>
                                        <button class="btn btn-outline-danger" type="button"
                                            onclick="setCodigoEliminar(<?=$proveedor->getProveedorID()?>)"><i
                                                class="fas fa-trash-alt eliminar-button"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- ELIMINAR BOTON -->
    <div id="confirmarEliminarModal" class="modal">
        <div class="modal-content">
            <form id="frmEliminarProveedor">
                <input type="hidden" id="deleteCod" name="deleteCod">
                <p>¿Estás seguro de que deseas eliminar este elemento?</p>
                <button type="button" onclick="eliminarProveedor()" id="eliminarConfirmado" class="btn btn-danger">Eliminar</button>
                <br>

            </form>
            <button id="cancelarEliminacion" class="btn btn-secondary">Cancelar</button>

        </div>
    </div>
</div>

<?php include("./Views/Layouts//footer-admin.php");?>


<script src="<?=$url_host?>assets/js/admin/proveedores.js"></script>

<!-- Graficos -->
<script src="<?php echo $url_host ?>assets/js/admin/graficos/graficoProveedor.js"></script>


</body>

</html>