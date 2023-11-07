<?php 
require_once("../../../includes/conexion.php");
$cod = $_POST['codigo'];
$razonSocial = $_POST['razonSocial'];
$ruc =$_POST['ruc'];
$direccion = $_POST['direccion'];
$telefono = $_POST['numero'];
$email = $_POST['email'];



$query = "exec SP_ActualizarProveedor :cod, :rs, :ruc, :dir, :tel, :email";
try{
    $sp = $conn->prepare($query);
    $sp->bindValue(":cod",$cod);
    $sp->bindValue(":rs",$razonSocial);
    $sp->bindValue(":ruc",$ruc);
    $sp->bindValue(":dir",$direccion);
    $sp->bindValue(":tel",$telefono);
    $sp->bindValue(":email",$email);

    $sp->execute();
    
    header("Location: ../../proveedores.php");

}catch(PDOException $e){
    echo "Error";
}