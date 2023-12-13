<?php 
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header-admin.php");
?>
<!--INICIO DEL CONTENIDO DE LA TABLA EMPLEADO-->

<div class="container-fluid">
    <div class="card-body">
        <div class="chart-area">
            <canvas id="chartEmpleado"></canvas>
        </div>
    </div>
    <!-- Page Heading -->
    <div>

        <div>
            <h1 class="h3 mb-2 text-gray-800">Pagos</h1>
        </div>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- TABLA DEL PERSONAL -->
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Datos de Pago</h5>
                <br>
                <button type="button" class="btn btn-outline-success" id="mostrarFormulario" onclick="eventosModalRegistrarPago()">
                    <i class="fas fa-user-plus"> Agregar</i>
                </button>


            </div>
          <!-- MODAL REGISTRAR PAGO -->
<div id="modalRegistrarPago" class="modal">
    <div class="modal-content">
        <h4>Registrar Pago</h4>
        <span class="close" id="cerrarModalRegistrarPago">&times;</span>

        <form id="frmRegistrarPago">

            <br>
            <!-- Registrar un pago -->
            <table>
                <tr>
                    <td><label for="usuarioID">ID del Usuario: </label></td>
                    <td><input type="text" class="form-control" placeholder="Ingrese el ID del usuario..."
                            id="usuarioID" name="usuarioID" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="fechaPago">Fecha de Pago:</label></td>
                    <td><input type="date" class="form-control" id="fechaPago" name="fechaPago" required></td>
                </tr>
                <tr>
                    <td><label for="monto">Monto del Pago: </label></td>
                    <td><input type="text" class="form-control" placeholder="Ingrese el monto del pago..."
                            name="monto" id="monto" required></td>
                </tr>
            </table>

            <hr>
            <!-- Guardar el pago -->
            <button type="button" onclick="registrarPago()" class="btn btn-success"
                style="display: block;width: 100%;text-align: center;">
                Guardar Pago
            </button>

        </form>

    </div>
</div>


            <!--MODAL ACTUALIZAR EMPLEADO    -->

            <div id="modal2" class="modal">
                <div class="modal-content">
                    <h4>Modificacion del Personal</h4>
                    <span class="close" id="cerrarModal2">&times;</span>

                    <form id="frmModificarEmpleado">

                        <br>
                        <!-- Agrega aquí los campos del formulario para agregar datos -->
                        <table>
                            <input type="hidden" class="form-control" name="codigo" id="txtCodigoAE">
                            <tr>
                                <td><label for="nombre">Nombres: </label></td>
                                <td> <input type="text" class="form-control" placeholder="..." id="txtNombreAE"
                                        name="nombre">
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="apellido">Apellidos:</label></td>
                                <td><input type="text" class="form-control" id="txtApellidoAE" placeholder="..."
                                        name="apellido"></td>
                            </tr>
                            <tr>
                                <td><label for="email">E-mail: </label></td>
                                <td><input type="email" class="form-control" placeholder="..." name="email" id="txtEmailAE"
                                        required></td>
                            </tr>
                            <tr>
                                <td> <label for="dni">DNI: </label></td>
                                <td><input type="text" class="form-control" name="dni" maxlength="8" placeholder="..." id="txtDniAE"></td>
                            </tr>
                            <tr>
                                <td><label for="direccion">Direccion: </label></td>
                                <td> <input type="text" class="form-control" name="direccion" placeholder="..."
                                        id="txtDireccionAE"></td>
                            </tr>
                            <tr>
                                <td><label for="numero">Telefono: </label></td>
                                <td><input type="tel" class="form-control" maxlength="9" name="numero" placeholder="..." id="txtNumeroAE">
                                </td>
                            </tr>
                        </table>

                        <hr>
                        <!-- Boton -->
                        <button type="button" onclick="modificarEmpleado()" class="btn btn-success" style="display: block;width: 100%;text-align: center;">
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
                                <th>Usuario</th>
                                <th>Fecha de Pago</th>
                                <th>Monto</th>
                                <th>
                                    <div style=" display: flex;">
                                        <i class="fas fa-tools"></i>
                                    </div>

                                </th>

                            </tr>
                        </thead>
                        <tbody class="table-hover">
                                    <?php foreach ($pagos as $pago): ?>
                                <tr id="tr<?=$pago->getPagosID()?>">
                                        <th><?=$pago->getUsuarioID()?></th>
                                        <td><?=$pago->getFechaPago()?></td>
                                        <td><?=$pago->getMonto()?></td> 
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-outline-warning mostrarFormulario2" type="button"><i class="fas fa-user-cog"></i></button>
                                                <button class="btn btn-outline-danger" type="button"><i class="fas fa-trash-alt eliminar-button"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!--ELIMINAR BOTON-->
    <div id="confirmarEliminarModal" class="modal">
        <div class="modal-content">
            <form id="frmEliminarEmpleado">
                <input type="hidden" id="deleteCod" name="codigo">
                <p>¿Estás seguro de que deseas eliminar este elemento?</p>
                <button type="button" onclick="eliminarEmpleado()" id="eliminarConfirmado" class="btn btn-danger">Eliminar</button>
                <br>
                
            </form>
            <button id="cancelarEliminacion" class="btn btn-secondary">Cancelar</button>

        </div>
    </div>


</div>

<?php include("./Views/Layouts/footer-admin.php");?>

<!--FUNCIONES-->
<script src="<?=$url_host?>assets/js/admin/pagos.js"></script>




</body>
</html>