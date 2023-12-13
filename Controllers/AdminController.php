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

    public function pagos()
        {
       
            $pags = PagoModel::getAllPago();
            view("admin.pagos", ["pagos" => $pags]);
        }

    public function registrarPago() {//va sin parametros
            $data = json_decode(file_get_contents('php://input'));//con el file_get_contents recibes los datos enviados por POST
            $pago = new PagoModel();
            $pago->setUsuarioID($data->usuarioID);
            $pago->setFechaPago($data->fechaPago);
            $pago->setMonto($data->monto);
    
            $resultado = $pago->savePago(); 
           
            $resultado = ($resultado === "correct") ? json_encode(PagoModel::getAllPago()) : $resultado;

            echo $resultado;
     }
     



    public function graph(){
        $grafico = json_encode(ProductoModel::getstockPorCategoria());

        echo $grafico;
    }
    private function guardarImagen(){
        $imgPath = 'assets/img/Productos/';
        $tempPath = $_FILES["imagen"]["tmp_name"];
        $nombreImagen = basename($_FILES["imagen"]["name"]);
        $fileType = pathinfo($nombreImagen, PATHINFO_EXTENSION);
        $nuevoNombre = sprintf("%s_%s.%s",$imgPath . str_replace(" ","_",strtolower($_POST["nombre"])),  date("Ymd_his"),$fileType);
        move_uploaded_file($tempPath, "./".$nuevoNombre);
        $_FILES["imagen"]["name"] = null;
        return $nuevoNombre;
    }

    //COMPRAS
    public function compras()
    {
        $compras = CompraModel::getAllAdmin();
        $proveedores = ProveedorModel::getAll();
        $productos = ProductoModel::getAllAdmin();
        view("admin.compras", ["compras" => $compras, "proveedores" => $proveedores, "productos" => $productos]);
    }


    public function ventas()
    {

        view("admin.ventas");
    }

    public function pruebas()
    {
        $nombreProd = $_POST["nombre"];
        $dirImg = 'assets/img/';
        $ubicacionTemporal = $_FILES["imagen"]["tmp_name"];
        $nombreImagen = basename($_FILES["imagen"]["name"]);
        $fileType = pathinfo($nombreImagen, PATHINFO_EXTENSION);
        $nuevoNombre = sprintf("%s_%s.%s",$dirImg . str_replace(" ","_",strtolower($nombreProd)),  date("Ymd_his"),$fileType);
        move_uploaded_file($ubicacionTemporal, "./".$nuevoNombre);
        echo "Termino todo";

    
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
        
        //Creando Objeto Producto
        $producto = new ProductoModel();
        $producto->setNombre($_POST["nombre"]);
        $producto->setDescripcion($_POST["descripcion"]);
        $producto->setPrecio($_POST["precio"]);
        $producto->setCantidadEnStock($_POST["stock"]);
        $producto->setCategoriaID($_POST["categoria"]);
        $producto->setURLImagen($this->guardarImagen());

        //Guardando en base de datos
        $resultado =  $producto->save();

        if($resultado === "correct"){
            $productos = ProductoModel::getAllAdmin();
            $grafico = ProductoModel::getstockPorCategoria();

            $resultado = array("Productos"=>$productos, "Grafico"=>$grafico);
            echo json_encode($resultado);
        }else{
            echo $resultado;
        }
    }

    public function modificarProducto()
    {
        $producto = new ProductoModel();
        $producto->setProductoID($_POST["codigo"]);
        $producto->setNombre($_POST["nombre"]);
        $producto->setDescripcion($_POST["descripcion"]);
        $producto->setPrecio($_POST["precio"]);
        $producto->setCantidadEnStock($_POST["stock"]);
        $producto->setCategoriaID($_POST["categoria"]);

        if(isset($_FILES["imagen"]["name"])){
            $producto->setURLImagen($this->guardarImagen());
        };
        $resultado = $producto->edit();
        if($resultado === "correct"){
            $productos = ProductoModel::getAllAdmin();
            $grafico = ProductoModel::getstockPorCategoria();

            $resultado = array("Productos"=>$productos, "Grafico"=>$grafico);
            echo json_encode($resultado);
        }else{
            echo $resultado;
        }
    }

    public function eliminarProducto()
    {
        $data = json_decode(file_get_contents('php://input'));
        $producto = new ProductoModel();
        $producto->setProductoID($data->ProductoID);

        $resultado = $producto->delete();
        if($resultado === "correct"){
            $productos = ProductoModel::getAllAdmin();
            $grafico = ProductoModel::getstockPorCategoria();

            $resultado = array("Productos"=>$productos, "Grafico"=>$grafico);
            echo json_encode($resultado);
        }else{
            echo $resultado;
        }
    }


    public function buscarProducto($name){
        $conn = new conexion();
        $resultado = $conn->getConnection()->prepare("EXEC SP_BuscarProductoByNombre :nom");
        $resultado->bindValue(":nom", $name);
        $resultado->execute();
        echo json_encode($resultado->fetchAll(PDO::FETCH_ASSOC));
    }


    #endregion

    #region Compras
    public function registrarCompra()
    {
        $data = json_decode(file_get_contents('php://input'));
        $compra = new CompraModel();
        
        $compra->setUsuarioID($data->Empleado);
        $compra->setProveedorID($data->Proveedor);
        $compra->setFechaCompra(date("Y-m-d H:i:s", strtotime($data->Fecha)));

        $detalleList =[];
        foreach($data->Productos as $p){
            $detalle = new DetalleCompraModel();
            $detalle->setProductoID($p->Producto);
            $detalle->setCantidad($p->Cantidad);
            array_push($detalleList, $detalle);
        }
        $compra->setDetalleCompra($detalleList);

        $resultado =  $compra->save();
        $resultado = ($resultado === "correct") ? json_encode(CompraModel::getAllAdmin()) : $resultado;

        echo $resultado;
    }


    public function eliminarCompra()
    {
        $data = json_decode(file_get_contents("php://input"));
        $compra = new CompraModel();
        $compra->setCompraID($data->CodigoCompra);
        $result = $compra->delete();
        $result = ($result === "correct") ? json_encode(CompraModel::getAllAdmin()) : $result;
        echo $result;
    }

    #endregion
}
