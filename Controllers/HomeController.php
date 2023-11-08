<?php
$host_url = "http://localhost/DOLLARCITYMVC/";
//include("./includes/conexion.php"); 
class HomeController extends conexion{

    public function __construct(){}



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

    public function productos(){
        //Hacemos uso de la funcion estatica
        $p = ProductoModel::getAll();

        view("home.productos", ["productos" =>$p]);
    }


        //Funciones

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

    public function pruebaVenta(){
        $venta = new VentaModel();
        $detalle = new DetalleVentaModel();
        
        $ar = [
            ['ProductoID' => 1, 'Cantidad' => 10],
            ['ProductoID' => 2, 'Cantidad' => 10],
            ['ProductoID' => 3, 'Cantidad' => 5],
        ];

        
        $type = array('ProdDetalles' => $ar);
        $detalle->setProductoID(1);
        $detalle->setCantidad(4);

        $venta->setUsuarioID(1);
        $venta->setDetalleVenta($ar);
        $venta->setFechaVenta(date("d-m-Y h:i:s"));
        echo json_encode($ar);
        echo $venta->save();

    }

    

}

?>