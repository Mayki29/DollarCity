<?php 
class DetalleVentaModel implements JsonSerializable{
    private $DetalleVentaID;
    private $VentaID;
    private $ProductoID;
    private $Cantidad;
    private $SubTotal;
    

    public function getDetalleVentaID()
    {
        return $this->DetalleVentaID;
    }

    public function setDetalleVentaID($DetalleVentaID)
    {
        $this->DetalleVentaID = $DetalleVentaID;
    }

    public function getVentaID()
    {
        return $this->VentaID;
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
        $this->ProductoID = $ProductoID;
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
            'DetalleVentaID' => $this->DetalleVentaID,
            'VentaID' => $this->VentaID,
            'ProductoID' => $this->ProductoID,
            'Cantidad' => $this->Cantidad,
            'SubTotal' => $this->SubTotal,
            
        ];
    }


}


?>