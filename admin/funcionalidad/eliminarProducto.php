<?php 
require_once("../../includes/conexion.php");
$codigo = $_POST['deleteCod'];


$query1 = "exec SP_DeshabilitarProducto :cod";
try{
    $result = $conn->prepare($query1);
    $result->bindValue(":cod",$codigo);
    $result->execute();
    
    header("Location: ../productos.php");

}catch(PDOException $e){
    echo "Error";
}