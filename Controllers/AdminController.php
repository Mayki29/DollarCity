<?php
class AdminController
{



    public function index()
    {
        view("admin.index");
    }
    public function empleados()
    {
        $emp = UsuarioModel::getAllEmpleados();
        view("admin.empleados", ["empleados" => $emp]);
    }
    public function proveedores(){
        $proveedores = ProveedorModel::getAll();
        view("admin.proveedores",["proveedores"=> $proveedores]);
    }
    public function productos(){
        $productos = ProductoModel::getAllAdmin();
        $categorias = CategoriaModel::getAll();
        $grafico = json_encode(ProductoModel::getstockPorCategoria());
        view("admin.productos",["productos"=>$productos, "categorias"=>$categorias, "grafico"=>$grafico]);
    }
    public function compras(){
   
        view("admin.compras");
    }

    public function pruebas(){

        $p = array("Stock"=>ProductoModel::getstockPorCategoria(), "Productos"=>ProductoModel::getAllAdmin());

        var_dump(json_encode($p));
    }


    public function registrarProducto(){
        $data = json_decode(file_get_contents('php://input'));
        $producto = new ProductoModel();
        $producto->setNombre($data->Nombre);
        $producto->setDescripcion($data->Descripcion);
        $producto->setPrecio($data->Precio);
        $producto->setCantidadEnStock($data->CantidadEnStock);
        $producto->setCategoriaID($data->CategoriaID);

        $resultado =  $producto->save();
        $resultado = ($resultado === "correct")? json_encode(ProductoModel::getAllAdmin()) : $resultado;

        echo $resultado;
    }

    public function modificarProducto(){
        $data = json_decode(file_get_contents('php://input'));
        $producto = new ProductoModel();
        $producto->setProductoID($data->ProductoID);
        $producto->setNombre($data->Nombre);
        $producto->setDescripcion($data->Descripcion);
        $producto->setPrecio($data->Precio);
        $producto->setCantidadEnStock($data->CantidadEnStock);
        $producto->setCategoriaID($data->CategoriaID);

        $resultado = $producto->edit();
        $resultado = ($resultado === "correct")? json_encode(ProductoModel::getAllAdmin()) : $resultado;
        echo $resultado;
    } 
    
    public function eliminarProducto(){
        $data = json_decode(file_get_contents('php://input'));
        $producto = new ProductoModel();
        $producto->setProductoID($data->ProductoID);

        $resultado = $producto->delete();
        $resultado = ($resultado === "correct")? json_encode(ProductoModel::getAllAdmin()) : $resultado;
        echo $resultado;
    }

#region Proveedor

    public function registrarProveedor(){
        $data = json_decode(file_get_contents('php://input'));
        $proveedor = new ProveedorModel();
        $proveedor->setRazonSocial($data->RazonSocial);
        $proveedor->setRUC($data->RUC);
        $proveedor->setDireccion($data->Direccion);
        $proveedor->setTelefono($data->Telefono);
        $proveedor->setEmail($data->Email);

        $resultado = $proveedor->save();
        $resultado = ($resultado === "correct")? json_encode(ProveedorModel::getAll()) : $resultado;
        echo $resultado;
    }

    public function modificarProveedor(){
        $data = json_decode(file_get_contents("php://input"));
        $proveedor = new ProveedorModel();
        $proveedor->setProveedorID($data->ProveedorID);
        $proveedor->setRazonSocial($data->RazonSocial);
        $proveedor->setRUC($data->RUC);
        $proveedor->setDireccion($data->Direccion);
        $proveedor->setTelefono($data->Telefono);
        $proveedor->setEmail($data->Email);

        $resultado = $proveedor->edit();
        $resultado = ($resultado === "correct")? json_encode(ProveedorModel::getAll()):$resultado;
        echo $resultado;
    }

    public function eliminarProveedor(){
        $data = json_decode(file_get_contents("php://input"));
        $proveedor = new ProveedorModel();
        $proveedor->setProveedorID($data->ProveedorID);
        $result = $proveedor->delete();
        $result = ($result === "correct")? json_encode(ProveedorModel::getAll()):$result;
        echo $result;
    }

#endregion
    

#region Empleado
public function registrarEmpleado()
    {
        $data = json_decode(file_get_contents('php://input'));
        $empleado = new UsuarioModel();
        $empleado->setNombres($data->nombres);
        $empleado->setApellidos($data->apellidos);
        $empleado->setEmail($data->email);
        $empleado->setDNI($data->dni);
        $empleado->setDireccion($data->direccion);
        $empleado->setNumeroTelefono($data->numeroTelefono);

        $resultado = $empleado->saveEmpleado();
        
        $resultado = ($resultado === "correct")? json_encode(UsuarioModel::getAllEmpleados()) : $resultado; 

        echo $resultado;

    }
    public function modificarEmpleado(){
        $data = json_decode(file_get_contents('php://input'));
        $empleado = new UsuarioModel();
        $empleado->setUsuarioID($data->usuarioId);
        $empleado->setNombres($data->nombres);
        $empleado->setApellidos($data->apellidos);
        $empleado->setEmail($data->email);
        $empleado->setDNI($data->dni);
        $empleado->setDireccion($data->direccion);
        $empleado->setNumeroTelefono($data->numeroTelefono);

        $resultado = $empleado->editEmpleado();
        $resultado = ($resultado === "correct")? json_encode(UsuarioModel::getAllEmpleados()) : $resultado;
        
        echo $resultado;

    }

    public function eliminarEmpleado(){
        $data = json_decode(file_get_contents('php://input'));
        $empleado = new UsuarioModel();
        $empleado->setUsuarioID($data->usuarioId);

        $resultado = $empleado->deleteEmpleado();
        $resultado = ($resultado === "correct")? json_encode(UsuarioModel::getAllEmpleados()) : $resultado;

        echo $resultado;


        
    }
#endregion
}
