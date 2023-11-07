<?php

require_once("../../../includes/conexion.php");
$codigo = $_POST['deleteCod'];

$query = "exec SP_DeshabilitarProveedor :cod";
try{
    $result = $conn->prepare($query);
    $result->bindValue(":cod",$codigo);
    $result->execute();
    
    header("Location: ../../proveedores.php");

}catch(PDOException $e){
    echo "Error";
}