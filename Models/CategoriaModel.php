<?php 
class CategoriaModel implements JsonSerializable{
    private $CategoriaID;
    private $Nombre;


    public function getCategoriaID()
    {
        return $this->CategoriaID;
    }

    public function setCategoriaID($CategoriaID)
    {
        $this->CategoriaID = $CategoriaID;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function jsonSerialize()
    {
        return [
            'CategoriaID' => $this->CategoriaID,
            'Nombre' => $this->Nombre
        ];
    }

    public static function getAll(){
        $conn = new conexion();
        $query = "EXEC SP_ListarCategorias";
        $result = $conn->getConnection()->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_CLASS, CategoriaModel::class);
    }


}

?>