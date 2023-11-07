<?php 
$paginaActual = basename(__FILE__);
include("./Views/Layouts/header.php");
?>
<div class="container_background_interface">
    <div class="background">
        <img src="<?= $url_host ?>assets/img/Registro-banner2.png" title="Dollarcity" alt="Error al cargar imagen">
    </div>
    <div class="registration">
        <div class="logo-registro">
            <img src="<?= $url_host ?>assets/img/logo-foot.svg" title="Dollarcity" alt="Error al cargar imagen">
        </div>
        <div class="formulary">
            <div class="text_information">
                <h1>Crea tu cuenta gratis</h1>
                <p>Ingresa la siguiente información para registrate.</p>
            </div>
            <div class="user_data">
                <main>
                    <form action="" class="formulario" id="formulario">
                        <!-- Grupo: Usuario -->
                        <div class="formulario__grupo" id="grupo__usuario">
                            <label for="usuario" class="formulario__label">Nombre</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="usuario" id="usuario"
                                    placeholder="Ejemplo: Nombre">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede
                                contener números, letras y guion bajo.</p>
                        </div>

                        <!-- Grupo: Nombre -->
                        <div class="formulario__grupo" id="grupo__nombre">
                            <label for="nombre" class="formulario__label">Apellido</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="nombre" id="nombre"
                                    placeholder="Ejemplo: Apellido">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede
                                contener números, letras y guion bajo.</p>
                        </div>

                        <!-- Grupo: Contraseña -->
                        <div class="formulario__grupo" id="grupo__password">
                            <label for="password" class="formulario__label">Contraseña</label>
                            <div class="formulario__grupo-input">
                                <input type="password" class="formulario__input" name="password" id="password"
                                    placeholder="Contraseña">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                        </div>

                        <!-- Grupo: Contraseña 2 -->
                        <div class="formulario__grupo" id="grupo__password2">
                            <label for="password2" class="formulario__label">Confirmar Contraseña</label>
                            <div class="formulario__grupo-input">
                                <input type="password" class="formulario__input" name="password2" id="password2"
                                    placeholder="Contraseña">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                        </div>

                        <!-- Grupo: Correo Electronico -->
                        <div class="formulario__grupo" id="grupo__correo">
                            <label for="correo" class="formulario__label">Correo Electrónico</label>
                            <div class="formulario__grupo-input">
                                <input type="email" class="formulario__input" name="correo" id="correo"
                                    placeholder="Ejemplo: ejemplo@gmail/hotmail.com">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El correo solo puede contener letras, números, puntos,
                                guiones y guion bajo.</p>
                        </div>

                        <!-- Grupo: Telefono -->
                        <div class="formulario__grupo" id="grupo__telefono">
                            <label for="telefono" class="formulario__label">Celular</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="telefono" id="telefono" maxlength="9"
                                    placeholder="Ejemplo: 999666333">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El celular solo puede contener números y el maximo son 9
                                dígitos.</p>
                        </div>

                        <!-- Grupo: Terminos y Condiciones -->
                        <div class="formulario__grupo" id="grupo__terminos">
                            <label class="formulario__label">
                                <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
                                Acepto los Terminos y Condiciones
                            </label>
                        </div>

                        <div class="formulario__mensaje" id="formulario__mensaje">
                            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario
                                correctamente. </p>
                        </div>

                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="formulario__btn">Enviar</button>
                            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado
                                exitosamente!</p>
                        </div>
                    </form>
                    <script src="<?=$url_host?>assets/js/Registro-formulario.js"></script>
                </main>
            </div>
        </div>
    </div>
</div>

<?php include("./Views/Layouts/footer.php") ?>