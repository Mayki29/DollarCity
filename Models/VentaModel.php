<?php 
class VentaModel implements JsonSerializable{
    private $VentaID;
    private $UsuarioID;
    private $DetalleVenta;
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


    public function getDetalleVenta()
    {
        return $this->DetalleVenta;
    }

    public function setDetalleVenta($DetalleVenta)
    {
        $this->DetalleVenta = $DetalleVenta;
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



    public function save(){
        $conn = new conexion();
        $query = "EXEC SP_CrearVenta :iduser, :fecha, :json";
        try{
            $r = $conn->getConnection()->prepare($query);
            $r->bindValue(":iduser", $this->UsuarioID);
            $r->bindValue(":fecha", $this->FechaVenta);
            $r->bindValue(":json", json_encode($this->DetalleVenta));
            $r->execute();
            //echo $r->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            echo $e;
        }
    }

}

?>