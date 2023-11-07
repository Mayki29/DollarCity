<?php 
class DetalleVentaModel implements JsonSerializable{
    private $DetalleVentaID;
    private $VentaID;
    private $ProductoID;
    private $Cantidad;
    private $Subtotal;
    private $Estado;


    public function getDetalleVentaID()
    {
        return $this->VentaID;
    }

    public function setDetalleVentaID($DetalleVentaID)
    {
        $this->DetalleVentaID = $DetalleVentaID;
    }

    public function getVentaID()
    {
        return $this->UsuarioID;
    }

    public function setVentaID($VentaID)
    {
        $this->VentaID = $VentaID;
    }

 

    public function getProductoID()
    {
        return $this->ProductoID;
    }

    public function setProductoID($ProductoID)
    {
        $this->ProductoID= $ProductoID;
    }


    public function getCantidad()
    {
        return $this->Cantidad;
    }

    public function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;
    }

    
    public function getSubtotal()
    {
        return $this->Subtotal;
    }

    public function setSubtotal($Subtotal)
    {
        $this->Subtotal = $Subtotal;
    }



    public function getEstado()
    {
        return $this->Estado;
    }

    public function setEstado($Estado)
    {
        $this->Estado= $Estado;
    }

  
    private $DetalleVentaID;
    private $VentaID;
    private $ProductoID;
    private $Cantidad;
    private $Subtotal;
    private $Estado;


    public function jsonSerialize()
    {
        return [
            'DetalleVentaID' => $this->DetalleVentaID,
            'VentaID' => $this->VentaID,
            'ProductoID' => $this->ProductoID,
            'Cantidad' => $this->Cantidad,
            'Subtotal' => $this->Subtotal,
            'Estado' => $this->Estado,
        ];
    }
/*
    public static function getAll(){
    
    }
*/

}

?>