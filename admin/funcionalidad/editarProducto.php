<?php 
require_once("../../includes/conexion.php");
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$descripcion =$_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$categoria = $_POST['categoria'];

$query1 = "exec SP_ActualizarProducto :cod, :nom, :desc, :pre, :st, :cat";
try{
    $result = $conn->prepare($query1);
    $result->bindValue(":cod",$codigo);
    $result->bindValue(":nom",$nombre);
    $result->bindValue(":desc",$descripcion);
    $result->bindValue(":pre",$precio);
    $result->bindValue(":st",$stock);
    $result->bindValue(":cat",$categoria);

    $result->execute();
    
    header("Location: ../productos.php");

}catch(PDOException $e){
    echo "Error";
}
