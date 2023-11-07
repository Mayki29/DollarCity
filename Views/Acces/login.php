<?php $url_host = "http://localhost/DollarCity/" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="<?php echo $url_host ?>assets/css/EstiloFormularioLogin.css">

</head>

<body>
    
    <header>
        <div class="logo">
            <img src="<?php echo $url_host ?>assets/img/logo.png" alt="Dollar City Logo">
        </div>
    </header>
    <div class="DollarCity">
        <div class="login-box" id="contenedorLogin">
            <div id="dvOpciones">
                <center>
                    <div class="user-box">
                        <label>¿CÓMO QUIERES INICIAR SESION?</label>
                        <br>
                    </div>
                </center>

                <center>

                    <a onclick="mostrarEmpleado()">
                        Empleado
                        <span></span>
                    </a>
                    <a onclick="mostrarCliente()">
                        Cliente
                        <span></span>
                    </a>
                    <a href="<?php echo $url_host ?>index.php">
                        Salir
                        <span></span>
                    </a>
                </center>
            </div>
            <form id="frmCliente" class="ocultar">
                <div class="user-box">
                    <input type="email" name="email" id="txtUser" required="">
                    <label>Ingresa tu usuario</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" id="txtPassword" required="">
                    <label>Ingresa tu contraseña</label>
                </div>
                <center>
                    <input type="submit" name="btnSubmitCli" id="btnSubmitCli" value="Iniciar Sesion">
                    
                    <a onclick="mostrarOpciones()">
                        REGRESAR
                        <span></span>
                    </a>
                    <a href="<?php echo $url_host ?>index.php">
                        SALIR
                        <span></span>
                    </a>
                    <h2 id="message" name="message"></h2>
                </center>

            </form>
            <form id="frmEmpleado" class="ocultar">
                <div class="user-box">
                    <input type="text" name="EmpleadoUsuario" id="EmpleadoUsuario" required="">
                    <label>Ingresa tu usuario</label>
                </div>
                <div class="user-box">
                    <input type="password" name="EmpleadoPassword" id="EmpleadoContraseña" required="">
                    <label>Ingresa tu contraseña</label>
                </div>
                <center>
                    <button type="submit" id="btnSubmit">
                        INICIAR SESION
                        <span></span>
                    </button>
                    <a onclick="mostrarOpciones()">
                        REGRESAR
                        <span></span>
                    </a>
                    <a href="<?php echo $url_host ?>index.php">
                        SALIR
                        <span></span>
                    </a>

                </center>
            </form>
        </div>
    </div>
    <script src="<?=$url_host?>assets/js/login.js"></script>
    
</body>

</html>