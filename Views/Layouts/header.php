<?php 
$url_host = "http://localhost/DOLLARCITY/" ;
//echo dirname(__DIR__);
//include_once("./includes/conexion.php"); 

/*include_once("./Models/UsuarioModel.php");
$conn = new conexion();*/
include_once("./Controllers/HomeController.php");
$categorias = HomeController::getCategorias();

$logEstado = 0;
session_start();
if(!isset($_SESSION['user'])){ 
    $logEstado = 0;
}else{ 
    $logEstado = 1;
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-escalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Dollar City | Perú</title>
    <!-- Formato icon para titulo -->
    <link rel="icon" href="<?= $url_host ?>assets/img/logo-titulo.ico">
    <!-- Enlaces a estilos CSS -->
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/estilos-general.css">
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/estilos-header.css">
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/estilos-registro.css">
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/slider.css">
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/content.css">
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?= $url_host ?>assets/css/fonts.css">
    <!-- Enlace a Iconos -->
    <link href="https://file.myfontastic.com/LhSoitGS3oZGK2yScVfSuJ/icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <div class="contenedor secciones">
            <div class="sub_contenedor secciones">
                <div class="primera_seccion">
                    <div class="logo">
                        <a href="<?= $url_host ?>home"><img src="<?= $url_host ?>assets/img/logo.png"
                                alt="Dollar City Logo"></a>
                    </div>
                    <form class="container-search" method="post">
                        <input type="text" id="search-input" placeholder="Buscar..." />
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <nav class="container-menu-first">
                        <ul class="menu-first">
                            <li class="menu_item">
                                <a class="menu_link <?= ($paginaActual == 'index.php')? 'menu_link-select':'' ?>"
                                    href="<?= $url_host ?>home"><i class="fa-solid fa-house"></i> Inicio</a>
                            </li>
                            <li class="menu_item">
                                <a class="menu_link <?= ($paginaActual == 'nosotros.php')? 'menu_link-select':'' ?>"
                                    href="<?= $url_host ?>home/nosotros"><i class="fa-solid fa-users"></i> Nosotros</a>
                            </li>
                            <li class="menu_item">
                                <a class="menu_link <?= ($paginaActual == 'ubicanos.php')? 'menu_link-select':'' ?>"
                                    href="<?= $url_host ?>home/ubicanos"><i class="fa-solid fa-location-dot"></i>
                                    Ubicanos</a>
                            </li>
                            <li class="menu_item">
                                <a class="menu_link <?= ($paginaActual == 'contactanos.php')? 'menu_link-select':'' ?>"
                                    href="<?= $url_host ?>home/contactanos"><i class="fa-solid fa-envelope"></i>
                                    Contactanos</a>
                            </li>
                            <li class="menu_item">
                                <?php if($logEstado == 1){ ?>

                                <div class="btn-group">
                                    <div class="dropdown">
                                        <a class="menu_link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Hola <?= $_SESSION['user']->getNombres() ?>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Perfil</a>
                                            <a class="dropdown-item" href="#">Compras</a>
                                            <a class="dropdown-item" onclick="logout()">Cerrar Sesion</a>
                                        </div>
                                    </div>
                                    <?php } else{ ?>
                                    <a class="menu_link" href="<?=$url_host?>acces/login"><i
                                            class="fa-solid fa-user"></i> Iniciar Sesion</a>';
                                    <?php }?>

                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="segunda_seccion">
                    <div class="menu-second">
                        <input type="checkbox" id="menu" />
                        <label for="menu">
                            <div class="bars-menu">
                                <div class="menu-line">
                                    <span class="line1"></span>
                                    <span class="line2"></span>
                                    <span class="line3"></span>
                                </div>
                                <a class="text-menu-second">Menú</a>
                            </div>
                        </label>
                        <script src="<?= $url_host ?>assets/js/menu-icon.js"></script>
                        <nav class="navbar p-0">
                            <ul class="m-0">
                                <li class="menu_second_item"><a class="menu_link-second"
                                        href="<?= $url_host ?>home/productos">Productos</a></li>
                                <li class="menu_second_item"><a class="menu_link-second" href="#">Ubicaciones</a></li>
                                <li class="menu_second_item"><a class="menu_link-second" href="#">Bienes Raíces</a></li>
                                <li class="menu_second_item"><a class="menu_link-second" href="#">Proveedores</a></li>
                                <li class="menu_second_item"><a class="menu_link-second" href="#">Contacto</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="menu-three">
                        <input type="checkbox" id="category" />
                        <label for="category">
                            <div class="container-button">
                                <div class="button-icon-category">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>
                                <div class="button-text-category">
                                    <a class="text-category">Categorías</a>
                                    <i class="fa-solid fa-circle-chevron-down"></i>
                                </div>
                            </div>
                        </label>
                        <nav class="navbar-category">
                            <ul>
                                <?php foreach($categorias as $categoria): ?>
                                <li class="menu_category_item"><a class="menu_link-category" href="#"><?=$categoria->getNombre()?></a>
                                </li>
                                <?php endforeach ?>                               
                            </ul>
                        </nav>
                    </div>
                    <div class="container_shopping_cart">
                        <a class="fa-solid fa-cart-plus" href="#" title="Mis compras"></a>
                    </div>
                    <div class="container_icons-social">
                        <a class="fa-brands fa-facebook" href="https://www.facebook.com/DollarcityPeru" target="_blank"
                            title="Facebook Dollarcity Perú"></a>
                        <a class="fa-brands fa-square-instagram" href="https://www.instagram.com/dollarcitype/"
                            target="_blank" title="Instagram Dollarcity Perú"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>