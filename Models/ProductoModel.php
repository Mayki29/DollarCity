<?php 
class ProductoModel implements JsonSerializable{
    private $ProductoID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $CantidadEnStock;
    private $CategoriaID;
    private $Categoria;
    private $Estado;

    //Getters and Setters
    public function getProductoID(){
        return $this->ProductoID;
    }
    public function setProductoID($ProductoID){
        $this->ProductoID = $ProductoID;
    }
    public function getNombre(){
        return $this->Nombre;
    }
    public function setNombre($Nombre){
        $this->Nombre = $Nombre;
    }
    public function getDescripcion(){
        return $this->Descripcion;
    }
    public function setDescripcion($Descripcion){
        $this->Descripcion = $Descripcion;
    }
    public function getPrecio(){
        return $this->Precio;
    }
    public function setPrecio($Precio){
        $this->Precio = $Precio;
    }
    public function getCantidadEnStock(){
        return $this->CantidadEnStock;
    }
    public function setCantidadEnStock($CantidadEnStock){
        $this->CantidadEnStock = $CantidadEnStock;
    }
    public function getCategoriaID(){
        return $this->CategoriaID;
    }
    public function setCategoriaID($CategoriaID){
        $this->CategoriaID = $CategoriaID;
    }
    public function getCategoria(){
        return $this->Categoria;
    }
    public function setCategoria($Categoria){
        $this->Categoria = $Categoria;
    }
    public function getEstado(){
        return $this->Estado;
    }
    public function setEstado($Estado){
        $this->Estado = $Estado;
    }

    public function jsonSerialize()
    {
        return [
            'ProductoID' => $this->ProductoID,
            'Nombre' => $this->Nombre,
            'Descripcion' => $this->Descripcion,
            'Precio' => $this->Precio,
            'CantidadEnStock' => $this->CantidadEnStock,
            'CategoriaID' => $this->CategoriaID,
            'Categoria' => $this->Categoria,
            'Estado' => $this->Estado
        ];
    }

    public static function getAll(){
        $conn = new conexion();
        $prepare = $conn->getConnection()->prepare("SELECT top(12)* FROM Producto");
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_CLASS, ProductoModel::class);
    }

    
    public static function getAllAdmin(){
        $conn = new conexion();
        $prepare = $conn->getConnection()->prepare("EXEC SP_ListarProductosAdmin");
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $listaProductos = [];
        foreach($result as $r){
            $producto = new ProductoModel();
            $categoria = new CategoriaModel();
            $producto->setProductoID($r["ProductoID"]);
            $producto->setNombre($r["Nombre"]);
            $producto->setDescripcion($r["Descripcion"]); 
            $producto->setPrecio($r["Precio"]);
            $producto->setCantidadEnStock($r["CantidadEnStock"]);

            $categoria->setCategoriaID($r["CategoriaID"]);
            $categoria->setNombre($r["Categoria"]);
            $producto->setCategoria($categoria);

            array_push($listaProductos, $producto);
        }
        return $listaProductos;

    }

    public function save(){
        $conn = new conexion();
        $query = "EXEC SP_CrearProducto :nombre, :descripcion, :precio, :stock, :catId";
        try{
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":nombre", $this->Nombre);
            $result->bindValue(":descripcion", $this->Descripcion);
            $result->bindValue(":precio", $this->Precio);
            $result->bindValue(":stock", $this->CantidadEnStock);
            $result->bindValue(":catId", $this->CategoriaID);
            
            $result->execute();

            return "correct";
        }catch(PDOException $e){
            return "error";
        }
        
    }

    public function edit(){
        $conn = new conexion();
        $query = "EXEC SP_ActualizarProducto :id, :nombre, :descripcion, :precio, :stock, :catId";
        try{
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":id", $this->ProductoID);
            $result->bindValue(":nombre", $this->Nombre);
            $result->bindValue(":descripcion", $this->Descripcion);
            $result->bindValue(":precio", $this->Precio);
            $result->bindValue(":stock", $this->CantidadEnStock);
            $result->bindValue(":catId", $this->CategoriaID);
            
            $result->execute();

            return "correct";
        }catch(PDOException $e){
            return "error";
        }
    }

    public function delete(){
        $conn = new conexion();
        $query = "EXEC SP_DeshabilitarProducto :id";
        try{
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":id", $this->ProductoID);
            
            $result->execute();

            return "correct";
        }catch(PDOException $e){
            return "error";
        }
    }

    public static function getstockPorCategoria(){
        $conn = new conexion();
        try{
            $result = $conn->getConnection()->prepare("EXEC SP_CantidadEnStockPorCategoria");
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return null;
        }
        

    }

}



?>