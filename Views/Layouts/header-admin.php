<?php $url_host = "http://localhost/DollarCity/"; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Administrador | DollarCity</title>
    <link rel="icon" href="<?=$url_host?>assets/img/logo-titulo.ico">
    <!-- Enlaces a estilos CSS -->
    <link rel="stylesheet" href="<?=$url_host?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?=$url_host?>assets/css/estilos-admin.css">
    <link rel="stylesheet" href="<?=$url_host?>assets/css/admin/empleadosFormulario.css">
    <link rel="stylesheet" href="<?=$url_host?>assets/css/admin/productosFormulario.css">
    <link rel="stylesheet" href="<?=$url_host?>assets/css/admin/proveedoresFormulario.css">
   
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://file.myfontastic.com/LhSoitGS3oZGK2yScVfSuJ/icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
   
   
</head>

<body id="page-top">

    <div id="wrapper">
        <!--EMPIEZA LA LISTA , LA BARRA LATERAL IZQUIERDA-->
        <ul class="navbar-nav sidebar sidebar-dark accordion " id="accordionSidebar">
            <!--SUPERIOR IZQUIERDO LOGO CON ADMINISTRADOR-->
            <a class="sidebar-brand d-flex align-items-center" id="logoAdmin" href="<?=$url_host?>admin">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-regular fa-user-circle" style="color: #fdf903;"></i>
                    <!--"fas" de FONT AWESOME....-->
                    <!-- <i class="fa-solid fa-user" style="color: #ffffff;"></i></i>-->
                </div>
                <div class="sidebar-brand-text mx-2">Administrador</div>
            </a>

            <!-- LINEA DE DIVISION -->
            <hr class="sidebar-divider my-0">

            <!-- EMPIEZA LA BARRA DASHBOARD -->
            <li class="<?php echo ($paginaActual == 'index.php')? 'menu_link active menu_item menu_link-select': 'menu_link';?>">
                <a class="nav-link <?php echo ($paginaActual == 'index.php')? 'menu_link-select': '';?>" href="<?=$url_host?>admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="<?php echo ($paginaActual == 'empleados.php')? 'menu_link active menu_item menu_link-select': 'menu_link';?>">
                <a class="nav-link <?php echo ($paginaActual == 'empleados.php')? 'menu_link-select': '';?>" href="<?=$url_host?>admin/empleados">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Empleados</span></a>
            </li>
            <li class="<?php echo ($paginaActual == 'proveedores.php')? 'menu_link active menu_item menu_link-select': 'menu_link';?>">
                <a class="nav-link <?php echo ($paginaActual == 'proveedores.php')? 'menu_link-select': '';?>" href="<?=$url_host?>admin/proveedores">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Proveedores</span></a>
            </li>
            <li class="<?php echo ($paginaActual == 'productos.php')? 'menu_link active menu_item menu_link-select': 'menu_link';?>">
                <a class="nav-link <?php echo ($paginaActual == 'productos.php')? '': '';?>" href="<?=$url_host?>admin/productos">
                    <i class="fas fa-fw fa-shopping-basket"></i>
                    <span>Productos</span></a>
            </li>
            <li class="<?php echo ($paginaActual == 'ventas.php')? 'menu_link active menu_item menu_link-select': 'menu_link';?>">
                <a class="nav-link <?php echo ($paginaActual == 'ventas.php')? 'menu_link-select': '';?>" href="<?=$url_host?>admin/ventas">
                    <i class="fas fa-fw fa-shopping-basket"></i>
                    <span>Ventas</span></a>
            </li>
            <li class="<?php echo ($paginaActual == 'compras.php')? 'menu_link active menu_item menu_link-select': 'menu_link';?>">
                <a class="nav-link <?php echo ($paginaActual == 'compras.php')? 'menu_link-select': '';?>" href="<?=$url_host?>admin/compras">
                    <i class="fas fa-fw fa-shopping-basket"></i>
                    <span>Compras</span></a>
            </li>

            <hr class="sidebar-divider my-4">

            <li class="menu_link">
                <a class="" href="<?=$url_host?>home">
                    <i class="fas fa-fw fa-reply-all"></i>
                    <span>Salir</span></a>
            </li>

        </ul>
        <!-- TERMINA LA BARRA LATERAL IZQUIERDA-->

        <!-- BARRA HORIZONTAL -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">


                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">


                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <!-- BARRA DE BUSQUEDA-->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-emphasis border-0 small" placeholder="Buscar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-light btn-outline-dark" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div>
                            <a href="<?= $url_host ?>index.php"><img src="<?=$url_host?>assets/img/logo.png"
                                    alt="DollarCityLogoNombre"></a>
                        </div>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- INFORMACION USUARIO -->
                        <li class="nav-item dropdown no-arrow">
                            <!--a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-white small">PERFIL</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a-->

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuraciones
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- FIN DE LA BARRA HORIZONTAL -->

                <!-- CONTENIDO PAGINA-->