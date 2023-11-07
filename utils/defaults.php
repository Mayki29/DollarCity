<?php 
if(!function_exists("view")){
    function view($nombreVista, $params = null){

        //En caso no sea null es por que es envió otro parametro
        if($params != null){
            foreach($params as $key => $param){
                $$key = $param; //obtenemos los parametros asignandolos en una variable con $$key 
                                //donde este tomara el nombre del parametro
            }
        }

        //explode divide un string en un array
        //utilizaremos la estructura de controlador.vista
        $vista = explode(".",$nombreVista); //le mencionamos cual sera el separador, ejm [0] => Home, [1]=> index
        include_once "./Views/{$vista[0]}/$vista[1].php";
    }
}
?>