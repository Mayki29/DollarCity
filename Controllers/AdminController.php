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
    public function proveedores()
    {
        $proveedores = ProveedorModel::getAll();
        view("admin.proveedores", ["proveedores" => $proveedores]);
    }
    public function productos()
    {
        $productos = ProductoModel::getAllAdmin();
        $categorias = CategoriaModel::getAll();
        $grafico = json_encode(ProductoModel::getstockPorCategoria());
        view("admin.productos", ["productos" => $productos, "categorias" => $categorias, "grafico" => $grafico]);
    }

    //COMPRAS
    public function compras()
    {
        $compras = CompraModel::getAllAdmin();
        $proveedores = ProveedorModel::getAll();
        view("admin.compras", ["compras" => $compras, "proveedores" => $proveedores]);
    }


    public function ventas()
    {

        view("admin.ventas");
    }

    public function pruebas()
    {

        //$p = array("Stock" => ProductoModel::getstockPorCategoria(), "Productos" => ProductoModel::getAllAdmin());

        
        /*$conn = new conexion();
        $r = $conn->getConnection()->prepare("SELECT * FROM DetalleCompra dc inner join Compra c  on dc.CompraID = c.CompraID;");
        $r->execute();
        $resultado = $r->fetchAll(PDO::FETCH_ASSOC);
        print_r($resultado);
        $listadetalle = [];
        $listaComp = [];
        $idControl = null;
        foreach ($resultado as $compra) {
            if ($idControl != $compra["CompraID"]) {
                $c = new CompraModel();
                $idControl = $compra["CompraID"];
                $c->setCompraID($compra["CompraID"]);
                $c->setUsuarioID($compra["UsuarioID"]);
                $c->setProveedorID($compra["FechaCompra"]);
                $c->setTotalCompra($compra["TotalCompra"]);
                foreach ($resultado as $dtcompra) {
                    if ($idControl == $dtcompra["CompraID"]) {
                        $dc = new DetalleCompraModel();
                        $dc->setDetalleCompraID($dtcompra["DetalleCompraID"]);
                        $dc->setProductoID($dtcompra["ProductoID"]);
                        $dc->setCantidad($dtcompra["Cantidad"]);
                        array_push($listadetalle, $dc);
                    }
                }
                $c->setDetalleCompra($listadetalle);
                array_push($listaComp, $c);
                $listadetalle = [];
            }
        }


        var_dump(json_encode($listaComp));*/
    }

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

        $resultado = ($resultado === "correct") ? json_encode(UsuarioModel::getAllEmpleados()) : $resultado;

        echo $resultado;
    }
    public function modificarEmpleado()
    {
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
        $resultado = ($resultado === "correct") ? json_encode(UsuarioModel::getAllEmpleados()) : $resultado;

        echo $resultado;
    }

    public function eliminarEmpleado()
    {
        $data = json_decode(file_get_contents('php://input'));
        $empleado = new UsuarioModel();
        $empleado->setUsuarioID($data->usuarioId);

        $resultado = $empleado->deleteEmpleado();
        $resultado = ($resultado === "correct") ? json_encode(UsuarioModel::getAllEmpleados()) : $resultado;

        echo $resultado;
    }
    #endregion

    #region Proveedor

    public function registrarProveedor()
    {
        $data = json_decode(file_get_contents('php://input'));
        $proveedor = new ProveedorModel();
        $proveedor->setRazonSocial($data->RazonSocial);
        $proveedor->setRUC($data->RUC);
        $proveedor->setDireccion($data->Direccion);
        $proveedor->setTelefono($data->Telefono);
        $proveedor->setEmail($data->Email);

        $resultado = $proveedor->save();
        $resultado = ($resultado === "correct") ? json_encode(ProveedorModel::getAll()) : $resultado;
        echo $resultado;
    }

    public function modificarProveedor()
    {
        $data = json_decode(file_get_contents("php://input"));
        $proveedor = new ProveedorModel();
        $proveedor->setProveedorID($data->ProveedorID);
        $proveedor->setRazonSocial($data->RazonSocial);
        $proveedor->setRUC($data->RUC);
        $proveedor->setDireccion($data->Direccion);
        $proveedor->setTelefono($data->Telefono);
        $proveedor->setEmail($data->Email);

        $resultado = $proveedor->edit();
        $resultado = ($resultado === "correct") ? json_encode(ProveedorModel::getAll()) : $resultado;
        echo $resultado;
    }

    public function eliminarProveedor()
    {
        $data = json_decode(file_get_contents("php://input"));
        $proveedor = new ProveedorModel();
        $proveedor->setProveedorID($data->ProveedorID);
        $result = $proveedor->delete();
        $result = ($result === "correct") ? json_encode(ProveedorModel::getAll()) : $result;
        echo $result;
    }

    #endregion

    #region Productos
    public function registrarProducto()
    {
        $data = json_decode(file_get_contents('php://input'));
        $producto = new ProductoModel();
        $producto->setNombre($data->Nombre);
        $producto->setDescripcion($data->Descripcion);
        $producto->setPrecio($data->Precio);
        $producto->setCantidadEnStock($data->CantidadEnStock);
        $producto->setCategoriaID($data->CategoriaID);

        $resultado =  $producto->save();
        $resultado = ($resultado === "correct") ? json_encode(ProductoModel::getAllAdmin()) : $resultado;

        echo $resultado;
    }

    public function modificarProducto()
    {
        $data = json_decode(file_get_contents('php://input'));
        $producto = new ProductoModel();
        $producto->setProductoID($data->ProductoID);
        $producto->setNombre($data->Nombre);
        $producto->setDescripcion($data->Descripcion);
        $producto->setPrecio($data->Precio);
        $producto->setCantidadEnStock($data->CantidadEnStock);
        $producto->setCategoriaID($data->CategoriaID);

        $resultado = $producto->edit();
        $resultado = ($resultado === "correct") ? json_encode(ProductoModel::getAllAdmin()) : $resultado;
        echo $resultado;
    }

    public function eliminarProducto()
    {
        $data = json_decode(file_get_contents('php://input'));
        $producto = new ProductoModel();
        $producto->setProductoID($data->ProductoID);

        $resultado = $producto->delete();
        $resultado = ($resultado === "correct") ? json_encode(ProductoModel::getAllAdmin()) : $resultado;
        echo $resultado;
    }

    #endregion

    #region Compras
    public function registrarCompra()
    {
        $data = json_decode(file_get_contents('php://input'));
        $compra = new CompraModel();
        $compra->setUsuarioID($data->Usuario);
        $compra->setProveedorID($data->Proveedor);
        $compra->setFechaCompra($data->FechaCompra);
        //$compra->setProductoID($data->Producto);

        $resultado =  $compra->save();
        $resultado = ($resultado === "correct") ? json_encode(CompraModel::getAllAdmin()) : $resultado;

        echo $resultado;
    }


    public function eliminarCompra()
    {
        $data = json_decode(file_get_contents("php://input"));
        $proveedor = new CompraModel();
        $proveedor->setProveedorID($data->ProveedorID);
        $result = $proveedor->delete();
        $result = ($result === "correct") ? json_encode(CompraModel::getAll()) : $result;
        echo $result;
    }

    #endregion
}
