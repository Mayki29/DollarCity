<?php

class HomeController extends conexion{
    

    public function __construct(){
        session_start();
    }



    //Renderizamos vistas
    public function index(){

        view("home.index");
        
    }
    public function nosotros(){
        view("home.nosotros");
    }
    public function ubicanos(){
        view("home.ubicanos");
    }

    public function contactanos(){
        view("home.contactanos");
    }

    public function carrito(){
        $productos = isset($_SESSION['carrito']['productos'])? $_SESSION['carrito']['productos'] :null;

        $lista_carrito = array();
        if($productos != null){
            foreach($productos as $clave => $cantidad){
                $c = new conexion();
                
                $sql = $c->getConnection()->prepare("SELECT *, $cantidad AS 'Cantidad', (Precio - ((Descuento/100)*Precio)) as 'PrecioFinal' FROM Producto WHERE ProductoID = :id and Estado = 1");
                $sql->bindValue(":id",$clave);
                $sql->execute();
                $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
            }
        }

        view("home.carrito", ['lista_carrito' => $lista_carrito]);
    }

    public function pago(){
        $productos = isset($_SESSION['carrito']['productos'])? $_SESSION['carrito']['productos'] :null;

        $lista_carrito = array();
        if($productos != null){
            foreach($productos as $clave => $cantidad){
                $c = new conexion();
                
                $sql = $c->getConnection()->prepare("SELECT *, $cantidad AS 'Cantidad', (Precio - ((Descuento/100)*Precio)) as 'PrecioFinal' FROM Producto WHERE ProductoID = :id and Estado = 1");
                $sql->bindValue(":id",$clave);
                $sql->execute();
                $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
            }
        }

        view("home.pago", ['lista_carrito' => $lista_carrito]);
    }

    public function productos(){
        //Hacemos uso de la funcion estatica
        $p = ProductoModel::getAll();

        view("home.productos", ["productos" =>$p]);
    }

    public function producto($id){
        $producto = ProductoModel::getById(intval($id));
        var_dump($producto);
        view("home.producto", ["producto"=> $producto]);
    }


    //Funciones

    function addCart(){

        if(isset($_POST['id'])){
            $id = $_POST['id'];
        
            if(isset($_SESSION['carrito']['productos'][$id])){
                $_SESSION['carrito']['productos'][$id] += 1;    
            }else{
                $_SESSION['carrito']['productos'][$id] = 1;
            }
            $datos['a'] = $_SESSION['carrito']['productos'];
            $datos['numero'] = count($_SESSION['carrito']['productos']);
            $datos['ok'] = true;
        
        }else{
            $datos['ok'] = false;
        }
        
        echo json_encode($datos);
    }
    function actualizarCantidad(){

        $id = isset($_POST['id'])? $_POST['id'] : 0;

        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        if($id > 0 && $cantidad > 0 && is_numeric(($cantidad))){
            if(isset($_SESSION['carrito']['productos'][$id])){
                $_SESSION['carrito']['productos'][$id] = $cantidad;
            }
            $datos['ok'] = true;
        }else{
            $datos['ok'] = false;
        }
        echo json_encode($datos);
    }

    function eliminarCariito(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];

            if(isset($_SESSION['carrito']['productos'][$id])){
                unset($_SESSION['carrito']['productos'][$id]);
                $datos['ok'] = true;
            }else{
                $datos['ok'] = false;
            }
        }else{
            $datos['ok'] = false;
        }
        echo json_encode($datos);
    }


    function getProducts(){
        $stm = $this->getConnection()->prepare("select top(18)* from Producto");
        $stm -> execute();
        return $productos = $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getCategorias(){
        return CategoriaModel::getAll();
    }

    public function prueba(){
        $c = new conexion();
        $a = $c->getConnection()->prepare("select * from Usuario");
        $a->execute();

        var_dump($a->fetchAll(PDO::FETCH_CLASS, UsuarioModel::class));
    }

    public function registrarVenta(){        
        $venta = new VentaModel();
        $detalle = new DetalleVentaModel();
        
        $productos = isset($_SESSION['carrito']['productos'])?$_SESSION['carrito']['productos']:null;
        $user = isset($_SESSION['user'])?$_SESSION['user']:null;

        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        $det = array();
        if(is_array($datos) && isset($_SESSION['user'])){
            $id_transaccion = $datos['detalles'];
            if($productos != null){
                foreach($productos as $clave => $cantidad){
                    $det[]=['ProductoID' => $clave, 'Cantidad' => $cantidad];
                }
        
                $fecha = $datos['detalles']['update_time'];
                $fecha_nueva = date("Y-m-d H:i:s", strtotime($fecha));
    
                $venta->setUsuarioID($user->getUsuarioID());
                $venta->setDetalleVenta($det);
                $venta->setFechaVenta($fecha_nueva);
                echo $venta->save();
            }
            unset($_SESSION['carrito']);
            $datos['ok'] = true;
            echo json_encode($datos);
        }
    }
}

?>