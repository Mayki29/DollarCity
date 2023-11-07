<?php
class ProveedorModel implements JsonSerializable{
    private $ProveedorID;
    private $RazonSocial;
    private $RUC;
    private $Direccion;
    private $Telefono;
    private $Email;
    private $Estado;


    public function getProveedorID(){
        return $this->ProveedorID;
    }
    public function setProveedorID($ProveedorID){
        $this->ProveedorID=$ProveedorID;
    }
    public function getRazonSocial(){
        return $this->RazonSocial;
    }
    public function setRazonSocial($RazonSocial){
        $this->RazonSocial=$RazonSocial;
    }
    public function getRUC(){
        return $this->RUC;
    }
    public function setRUC($RUC){
        $this->RUC=$RUC;
    }
    public function getDireccion(){
        return $this->Direccion;
    }
    public function setDireccion($Direccion){
        $this->Direccion=$Direccion;
    }
    public function getTelefono(){
        return $this->Telefono;
    }
    public function setTelefono($Telefono){
        $this->Telefono=$Telefono;
    }
    public function getEmail(){
        return $this->Email;
    }
    public function setEmail($Email){
        $this->Email=$Email;
    }
    public function getEstado(){
        return $this->Estado;
    }
    public function setEstado($Estado){
        $this->Estado=$Estado;
    }

    public function jsonSerialize()
    {
        return [
            'ProveedorID' => $this->ProveedorID,
            'RazonSocial' => $this->RazonSocial,
            'RUC' => $this->RUC,
            'Direccion' => $this->Direccion,
            'Telefono' => $this->Telefono,
            'Email' => $this->Email,
            'Estado' => $this->Estado
        ];
    }

    public static function getAll(){
        $conn = new conexion();
        $result = $conn->getConnection()->prepare("EXEC SP_ListarProveedores");
        $result->execute();

        return $result->fetchAll(PDO::FETCH_CLASS, ProveedorModel::class);
    }

    public function save(){
        $conn = new conexion();
        $query = "EXEC SP_CrearProveedor :razonSocial, :ruc, :direccion, :telefono, :email";
        try{
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":razonSocial", $this->RazonSocial);
            $result->bindValue(":ruc", $this->RUC);
            $result->bindValue(":direccion", $this->Direccion);
            $result->bindValue(":telefono", $this->Telefono);
            $result->bindValue(":email", $this->Email);

            $result->execute();
            return "correct";
        }catch(PDOException $e){
            return "error";
        }

        
    }
    public function edit(){
        $conn = new conexion();
        $query = "EXEC SP_ActualizarProveedor :id, :razonSocial, :ruc, :direccion, :telefono, :email";

        try{
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":id", $this->ProveedorID);
            $result->bindValue(":razonSocial", $this->RazonSocial);
            $result->bindValue(":ruc", $this->RUC);
            $result->bindValue(":direccion", $this->Direccion);
            $result->bindValue(":telefono", $this->Telefono);
            $result->bindValue(":email", $this->Email);

            $result->execute();
            return "correct";
        }catch(PDOException $e){
            return "error";
        }
    }

    public function delete(){
        $conn = new conexion();
        $query = "EXEC SP_DeshabilitarProveedor :id";
        try{
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":id", $this->ProveedorID);
            $result->execute();

            return "correct";
        }catch(PDOException $e){
            return "error";
        }
    }
}


?>