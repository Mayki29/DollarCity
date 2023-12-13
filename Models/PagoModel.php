<?php 

class PagoModel implements JsonSerializable{
    private $PagosID;
    private $UsuarioID;
    private $FechaPago;
    private $Monto;
    private $Estado;

    public function getPagosID()
    {
        return $this->PagosID;
    }
    
    public function getUsuarioID()
    {
        return $this->UsuarioID;
    }
    
    public function getFechaPago()
    {
        return $this->FechaPago;
    }
    
    public function getMonto()
    {
        return $this->Monto;
    }
    
    public function getEstado()
    {
        return $this->Estado;
    }
    public function setPagosID($PagosID)
    {
        $this->PagosID = $PagosID;
    }
    
    public function setUsuarioID($UsuarioID)
    {
        $this->UsuarioID = $UsuarioID;
    }
    
    public function setFechaPago($FechaPago)
    {
        $this->FechaPago = $FechaPago;
    }
    
    public function setMonto($Monto)
    {
        $this->Monto = $Monto;
    }
    
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }
        

    

    public function jsonSerialize()
    {
        return [
            'PagosID' => $this->PagosID,
            'UsuarioID' => $this->UsuarioID,
            'FechaPago' => $this->FechaPago,
            'Monto' => $this->Monto,
            'Estado' => $this->Estado,
        ];
    }

    public static function getAllPago(){
        $conn = new conexion();
        $prepare = $conn->getConnection()->prepare("SELECT * FROM Pago");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, PagoModel::class);
    }

    public function savePago(){
        $conn = new conexion();
        $query = "EXEC SP_PagoEmpleado :UsuarioID, :FechaPago, :Monto";
        try {
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":UsuarioID", $this->UsuarioID);
            $result->bindValue(":FechaPago", $this->FechaPago);
            $result->bindValue(":Monto", $this->Monto);
    
            $result->execute();
    
            return "correct";
        } catch (PDOException $e) {
            return "error";
        }
    }
    
    
    
    
    
}



?>