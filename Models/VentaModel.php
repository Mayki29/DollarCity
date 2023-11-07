<?php 
class VentaModel implements JsonSerializable{
    private $VentaID;
    private $UsuarioID;
    private $FechaVenta;
    private $TotalVenta;
    private $Estado;


    public function getVentaID()
    {
        return $this->VentaID;
    }

    public function setVentaID($VentaID)
    {
        $this->VentaID = $VentaID;
    }

    public function getUsuarioID()
    {
        return $this->UsuarioID;
    }

    public function setUsuarioID($UsuarioID)
    {
        $this->UsuarioID = $UsuarioID;
    }

 

    public function getFechaVenta()
    {
        return $this->FechaVenta;
    }

    public function setFechaVenta($FechaVenta)
    {
        $this->FechaVenta = $FechaVenta;
    }


    public function getTotalVenta()
    {
        return $this->TotalVenta;
    }

    public function setTotalVenta($TotalVenta)
    {
        $this->TotalVenta = $TotalVenta;
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
            'VentaID' => $this->VentaID,
            'UsuarioID' => $this->UsuarioID,
            'FechaVenta' => $this->FechaVenta,
            'TotalVenta' => $this->TotalVenta,
            'Estado' => $this->Estado,
        ];
    }
/*
    public static function getAll(){
    
    }
*/

}

?>