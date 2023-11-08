<?php 
class DetalleCompraModel implements JsonSerializable{
    private $DetalleCompraID;
    private $CompraID;
    private $ProductoID;
    private $Producto;
    private $Cantidad;
    private $SubTotal;


    public function getDetalleCompraID()
    {
        return $this->DetalleCompraID;
    }

    public function setDetalleCompraID($DetalleCompraID)
    {
        $this->DetalleCompraID = $DetalleCompraID;
    }

    public function getCompraID()
    {
        return $this->CompraID;
    }

    public function setCompraID($CompraID)
    {
        $this->CompraID = $CompraID;
    }

    public function getProductoID()
    {
        return $this->ProductoID;
    }

    public function setProductoID($ProductoID)
    {
        $this->ProductoID = $ProductoID;
    }

    public function getProducto()
    {
        return $this->Producto;
    }

    public function setProducto($Producto)
    {
        $this->Producto = $Producto;
    }

    public function getCantidad()
    {
        return $this->Cantidad;
    }

    public function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;
    }

    public function getSubTotal()
    {
        return $this->SubTotal;
    }
    public function setSubTotal($SubTotal)
    {
        $this->SubTotal = $SubTotal;
    }

    



    public function jsonSerialize()
    {
        return [
            'DetalleCompraID' => $this->DetalleCompraID,
            'CompraID' => $this->CompraID,
            'ProductoID' => $this->ProductoID,
            'Producto' => $this->Producto,
            'Cantidad' => $this->Cantidad,
            'SubTotal' => $this->SubTotal,
        ];
    }


    public static function getAll(){
        $conn = new conexion();
        $prepare = $conn->getConnection()->prepare("SELECT top(12)* FROM DetalleCompra");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS,DetalleCompraModel::class);
    }

}

?>