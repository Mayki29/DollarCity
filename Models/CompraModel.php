<?php 
class CompraModel implements JsonSerializable{
    private $CompraID;
    private $UsuarioID;
    private $ProveedorID;
    private $FechaCompra;
    private $TotalCompra;

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

    public function getProveedorID()
    {
        return $this->ProveedorID;
    }

    public function setProveedorID($ProveedorID)
    {
        $this->ProveedorID = $ProveedorID;
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
            'ProveedorID' => $this->ProveedorID,
            'FechaCompra' => $this->FechaCompra,
            'TotalCompra' => $this->TotalCompra,
            'DetalleCompraID' => $this->DetalleCompraID,
            'DetalleCompra' => $this->DetalleCompra,
            'Estado' => $this->Estado,
        ];
    }

    public static function getAll(){
        $conn = new conexion();
        $prepare = $conn->getConnection()->prepare("SELECT top(12)* FROM Compra");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, CompraModel::class);
    }


    public static function getAllAdmin(){
      
    }


public function save(){
    $conn = new conexion();
    $query = "EXEC SP_CrearCompra :usuario, :proveedor, :fecha, :producto";
    try{
        $result = $conn->getConnection()->prepare($query);
        $result->bindValue(":usuario", $this->usuario);
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
    $query = "EXEC SP_ActualizarCompra :usuario, :proveedor, :fecha, :producto, :cantidad, :subtotal, :total";
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
    }
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