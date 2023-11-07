<?php 
class DetalleCompraModel implements JsonSerializable{
    private $DetalleCompraID;
    private $CompraID;
    private $ProductoID;
    private $Producto;
    private $Cantidad;
    private $Subtotal;


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

    public function setProductoID($Producto)
    {
        $this->Producto = $Producto;
    }

    public function getCantidad()
    {
        return $this->Cantidad;
    }

    public function setProductoID($Cantidad)
    {
        $this->Producto = $Cantidad;
    }
    public function setSubtotal($Subtotal)
    {
        $this->Subtotal = $Subtotal;
    }

    

    private $DetalleCompraID;
    private $CompraID;
    private $ProductoID;
    private $Producto;
    private $Cantidad;
    private $Subtotal;


    public function jsonSerialize()
    {
        return [
            'DetalleCompraID' => $this->DetalleCompraID,
            'CompraID' => $this->CompraID,
            'ProductoID' => $this->ProductoID,
            'Producto' => $this->Producto,
            'Cantidad' => $this->Cantidad,
            'Subtotal' => $this->SubtotalD,
        ];
    }

   /* public static function getAll(){
        $conn = new conexion();
        $query = "EXEC SP_ListarCategorias";
        $result = $conn->getConnection()->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_CLASS, CategoriaModel::class);
    }
*/

}

?>