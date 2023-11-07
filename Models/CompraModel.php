<?php 
class CompraModel implements JsonSerializable{
    private $CompraID;
    private $UsuarioID;
    private $ProveedorID;
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
        return $this->DetalleCompra;
    }

    public function setDetalleCompra($DetalleCompra)
    {
        $this->DetalleCompra= $DetalleCompra;
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
/*
    public static function getAll(){
    
    }
*/

}

?>