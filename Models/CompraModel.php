<?php 
class CompraModel implements JsonSerializable{
    private $CompraID;
    private $UsuarioID;
    private $Usuario;
    private $ProveedorID;
    private $Proveedor;
    private $FechaCompra;
    private $TotalCompra;
    private $DetalleCompraID;
    private $DetalleCompra;
    private $Estado;


    public function getCompraID()
    {
        return $this->CompraID;
    }

    public function setCompraID($CompraID)
    {
        $this->CompraID = $CompraID;
    }

    public function getUsuarioID()
    {
        return $this->UsuarioID;
    }

    public function setUsuarioID($UsuarioID)
    {
        $this->UsuarioID = $UsuarioID;
    }
    public function getUsuario()
    {
        return $this->Usuario;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;

    }

    public function getProveedorID()
    {
        return $this->ProveedorID;
    }

    public function setProveedorID($ProveedorID)
    {
        $this->ProveedorID = $ProveedorID;
    }
    public function getProveedor()
    {
        return $this->Proveedor;
    }

    public function setProveedor($Proveedor)
    {
        $this->Proveedor = $Proveedor;
    }

    public function getFechaCompra()
    {
        return $this->FechaCompra;
    }

    public function setFechaCompra($FechaCompra)
    {
        $this->FechaCompra = $FechaCompra;
    }


    public function getTotalCompra()
    {
        return $this->TotalCompra;
    }

    public function setTotalCompra($TotalCompra)
    {
        $this->TotalCompra = $TotalCompra;
    }

    public function getDetalleCompraID()
    {
        return $this->DetalleCompraID;
    }

    public function setDetalleCompraID($DetalleCompraID)
    {
        $this->DetalleCompraID = $DetalleCompraID;
    }

    public function getDetalleCompra()
    {
        return $this->DetalleCompraID;
    }

    public function setDetalleCompra($DetalleCompra)
    {
        $this->DetalleCompra = $DetalleCompra;
    }


    public function getEstado()
    {
        return $this->Estado;
    }

    public function setEstado($Estado)
    {
        $this->Estado= $Estado;
    }




    public function jsonSerialize()
    {
        return [
            'CompraID' => $this->CompraID,
            'UsuarioID' => $this->UsuarioID,
            'Usuario' => $this->Usuario,
            'ProveedorID' => $this->ProveedorID,
            'Proveedor' => $this->Proveedor,
            'FechaCompra' => $this->FechaCompra,
            'TotalCompra' => $this->TotalCompra,
            'DetalleCompraID' => $this->DetalleCompraID,
            'DetalleCompra' => $this->DetalleCompra,
            'Estado' => $this->Estado,
        ];
    }

    /*
    public static function getAll(){
        $conn = new conexion();
        $prepare = $conn->getConnection()->prepare("SELECT top(12)* FROM Compra");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, CompraModel::class);
    }

*/
    public static function getAllAdmin(){
        $conn = new conexion();
        $prepare = $conn->getConnection()->prepare("EXEC SP_ListarCompras");
        $prepare->execute();
        $resultado = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $listadetalle = [];
        $listaComp = [];
        $idControl = null;
        foreach ($resultado as $compra) {
            if ($idControl != $compra["CompraID"]) {
                $idControl = $compra["CompraID"];

                $empleado = new UsuarioModel();
                $empleado->setUsuarioID($compra["UsuarioID"]);
                $empleado->setNombres($compra["Nombres"]);
                $empleado->setApellidos($compra["Apellidos"]);
                
                $proveedor = new ProveedorModel();
                $proveedor->setProveedorID($compra["ProveedorID"]);
                $proveedor->setRazonSocial($compra["RazonSocial"]);
                
                $c = new CompraModel();
                
                $c->setCompraID($compra["CompraID"]);
                $c->setUsuario($empleado);
                $c->setProveedor($proveedor);
                $c->setFechaCompra($compra["FechaCompra"]);
                $c->setTotalCompra($compra["TotalCompra"]);
                foreach ($resultado as $dtcompra) {
                    if ($idControl == $dtcompra["CompraID"]) {
                        $producto = new ProductoModel();
                        $producto->setProductoID($dtcompra["ProductoID"]);
                        $producto->setNombre($dtcompra["NombreProducto"]);

                        $dc = new DetalleCompraModel();
                        $dc->setDetalleCompraID($dtcompra["DetalleCompraID"]);
                        $dc->setProducto($producto);
                        $dc->setCantidad($dtcompra["Cantidad"]);
                        $dc->setSubTotal($dtcompra["SubTotal"]);
                        array_push($listadetalle, $dc);
                    }
                }
                $c->setDetalleCompra($listadetalle);
                array_push($listaComp, $c);
                $listadetalle = [];
            }
        }
        return $listaComp;
    }


public function save(){
    $conn = new conexion();
   $query = "EXEC SP_CrearCompra :usuario, :proveedor, :fecha, :producto";
    try{
        $result = $conn->getConnection()->prepare($query);
        $result->bindValue(":usuario", $this->UsuarioID);
        $result->bindValue(":proveedor", $this->proveedor);
        $result->bindValue(":fecha", $this->fecha);
        $result->bindValue(":producto", $this->producto);
        
        $result->execute();

        return "correct";
    }catch(PDOException $e){
        return "error";
    }
    
}


public function edit(){
    $conn = new conexion();
    /*$query = "EXEC SP_ActualizarCompra :usuario, :proveedor, :fecha, :producto, :cantidad, :subtotal, :total";
    try{
        $result = $conn->getConnection()->prepare($query);
        $result->bindValue(":usuario", $this->UsuarioID);
        $result->bindValue(":proveedor", $this->ProveedorID);
        $result->bindValue(":fecha", $this->FechaCompra);
        $result->bindValue(":producto", $this->producto);
        $result->bindValue(":cantidad", $this->Cantidad);
        $result->bindValue(":catId", $this->CategoriaID);
        
        $result->execute();

        return "correct";
    }catch(PDOException $e){
        return "error";
    }*/
}

public function delete(){
    $conn = new conexion();
    $query = "EXEC SP_DeshabilitarCompra :id";
    try{
        $result = $conn->getConnection()->prepare($query);
        $result->bindValue(":id", $this->CompraID);
        
        $result->execute();

        return "correct";
    }catch(PDOException $e){
        return "error";
    }
}



    

    
}

?>