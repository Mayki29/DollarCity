<?php
require('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
include_once("includes/conexion.php");
include_once("Models/UsuarioModel.php");
include_once("Models/ProductoModel.php");
include_once("Models/CategoriaModel.php");
include_once("Models/ProveedorModel.php");
include_once("Models/CompraModel.php");
include_once("Models/DetalleCompraModel.php");

include_once("utils/defaults.php");



$controller = $_GET['controller'];
$action = $_GET['action'];
$id = $_GET['id'];

if (empty($action))
    $action = "index";

$ctrlName = $controller . "Controller";
include "./Controllers/$ctrlName.php";
$ctrl = new $ctrlName;
$ctrl->{$action}();


?>