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

    public function prueba(){
        $c = new conexion();
        $a = $c->getConnection()->prepare("select * from Usuario");
        $a->execute();

        var_dump($a->fetchAll(PDO::FETCH_CLASS, UsuarioModel::class));
    }

    

}

?>